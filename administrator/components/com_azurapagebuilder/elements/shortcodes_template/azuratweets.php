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

AzuraJs::addStyle('owlCarousel','/components/com_azurapagebuilder/assets/plugins/owlCarousel/owl.carousel.css');
AzuraJs::addJScript('jquery_easing','/components/com_azurapagebuilder/assets/plugins/owlCarousel/jquery.easing.1.3.min.js');
AzuraJs::addJScript('owlCarousel','/components/com_azurapagebuilder/assets/plugins/owlCarousel/owl.carousel.min.js');

$classes = "azura_tweets";

$animationData = '';
if($animationArgs['animation'] == '1'){
	$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}

if(!empty($extraclass)){
	$classes .= ' '.$extraclass;
}

$classes = 'class="'.$classes.'"';

?>

<div <?php echo $classes.' '.$tweetsstyle.' '.$animationData;?>>
	<span>
		<i class="icon-twitter"></i>
	</span>
<?php if(count($tweetsFeed)) :?>
	<div class="azura_tweet_slider tweet_list owl-carousel">
	<?php foreach ($tweetsFeed as $key => $feed) :?>
		<div class="item">
			<p class="tweet_text"><?php echo $tweetsHelper->prepareTweet($feed['text']);?></p>
		</div>
	<?php endforeach;?>
	</div>
<?php endif;?>
</div>