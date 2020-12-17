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

$classes = 'azura_video azp_font_edit';
if($fitvids === '1'){
	AzuraJs::addJScript('fitvids','/components/com_azurapagebuilder/assets/plugins/FitVids/jquery.fitvids.js');
}

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if(!empty($class)){
	$classes = ' '.$class;
}

if($fitvids === '1'){
	$classes .= ' azura_video_fitvids';
}

$classes = 'class="'.$classes.'"';
 
if(!empty($id)){
	$id = 'id="'.$id.'"';
}
?>
<?php
if($fitvids === '1') :?>
<div <?php echo $id.' '.$classes.' '.$videostyle.' '.$animationData;?> >
	<iframe  src="<?php echo $src;?>?autoplay=<?php echo $autoplay;?>&amp;loop=<?php echo $loop;?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</div>
<?php else: ?>
	<iframe  src="<?php echo $src;?>?autoplay=<?php echo $autoplay;?>&amp;loop=<?php echo $loop;?>" width="<?php echo $width;?>" height="<?php echo $height;?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<?php endif;?>