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

if(empty($id)){
	$id = uniqid('owl-demo');
}


$classes = 'azp-carousel azp_font_edit';

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';		
}

if ($class) {
	$classes .= ' '.$class;
}

$classes = 'class="'.$classes.'"';

?>
<div id="<?php echo $id;?>" <?php echo $classes;?> <?php echo $carouselsliderstyle.' '.$animationData;?>>
	<?php echo do_shortcode($content);?>
</div>
<script>
jQuery(function($){

	var owl = $('#<?php echo $id;?>');
	
	owl.owlCarousel({	

		autoPlay : <?php echo (($autoplay == '1')? 'true' : 'false');?>,
	
		navigation : <?php echo (($navigation == '1' )? 'true' : 'false');?>,

		pagination:<?php echo (($pagination == '1' )? 'true' : 'false');?>,

	<?php if((int)$slideperview == 1) :?>
		singleItem : true,
	<?php else: ?>
		items : <?php echo (int)$slideperview;?>,
	<?php endif;?>

	<?php if(!empty($itemscustom)): ?>
		itemsCustom : <?php echo $itemscustom;?>,
	<?php endif;?>	

	<?php if(!empty($sliderspeed)): ?>
		slideSpeed : <?php echo $sliderspeed;?>,
	<?php endif;?>	

	<?php if(!empty($paginationspeed)): ?>
		paginationSpeed : <?php echo $paginationspeed;?>,
	<?php endif;?>

	<?php if(!empty($rewindspeed)): ?>
		rewindSpeed : <?php echo $rewindspeed;?>,
	<?php endif;?>

		autoHeight : <?php echo (($autoheight == '1' )? 'true' : 'false');?>,
		mouseDrag:	<?php echo (($mousedrag == '1' )? 'true' : 'false');?>,	
		touchDrag:<?php echo (($touchdrag == '1' )? 'true' : 'false');?>,
	<?php if(!empty($transtyle)): ?>
		transitionStyle : "<?php echo $transtyle;?>"
	<?php endif;?>		   
	});
})
</script>

