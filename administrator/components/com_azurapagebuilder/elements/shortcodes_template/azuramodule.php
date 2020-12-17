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

$classes = 'azp_module azp_font_edit';

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
<div <?php echo (!empty($id)? 'id="'.$id.'"' : ''); ?> <?php echo $classes.' '.$modulestyle.' '.$animationData;?>>
	<?php if($showtitle) : ?>
		<h3><?php echo $module->title;?></h3>
	<?php endif;?>
	<?php echo $module->content;?>
</div>