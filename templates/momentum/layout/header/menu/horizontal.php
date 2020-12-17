<?php 
defined('_JEXEC') or die;
?>
<!-- Menu horizontal -->
<div class="menu-horizontal menu-<?php echo $menucolors;?> mh-hide">
	<div class="row">
		<div class="twelve col">


			<!-- Symbolic or typographic logo -->
			<div class="mh-logo">
			<?php if($logotype !== 'showboth'): ?>
				<?php if($logotype == 'image') :?>
					<a href="<?php echo JURI::root(true);?>" title="<?php echo $sitename;?>"><img src="<?php echo JURI::root(true).'/'.$logoImage;?>" alt="<?php echo $sitename;?>"></a>
				<?php else: ?>
					<?php if(!empty($logoText)) : ?>
						<h1><a href="#home" class="scrollto"><?php echo $logoText;?></a></h1>
					<?php else : ?>
						<h1><a href="#home" class="scrollto"><?php echo $sitename;?></a></h1>
					<?php endif;?>
				<?php endif;?>
				
			<?php else : ?>
				<?php if(!empty($logoImage)) :?>
					<a href="<?php echo JURI::root(true);?>" title="<?php echo $sitename;?>"><img src="<?php echo JURI::root(true).'/'.$logoImage;?>" alt="<?php echo $sitename;?>"></a>
				<?php endif;?>
				<?php if(!empty($logoText)) : ?>
					<h1><a href="#home" class="scrollto"><?php echo $logoText;?></a></h1>
				<?php else : ?>
					<h1><a href="#home" class="scrollto"><?php echo $sitename;?></a></h1>
				<?php endif;?>
			<?php endif;?>
			</div>


			<!-- Menu toggle -->
			<input type="checkbox" id="toggle" />
			<label for="toggle" class="toggle"></label>


			<!-- Menu items -->
			<div class="menu">
				<?php if($this->countModules('main_nav')) :?>
				<!-- Menu items -->
				<jdoc:include type="modules" name="main_nav" style="none" />

				<?php endif;?>
			</div>


		</div>
	</div>
</div>