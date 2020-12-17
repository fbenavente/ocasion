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

if(!empty($id)) {
	$id = 'id="'.$id.'"';
}
$classes = 'azura_cta azp_font_edit';

if(!empty($extraclass)) {
	$classes .= ' '.$extraclass;
}

$classes .= ' cta_align_'.$textalign;
//animation
$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

$btnClass = 'azura_btn';

$btnClass .= ' azura_'.$buttoncolor;

if(!empty($buttonsize)){
	$btnClass .= ' azura_'.$buttonsize;
}

$btnClass = 'class="'.$btnClass.'"';

$classes = 'class="'.$classes.'"';

if(!empty($target)) {
	$target = 'target="'.$target.'"';
}

if(!empty($url)){
	$url = 'href="'.$url.'"';
}
	
?>
<div <?php echo $id.' '.$classes.' '.$ctastyle.' '.$animationData;?>>
	<?php if(!empty($heading)):?>
	<h1><?php echo $heading;?></h1>
	<?php endif;?>
  	<?php echo $content;?>
  	<p class="cta_btn_<?php echo $buttonposition;?>">
  		<a  <?php echo $btnClass.' '.$url.' '.$target;?>>
			<?php echo $buttontext;?>
		</a>
	</p>
</div>
