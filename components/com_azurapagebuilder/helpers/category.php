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

/**
 * Contact Component Category Tree
 *
 * @package     Joomla.Site
 * @subpackage  com_contact
 * @since       1.6
 */
class AzuraPagebuilderCategories extends JCategories
{
	public function __construct($options = array())
	{
		$options['table'] = '#__azurapagebuilder_pages';
		$options['extension'] = 'com_azurapagebuilder';
		//$options['statefield'] = 'published';
		parent::__construct($options);
	}
}
