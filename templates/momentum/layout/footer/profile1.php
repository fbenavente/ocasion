<?php 

defined('_JEXEC') or die;
?>    
    <?php //if($showBackTop === '1') :?>
    <!-- Back to top -->
    <div class="back-top-wrap">
        <a href="#top" class="scrollto"><i class="back-top fa fa-chevron-up"></i></a>
    </div>
    <?php //endif;?>
        

    
        
        
    <?php if($this->countModules('footer-social')) :?>
    <!-- Social footer -->
    <footer class="social-footer">
        <div class="row">
            <div class="twelve col sf-icons">
                <jdoc:include type="modules" name="footer-social" style="none" />
            </div>
        </div>
    </footer>

    <?php endif;?>


    <?php if($this->countModules('footer-copyright')) :?>
    <!-- Footer -->
    <footer class="footer">
        <div class="row">
            <div class="twelve col">
                <jdoc:include type="modules" name="footer-copyright" style="none" />
            </div>
        </div>
    </footer>
    <?php endif;?>

    <?php if ($this->countModules('debug')) : ?>
        <jdoc:include type="modules" name="debug" style="none" />
    <?php endif;?>

    <script src="<?php echo $template_folder; ?>/js/lib/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo $template_folder; ?>/js/lib/jquery.bxslider.min.js"></script>
    <script src="<?php echo $template_folder; ?>/js/lib/owl.carousel.min.js"></script>
    <script src="<?php echo $template_folder; ?>/js/lib/jquery.fitvids.js"></script>
    <script src="<?php echo $template_folder; ?>/js/lib/jquery.equal.js"></script>
    <script src="<?php echo $template_folder; ?>/js/main.js"></script>

    <script src="<?php echo $template_folder; ?>/js/lib/retina.min.js"></script>
    
