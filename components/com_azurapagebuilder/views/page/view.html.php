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

class AzuraPagebuilderViewPage extends JViewLegacy
{
	protected $item;

	protected $params;

	protected $print;

	protected $state;

	protected $user;
	
	public function display($tpl = null)
	{
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		$dispatcher = JEventDispatcher::getInstance();

		//$this->item		= $this->get('Item');

		

		$this->item		= $this->get('Item');
		$this->print	= $app->input->getBool('print');
		$this->state	= $this->get('State');
		$this->user		= $user;
		
		//$alt_layout = $this->get('Alt_layout');
		//echo'<pre>';var_dump($alt_layout);die;
		// if(!empty($alt_layout)){
		// 	$this->setLayout($alt_layout);
		// }

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		// Create a shortcut for $item.
		$item = $this->item;
		if($item->alt_layout !== '_:default'){//die;
			$this->setLayout($item->alt_layout);
		}

		$item->tagLayout = new JLayoutFile('joomla.content.tags');

		// Add router helpers.
		$item->slug			= $item->alias ? ($item->id.':'.$item->alias) : $item->id;
		$item->catslug		= $item->category_alias ? ($item->catid.':'.$item->category_alias) : $item->catid;
		$item->parent_slug	= $item->parent_alias ? ($item->parent_id . ':' . $item->parent_alias) : $item->parent_id;

		// No link for ROOT category
		if ($item->parent_alias == 'root')
		{
			$item->parent_slug = null;
		}

		// TODO: Change based on shownoauth
		$item->readmore_link = JRoute::_(AzuraPagebuilderHelperRoute::getPageRoute($item->slug, $item->catslug));

		// Merge page params. If this is single-page view, menu params override page params
		// Otherwise, page params override menu item params
		$this->params = $this->state->get('params');
		$active = $app->getMenu()->getActive();
		$temp = clone ($this->params);

		// Check to see which parameters should take priority
		if ($active)
		{
			$currentLink = $active->link;

			// If the current view is the active item and an page view for this page, then the menu item params take priority
			if (strpos($currentLink, 'view=page') && (strpos($currentLink, '&id='.(string) $item->id)))
			{
				
				// $item->params are the page params, $temp are the menu item params
				// Merge so that the menu item params take priority
				$item->params->merge($temp);
			}
			else
			{
				// Current view is not a single page, so the page params take priority here
				// Merge the menu item params with the page params so that the page params take priority
				$temp->merge($item->params);
				$item->params = $temp;

			}
		}
		else
		{
			// Merge so that page params take priority
			$temp->merge($item->params);
			$item->params = $temp;
		}

		//echo'<pre>';var_dump($this->item->params);die;

		$offset = $this->state->get('list.offset');

		// Check the view access to the page (the model has already computed the values).
		if ($item->params->get('access-view') == false && ($item->params->get('show_noauth', '0') == '0'))
		{
			JError::raiseWarning(403, JText::_('COM_AZP_ALERTNOAUTHOR'));
			return;
		}

		$item->tags = new JHelperTags;
		$item->tags->getItemTags('com_azurapagebuilder.page', $this->item->id);

		// new in version 2.2
		$item->page_likes	= $this->get('PageLikes');

		// Increment the hit counter of the page.
		if (!$this->params->get('intro_only') && $offset == 0)
		{
			$model = $this->getModel();
			$model->hit();
		}

		$this->pageclass_sfx = htmlspecialchars($this->item->params->get('pageclass_sfx'));

		$this->_prepareDocument();

		parent::display($tpl);





		// if($this->item !== false){
			
		// 	$this->state	= $this->get('State');
		// 	//$this->user		= $user;
		// 	//$this->elements = $this->get('Elements');

		// 	// Check for errors.
		// 	if (count($errors = $this->get('Errors')))
		// 	{
		// 		JError::raiseWarning(500, implode("\n", $errors));
		// 		return false;
		// 	}
		// 	$this->authorised = $user->authorise('core.edit', 'com_azurapagebuilder.page.'.$this->item->id);
		// 	//echo'<pre>';var_dump($this->item->id);var_dump($user);die;
		// 	$item = $this->item;

		// 	$this->params = $this->state->get('params');

		// 	$temp = clone ($this->params);

		// 	// Current view is not a single product, so the product params take priority here
		// 	// Merge the menu item params with the product params so that the product params take priority

		// 	$temp->merge($item->params);

		// 	$item->params = $temp;

		// 	// Prepare for onContentPrepare event
		// 	//$item->text = rawurldecode($item->pagecontent);

		// 	//JPluginHelper::importPlugin('content');
		// 	//$dispatcher->trigger('onContentPrepare', array ('com_azurapagebuilder.page', &$item, &$this->params, 1));

		// 	//$item->event = new stdClass;
		// 	//$results = $dispatcher->trigger('onContentAfterTitle', array('com_azurapagebuilder.page', &$item, &$this->params, 1));
		// 	//$item->event->afterDisplayTitle = trim(implode("\n", $results));

		// 	//$results = $dispatcher->trigger('onContentBeforeDisplay', array('com_azurapagebuilder.page', &$item, &$this->params, 1));
		// 	//echo'<pre>';var_dump($results);die;
		// 	//$item->event->beforeDisplayContent = trim(implode("\n", $results));

		// 	// $results = $dispatcher->trigger('onContentAfterDisplay', array('com_azurapagebuilder.page', &$item, &$this->params, 1));
		// 	// $item->event->afterDisplayContent = trim(implode("\n", $results));

		// 	//$item->pagecontent = rawurlencode($item->text);
		// 	//echo'<pre>';var_dump($item->text);die;
		// 	//Escape strings for HTML output
			
		// 	$model = $this->getModel();
		// 	$model->hit();

		// 	$this->pageclass_sfx = htmlspecialchars($this->item->params->get('pageclass_sfx'));

		// 	$this->_prepareDocument();

		// 	parent::display($tpl);
		
		// }

		
	}

