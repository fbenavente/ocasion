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

ElementParser::do_shortcode($content);
//echo'<pre>';var_dump($processItemsArray);die;

$classes = "owlcarousel process-slider";

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
<?php if(count($processItemsArray)) : ?>
<div <?php echo $id;?> <?php echo $classes.' '.$processstyle.' '.$animationData;?>>


	<?php foreach ($processItemsArray as $pro) :?>
			
		<!-- Process item -->
		<div class="grid-ms">
			<div class="process-item grab">
				<?php if(!empty($pro['iconclass'])) : ?>
					<i class="<?php echo $pro['iconclass'];?>"></i>
				<?php endif;?>
				<?php echo $pro['content'];?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
<?php endif;?>