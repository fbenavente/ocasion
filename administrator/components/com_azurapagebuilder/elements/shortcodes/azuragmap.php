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

//[GMap]
if(!function_exists('azuragmap_sc')) {

	function azuragmap_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'extraclass' => '',
			   'mapheight'=>'300',
			   'gmaplat'=>'44.434596',
			   'gmaplog'=>'26.080533',
			   'gmappancontrol'=>'1',
			   'gmapzoomcontrol' => '1',
			   'gmaptypecontrol' => '1',
			   'gmapstreetviewcontrol'=>'1',
			   'gmapscrollwheel'=>'1',
			   'gmapzoom'=>'13',
			   'gmaptypeid'=>'ROADMAP'
		 ), $atts));

		//if(empty($content)) return null;

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

		$gmapstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$gmapstyle .= trim($styleText);
		}

		if(!empty($gmapstyle)){
			$gmapstyle = 'style="'.$gmapstyle.'"';
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

		$shortcodeTemp = ElementParser::addShortcodeTemplate('azuragmap');
		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;
		
		return $content;

	}
		
	ElementParser::add_shortcode( 'AzuraGMap', 'azuragmap_sc' );
}