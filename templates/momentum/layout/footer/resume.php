<?php

defined('_JEXEC') or die;

?>

	<?php if($this->countModules('footer-copyright')) :?>
	<section id="subfooter">
		<div class="container">
			<jdoc:include type="modules" name="footer-copyright" style="none" />
		</div>
	</section>

	<?php endif;?>
	
	<?php if($showBackTop === '1') :?>
	<!-- Back to top button -->
	<!-- <div class="relative">
		<a href="#top" class="backtotop right scrollto"><i class="fa fa-long-arrow-up"></i></a>
	</div> -->
	<?php endif;?>
	

	<?php if ($this->countModules('debug')) : ?>
  		<jdoc:include type="modules" name="debug" style="none" />
	<?php endif;?>

</div><!-- End of Wrapper -->


<!-- put your javascript link in the end of the page  -->
<!-- <script src="http://code.jquery.com/jquery.js"></script> -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="http://developer.hawkface.com/ringside/affluence-select/html/js/classie.js"></script>
<!-- Bootstrap JavaScript -->
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!--<script src="<?php echo $template_folder; ?>/resume_assets/js/strip.pkgd.min.js"></script>-->
<!--<script src="js/t.min.js"></script>-->
<script src="<?php echo $template_folder; ?>/resume_assets/js/prefix.js"></script>
<script src="<?php echo $template_folder; ?>/resume_assets/js/tipped.js"></script>
<script src="<?php echo $template_folder; ?>/resume_assets/js/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo $template_folder; ?>/resume_assets/js/jquery.flexnav.min.js"></script>
<script src="<?php echo $template_folder; ?>/resume_assets/js/scrollReveal.js"></script>
<script src="<?php echo $template_folder; ?>/js/wow.js"></script>
<script src="<?php echo $template_folder; ?>/resume_assets/js/custom.js"></script>