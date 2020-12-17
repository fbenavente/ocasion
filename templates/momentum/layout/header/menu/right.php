<?php 
defined('_JEXEC') or die;
?>
<!-- Menu -->
<div class="menu-right" id="theMenu">
	<div class="menu-wrap menu-<?php echo $menucolors;?>">


		<?php echo $logo;?>


		<!-- Close menu -->
		<p class="menu-close">X</p>


		<?php if($this->countModules('main_nav')) :?>
		<!-- Menu items -->
		<jdoc:include type="modules" name="main_nav" style="none" />

		<?php endif;?>

		<?php if(!empty($facebooklink) || !empty($googlepluslink) || !empty($twitterlink) || !empty($envelopelink))  :?>
		<!-- Social icons -->
		<div class="menu-icons">
		<?php if(!empty($facebooklink)) :?>
			<a href="<?php echo $facebooklink;?>"><i class="fa fa-facebook"></i></a>
		<?php endif;?>
		<?php if(!empty($googlepluslink)) :?>
			<a href="<?php echo $googlepluslink;?>"><i class="fa fa-google-plus"></i></a>
		<?php endif;?>
		<?php if(!empty($twitterlink)) :?>
			<a href="<?php echo $twitterlink;?>"><i class="fa fa-twitter"></i></a>
		<?php endif;?>
		<?php if(!empty($envelopelink)) :?>
			<a href="<?php echo $envelopelink;?>"><i class="fa fa-envelope-o"></i></a>
		<?php endif;?>
		</div>
		<?php endif;?>


	</div>


	<!-- Menu toggle -->
	<div id="toggle-right" class="menu-toggle"><i class="fa fa-bars"></i></div>


</div>