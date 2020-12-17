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
// Error page
$errorbg = $params->get('errorbg','');
if(!empty($errorbg)){
  $errorbg = ' style="background-image:url('.JURI::root(true).'/'.$errorbg.');"';
}else{
  $errorbgcolor = $params->get('errorbgcolor','#e14d43');
  $errorbg = ' style="background-color:'.$errorbgcolor.';"';
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

<!DOCTYPE html>
<html lang="<?php echo $this->language;?>">
<!--[if IE 7]><html lang="<?php echo $this->language;?>" class="ie7"><![endif]-->
<!--[if IE 8]><html lang="<?php echo $this->language;?>" class="ie8"><![endif]-->
<!--[if IE 9]><html lang="<?php echo $this->language;?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><html lang="<?php echo $this->language;?>"><![endif]-->
<!--[if !IE]><html lang="<?php echo $this->language;?>"><![endif]-->
<head>
   <meta charset="<?php echo $this->_charset;?>">
   
   <!-- Standard Favicon--> 
   <link rel="shortcut icon" href="<?php echo JURI::base(true). (!empty($favicon)? '/'.$favicon : '/images/favicon/favicon.ico');?>">
   
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

   <?php if($useDifferentFont === '1') :?>
   <?php echo $importfont ;?>
   <?php else :?>
   <!-- Fonts -->
   <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,300,700' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
   <?php endif;?>

	<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
	<!-- Essential stylesheets -->
	<link rel="stylesheet" href="<?php echo $template_folder; ?>/css/lib/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $template_folder; ?>/css/lib/base.css">

	<!-- The stylesheet -->
	<link rel="stylesheet" href="<?php echo $template_folder; ?>/css/style.css">

	<?php if($useDifferentFont === '1'){ ?>
  	<style>
    	<?php echo $fontstyle;?>
  	</style>
  	<?php 
  	}
  	?>

	<script src="<?php echo $template_folder; ?>/js/lib/modernizr.js"></script>

   <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->

   <script type="text/javascript" >
      baseUrl = "<?php echo JURI::root();?>";
      siteName = "<?php echo $sitename;?>";
      templateName = "<?php echo $this->template;?>";
   </script>

   <?php if(!empty($customstylecode)) {
      echo $customstylecode;
   }
   ?>
</head>

<body class="cth-site <?php //echo $bgcolor;?> lang-dir_<?php echo $this->direction;?> <?php echo $pageClassSfx;?> <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '');
?>">


	<!-- 404 Page -->
	<section class="fourofour">
		<div class="header bg-img fixed background-one" <?php echo $errorbg;?>>
			<div class="header-inner">
				<!-- Content -->
				<div class="error-circle">
					<h1 class="text-dark"><?php echo $this->error->getCode(); ?></h1>
					<h5 class="serif text-dark"><?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?></h5>
					<?php echo $doc->getBuffer('modules', '404-content', array('style' => 'none')); ?>
					
				</div>


			</div>
		</div>
	</section>

	<script src="<?php echo $template_folder; ?>/js/lib/jquery.min.js"></script>
	<script src="<?php echo $template_folder; ?>/js/lib/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo $template_folder; ?>/js/lib/jquery.bxslider.min.js"></script>
    <script src="<?php echo $template_folder; ?>/js/lib/owl.carousel.min.js"></script>
    <script src="<?php echo $template_folder; ?>/js/lib/jquery.fitvids.js"></script>
    <script src="<?php echo $template_folder; ?>/js/lib/jquery.equal.js"></script>
    <script src="<?php echo $template_folder; ?>/js/main.js"></script>

    <script src="<?php echo $template_folder; ?>/js/lib/retina.min.js"></script>


</body>
</html>

