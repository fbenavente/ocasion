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

<!-- Work slider -->
<div class="row relative">
<?php if(count($items)) :
    $carouselId = uniqid('owlcarouselID');
?>
    <div id="<?php echo $carouselId;?>" class="owlcarousel work-slider">
    <?php foreach($items as $item) : 

        //$itemParams = json_decode($item->params);echo'<pre>';var_dump($itemParams);die;
        $extraFields = json_decode($item->extra_fields);
        $popupType = '';
        $popupLink = $extraFields[2]->value;
        $faIcon = 'fa-search';
        switch ($extraFields[1]->value) {
            case '1':
                $popupType = '';
                $faIcon = 'fa-search';
                $popupLink = JURI::root(true).$extraFields[2]->value;
                break;
            case '2':
                $popupType = '-youtube';
                $faIcon = 'fa-film';
                break;

            case '3':
                $popupType = '-vimeo';
                $faIcon = 'fa-film';
                break;
            case '4':
                $popupType = '-gallery';
                $faIcon = 'fa-image';
                $popupLink = JURI::root(true).$extraFields[2]->value;
                break;
            case '5':
                $popupType = '-soundcloud';
                $faIcon = 'fa-soundcloud';
                break;
            case '6':
                $popupType = 'gallery-link';
                $faIcon = 'fa-image';
                break;
            default:
                $popupType = '';
                $faIcon = 'fa-search';
                $popupLink = JURI::root(true).$extraFields[2]->value;
                break;
        }
    ?>

        <!-- Work item -->
        <div class="grid-ms">
        <?php if($popupType == 'gallery-link') : ?>
            <div class="overlay-item gallery-link">
                <a>
        <?php else : ?>
            <div class="overlay-item">
                <a class="popup<?php echo $popupType;?>" href="<?php echo $popupLink;?>">
        <?php endif;?>

                    <span class="o-hover">
                    <?php //if(json_decode($item->params)->catItemReadMore) : ?>
                        <span>
                            <i class="fa <?php echo $faIcon;?> fa-2x"></i>
                        </span>
                    <?php //endif;?>
                    </span>
                    <img src="<?php echo JURI::root(true).$extraFields[0]->value;?>" alt="<?php echo $item->title;?>" class="responsive-img">
                </a>
            </div>
        <?php if($popupType == 'gallery-link') : ?>
            <div class="gallery">
            <?php foreach($extraFields as $key=>$field) :
                if($key > 2 && !empty($field->value)) :
             ?>
                <a href="<?php echo JURI::root(true).$field->value;?>"></a>
            <?php endif; endforeach;?>
            </div>
        <?php endif;?>
            <div class="e-info">
                <h3><?php echo $item->title;?></h3>
                <?php if(!empty($item->introtext)) {
                    echo $item->introtext;
                } ?>
            </div>
        </div>

    <?php endforeach;?>

    </div>


    <!-- Controls for the work slider -->
    <a class="work-prev <?php echo $carouselId;?>-prev oc-left"><i class="fa fa-angle-left"></i></a>
    <a class="work-next <?php echo $carouselId;?>-next oc-right"><i class="fa fa-angle-right"></i></a>
<?php endif;?>

</div>

<!-- <div class="row">
    <div class="eight col center text-center">
        
        <br>
        <a href="<?php echo ElementParser::getK2CategoryLink($category);?>" class="btn"><?php echo JText::_('TPL_CAPTURE_WORK_VIEW_ALL_WORK_TEXT');?></a>

    </div>
</div> -->


