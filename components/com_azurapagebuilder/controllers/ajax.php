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

class AzuraPagebuilderControllerAjax extends JControllerLegacy {

	public function doLike(){
		//JSession::checkToken('post') or jexit(JText::_('JInvalid_Token'));

		$app = JFactory::getApplication();
		$input = $app->input;
		$pk = $input->getInt('id',0);
		$opt = $input->getString('opt',"com_azurapagebuilder");

		$user = JFactory::getUser();

		$userIP = $_SERVER['REMOTE_ADDR'];
		$return = array("info"=>'error',"msg"=>"unliked");
		if($pk > 0){

			$db    = JFactory::getDbo();
			$query = $db->getQuery(true);

			// Create the base select statement.
			$query->select('*')
				->from($db->quoteName('#__azurapagebuilder_likes'))
				->where($db->quoteName('pageID') . ' = ' . (int) $pk .' AND '.$db->quoteName('option') . ' = ' . $db->quote($opt));

			// Set the query and load the result.
			$db->setQuery($query);

			// Check for a database error.
			try
			{
				$like = $db->loadObject();
			}
			catch (RuntimeException $e)
			{
				//JError::raiseWarning(500, $e->getMessage());

				echo json_encode($return);
				exit();
			}

			// There are no likes yet, so lets insert our like
			if (!$like)
			{
				$query = $db->getQuery(true);


				$likedUsers = new JRegistry;
				$likedIPs = new JRegistry;
				

				if(!$user->guest){
					$likedUsers->loadArray(array($user->id));
					$likedIPs->loadArray(array());
				}else{
					$likedUsers->loadArray(array());
					$likedIPs->loadArray(array($userIP));
				}

				// Create the base insert statement.
				$query->insert($db->quoteName('#__azurapagebuilder_likes'))
					->columns(array($db->quoteName('pageID'), $db->quoteName('like_count'), $db->quoteName('likedUsers'), $db->quoteName('likedIPs'), $db->quoteName('option')))
					->values((int) $pk . ', 1, '.$db->quote($likedUsers->toString()).', '.$db->quote($likedIPs->toString()).', '.$db->quote($opt));
				// Set the query and execute the insert.
				$db->setQuery($query);

				try
				{
					$db->execute();
				}
				catch (RuntimeException $e)
				{
					//JError::raiseWarning(500, $e->getMessage());
					$return = array("info"=>'error',"msg"=>$e->getMessage());

					echo json_encode($return);
					exit();
				}

				$return = array("info"=>'success',"msg"=>"liked","like_count"=>1);
			}
			else
			{
				$likedUsers = new JRegistry;
				$likedIPs = new JRegistry;
				$likedUsers->loadString($like->likedUsers);
				$likedIPs->loadString($like->likedIPs);

				//$return = array("info"=>'success',"msg"=>$likedIPs->toString(),"like_count","1");


				if(!$user->guest){
					//$likedIPs_Arr = $likedIPs->toArray();
					$likedUsers_Arr = $likedUsers->toArray();
					$us_key = array_search($user->id, $likedUsers_Arr);
					if($us_key !== false){
						$query = $db->getQuery(true);

						unset($likedUsers_Arr[$us_key]);

						$likedUsers = new JRegistry;

						$likedUsers->loadArray($likedUsers_Arr);


						if($like->like_count == 1){
							$query->delete($db->quoteName('#__azurapagebuilder_likes'))
									->where($db->quoteName('pageID') . ' = ' . (int) $pk.' AND '.$db->quoteName('option') . ' = ' . $db->quote($opt));
						}else{
							// Create the base update statement.
							$query->update($db->quoteName('#__azurapagebuilder_likes'))
								 	->set($db->quoteName('like_count') . ' = like_count - 1')
									->set($db->quoteName('likedUsers') . ' = ' . $db->quote($likedUsers->toString()))
									->where($db->quoteName('pageID') . ' = ' . (int) $pk.' AND '.$db->quoteName('option') . ' = ' . $db->quote($opt));
						}

						// Set the query and execute the update.
						$db->setQuery($query);

						try
						{
							$db->execute();
						}
						catch (RuntimeException $e)
						{
							//JError::raiseWarning(500, $e->getMessage());

							$return = array("info"=>'error',"msg"=>$e->getMessage());

							echo json_encode($return);
							exit();
						}

						$return = array("info"=>'success',"msg"=>"unliked","like_count"=>($like->like_count -1));
					}else{
						$likedUsers_Arr[] = $user->id;
						$query = $db->getQuery(true);

						$likedUsers->loadArray($likedUsers_Arr);

						// Create the base update statement.
						$query->update($db->quoteName('#__azurapagebuilder_likes'))
							 	->set($db->quoteName('like_count') . ' = like_count + 1')
								->set($db->quoteName('likedUsers') . ' = ' . $db->quote($likedUsers->toString()))
								->where($db->quoteName('pageID') . ' = ' . (int) $pk.' AND '.$db->quoteName('option') . ' = ' . $db->quote($opt));

						// Set the query and execute the update.
						$db->setQuery($query);

						try
						{
							$db->execute();
						}
						catch (RuntimeException $e)
						{
							//JError::raiseWarning(500, $e->getMessage());

							$return = array("info"=>'error',"msg"=>$e->getMessage());

							echo json_encode($return);
							exit();
						}

						$return = array("info"=>'success',"msg"=>"liked","like_count"=>($like->like_count + 1));
					}
				}else{
					$likedIPs_Arr = $likedIPs->toArray();
					//$return = array("info"=>'success',"msg"=>json_encode($likedIPs_Arr),"like_count","1");
					$ip_key = array_search($userIP, $likedIPs_Arr);
					if($ip_key !== false){
						$query = $db->getQuery(true);

						unset($likedIPs_Arr[$ip_key]);

						$likedIPs = new JRegistry;

						$likedIPs->loadArray($likedIPs_Arr);

						if($like->like_count == 1){
							$query->delete($db->quoteName('#__azurapagebuilder_likes'))
									->where($db->quoteName('pageID') . ' = ' . (int) $pk.' AND '.$db->quoteName('option') . ' = ' . $db->quote($opt));
						}else{
							// Create the base update statement.
							$query->update($db->quoteName('#__azurapagebuilder_likes'))
								 	->set($db->quoteName('like_count') . ' = like_count - 1')
									->set($db->quoteName('likedIPs') . ' = ' . $db->quote($likedIPs->toString()))
									->where($db->quoteName('pageID') . ' = ' . (int) $pk.' AND '.$db->quoteName('option') . ' = ' . $db->quote($opt));
						}

						// Set the query and execute the update.
						$db->setQuery($query);

						try
						{
							$db->execute();
						}
						catch (RuntimeException $e)
						{
							//JError::raiseWarning(500, $e->getMessage());

							$return = array("info"=>'error',"msg"=>$e->getMessage());

							echo json_encode($return);
							exit();
						}

						$return = array("info"=>'success',"msg"=>"unliked","like_count"=>($like->like_count -1));
					}else{
						$likedIPs_Arr[] = $userIP;
						$query = $db->getQuery(true);

						$likedIPs->loadArray($likedIPs_Arr);

						// Create the base update statement.
						$query->update($db->quoteName('#__azurapagebuilder_likes'))
							 	->set($db->quoteName('like_count') . ' = like_count + 1')
								->set($db->quoteName('likedIPs') . ' = ' . $db->quote($likedIPs->toString()))
								->where($db->quoteName('pageID') . ' = ' . (int) $pk.' AND '.$db->quoteName('option') . ' = ' . $db->quote($opt));

						// Set the query and execute the update.
						$db->setQuery($query);

						try
						{
							$db->execute();
						}
						catch (RuntimeException $e)
						{
							//JError::raiseWarning(500, $e->getMessage());

							$return = array("info"=>'error',"msg"=>$e->getMessage());

							echo json_encode($return);
							exit();
						}

						$return = array("info"=>'success',"msg"=>"liked","like_count"=>($like->like_count + 1));
					}
				}
			}
		}

		echo json_encode($return);
		exit();
	}
}