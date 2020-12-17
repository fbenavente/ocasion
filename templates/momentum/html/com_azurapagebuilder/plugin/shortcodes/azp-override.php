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

//[Home Bigtext]
if(!function_exists('azurahomebigtext_sc')) {

	function azurahomebigtext_sc( $atts, $content="" ) {
	
		extract(ElementParser::shortcode_atts(array(
				'bgcolor'=>'img',
				'textcolor'=>'white',
			   	'id' => '',
			   	'extraclass' => '',
			   	// 'scroll_link'=>'',
			   	// 'scroll_class'=>'',
			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$homebigtextstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$homebigtextstyle .= trim($styleText);
		}

		if(!empty($homebigtextstyle)){
			$homebigtextstyle = 'style="'.$homebigtextstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurahomebigtext');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraHomeBigtext', 'azurahomebigtext_sc' );
}

//[Services]
if(!function_exists('azuraservices_sc')) {

	$servicesItemsArray = array();

	function azuraservices_sc( $atts, $content="" ) {

	 	global $servicesItemsArray;
	
		extract(cth_shortcode_atts(array(
				// 'title1' => '',
			 //   	'title2' => '',
			 //   	'title3'=>'',
			   	'id' => 'services',
			   	'extraclass' => '',

			   	'items'=>'4',
				'autoplay'=>'',
				'issingle'=>'0',
				'itemscustom'=>'',
				'slidespeed'=>'200',
				'shownav'=>'1',
				
			   	'layout'=>''
		), $atts));

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

		$servicesstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$servicesstyle .= trim($styleText);
		}

		if(!empty($servicesstyle)){
			$servicesstyle = 'style="'.$servicesstyle.'"';
		}

		$animationArgs = cth_shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraservices');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$servicesItemsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraServices', 'azuraservices_sc' );

	function azuraservices_item_sc( $atts, $content="" ) {

	 	global $servicesItemsArray;

	 	$servicesItemsArray[] = array('iconclass'=>$atts['iconclass'],'content'=>$content);

	}

	ElementParser::add_shortcode( 'AzuraServicesItem', 'azuraservices_item_sc' );
}
//[Work Slider]
if(!function_exists('azuraworkslider_sc')) {


	function azuraworkslider_sc( $atts, $content="" ) {

	
		extract(cth_shortcode_atts(array(
				// 'title1' => '',
			 //   	'title2' => '',
			 //   	'title3'=>'',
			   	//'id' => 'services',
			   	'extraclass' => '',

			   	'category'=>'',
		         'order'=>'created',
		         'orderdir'=>'ASC',
		         'limit'=>'All',

			   	'ditems'=>'3',
				'autoplay'=>'',
				'issingle'=>'0',
				'itemscustom'=>'',
				'slidespeed'=>'200',
				'shownav'=>'1',
				
			   	'layout'=>''
		), $atts));

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

		$worksliderstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$worksliderstyle .= trim($styleText);
		}

		if(!empty($worksliderstyle)){
			$worksliderstyle = 'style="'.$worksliderstyle.'"';
		}

		if($category == '0' || $category =='') return false;

      	$items = ElementParser::getK2Items($category, $limit, $order, $orderdir,'', '0');


		$animationArgs = cth_shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraworkslider');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraWorkSlider', 'azuraworkslider_sc' );

	
}


//[Home Full]
if(!function_exists('azurahomefull_sc')) {

	function azurahomefull_sc( $atts, $content="" ) {
	
		extract(ElementParser::shortcode_atts(array(
				// 'bgcolor'=>'img',
				// 'textcolor'=>'white',
			   	'id' => '',
			   	'extraclass' => '',
			   	'scroll_link'=>'',
			   	'scroll_class'=>'',
			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$homefullstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$homefullstyle .= trim($styleText);
		}

		if(!empty($homefullstyle)){
			$homefullstyle = 'style="'.$homefullstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurahomefull');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraHomeFull', 'azurahomefull_sc' );
}
//[Home Full Bg Slider]
if(!function_exists('azurafullbgslider_sc')) {

	$fullBgSliderItemsArray = array();

	function azurafullbgslider_sc( $atts, $content="" ) {

	 	global $fullBgSliderItemsArray;
	
		extract(ElementParser::shortcode_atts(array(
				'textcolor' => 'white',
			   	'id' => '',
			   	'extraclass' => '',
			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$fullbgsliderstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$fullbgsliderstyle .= trim($styleText);
		}

		if(!empty($fullbgsliderstyle)){
			$fullbgsliderstyle = 'style="'.$fullbgsliderstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurafullbgslider');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$fullBgSliderItemsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraFullBgSlider', 'azurafullbgslider_sc' );

	function azurafullbgslider_item_sc( $atts, $content="" ) {

	 	global $fullBgSliderItemsArray;

	 	$fullBgSliderItemsArray[] = array('src'=>$atts['src'],'overlay'=>$atts['overlay'],'extraclass'=>$atts['extraclass'],'content'=>$content);

	}

	ElementParser::add_shortcode( 'AzuraFullBgSliderItem', 'azurafullbgslider_item_sc' );
}
//[Home Full Slider]
if(!function_exists('azurafullslider_sc')) {

	$fullSliderItemsArray = array();

	function azurafullslider_sc( $atts, $content="" ) {

	 	global $fullSliderItemsArray;
	
		extract(ElementParser::shortcode_atts(array(
				'textcolor' => 'white',
			   	'id' => '',
			   	'src' => '',
			   	'mode'=>'horizontal',
			   	'auto' => '0',
			   	'speed' => '500',
			   	'pager' => '0',
			   	'controls' => '1',
			   	'extraclass' => '',
			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$fullsliderstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$fullsliderstyle .= trim($styleText);
		}

		if(!empty($fullsliderstyle)){
			$fullsliderstyle = 'style="'.$fullsliderstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurafullslider');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$fullSliderItemsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraFullSlider', 'azurafullslider_sc' );

	function azurafullslider_item_sc( $atts, $content="" ) {

	 	global $fullSliderItemsArray;

	 	$fullSliderItemsArray[] = array(/*'src'=>$atts['src'],'overlay'=>$atts['overlay'],*/'extraclass'=>$atts['extraclass'],'content'=>$content);

	}

	ElementParser::add_shortcode( 'AzuraFullSliderItem', 'azurafullslider_item_sc' );
}
//[Home Background Content Slider]
if(!function_exists('azurabgcslider_sc')) {

	$bgcSliderItemsArray = array();

	function azurabgcslider_sc( $atts, $content="" ) {

	 	global $bgcSliderItemsArray;
	
		extract(ElementParser::shortcode_atts(array(
				'textcolor' => 'white',
				'shownavigation'=>'1',

				'mode'=>'fade',
			   	'auto' => '0',
			   	'speed' => '500',
			   	'pager' => '1',
			   	'controls' => '1',

			   	'id' => '',
			   	'extraclass' => '',
			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$bgcsliderstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$bgcsliderstyle .= trim($styleText);
		}

		if(!empty($bgcsliderstyle)){
			$bgcsliderstyle = 'style="'.$bgcsliderstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurabgcslider');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$bgcSliderItemsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraBgCSlider', 'azurabgcslider_sc' );

	function azurabgcslider_item_sc( $atts, $content="" ) {

	 	global $bgcSliderItemsArray;

	 	$bgcSliderItemsArray[] = array('src'=>$atts['src'],/*'overlay'=>$atts['overlay'],*/'extraclass'=>$atts['extraclass'],'content'=>$content);

	}

	ElementParser::add_shortcode( 'AzuraBgCSliderItem', 'azurabgcslider_item_sc' );
}
//[Home Background Slider]
if(!function_exists('azurabgslider_sc')) {

	$bgSliderItemsArray = array();

	function azurabgslider_sc( $atts, $content="" ) {

	 	global $bgSliderItemsArray;
	
		extract(ElementParser::shortcode_atts(array(
				'scroll_link'=>'',
				'scroll_class'=>'',
			   	'id' => '',
			   	'extraclass' => '',

			   	'mode'=>'fade',
			   	'auto' => '1',
			   	'speed' => '1000',
			   	'pager' => '0',
			   	'controls' => '0',

			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$bgsliderstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$bgsliderstyle .= trim($styleText);
		}

		if(!empty($bgsliderstyle)){
			$bgsliderstyle = 'style="'.$bgsliderstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurabgslider');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$bgSliderItemsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraBgSlider', 'azurabgslider_sc' );

	function azurabgslider_item_sc( $atts, $content="" ) {

	 	global $bgSliderItemsArray;

	 	$bgSliderItemsArray[] = array('src'=>$atts['src'],/*'overlay'=>$atts['overlay'],*/'extraclass'=>$atts['extraclass'],'content'=>$content);

	}

	ElementParser::add_shortcode( 'AzuraBgSliderItem', 'azurabgslider_item_sc' );
}
//[Azura Sticky Menu]
if(!function_exists('azurastickymenu_sc')) {

	function azurastickymenu_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   // 'name' => 'CTHthemes',
			   // 'job'=>'Developer',
			   'alreadyfixed' => '0',
			   'extraclass'=>'',
			   'layout'=>''
		 ), $atts));

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurastickymenu');
			}
		}
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraStickyMenu', 'azurastickymenu_sc' );
}
//25.[Row]
if(!function_exists('azurarow_sc')) {

	$rowColumnsArray = array();

	function azurarow_sc( $atts, $content="" ) {
	
		extract(ElementParser::shortcode_atts(array(
			   'id' => '',
			   'sec_class'=>'',
			   'fullwidth'=>'0',
			   'class' => '',
			   'layout'=>''
		 ), $atts));

		global $rowColumnsArray;

		$styleArr = ElementParser::shortcode_atts(array(

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

		$rowstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$rowstyle .= trim($styleText);
		}

		if(!empty($rowstyle)){
			$rowstyle = 'style="'.$rowstyle.'"';
		}

				$animationArgs = ElementParser::shortcode_atts(array(

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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurarow');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$rowColumnsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraRow', 'azurarow_sc' );

	function azuracolumn_sc( $colatts, $content="" ) {

	 	global $rowColumnsArray;
			$responsiveTxt = ElementParser::parseResponsive(cth_shortcode_atts(array(


		 		'lgoffsetclass'		=>'',
		 		'lgwidthclass'		=>'',
		 		'hidden-lg'			=>'',

		 		'mdoffsetclass'		=>'',
		 		'mdwidthclass'		=>'',
		 		'hidden-md'			=>'',

		 		'smoffsetclass'		=>'',
		 		'smwidthclass'		=>'', //is $columnwidthclass
		 		'hidden-sm'			=>'',

		 		'xsoffsetclass'		=>'',
		 		'xswidthclass'		=>'',
		 		'hidden-xs'			=>'',

			), $colatts),'');

	 		$colStyleArr = ElementParser::parseStyle(
	 			cth_shortcode_atts(array(

	               	'margin_top'=>'',
		           	'margin_right' => '',
				   	'margin_bottom'=> '',
		           	'margin_left'=> '',

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

				), $colatts)
			);

			$colStyle = '';

			$styleText = implode(" ", $colStyleArr);
			

			$styleTextTest = trim($styleText);
			if(!empty($styleTextTest)){
				$colStyle .= trim($styleText);
			}

			if(!empty($colStyle)){
				$colStyle = 'style="'.$colStyle.'"';
			}

			$animationArgs = cth_shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',
               'animationduration'=>'',

			), $colatts);

			extract(cth_shortcode_atts(array(

               	'id'=>'',
	           	'class' => '',
	           	'columnwidthclass'=>'col-md-12',
			   	

			), $colatts));

		 	$rowColumnsArray[] = array(
		 		'animation'=>$animationArgs['animation'],
		 		'animationtype'=>$animationArgs['animationtype'],
		 		'animationdelay'=>$animationArgs['animationdelay'],
		 		'animationduration'=>$animationArgs['animationduration'],

		 		'columnstyle'=> $colStyle,

		 		'id'=>$id,
		 		'class'=>$class,
		 		'columnwidthclass'=>$columnwidthclass,
		 		'responsivetext'=>$responsiveTxt,
		 		'content'=>$content
		 	);

	}

	ElementParser::add_shortcode( 'AzuraColumn', 'azuracolumn_sc' );
}

//[Icon Box]
if(!function_exists('azuraiconbox_sc')) {

	function azuraiconbox_sc( $atts, $content="" ) {
	
		extract(ElementParser::shortcode_atts(array(
				'title'=>'',
				'icon'=>'fa fa-magic',
			   	'extraclass' => '',
			   	'link'=>'',
			   	// 'scroll_link'=>'',
			   	// 'scroll_class'=>'',
			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$iconboxstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$iconboxstyle .= trim($styleText);
		}

		if(!empty($iconboxstyle)){
			$iconboxstyle = 'style="'.$iconboxstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraiconbox');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraIconBox', 'azuraiconbox_sc' );
}
//[K2 Category]
if(!function_exists('azurak2category_sc')) {

	function azurak2category_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'class' => '',
         'category'=>'',
         'order'=>'created',
         'orderdir'=>'ASC',
         'limit'=>'All',
         'showfilter'=>'1',
         'fetchchild'=>'0',
         'layout'=>''
		 ), $atts));

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

    $k2categorystyle = '';

    $styleText = implode(" ", $styleTextArr);
    

    $styleTextTest = trim($styleText);
    if(!empty($styleTextTest)){
      $k2categorystyle .= trim($styleText);
    }

    if(!empty($k2categorystyle)){
      $k2categorystyle = 'style="'.$k2categorystyle.'"';
    }

    $animationArgs = cth_shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate',
         'animationtype'=>'',
               'animationdelay'=>'',

     ), $atts);

      if($category == '0' || $category =='') return false;

      $items = ElementParser::getK2Items($category, $limit, $order, $orderdir,'',$fetchchild);

      if($showfilter == '1'){
          $tagsFilter = ElementParser::getK2TagsFilter($items);
      }
       
      $shortcodeTemp = false;

      if(stripos($layout, '_:') !== false){
          $shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
      }else{
          if(stripos($layout, ':') !== false){
              $shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate().  '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
          }else{
              $shortcodeTemp = ElementParser::addShortcodeTemplate('azurak2category');
          }
      }
      
      $buffer = ob_get_clean();
      
      ob_start();
      
      if($shortcodeTemp !== false) require $shortcodeTemp;
      
      $content = ob_get_clean();
      
      ob_start();
      
      echo $buffer;
      
      return $content;
	}
		
	ElementParser::add_shortcode( 'AzuraK2Category', 'azurak2category_sc' );
}
//[K2 Item View]
if(!function_exists('azurak2itemview_sc')) {

	function azurak2itemview_sc( $atts, $content="" ) {

	
		extract(cth_shortcode_atts(array(
			   	'k2_id'=>'',
			   	'imagesize'=>'',
			   	'posttype'=>'0',
			   	'showcreated'=>'1',
			   	'showcategory'=>'1',
			   	'showcomment'=>'1',
			   	'showtitle'=>'1',
			   	'showreadmore'=>'1',
			   	'introtextlength'=>'',
			   	'showfulltext'=>'0',
			   	'extraclass' => '',
			   	'layout'=>''
		), $atts));

		if($k2_id == '0' || $k2_id =='') return false;

      	$item = ElementParser::getK2Item($k2_id, '');

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

		$k2itemviewstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$k2itemviewstyle .= trim($styleText);
		}

		if(!empty($k2itemviewstyle)){
			$k2itemviewstyle = 'style="'.$k2itemviewstyle.'"';
		}

		$animationArgs = cth_shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',
               'animationduration'=>''

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurak2itemview');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraK2ItemView', 'azurak2itemview_sc' );
}
//[Process]
if(!function_exists('azuraprocess_sc')) {

	$processItemsArray = array();

	function azuraprocess_sc( $atts, $content="" ) {

	 	global $processItemsArray;
	
		extract(ElementParser::shortcode_atts(array(
				// 'title1' => '',
			 //   	'title2' => '',
			 //   	'title3'=>'',
			   	'id' => '',
			   	'extraclass' => '',
			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$processstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$processstyle .= trim($styleText);
		}

		if(!empty($processstyle)){
			$processstyle = 'style="'.$processstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraprocess');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$processItemsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraProcess', 'azuraprocess_sc' );

	function azuraprocess_item_sc( $atts, $content="" ) {

	 	global $processItemsArray;

	 	$processItemsArray[] = array('iconclass'=>$atts['iconclass'],'content'=>$content);

	}

	ElementParser::add_shortcode( 'AzuraProcessItem', 'azuraprocess_item_sc' );
}
//[Team]
if(!function_exists('azurateam_sc')) {

	$teamMembersArray = array();

	function azurateam_sc( $atts, $content="" ) {

	 	global $teamMembersArray;
	
		extract(ElementParser::shortcode_atts(array(
				// 'title1' => '',
			 //   	'title2' => '',
			 //   	'title3'=>'',
			 //   	'bgcolor'=>'white',
			   	'viewmode'=>'slider',
			   	'id' => '',
			   	'extraclass' => '',

			   	'items'=>'4',
				'autoplay'=>'',
				'issingle'=>'0',
				'itemscustom'=>'',
				'slidespeed'=>'200',
				'shownav'=>'1',

			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$teamstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$teamstyle .= trim($styleText);
		}

		if(!empty($teamstyle)){
			$teamstyle = 'style="'.$teamstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurateam');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$teamMembersArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraTeam', 'azurateam_sc' );

	function azurateammember_sc( $atts, $content="" ) {

	 	global $teamMembersArray;

	 	$teamMembersArray[] = array('name'=>$atts['name'],'job'=>$atts['job'],'photo'=>$atts['photo']/*,'extraclass'=>$atts['extraclass']*/,'content'=>$content);

	}

	ElementParser::add_shortcode( 'AzuraTeamMember', 'azurateammember_sc' );
}
//[Single Member]
if(!function_exists('azuramemberitem_sc')) {


	function azuramemberitem_sc( $atts, $content="" ) {

	
		extract(ElementParser::shortcode_atts(array(
			   	'name'=>'',
			   	'job' => '',
			   	'photo' => '',
			   	'extraclass' => '',
			   	'layout'=>''
		), $atts));

		$styleArr = ElementParser::shortcode_atts(array(

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

		$memberitemstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$memberitemstyle .= trim($styleText);
		}

		if(!empty($memberitemstyle)){
			$memberitemstyle = 'style="'.$memberitemstyle.'"';
		}

		$animationArgs = ElementParser::shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
			   'animationtype'=>'',
			   'hoveranimationtype'=>'',
			   'infinite'=>'0',
               'animationdelay'=>'0',

		 ), $atts);

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuramemberitem');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraMemberItem', 'azuramemberitem_sc' );
}

//[Social Link]
if(!function_exists('sociallink_sc')) {

	function sociallink_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'icon' => 'fa fa-joomla',
			   'class'=>'',
			   'link' =>"#"
		 ), $atts));

		if(!empty($class)){
			$class = ' class="'.$class.'"';
		}
		 
		 
		 
		return '<a href="'.$link.'"'.$class.'><i class="' . $icon . '"></i></a>';
	 
	}
		
	ElementParser::add_shortcode( 'sociallink', 'sociallink_sc' );
}
//[Icon]
if(!function_exists('icon_sc')) {

	function icon_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'name' => 'fa fa-joomla',
			   'class' =>""
		 ), $atts));

		if(!empty($class)){
			$name .= ' '.$class;
		}
		 
		 
		 
		return '<i class="' . $name . '"></i>';
	 
	}
		
	ElementParser::add_shortcode( 'icon', 'icon_sc' );
}
//[FA Icon]
if(!function_exists('faicon_sc')) {

	function faicon_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'name' => 'joomla',
			   'class' =>""
		 ), $atts));

		$name = 'fa fa-'.$name;

		if(!empty($class)){
			$name .= ' '.$class;
		}
		 
		 
		 
		return '<i class="' . $name . '"></i>';
	 
	}
		
	ElementParser::add_shortcode( 'faicon', 'faicon_sc' );
}
//[Similiar Projects]
if(!function_exists('similiarprojects_sc')) {

	function similiarprojects_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			'limit'=> 4
		 ), $atts));

		$html = '';

		$app = JFactory::getApplication();
		$com = $app->input->getCmd('option');
		$view = $app->input->getCmd('view');
		$itemID = $app->input->getInt('id',0);
		//echo'<pre>';var_dump($app->input);die;
		if($itemID&&$com == 'com_k2'&&$view == 'item'){
			$workItem = ElementParser::getK2Item($itemID,'',false);
			$similiarItems = ElementParser::getK2Items($workItem->catid,$limit);
			if($similiarItems){
				$html .= '<div class="row equal">';

				foreach ($similiarItems as $proj) {
					$extraFields = json_decode($proj->extra_fields);

					if($extraFields[1]->value === '5'):
						$html .='<div class="three col large-six col medium-six col small-six col x-small-twelve col op-link grid-mb gallery-link">';
					else: 
						$html .='<div class="three col large-six col medium-six col small-six col x-small-twelve col op-link grid-mb">';
					endif;

						    switch ($extraFields[1]->value) {
						    case '1': 
						        $html .='<a class="popup" href="'.JURI::root(true).$extraFields[2]->value.'">';
						            
						        break;
						    case '2':
						        $html .='<a href="'.ElementParser::getK2ItemLink($proj->id,$proj->alias,$proj->catid,$proj->categoryalias).'" >';

						        break;
						    case '3':
						        $html .='<a class="popup-vimeo" href="'.$extraFields[2]->value.'">';
						        break;
						    case '4': 
						        $html .='<a class="popup-youtube" href="'.$extraFields[2]->value.'">';
						        break;
						    case '5':
						        $html .='<a>';
						        break;
						    default:
						        $html .='<a class="popup" href="'.JURI::root(true).$extraFields[2]->value.'">';
						            break;
						    }

						            $html .='<img src="'.JURI::root(true).$extraFields[0]->value.'" alt="'.$proj->title.'" class="responsive-img">';
						            $html .='<b>'.$proj->title.'</b>';
						            $html .='<em></em>';
						        $html .='</a>';
						    $html .='</div>';
						if($extraFields[1]->value == '5') :
							$html .='<div class="gallery">';
							foreach($extraFields as $key=>$value) :
							    if($key > 1 && $value->value): 
							    	$html .='<a href="'.JURI::root(true).$value->value.'"></a>';
							    endif;
							endforeach;
							$html .='</div>';
						endif;

				}

				$html .= '</div>';
			}
		}

		return $html;
	 
	}
		
	ElementParser::add_shortcode( 'similiarprojects', 'similiarprojects_sc' );
}