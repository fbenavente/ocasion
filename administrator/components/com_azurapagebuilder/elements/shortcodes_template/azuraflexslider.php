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

AzuraJs::addStyle('flex','/components/com_azurapagebuilder/assets/plugins/flexSlider/flexslider.css');
AzuraJs::addJScript('flex','/components/com_azurapagebuilder/assets/plugins/flexSlider/jquery.flexslider-min.js');

if(!empty($id)){
	$id = ' id="'.$id.'" ';
}

$classes = 'azura_flexslider';
if ($class) {
	$classes .= ' '.$class;
}

$animationData = '';
if($animationArgs['animation'] == '1'){
    $classes .= ' animate-in';
    $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';   
}

$classes = 'class="'.$classes.'"';

?>
<div<?php echo $id;?> <?php echo $classes.' '.$flexsliderstyle.' '.$animationData;?> data-animation="<?php echo $flexanimation;?>" data-direction="<?php echo $direction;?>" data-slideshow="<?php echo $slideshow;?>" data-slideshowspeed="<?php echo $slideshowspeed;?>" data-animationspeed="<?php echo $animationspeed;?>">
<?php if(!empty($flexSliderItemsArray)):?>
	<ul class="slides">
		<?php foreach($flexSliderItemsArray as $slide) :?>
		<li>
			<?php if(!empty($slide['slideimage'])) :?>
				<img src="<?php echo JURI::root(true).'/'.$slide['slideimage'];?>" alt="">
			<?php endif;?>
			<?php echo ElementParser::do_shortcode( $slide['content'] ); ?>
		</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>
</div>

