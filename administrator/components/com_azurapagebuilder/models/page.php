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

//Import filesystem libraries. Perhaps not necessary, but does not hurt
jimport('joomla.filesystem.file');

JLoader::register('AzuraPagebuilderHelper', JPATH_ADMINISTRATOR . '/components/com_azurapagebuilder/helpers/azurapagebuilder.php');

class AzuraPagebuilderModelPage extends JModelAdmin
{

	/**
	 * The type alias for this content type.
	 *
	 * @var      string
	 * @since    3.2
	 */
	public $typeAlias = 'com_azurapagebuilder.page';

	/**
	 * The prefix to use with controller messages.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $text_prefix = 'COM_AZURAPAGEBUILDER';

	protected $item = null;

	protected static $elementOrder = 0;

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission for the component.
	 *
	 * @since   1.6
	 */
	// protected function canDelete($record)
	// {
	// 	if (!empty($record->id))
	// 	{
	// 		if ($record->state != -2)
	// 		{
	// 			return;
	// 		}

	// 		$user = JFactory::getUser();

	// 		if ($record->id)
	// 		{
	// 			return $user->authorise('core.delete', 'com_azurapagebuilder.page.'.(int) $record->id);
	// 		}
	// 		else
	// 		{
	// 			return parent::canDelete($record);
	// 		}
	// 	}
	// }
	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to delete the record. Defaults to the permission set in the component.
	 *
	 * @since   1.6
	 */
	protected function canDelete($record)
	{
		if (!empty($record->id))
		{
			if ($record->state != -2)
			{
				return;
			}
			$user = JFactory::getUser();
			return $user->authorise('core.delete', 'com_azurapagebuilder.page.' . (int) $record->id);
		}
	}

	/**
	 * Method to test whether a record can be deleted.
	 *
	 * @param   object  $record  A record object.
	 *
	 * @return  boolean  True if allowed to change the state of the record. Defaults to the permission for the component.
	 *
	 * @since   1.6
	 */
	// protected function canEditState($record)
	// {
	// 	$user = JFactory::getUser();

	// 	if (!empty($record->id))
	// 	{
	// 		return $user->authorise('core.edit.state', 'com_azurapagebuilder.page.'.(int) $record->id);
	// 	}
	// 	else
	// 	{
	// 		return parent::canEditState($record);
	// 	}
	// }
	protected function canEditState($record)
	{
		$user = JFactory::getUser();

		// Check for existing article.
		if (!empty($record->id))
		{
			return $user->authorise('core.edit.state', 'com_azurapagebuilder.page.' . (int) $record->id);
		}
		// New article, so check against the category.
		elseif (!empty($record->catid))
		{
			return $user->authorise('core.edit.state', 'com_azurapagebuilder.category.' . (int) $record->catid);
		}
		// Default to component settings if neither article nor category known.
		else
		{
			return parent::canEditState('com_azurapagebuilder');
		}
	}

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'Page', $prefix = 'AzuraPagebuilderTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	* Get table for element
	*
	*/

	// public function getTableElement($type = 'Element', $prefix = 'AzuraPagebuilderTable', $config = array())
	// {
	// 	return JTable::getInstance($type, $prefix, $config);
	// }

