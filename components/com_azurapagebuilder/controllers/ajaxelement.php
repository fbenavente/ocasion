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

class AzuraPagebuilderControllerAjaxElement extends JControllerLegacy {

	public function login(){

		JSession::checkToken('post') or jexit(JText::_('JInvalid_Token'));

		$app    = JFactory::getApplication();
		$input  = $app->input;
		$method = $input->getMethod();

		// Populate the data array:
		$data = array();

		$data['return']    = base64_decode($app->input->post->get('return', '', 'BASE64'));
		$data['returnfalse']    = base64_decode($app->input->post->get('returnfalse', '', 'BASE64'));
		$data['username']  = $input->$method->get('username', '', 'USERNAME');
		$data['password']  = $input->$method->get('password', '', 'RAW');
		$data['secretkey'] = $input->$method->get('secretkey', '', 'RAW');

		// Set the return URL if empty.
		if (empty($data['return']))
		{
			$data['return'] = 'index.php?option=com_users&view=profile';
		}

		// Set the return URL in the user state to allow modification by plugins
		$app->setUserState('users.login.form.return', $data['return']);

		// Get the log in options.
		$options = array();
		$options['remember'] = $input->getBool('remember', false);
		$options['return']   = $data['return'];

		// Get the log in credentials.
		$credentials = array();
		$credentials['username']  = $data['username'];
		$credentials['password']  = $data['password'];
		$credentials['secretkey'] = $data['secretkey'];

		// Perform the log in.
		if (true === $app->login($credentials, $options))
		{
			// Success
			if ($options['remember'] == true)
			{
				$app->setUserState('rememberLogin', true);
			}
			$app->setUserState('users.login.form.data', array());
			$app->redirect(JRoute::_($app->getUserState('users.login.form.return'), false));
			//echo json_encode(array("info"=>'success',"msg"=>JText::_('COM_AZURAPAGEBUILDER_LOGIN_SUSSCES_MESSAGE'),"returnurl"=>$data['return']));
		}
		else
		{
			// Login failed !
			$data['remember'] = (int) $options['remember'];
			$app->setUserState('users.login.form.data', $data);
			//$app->redirect(JRoute::_('index.php?option=com_users&view=login', false));
			$app->redirect(JRoute::_($data['returnfalse'], false));
			//echo json_encode(array("info"=>'error',"msg"=>JText::_('COM_AZURAPAGEBUILDER_LOGIN_SUSSCES_FAIL')));
		}

		//exit();
	}
}