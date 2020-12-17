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

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/pages.php';
require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/azuraelements.php';

class AzuraPagebuilderViewPage extends JViewLegacy
{
	protected $state;

	protected $item;

	protected $form;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state	= $this->get('State');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');
		//die('this here');
		$this->canDo		= PagesHelper::getActions('com_azurapagebuilder', 'page', $this->item->id);
		
		$this->elements = $this->get('Elements');

		$this->elementsForm = JForm::getInstance('com_azurapagebuilder.elements', 'elements');

		$this->pageTemplates = $this->get('PageTemplates');
		$this->secTemplates = $this->get('SecTemplates');

        

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$comParams = JComponentHelper::getParams('com_azurapagebuilder');
		$elements_expand = $comParams->get('elements_expand');
		$this->elements_expand = 'ishide';
		if($elements_expand == '1'){
			$this->elements_expand = '';
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	* 
	*/
	public function loadDefaultSection(){

		require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/defaultsection.php');
	}

	/**
	* getChildElements($id)
	*/
	public function getChildElements($parentID){
		$model = $this->getModel();

		return $model->getChildElements($parentID);
	}

	/**
	* $row object
	*/

	public function parseElement($element){

		$azuraelements = AzuraElements::getElements(true);

		//echo'<pre>';var_dump($azuraelements);die;

		// switch ($element->type) {
		// 	case 'AzuraRow':
		// 		$element->elementTypeName = '<i class="fa fa-bars"></i>  Row';
		// 		break;
		// 	case 'AzuraColumn':
		// 		$element->elementTypeName = '<i class="fa fa-columns"></i>  Column';
		// 		break;
		// 	case 'AzuraText':
		// 		$element->elementTypeName = 'Text';
		// 		break;
		// 	case 'AzuraTabs':
		// 		$element->elementTypeName = 'Tabs';
		// 		break;
		// 	case 'AzuraAccordion':
		// 		$element->elementTypeName = 'Accordion';
		// 		break;
		// 	case 'AzuraAccordionItem':
		// 		$element->elementTypeName = 'Accordion Item';
		// 		break;
		// 	case 'AzuraBsCarousel':
		// 		$element->elementTypeName = 'Bootstrap Carousel';
		// 		break;
		// 	case 'AzuraBsCarouselItem':
		// 		$element->elementTypeName = 'Bootstrap Carousel Item';
		// 		break;
		// 	default :
		// 		$element->elementTypeName = 'Element';
		// 		break;
		// }

		if($element->type === 'AzuraRow'){
			require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/row.php'); 
		}elseif(isset($element->ispagesection)&&$element->ispagesection === true){
			//echo'<pre>';var_dump($element);die;
			require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/pagesection.php'); 
		}elseif(isset($element->ispagesectionitem)&&$element->ispagesectionitem === true){
			//echo'<pre>';var_dump($element);die;
			require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/pagesectionitem.php'); 
		}elseif($element->type === 'AzuraColumn'){
			require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/column.php'); 
		}elseif($element->type === 'AzuraContainer'){
			require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/container.php'); 
		}else{
			$elementNames = array_keys($azuraelements);

			if(in_array($element->type, $elementNames)){
				//die('has a element in this array');
				if ($azuraelements[$element->type]->hasownchild === 'no') {
					if($azuraelements[$element->type]->isownchild === 'yes'){
						require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/default-ischild.php'); 
					}else{
						require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/default.php'); 
					}
				}else{
					require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/default-haschild.php'); 
				}
			}
		}

		/*
		switch ($element->type) {
			case 'AzuraRow':
				require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/row.php'); 
				break;
			case 'AzuraColumn':
				require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/column.php'); 
				break;
			case 'AzuraAccordion':
				require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/accordion.php'); 
				break;
			case 'AzuraAccordionItem':
				require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/accordionitem.php'); 
				break;
			case 'AzuraTabs':
				require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/tabs.php'); 
				break;
			case 'AzuraTabsItem':
				require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/tabsitem.php'); 
				break;
			case 'AzuraBsCarousel':
				require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/bscarousel.php'); 
				break;
			case 'AzuraBsCarouselItem':
				require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/bscarouselitem.php'); 
				break;
			default :
				require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/default.php'); 
				break;
		}
		*/
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));

		// Since we don't track these assets at the item level, use the category id.
		$canDo		= $this->canDo;

		JToolbarHelper::title(JText::_('Pages Manager: Build Page'), '');

		// If not checked out, can save the item.
		if (!$checkedOut && ($canDo->get('core.edit')||($user->authorise('core.create', 'com_azurapagebuilder'))))
		{
			JToolbarHelper::apply('page.apply');
			JToolbarHelper::save('page.save');
		}
		if (!$checkedOut && ($user->authorise('core.create', 'com_azurapagebuilder')))
		{
			JToolbarHelper::save2new('page.save2new');
		}
		// If an existing item, can save to a copy.
		if (!$isNew && ($user->authorise('core.create', 'com_azurapagebuilder')))
		{
			JToolbarHelper::save2copy('page.save2copy');
		}
		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('page.cancel');
		}
		else
		{
			if ($this->state->params->get('save_history', 0) && $user->authorise('core.edit'))
			{
				JToolbarHelper::versions('com_azurapagebuilder.page', $this->item->id);
			}

			JToolbarHelper::cancel('page.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
