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
if($usepretty === '1'){
	AzuraJs::addStyle('prettyphoto','/components/com_azurapagebuilder/assets/plugins/prettyPhoto/css/prettyPhoto.css');
	AzuraJs::addJScript('prettyphoto','/components/com_azurapagebuilder/assets/plugins/prettyPhoto/js/jquery.prettyPhoto.js');
}

$classes = "azura_image azp_font_edit";

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';		
}

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}
$classes .= ' azura_align_'.$alignment;

$classes = 'class="'.$classes.'"';
 
if(!empty($id)){
	$id = 'id="'.$id.'"';
}
        
?>
<div <?php echo $id.' '.$classes.' '.$imagestyle.' '.$animationData;?>>
<?php if($usepretty === '1') :?>
	<?php if(!empty($largeimage)) :?>
	<a href="<?php echo JURI::root(true).'/'.$largeimage;?>" class="azura_prettyPhoto">
	<?php else:?>
	<a href="<?php echo JURI::root(true).'/'.$src;?>" class="azura_prettyPhoto">
	<?php endif;?>
<?php else :?>
	<?php if(!empty($imagelink)) :?>
		<a href="<?php echo $imagelink;?>" target="_blank">
	<?php endif;?>
<?php endif;?>
	<?php if($style === 'box_shadow_3d') :?>
	<span class="azura_box_shadow_3d_wrap">
	<?php endif;?>
		<img class="img_style_<?php echo $style;?> color_<?php echo $bordercolor;?>"  alt="single image" src="<?php echo JURI::root(true).'/'.$src;?>">
	<?php if($style === 'box_shadow_3d') :?>
	</span>
	<?php endif;?>
<?php if($usepretty === '1' || !empty($imagelink)) :?>
	</a>
<?php endif;?>
</div>

		