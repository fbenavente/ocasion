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


	
$classes = "employee-slider-wrap";


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
	$id='id="'.$id.'"';
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
<section <?php echo $id.' '. $classes.' '.$teamstyle.' '.$animationData;?>>
<?php if(count($teamMembersArray)):?>
<div class="row relative">
	<div class="owlcarousel employee-slider grid-mt" data-options="<?php echo $dataObj;?>">

	<?php foreach ($teamMembersArray as $key => $tm) : ?>
		<!-- Employee -->
		<div class="grid-ms">
			<div class="overlay-item">
				<?php echo $tm['content'];?>
				<?php if(!empty($tm['photo'])) :?>
					<img src="<?php echo JURI::root(true).'/'.$tm['photo'];?>" alt="<?php echo $tm['name'];?>" class="responsive-img">
				<?php endif;?>
				
			</div>
			<div class="e-info">
				<h3><?php echo $tm['name'];?></h3>
				<?php if(!empty($tm['job'])) :?>
				<p><?php echo $tm['job'];?></p>
				<?php endif;?>
			</div>
		</div>
	<?php endforeach;?>
	</div>
	<?php if($shownav === '1') :?>
	<!-- Controls for the employee slider -->
	<a class="emp-prev oc-left"><i class="arrow-control fa fa-angle-left"></i></a>
	<a class="emp-next oc-right"><i class="arrow-control fa fa-angle-right"></i></a>
	<?php endif;?>
</div>
<?php endif;?>
</section>
