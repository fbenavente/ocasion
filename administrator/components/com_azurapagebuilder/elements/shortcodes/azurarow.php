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

//[Row]
if(!function_exists('azurarow_sc')) {

	$rowColumnsArray = array();

	function azurarow_sc( $atts, $content="" ) {
	
		extract(ElementParser::shortcode_atts(array(
			   'id' => '',
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

			), $colatts));

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