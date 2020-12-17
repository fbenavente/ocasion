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

global $tourItemsArray;

ElementParser::do_shortcode($content);

if($id){
	$id = 'id="'.$id.'"';
}

$classes = 'azura_tour';

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

  	<?php if($tabposition === 'left') :?>

	<div class="col-sm-3">
	  	<!-- Nav tabs -->
		  <ul class="azura_nav azura_nav-<?php echo $tabstyle;?>s<?php if($verticaltext === '1') echo '  sideways';?> tabs-left">
		  	<?php foreach ($tourItemsArray as $key => $tour) :?>
			    <?php if(($key+1) === $defaultactive) :?>
			    <li class="active">
			    <?php else : ?>
			    <li>
			    <?php endif;?>

		    	<a href="#<?php echo !empty($tour['id'])? $tour['id'] : ElementParser::slug($tour['title']);?>" data-toggle="azura_<?php echo $tabstyle;?>">
				<?php if(!empty($tour['iconclass'])) :?>
				<i class="<?php echo $tour['iconclass'];?>"></i>
				<?php endif;?>
		    	<?php echo $tour['title'];?></a>
		    </li>
		    <?php endforeach;?>
		  </ul>
	  </div>

	<?php endif;?>

	  <div class="col-sm-9">
	  	<!-- Tab panes -->
		  <div class="azura_tab-content">
		  	<?php foreach ($tourItemsArray as $key => $tour) :?>
			  	<?php if(($key+1) === $defaultactive) :?>
			    <div class="azura_tab-pane active<?php if($fade === '1') echo ' fade in';?>" id="<?php echo !empty($tour['id'])? $tour['id'] : ElementParser::slug($tour['title']);?>">
			    <?php else : ?>
			    <div class="azura_tab-pane<?php if($fade === '1') echo ' fade';?>" id="<?php echo !empty($tour['id'])? $tour['id'] : ElementParser::slug($tour['title']);?>">
			    <?php endif;?>

				<?php echo $tour['content']; ?>
		    
		    </div>
		    <?php endforeach;?>
		  </div>
	  </div>

	<?php if($tabposition === 'right') :?>
	<div class="col-sm-3">
  	<!-- Nav tabs -->
	  <ul class="azura_nav azura_nav-<?php echo $tabstyle;?>s<?php if($verticaltext === '1') echo '  sideways';?> tabs-right">
	  	<?php foreach ($tourItemsArray as $key => $tour) :?>
		    <?php if(($key+1) === $defaultactive) :?>
		    <li class="active">
		    <?php else : ?>
		    <li>
		    <?php endif;?>

	    	<a href="#<?php echo !empty($tour['id'])? $tour['id'] : ElementParser::slug($tour['title']);?>" data-toggle="azura_<?php echo $tabstyle;?>"><?php echo $tour['title'];?></a>
	    </li>
	    <?php endforeach;?>
	  </ul>
  </div>
	<?php endif;?>

</div>


