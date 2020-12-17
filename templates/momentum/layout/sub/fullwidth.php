<?php 

defined('_JEXEC') or die;
$rightSidebar = false;
if($this->countModules('right-sidebar')|| $this->countModules('position-7')){
	$rightSidebar = true;
}
$leftSidebar = false;
if($this->countModules('left-sidebar')|| $this->countModules('position-8')){
	$leftSidebar = true;
}
// if(!$leftSidebar && !$rightSidebar){
// 	$fullWidthClass = 'col-lg-12';
// }elseif(($leftSidebar&&!$rightSidebar)|| (!$leftSidebar&&$rightSidebar)){
// 	$fullWidthClass = 'col-lg-9';
// }else{
// 	$fullWidthClass = 'col-lg-6';
// }
?>
<?php if($rightSidebar) :?>
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
        <div class="four col">
            <div class="sidebar">
                <?php if($this->countModules('right-sidebar')) :?>
                    <jdoc:include type="modules" name="right-sidebar"  style="widget" />
                <?php endif;?>
                <?php if($this->countModules('position-7')) :?>
                    <jdoc:include type="modules" name="position-7" style="well" />
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
<?php elseif($leftSidebar) :?>
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
<?php else :?>
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
        <div class="twelve col">
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
<?php endif;?>
