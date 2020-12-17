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
jimport('joomla.filesystem.file');

require_once JPATH_COMPONENT_ADMINISTRATOR.'/helpers/azuraelements.php';

class AzuraPagebuilderControllerPageTemplate extends JControllerLegacy
{
	private static $eles = null;

	public function __construct($config = array())
	{

		JForm::addFieldPath(JPATH_ROOT.'/administrator/components/com_azurapagebuilder/models/fields');
		JForm::addFieldPath(JPATH_ROOT.'/administrator/components/com_content/models/fields');
		JForm::addFieldPath(JPATH_ROOT.'/administrator/components/com_k2/elements');
		//JForm::addFormPath(JPATH_ROOT.'/templates/protostar/html/com_azurapagebuilder/forms');
		JForm::addFormPath(JPATH_ROOT.'/administrator/components/com_azurapagebuilder/models/forms');
		JForm::addFormPath(JPATH_THEMES.'/'.JFactory::getApplication()->getTemplate().'/html/com_azurapagebuilder/forms');
		require_once JPATH_ROOT.'/administrator/components/com_azurapagebuilder/helpers/azuraelements.php';
		AzuraElements::loadElements(false);
		AzuraElements::loadElements(true);
		parent::__construct();
	}

	public function save(){
		$fname = $this->input->getString('name','');
		$data = $this->input->get('data','','raw');


		$result = array();
		$result['info'] = 'error';
		$result['msg'] = 'The template name is not empty. Please check';
		if(!empty($fname)){
			$pageData = new stdClass;
			$pageData->templatename = $fname;
			$pageData->pagecontent = $data;

			$regex = '#[^A-Za-z0-9\_]#';

			$name = strtolower(preg_replace($regex, '', str_replace(" ", "_", $fname)));
			

			$pageTemplateFolder = JPath::clean(JPATH_COMPONENT_ADMINISTRATOR.'/pagetemplates/');

			if (file_exists(JPath::clean($pageTemplateFolder . '/' . $name . '.php')))
			{
				$result['msg'] = 'Template name exist';

				echo json_encode($result);

				exit();

				//return false;
			}

			$pageData->savename = $name;
			$pageData = rawurlencode(json_encode($pageData));

			// create new template file
			$file = fopen(JPath::clean($pageTemplateFolder . '/' . $name . '.php'), 'x');

			if (!$file)
			{
				$result['msg'] = 'There is an error on creating template file. Please check.';

				//echo json_encode($result);

				//exit();
			}else{
				$write = fwrite($file,$pageData);

				if(!$write){

					$result['msg'] = 'There is an error on writing page template data. Please check.';

					//echo json_encode($result);

					//fclose($file);

				}else{
					$result['info'] = 'success';
					$result['msg'] = 'Page template saved.';

					$result['templatename'] = $fname;
					$result['savename'] = $name;
					//echo json_encode($result);

					

				}	

				
			}

			fclose($file);

			echo json_encode($result);

		}else{
			echo json_encode($result);
		}

		exit();
	}

	public function delete(){
		$savename = $this->input->getString('name','');


		$result = array();
		$result['info'] = 'error';
		$result['msg'] = 'The page template name is empty. Please check!';

		if(!empty($savename)){
			
			$pageTemplateFolder = JPath::clean(JPATH_COMPONENT_ADMINISTRATOR.'/pagetemplates/');

			if (file_exists(JPath::clean($pageTemplateFolder . '/' . $savename . '.php')))
			{
				if(!JFile::delete(JPath::clean($pageTemplateFolder . '/' . $savename . '.php'))){
					$result['msg'] = 'Error on deleting the page template file!';
				}else{
					$result['info'] = 'success'; 
					$result['msg'] = 'The page template deleted!';
				}
			}else{
				$result['msg'] = "The page template does not not exist!";
			}

			echo json_encode($result);

		}else{
			echo json_encode($result);
		}

		//echo json_encode($result);

		exit();
	}

