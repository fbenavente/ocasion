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

AzuraJs::addJScript('GmapAPI', 'http://maps.google.com/maps/api/js?sensor=false', false , false, '');
AzuraJs::addJScript('Gmap3','/components/com_azurapagebuilder/assets/plugins/gmap3/gmap3.min.js');

$classes ='azura_gmap azp_font_edit';

$animationData = '';
if($animationArgs['animation'] == '1'){
        $classes .= ' animate-in';
    $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"'; 
    
}

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}

if(empty($mapheight) || !is_int((int)$mapheight)){
    $classes .= ' azura_gmap_responsive';
    $mapheight = 300;
}

if(!empty($id)){
    $id = ' id="'.$id.'"';
}

$gmapData = new stdClass;
$gmapData->gmapheight = $mapheight;
$gmapData->gmaplat = $gmaplat;
$gmapData->gmaplog = $gmaplog;
if($gmappancontrol === '1'){
    $gmapData->gmappancontrol = true;
}else{
    $gmapData->gmappancontrol = false;
}
if($gmapzoomcontrol === '1'){
    $gmapData->gmapzoomcontrol = true;
}else{
    $gmapData->gmapzoomcontrol = false;
}
if($gmaptypecontrol === '1'){
    $gmapData->gmaptypecontrol = true;
}else{
    $gmapData->gmaptypecontrol = false;
}
if($gmapstreetviewcontrol === '1'){
    $gmapData->gmapstreetviewcontrol = true;
}else{
    $gmapData->gmapstreetviewcontrol = false;
}
if($gmapscrollwheel === '1'){
    $gmapData->gmapscrollwheel = true;
}else{
    $gmapData->gmapscrollwheel = false;
}
$gmapData->gmapzoom = (int)$gmapzoom;
$gmapData->gmaptypeid = $gmaptypeid;

$gmapData = rawurlencode(json_encode($gmapData));

?>
<div class="<?php echo $classes; ?>" <?php echo $id.' '.$gmapstyle.' '.$animationData;?> data-map="<?php echo $gmapData;?>">
    <div class="azura_gmap_wrapper"></div>
</div>
