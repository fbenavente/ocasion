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

$classes = "azura_alert azp_font_edit";

$animationData = '';
if($animationArgs['animation'] == '1'){
	$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';
}

$classes .= ' azura_alert-'.strtolower($type);

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}

if($closebtn === '1'){
	$class .= ' azura_alert-dismissible';
	if($fadeeffect === '1'){
		$classes .= ' azura_fade in';
	}
}

$classes = 'class="'.$classes.'"';
 
?>
<div <?php echo $classes.' '.$alertstyle.' '.$animationData;?> role="azura_alert">
<?php if($closebtn === '1'): ?>
  <button type="button" class="close" data-dismiss="azura_alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<?php endif; ?>
  <?php echo ElementParser::do_shortcode($content);?>
</div>