	public function append(){
		$savename = $this->input->getString('name','');


		// $result = array();
		// $result['info'] = 'error';
		// $result['msg'] = 'The page template name is empty. Please check!';

		$result = false;

		if(!empty($savename)){
			
			$pageTemplateFolder = JPath::clean(JPATH_COMPONENT_ADMINISTRATOR.'/pagetemplates/');

			if (file_exists(JPath::clean($pageTemplateFolder . '/' . $savename . '.php')))
			{
				$tempContent = JFile::read($pageTemplateFolder.'/'.$savename . '.php');
	        	if($tempContent !== false){
	        		$tempContent = json_decode(rawurldecode($tempContent));

	        		$result = '';

	        		$pageSections = json_decode(rawurldecode($tempContent->pagecontent));

	        		
					if(count($pageSections)){
						foreach ($pageSections as $key => $row) {
							$result .= self::parseElement($row);
						}
					}
	        		
	        	}
			}
		}

		echo $result;

		exit();
	}

	// Section template
	public function saveSec(){
		$fname = $this->input->getString('name','');
		$data = $this->input->get('data','','raw');


		$result = array();
		$result['info'] = 'error';
		$result['msg'] = 'The template name is not empty. Please check';
		if(!empty($fname)){
			$pageData = new stdClass;
			$pageData->templatename = $fname;
			$pageData->pagecontent = $data;

			$regex = '#[^A-Za-z0-9\_]#';

			$name = strtolower(preg_replace($regex, '', str_replace(" ", "_", $fname)));
			

			$pageTemplateFolder = JPath::clean(JPATH_COMPONENT_ADMINISTRATOR.'/sectemplates/');

			if (file_exists(JPath::clean($pageTemplateFolder . '/' . $name . '.php')))
			{
				$result['msg'] = 'Template name exist';

				echo json_encode($result);

				exit();

				//return false;
			}

			$pageData->savename = $name;
			$pageData = rawurlencode(json_encode($pageData));

			// create new template file
			$file = fopen(JPath::clean($pageTemplateFolder . '/' . $name . '.php'), 'x');

			if (!$file)
			{
				$result['msg'] = 'There is an error on creating template file. Please check.';

				//echo json_encode($result);

				//exit();
			}else{
				$write = fwrite($file,$pageData);

				if(!$write){

					$result['msg'] = 'There is an error on writing section template data. Please check.';

					//echo json_encode($result);

					//fclose($file);

				}else{
					$result['info'] = 'success';
					$result['msg'] = 'section template saved.';

					$result['templatename'] = $fname;
					$result['savename'] = $name;
					//echo json_encode($result);

					

				}	

				
			}

			fclose($file);

			echo json_encode($result);

		}else{
			echo json_encode($result);
		}

		exit();
	}

	public function deleteSec(){
		$savename = $this->input->getString('name','');


		$result = array();
		$result['info'] = 'error';
		$result['msg'] = 'The section template name is empty. Please check!';

		if(!empty($savename)){
			
			$pageTemplateFolder = JPath::clean(JPATH_COMPONENT_ADMINISTRATOR.'/sectemplates/');

			if (file_exists(JPath::clean($pageTemplateFolder . '/' . $savename . '.php')))
			{
				if(!JFile::delete(JPath::clean($pageTemplateFolder . '/' . $savename . '.php'))){
					$result['msg'] = 'Error on deleting the section template file!';
				}else{
					$result['info'] = 'success'; 
					$result['msg'] = 'The section template deleted!';
				}
			}else{
				$result['msg'] = "The section template does not not exist!";
			}

			echo json_encode($result);

		}else{
			echo json_encode($result);
		}

		//echo json_encode($result);

		exit();
	}

	public function appendSec(){
		$savename = $this->input->getString('name','');


		// $result = array();
		// $result['info'] = 'error';
		// $result['msg'] = 'The page template name is empty. Please check!';

		$result = false;

		if(!empty($savename)){
			
			$pageTemplateFolder = JPath::clean(JPATH_COMPONENT_ADMINISTRATOR.'/sectemplates/');

			if (file_exists(JPath::clean($pageTemplateFolder . '/' . $savename . '.php')))
			{
				$tempContent = JFile::read($pageTemplateFolder.'/'.$savename . '.php');
	        	if($tempContent !== false){
	        		$tempContent = json_decode(rawurldecode($tempContent));

	        		$result = '';

	        		$pageSections = json_decode(rawurldecode($tempContent->pagecontent));

	        		//echo json_encode($pageSections);exit;
	        		
					//if(count($pageSections)){
						//foreach ($pageSections as $key => $row) {
							$result .= self::parseElement($pageSections);
						//}
					//}
	        		
	        	}
			}
		}

		echo $result;

		exit();
	}

