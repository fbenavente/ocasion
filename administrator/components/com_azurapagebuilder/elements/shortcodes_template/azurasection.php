<?php
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die();

$classes = "azp_sections azp_font_edit";

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if(!empty($class)){
	$classes .= ' '.$class;
}

$classes = 'class="'.$classes.'"';
 
if(!empty($id)){
	$id = 'id="'.$id.'"';
}

if(!empty($subwrapperclass)){
	$subwrapperclass = 'class="'.$subwrapperclass.'"';
}

$html = '<'.$wrappertag.' '.$id.' '.$classes.' '. $sectionstyle.' '.$animationData.'>';
	if($usesubwrapper == '1'){
		$html .='<div '.$subwrapperclass.'>';
	}
		$html .= do_shortcode($content);
	if($usesubwrapper == '1'){
		$html .='</div>';
	}
$html .= '</'.$wrappertag.'>';

echo $html;

?>