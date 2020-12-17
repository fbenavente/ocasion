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

//[Article Grid]
if(!function_exists('azuraarticlesgrid_sc')) {

	function azuraarticlesgrid_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'extraclass' => '',
         'category'=>'',
         'order'=>'created',
         'orderdir'=>'ASC',
         'columngrid'=>'3',
         'showthumbnail'=>'1',
         'showtitle'=>'1',
         'showintrotext'=>'1',
         'showdate'=>'1',
         'showmore'=>'1',
         'limit'=>'All',
         'showfilter'=>'0',
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

    $articlesgridstyle = '';

    $styleText = implode(" ", $styleTextArr);
    

    $styleTextTest = trim($styleText);
    if(!empty($styleTextTest)){
      $articlesgridstyle .= trim($styleText);
    }

    if(!empty($articlesgridstyle)){
      $articlesgridstyle = 'style="'.$articlesgridstyle.'"';
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

      if($category == '0' || $category =='') return false;

      $articles = ElementParser::getContentItems($category, $limit, $order, $orderdir,'',$fetchchild);

       //echo'<pre>';var_dump($articles);die;

      if($showfilter == '1'){
          $tagsFilter = ElementParser::getArticlesTagsFilter($articles);
          //echo'<pre>';var_dump($tagsFilter);die;
      }


       
      $shortcodeTemp = false;

      if(stripos($layout, '_:') !== false){
          $shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR . '/elements/shortcodes_template/'.substr($layout, 2).'.php';
      }else{
          if(stripos($layout, ':') !== false){
              $shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
          }else{
              $shortcodeTemp = ElementParser::addShortcodeTemplate('azuraarticlesgrid');
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
		
	ElementParser::add_shortcode( 'AzuraArticlesGrid', 'azuraarticlesgrid_sc' );
}