	private static function parseElement($element){

		$azuraelements = AzuraElements::getElements(true);

		self::$eles = $azuraelements;

		if($element->type === 'AzuraRow'){

			return self::parseRowElement($element);
			
		}elseif(isset($element->ispagesection)&&$element->ispagesection === true){
			return self::parsePageSection($element);
		}elseif(isset($element->ispagesectionitem)&&$element->ispagesectionitem === true){
			return self::parsePageSectionItem($element);
		}elseif($element->type === 'AzuraColumn'){
			return self::parseColumnElement($element);
		}elseif($element->type === 'AzuraContainer'){
			return self::parseContainerElement($element);
		}else{
			$elementNames = array_keys($azuraelements);

			if(in_array($element->type, $elementNames)){
				//die('has a element in this array');
				if ($azuraelements[$element->type]->hasownchild === 'no') {
					if($azuraelements[$element->type]->isownchild === 'yes'){
						return self::parseDefaultIsChildElement($element);
						//require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/default-ischild.php'); 
					}else{
						return self::parseDefaultElement($element);
						//require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/default.php'); 
					}
				}else{
					return self::parseDefaultHasChildElement($element);
					//require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/default-haschild.php'); 
				}
			}
		} 
	}

	private static function parseRowElement($element){
		$html = array();
		$html[] = '<div class="azura-element-block pagebuilder-section" data-typeName="'.$element->type.'">';
			$html[] = '<div class="section-header clearfix">';
				$html[] = '<div class="pull-left">';
					$html[] = '<a class="move-icon" href="javascript:void(0)"><i class="fa fa-arrows"></i></a>';
					$html[] = '<div class="azura-row-layout">';
						$html[] = '<a class="columns-layout" href="javascript:void(0)"><i class="fa fa-plus"></i> Add Columns</a>';
						$html[] = '<ul>';
							$html[] = '<li><a class="set-width l_1" data-layout="11" href="#" title="1"></a></li>';
							$html[] = '<li><a class="set-width l_12_12" href="#" data-layout="12_12" title="1/2+1/2"></a></li>';
							$html[] = '<li><a class="set-width l_23_13" href="#" data-layout="23_13" title="2/3+1/3"></a></li>';
							$html[] = '<li><a class="set-width l_13_13_13" href="#" data-layout="13_13_13" title="1/3+1/3+1/3"></a></li>';
							$html[] = '<li><a class="set-width l_14_14_14_14" href="#" data-layout="14_14_14_14" title="1/4+1/4+1/4+1/4"></a></li>';
							$html[] = '<li><a class="set-width l_14_34" href="#" data-layout="14_34" title="1/4+3/4"></a></li>';
							$html[] = '<li><a class="set-width l_14_12_14" href="#" data-layout="14_12_14" title="1/4+1/2+1/4"></a></li>';
							$html[] = '<li><a class="set-width l_56_16" href="#" data-layout="56_16" title="5/6+1/6"></a></li>';
							$html[] = '<li><a class="set-width l_16_16_16_16_16_16" data-layout="16_16_16_16_16_16" href="#" title="1/6+1/6+1/6+1/6+1/6+1/6"></a></li>';
							$html[] = '<li><a class="set-width l_16_46_16" data-layout="16_46_16" href="#" title="1/6+4/6+1/6"></a></li>';
							$html[] = '<li><a class="set-width l_16_16_16_12" data-layout="16_16_16_12" href="#" title="1/6+1/6+1/6+1/2"></a></li>';
							$html[] = '<li class="custom">';
								$html[] = '<ul>';
									$html[] = '<li>Custom Layout</li>';
									$html[] = '<li>&nbsp;&nbsp;&nbsp;<input type="text" class="set-width-column inputbox" placeholder="5/12+7/12"></li>';
									$html[] = '<li>&nbsp;&nbsp;&nbsp;<button class="btn btn-small set-width-custom-button">Set</button></li>';
								$html[] = '</ul>';
							$html[] = '</li>';
						$html[] = '</ul>';
						
					$html[] = '</div>';
					$html[] = '<a class="row-add-new-col" href="javascript:void(0)" title="Add New Column"><i class="fa fa-plus"></i></a>';
					$html[] = '<div class="azura-row-title">'. (!empty($element->name)? $element->name : '') .'</div>';
				$html[] = '</div>';
				
				
				$html[] = '<div class="azura-element-tools pull-right">';

					$html[] = '<a href="javascript:void(0)" class="row-showhide"><i class="fa fa-chevron-up"></i></a>';
					$html[] = '<a href="javascript:void(0)" class="row-configs"><i class="fa fa-cog"></i></a>';
					$html[] = '<a  href="javascript:void(0)" class="row-duplicate"><i class="fa fa-copy"></i></a>';
					$html[] = '<a  href="javascript:void(0)" class="row-delete"><i class="fa fa-times"></i></a>';
					
				$html[] = '</div>';

			$html[] = '</div>';

			$html[] = '<div class="azura-element-type-'.strtolower($element->type).'-container row">';
			
			if(count($element->children)) {

				foreach ($element->children as $child) {
					$html[] = self::parseElement($child);
				}

			}else{

				$html[] = '<div class="column-parent col-md-12"  data-typeName="AzuraColumn">';
					$html[] = '<div class="column-wrapper">';
						$html[] = '<div class="col-settings">';
		                    $html[] = '<a class="col-tools-name" href="javascript:void(0);">Column Tools</a>';
		                    $html[] = '<a class="add-container" href="javascript:void(0)" title="Add Container element"><i class="fa fa-plus-circle"></i></a>';
		                    $html[] = '<a class="add-element" href="javascript:void(0)" title="Add elements"><i class="fa fa-plus-circle"></i></a>';
		                    $html[] = '<a class="column-configs" href="javascript:void(0)" title="Config"><i class="fa fa-cog"></i></a>';
		                    $html[] = '<a class="column-duplicate" href="javascript:void(0)" title="Copy Column"><i class="fa fa-copy"></i></a>';
		                    $html[] = '<a class="column-delete" href="javascript:void(0)" title="Delete Column"><i class="fa fa-times"></i></a>';

		                $html[] = '</div>';
		                $html[] = '<div class="clearfix"></div>';

						$html[] = '<div class="column"></div>';
					$html[] = '</div>';

					$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode('{"type":"AzuraColumn","id": "0","published":"1","language":"*", "content":"","attrs":{"columnwidthclass":"col-md-12"}}').'"></div>';
				$html[] = '</div>';

			} 


			$html[] = '</div>';

			$storedData = $element;
			unset($storedData->children);


			$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode(json_encode($storedData)).'"></div>';

		$html[] = '</div>';


		return implode("\n", $html);
	}

