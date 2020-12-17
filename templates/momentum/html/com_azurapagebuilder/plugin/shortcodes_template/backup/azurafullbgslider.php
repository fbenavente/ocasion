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

$classes = "home fullwidth";



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
?>
<section <?php echo $id;?> <?php echo $classes.' '.$fullbgsliderstyle.' '.$animationData;?>>
	<div class="header">


		<!-- Content -->
		<div class="header-inner">
			<?php echo $content;?>
		</div>

	<?php if(count($fullBgSliderItemsArray)) :?>
		<ul class="fw-bg-slider">
			<?php foreach ($fullBgSliderItemsArray as $key => $bg) :?>
				<li><div class="fullwidth bg-img <?php echo $bg['extraclass'];?>" style="background-image: url(<?php echo JURI::root(true).'/'.$bg['src'];?>);"><?php if($bg['overlay'] === '1') : ?><div class="overlay"></div><?php endif;?></div></li>
			<?php endforeach;?>
		</ul>

	<?php endif;?>


	</div>
</section>
