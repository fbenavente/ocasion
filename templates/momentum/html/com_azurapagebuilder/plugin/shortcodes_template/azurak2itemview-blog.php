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

$classes = "blog-block";

$animationData = '';
if($animationArgs['animation'] == '1'){
    $classes .= ' animate-in';
    $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';
}

if(!empty($extraclass)){
    $classes .= ' '.$extraclass;
}

$classes = 'class="'.$classes.'"';
$iconClass = 'fa fa-file-text-o';
?>
<div <?php echo $classes.' '.$k2itemviewstyle.' '.$animationData;?>>
<?php if($item): ?> 
    <?php 
        if($posttype === '1'){
            $extraFields = array();
            if($item->extra_fields){
              if(!is_array($item->extra_fields)){
                $extraFields = json_decode($item->extra_fields);
              }else{
                $extraFields = $item->extra_fields;
              }
            }
            if(!empty($extraFields)){
                $postType = $extraFields[0]->value;
                $postLink = $extraFields[1]->value;
            }

            switch ($postType) {
                case '1':
                    $iconClass = 'fa fa-image';
                    break;
                case '2':
                    $iconClass = 'fa fa-camera';
                    break;
                case '3':
                    $iconClass = 'fa fa-camera';
                    break;
                case '4':
                    $iconClass = 'fa fa-lightbulb-o';
                    break;
                case '5':
                    $iconClass = 'fa fa-audio';
                    break;
                case '6':
                    $iconClass = 'fa fa-link';
                    break;
                
            }

        }  
    ?>
    <?php if(!empty($imagesize)) :?>
        <?php if(/*$item->params->get('itemImage') && */!empty($item->{$imagesize})): ?>
            <img src="<?php echo $item->{$imagesize}; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" class="responsive-img">
        <?php endif; ?>
    <?php endif;?>

    <?php if($posttype === '1') :?>
        <?php
        switch ($postType) :
            case '1': # single photo ?>
            
                <img src="<?php echo JURI::root(true).$postLink;?>" alt="<?php echo $item->title;?>" class="responsive-img">
            
        <?php   break;
            case '2': # youtube video 
            $id = array();
            // get youtube video id from link
            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $postLink, $id);
            //support embed link pasted at link
            if(empty($id) || !is_array($id)){
                preg_match('/embed[\/]([^\\?\\&]+)[\\?]/', $postLink, $id);
            }
            if(!empty($id[1])) : ?>
                
                <div class="responsive-video">
                    <iframe src="http://www.youtube.com/embed/<?php echo $id[1];?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
                
            <?php endif;?>

        <?php   break;
            case '3': # vimeo video 
            $id = array();
            // get vimeo video id from link
            preg_match('/http:\/\/vimeo.com\/(\d+)$/', $postLink, $id);

            if(count($id[1])) :?>
            
            <div class="responsive-video">
                <iframe src="http://player.vimeo.com/video/<?php echo $id[1];?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
            
            <?php endif;?>
        <?php   break;
            case '4': # image slider ?>
            
                <ul class="img-slider">
                <?php
                foreach ($extraFields as $key => $field) :
                    if($key > 0 && trim($field->value) !='') :
                ?>
                        <li>
                            <img alt="<?php echo $item->title. '-image-'.($key+1);?>" src="<?php echo JURI::root(true).$field->value;?>"  class="responsive-img">
                        </li>
                <?php endif; endforeach; ?>
                </ul>
            
        <?php   break;
            case '5': # soundcloud audio 
            $url = str_replace(":", "%3A", $postLink);?>
            
                <div class="responsive-video">
                    <iframe src="https://w.soundcloud.com/player/?url=<?php echo $url;?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            
        <?php   break;
            default: # code... ?>

        <?php
                break;
        endswitch; ?>

    <?php endif;?>

    <div class="bb-wrap">
        <div class="bb-circle">
            <i class="<?php echo $iconClass;?>"></i>
        </div>
        <?php if($showtitle === '1') :?>
        <h3><a href="<?php echo ElementParser::getK2ItemLink($item->id,$item->alias,$item->catid,$item->category->alias);?>"><?php echo $item->title;?></a></h3>
        <?php endif;?>
        
        <?php if($showcreated === '1'||$showcategory === '1'||$showcomment === '1'): ?>
        <div class="bb-meta">
        <?php if($showcreated === '1') : ?>
            <?php //if($item->params->get('itemDateCreated')): ?>
            <a href="#"><i class="fa fa-clock-o"></i> <?php echo JHtml::_('date',$item->created,'F d, Y');?></a> 
            <?php //endif; ?>
        <?php endif; ?>
        <?php if($showcategory === '1') : ?>
            <a href="<?php echo $item->category->link; ?>"><i class="fa fa-tag"></i> <?php echo $item->category->name;?></a> 
        <?php endif; ?>
        <?php if($showcomment === '1') : ?>
            <?php //if($item->params->get('itemCommentsAnchor') && ($item->params->get('comments') == '1') ): ?>
            
        
                    <?php if($item->numOfComments > 0): ?>
                    
                    <a href="<?php echo $item->link; ?>#itemCommentsAnchor">
                        <i class="fa fa-comments"></i> <?php echo $item->numOfComments; ?> <?php echo ($item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
                    </a>
                    <?php else: ?>
                    <a href="<?php echo $item->link; ?>#itemCommentsAnchor">
                        <i class="fa fa-comments"></i> <?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
                    </a>
                    <?php endif; ?>
            <?php //endif; ?>
        <?php endif; ?>
        </div>
        <?php endif;?>
        <?php if($introtextlength !== 'hide') :?>
            <?php if(is_numeric($introtextlength)){
                echo '<p>'.JHtml::_('string.truncate',strip_tags($item->introtext),(int)$introtextlength).'</p>';
            }else{
                echo $item->introtext;
            }
        ?>
        <?php endif;?>
        <?php if($showfulltext === '1'){
            echo $item->fulltext;
        }?>
        <?php if($showreadmore === '1') :?>
        <a href="<?php echo $item->link;?>" class="read-more"><?php echo JText::_('TPL_CAPTURE_READ_MORE_TEXT');?></a>
        
        <?php endif;?>
        
    </div>
<?php endif;?>
</div>
