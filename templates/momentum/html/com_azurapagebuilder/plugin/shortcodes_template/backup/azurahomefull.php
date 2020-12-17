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


$classes = 'header fullwidth bg-img bg-two';


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
<div <?php echo $id;?> class="home fullwidth <?php echo $extraclass;?>">
	<div <?php echo $classes.' '.$homefullstyle.' '.$animationData;?>>
		<div class="overlay"></div>
		<div class="header-inner">
			<?php echo ElementParser::do_shortcode($content);?>
		</div>
	</div>
	<?php if(!empty($scroll_link)) :?>
	<a href="<?php echo $scroll_link;?>"<?php if(!empty($scroll_class)) echo ' class="'.$scroll_class.'"';?>><span></span></a>
<?php endif;?>
</div>