<?php
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
//no direct accees
defined ('_JEXEC') or die('resticted aceess');

//[Tweets Feed]
if(!function_exists('azuratweets_sc')) {

	function azuratweets_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
				'twittername' 				=>	'Cththemes',
				'consumer_key'				=>	'b1gNFU5p55j7GR0vACWyZf0j8',
				'consumer_key_secret' 		=>	'V0a7UkD0XTuP4zdoJoBPlpbQC9TtGk8ucotXRZZZP4MYv7TkK2',
				'access_token'				=>	'2549127786-T8zZA3d7cJcgDkI2kwbfQ2XeU8exphGZu3hZVvK',
				'access_token_secret' 		=>	'pQXlpkL9CSCIsEnGF5xgsjKObDRWcD77thGkFG9RLzgjs',
				'count'						=>	'3',
				'layout'=>''
		), $atts));

		$params = array(
				'twittername'=>$twittername,
				'consumer_key'=>$consumer_key,
				'consumer_key_secret'=>$consumer_key_secret,
				'access_token'=>$access_token,
				'access_token_secret'=>$access_token_secret,
				'counts'=>$count
		);
		require_once JPATH_COMPONENT_ADMINISTRATOR . '/helpers/cthtweetshelper.php';

		$tweetsHelper = new CthTweetsHelper($params);

		$tweetsFeed = $tweetsHelper->fetch();

		$styleArr = cth_shortcode_atts(array(

               'margin_top'=>'',
               'margin_right' => '',
               'margin_bottom'=>'',
               'margin_left'=>'',

               'border_top_width'=>'',
               'border_right_width' => '',
               'border_bottom_width'=>'',
               'border_left_width'=>'',

               'padding_top'=>'',
               'padding_right' => '',
               'padding_bottom'=>'',
               'padding_left'=>'',

               'border_color'=>'',
               'border_style' => '',

               'background_color'=>'',
               'background_image'=>'',
               'background_repeat'=>'',
               'background_attachment'=>'',
               'background_size'=>'',
               'additional_style'=>'',
               'simplified'=>''

        ), $atts);

        $styleTextArr = ElementParser::parseStyle($styleArr);

        $tweetsstyle = '';

        $styleText = implode(" ", $styleTextArr);
        
        $styleTextTest = trim($styleText);
        if(!empty($styleTextTest)){
            $tweetsstyle .= trim($styleText);
        }

        if(!empty($tweetsstyle)){
            $tweetsstyle = 'style="'.$tweetsstyle.'"';
        }

        // animation
        $animationArgs = cth_shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',
               'animationduration'=>'',

		), $atts);

        $shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR . '/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuratweets');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$accordionItem = null;
		
		return $content;
	 
	}
		
	ElementParser::add_shortcode( 'AzuraTweets', 'azuratweets_sc' );
}