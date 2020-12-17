<?php
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die;

if($slidertype === 'nivo'){
	AzuraJs::addStyle('nivo','/components/com_azurapagebuilder/assets/plugins/nivo_slider/nivo-slider.css');
	AzuraJs::addStyle('nivo_theme_default','/components/com_azurapagebuilder/assets/plugins/nivo_slider/themes/default/default.css');
	AzuraJs::addJScript('nivo','/components/com_azurapagebuilder/assets/plugins/nivo_slider/jquery.nivo.slider.pack.js');
}else if($slidertype === 'flex_fade' || $slidertype === 'flex_slide'){
	AzuraJs::addStyle('flex','/components/com_azurapagebuilder/assets/plugins/flexSlider/flexslider.css');
	AzuraJs::addJScript('flex','/components/com_azurapagebuilder/assets/plugins/flexSlider/jquery.flexslider-min.js');
}

$classes = 'azura_articlesslider azura_slider_'.$slidertype.' azp_font_edit';

$animationData = '';
if($animationArgs['animation'] == '1'){
	$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}

$classes = 'class="'.$classes.'"';

// Required if show readmore or show more post
require_once JPATH_SITE.'/components/com_content/helpers/route.php';

?>
<?php if(count($articles)) : ?>

<div <?php echo $classes.' '.$articlessliderstyle.' '.$animationData;?>>
<?php if($slidertype === 'nivo') :?>
	<div class="theme-default">
		<div class="ribbon"></div>
		<div <?php if(!empty($id)) echo 'id="'.$id.'"';?> class="nivoSlider">

			<?php
			$eleCaptions = array();
			foreach ($articles as $key => $article) : ?>
			<?php
        		$artImages = json_decode($article->images);
        		if(!empty($artImages->image_intro)) :
        	?>
					<img src="<?php echo JURI::root(true).'/'.$artImages->image_intro;?>" alt="" title="#<?php echo $id;?>nivoCaption<?php echo $key;?>"/>
			<?php endif;?>
			<?php $cap = '<div id="'.$id.'nivoCaption'.$key.'" class="nivo-html-caption">';
				if($showtitle === '1') {
					$cap .= '<h3><a href="'.ContentHelperRoute::getArticleRoute($article->id,$category).'">'.$article->title.'</a></h3>';
				}
				if(!empty($introtextlength)){
					if(is_int((int)$introtextlength)){
						$cap .= '<p>'.JHtml::_('string.truncate',strip_tags($article->introtext),(int)$introtextlength).'</p>';
					}else{
						$cap .= '<p>'.JHtml::_('string.truncate',strip_tags($article->introtext),120).'</p>';
					}
				}

				$cap .= '</div>';

				$eleCaptions[] = $cap;

			?>
			
			<?php endforeach;?>
		</div>

		<?php echo implode($eleCaptions, "\n");?>
	</div>
<?php else : ?>
	<div <?php if(!empty($id)) echo 'id="'.$id.'"';?> class="flexslider">
	  	<ul class="slides">
	  		<?php
			
			foreach ($articles as $key => $article) : ?>
			<li>
			<?php
        		$artImages = json_decode($article->images);
        		if(!empty($artImages->image_intro)) :
        	?>
				<img src="<?php echo JURI::root(true).'/'.$artImages->image_intro;?>" alt=""/>
			<?php endif;?>

			<?php if($showtitle === '1' || !empty($introtextlength)) :?>
				<div class="flex_caption">
					<?php 
					if($showtitle === '1') : ?>
						<h3><a href="<?php echo ContentHelperRoute::getArticleRoute($article->id,$category);?>"><?php echo $article->title;?></a></h3>
					<?php endif;
					if(!empty($introtextlength)){
						if(is_int((int)$introtextlength)){ ?>
							<p><?php echo JHtml::_('string.truncate',strip_tags($article->introtext),(int)$introtextlength);?></p>
					<?php
						}else{ ?>
							<p><?php echo JHtml::_('string.truncate',strip_tags($article->introtext),120);?></p>
				<?php	}
					} ?>
				</div>
			<?php endif;?>

	    	</li>
	    <?php endforeach;?>
	  	</ul>
	</div>
<?php endif;?>
</div>

<?php endif;?>