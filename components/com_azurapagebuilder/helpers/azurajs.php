<?php
defined('_JEXEC') or die;

/**
* AzuraJs
*/
class AzuraJs
{
	
	private static $scripts = array();
	private static $styles = array();
	private static $datas = array();
	private static $pageScript = '';
	//private static $pageStyle = '';

	public static function addJScript($name, $script = false, $defer = true, $async = false, $ver = AZURA_VERSION){
		self::$scripts[$name]['script'] = trim($script);
		self::$scripts[$name]['defer'] = $defer;
		self::$scripts[$name]['async'] = $async;
		self::$scripts[$name]['ver'] = $ver;
		self::$scripts[$name]['added'] = false;
	}

	public static function addPageScript($script){
		self::$pageScript .= $script;
	}

	public static function writePageScript(){
		return self::$pageScript;
	}

	// public static function addPageStyle($style){
	// 	self::$pageStyle .= $style;
	// }

	// public static function getPageStyle(){
	// 	return self::$pageStyle;
	// }

	public static function setData($name, $val){
		self::$datas[$name] = $val;
	}

	public static function getData($name){
		if(isset(self::$datas[$name])){
			return self::$datas[$name];
		}else{
			return false;
		}
	}

	public static function writeJScripts(){

		$html = '';
		foreach(self::$scripts as $name => &$js){
			if($js['added']) continue;
			if(!$js['script'] or strpos($js['script'],'/')===0 or strpos($js['script'],'http://')===0 and strpos($js['script'],'//<![CDATA[')!==0){

				if(!$js['script']){
					$file = $name;
				} else {
					$file = $js['script'];
				}

				if(strpos($file,'http://') === 0){
					$file = $file;
				}else if(strpos($file,'/')!==0){
					$file = self::setPath($file,false,'');
				}else  if(strpos($file,'//')!==0){
					$file = JURI::root(true).$file;
				}
				$ver = '';
				if(!empty($js['ver'])) $ver = '?azuraver='.$js['ver'];
				$document = JFactory::getDocument();
				$document->addScript( $file.$ver);
			}

			$html .= chr(13);
			$js['added'] = true;
		}
		return $html;
	}

	public static function setPath( $namespace ,$path = FALSE ,$version='' ,$minified = NULL , $ext = 'js', $absolute_path=false)
	{

		$version = $version ? '.'.$version : '';
		$min	 = $minified ? '.min' : '';
		$file 	 = $namespace.$version.$min.'.'.$ext ;

		return $file ;
	}

	public static function getScripts(){
		return self::$scripts;
	}

	public static function addStyle($name, $style = false, $ver = AZURA_VERSION){
		self::$styles[$name]['style'] = trim($style);
		self::$styles[$name]['ver'] = $ver;
		self::$styles[$name]['added'] = false;
	}

	public static function writeStyles(){

		$html = '';
		foreach(self::$styles as $name => &$css){
			if($css['added']) continue;
			if(!$css['style'] or strpos($css['style'],'/')===0 or strpos($css['style'],'http://')===0 ){

				if(!$css['style']){
					$file = $name;
				} else {
					$file = $css['style'];
				}

				if(strpos($file,'http://') === 0){
					$file = $file;
				}else if(strpos($file,'/')!==0){
					$file = self::setPath($file,false,'');
				}else  if(strpos($file,'//')!==0){
					$file = JURI::root(true).$file;
				}
				$ver = '';
				if(!empty($css['ver'])) $ver = '?azuraver='.$css['ver'];
				$doc = JFactory::getDocument();
				$doc->addStyleSheet($file.$ver);
			}

			$html .= chr(13);
			$css['added'] = true;
		}
		return $html;
	}
}