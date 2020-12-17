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

/**
 * @package     CTHthemes.AzuraPagebuilder
 * @subpackage  com_azurapagebuilder
 */
abstract class JHtmlAzuraPagebuilder
{
	/**
	 * Get the associated language flags
	 *
	 * @param   int  $pageid  The item id to search associations
	 *
	 * @return  string  The language HTML
	 */
	public static function association($pageid)
	{
		// Defaults
		$html = '';

		// Get the associations
		if ($associations = JLanguageAssociations::getAssociations('com_azurapagebuilder', '#__azurapagebuilder_pages', 'com_azurapagebuilder.item', $pageid))
		{
			foreach ($associations as $tag => $associated)
			{
				$associations[$tag] = (int) $associated->id;
			}

			// Get the associated page items
			$db = JFactory::getDbo();
			$query = $db->getQuery(true)
				->select('p.id, p.title as title')
				->select('l.sef as lang_sef')
				->from('#__azurapagebuilder_pages as p')
				->select('cat.title as category_title')
				->join('LEFT', '#__categories as cat ON cat.id=p.catid')
				->where('p.id IN (' . implode(',', array_values($associations)) . ')')
				->join('LEFT', '#__languages as l ON p.language=l.lang_code')
				->select('l.image')
				->select('l.title as language_title');
			$db->setQuery($query);

			try
			{
				$items = $db->loadObjectList('id');
			}
			catch (runtimeException $e)
			{
				throw new Exception($e->getMessage(), 500);

				return false;
			}

			if ($items)
			{
				foreach ($items as &$item)
				{
					$text = strtoupper($item->lang_sef);
					$url = JRoute::_('index.php?option=com_azurapagebuilder&task=page.edit&id=' . (int) $item->id);
					$tooltipParts = array(
						JHtml::_('image', 'mod_languages/' . $item->image . '.gif',
								$item->language_title,
								array('title' => $item->language_title),
								true
						),
						$item->title,
						'(' . $item->category_title . ')'
					);

					$item->link = JHtml::_('tooltip', implode(' ', $tooltipParts), null, null, $text, $url, null, 'hasTooltip label label-association label-' . $item->lang_sef);
				}
			}

			$html = JLayoutHelper::render('joomla.content.associations', $items);
		}
		//echo'<pre>';var_dump($html);die;

		return $html;
	}

	/**
	 * @param   int $value	The featured value
	 * @param   int $i
	 * @param   bool $canChange Whether the value can be changed or not
	 *
	 * @return  string	The anchor tag to toggle featured/unfeatured contacts.
	 * @since   1.6
	 */
	// public static function featured($value = 0, $i, $canChange = true)
	// {
	// 	// Array of image, task, title, action
	// 	$states	= array(
	// 		0	=> array('disabled.png', 'contacts.featured', 'COM_CONTACT_UNFEATURED', 'COM_CONTACT_TOGGLE_TO_FEATURE'),
	// 		1	=> array('featured.png', 'contacts.unfeatured', 'JFEATURED', 'COM_CONTACT_TOGGLE_TO_UNFEATURE'),
	// 	);
	// 	$state	= JArrayHelper::getValue($states, (int) $value, $states[1]);
	// 	$html	= JHtml::_('image', 'admin/'.$state[0], JText::_($state[2]), null, true);
	// 	if ($canChange)
	// 	{
	// 		$html	= '<a href="#" onclick="return listItemTask(\'cb'.$i.'\',\''.$state[1].'\')" title="'.JText::_($state[3]).'">'
	// 				. $html .'</a>';
	// 	}

	// 	return $html;
	// }
}
