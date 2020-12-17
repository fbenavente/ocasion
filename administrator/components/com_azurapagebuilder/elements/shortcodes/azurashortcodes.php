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

//1. [Accordion]
if(!function_exists('azuraaccordion_sc')) {
	
	$accordionItemsArray = array();

	function azuraaccordion_sc( $atts, $content="" ) {

		global $accordionItemsArray;
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'class' => '',
			   'defaultactive'=>'1',
			   'acctype'=>'',
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

		$accordionstyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$accordionstyle .= trim($styleText);
		}

		if(!empty($accordionstyle)){
			$accordionstyle = 'style="'.$accordionstyle.'"';
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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraaccordion');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$accordionItemsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraAccordion', 'azuraaccordion_sc' );

	function azuraaccordionitem_sc( $atts, $content="" ) {

		global $accordionItemsArray;


		$accordionItemsArray[] = array('id'=>$atts['id'],'class'=>$atts['class'],'title'=>$atts['title'],'subtitle'=>$atts['subtitle'],'content'=>$content);

		
	}
		
	ElementParser::add_shortcode( 'AzuraAccordionItem', 'azuraaccordionitem_sc' );
}
//2.[Alert]
if(!function_exists('azuraalert_sc')) {

	function azuraalert_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   // 'id' => '',
				'title'=>'',
			   	'extraclass' => '',
			   	'type' => 'danger',
			   	'closebtn' => '0',
			   	'fadeeffect'=>'0',
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

		$alertstyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$alertstyle .= trim($styleText);
		}

		if(!empty($alertstyle)){
			$alertstyle = 'style="'.$alertstyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraalert');
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
		
	ElementParser::add_shortcode( 'AzuraAlert', 'azuraalert_sc' );
}
//3.[Article Grid]
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
//4.[Article Slider]
if(!function_exists('azuraarticlesslider_sc')) {

	function azuraarticlesslider_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'extraclass' => '',
         'category'=>'',
         'order'=>'created',
         'orderdir'=>'ASC',
         // 'columngrid'=>'3',
         // 'showthumbnail'=>'1',
         'slidertype'=>'flex_fade',
         'showtitle'=>'1',
         'introtextlength'=>'',
         // 'showdate'=>'1',
         'showmore'=>'1',
         'limit'=>'All',
         // 'showfilter'=>'0',
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

    $articlessliderstyle = '';

    $styleText = implode(" ", $styleTextArr);
    

    $styleTextTest = trim($styleText);
    if(!empty($styleTextTest)){
      $articlessliderstyle .= trim($styleText);
    }

    if(!empty($articlessliderstyle)){
      $articlessliderstyle = 'style="'.$articlessliderstyle.'"';
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

      // if($showfilter == '1'){
      //     $tagsFilter = ElementParser::getArticlesTagsFilter($articles);
      //     //echo'<pre>';var_dump($tagsFilter);die;
      // }


       
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
		
	ElementParser::add_shortcode( 'AzuraArticlesSlider', 'azuraarticlesslider_sc' );
}
//5.[Bs Carousel]
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
//6.[Button]
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
//7.[Button Link]
if(!function_exists('azurabuttonlink_sc')) {

	function azurabuttonlink_sc( $atts, $content="" ) {
	
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
		
	ElementParser::add_shortcode( 'AzuraButtonLink', 'azurabuttonlink_sc' );
}
//8.[Custom heading]
if(!function_exists('azuraheading_sc')) {

	function azuraheading_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'elementtag' => 'h3',
			   
               'textalign'=>'left',
               'fontsize'=>'',
			   'lineheight'=>'',
			   'font_color'=>'',
			   'extraclass'=>'',
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

		$headingstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$headingstyle .= trim($styleText);
		}

		if(!empty($headingstyle)){
			$headingstyle = 'style="'.$headingstyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraheading');
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
		
	ElementParser::add_shortcode( 'AzuraHeading', 'azuraheading_sc' );
}
//9.[Contact form]
if(!function_exists('azuracontactform_sc')) {

	function azuracontactform_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'title' => '',
			   // 'introduction'=>'',
               'receiveemail'=>'',
               'emailsubject'=>'',
			   'thanksmessage'=>'',
			   'showsubject'=>'0',
			   'showwebsite'=>'1',
			   'sendascopy'=>'0',
			   'id'=>'',
			   'extraclass'=>'',
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

		$contactformstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$contactformstyle .= trim($styleText);
		}

		if(!empty($contactformstyle)){
			$contactformstyle = 'style="'.$contactformstyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuracontactform');
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
		
	ElementParser::add_shortcode( 'AzuraContactForm', 'azuracontactform_sc' );
}
//10.[Column Container]
if(!function_exists('azuracontainer_sc')) {

	function azuracontainer_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
				'title'=>'',
				'wraptag'=>'div',
			   	'id' => '',
			   	'class' => '',
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

		$containerstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$containerstyle .= trim($styleText);
		}

		if(!empty($containerstyle)){
			$containerstyle = 'style="'.$containerstyle.'"';
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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuracontainer');
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
		
	ElementParser::add_shortcode( 'AzuraContainer', 'azuracontainer_sc' );

}
//11.[Call to action]
if(!function_exists('azuracta_sc')) {

	function azuracta_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
				'id'=>'',
				'extraclass'=>'',
				'textalign'=>'left',
				'buttontext'=>'',
				'heading'=>'',
				'buttonposition'=>'left',
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

        $ctastyle = '';

        $styleText = implode(" ", $styleTextArr);
        
        $styleTextTest = trim($styleText);
        if(!empty($styleTextTest)){
            $ctastyle .= trim($styleText);
        }

        if(!empty($ctastyle)){
            $ctastyle = 'style="'.$ctastyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuracta');
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
		
	ElementParser::add_shortcode( 'AzuraCTA', 'azuracta_sc' );
}
//12.[Facebook Like box]
if(!function_exists('azurafacebooklike_sc')) {

	function azurafacebooklike_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   // 'id' => '',
			'url'=>'',
			   'extraclass' => '',
			   'type' => 'standard',
			   'width' => '',
			   'height'=>'',
			   'action'=>'like',
			   'face'=>'0',
			   'share'=>'0',
			   'uselike'=>'0',
			   'posts'=>'0',
			   'scheme'=>'light',
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

		$facebooklikestyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$facebooklikestyle .= trim($styleText);
		}

		if(!empty($facebooklikestyle)){
			$facebooklikestyle = 'style="'.$facebooklikestyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurafacebooklike');
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
		
	ElementParser::add_shortcode( 'AzuraFacebookLike', 'azurafacebooklike_sc' );
}
//13.[Flex Slider]
if(!function_exists('azuraflexslider_sc')) {
	
	$flexSliderItemsArray = array();

	function azuraflexslider_sc( $atts, $content="" ) {
		global $flexSliderItemsArray;
		
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'class' => 'flexslider',
			   'flexanimation'=>'fade',
			   'direction'=>'horizontal',
			   'slideshow'=>'1',
			   'slideshowspeed'=>'700',
			   'animationspeed'=>'600',
			   // 'pagination'=>'1',
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

        $flexsliderstyle = '';

        $styleText = implode(" ", $styleTextArr);
        
        $styleTextTest = trim($styleText);
        if(!empty($styleTextTest)){
            $flexsliderstyle .= trim($styleText);
        }

        if(!empty($flexsliderstyle)){
            $flexsliderstyle = 'style="'.$flexsliderstyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraflexslider');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$flexSliderItemsArray = array();

		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraFlexSlider', 'azuraflexslider_sc' );


	//[Bs Carousel Item]
	function azuraflexslider_item_sc( $atts, $content="" ) {

		global $flexSliderItemsArray;

		$flexSliderItemsArray[] = array(/*'id'=>$atts['id'],*/'class'=>$atts['class'],'slideimage'=>$atts['slideimage'],'content'=>$content);
	
		
	}
		
	ElementParser::add_shortcode( 'AzuraFlexSliderItem', 'azuraflexslider_item_sc' );
}
//14.[Flickr Feed]
if(!function_exists('azuraflickr_sc')) {
	
	function azuraflickr_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'extraclass' => '',
			   'accountid'=>'37304598@N02',
			   'count'=>'6',
			   'viewtype'=>'grid',
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

		$flickrstyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$flickrstyle .= trim($styleText);
		}

		if(!empty($flickrstyle)){
			$flickrstyle = 'style="'.$flickrstyle.'"';
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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraflickr');
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
		
	ElementParser::add_shortcode( 'AzuraFlickr', 'azuraflickr_sc' );

}
//15.[Gallery]
if(!function_exists('azuragallery_sc')) {
	
	$galleryItemsArray = array();

	function azuragallery_sc( $atts, $content="" ) {

		global $galleryItemsArray;
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'extraclass' => '',
			   'gridwidth'=>'20',
			   'gallery'=>'',
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

		$gallerystyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$gallerystyle .= trim($styleText);
		}

		if(!empty($gallerystyle)){
			$gallerystyle = 'style="'.$gallerystyle.'"';
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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuragallery');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$galleryItemsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraGallery', 'azuragallery_sc' );

	function azuragalleryitem_sc( $atts, $content="" ) {

		global $galleryItemsArray;


		$galleryItemsArray[] = array(
									'slideimage'=>$atts['slideimage'],
									'usepretty'=>$atts['usepretty'],
									'largeimage'=>$atts['largeimage'],
									'imagelink'=>$atts['imagelink'],
									'extraclass'=>$atts['extraclass'],
									'content'=>$content);

		
	}
		
	ElementParser::add_shortcode( 'AzuraGalleryItem', 'azuragalleryitem_sc' );
}
//16.[GMap]
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
//17.[Google plus button]
if(!function_exists('azuragoogleplus_sc')) {

	function azuragoogleplus_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   // 'id' => '',
			'url'=>'',
			   'size' => 'standard',
			   'annotation' => 'bubble',
			   'extraclass'=>'',
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

		$googleplusstyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$googleplusstyle .= trim($styleText);
		}

		if(!empty($googleplusstyle)){
			$googleplusstyle = 'style="'.$googleplusstyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuragoogleplus');
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
		
	ElementParser::add_shortcode( 'AzuraGooglePlus', 'azuragoogleplus_sc' );
}
//18.[Html]
if(!function_exists('azurahtml_sc')) {

	function azurahtml_sc( $atts, $content="" ) {
	
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

		$htmlstyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$htmlstyle .= trim($styleText);
		}

		if(!empty($htmlstyle)){
			$htmlstyle = 'style="'.$htmlstyle.'"';
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

		$animationData = '';
    if($animationArgs['animation'] == '1'){
      $class .= ' animate-in';
      $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';
    }

		if(!empty($class)){
			$class = 'class="'.$class.'"';
		}

		if(empty($htmlstyle)&& empty($class)&&empty($animationData)){

			return ElementParser::do_shortcode($content);
		}else{
			return '<div '.$class.' '.$htmlstyle.' '.$animationData.'>'.ElementParser::do_shortcode($content).'</div>';
		}
	 
	}
		
	ElementParser::add_shortcode( 'AzuraHtml', 'azurahtml_sc' );
}
//19.[Single Image]
if(!function_exists('azuraimage_sc')) {

	function azuraimage_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
				'id'=>'',
			   'alignment' => 'left',
			   'extraclass'=>'',
               'style'=>'',
               'bordercolor'=>'grey',
               'usepretty'=>'0',
               'largeimage'=>'',
               'imagelink'=>'',
               'src'=>'',
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

		$imagestyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$imagestyle .= trim($styleText);
		}

		if(!empty($imagestyle)){
			$imagestyle = 'style="'.$imagestyle.'"';
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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraimage');
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
		
	ElementParser::add_shortcode( 'AzuraImage', 'azuraimage_sc' );
}
//20.[Raw JS]
if(!function_exists('azurajs_sc')) {

	function azurajs_sc( $atts, $content="" ) {
	 
        return $content;
	}
		
	ElementParser::add_shortcode( 'AzuraJS', 'azurajs_sc' );
}
//21.[Joomla Module]
if(!function_exists('azuramodule_sc')) {

	function azuramodule_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'extraclass' => '',
            'moduleid'=>'',
            'chromestyle'=>'none',
            'showtitle'=>'',
            'layout'=>''
		), $atts));

      if($moduleid == '0' || $moduleid =='') return false;

      //echo'<pre>';var_dump($chromestyle);die; System-none

      $module = ElementParser::loadModule($moduleid,$chromestyle);

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

      $modulestyle = '';

      $styleText = implode(" ", $styleTextArr);
    

      $styleTextTest = trim($styleText);

      if(!empty($styleTextTest)){
         $modulestyle .= trim($styleText);
      }

      if(!empty($modulestyle)){
         $modulestyle = 'style="'.$modulestyle.'"';
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
            $shortcodeTemp = ElementParser::addShortcodeTemplate('azuramodule');
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
		
	ElementParser::add_shortcode( 'AzuraModule', 'azuramodule_sc' );
}
//22.[Nivo Slider]
if(!function_exists('azuranivoslider_sc')) {
	
	$nivosliderItemsArray = array();

	function azuranivoslider_sc( $atts, $content="" ) {

		global $nivosliderItemsArray;
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'extraclass' => '',
			   'defaultactive'=>'1',
			   'acctype'=>'',
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

		$nivosliderstyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$nivosliderstyle .= trim($styleText);
		}

		if(!empty($nivosliderstyle)){
			$nivosliderstyle = 'style="'.$nivosliderstyle.'"';
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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuranivoslider');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$nivosliderItemsArray = array();
		
		return $content;

		
	}
		
	ElementParser::add_shortcode( 'AzuraNivoSlider', 'azuranivoslider_sc' );

	function azuranivoslideritem_sc( $atts, $content="" ) {

		global $nivosliderItemsArray;


		$nivosliderItemsArray[] = array('slideimage'=>$atts['slideimage'],'imagelink'=>$atts['imagelink'],'extraclass'=>$atts['extraclass'],'content'=>$content);

		
	}
		
	ElementParser::add_shortcode( 'AzuraNivoSliderItem', 'azuranivoslideritem_sc' );
}
//23.[Pinterest button]
if(!function_exists('azurapinterest_sc')) {

	function azurapinterest_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   // 'id' => '',
				'url'=>'',
			   'size' => '28',
			   'shape'=>'rect',
			   'annotation' => 'above',
			   'extraclass'=>'',
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

		$pintereststyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$pintereststyle .= trim($styleText);
		}

		if(!empty($pintereststyle)){
			$pintereststyle = 'style="'.$pintereststyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurapinterest');
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
		
	ElementParser::add_shortcode( 'AzuraPinterest', 'azurapinterest_sc' );
}
//24.[Progress]
if(!function_exists('azuraprogress_sc')) {

	function azuraprogress_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'id' => '',
			   'class' => '',
			   'value' => '',
			   'title' => '',
			   'type'=>'',
			   'striped'=>'1',
			   'animated' => '1',
			   'aschild' => '0',
			   'customstyle'=>'',
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

		$progressstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$progressstyle .= trim($styleText);
		}

		if(!empty($progressstyle)){
			$progressstyle = 'style="'.$progressstyle.'"';
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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuraprogress');
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
		
	ElementParser::add_shortcode( 'AzuraProgress', 'azuraprogress_sc' );
}
//25.[Row]
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

			), $colatts),'azp_');

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
//26.[Icon]
if(!function_exists('azuraseparator_sc')) {

	function azuraseparator_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   'color' => 'grey',
			   'style'=>'border',
          'width'=>'100',
          'extraclass'=>'',
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

    $separatorstyle = '';

    $styleText = implode(" ", $styleTextArr);
    

    $styleTextTest = trim($styleText);
    if(!empty($styleTextTest)){
      $separatorstyle .= trim($styleText);
    }

    if(!empty($separatorstyle)){
      $separatorstyle = 'style="'.$separatorstyle.'"';
    }

        $animationArgs = cth_shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
         'animationtype'=>'fadeIn',
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
        $shortcodeTemp = ElementParser::addShortcodeTemplate('azuraseparator');
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
		
	ElementParser::add_shortcode( 'AzuraSeparator', 'azuraseparator_sc' );
}
//27.[Icon]
if(!function_exists('azuraseparatortext_sc')) {

	function azuraseparatortext_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
      'title'=>'',
      'titleposition'=>'separator_align_center',
			   'color' => 'grey',
			   'style'=>'border',
          'width'=>'100',
          'extraclass'=>'',
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

    $separatortextstyle = '';

    $styleText = implode(" ", $styleTextArr);
    

    $styleTextTest = trim($styleText);
    if(!empty($styleTextTest)){
      $separatortextstyle .= trim($styleText);
    }

    if(!empty($separatortextstyle)){
      $separatortextstyle = 'style="'.$separatortextstyle.'"';
    }

        $animationArgs = cth_shortcode_atts(array(

               'animation'=>'0',
               'trigger' => 'animate-in',
         'animationtype'=>'fadeIn',
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
        $shortcodeTemp = ElementParser::addShortcodeTemplate('azuraseparatortext');
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
		
	ElementParser::add_shortcode( 'AzuraSeparatorText', 'azuraseparatortext_sc' );
}
//28.[Spacer]
if(!function_exists('azuraspacer_sc')) {

	function azuraspacer_sc( $atts, $content="" ) {

        extract(cth_shortcode_atts(array(
                'id' => '',
                'extraclass'=>'',
                'height'=>'35',
        ), $atts));

        $classes = 'azura_spacer';

        if(!empty($extraclass)){
            $classes .= ' '.$extraclass;
        }

        $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';

        $regexr = preg_match($pattern,$height,$matches);

        $value = isset( $matches[1] ) ? (float) $matches[1] : '35';
        $unit = isset( $matches[2] ) ? $matches[2] : 'px';
        $height = $value . $unit;

        $stylecss = ( (float) $height >= 0.0 ) ? ' style="height: '.$height.'"' : '';

        $html = '<div class="'.$classes.'" '.$stylecss.'><span class="azura_spacer_inner"></span></div>';

        
	 
        return $html;
	}
		
	ElementParser::add_shortcode( 'AzuraSpacer', 'azuraspacer_sc' );
}
//29.[Subscribe form]
if(!function_exists('azurasubscribeform_sc')) {

	function azurasubscribeform_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
               'receiveemail'=>'',
               'emailsubject'=>'',
			   'thanksmessage'=>'',
			   'id'=>'',
			   'extraclass'=>'',
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

		$subscribestyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$subscribestyle .= trim($styleText);
		}

		if(!empty($subscribestyle)){
			$subscribestyle = 'style="'.$subscribestyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azurasubscribe');
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
		
	ElementParser::add_shortcode( 'AzuraSubscribe', 'azurasubscribeform_sc' );
}
//30.[Tab]
if(!function_exists('azuratabs_sc')) {

	$tabsItemsArray = array();

	function azuratabs_sc( $atts, $content="" ){

		global $tabsItemsArray;

		extract(cth_shortcode_atts(array(
			  'id' => '',
			  'class'=>'',
			  'tabstyle'=>'tab',
			  'usejustified'=>'0',
			  'fade'=>'1',
			  'defaultactive'=>'1',
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

		$tabsstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$tabsstyle .= trim($styleText);
		}

		if(!empty($tabsstyle)){
			$tabsstyle = 'style="'.$tabsstyle.'"';
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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuratabs');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$tabsItemsArray = array();

		
		return $content;
	}


	ElementParser::add_shortcode( 'AzuraTabs', 'azuratabs_sc' );

	//Tab Items
	function azuratabs_item_sc( $atts, $content="" ){
		global $tabsItemsArray;

		$tabsItemsArray[] = array('id'=>$atts['id'],'class'=>$atts['class'],'title'=>$atts['title'],/*'iconclass'=>$atts['iconclass'],*/'content'=>$content);
		
	}

	ElementParser::add_shortcode( 'AzuraTabsItem', 'azuratabs_item_sc' );
		
}
//31.[Text]
if(!function_exists('azuratext_sc')) {

	function azuratext_sc( $atts, $content="" ) {
	
		// extract(cth_shortcode_atts(array(
		// 	   'id' => '',
		// 	   'class' => '',
  //         'wrapper'=>''
		//  ), $atts));

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

    $textstyle = '';

    $styleText = implode(" ", $styleTextArr);
    

    $styleTextTest = trim($styleText);
    if(!empty($styleTextTest)){
      $textstyle .= trim($styleText);
    }

    if(!empty($textstyle)){
      $textstyle = 'style="'.$textstyle.'"';
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

    $classes = 'azura-text-wrapper';

    $animationData = '';
    if($animationArgs['animation'] == '1'){
      if($animationArgs['trigger'] == 'animate-in'){
        $classes .= ' '.$animationArgs['trigger'];
        $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';
      }else{
        $classes .= ' '.$animationArgs['trigger'].'-'.$animationArgs['hoveranimationtype'];
        if($animationArgs['infinite'] != '0'){
          $classes .= ' infinite';
        }
      }
      
      
    }


    if(!empty($class)){
      $classes .= ' '.$class;
    }

    if(!empty($classes)){
      $classes = 'class="'.$classes.'"';
    }
        
         $html = '';
         //if(!empty($wrapper)){
            //$html .= '<div '.$textstyle.' '.$classes.' '.$animationData;
            
            // if(!empty($id)){
            //     $html .= ' id="'.$id.'"';
            // }
            //$html .='>';
         //}
	       $html .= ElementParser::do_shortcode($content);
        
        //$html .= '</div>';
	 
        return $html;
	}
		
	ElementParser::add_shortcode( 'AzuraText', 'azuratext_sc' );
}
//32.[Tour]
if(!function_exists('azuratour_sc')) {

	$tabsItemsArray = array();

	function azuratour_sc( $atts, $content="" ){

		global $tourItemsArray;

		extract(cth_shortcode_atts(array(
			  'id' => '',
			  'class'=>'',
			  'tabstyle'=>'tab',
			  'tabposition'=>'left',
			  'verticaltext'=>'0',
			  'fade'=>'1',
			  'defaultactive'=>'1',
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

		$tabsstyle = '';

		$styleText = implode(" ", $styleTextArr);
		

		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$tabsstyle .= trim($styleText);
		}

		if(!empty($tabsstyle)){
			$tabsstyle = 'style="'.$tabsstyle.'"';
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
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR.'/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuratour');
			}
		}


		
		
		$buffer = ob_get_clean();
		
		ob_start();
		
		if($shortcodeTemp !== false) require $shortcodeTemp;
		
		$content = ob_get_clean();
		
		ob_start();
		
		echo $buffer;

		$tourItemsArray = array();

		
		return $content;
	}


	ElementParser::add_shortcode( 'AzuraTour', 'azuratour_sc' );

	//Tab Items
	function azuratour_item_sc( $atts, $content="" ){
		global $tourItemsArray;

		$tourItemsArray[] = array('id'=>$atts['id'],'class'=>$atts['class'],'title'=>$atts['title'],'iconclass'=>$atts['iconclass'],'content'=>$content);
		
	}

	ElementParser::add_shortcode( 'AzuraTourItem', 'azuratour_item_sc' );
	
		
}
//33.[Tweets Feed]
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
//34.[Twitter button]
if(!function_exists('azuratwittershare_sc')) {

	function azuratwittershare_sc( $atts, $content="" ) {
	
		extract(cth_shortcode_atts(array(
			   // 'id' => '',
			'url'=>'',
			   'screenname' => '',
			   'related' => '',
			   'count' => 'horizontal',
			   'extraclass'=>'',
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

		$twittersharestyle = '';

		$styleText = implode(" ", $styleTextArr);
		
		$styleTextTest = trim($styleText);
		if(!empty($styleTextTest)){
			$twittersharestyle .= trim($styleText);
		}

		if(!empty($twittersharestyle)){
			$twittersharestyle = 'style="'.$twittersharestyle.'"';
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
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuratwittershare');
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
		
	ElementParser::add_shortcode( 'AzuraTwitterShare', 'azuratwittershare_sc' );
}
//35.[video]
if(!function_exists('azuravideo_sc')) {
	function azuravideo_sc( $atts, $content="" ){
	
		extract(cth_shortcode_atts(array(
				'id'=>'',
				'class'=>'',
				'autoplay'=>'0',
				'loop'=>'0',
				'width'=>'',
				'height'=>'',
				'fitvids'=>'0',
				'layout' => ''
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

	    $videostyle = '';

	    $styleText = implode(" ", $styleTextArr);
	    

	    $styleTextTest = trim($styleText);

	    if(!empty($styleTextTest)){
	      	$videostyle .= trim($styleText);
	    }

	    if(!empty($videostyle)){
	      	$videostyle = 'style="'.$videostyle.'"';
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

		$video = parse_url($content);
			
		switch($video['host']) {
				case 'youtu.be':
					$vid = trim($video['path'],'/');
					$src = 'https://www.youtube.com/embed/' . $vid;
				break;
				
				case 'www.youtube.com':
				case 'youtube.com':
					parse_str($video['query'], $query);
					$vid = $query['v'];
					$src = 'https://www.youtube.com/embed/' . $vid;
				break;
				
				case 'vimeo.com':
				case 'www.vimeo.com':
					$vid = trim($video['path'],'/');
					$src = "http://player.vimeo.com/video/{$vid}";
		}

		$shortcodeTemp = false;

		if(stripos($layout, '_:') !== false){
			$shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR . '/elements/shortcodes_template/'.substr($layout, 2).'.php';
		}else{
			if(stripos($layout, ':') !== false){
				$shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
			}else{
				$shortcodeTemp = ElementParser::addShortcodeTemplate('azuravideo');
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
	
	ElementParser::add_shortcode( 'AzuraVideo', 'azuravideo_sc' );
}
//36.[Awesome Icon]
if(!function_exists('faicon_sc')) {
	function faicon_sc( $atts, $content="" ){
	
		extract(cth_shortcode_atts(array(
				'name'=>'magic',
				'extraclass'=>'',
		), $atts));

		$html = '';
		$class = 'fa fa-'.$name;
		if(!empty($extraclass)){
			$class .=' '.$extraclass;
		}

		$html = '<i class="'.$class.'"></i>';
		return $html;
	}
	
	ElementParser::add_shortcode( 'FaIcon', 'faicon_sc' );
}
//37.[Glyphicon Icon]
if(!function_exists('glyphicon_sc')) {
	function glyphicon_sc( $atts, $content="" ){
	
		extract(cth_shortcode_atts(array(
				'name'=>'ok-sign',
				'extraclass'=>'',
		), $atts));

		$html = '';
		$class = 'glyphicon glyphicon-'.$name;
		if(!empty($extraclass)){
			$class .=' '.$extraclass;
		}

		$html = '<i class="'.$class.'"></i>';
		return $html;
	}
	
	ElementParser::add_shortcode( 'glyphicon', 'glyphicon_sc' );
}
//38.[VideoBg]
if(!function_exists('azuravideobg_sc')) {
  function azuravideobg_sc( $atts, $content="" ){
  
    extract(cth_shortcode_atts(array(
      'id'=>'',
      'class'=>'player',
      'link'=>'V2rifmjZuKQ',
      'autoplay'=>'1',
      'loop'=>'1',
      'mute'=>'1',
      'vol'=>'50',
      'quality'=>'default',
      'ratio'=>'4/3',
      'opacity'=>'1',
      'containment'=>'self',
      'startat'=>'20',
      'showcontrols'=>'1',
      'layout' => '','scrollreveal'=>''
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

    $videostyle = '';

    $styleText = implode(" ", $styleTextArr);
    

    $styleTextTest = trim($styleText);
    if(!empty($styleTextTest)){
      $videostyle .= trim($styleText);
    }

    if(!empty($videostyle)){
      $videostyle = 'style="'.$videostyle.'"';
    }

    $shortcodeTemp = false;

    if(stripos($layout, '_:') !== false){
      $shortcodeTemp = JPATH_COMPONENT_ADMINISTRATOR . '/elements/shortcodes_template/'.substr($layout, 2).'.php';
    }else{
      if(stripos($layout, ':') !== false){
        $shortcodeTemp = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate(). '/html/com_azurapagebuilder/plugin/shortcodes_template/'.substr($layout, stripos($layout, ':')+1).'.php';
      }else{
        $shortcodeTemp = ElementParser::addShortcodeTemplate('azuravideobg');
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
  
  ElementParser::add_shortcode( 'AzuraVideoBg', 'azuravideobg_sc' );
}
//[39 TinyMce]
if(!function_exists('azuratinymce_sc')) {

  function azuratinymce_sc( $atts, $content="" ) {
  
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

    $tinymcestyle = '';

    $styleText = implode(" ", $styleTextArr);
    
    $styleTextTest = trim($styleText);
    if(!empty($styleTextTest)){
      $tinymcestyle .= trim($styleText);
    }

    if(!empty($tinymcestyle)){
      $tinymcestyle = 'style="'.$tinymcestyle.'"';
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


    $animationData = '';
    if($animationArgs['animation'] == '1'){
      $class .= ' animate-in';
      $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';
    }


    if(!empty($class)){
      $class = 'class="'.$class.'"';
    }

    if(empty($tinymcestyle)&& empty($class)&&empty($animationData)){

      return ElementParser::do_shortcode($content);
    }else{
      return '<div '.$class.' '.$tinymcestyle.' '.$animationData.'>'.ElementParser::do_shortcode($content).'</div>';
    }
   
  }
    
  ElementParser::add_shortcode( 'AzuraTinyMce', 'azuratinymce_sc' );
}