	/**
	 * Method to get the record form.
	 *
	 * @param   array      $data        Data for the form.
	 * @param   boolean    $loadData    True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed  A JForm object on success, false on failure
	 * @since   1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		//JForm::addFieldPath('JPATH_ADMINISTRATOR/components/com_users/models/fields');
		// Get the form.
		$form = $this->loadForm('com_azurapagebuilder.page', 'page', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		$jinput = JFactory::getApplication()->input;

		// The front end calls this model and uses a_id to avoid id clashes so we need to check for that first.
		if ($jinput->get('p_id'))
		{
			$id = $jinput->get('p_id', 0);
		}
		// The back end uses id so we use that the rest of the time and set it to 0 by default.
		else
		{
			$id = $jinput->get('id', 0);
		}
		// Determine correct permissions to check.
		if ($this->getState('page.id'))
		{
			$id = $this->getState('page.id');
			// Existing record. Can only edit in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit');
			// Existing record. Can only edit own articles in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.edit.own');
		}
		else
		{
			// New record. Can only create in selected categories.
			$form->setFieldAttribute('catid', 'action', 'core.create');
		}

		$user = JFactory::getUser();

		// Check for existing article.
		// Modify the form based on Edit State access controls.
		if ($id != 0 && (!$user->authorise('core.edit.state', 'com_azurapagebuilder.page.' . (int) $id))
			|| ($id == 0 && !$user->authorise('core.edit.state', 'com_azurapagebuilder'))
		)
		{
			// Disable fields for display.
			//$form->setFieldAttribute('featured', 'disabled', 'true');
			$form->setFieldAttribute('ordering', 'disabled', 'true');
			$form->setFieldAttribute('publish_up', 'disabled', 'true');
			$form->setFieldAttribute('publish_down', 'disabled', 'true');
			$form->setFieldAttribute('state', 'disabled', 'true');

			// Disable fields while saving.
			// The controller has already verified this is an page you can edit.
			//$form->setFieldAttribute('featured', 'filter', 'unset');
			$form->setFieldAttribute('ordering', 'filter', 'unset');
			$form->setFieldAttribute('publish_up', 'filter', 'unset');
			$form->setFieldAttribute('publish_down', 'filter', 'unset');
			$form->setFieldAttribute('state', 'filter', 'unset');
		}

		// Prevent messing with page language and category when editing existing page with associations
		$app = JFactory::getApplication();
		$assoc = JLanguageAssociations::isEnabled();

		// Check if page is associated
		if ($this->getState('page.id') && $app->isSite() && $assoc)
		{
			$associations = JLanguageAssociations::getAssociations('com_azurapagebuilder', '#__azurapagebuilder_pages', 'com_azurapagebuilder.item', $id);

			// Make fields read only
			if ($associations)
			{
				$form->setFieldAttribute('language', 'readonly', 'true');
				$form->setFieldAttribute('catid', 'readonly', 'true');
				$form->setFieldAttribute('language', 'filter', 'unset');
				$form->setFieldAttribute('catid', 'filter', 'unset');
			}
		}

		return $form;
	}


	/**
	 * Abstract method for getting the form from the model.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed  A JForm object on success, false on failure
	 *
	 * @since   1.6
	 */
	// public function getForm($data = array(), $loadData = true)
	// {
	// 	// Get the form.
	// 	$form = $this->loadForm('com_azurapagebuilder.page', 'page', array('control' => 'jform', 'load_data' => $loadData));

	// 	if (empty($form))
	// 	{
	// 		return false;
	// 	}

	// 	// Modify the form based on access controls.
	// 	if (!$this->canEditState((object) $data))
	// 	{
	// 		// Disable fields for display.
	// 		$form->setFieldAttribute('ordering', 'disabled', 'true');
	// 		$form->setFieldAttribute('state', 'disabled', 'true');
	// 		$form->setFieldAttribute('publish_up', 'disabled', 'true');
	// 		$form->setFieldAttribute('publish_down', 'disabled', 'true');

	// 		// Disable fields while saving.
	// 		// The controller has already verified this is a record you can edit.
	// 		$form->setFieldAttribute('ordering', 'filter', 'unset');
	// 		$form->setFieldAttribute('state', 'filter', 'unset');
	// 		$form->setFieldAttribute('publish_up', 'filter', 'unset');
	// 		$form->setFieldAttribute('publish_down', 'filter', 'unset');
	// 	}

	// 	return $form;
	// }

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return  array  The default data is an empty array.
	 *
	 * @since   1.6
	 */
	// protected function loadFormData()
	// {
	// 	// Check the session for previously entered form data.
	// 	$data = JFactory::getApplication()->getUserState('com_azurapagebuilder.edit.page.data', array());

	// 	if (empty($data))
	// 	{
	// 		$data = $this->getItem();

