<?php 

defined('_JEXEC') or die;

?>
<!-- Blog -->
<section class="blog">
<?php if($activeMenu->params->get('show_page_heading') === '1') :?>
    <!-- Title -->
    <div class="row title">
        <h2><?php echo $activeMenu->params->get('page_heading');?></h2>
        <hr>
    </div>
<?php endif;?>
    <jdoc:include type="modules" name="blog-title" style="none" />
    <div class="row">
        <div class="four col">
            <div class="sidebar left">
                <?php if($this->countModules('left-sidebar')) :?>
                    <jdoc:include type="modules" name="left-sidebar"  style="widget" />
                <?php endif;?>
                <?php if($this->countModules('position-8')) :?>
                    <jdoc:include type="modules" name="position-8" style="xhtml" />
                <?php endif;?>
            </div>
        </div>
        <div class="eight col">
            <?php if ($this->countModules('position-1')) : ?>
                <jdoc:include type="modules" name="position-1" style="none" />
            <?php endif;?>
            <?php if ($this->countModules('position-2')) : ?>
                <jdoc:include type="modules" name="position-2" style="none" />
            <?php endif;?>

            <jdoc:include type="modules" name="position-3" style="xhtml" />
            <jdoc:include type="message" />
            <jdoc:include type="component" />
        </div>
        
    </div>
</section>