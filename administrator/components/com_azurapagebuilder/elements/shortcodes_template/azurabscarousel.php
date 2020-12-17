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

global $bsCarouselItemsArray;

ElementParser::do_shortcode($content);

$classes = 'azura_carousel slide azp_font_edit';

$animationData = '';
if($animationArgs['animation'] == '1'){
	 $classes .= ' animate-in';
  $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"'; 
}

if(!empty($class)){
	$classes .= ' '.$class;
}

$classes = 'class="'.$classes.'"';
 
if(empty($id)){
	$id = uniqid('azura_carousel');
}

$carouselData = ' ';
if(is_int((int)$interval)){
	$carouselData .= 'data-interval="'.(int)$interval.'"';
}
if($wrap === '0'){
	$carouselData .= ' data-wrap="false"';
}
if($keyboard === '0'){
	$carouselData .= ' data-keyboard="false"';
}
$carouselData .= ' data-pause="'.$pause.'"';


?>
<?php if(count($bsCarouselItemsArray)) :?>
<div id="<?php echo $id;?>" <?php echo $classes.' '.$bscarouselstyle.' '.$animationData.$carouselData;?>>
<?php if($pagination == '1') :?>
  <!-- Indicators -->
  <ol class="azura_carousel-indicators">
  	<?php foreach ($bsCarouselItemsArray as $key => $carouselItem) :?>
    	<li data-target="#<?php echo $id;?>" data-slide-to="<?php echo $key;?>" <?php if($key == 0) echo 'class="active"';?>></li>
    <?php endforeach;?>
  </ol>
<?php endif;?>
  <!-- Wrapper for slides -->
  <div class="azura_carousel-inner" role="listbox">
  	<?php foreach ($bsCarouselItemsArray as $key => $carouselItem) :?>
    <div class="item <?php if($key == 0) echo ' active';?> <?php echo $carouselItem['class'];?>">
      <img src="<?php echo JURI::root(true).'/'.$carouselItem['image'];?>" alt="...">
      	<?php if(!empty($carouselItem['content'])) :?>
	      	<div class="azura_carousel-caption">
	        <?php echo $carouselItem['content'];?>
	      	</div>
  		<?php endif;?>
    </div>
    <?php endforeach;?>
  </div>
<?php if($navigation == '1') :?>
  <!-- Controls -->
  <a class="left azura_carousel-control" href="#<?php echo $id;?>" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right azura_carousel-control" href="#<?php echo $id;?>" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
<?php endif;?>
</div>
<?php endif;?>