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



global $galleryItemsArray;

ElementParser::do_shortcode($content);

$classes = 'azura_gallery azura_gallery_grid';

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
	
}

if(!empty($class)){
	$classes .= ' '.$class;
}

$classes = 'class="'.$classes.'"';

?>

<?php if(count($galleryItemsArray)) :?>

<div <?php echo $classes;?> <?php echo $gallerystyle.' '.$animationData;?>>

	<div <?php if(!empty($id)) echo 'id="'.$id.'"';?> class="image_grid_wrap">
		<div  class="grid-sizer <?php echo 'w'.$gridwidth;?>"></div>
		<?php
		
		foreach ($galleryItemsArray as $key => $item) : ?>
		<?php
		if($item['usepretty'] === '1'){
			AzuraJs::addStyle('prettyphoto','/components/com_azurapagebuilder/assets/plugins/prettyPhoto/css/prettyPhoto.css');
			AzuraJs::addJScript('prettyphoto','/components/com_azurapagebuilder/assets/plugins/prettyPhoto/js/jquery.prettyPhoto.js');
		}
		?>
		<div class="isotope-item <?php echo 'w'.$gridwidth.' '.$item['extraclass'];?>" >
		<?php if($item['usepretty'] === '1') :?>
			<?php if(!empty($item['largeimage'])) :?>
			<a href="<?php echo JURI::root(true).'/'.$item['largeimage'];?>" rel="prettyPhoto<?php if(!empty($gallery)) echo '['.$gallery.']';?>">
			<?php else:?>
			<a href="<?php echo JURI::root(true).'/'.$item['slideimage'];?>" rel="prettyPhoto<?php if(!empty($gallery)) echo '['.$gallery.']';?>">
			<?php endif;?>
		<?php else :?>
			<?php if(!empty($item['imagelink'])) :?>
				<a href="<?php echo $item['imagelink'];?>">
			<?php endif;?>
		<?php endif;?>
				<img src="<?php echo JURI::root(true).'/'.$item['slideimage'];?>" alt=""/>
		<?php if($item['usepretty'] === '1' ||!empty($item['imagelink'])) :?>
			</a>
		<?php endif;?>
		</div>
		<?php endforeach;?>
	</div>

</div>

<?php endif;?>

