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

$classes = "icon-nav";

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
	<a href="<?php echo $link;?>">
		<i class="<?php echo $icon;?>"></i>
		<?php if(!empty($title)):?>
			<b><?php echo $title;?></b>
		<?php endif;?>
		<?php echo $content;?>
	</a>
</div>