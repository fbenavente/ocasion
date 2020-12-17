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

$classes = "azura_pinterest pinterest-pinit-button azp_font_edit";

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}


$dataShape = '';
if($shape === 'round'){
	//$dataHeight = '';
	$dataShape = 'data-pin-shape="round"';
	if((int)$size == 28){
		$size = '32';
	}else{
		$size = '16';
	}
}

$dataHeight = 'data-pin-height="'.$size.'"';

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}

$classes = 'class="'.$classes.'"';

if(!empty($url)){
	$url = JURI::root();
}
//&media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest
?>
<div <?php echo $classes.' '.$pintereststyle.' '.$animationData;?>>
	<a href="//www.pinterest.com/pin/create/button/?url=<?php echo $url;?>" data-pin-do="buttonPin" data-pin-config="<?php echo $annotation;?>" data-pin-color="red"  <?php echo $dataHeight.' '.$dataShape;?>>
		<img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_<?php echo $shape;?>_red_<?php echo (int)$size;?>.png" />
	</a>
</div>