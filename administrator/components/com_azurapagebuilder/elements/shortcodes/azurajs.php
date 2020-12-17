<?php
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
//no direct accees
defined ('_JEXEC') or die('resticted aceess');

//[Raw JS]
if(!function_exists('azurajs_sc')) {

	function azurajs_sc( $atts, $content="" ) {
	 
        return $content;
	}
		
	ElementParser::add_shortcode( 'AzuraJS', 'azurajs_sc' );
}