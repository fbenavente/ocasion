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

$classes = 'azp_k2category cbp-l-filters-alignCenter azp_font_edit';

$animationData = '';
if($animationArgs['animation'] == '1'){
    $classes .= ' animate-in';
    $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';
}

if(!empty($class)){
	$classes .= ' '.$class;
}

$classes = 'class="'.$classes.'"';

?>
<?php if(count($items)) : ?>
<!-- Work grid -->
<div class="work-grid">


<?php foreach ($items as $key => $item) : //echo'<pre>',var_dump($item);die;

    $extraFields = json_decode($item->extra_fields);
?>
    <!-- Work item -->
    <?php if($extraFields[1]->value === '5'):?>
    <div class="work-item gallery-link">
    <?php else: ?>
    <div class="work-item">
    <?php endif;?>
    <?php switch ($extraFields[1]->value) {
        case '1': ?>
        <a class="popup" href="<?php echo JURI::root(true).$extraFields[2]->value;?>">
            <i class="fa fa-expand"></i>
    <?php
            break;
        case '2': ?>
        <a href="<?php echo ElementParser::getK2ItemLink($item->id,$item->alias,$item->catid,$item->categoryalias);?>" >
            <i class="fa fa-link"></i>
    <?php
            break;
        case '3':?>
        <a class="popup-vimeo" href="<?php echo $extraFields[2]->value;?>">
            <i class="fa fa-expand"></i>
    <?php
            break;
        case '4': ?>
        <a class="popup-youtube" href="<?php echo $extraFields[2]->value;?>">
            <i class="fa fa-expand"></i>
    <?php
            break;
        case '5': ?>
        <a>
            <i class="fa fa-image"></i>
    <?php 
            break;
        default: ?>
        <a class="popup" href="<?php echo JURI::root(true).$extraFields[2]->value;?>">
            <i class="fa fa-expand"></i>
    <?php
            break;
    } ?>
            <img src="<?php echo JURI::root(true).$extraFields[0]->value;?>" alt="<?php echo $item->title;?>" class="responsive-img">
            <div class="wi-info">
                <h3><?php echo $item->title;?></h3>
                <p><?php echo ElementParser::getK2ItemTagsFilter($item,", ");?></p>
                
            </div>
        </a>
    </div>
    <?php if($extraFields[1]->value == '5') : ?>
    <div class="gallery">
    <?php foreach($extraFields as $key=>$value) :?>
        <?php if($key > 1 && $value->value): ?>
        <a href="<?php echo JURI::root(true).$value->value;?>"></a>
        <?php endif;?>
    <?php endforeach;?>
    </div>
    <?php endif;?>


    
<?php endforeach;?>

</div>

<!-- View all work button -->
<div class="grey-cta">
    <a href="<?php echo ElementParser::getK2CategoryLink($category);?>" class="btn"><?php echo JText::_('TPL_CAPTURE_WORK_VIEW_ALL_WORK_TEXT');?></a>
</div>
<?php endif;?>
