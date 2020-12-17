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

//[Bs Carousel]
if(!function_exists('azurabscarousel_sc')) {
	
	$bsCarouselItemsArray = array();

	function azurabscarousel_sc( $atts, $content="" ) {
		global $bsCarouselItemsArray;
		
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'class' => '',
			   'interval'=>'5000',
			   'pause'=>'hover',
			   'wrap'=>'1',
			   'keyboard'=>'1',
			   'navigation'=>'1',
			   'pagination'=>'1',
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

        $bscarouselstyle = '';

        $styleText = implode(" ", $styleTextArr);
        
        $styleTextTest = trim($styleText);
        if(!empty($styleTextTest)){
            $bscarouselstyle .= trim($styleText);
        }

        if(!empty($bscarouselstyle)){
            $bscarouselstyle = 'style="'.$bscarouselstyle.'"';
        }


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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurabscarousel');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$bsCarouselItemsArray = array();

		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraBsCarousel', 'azurabscarousel_sc' );


	//[Bs Carousel Item]
	function azurabscarousel_item_sc( $atts, $content="" ) {

		global $bsCarouselItemsArray;

		$bsCarouselItemsArray[] = array('id'=>$atts['id'],'class'=>$atts['class'],'image'=>$atts['image'],'content'=>$content);
	
		
	}
		
	ElementParser::add_shortcode( 'AzuraBsCarouselItem', 'azurabscarousel_item_sc' );
}