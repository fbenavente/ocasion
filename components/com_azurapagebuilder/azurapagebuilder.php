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
define('AZURA_VERSION','2.1.0');
require_once JPATH_COMPONENT.'/helpers/route.php';
require_once JPATH_COMPONENT.'/helpers/query.php';
require_once JPATH_COMPONENT .'/helpers/elementparser.php';
require_once JPATH_COMPONENT .'/helpers/azurajs.php';

$controller	= JControllerLegacy::getInstance('AzuraPagebuilder');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();