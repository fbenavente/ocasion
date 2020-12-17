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

$classes = 'azura_contactform azp_font_edit';

$animationData = '';
if($animationArgs['animation'] == '1'){
        $classes .= ' animate-in';
    $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';   
}

$classes = 'class="'.$classes.'"';

?>
<!--contact form -->

<div <?php echo $classes.' '.$contactformstyle.' '.$animationData;?>>

    <?php if(!empty($title)) :?>
    <h3><?php echo $title;?></h3>
    <?php endif;?>

    <?php if(!empty($content)) :?>
    <p><?php echo $content;?></p>
    <br>
    <?php endif;?>

    <div id="azuramessage"></div>

    <form class="azura_contact-form" method="post" action="<?php echo JURI::root();?>" name="azuracontactform" id="azuracontactform">
        <div class="azura_form-group">
            <label for="name"><?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_NAME_LABEL_TEXT');?></label>
            <input type="text" name="name" class="azura_form-control" id="name" placeholder="<?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_NAME_TEXT');?>">
        </div>
        
        <div class="azura_form-group">
            <label for="email"><?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_EMAIL_LABEL_TEXT');?></label>
            <input type="email" name="email" class="azura_form-control" id="email" placeholder="<?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_EMAIL_TEXT');?>">
        </div>  
        <?php if($showwebsite === '1') :?> 
        <div class="azura_form-group">
            <label for="website"><?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_WEBSITE_LABEL_TEXT');?></label>
            <input type="text" name="website" class="azura_form-control" id="website" placeholder="<?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_WEBSITE_TEXT');?>">
        </div> 
        <?php endif;?>
        <?php if($showsubject === '1') :?> 
        <div class="azura_form-group">
            <label for="subject"><?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_SUBJECT_LABEL_TEXT');?></label>
            <input type="text" name="subject" class="azura_form-control" id="subject" placeholder="<?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_SUBJECT_TEXT');?>" value="<?php echo $emailsubject;?>">
        </div> 
        <?php endif;?>
        <div class="azura_form-group">
            <label for="comments"><?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_MESSAGE_LABEL_TEXT');?></label>
            <textarea name="message" rows="6" id="message" class="azura_form-control" placeholder="<?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_MESSAGE_TEXT');?>"></textarea>
        </div> 
        
        <?php if($sendascopy === '1') :?> 
        
            <label class="azura_checkbox-inline" for="sendascopy">
            <input type="checkbox" value="1" id="sendascopy"  name="sendAsCopy">
            <?php echo JText::_('MOD_AZURAPAGEBUILDER_SEND_AS_A_COPY_TEXT');?></label>
            <div style="margin-bottom: 15px;"></div>
        
        <?php endif;?>


        <?php
        JPluginHelper::importPlugin('captcha');
        $dispatcher = JEventDispatcher::getInstance();
        $dispatcher->trigger('onInit','dynamic_recaptcha_1');
        ?>
        <div id="dynamic_recaptcha_1"></div>
			
        <div class="azura_form-group">
            <input type="submit"  class="azura_btn azura_btn-default" id="azurasubmit" value="<?php echo JText::_('COM_AZURAPAGEBUILDER_CONTACT_SEND_TEXT');?>">
        </div> 
            

        <input type="hidden" name="receiveEmail" value="<?php echo $receiveemail;?>">
        <?php if($showsubject === '0') :?> 
		<input type="hidden" name="subject" value="<?php echo $emailsubject;?>">
        <?php endif;?>
		<input type="hidden" name="thanks" value="<?php echo $thanksmessage;?>">
		<input type="hidden" name="option" value="com_azurapagebuilder">
		<input type="hidden" name="task" value="contact.sendemail">
		<?php echo JHtml::_('form.token'); ?>


    </form>
</div>
