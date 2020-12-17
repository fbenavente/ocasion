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

$classes = "icon-list";

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}

$classes = 'class="'.$classes.'"';
// if(!empty($id)){
// 	$id = 'id="'.$id.'"';
// }
?>
<div <?php echo $classes.' '.$iconboxstyle.' '.$animationData;?>>
	<div class="il-icon">
		<i class="<?php echo $icon;?>"></i>
	</div>
	<div class="il-text">
		<?php if(!empty($title)):?>
			<h3><?php echo $title;?></h3>
		<?php endif;?>
		<?php echo $content;?>
	</div>
</div>
