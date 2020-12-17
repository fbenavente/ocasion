<?php 

defined('_JEXEC') or die;

?>
<!-- Bootstrap core CSS -->
<link href="<?php echo $template_folder; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!-- Custom CSS -->
<link href="<?php echo $template_folder; ?>/css/animate.css" rel="stylesheet" type="text/css">
<link href="<?php echo $template_folder; ?>/css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link href="<?php echo $template_folder; ?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $template_folder; ?>/css/component.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $template_folder; ?>/css/colorbox-skins/<?php echo $colorboxskin;?>/colorbox.css" type="text/css">
<link href="<?php echo $template_folder; ?>/css/main.css" rel="stylesheet" type="text/css">
<link href="<?php echo $template_folder; ?>/css/settings.css" rel="stylesheet" type="text/css">
<link href="<?php echo $template_folder; ?>/css/bxslider.css" rel="stylesheet" type="text/css">
<link href="<?php echo $template_folder; ?>/css/header/h3.css" rel="stylesheet" type="text/css">
<link href="<?php echo $template_folder; ?>/css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php echo $template_folder; ?>/css/rivathemes.css" rel="stylesheet" type="text/css">
<link href="<?php echo $template_folder; ?>/css/flexslider.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $template_folder; ?>/css/rivaMegaMenu.css" rel="stylesheet" type="text/css">
<?php if($useDifferentFont === '1') :?>
<style><?php echo $fontstyle ;?></style>
<?php endif;?>

<?php if($overrideColor == '1') : ?>
<link rel="stylesheet" type="text/css" href="<?php echo $template_folder; ?>/css/color.php?bc=<?php echo $bC;?>&amp;sc=<?php echo $sC;?>&amp;tc=<?php echo $tC;?>" id="envor-site-color">
<?php else : ?>
	<?php if($preset !== 'default') :?>
		<link rel="stylesheet" href="<?php echo $template_folder; ?>/css/<?php echo $preset;?>.css" id="envor-site-color"/>
	<?php else:?>
		<link href="<?php echo $template_folder; ?>/css/color1.css" rel="stylesheet" type="text/css" id="envor-site-color">
	<?php endif;?>
<?php endif;?>