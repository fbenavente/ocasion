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

global $accordionItemsArray;

ElementParser::do_shortcode($content);

//$classes = 'azp_panel-group panel-group azp_font_edit';
$classes = 'accordion';

$animationData = '';
if($animationArgs['animation'] == '1'){
	$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';
}

if(!empty($class)){
	$classes .= ' '.$class;
}

$classes = 'class="'.$classes.'"';
 
if(empty($id)){
	$id = uniqid();
}

if(is_int((int)$defaultactive)){
	$defaultactive = (int)$defaultactive;
}else{
	$defaultactive = 1;
}


?>

<?php if(count($accordionItemsArray)) :?>

<div id="<?php echo $id;?>" <?php echo $classes;?> <?php echo $accordionstyle.' '.$animationData;?>>


	<?php foreach ($accordionItemsArray as $key => $item) : ?>

		<div class="accordion-group <?php echo $item['class'];?>">
		  <div class="accordion-heading">
		    <a class="accordion-toggle" data-toggle="collapse" <?php if($acctype === 'accordion') echo 'data-parent="#'.$id.'"';?> href="#<?php echo !empty($item['id'])? $item['id'] : ElementParser::slug($item['title']);?>">
		    <?php echo $item['title'];?>
		    </a>
		  </div>
		  <div id="<?php echo !empty($item['id'])? $item['id'] : ElementParser::slug($item['title']);?>" class="accordion-body collapse<?php if(($key+1) === $defaultactive) echo ' in';?>">
		    <div class="accordion-inner">
		    <?php echo $item['content'];?>
		    </div>
		  </div>
		</div>
	
	<?php endforeach;?>

</div>

<?php endif;?>