	private static function parsePageSection($element){
		$html = array();

		$html[] = '<div class="azura-element-block pagebuilder-section pagesection" data-typeName="'.$element->type.'">';
			$html[] = '<div class="section-header clearfix">';
				$html[] = '<div class="pull-left">';
					$html[] = '<a class="move-icon" href="javascript:void(0)"><i class="fa fa-arrows"></i></a>';
				if($element->hasonechild === 'no'&& $element->hasownchild === 'yes') :

					$html[] = '<div class="azura-row-layout">';
						$html[] = '<a class="columns-layout" href="javascript:void(0)"><i class="fa fa-plus"></i> Section Layout</a>';
						$html[] = '<ul>';
							$html[] = '<li><a class="sec-set-width l_1" data-layout="11" href="#" title="1"></a></li>';
							$html[] = '<li><a class="sec-set-width l_12_12" href="#" data-layout="12_12" title="1/2+1/2"></a></li>';
							$html[] = '<li><a class="sec-set-width l_23_13" href="#" data-layout="23_13" title="2/3+1/3"></a></li>';
							$html[] = '<li><a class="sec-set-width l_13_13_13" href="#" data-layout="13_13_13" title="1/3+1/3+1/3"></a></li>';
							$html[] = '<li><a class="sec-set-width l_14_14_14_14" href="#" data-layout="14_14_14_14" title="1/4+1/4+1/4+1/4"></a></li>';
							$html[] = '<li><a class="sec-set-width l_14_34" href="#" data-layout="14_34" title="1/4+3/4"></a></li>';
							$html[] = '<li><a class="sec-set-width l_14_12_14" href="#" data-layout="14_12_14" title="1/4+1/2+1/4"></a></li>';
							$html[] = '<li><a class="sec-set-width l_56_16" href="#" data-layout="56_16" title="5/6+1/6"></a></li>';
							$html[] = '<li><a class="sec-set-width l_16_16_16_16_16_16" data-layout="16_16_16_16_16_16" href="#" title="1/6+1/6+1/6+1/6+1/6+1/6"></a></li>';
							$html[] = '<li><a class="sec-set-width l_16_46_16" data-layout="16_46_16" href="#" title="1/6+4/6+1/6"></a></li>';
							$html[] = '<li><a class="sec-set-width l_16_16_16_12" data-layout="16_16_16_12" href="#" title="1/6+1/6+1/6+1/2"></a></li>';
							$html[] = '<!-- <li class="custom">';
								$html[] = '<ul>';
									$html[] = '<li>Custom Layout</li>';
									$html[] = '<li>&nbsp;&nbsp;&nbsp;<input type="text" class="set-width-column inputbox" placeholder="5/12+7/12"></li>';
									$html[] = '<li>&nbsp;&nbsp;&nbsp;<button class="btn btn-small set-width-custom-button">Set</button></li>';
								$html[] = '</ul>';
							$html[] = '</li> -->';
						$html[] = '</ul>';
						
					$html[] = '</div>';

				endif;

					$html[] = '<div class="azura-row-title">'.(!empty($element->name)? $element->name : '').'</div>';
				$html[] = '</div>';
				
				
				$html[] = '<div class="azura-element-tools pull-right">';
					$html[] = '<a href="javascript:void(0)" class="row-showhide"><i class="fa fa-chevron-up"></i></a>';
					$html[] = '<a href="javascript:void(0)" class="row-configs"><i class="fa fa-cog"></i></a>';
					$html[] = '<a  href="javascript:void(0)" class="row-duplicate"><i class="fa fa-copy"></i></a>';
					$html[] = '<a  href="javascript:void(0)" class="row-delete"><i class="fa fa-times"></i></a>';
					
				$html[] = '</div>';

			$html[] = '</div>';

			$html[] = '<div class="row">';

			if($element->hasownchild === 'yes') :

				if(count($element->children)) {
					foreach ($element->children as $child) {
						$html[] = self::parseElement($child);
					}
				}else{ 
					$html[] = '<div class="column-parent pagesection col-md-12"  data-typeName="'.$element->childtypename.'">';
						$html[] = '<div class="section-item">';
		                    $html[] = '<h3>Section Item</h3>';

		                    $html[] = '<div class="azura-element-tools">';
		                        $html[] = '<a href="javascrip:void(0)" class="sec-child-configs"><i class="fa fa-pencil"></i></a>';
		                        $html[] = '<a href="javascrip:void(0)" class="sec-child-copy"><i class="fa fa-copy"></i></a>';
		                        $html[] = '<a href="javascrip:void(0)" class="sec-child-remove"><i class="fa fa-times"></i></a>';
		                    $html[] = '</div>';

		                $html[] = '</div>';

		                $html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode('{"type":"'.$element->childtypename.'","ispagesectionitem": true ,"parenttypename": "'.$element->type.'","id": "0","published":"1","language":"*", "content":"","attrs":{"columnwidthclass":"col-md-12"}}').'"></div>';
					$html[] = '</div>';
				} 

			endif;

			$html[] = '</div>';
			
			$storedData = $element;
			unset($storedData->children); 

			$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode(json_encode($storedData)).'"></div>';

		$html[] = '</div>';

		return implode("\n", $html);
	}

