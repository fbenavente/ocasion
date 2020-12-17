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

//$classes = "skill-bg";

// $animationData = '';
// if($animationArgs['animation'] == '1'){
// 	$classes .= ' animate-in';
// 	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';
// }

// if(!empty($extraclass)){
// 	$classes .= ' '.$extraclass;
// }
$params = JFactory::getApplication()->getTemplate(true)->params;
$sitename = JFactory::getApplication()->getCfg('sitename');
$logoImage = $params->get('logoImage');
$logoText = $params->get('logoText');

$logo = '';
if(!empty($logoImage)){
   $logo .= '<a href="'.JURI::root(true).'"  title="'.$sitename.'"><img src="'.JURI::root(true).'/'.$logoImage.'" alt="logo"></a>';
}elseif(!empty($logoText)){
   $logo .= '<h1><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$logoText.'</a></h1>';
}elseif(empty($logo)){
   $logo .= '<h1><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$sitename.'</a><h1>';
}

?>
<!-- Top bar -->
<div class="top-bar fixedmenu<?php if($alreadyfixed === '1') echo ' alreadyfixed';?>">
   <div class="row">
      <div class="twelve col">


         <!-- Symbolic or typographic logo -->
         <div class="tb-logo">
            <?php echo $logo;?>
         </div>


         <!-- Menu toggle -->
         <input type="checkbox" id="toggle" />
         <label for="toggle" class="toggle"></label>

         <?php 
             echo AzuraModuleHelper::loadposition('main_nav','none');
         ?>
   
      </div>
   </div>
</div>