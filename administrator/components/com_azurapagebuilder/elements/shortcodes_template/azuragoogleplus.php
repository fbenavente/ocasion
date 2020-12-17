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

$classes = "azura_googleplus google-plus-share-button azp_font_edit";

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}

$classes = 'class="'.$classes.'"';

AzuraJs::addJScript('google_plus','https://apis.google.com/js/platform.js', true, true, '');

?>

<!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->
<div <?php echo $classes.' '.$googleplusstyle.' '.$animationData;?>><g:plusone size="<?php echo $size;?>" annotation="<?php echo $annotation;?>"></g:plusone></div>