	private static function parsePageSectionItem($element){
		$html = array();

		$html[] = '<div class="column-parent pagesection '.(!empty($element->attrs->columnwidthclass)? $element->attrs->columnwidthclass : 'col-md-12').'"  data-typeName="'.$element->type.'">';
			$html[] = '<div class="section-item">';
		        $html[] = '<h3>'.(!empty($element->name)? $element->name : "Section Item").'</h3>';

		        $html[] = '<div class="azura-element-tools">';
		            $html[] = '<a href="javascrip:void(0)" class="sec-child-configs"><i class="fa fa-pencil"></i></a>';
		            $html[] = '<a href="javascrip:void(0)" class="sec-child-copy"><i class="fa fa-copy"></i></a>';
		            $html[] = '<a href="javascrip:void(0)" class="sec-child-remove"><i class="fa fa-times"></i></a>';
		        $html[] = '</div>';

		    $html[] = '</div>';

			$storedData = $element;
			unset($storedData->children); 

			$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode(json_encode($storedData)).'"></div>';
		$html[] = '</div>';

		return implode("\n", $html);
	}

	private static function parseColumnElement($element){
		$html = array();

		$html[] = '<div class="column-parent '.(!empty($element->attrs->columnwidthclass)? $element->attrs->columnwidthclass : 'col-md-12').(isset($element->attrs->smoffsetclass)? ' '.$element->attrs->smoffsetclass : ' col-sm-offset-0').(isset($element->attrs->mdwidthclass)? ' '.$element->attrs->mdwidthclass : '').(isset($element->attrs->lgwidthclass)? ' '.$element->attrs->lgwidthclass : '').'"  data-typeName="AzuraColumn">';
			$html[] = '<div class="column-wrapper">';
				$html[] = '<div class="col-name">';
					$html[] = '<span>'.(!empty($element->name)? $element->name : '') .'</span>';
				$html[] = '</div>';
				$html[] = '<div class="col-settings">';
	                $html[] = '<a class="col-tools-name" href="javascript:void(0);">Column Tools</a>';
	                $html[] = '<a class="add-container" href="javascript:void(0)" title="Add Container element"><i class="fa fa-plus-circle"></i></a>';
	                $html[] = '<a class="add-element" href="javascript:void(0)" title="Add elements"><i class="fa fa-plus-circle"></i></a>';
	                $html[] = '<a class="column-configs" href="javascript:void(0)" title="Config"><i class="fa fa-cog"></i></a>';
	                $html[] = '<a class="column-duplicate" href="javascript:void(0)" title="Copy Column"><i class="fa fa-copy"></i></a>';
	                $html[] = '<a class="column-delete" href="javascript:void(0)" title="Delete Column"><i class="fa fa-times"></i></a>';

	            $html[] = '</div>';
	            $html[] = '<div class="clearfix"></div>';
	            
				$html[] = '<div class="column">';

				if(count($element->children)) {
					foreach ($element->children as $child) {
						$html[] = self::parseElement($child);
					}
				}
				$html[] = '</div>';

			$html[] = '</div>';
			
			$storedData = $element;
			unset($storedData->children);


			$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode(json_encode($storedData)).'"></div>';
		$html[] = '</div>';

		return implode("\n", $html);
	}

