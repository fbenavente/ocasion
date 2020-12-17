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

JLoader::register('AzuraPagebuilderHelper', JPATH_ADMINISTRATOR . '/components/com_azurapagebuilder/helpers/azurapagebuilder.php');
JLoader::register('CategoryHelperAssociation', JPATH_ADMINISTRATOR . '/components/com_categories/helpers/association.php');

/**
 * AzuraPagebuilder Component Association Helper
 *
 * @package     Joomla.Site
 * @subpackage  com_azurapagebuilder
 * @since       3.0
 */
abstract class AzuraPagebuilderHelperAssociation extends CategoryHelperAssociation
{
	/**
	 * Method to get the associations for a given item
	 *
	 * @param   integer  $id    Id of the item
	 * @param   string   $view  Name of the view
	 *
	 * @return  array   Array of associations for the item
	 *
	 * @since  3.0
	 */

	public static function getAssociations($id = 0, $view = null)
	{
		jimport('helper.route', JPATH_COMPONENT_SITE);

		$app = JFactory::getApplication();
		$jinput = $app->input;
		$view = is_null($view) ? $jinput->get('view') : $view;
		$id = empty($id) ? $jinput->getInt('id') : $id;

		if ($view == 'page')
		{
			if ($id)
			{
				$associations = JLanguageAssociations::getAssociations('com_azurapagebuilder', '#__azurapagebuilder_pages', 'com_azurapagebuilder.item', $id);

				$return = array();

				foreach ($associations as $tag => $item)
				{
					$return[$tag] = AzuraPagebuilderHelperRoute::getPageRoute($item->id, $item->catid, $item->language);
				}

				return $return;
			}
		}

		if ($view == 'category' || $view == 'categories')
		{
			return self::getCategoryAssociations($id, 'com_azurapagebuilder');
		}

		return array();

	}
}
