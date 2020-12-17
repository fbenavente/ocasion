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

define ('AZURA_VERSION','2.3.0');

if(!JFactory::getUser()->authorise('core.manage', 'com_azurapagebuilder')){
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Require helper file
JLoader::register('AzuraPagebuilderHelper', JPATH_COMPONENT . '/helpers/azurapagebuilder.php');

$controller = JControllerLegacy::getInstance('AzuraPagebuilder');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
