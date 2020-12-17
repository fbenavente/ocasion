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

$classes = "azura_heading azura_align_".$textalign." azp_font_edit";

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}


$classes = 'class="'.$classes.'"';

$hstyle = '';

if(!empty($fontsize)){
	$hstyle .= 'font-size:'.str_replace(";", "", $fontsize).';';
}
if(!empty($lineheight)){
	$hstyle .= 'line-height:'.str_replace(";", "", $lineheight).';';
}
if(!empty($font_color)){
	$hstyle .= 'color:'.str_replace(";", "", $font_color).';';
}
if(!empty($hstyle)){
	$hstyle = 'style="'.$hstyle.'"';
}
?>
<div <?php echo $classes.' '.$headerstyle.' '.$animationData;?>>
	<<?php echo $elementtag;?> <?php echo $hstyle;?>><?php echo $content;?></<?php echo $elementtag;?>>
</div>