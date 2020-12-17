<?php
/**
 * @author Cththemes - www.cththemes.com
 * @date: 01-04-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die;

// Getting params from template
$params = &JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$doc->setMetaData('title', FALSE);

$lang_tag = JFactory::getLanguage()->getTag();
$defaultMenu = $app->getMenu()->getDefault($lang_tag);
$activeMenu = $app->getMenu()->getActive();

$isHomePage = true;
if(isset($activeMenu)){
	if($defaultMenu !== $activeMenu){
		$isHomePage = false;
	}
}else{
	$activeMenu = $defaultMenu;
}

$input = $app->input;

$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->getCfg('sitename');

$pageClassSfx = $activeMenu->params->get('pageclass_sfx',' ');

//Basic
$favicon = $params->get('favicon');
$logoImage = $params->get('logoImage');
$logoText = $params->get('logoText');

$transparentheader = $params->get('transparentheader','0');
$disableMooTools = $params->get('disableMooTools','0');
$disableTooltip = $params->get('disableTooltip','0');

//layout
$templateprofile = $params->get('templateprofile','profile1');
$hideComponentErea = $params->get('hideComponentErea','0');
$layoutstyle = $params->get('layoutstyle','rightsidebar');
$headerstyle = 'default';

// Google fonts
$useDifferentFont = $params->get('useDifferentFont','0');
if($useDifferentFont === '1') {
    $importfont = $params->get('importfont',"<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,300,700' rel='stylesheet' type='text/css'><link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>");
    $fontstyle = $params->get('fontstyle',"body {font-family: 'Open Sans', Helvetica, Arial, sans-serif;}h1, h2, h3, h4, h5, h6,.h1, .h2, .h3, .h4, .h5, .h6 {font-family: 'Raleway', 'Open Sans', Helvetica, Arial, sans-serif;}");
}

// Color Presets                
$preset = $params->get('preset','default');
$overrideColor = $params->get('overrideColor','0');//echo'<pre>';var_dump($overrideColor);die;
if($overrideColor === '1'){
    $bc = substr($params->get('baseColor', '#ff4800'),1);
}

// Custom Codes
$customstylecode = $params->get('customstylecode','');
$customscriptcode = $params->get('customscriptcode','');

$template_folder = JURI::root(true).'/templates/'.$this->template;

// custom style and script
$customStyleLinks = array();
$customScriptLinks = array();

$themePath = JPATH_THEMES.'/'.$this->template;
$themeLink = JURI::root(true).'/templates/'.$this->template;

$customCssLinks = array();

$cusCssLinks = $params->get('customcsslinks');

$customJsLinks = array();

$cusJsLinks = $params->get('customjslinks');

?>
<?php
if($disableMooTools === '1'){
    unset($doc->_scripts[JURI::root(true)."/media/system/js/mootools-core.js"]);
    unset($doc->_scripts[JURI::root(true)."/media/system/js/mootools-more.js"]);
}

if($disableTooltip === '1') {
    if (isset($doc->_script['text/javascript'])) {
        $doc->_script['text/javascript'] = preg_replace('%jQuery\(document\)\.ready\(function\(\)\s*{\s*jQuery\(\'\.hasTooltip\'\)\.tooltip\({"html": true,"container": "body"}\);\s*}\);\s*%', '', $doc->_script['text/javascript']);
        if (empty($doc->_script['text/javascript']))
            unset($doc->_script['text/javascript']);
    }
}

if(!empty($cusCssLinks)){

    $customCssLinks = explode(",", $cusCssLinks);

}


if(!empty($customCssLinks)){

    foreach ($customCssLinks as $css) {
        if(file_exists($themePath.$css)){
            $customStyleLinks[] = $themeLink.$css;
        }elseif(file_exists($themePath.'/css/'.$css)){
            $customStyleLinks[] = $themeLink.'/css/'.$css;
        }elseif(file_exists($themePath.'/stylesheet/'.$css)){
            $customStyleLinks[] = $themeLink.'/stylesheet/'.$css;
        }
        
    }
}


if(!empty($cusJsLinks)){

    $customJsLinks = explode(",", $cusJsLinks);

}


if(!empty($customJsLinks)){

    foreach ($customJsLinks as $js) {
        if(file_exists($themePath.$js)){
            $customScriptLinks[] = $themeLink.$js;
        }elseif(file_exists($themePath.'/js/'.$js)){
            $customScriptLinks[] = $themeLink.'/js/'.$js;
        }elseif(file_exists($themePath.'/script/'.$js)){
            $customScriptLinks[] = $themeLink.'/script/'.$js;
        }
        
    }
} 

?>

<?php require_once dirname(__FILE__).'/layout/header.php'; ?>



<?php if($this->countModules('breadcrumbs')) : ?>
    <jdoc:include type="modules" name="breadcrumbs"  style="none" />
<?php endif;?>



<?php if ($this->countModules('position-4')) : ?>
		<jdoc:include type="modules" name="position-4" style="none" />
<?php endif;?>

<?php if ($this->countModules('position-5')) : ?>
		<jdoc:include type="modules" name="position-5" style="none" />
<?php endif;?>

<?php if ($this->countModules('position-6')) : ?>
		<jdoc:include type="modules" name="position-6" style="none" />
<?php endif;?>


<?php if($hideComponentErea !=='1') {
	require_once dirname(__FILE__).'/layout/component.php';

} ?>
<!-- Component erea -->
<?php if ($this->countModules('position-9')) : ?>
		<jdoc:include type="modules" name="position-9" style="none" />
<?php endif;?>

<?php require_once dirname(__FILE__).'/layout/footer.php'; ?>
