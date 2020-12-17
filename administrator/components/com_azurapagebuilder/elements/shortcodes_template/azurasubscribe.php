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

$classes = 'azura_subscribeform subscribe-wrapper azp_font_edit';

$animationData = '';
if($animationArgs['animation'] == '1'){
    $classes .= ' animate-in';
    $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';   
}
if(!empty( $extraclass)){
    $classes .=' '.$extraclass;
}
$classes = 'class="'.$classes.'"';
if(!empty( $id)){
    $id .='id="'.$id.'"';
}
?>
<!--contact form -->

<div <?php echo $id.' '. $classes.' '.$subscribestyle.' '.$animationData;?>>
    <div class="row">
        <div class="subscribe">
            <div id="azurasubscribemessage"></div>

            <form class="azura_subscribe-form" method="post" action="<?php echo JURI::root();?>" name="azurasubscribeform" id="azurasubscribeform">
        
                
                <input placeholder="<?php echo JText::_('COM_AZURAPAGEBUILDER_YOUR_EMAIL_TEXT');?>" id="subscribe_email" class="text wow fadeInLeft login_input" type="text" name="email" data-wow-delay="100ms" data-wow-duration="400ms"> 
                <input type="submit" id="azurasubscribesubmit" value="<?php echo JText::_('COM_AZURAPAGEBUILDER_SUBSCRIBE_TEXT');?>" class="btn wow fadeInRight" data-wow-delay="300ms" data-wow-duration="400ms">
                <?php
                JPluginHelper::importPlugin('captcha');
                $dispatcher = JEventDispatcher::getInstance();
                $dispatcher->trigger('onInit','dynamic_recaptcha_1');
                ?>
                <div id="dynamic_recaptcha_1"></div>

                <input type="hidden" name="receiveEmail" value="<?php echo $receiveemail;?>">
                
                <input type="hidden" name="subject" value="<?php echo $emailsubject;?>">
                
                <input type="hidden" name="thanks" value="<?php echo $thanksmessage;?>">
                <input type="hidden" name="option" value="com_azurapagebuilder">
                <input type="hidden" name="task" value="contact.subscribe">
                <?php echo JHtml::_('form.token'); ?>
            </form>
        </div>
    </div>
</div>

