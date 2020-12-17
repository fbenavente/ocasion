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


class AzuraPagebuilderController extends JControllerLegacy {

	protected $default_view = 'pages';

	public function __construct($config = array())
	{

		JForm::addFieldPath(JPATH_ROOT.'/administrator/components/com_azurapagebuilder/models/fields');
		//JForm::addFormPath(JPATH_ROOT.'/templates/protostar/html/com_azurapagebuilder/forms');
		JForm::addFormPath(JPATH_ROOT.'/administrator/components/com_azurapagebuilder/models/forms');
		JForm::addFormPath(JPATH_THEMES.'/'.JFactory::getApplication()->getTemplate().'/html/com_azurapagebuilder/forms');

		require_once JPATH_ROOT.'/administrator/components/com_azurapagebuilder/helpers/azuraelements.php';
		AzuraElements::loadElements(false);
		AzuraElements::loadElements(true);

		parent::__construct();
	}


	public function display($cachable = false, $urlparms= false){

		require_once JPATH_COMPONENT.'/helpers/pages.php';

		
		$view   = $this->input->get('view', 'pages');

		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');



		// Check for edit form.
		if ($view == 'page' && $layout == 'edit' && !$this->checkEditId('com_azurapagebuilder.edit.page', $id))
		{
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_azurapagebuilder&view=pages', false));

			return false;
		}

		parent::display();

		return $this;
	}
}