	// 		// Prime some default values.
	// 		if ($this->getState('page.id') == 0)
	// 		{
	// 			$app = JFactory::getApplication();
	// 		}
	// 	}

	// 	$this->preprocessData('com_azurapagebuilder.page', $data);

	// 	return $data;
	// }

	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$app = JFactory::getApplication();
		$data = $app->getUserState('com_azurapagebuilder.edit.page.data', array());

		if (empty($data))
		{
			$data = $this->getItem();

			// Prime some default values.
			if ($this->getState('page.id') == 0)
			{
				$filters = (array) $app->getUserState('com_azurapagebuilder.pages.filter');
				$filterCatId = isset($filters['category_id']) ? $filters['category_id'] : null;

				$data->set('catid', $app->input->getInt('catid', $filterCatId));
			}
		}

		$this->preprocessData('com_azurapagebuilder.page', $data);

		return $data;
	}

	/**
	 * Auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return  void
	 * @since    3.0
	 */
	protected function preprocessForm(JForm $form, $data, $group = 'content')
	{
		// Association content items
		$app = JFactory::getApplication();
		$assoc = JLanguageAssociations::isEnabled();
		if ($assoc)
		{
			$languages = JLanguageHelper::getLanguages('lang_code');
			$addform = new SimpleXMLElement('<form />');
			$fields = $addform->addChild('fields');
			$fields->addAttribute('name', 'associations');
			$fieldset = $fields->addChild('fieldset');
			$fieldset->addAttribute('name', 'item_associations');
			$fieldset->addAttribute('description', 'COM_CONTENT_ITEM_ASSOCIATIONS_FIELDSET_DESC');
			$add = false;
			foreach ($languages as $tag => $language)
			{
				if (empty($data->language) || $tag != $data->language)
				{
					$add = true;
					$field = $fieldset->addChild('field');
					$field->addAttribute('name', $tag);
					$field->addAttribute('type', 'modal_page');
					$field->addAttribute('language', $tag);
					$field->addAttribute('label', $language->title);
					$field->addAttribute('translate_label', 'false');
					$field->addAttribute('edit', 'true');
					$field->addAttribute('clear', 'true');
				}
			}
			if ($add)
			{
				$form->load($addform, false);
			}
		}

		parent::preprocessForm($form, $data, $group);
	}


	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed  Object on success, false on failure.
	 *
	 * @since   1.6
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk))
		{
			// Convert the metadata field to an array.
			$registry = new JRegistry;
			$registry->loadString($item->metadata);
			$item->metadata = $registry->toArray();

			$item->description = trim($item->fulltext) != '' ? $item->introtext . "<hr id=\"system-readmore\" />" . $item->fulltext : $item->introtext;

			if (!empty($item->id))
			{
				$item->tags = new JHelperTags;
				$item->tags->getTagIds($item->id, 'com_azurapagebuilder.page');
				$item->metadata['tags'] = $item->tags;
			}

		}

		// Load associated content items
		$app = JFactory::getApplication();
		$assoc = JLanguageAssociations::isEnabled();

		if ($assoc)
		{
			$item->associations = array();

			if ($item->id != null)
			{
				$associations = JLanguageAssociations::getAssociations('com_azurapagebuilder', '#__azurapagebuilder_pages', 'com_azurapagebuilder.item', $item->id);

				foreach ($associations as $tag => $association)
				{
					$item->associations[$tag] = $association->id;
				}
			}
		}


		$this->item = $item;

		return $item;
	}

	// get first level item
	/*
	public function getElements(){

		$db = $this->getDbo();

		$pageId = $this->getState($this->getName() . '.id');

		$query = $db->getQuery(true);

		$query->select('e.*')//select('e.id,e.pageID,e.name,e.type,e.shortcode,e.content,e.attrs')
				->from($db->quoteName('#__azurapagebuilder_elements') . ' as e')
				->where('e.level = 0 AND e.pageID = '.(int) $pageId)
				->order('e.elementOrder asc');

		$db->setQuery($query);

		$elements = $db->loadObjectList();

		return $elements;
	}

	public function getChildElements($id,$page = ''){

		$db = $this->getDbo();

		$pageId = $this->getState($this->getName() . '.id');

		$query = $db->getQuery(true);

		$query->select('e.*')//select('e.id,e.pageID,e.name,e.type,e.shortcode,e.content,e.attrs')
				->from($db->quoteName('#__azurapagebuilder_elements') . ' as e')
				->where('e.hasParentID = '.(int)$id);
				if(!empty($page)){
					$query->where('e.pageID = '.(int) $page);
				}else{
					$query->where('e.pageID = '.(int) $pageId);
				}
				$query->order('e.elementOrder asc');

		$db->setQuery($query);

		$elements = $db->loadObjectList();

		return $elements;
	}

	protected function getElement($id = 0){
		if((int)$id > 0){
			$table = $this->getTableElement();

			// Attempt to load the row.
			$return = $table->load((int)$id);

			// Check for a table object error.
			if ($return === false && $table->getError())
			{
				$this->setError($table->getError());
				return false;
			}


			// Convert to the JObject before adding other data.
			$properties = $table->getProperties(1);
			$item = JArrayHelper::toObject($properties, 'JObject');

			return $item;
		}

		return false;
	}*/

	/**
	 * Prepare and sanitise the table data prior to saving.
	 *
	 * @param   JTable  $table  A reference to a JTable object.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function prepareTable($table)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		$table->title = htmlspecialchars_decode($table->title, ENT_QUOTES);
		$table->alias = JApplication::stringURLSafe($table->alias);

		if (empty($table->alias))
		{
			$table->alias = JApplication::stringURLSafe($table->title);
		}

		if (empty($table->id))
		{
			// Set the values

			// Set ordering to the last item if not set
			if (empty($table->ordering))
			{
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__azurapagebuilder_pages');
				$max = $db->loadResult();

				$table->ordering = $max + 1;
			}
			else
			{
				// Set the values
				$table->modified    = $date->toSql();
				$table->modified_by = $user->get('id');
			}
		}

		// Increment the product version number.
		$table->version++;
	}

	/*

	protected function prepareTableElement($table,$front = false)
	{
		$date = JFactory::getDate();
		$user = JFactory::getUser();

		$table->name = htmlspecialchars_decode($table->name, ENT_QUOTES);

		if (empty($table->id))
		{
			if($front === false){
				$pageId = $this->getState($this->getName() . '.id');

				$table->pageID = (int) $pageId;
			}
			// Set ordering to the last item if not set
			if (empty($table->ordering))
			{
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__azurapagebuilder_elements');
				$max = $db->loadResult();

				$table->ordering = $max + 1;
			}
			else
			{
				// Set the values
				$table->modified    = $date->toSql();
				$table->modified_by = $user->get('id');
			}
		}

		$table->object = '  ';

		if($front === false){
			self::$elementOrder++;

			$table->elementOrder = self::$elementOrder;
		}elseif($front === true){
			$db = JFactory::getDbo();
			$db->setQuery('SELECT MAX(elementOrder) FROM #__azurapagebuilder_elements WHERE pageID='.$table->pageID);
			$max = $db->loadResult();

			$table->elementOrder = $max + 1;

			// hasChildID
			if($table->hasChild == '1'){
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(hasChildID) FROM #__azurapagebuilder_elements WHERE pageID='.$table->pageID);
				$max = $db->loadResult();

				$table->hasChildID = $max + 1;
			}
		}
	}
	*/

	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param   JTable  $table  A JTable object.
	 *
	 * @return  array  An array of conditions to add to ordering queries.
	 *
	 * @since   1.6
	 */
	protected function getReorderConditions($table)
	{
		$condition = array();
		//$condition[] = 'catid = ' . (int) $table->catid;

		return $condition;
	}

	/* delete elements before save */

	/*protected function deleteElement($id){
		$db = $this->getDbo();
 
		$query = $db->getQuery(true);
		 
		// delete all custom keys for user 1001.
		$conditions = array(
		   $db->quoteName('pageID') . ' = ' . (int) $this->getState($this->getName() . '.id'),
		   $db->quoteName('id') . ' = ' . (int) $id
		);
		 
		$query->delete($db->quoteName('#__azurapagebuilder_elements'));
		$query->where($conditions);
		
		 
		$db->setQuery($query);
		 
		 
		$db->execute();
	}*/

	/* get elementsID */
	/*protected function getElementsID(){
		$db = $this->getDbo();

		$pageId = $this->getState($this->getName() . '.id');

		$query = $db->getQuery(true);

		$query->select('id')
				->from($db->quoteName('#__azurapagebuilder_elements'))
				->where('pageID = '.(int) $pageId);

		$db->setQuery($query);

		$elements = $db->loadRowList();

		return $elements;
	}*/
	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since	3.1
	 */

	public function save($data)
	{
		$app = JFactory::getApplication();

		// Alter the title for save as copy
		if ($app->input->get('task') == 'save2copy')
		{
			list($name, $alias) = $this->generateNewTitle('', $data['alias'], $data['title']);
			$data['title']	= $name;
			$data['alias']	= $alias;
			$data['state']	= 0;
		}
		
		if (parent::save($data))
		{

			
			$assoc = JLanguageAssociations::isEnabled();
			if ($assoc)
			{
				$id = (int) $this->getState($this->getName() . '.id');
				$item = $this->getItem($id);

				// Adding self to the association
				$associations = $data['associations'];

				foreach ($associations as $tag => $id)
				{
					if (empty($id))
					{
						unset($associations[$tag]);
					}
				}

				// Detecting all item menus
				$all_language = $item->language == '*';

				if ($all_language && !empty($associations))
				{
					JError::raiseNotice(403, JText::_('COM_AZP_ERROR_ALL_LANGUAGE_ASSOCIATED'));
				}

				$associations[$item->language] = $item->id;

				// Deleting old association for these items
				$db = JFactory::getDbo();
				$query = $db->getQuery(true)
					->delete('#__associations')
					->where('context=' . $db->quote('com_azurapagebuilder.item'))
					->where('id IN (' . implode(',', $associations) . ')');
				$db->setQuery($query);
				$db->execute();

				if ($error = $db->getErrorMsg())
				{
					$this->setError($error);
					return false;
				}

				if (!$all_language && count($associations))
				{
					// Adding new association for these items
					$key = md5(json_encode($associations));
					$query->clear()
						->insert('#__associations');

					foreach ($associations as $id)
					{
						$query->values($id . ',' . $db->quote('com_azurapagebuilder.item') . ',' . $db->quote($key));
					}

					$db->setQuery($query);
					$db->execute();

					if ($error = $db->getErrorMsg())
					{
						$this->setError($error);
						return false;
					}
				}
			}

			return true;
		}

		return false;

	}

	/*
	public function save($data)
	{

		$app = JFactory::getApplication();

		//$dataShortcode = $data['shortcode'];


		//$dataElementsArray = json_decode(rawurldecode($data['elementsArray']));


		//$dataElementsSettingArray = json_decode(rawurldecode($data['elementsSettingArray']));

		//$dataElementsShortcodeArray = json_decode(rawurldecode($data['elementsShortcodeArray']));

		$controllerTask = $app->input->get('task');
		// Alter the title for save as copy
		if ($controllerTask == 'save2copy')
		{
			list($name, $alias) = $this->generateNewTitle('', $data['alias'], $data['title']);
			$data['title']	= $name;
			$data['alias']	= $alias;
			$data['state']	= 0;
		}

		$data['shortcode'] = '';
		$data['elementsArray'] = '';

		if(parent::save($data)){

			$elements = array();
			$elementsID = array();

			foreach ($dataElementsSettingArray as $key => $element) {

				$attrs = json_decode($element)->attrs;

				$element = get_object_vars(json_decode($element));
				
				$element['attrs'] = json_encode($attrs);

				//$element['shortcode'] = rawurldecode($dataElementsShortcodeArray[$key]);
				$element['shortcode'] = '';

				if ($controllerTask == 'save2copy'){
					$element['id'] = 0;
				}else{
					$elementsID[] = $element['id'];
				}

				$elements[] = $element;
				

			}

			if(count($elementsID)){
				$elementsDatabase = $this->getElementsID();

				foreach ($elementsDatabase as $elIDArr) {
					if(!in_array($elIDArr[0], $elementsID)){
						$this->deleteElement($elIDArr[0]);
					}
				}
			}

			foreach ($elements as $el) {
				$this->savePageElement($el);
			}

			return true;
		}

		return false;

		//return parent::save($data);
	}
	*/
	/*

	public function savePageElement($elementObject,$front = false){

		$table = $this->getTableElement();

		$isNew = true;

		// Allow an exception to be thrown.
		try
		{
			// Load the row if saving an existing record.
			if ((int)$elementObject['id'] > 0)
			{
				
				$table->load((int)$elementObject['id']);
				$isNew = false;
			}
			
			// Bind the data.
			if (!$table->bind($elementObject))
			{

				$this->setError($table->getError());

				return false;
			}

			// Prepare the row for saving
			$this->prepareTableElement($table,$front);

			// Check the data.
			if (!$table->check())
			{
				$this->setError($table->getError());
				return false;
			}
			// Store the data.
			if (!$table->store())
			{
				$this->setError($table->getError());
				return false;
			}
			// Clean the cache.
			//$this->cleanCache();
			
		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		if($front === true){
			$db = $table->getDBO();
			$newID = $db->insertId();
			return $newID;
		}

		return true;
	}*/

	public function getPageTemplates(){

		$templates = array();
		$templatesInfo = array();

		$pageTemplateFolder = JPath::clean(JPATH_COMPONENT_ADMINISTRATOR.'/pagetemplates/');

		$templatefiles = glob( $pageTemplateFolder.'/*.php' );

        foreach((array) $templatefiles as $value)  $templates[] =  basename($value);

        $templates = array_unique($templates);

        foreach ($templates as $key => $temp) {
        	$tempContent = JFile::read($pageTemplateFolder.'/'.$temp);
        	if($tempContent !== false){
        		$tempContent = json_decode(rawurldecode($tempContent));

        		$infos = new stdClass;
        		$infos->templatename = $tempContent->templatename;
        		$infos->savename = $tempContent->savename;

        		$templatesInfo[] = $infos;
        		
        	}
        }

        return $templatesInfo;
	}

	public function getSecTemplates(){

		$templates = array();
		$templatesInfo = array();

		$pageTemplateFolder = JPath::clean(JPATH_COMPONENT_ADMINISTRATOR.'/sectemplates/');

		$templatefiles = glob( $pageTemplateFolder.'/*.php' );

        foreach((array) $templatefiles as $value)  $templates[] =  basename($value);

        $templates = array_unique($templates);

        foreach ($templates as $key => $temp) {
        	$tempContent = JFile::read($pageTemplateFolder.'/'.$temp);
        	if($tempContent !== false){
        		$tempContent = json_decode(rawurldecode($tempContent));

        		$infos = new stdClass;
        		$infos->templatename = $tempContent->templatename;
        		$infos->savename = $tempContent->savename;

        		$templatesInfo[] = $infos;
        		
        	}
        }

        return $templatesInfo;
	}

	/**
	 * Method to change the title & alias.
	 *
	 * @param   integer  $category_id  The id of the parent.
	 * @param   string   $alias        The alias.
	 * @param   string   $name         The title.
	 *
	 * @return  array  Contains the modified title and alias.
	 *
	 * @since   3.1
	 */
	protected function generateNewTitle($category_id, $alias, $name)
	{
		// Alter the title & alias
		$table = $this->getTable();

		while ($table->load(array('alias' => $alias)))
		{
			if ($name == $table->title)
			{
				$name = JString::increment($name);
			}

			$alias = JString::increment($alias, 'dash');
		}

		return array($name, $alias);
	}
}
