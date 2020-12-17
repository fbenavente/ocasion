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

$classes = "azp_container-ele";

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

$html = '<'.$wraptag.' '.$id.' '.$classes.' '.$containerstyle.' '.$animationData.'>';
if(!empty($title)){
	$html .='<div class="title">';
		$html .='<h2>'.$title.'</h2>';
	$html .='</div>';
}
	$html .= ElementParser::do_shortcode($content);
$html .= '</'.$wraptag.'>';

echo $html;

?>