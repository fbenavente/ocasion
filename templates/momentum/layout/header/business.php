<?php 

defined('_JEXEC') or die;

$logo = '';
if ($logotype !== 'showboth') {
  if($logotype === 'image'){
    $logo = '<p class="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'"><img src="'.JURI::root(true).'/'.$logoImage.'" class="img-responsive"></a></p>';
  }else{
    if(!empty($logoText)){
      $logo = '<p class="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$logoText.'</a></p>';
    }elseif(empty($logo)){
      $logo = '<p class="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$sitename.'</a><p>';
    }
  }
}else{
  if(!empty($logoImage)){
    $logo .= '<p class="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'"><img src="'.JURI::root(true).'/'.$logoImage.'" class="img-responsive"></a></p>';
  }
  if(!empty($logoText)){
    $logo .= '<p class="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$logoText.'</a></p>';
  }else{
    $logo .= '<p class="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$sitename.'</a><p>';
  }
}

?>
<header id="main">
    <nav class="header">
        <div class="container">
            <div class="row">
                <?php echo $logo;?>

                <nav class="main-nav">
                <?php if($this->countModules('main_nav')) :?>
                    <ul>
                        <!-- Menu items -->
                        <jdoc:include type="modules" name="main_nav" style="none" />
                    </ul>
                <?php endif;?>
                </nav>
            
                <div class="menu-button one-page"></div>
                <?php if($this->countModules('main_nav')) :?>
                    <nav class="mobile-nav">
                        <ul class="flexnav one-page" data-breakpoint="798">
                            <!-- Menu items -->
                            <jdoc:include type="modules" name="main_nav" style="none" />
                        </ul>
                    </nav>
                <?php endif;?>
              </div>
        </div><!-- container -->
    </nav>
</header>