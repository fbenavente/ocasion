<?php
defined('_JEXEC') or die;

/**
* AzuraJs
*/
class AzuraJs
{
	
	private static $scripts = array();

	public static function addScript($name,$style = true){
		if(isset($scripts[$name]) && $scripts[$name ]=== true){
			return;
		}else{
			if(method_exists(self, 'include'.$name.'Script')){
				$funcName = 'include'.ucfirst($name).'Script';
				self::$funcName();
				$scripts[$name] = true;
			}
		}
	}

	public static function includeGmapScript(){
		$doc = JFactory::getDocument();
		$doc->addScript('http://maps.google.com/maps/api/js?sensor=false');
		$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/plugins/gmap3/gmap3.min.js');
	}
}