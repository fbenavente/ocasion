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

//[Button]
if(!function_exists('azurabutton_sc')) {

	function azurabutton_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
				'id'=>'',
				'extraclass'=>'',
				'buttontext'=>'',
				'buttonicon'=>'',
				'url'=>'',
				'buttoncolor'=>'btn-default',
				'buttonsize'=>'',
				'target'=>'',
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

        $buttonstyle = '';

        $styleText = implode(" ", $styleTextArr);
        
        $styleTextTest = trim($styleText);
        if(!empty($styleTextTest)){
            $buttonstyle .= trim($styleText);
        }

        if(!empty($buttonstyle)){
            $buttonstyle = 'style="'.$buttonstyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurabutton');
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
		
	ElementParser::add_shortcode( 'AzuraButton', 'azurabutton_sc' );
}