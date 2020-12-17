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

$classes = 'four col medium-six col small-twelve col grid-mb';

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
<?php //echo $classes.' '.$k2categorystyle.' '.$animationData;?>

    
    <?php foreach ($items as $key => $item) : //echo'<pre>',var_dump($item);die;

        $extraFields = json_decode($item->extra_fields);
        $postType = $extraFields[0]->value;
        $postLink = $extraFields[1]->value;
        $iconClass = 'fa fa-file-text-o';
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
    ?>
            <!-- Blog block -->
            <div <?php echo $classes;?>>
                <div class="blog-block">
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
                    
                    <div class="bb-wrap">
                        <div class="bb-circle">
                            <i class="<?php echo $iconClass;?>"></i>
                        </div>
                        <h3><a href="<?php echo $item->link;?>"><?php echo $item->title;?></a></h3>
                        <div class="bb-meta">
                            <a href="#"><i class="fa fa-user"></i> <?php echo ElementParser::userGetName($item->created_by);?></a>
                            <a href="#"><i class="fa fa-clock-o"></i> <?php echo JHtml::_('date',$item->created,'F d, Y');?></a>
                        </div>
                        <p><?php echo JHtml::_('string.truncate',strip_tags($item->introtext),'100'); ?></p>
                        <a href="<?php echo $item->link;?>" class="read-more"><?php echo JText::_('TPL_CAPTURE_READ_MORE_TEXT');?></a>
                    </div>
                </div>
            </div>

   

        <?php endforeach;?>


<?php endif;?>
