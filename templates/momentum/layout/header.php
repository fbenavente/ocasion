<?php 

defined('_JEXEC') or die;


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

   <jdoc:include type="head" />

   <?php require_once dirname(__FILE__).'/header/profile/'.$headerstyle.'.php'; ?>

   <?php if($overrideColor === '1'){ 
      $doc->addStylesheet($template_folder.'/css/color/default.php?bc='.$bc,'text/css','all');
   }else{
      $doc->addStylesheet($template_folder.'/css/color/'.$preset.'.css','text/css','all');
   }

   ?>

   <?php if($useDifferentFont === '1'){
      $doc->addStyleDeclaration($fontstyle,'text/css');
   }
   ?>

   <?php
   $doc->addStylesheet($template_folder.'/css/custom.css','text/css','all');

   if(!empty($customStyleLinks)) {

      foreach ($customStyleLinks as $link) {
         $doc->addStylesheet($link,'text/css','all');
      }

   } ?>

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

   <!-- Top of the page -->
   <div id="top"></div>

<?php require_once dirname(__FILE__).'/header/'.$headerstyle.'.php'; ?>