	/**
	* getChildElements($id)
	*/
	// public function getChildElements($parentID){
	// 	$model = $this->getModel();

	// 	return $model->getChildElements($parentID);
	// }

	/*parseElement */
	public function parseElement($element){
		//echo'<pre>';var_dump($element);die;
		if($element->published == '0') return false;
		
		if(isset($element->children) && count($element->children)){
			foreach ($element->children as $child) {
				$element->content .= ElementParser::do_shortcode($this->parseElement($child) );
			}
		}
		$attrsText = '';

		foreach ($element->attrs as $key => $value) {
			$attrsText .=(' '.$key.'="'.$value.'"');
		}



		return '['.$element->type.$attrsText.']'.$element->content.'[/'.$element->type.']';
	}

	/* parseElement() */
	/*
	public function parseElement($element){
		if($element->hasChild == '1' || isset($element->hasChildID)){
			$element->elementChilds = $this->getChildElements($element->hasChildID);
			foreach ($element->elementChilds as $key => $child) {
				//$this->parseElement($child);

				$element->content .= do_shortcode($this->parseElement($child));
			}
		}

		$attrs = json_decode($element->attrs);
		$attrsText = '';

		foreach ($attrs as $key => $value) {
			$attrsText .=(' '.$key.'="'.$value.'"');
		}



		return '['.$element->type.$attrsText.']'.$element->content.'[/'.$element->type.']';
	}
	*/
	protected function getProducts($catid){
		$model = $this->getModel();

		return $model->getProducts($catid);
	}

	protected function getComments(){
		$model = $this->getModel();

		return $model->getComments();
	}

	public function addCustomCss($links =''){
		$linkArray = array();
		if(!empty($links)){
			$linkArray = explode(",", $links);
		}else{
			return false;
		}
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();
		$themePath = JPATH_THEMES.'/'.$app->getTemplate();
		$themeLink = JURI::base(true).'/templates/'.$app->getTemplate();
		foreach ($linkArray as $ctlink) {
			if(file_exists($themePath.'/css/'.$ctlink)){
				$doc->addStyleSheet($themeLink.'/css/'.$ctlink);
			}elseif(file_exists($themePath.'/stylesheet/'.$ctlink)){
				$doc->addStyleSheet($themeLink.'/stylesheet/'.$ctlink);
			}
		}
	}

	public function addCustomJS($links =''){
		$linkArray = array();
		if(!empty($links)){
			$linkArray = explode(",", $links);
		}else{
			return false;
		}
		$app = JFactory::getApplication();
		$doc = JFactory::getDocument();
		$themePath = JPATH_THEMES.'/'.$app->getTemplate();
		$themeLink = JURI::base(true).'/templates/'.$app->getTemplate();
		foreach ($linkArray as $ctlink) {
			if(file_exists($themePath.'/js/'.$ctlink)){
				$doc->addScript($themeLink.'/js/'.$ctlink);
			}elseif(file_exists($themePath.'/javascript/'.$ctlink)){
				$doc->addScript($themeLink.'/javascript/'.$ctlink);
			}
		}
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway	= $app->getPathway();
		$title		= null;

		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();

		if ($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else
		{
			$this->params->def('page_heading', JText::_('COM_AZURAPAGEBUILDER'));
		}

		$title = $this->params->get('page_title', '');

		$id = (int) @$menu->query['id'];

		// if the menu item does not concern this page
		if ($menu && ($menu->query['option'] != 'com_azurapagebuilder' || $menu->query['view'] != 'page' || $id != $this->item->id))
		{
			// If this is not a single page menu item, set the page title to the page title
			if ($this->item->title)
			{
				$title = $this->item->title;
			}
			$path = array(array('title' => $this->item->title, 'link' => ''));
		
			$path = array_reverse($path);

			foreach ($path as $item)
			{
				$pathway->addItem($item['title'], $item['link']);
			}
		}

		// Check for empty title and add site name if param is set
		if (empty($title))
		{
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1)
		{
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2)
		{
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}

		if (empty($title))
		{
			$title = $this->item->title;
		}


		$this->document->setTitle($title);

		if ($this->item->metadesc)
		{
			$this->document->setDescription($this->item->metadesc);
		}
		elseif (!$this->item->metadesc && $this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->item->metakey)
		{
			$this->document->setMetadata('keywords', $this->item->metakey);
		}
		elseif (!$this->item->metakey && $this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}

		if ($app->getCfg('MetaAuthor') == '1')
		{
			$this->document->setMetaData('author', $this->item->author);
		}

		$mdata = $this->item->metadata->toArray();

		foreach ($mdata as $k => $v)
		{
			if ($v)
			{
				$this->document->setMetadata($k, $v);
			}
		}

	}
}
