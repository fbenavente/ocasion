<?php 

defined('_JEXEC') or die;

$logo = '';
if ($logotype !== 'showboth') {
	if($logotype === 'image'){
		$logo = '<p id="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'"><img src="'.JURI::root(true).'/'.$logoImage.'" class="img-responsive"></a></p>';
	}else{
		if(!empty($logoText)){
			$logo = '<p id="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$logoText.'</a></p>';
		}elseif(empty($logo)){
			$logo = '<p id="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$sitename.'</a><p>';
		}
	}
}else{
	if(!empty($logoImage)){
		$logo .= '<p id="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'"><img src="'.JURI::root(true).'/'.$logoImage.'" class="img-responsive"></a></p>';
	}
	if(!empty($logoText)){
		$logo .= '<p id="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$logoText.'</a></p>';
	}else{
		$logo .= '<p id="logo"><a href="'.JURI::root(true).'"  title="'.$sitename.'">'.$sitename.'</a><p>';
	}
}

?>
<header id="header">			
	<nav class="header">
		<div class="container">
			<div class="row">
				<!-- <p id="logo"><a href="#">logo</a></p> -->
				<?php echo $logo;?>
				
				<?php if($this->countModules('main_nav')) :?>
				<ul class="main-nav">
					<!-- Menu items -->
					<jdoc:include type="modules" name="main_nav" style="none" />
				</ul>
				<?php endif;?>
				
				<div class="menu-button"></div>
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
	</nav><!-- end nav -->
		

</header><!-- header -->