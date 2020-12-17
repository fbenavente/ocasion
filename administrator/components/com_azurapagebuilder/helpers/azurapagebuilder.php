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

class AzuraPagebuilderHelper extends JHelperContent {

	public static function addSubmenu($submenu = 'pages') 
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_AZURAPAGEBUILDER_SUBMENU_PAGES'),
			'index.php?option=com_azurapagebuilder&view=pages',
			$submenu == 'pages'
		);
 
		JHtmlSidebar::addEntry(
			JText::_('COM_AZURAPAGEBUILDER_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&view=categories&extension=com_azurapagebuilder',
			$submenu == 'categories'
		);
	}

	

}