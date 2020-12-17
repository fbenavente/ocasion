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

$classes = "home";



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
if($auto == '1'){
	$dataObj->auto = true;
}else{
	$dataObj->auto = false;
}
if($pager == '1'){
	$dataObj->pager = true;
}else{
	$dataObj->pager = false;
}
if($controls == '1'){
	$dataObj->controls = true;
}else{
	$dataObj->controls = false;
}
$dataObj->speed = (int)$speed;
$dataObj->mode = $mode;
//$dataObj->items = (int)$items;
$dataObj = rawurlencode(json_encode($dataObj));


?>
<!-- Home -->
<section  <?php echo $id;?> <?php echo $classes.' '.$bgsliderstyle.' '.$animationData;?>>
	<div class="header large">
		<!-- Content -->
		<div class="header-inner">
			<?php echo $content;?>
		</div>

		<?php if(count($bgSliderItemsArray)) :?>
		<ul class="home-bg-slider"  data-options="<?php echo $dataObj;?>">
				
				<?php foreach ($bgSliderItemsArray as $key => $bg) :?>

				<li><div class="header large bg-img background-two <?php echo $bg['extraclass'];?>" style="background-image: url(<?php echo JURI::root(true).'/'.$bg['src'];?>);"></div></li>

				<?php endforeach;?>
		</ul>
		<?php endif;?>
	</div>
</section>
