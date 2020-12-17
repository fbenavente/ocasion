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

    <form class="azura_contact-form form c-form" method="post" action="<?php echo JURI::current();?>" name="azuracontactform" id="azuracontactform">
	    <fieldset> 
	        
	            <input type="text" name="name"  id="name" placeholder="<?php echo JText::_('TPL_MOMENTUM_CONTACT_YOUR_NAME_TEXT');?>">

	        
	        
	            <input type="text" name="email" id="email" placeholder="<?php echo JText::_('TPL_MOMENTUM_CONTACT_YOUR_EMAIL_TEXT');?>">

	        <?php if($showwebsite === '1') :?> 
	        
	            <input type="text" name="website"  id="website" placeholder="<?php echo JText::_('TPL_MOMENTUM_CONTACT_WEBSITE_TEXT');?>">

	        <?php endif;?>
	        <?php if($showsubject === '1') :?> 
	        
	            <input type="text" name="subject"  id="subject" placeholder="<?php echo JText::_('TPL_MOMENTUM_CONTACT_SUBJECT_TEXT');?>" value="<?php echo $emailsubject;?>">
 
	        <?php endif;?>
	        
	            <textarea name="message" rows="6" id="message"  placeholder="<?php echo JText::_('TPL_MOMENTUM_CONTACT_MESSAGE_TEXT');?>"></textarea>

	        
	        <?php if($sendascopy === '1') :?> 
	        
	            <label class="azura_checkbox-inline" for="sendascopy">
	            <input type="checkbox" value="1" id="sendascopy"  name="sendAsCopy">
	            <?php echo JText::_('TPL_MOMENTUM_SEND_AS_A_COPY_TEXT');?></label>
	            <div style="margin-bottom: 15px;"></div>
	        
	        <?php endif;?>


	        <?php
	        JPluginHelper::importPlugin('captcha');
	        $dispatcher = JEventDispatcher::getInstance();
	        $dispatcher->trigger('onInit','dynamic_recaptcha_1');
	        ?>
	        <div id="dynamic_recaptcha_1"></div>
			
			<input type="submit" class="submit btn outline" id="azurasubmit" value="<?php echo JText::_('TPL_MOMENTUM_CONTACT_SEND_MESSAGE_TEXT');?>" />

	    </fieldset>      

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