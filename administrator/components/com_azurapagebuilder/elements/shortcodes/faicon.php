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

//[Awesome Icon]
if(!function_exists('faicon_sc')) {
	function faicon_sc( $atts, $content="" ){
	
		extract(cth_shortcode_atts(array(
				'name'=>'magic',
				'extraclass'=>'',
		), $atts));

		$html = '';
		$class = 'fa fa-'.$name;
		if(!empty($extraclass)){
			$class .=' '.$extraclass;
		}

		$html = '<i class="'.$class.'"></i>';
		return $html;
	}
	
	ElementParser::add_shortcode( 'FaIcon', 'faicon_sc' );
}