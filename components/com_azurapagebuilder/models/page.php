<?php
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die;

class AzuraPagebuilderModelPage extends JModelItem
{
	/**
	 * Model context string.
	 *
	 * @var        string
	 */
	protected $context = 'com_azurapagebuilder.page';

		/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since   1.6
	 *
	 * @return void
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication('site');

		// Load state from the request.
		$pk = $app->input->getInt('id');
		$this->setState('page.id', $pk);

		$offset = $app->input->getUInt('limitstart');
		$this->setState('list.offset', $offset);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);

		// TODO: Tune these values based on other permissions.
		$user = JFactory::getUser();

		if ((!$user->authorise('core.edit.state', 'com_azurapagebuilder')) && (!$user->authorise('core.edit', 'com_azurapagebuilder')))
		{
			$this->setState('filter.published', 1);
			$this->setState('filter.archived', 2);
		}

		$this->setState('filter.language', JLanguageMultilang::isEnabled());
	}


	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since   1.6
	 *
	 * @return void
	 */
	// protected function populateState()
	// {
	// 	$app = JFactory::getApplication('site');

	// 	// Load state from the request.
	// 	$pk = $app->input->getInt('id');
	// 	$this->setState('page.id', $pk);

	// 	// Load the parameters.
	// 	$params = $app->getParams();

	// 	$this->setState('params', $params);

	// 	// TODO: Tune these values based on other permissions.
	// 	$user = JFactory::getUser();

	// 	if ((!$user->authorise('core.edit.state', 'com_azurapagebuilder')) && (!$user->authorise('core.edit', 'com_azurapagebuilder')))
	// 	{
	// 		$this->setState('filter.published', 1);
	// 		$this->setState('filter.archived', 2);
	// 	}

	// 	$this->setState('filter.language', JLanguageMultilang::isEnabled());
	// }

	/**
	 * Method to get page data.
	 *
	 * @param   integer  $pk  The id of the page.
	 *
	 * @return  mixed  Menu item data object on success, false on failure.
	 */
	public function getItem($pk = null)
	{
		$user	= JFactory::getUser();

		$pk = (!empty($pk)) ? $pk : (int) $this->getState('page.id');

		if ($this->_item === null)
		{
			$this->_item = array();
		}

		if (!isset($this->_item[$pk]))
		{
			try
			{
				$db = $this->getDbo();
				$query = $db->getQuery(true)
					->select(
						$this->getState(
							'item.select', 'a.id, a.asset_id, a.title, a.alias, a.introtext, a.fulltext, ' .
							'a.pagecontent, a.alt_layout, a.customCssLinks, '.
							// If badcats is not null, this means that the page is inside an unpublished category
							// In this case, the state is set to 0 to indicate Unpublished (even if the page state is Published)
							'CASE WHEN badcats.id is null THEN a.state ELSE 0 END AS state, ' .
							'a.catid, a.created, a.created_by, a.created_by_alias, ' .
							// Use created if modified is 0
							'CASE WHEN a.modified = ' . $db->quote($db->getNullDate()) . ' THEN a.created ELSE a.modified END as modified, ' .
							'a.modified_by, a.checked_out, a.checked_out_time, a.publish_up, a.publish_down, ' .
							//'a.images, a.urls, a.attribs, a.version, a.ordering, ' .
							'a.params, a.version, a.ordering, ' .
							//'a.metakey, a.metadesc, a.access, a.hits, a.metadata, a.featured, a.language, a.xreference'
							'a.metakey, a.metadesc, a.access, a.hits, a.metadata, a.language'
						)
					);
				$query->from('#__azurapagebuilder_pages AS a');

				// Join on likes table.
				// $query->select('l.like_count AS like_count, l.likedUsers AS likedUsers, l.likedIPs AS likedIPs')
				// 		->join('LEFT', '#__azurapagebuilder_likes AS l on l.pageID = a.id AND l.option = "com_azurapagebuilder"');

				$query->where('a.id = '. (int) $pk);


				// Join on category table.
				$query->select('c.title AS category_title, c.alias AS category_alias, c.access AS category_access')
					->join('LEFT', '#__categories AS c on c.id = a.catid');

				// Join on user table.
				$query->select('u.name AS author')
					->join('LEFT', '#__users AS u on u.id = a.created_by');

				// Filter by language
				if ($this->getState('filter.language'))
				{
					$query->where('a.language in (' . $db->quote(JFactory::getLanguage()->getTag()) . ',' . $db->quote('*') . ')');
				}

				// Join over the categories to get parent category titles
				$query->select('parent.title as parent_title, parent.id as parent_id, parent.path as parent_route, parent.alias as parent_alias')
					->join('LEFT', '#__categories as parent ON parent.id = c.parent_id');

				// Join on voting table
				$query->select('ROUND(v.rating_sum / v.rating_count, 0) AS rating, v.rating_count as rating_count')
					->join('LEFT', '#__content_rating AS v ON a.id = v.content_id')

					->where('a.id = ' . (int) $pk);

				if ((!$user->authorise('core.edit.state', 'com_azurapagebuilder')) && (!$user->authorise('core.edit', 'com_azurapagebuilder'))) {
					// Filter by start and end dates.
					$nullDate = $db->quote($db->getNullDate());
					$date = JFactory::getDate();

					$nowDate = $db->quote($date->toSql());

					$query->where('(a.publish_up = ' . $nullDate . ' OR a.publish_up <= ' . $nowDate . ')')
						->where('(a.publish_down = ' . $nullDate . ' OR a.publish_down >= ' . $nowDate . ')');
				}

				// Join to check for category published state in parent categories up the tree
				// If all categories are published, badcats.id will be null, and we just use the page state
				$subquery = ' (SELECT cat.id as id FROM #__categories AS cat JOIN #__categories AS parent ';
				$subquery .= 'ON cat.lft BETWEEN parent.lft AND parent.rgt ';
				$subquery .= 'WHERE parent.extension = ' . $db->quote('com_content');
				$subquery .= ' AND parent.published <= 0 GROUP BY cat.id)';
				$query->join('LEFT OUTER', $subquery . ' AS badcats ON badcats.id = c.id');

				// Filter by published state.
				$published = $this->getState('filter.published');
				$archived = $this->getState('filter.archived');

				if (is_numeric($published))
				{
					$query->where('(a.state = ' . (int) $published . ' OR a.state =' . (int) $archived . ')');
				}

				$db->setQuery($query);

				$data = $db->loadObject();

				if (empty($data))
				{
					return JError::raiseError(404, JText::_('COM_AZURAPAGEBUILDER_ERROR_PAGE_NOT_FOUND'));
				}

				// Check for published state if filter set.
				if (((is_numeric($published)) || (is_numeric($archived))) && (($data->state != $published) && ($data->state != $archived)))
				{
					return JError::raiseError(404, JText::_('COM_AZURAPAGEBUILDER_ERROR_PAGE_NOT_FOUND'));
				}

				// Convert parameter fields to objects.
				$registry = new JRegistry;
				$registry->loadString($data->params);

				$data->params = clone $this->getState('params');
				$data->params->merge($registry);

				$registry = new JRegistry;
				$registry->loadString($data->metadata);
				$data->metadata = $registry;

				/*$page_likes = new JRegistry;

				//echo'<pre>';var_dump($result->like_count);die;

				if(isset($result->like_count)){
					$page_likes->set('like_count',$result->like_count);
					if(!$user->guest){
						$likedUsers_Reg = new JRegistry;
						$likedUsers_Reg->loadString($result->likedUsers);
						$likedUsers_Reg = $likedUsers_Reg->toArray();
						if(array_search($user->id, $likedUsers_Reg) !== false){
							$page_likes->set('like_status','liked');
						}else{
							$page_likes->set('like_status','unliked');
						}
						//unset($likedUsers_Reg);
					}else{
						$likedIPs_Reg = new JRegistry;
						$likedIPs_Reg->loadString($result->likedIPs);
						$likedIPs_Reg = $likedIPs_Reg->toArray();

						$userIP = $_SERVER['REMOTE_ADDR'];

						if(array_search($userIP, $likedIPs_Reg) !== false){
							$page_likes->set('like_status','liked');
						}else{
							$page_likes->set('like_status','unliked');
						}
						//unset($likedIPs_Reg);
					}
				}else{
					$page_likes->set('like_count',0);
					$page_likes->set('like_status','unliked');
				}

				$data->page_likes = $page_likes;
				unset($page_likes);
				*/

				// Technically guest could edit an page, but lets not check that to improve performance a little.
				if (!$user->get('guest'))
				{
					$userId = $user->get('id');
					$asset = 'com_azurapagebuilder.page.' . $data->id;

					// Check general edit permission first.
					if ($user->authorise('core.edit', $asset))
					{
						$data->params->set('access-edit', true);
					}

					// Now check if edit.own is available.
					elseif (!empty($userId) && $user->authorise('core.edit.own', $asset))
					{
						// Check for a valid user and that they are the owner.
						if ($userId == $data->created_by)
						{
							$data->params->set('access-edit', true);
						}
					}
				}

				// Compute view access permissions.
				if ($access = $this->getState('filter.access'))
				{
					// If the access filter has been set, we already know this user can view.
					$data->params->set('access-view', true);
				}
				else
				{
					// If no access filter is set, the layout takes some responsibility for display of limited information.
					$user = JFactory::getUser();
					$groups = $user->getAuthorisedViewLevels();

					if ($data->catid == 0 || $data->category_access === null)
					{
						$data->params->set('access-view', in_array($data->access, $groups));
					}
					else
					{
						$data->params->set('access-view', in_array($data->access, $groups) && in_array($data->category_access, $groups));
					}
				}

				$this->_item[$pk] = $data;
			}
			catch (Exception $e)
			{
				if ($e->getCode() == 404)
				{
					// Need to go thru the error handler to allow Redirect to work.
					JError::raiseError(404, $e->getMessage());
				}
				else
				{
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}
		}

		return $this->_item[$pk];
	}

	public function getPageLikes($pk = null){
		$user	= JFactory::getUser();
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('page.id');
				
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);
		//$query->select($this->getState('item.select', 'a.*'));


		//$query->from($db->quoteName('#__azurapagebuilder_pages').' AS a');

		$query->select('l.like_count AS like_count, l.likedUsers AS likedUsers, l.likedIPs AS likedIPs')
				->from($db->quoteName('#__azurapagebuilder_likes').' AS l');

		$query->where('(l.pageID = '. (int) $pk.' AND l.option = "com_azurapagebuilder")');

		$db->setQuery($query);

		// convert page params to JRegistry object

		$result = $db->loadObject();

		$page_likes = new JRegistry;

		//echo'<pre>';var_dump($result->like_count);die;

		if(isset($result->like_count)){
			$page_likes->set('like_count',$result->like_count);
			if(!$user->guest){
				$likedUsers_Reg = new JRegistry;
				$likedUsers_Reg->loadString($result->likedUsers);
				$likedUsers_Reg = $likedUsers_Reg->toArray();
				if(array_search($user->id, $likedUsers_Reg) !== false){
					$page_likes->set('like_status','liked');
				}else{
					$page_likes->set('like_status','unliked');
				}
				//unset($likedUsers_Reg);
			}else{
				$likedIPs_Reg = new JRegistry;
				$likedIPs_Reg->loadString($result->likedIPs);
				$likedIPs_Reg = $likedIPs_Reg->toArray();

				$userIP = $_SERVER['REMOTE_ADDR'];

				if(array_search($userIP, $likedIPs_Reg) !== false){
					$page_likes->set('like_status','liked');
				}else{
					$page_likes->set('like_status','unliked');
				}
				//unset($likedIPs_Reg);
			}
		}else{
			$page_likes->set('like_count',0);
			$page_likes->set('like_status','unliked');
		}

		// $data->page_likes = $page_likes;
		// unset($page_likes);
		return $page_likes;


	}



	/**
	 * Method to get article data.
	 *
	 * @param   integer  $pk  The id of the article.
	 *
	 * @return  mixed  Menu item data object on success, false on failure.
	 */
	// public function getItem($pk = null)
	// {
	// 	$user	= JFactory::getUser();
	// 	$db = JFactory::getDbo();

	// 	$query = $db->getQuery(true);
	// 	$query->select($this->getState('item.select', 'a.*'));

	// 	$pk = (!empty($pk)) ? $pk : (int) $this->getState('page.id');

	// 	$query->from($db->quoteName('#__azurapagebuilder_pages').' AS a');

	// 	// Join on user table.
	// 	$query->select('u.name AS author')
	// 			->join('LEFT', '#__users AS u on u.id = a.created_by');
	// 	// Join on likes table.
	// 	$query->select('l.like_count AS like_count, l.likedUsers AS likedUsers, l.likedIPs AS likedIPs')
	// 			->join('LEFT', '#__azurapagebuilder_likes AS l on l.pageID = a.id AND l.option = "com_azurapagebuilder"');

	// 	$query->where('a.id = '. (int) $pk);

	// 	$db->setQuery($query);

	// 	// convert page params to JRegistry object

	// 	$result = $db->loadObject();

	// 	if($result){

	// 		$params = new JRegistry;

	// 		$params->loadString($result->params);

	// 		$result->params = $params;

	// 		$metadata = new JRegistry;

	// 		$metadata->loadString($result->metadata);

	// 		$result->metadata = $metadata;

	// 		$page_likes = new JRegistry;

	// 		//echo'<pre>';var_dump($result->like_count);die;

	// 		if(isset($result->like_count)){
	// 			$page_likes->set('like_count',$result->like_count);
	// 			if(!$user->guest){
	// 				$likedUsers_Reg = new JRegistry;
	// 				$likedUsers_Reg->loadString($result->likedUsers);
	// 				$likedUsers_Reg = $likedUsers_Reg->toArray();
	// 				if(array_search($user->id, $likedUsers_Reg) !== false){
	// 					$page_likes->set('like_status','liked');
	// 				}else{
	// 					$page_likes->set('like_status','unliked');
	// 				}
	// 				//unset($likedUsers_Reg);
	// 			}else{
	// 				$likedIPs_Reg = new JRegistry;
	// 				$likedIPs_Reg->loadString($result->likedIPs);
	// 				$likedIPs_Reg = $likedIPs_Reg->toArray();

	// 				$userIP = $_SERVER['REMOTE_ADDR'];

	// 				if(array_search($userIP, $likedIPs_Reg) !== false){
	// 					$page_likes->set('like_status','liked');
	// 				}else{
	// 					$page_likes->set('like_status','unliked');
	// 				}
	// 				//unset($likedIPs_Reg);
	// 			}
	// 		}else{
	// 			$page_likes->set('like_count',0);
	// 			$page_likes->set('like_status','unliked');
	// 		}

	// 		$result->page_likes = $page_likes;

	// 		unset($page_likes);
	// 		unset($result->like_count);
	// 		unset($result->likedUsers);
	// 		unset($result->likedIPs);

	// 		return $result;
	// 	}else{
	// 		return JError::raiseError(404, JText::_('COM_AZURAPAGEBUILDER_ERROR_PAGE_NOT_FOUND'));
	// 	}

		

		
	// }

	// public function getElements($pageID = null){
	// 	$pageID = (!empty($pageID)) ? $pageID : (int) $this->getState('page.id');

	// 	$db = JFactory::getDbo();

	// 	$query = $db->getQuery(true);
	// 	$query->select('e.*');
	// 	$query->from($db->quoteName('#__azurapagebuilder_elements') . ' AS e');
	// 	$query->where('e.level = 0 AND e.pageID = ' .(int) $pageID);
	// 	$query->where('e.published = 1 AND e.trash = 0');

	// 	$query->order('e.elementOrder ASC');

	// 	$db->setQuery($query,0,'All');

	// 	$results = $db->loadObjectList();

	// 	return $results;

	// }

	// public function getChildElements($id){

	// 	$db = $this->getDbo();

	// 	$pageId = $this->getState('page.id');

	// 	$query = $db->getQuery(true);

	// 	$query->select('e.*')//select('e.id,e.pageID,e.name,e.type,e.shortcode,e.content,e.attrs')
	// 			->from($db->quoteName('#__azurapagebuilder_elements') . ' as e')
	// 			->where('e.hasParentID = '.(int)$id.' AND e.pageID = '.(int) $pageId)
	// 			->where('e.published = 1 AND e.trash = 0')
	// 			->order('e.elementOrder asc');

	// 	$db->setQuery($query);

	// 	$elements = $db->loadObjectList();

	// 	return $elements;
	// }

	public function getAlt_layout($pk = null)
	{
		$user	= JFactory::getUser();
		$db = JFactory::getDbo();

		$query = $db->getQuery(true);
		$query->select($db->quoteName('a.alt_layout'));

		$pk = (!empty($pk)) ? $pk : (int) $this->getState('page.id');

		$query->from($db->quoteName('#__azurapagebuilder_pages').' AS a');

		$query->where('a.id = '. (int) $pk);

		$db->setQuery($query);

		// convert page params to JRegistry object

		return $db->loadResult();

	}
	public function addComment(){

		$db = JFactory::getDbo();
		$userId = JFactory::getUser()->get('id');
		$input = JFactory::getApplication()->input;
		$comment = $input->getString('comment', '');

		$pk = (int) $this->getState('product.id');

		// variable for new comment to add
		$newComment = array();

		$newComment['userid'] = (int) $userId;
		$newComment['username'] = JFactory::getUser()->get('username');
		$newComment['comment'] = $comment;
		$newComment['created'] = JFactory::getDate()->toSql(true);


		$query = $db->getQuery(true);

			// Create the base select statement.
		$query->select('*')
			  ->from($db->quoteName('#__carts_products_comments'))
			  ->where($db->quoteName('product_id') . ' = ' . (int) $pk);

		// Set the query and load the result.
		$db->setQuery($query);
		$comments = $db->loadObject();

		$return = array();

		// Check for a database error.
		if ($db->getErrorNum()){
			$return['success'] = false;
			$return['error'] = $db->getErrorMsg();

			return $return;
		}

		if (!$comments) {
			// add comment for new product
			$commentExists = array();
			$commentExists[] = $newComment;

			$temp = new JRegistry;
			$temp->loadArray($commentExists);

			$commentExists = $temp->toString();

			$query = $db->getQuery(true);

				// Create the base insert statement.
				$query->insert($db->quoteName('#__carts_products_comments'))
					->columns(array($db->quoteName('product_id'), $db->quoteName('comments'), $db->quoteName('params')))
					->values((int) $pk . ', ' . $db->quote($commentExists) . ', "params goes here"');

				// Set the query and execute the insert.
				$db->setQuery($query);

				try
				{
					$db->execute();
				}
				catch (RuntimeException $e)
				{
					JError::raiseWarning(500, $e->getMessage());

					$return['success'] = false;
					$return['error'] = $e->getMessage();

					return $return;
				}

			$return['success'] = true;
			$return['error'] = '';
			$return['comment'] = $newComment;

			return $return;
		}else{

			$commentExists = $comments->comments;

			$temp = new JRegistry;

			$temp->loadString($commentExists);

			$commentExists = $temp->toArray();

			array_unshift($commentExists, $newComment);

			$temp = new JRegistry;

			$temp->loadArray($commentExists);

			$commentExists = $temp->toString();

			//$return[] = $commentExists;

			//return $return;



			$query = $db->getQuery(true);

				// Create the base update statement.
				$query->update($db->quoteName('#__carts_products_comments').' ')
					->set($db->quoteName('comments') . ' = ' .$db->quote($commentExists))
					->where($db->quoteName('product_id') . ' = ' . (int) $pk);

				// Set the query and execute the update.
				$db->setQuery($query);

				try
				{
					$db->execute();
				}
				catch (RuntimeException $e)
				{
					JError::raiseWarning(500, $e->getMessage());

					$return['success'] = false;
					$return['error'] = $e->getMessage();

					return $return;
				}

			$return['success'] = true;
			$return['error'] = '';
			$return['comment'] = $newComment;

			return $return;

		}

		$return['success'] = false;
		$return['error'] = 'Unknow error';

		return $return;
	}


	public function getComments(){

		$db = JFactory::getDbo();
		$input = JFactory::getApplication()->input;

		$pk = (int) $this->getState('product.id');

		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('*')
			  ->from($db->quoteName('#__carts_products_comments'))
			  ->where($db->quoteName('product_id') . ' = ' . (int) $pk);

		// Set the query and load the result.
		$db->setQuery($query);
		$comment = $db->loadObject();

		$return = array();

		// Check for a database error.
		if ($db->getErrorNum()){

			JError::raiseWarning(500, $db->getErrorMsg());

			return false;
		}

		if(!$comment){
			return false;
		}
		else {
			$return = $comment->comments;

			$temp = new JRegistry;
			$temp->loadString($return);
			$return = $temp->toArray();

			$this->_comments_total = count($return);

			$limit = $this->getState('list.limit');

			$limitstart = $this->getState('list.start');

			$return = array_slice($return, $limitstart, $limit);

			return $return;
		}

	}

		/**
	 * Method to get a JPagination object for the comments data set.
	 *
	 * @return  JPagination  A JPagination object for the data set.
	 *
	 * @since   12.2
	 */
	public function getCommentsPagination()
	{
		// Get a storage key.
		$store = $this->getStoreId('getPagination');

		// Try to load the data from internal storage.
		if (isset($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		// Create the pagination object.
		$limit = (int) $this->getState('list.limit') - (int) $this->getState('list.links');
		$page = new JPagination($this->getTotal(), $this->getStart(), $limit);

		// Add the object to the internal cache.
		$this->cache[$store] = $page;

		return $this->cache[$store];
	}

	/**
	 * Method to get a store id based on the model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  An identifier string to generate the store id.
	 *
	 * @return  string  A store id.
	 *
	 * @since   12.2
	 */
	protected function getStoreId($id = '')
	{
		// Add the list state to the store id.
		$id .= ':' . $this->getState('list.start');
		$id .= ':' . $this->getState('list.limit');

		return md5($this->context . ':' . $id);
	}

	/**
	 * Method to get the total number of items for the data set.
	 *
	 * @return  integer  The total number of items available in the data set.
	 *
	 * @since   12.2
	 */
	public function getTotal()
	{
		// Get a storage key.
		$store = $this->getStoreId('getTotal');

		// Try to load the data from internal storage.
		if (isset($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		// Load the total.
		
		// Add the total to the internal cache.
		$this->cache[$store] = $this->_comments_total;

		return $this->cache[$store];
	}

	/**
	 * Method to get the starting number of items for the data set.
	 *
	 * @return  integer  The starting number of items available in the data set.
	 *
	 * @since   12.2
	 */
	public function getStart()
	{
		$store = $this->getStoreId('getstart');

		// Try to load the data from internal storage.
		if (isset($this->cache[$store]))
		{
			return $this->cache[$store];
		}

		$start = $this->getState('list.start');
		$limit = $this->getState('list.limit');
		$total = $this->getTotal();

		if ($start > $total - $limit)
		{
			$start = max(0, (int) (ceil($total / $limit) - 1) * $limit);
		}

		// Add the total to the internal cache.
		$this->cache[$store] = $start;

		return $this->cache[$store];
	}


	/**
	 * Increment the hit counter for the article.
	 *
	 * @param   integer  $pk  Optional primary key of the article to increment.
	 *
	 * @return  boolean  True if successful; false otherwise and internal error set.
	 */
	public function hit($pk = 0)
	{
		$input = JFactory::getApplication()->input;
		$hitcount = $input->getInt('hitcount', 1);

		if ($hitcount)
		{
			$pk = (!empty($pk)) ? $pk : (int) $this->getState('page.id');

			$table = JTable::getInstance('Page', 'AzuraPagebuilderTable');
			$table->load($pk);
			$table->hit($pk);
		}

		return true;
	}

	/**
	 * Save user vote on page
	 *
	 * @param   integer  $pk    Joomla Article Id
	 * @param   integer  $rate  Voting rate
	 *
	 * @return  boolean          Return true on success
	 */
	public function storeVote($pk = 0, $rate = 0)
	{
		if ($rate >= 1 && $rate <= 5 && $pk > 0)
		{
			$userIP = $_SERVER['REMOTE_ADDR'];

			// Initialize variables.
			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);

			// Create the base select statement.
			$query->select('*')
				->from($db->quoteName('#__content_rating'))
				->where($db->quoteName('content_id') . ' = ' . (int) $pk);

			// Set the query and load the result.
			$db->setQuery($query);

			// Check for a database error.
			try
			{
				$rating = $db->loadObject();
			}
			catch (RuntimeException $e)
			{
				JError::raiseWarning(500, $e->getMessage());

				return false;
			}

			// There are no ratings yet, so lets insert our rating
			if (!$rating)
			{
				$query = $db->getQuery(true);

				// Create the base insert statement.
				$query->insert($db->quoteName('#__content_rating'))
					->columns(array($db->quoteName('content_id'), $db->quoteName('lastip'), $db->quoteName('rating_sum'), $db->quoteName('rating_count')))
					->values((int) $pk . ', ' . $db->quote($userIP) . ',' . (int) $rate . ', 1');

				// Set the query and execute the insert.
				$db->setQuery($query);

				try
				{
					$db->execute();
				}
				catch (RuntimeException $e)
				{
					JError::raiseWarning(500, $e->getMessage());

					return false;
				}
			}
			else
			{
				if ($userIP != ($rating->lastip))
				{
					$query = $db->getQuery(true);

					// Create the base update statement.
					$query->update($db->quoteName('#__content_rating'))
						->set($db->quoteName('rating_count') . ' = rating_count + 1')
						->set($db->quoteName('rating_sum') . ' = rating_sum + ' . (int) $rate)
						->set($db->quoteName('lastip') . ' = ' . $db->quote($userIP))
						->where($db->quoteName('content_id') . ' = ' . (int) $pk);

					// Set the query and execute the update.
					$db->setQuery($query);

					try
					{
						$db->execute();
					}
					catch (RuntimeException $e)
					{
						JError::raiseWarning(500, $e->getMessage());

						return false;
					}
				}
				else
				{
					return false;
				}
			}

			return true;
		}

		JError::raiseWarning('SOME_ERROR_CODE', JText::sprintf('COM_AZP_INVALID_RATING', $rate), "JModelPage::storeVote($rate)");

		return false;
	}
}
