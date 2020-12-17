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

global $tabsItemsArray;

ElementParser::do_shortcode($content);

if($id){
	$id = 'id="'.$id.'"';
}

$classes = 'azura_tabs';

$animationData = '';
if($animationArgs['animation'] == '1'){
		$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if ($class) {
	$classes .= ' '.$class;
}

if(!empty($classes)){
	$classes = 'class="'.$classes.'"';
}
if(is_int((int)$defaultactive)){
	$defaultactive = (int)$defaultactive;
}else{
	$defaultactive = 1;
}

?>

<div <?php echo $classes .' '.$tabsstyle.' '.$animationData;?>>

  <!-- Nav tabs -->
  <ul class="azura_nav azura_nav-<?php echo $tabstyle;?>s<?php if($usejustified === '1') echo '  azura_nav-justified';?>">
  	<?php foreach ($tabsItemsArray as $key => $tab) :?>
	    <?php if(($key+1) === $defaultactive) :?>
	    <li class="active">
	    <?php else : ?>
	    <li>
	    <?php endif;?>

    	<a href="#<?php echo !empty($tab['id'])? $tab['id'] : ElementParser::slug($tab['title']);?>" data-toggle="azura_<?php echo $tabstyle;?>"><?php echo $tab['title'];?></a>
    </li>
    <?php endforeach;?>
  </ul>

  <!-- Tab panes -->
  <div class="azura_tab-content">
  	<?php foreach ($tabsItemsArray as $key => $tab) :?>
	  	<?php if(($key+1) === $defaultactive) :?>
	    <div class="azura_tab-pane active<?php if($fade === '1') echo ' fade in';?>" id="<?php echo !empty($tab['id'])? $tab['id'] : ElementParser::slug($tab['title']);?>">
	    <?php else : ?>
	    <div class="azura_tab-pane<?php if($fade === '1') echo ' fade';?>" id="<?php echo !empty($tab['id'])? $tab['id'] : ElementParser::slug($tab['title']);?>">
	    <?php endif;?>

		<?php echo $tab['content']; ?>
    
    </div>
    <?php endforeach;?>
  </div>

</div>