	private static function parseContainerElement($element){
		$html = array();

		$html[] = '<div class="azura-element iscontainer"  data-typeName="AzuraContainer">';
			$html[] = '<div class="azura-element-wrapper azura-element-type-azuracontainer clearfix">';
		        $html[] = '<div class="azura-element-tools">';
			        $html[] = '<a href="javascrip:void(0)" class="container-addele"><i class="fa fa-plus"></i></a>';
			        $html[] = '<a href="javascrip:void(0)" class="element-configs"><i class="fa fa-pencil"></i></a>';
			        $html[] = '<a href="javascrip:void(0)" class="element-copy"><i class="fa fa-copy"></i></a>';
			        $html[] = '<a href="javascrip:void(0)" class="element-remove"><i class="fa fa-times"></i></a>';
		        $html[] = '</div>';
		    $html[] = '</div>';
		    $html[] = '<div class="azura-elements-container">';
			if(count($element->children)) {
				foreach ($element->children as $child) {
					$html[] = self::parseElement($child);
				}
			}
			$html[] = '</div>';

			$storedData = $element;
			unset($storedData->children);

			$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode(json_encode($storedData)).'"></div>';
		$html[] = '</div>';

		return implode("\n", $html);
	}

	private static function parseDefaultElement($element){
		$html = array();

		$html[] = '<div class="azura-element" data-typeName="'.$element->type.'">';
			$html[] = '<div class="azura-element-wrapper azura-element-type-'.strtolower($element->type).' clearfix">';
				$html[] = '<img class="element-icon" src="'.JURI::root(true).'/media/com_azurapagebuilder/elements-icon/'. strtolower(substr($element->type, 5)).'-icon.png" alt="'.strtolower(substr($element->type, 5)).'" width="24" height="24">';
				
				$html[] = '<h3>'.self::$eles[$element->type]->name.(!empty($element->name)? ' - '.$element->name : '').'</h3>';
				$html[] = '<div class="azura-element-tools">';
					$html[] = '<a href="javascrip:void(0)" class="element-configs"><i class="fa fa-pencil"></i></a>';
					$html[] = '<a href="javascrip:void(0)" class="element-copy"><i class="fa fa-copy"></i></a>';
					$html[] = '<a href="javascrip:void(0)" class="element-remove"><i class="fa fa-times"></i></a>';
				$html[] = '</div>';

			$html[] = '</div>';

			$storedData = $element;
			unset($storedData->children);

			$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode(json_encode($storedData)).'"></div>';
			
		$html[] = '</div>';

		return implode("\n", $html);
	}


