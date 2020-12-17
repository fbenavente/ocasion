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
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
//echo'<pre>';var_dump($this->item);die;
// Create shortcuts to some parameters.
$params  = $this->item->params;
// $canEdit = $params->get('access-edit');
// $user    = JFactory::getUser();
// $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
// 	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author'));


$doc = JFactory::getDocument();

JHtml::_('jquery.framework');

//$user    = JFactory::getUser();
// Add Glyphicon and Awsome fonts
if($params->get('minify_css','1')){
	// If minnify css and js
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/css/azp-style.min.css');
}else{
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/fonts/azura-fonts.css');
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/plugins/animations/animations.min.css');
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/css/azura.grid.css');
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/css/azura_elements.css');

}
if($params->get('minify_js','1')){
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/plugins/animations/animations.min.js');
}else{
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/plugins/animations/appear.min.js');
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/plugins/animations/animations.js');
}
// if($this->item->jQueryLinkType == '1'){
// 	$doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
// }elseif($this->item->jQueryLinkType == '2') {
// 	$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/jquery.min.js');
// }
// if($this->item->noConflict == '1') {
// 	$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/jquery.noconflict.js');
// }

$azuraRootURL = 'var azuraUrl="'.JURI::root().'";';
$doc->addScriptDeclaration($azuraRootURL);

//$this->addCustomJs($this->item->customJsLinks);
$this->item->text = '';
AzuraJs::setData('hits',$this->item->hits);
AzuraJs::setData('pageid',$this->item->id);
AzuraJs::setData('page_likes',$this->item->page_likes);
?>

<?php 
if(isset($this->item->pagecontent)){
	$pageContent = json_decode(rawurldecode($this->item->pagecontent));
	//$this->item->pagecontent = '';
	unset($this->item->pagecontent);
	foreach ($pageContent as $key => $row) {
		$this->item->text .= ElementParser::do_shortcode($this->parseElement($row));
	}
	unset($pageContent);
	//$this->item->text = $this->item->pagecontent;

}
AzuraJs::writeStyles();
AzuraJs::writeJScripts();
if($params->get('minify_js','1')){
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/js/azp-elements.min.js');
}else{
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/js/azura_elements.js');
}
// new in version 2.2
if(!empty($this->item->customCssLinks)){
	$doc->addStyleDeclaration($this->item->customCssLinks);
}
//echo'<pre>';var_dump($this->item->text);die;
$this->item->text .= '{emailcloak=off}';
$dispatcher = JEventDispatcher::getInstance();
JPluginHelper::importPlugin('content');
$dispatcher->trigger('onContentPrepare', array ('com_azurapagebuilder.page', &$this->item, &$this->params, 1));
?>
<?php echo $this->item->text; ?>
<?php echo AzuraJs::writePageScript();?>