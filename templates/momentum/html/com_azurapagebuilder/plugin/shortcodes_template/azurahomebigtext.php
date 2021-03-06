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
if($bgcolor === 'img'){
	$classes = "header large bg-img fixed background-one";
}else{
	$classes = "header bg-".$bgcolor;
}


$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

// if(!empty($extraclass)){
// 	$classes .= ' '.$extraclass;
// }

$classes = 'class="'.$classes.'"';
if(!empty($id)){
	$id = 'id="'.$id.'"';
}
?>
<section <?php echo $id;?> class="home <?php echo $extraclass;?>">
	<div <?php echo $classes.' '.$homebigtextstyle.' '.$animationData;?>>
		<div class="header-inner">

			<?php echo ElementParser::do_shortcode($content);?>

		</div>
	</div>
</section>