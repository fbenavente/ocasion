<?php
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die();

class AzuraPagebuilderControllerContact extends JControllerLegacy {

	public function sendemail(){
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$app = JFactory::getApplication();
		$input = $app->input;

		$mailfrom	= $app->getCfg('mailfrom');
		$fromname	= $app->getCfg('fromname');

		$name		= $input->getString('name');
		$website		= $input->getString('website','');
		$email		= JStringPunycode::emailToPunycode($input->getString('email'));

		

		// Set up regular expression strings to evaluate the value of email variable against
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		// Run the preg_match() function on regex against the email address
		if (!preg_match($regex, $email)) {
		    echo json_encode(array("info"=>'error',"msg"=>JText::_('COM_AZURAPAGEBUILDER_INVALID_EMAIL_MESSSAGE')));
		    exit();
		}

		$imported = JPluginHelper::importPlugin('captcha');
		if($imported){
			$dispatcher = JEventDispatcher::getInstance();
			$result = $dispatcher->trigger('onCheckAnswer',$input->get('recaptcha_response_field','','string'));
			if(!$result[0]){
				echo json_encode(array("info"=>'error',"msg"=>JText::_('COM_AZURAPAGEBUILDER_CONTACT_ERROR_INVALID_CAPTCHA_CODE_TEXT')));	   
				exit();
			}
		}
		
		$body		= $input->getString('message');

		$receiveEmail = JStringPunycode::emailToPunycode($input->getString('receiveEmail'));
		$subject	= $input->getString('subject');
		$thanks	= $input->getString('thanks');

		// Prepare email body
		$prefix = JText::sprintf('COM_AZURAPAGEBUILDER_ENQUIRY_TEXT', JUri::base());
		$body	= $prefix."\n".$name.' <'.$email.'>'. ' '. $website. "\r\n\r\n".stripslashes($body);
		$body .= "\n".$thanks;

		$mail = JFactory::getMailer();

		$mail->addRecipient($receiveEmail);
		$mail->setSender(array($mailfrom, $fromname));
		$mail->setSubject($subject);
		$mail->setBody($body);
		$sent = $mail->Send();

		//If we are supposed to copy the sender, do so.

		// check whether email copy function activated
		if ($input->getInt('sendAsCopy') == '1')
		{
			$copytext		= JText::sprintf('COM_AZURAPAGEBUILDER_COPYTEXT_OF', $receiveEmail, $sitename);
			$copytext		.= "\r\n\r\n".$body."\n".$thanks;
			$copysubject	= JText::sprintf('COM_AZURAPAGEBUILDER_COPYSUBJECT_OF', $subject);

			$mail = JFactory::getMailer();
			$mail->addRecipient($email);
			$mail->setSender(array($mailfrom, $fromname));
			$mail->setSubject($copysubject);
			$mail->setBody($copytext);
			$sent = $mail->Send();
		}

		$mes = (string)$sent;
		if (!($sent instanceof Exception)){
			echo json_encode(array("info"=>'success',"msg"=>$thanks));
		}else{
			echo json_encode(array("info"=>'error',"msg"=>$mes));
		}
		exit();
	}

	public function subscribe(){
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$app = JFactory::getApplication();
		$input = $app->input;

		$mailfrom	= $app->getCfg('mailfrom');
		$fromname	= $app->getCfg('fromname');

		$name		= $input->getString('name','Your Name');
		$email		= JStringPunycode::emailToPunycode($input->getString('email'));

		

		// Set up regular expression strings to evaluate the value of email variable against
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		// Run the preg_match() function on regex against the email address
		if (!preg_match($regex, $email)) {
		    echo json_encode(array("info"=>'error',"msg"=>JText::_('COM_AZURAPAGEBUILDER_INVALID_EMAIL_MESSSAGE')));
		    exit();
		}

		$imported = JPluginHelper::importPlugin('captcha');
		if($imported){
			$dispatcher = JEventDispatcher::getInstance();
			$result = $dispatcher->trigger('onCheckAnswer',$input->get('recaptcha_response_field','','string'));
			if(!$result[0]){
				echo json_encode(array("info"=>'error',"msg"=>JText::_('COM_AZURAPAGEBUILDER_CONTACT_ERROR_INVALID_CAPTCHA_CODE_TEXT')));	   
				exit();
			}
		}

		$receiveEmail = JStringPunycode::emailToPunycode($input->getString('receiveEmail'));
		$subject	= $input->getString('subject');
		$thanks	= $input->getString('thanks');

		// Prepare email body
		$prefix = JText::sprintf('COM_AZURAPAGEBUILDER_ENQUIRY_TEXT', JUri::base());
		$body	= $prefix."\n".$name.' <'.$email.'>'. "\r\n\r\n".stripslashes($subject);

		$mail = JFactory::getMailer();

		$mail->addRecipient($receiveEmail);
		$mail->setSender(array($mailfrom, $fromname));
		$mail->setSubject($subject);
		$mail->setBody($body);
		$sent = $mail->Send();

		//If we are supposed to copy the sender, do so.

		// check whether email copy function activated
		if ($input->getInt('sendAsCopy') == '1')
		{
			$copytext		= JText::sprintf('COM_AZURAPAGEBUILDER_COPYTEXT_OF', $receiveEmail, $sitename);
			$copytext		.= "\r\n\r\n".$body;
			$copysubject	= JText::sprintf('COM_AZURAPAGEBUILDER_COPYSUBJECT_OF', $subject);

			$mail = JFactory::getMailer();
			$mail->addRecipient($email);
			$mail->setSender(array($mailfrom, $fromname));
			$mail->setSubject($copysubject);
			$mail->setBody($copytext);
			$sent = $mail->Send();
		}

		$mes = (string)$sent;
		if (!($sent instanceof Exception)){
			echo json_encode(array("info"=>'success',"msg"=>$thanks));
		}else{
			echo json_encode(array("info"=>'error',"msg"=>$mes));
		}
		exit();
	}

	public function calendar()
	{
		require_once (JPATH_SITE.DS.'administrator/components/com_azurapagebuilder/helpers/k2calendarhelper.php');
		
		$mainframe = JFactory::getApplication();
		$month = JRequest::getInt('month');
		$year = JRequest::getInt('year');
		$months = array(JText::_('K2_JANUARY'), JText::_('K2_FEBRUARY'), JText::_('K2_MARCH'), JText::_('K2_APRIL'), JText::_('K2_MAY'), JText::_('K2_JUNE'), JText::_('K2_JULY'), JText::_('K2_AUGUST'), JText::_('K2_SEPTEMBER'), JText::_('K2_OCTOBER'), JText::_('K2_NOVEMBER'), JText::_('K2_DECEMBER'), );
		$days = array(JText::_('CTH_K2_SUN'),JText::_('CTH_K2_MON'),JText::_('CTH_K2_TUE'),JText::_('CTH_K2_WED'),JText::_('CTH_K2_THU'),JText::_('CTH_K2_FRI'),JText::_('CTH_K2_SAT'));
		$cal = new CTHCalendar;
		$cal->setMonthNames($months);
		$cal->setDayNames($days);
		$cal->category = JRequest::getInt('catid');
		$cal->setStartDay(1);
		if (($month) && ($year))
		{
			echo $cal->getMonthView($month, $year);
		}
		else
		{
			echo $cal->getCurrentMonthView();
		}
		$mainframe->close();
	}
}