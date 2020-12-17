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


	
$classes = "grid-mb";


$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}

$classes = 'class="'.$classes.'"';
 
?>
<div <?php echo  $classes.' '.$memberitemstyle.' '.$animationData;?>>
	<div class="overlay-item">
		<?php echo $content;?>
		<?php if(!empty($photo)) :?>
		<img src="<?php echo JURI::root(true).'/'.$photo;?>" alt="<?php echo $name;?>" class="responsive-img">
		<?php endif;?>
	</div>
	<div class="e-info">
			<h3><?php echo $name;?></h3>
		<?php if(!empty($job)) :?>
			<p><?php echo $job;?></p>
		<?php endif;?>
	</div>
</div>
