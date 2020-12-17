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

global $nivosliderItemsArray;

ElementParser::do_shortcode($content);

$classes = 'azura_gallery azura_gallery_nivo';

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

<?php if(count($nivosliderItemsArray)) :?>

<?php 
	AzuraJs::addStyle('nivo','/components/com_azurapagebuilder/assets/plugins/nivo_slider/nivo-slider.css');
	AzuraJs::addStyle('nivo_theme_default','/components/com_azurapagebuilder/assets/plugins/nivo_slider/themes/default/default.css');
	AzuraJs::addJScript('nivo','/components/com_azurapagebuilder/assets/plugins/nivo_slider/jquery.nivo.slider.pack.js');
?>

<div <?php echo $classes;?> <?php echo $gallerystyle.' '.$animationData;?>>
	<div class="theme-default">
		<div class="ribbon"></div>
		<div <?php if(!empty($id)) echo 'id="'.$id.'"';?> class="nivoSlider">

			<?php
			$eleCaptions = array();
			foreach ($nivosliderItemsArray as $key => $item) : ?>
			<?php if(!empty($item['imagelink'])) :?>
				<a href="<?php echo $item['imagelink'];?>">
			<?php endif;?>
					<img src="<?php echo JURI::root(true).'/'.$item['slideimage'];?>" alt="" title="#nivoCaption<?php echo $key;?>"/>
			<?php if(!empty($item['imagelink'])) :?>
				</a>
			<?php endif;?>
			<?php $eleCaptions[] = '<div id="nivoCaption'.$key.'" class="nivo-html-caption">'.$item['content'].'</div>'; ?>
			
			<?php endforeach;?>
		</div>

		<?php echo implode($eleCaptions, "\n");?>
	</div>

</div>

<?php endif;?>

