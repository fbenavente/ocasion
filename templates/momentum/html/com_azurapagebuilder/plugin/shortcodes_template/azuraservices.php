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

//ElementParser::do_shortcode($content);
//echo'<pre>';var_dump($processItemsArray);die;

$classes = "services section-slider";

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}

$classes = 'class="'.$classes.'"';
if(!empty($id)){
	$id = 'id="'.$id.'"';
}

$dataObj = new stdClass;
if($autoplay == 'true'){
	$dataObj->autoplay = true;
}elseif(is_numeric($autoplay)){
	$dataObj->autoplay = (int)$autoplay;
}else{
	$dataObj->autoplay = false;
}
if($issingle === '1'){
	$dataObj->singleitem = true;
}else{
	$dataObj->singleitem = false;
}
$dataObj->slidespeed = (int)$slidespeed;
$dataObj->items = (int)$items;
$dataObj = rawurlencode(json_encode($dataObj));

?>
<section <?php echo $id;?> <?php echo $classes.' '.$servicesstyle.' '.$animationData;?>>
	<?php if(!empty($content)) {
		echo $content;
	}
	?>

	<div class="row relative services-slider-wrap">
		<?php if(count($servicesItemsArray)) : ?>
		<div class="owlcarousel services-slider" data-options="<?php echo $dataObj;?>">


			<?php foreach ($servicesItemsArray as $ser) :?>
					
				<!-- Process item -->
				<div class="grid-ms">
					<div class="service-item">
						<?php if(!empty($ser['iconclass'])) : ?>
							<i class="<?php echo $ser['iconclass'];?>"></i>
						<?php endif;?>
						<?php echo $ser['content'];?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif;?>
		<?php if($shownav === '1') :?>
		<!-- Controls for the services slider -->
		<a class="serv-prev oc-left"><i class="arrow-control fa fa-angle-left"></i></a>
		<a class="serv-next oc-right"><i class="arrow-control fa fa-angle-right"></i></a>
		<?php endif;?>
	</div>
</section>