	private static function parseDefaultHasChildElement($element){
		$html = array();

		$html[] = '<div class="azura-element" data-typeName="'.$element->type.'">';
			$html[] = '<div class="azura-element-wrapper azura-element-type-'.strtolower($element->type).' clearfix">';
				$html[] = '<img class="element-icon" src="'.JURI::root(true).'/media/com_azurapagebuilder/elements-icon/'. strtolower(substr($element->type, 5)).'-icon.png" alt="'.strtolower(substr($element->type, 5)).'" width="24" height="24">';
				
				$html[] = '<h3>'.self::$eles[$element->type]->name.(!empty($element->name)? ' - '.$element->name : '').'</h3>';
				$html[] = '<div class="azura-element-tools">';
					$html[] = '<a href="javascrip:void(0)" class="element-configs"><i class="fa fa-pencil"></i></a>';
					$html[] = '<a href="javascrip:void(0)" class="element-copy"><i class="fa fa-copy"></i></a>';
					$html[] = '<a href="javascrip:void(0)" class="element-remove"><i class="fa fa-times"></i></a>';
				$html[] = '</div>';

			$html[] = '</div>';

			$html[] = '<div class="azura-element-children">';

			if(count($element->children)) {
				foreach ($element->children as $child) {
					$html[] = self::parseElement($child);
				}
			}else{

				$html[] = '<div class="azura-element-child" data-typeName="'.self::$eles[$element->type]->childtypename.'">';
					$html[] = '<div class="azura-element-wrapper azura-element-type-'.strtolower(self::$eles[$element->type]->childtypename).' clearfix">';
						$html[] = '<h3>'.self::$eles[$element->type]->childname.'</h3>';
						
						$html[] = '<div class="azura-element-tools">';
							$html[] = '<a href="javascrip:void(0)" class="element-child-configs"><i class="fa fa-pencil"></i></a>';
							$html[] = '<a href="javascrip:void(0)" class="element-child-copy"><i class="fa fa-copy"></i></a>';
							$html[] = '<a href="javascrip:void(0)" class="element-child-remove"><i class="fa fa-times"></i></a>';
						$html[] = '</div>';

					$html[] = '</div>';
					$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode('{"type":"'.self::$eles[$element->type]->childtypename.'","id": "0","published":"1","language":"*", "content":"","attrs":{}}').'"></div>';
				$html[] = '</div>';

			}
			$html[] = '</div>';

			$storedData = $element;
			
			$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode(json_encode($storedData)).'"></div>';
			
		$html[] = '</div>';

		return implode("\n", $html);
	}

	private static function parseDefaultIsChildElement($element){
		$html = array();

		$html[] = '<div class="azura-element-child" data-typeName="'.$element->type.'">';
			$html[] = '<div class="azura-element-wrapper azura-element-type-'.strtolower($element->type).' clearfix">';
				
			if(!empty($element->name)):
				$html[] = '<h3>'.$element->name.'</h3>';
			else :
				$html[] = '<h3>'.self::$eles[$element->type]->name.'</h3>';

			endif; 

				$html[] = '<div class="azura-element-tools">';
					$html[] = '<a href="javascrip:void(0)" class="element-child-configs"><i class="fa fa-pencil"></i></a>';
					$html[] = '<a href="javascrip:void(0)" class="element-child-copy"><i class="fa fa-copy"></i></a>';
					$html[] = '<a href="javascrip:void(0)" class="element-child-remove"><i class="fa fa-times"></i></a>';
				$html[] = '</div>';

			$html[] = '</div>';

			$storedData = $element;
			unset($storedData->children);

			$html[] = '<div class="azura-element-settings-saved saved" data="'.rawurlencode(json_encode($storedData)).'"></div>';
			
		$html[] = '</div>';

		return implode("\n", $html);
	}
	
}


