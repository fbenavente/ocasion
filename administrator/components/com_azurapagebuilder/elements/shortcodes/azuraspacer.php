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

//[Spacer]
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