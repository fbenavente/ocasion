<?php
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filesystem.file' );
jimport('joomla.filesystem.folder');

require_once JPATH_SITE.'/administrator/components/com_azurapagebuilder/helpers/elementshelper.php';
require_once JPATH_SITE.'/administrator/components/com_azurapagebuilder/helpers/cthimageresizer.php';

/**
* ElementParser
*/
class ElementParser
{
    
    private static $shortcode_tags = array();


    
    /**
     * WordPress API for creating bbcode like tags or what WordPress calls
     * "shortcodes." The tag and attribute parsing or regular expression code is
     * based on the Textpattern tag parser.
     *
     * A few examples are below:
     *
     * [shortcode /]
     * [shortcode foo="bar" baz="bing" /]
     * [shortcode foo="bar"]content[/shortcode]
     *
     * Shortcode tags support attributes and enclosed content, but does not entirely
     * support inline shortcodes in other shortcodes. You will have to call the
     * shortcode parser in your function to account for that.
     *
     * {@internal
     * Please be aware that the above note was made during the beta of WordPress 2.6
     * and in the future may not be accurate. Please update the note when it is no
     * longer the case.}}
     *
     * To apply shortcode tags to content:
     *
     * <code>
     * $out = do_shortcode($content);
     * </code>
     *
     * @link http://codex.wordpress.org/Shortcode_API
     *
     * @package WordPress
     * @subpackage Shortcodes
     * @since 2.5.0
     */

    public static function addShortcodeFiles()
    {
        //$app = JFactory::getApplication();

        $template = JFactory::getApplication()->getTemplate();

        //$templatePath = JPATH_THEMES . '/'.$template . '/html/com_azurapagebuilder/plugin/shortcodes/';
        //$comPath = JPATH_ROOT.'/administrator/components/com_azurapagebuilder/elements/shortcodes/';

        // $shortcodes = array();

        // $templateShortcodes = glob( $templatePath.'*.php' );
        // $comShortcodes = glob( $comPath.'*.php');

        // foreach((array) $templateShortcodes as $value)  $shortcodes[] =  basename($value);

        // foreach((array) $comShortcodes as $value)  $shortcodes[] =   basename($value);

        // $shortcodes = array_unique($shortcodes);


        // if(count($shortcodes)){
        //     foreach($shortcodes as $shortcode  ){
            
        //         $templateShortcode  = $templatePath. $shortcode;
        //         $comShortcode = $comPath . $shortcode;

        //         if( file_exists( $templateShortcode ) && !is_dir( $templateShortcode ) ){
        //             require_once $templateShortcode;
        //         }
        //         if( file_exists( $comShortcode ) && !is_dir( $comShortcode ) ){
        //             require_once $comShortcode;
        //         }
        //     }
        // }

        if( file_exists( JPATH_THEMES . '/'.$template . '/html/com_azurapagebuilder/plugin/shortcodes/azp-override.php' ) && !is_dir( JPATH_THEMES . '/'.$template . '/html/com_azurapagebuilder/plugin/shortcodes/azp-override.php' ) ){
            require_once JPATH_THEMES . '/'.$template . '/html/com_azurapagebuilder/plugin/shortcodes/azp-override.php';
        }
        if( file_exists( JPATH_ROOT.'/administrator/components/com_azurapagebuilder/elements/shortcodes/azurashortcodes.php' ) && !is_dir( JPATH_ROOT.'/administrator/components/com_azurapagebuilder/elements/shortcodes/azurashortcodes.php' ) ){
            require_once JPATH_ROOT.'/administrator/components/com_azurapagebuilder/elements/shortcodes/azurashortcodes.php';
        }

    }


    /**
     * Container for storing shortcode tags and their hook to call for the shortcode
     *
     * @since 2.5.0
     *
     * @name $shortcode_tags
     * @var array
     * @global array $shortcode_tags
     */
    //$shortcode_tags = array();

    /**
     * Add hook for shortcode tag.
     *
     * There can only be one hook for each shortcode. Which means that if another
     * plugin has a similar shortcode, it will override yours or yours will override
     * theirs depending on which order the plugins are included and/or ran.
     *
     * Simplest example of a shortcode tag using the API:
     *
     * <code>
     * // [footag foo="bar"]
     * function footag_func($atts) {
     *  return "foo = {$atts[foo]}";
     * }
     * add_shortcode('footag', 'footag_func');
     * </code>
     *
     * Example with nice attribute defaults:
     *
     * <code>
     * // [bartag foo="bar"]
     * function bartag_func($atts) {
     *  extract(shortcode_atts(array(
     *      'foo' => 'no foo',
     *      'baz' => 'default baz',
     *  ), $atts));
     *
     *  return "foo = {$foo}";
     * }
     * add_shortcode('bartag', 'bartag_func');
     * </code>
     *
     * Example with enclosed content:
     *
     * <code>
     * // [baztag]content[/baztag]
     * function baztag_func($atts, $content='') {
     *  return "content = $content";
     * }
     * add_shortcode('baztag', 'baztag_func');
     * </code>
     *
     * @since 2.5.0
     *
     * @uses $shortcode_tags
     *
     * @param string $tag Shortcode tag to be searched in post content.
     * @param callable $func Hook to run when shortcode is found.
     */
    public static function add_shortcode($tag, $func) {
        //global $shortcode_tags;

        if ( is_callable($func) )
            self::$shortcode_tags[$tag] = $func;
    }

    /**
     * Removes hook for shortcode.
     *
     * @since 2.5.0
     *
     * @uses $shortcode_tags
     *
     * @param string $tag shortcode tag to remove hook for.
     */
    public static function remove_shortcode($tag) {
        //global $shortcode_tags;

        unset(self::$shortcode_tags[$tag]);
    }

    /**
     * Clear all shortcodes.
     *
     * This function is simple, it clears all of the shortcode tags by replacing the
     * shortcodes global by a empty array. This is actually a very efficient method
     * for removing all shortcodes.
     *
     * @since 2.5.0
     *
     * @uses $shortcode_tags
     */
    public static function remove_all_shortcodes() {
        //global $shortcode_tags;

        self::$shortcode_tags = array();
    }

    /**
     * Whether a registered shortcode exists named $tag
     *
     * @since 3.6.0
     *
     * @global array $shortcode_tags
     * @param string $tag
     * @return boolean
     */
    private static function shortcode_exists( $tag ) {
        //global $shortcode_tags;
        return array_key_exists( $tag, self::$shortcode_tags );
    }

    /**
     * Whether the passed content contains the specified shortcode
     *
     * @since 3.6.0
     *
     * @global array $shortcode_tags
     * @param string $tag
     * @return boolean
     */
    private static function has_shortcode( $content, $tag ) {
        if ( false === strpos( $content, '[' ) ) {
            return false;
        }

        if ( self::shortcode_exists( $tag ) ) {
            preg_match_all( '/' . self::get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
            if ( empty( $matches ) )
                return false;

            foreach ( $matches as $shortcode ) {
                if ( $tag === $shortcode[2] )
                    return true;
            }
        }
        return false;
    }

    /**
     * Search content for shortcodes and filter shortcodes through their hooks.
     *
     * If there are no shortcode tags defined, then the content will be returned
     * without any filtering. This might cause issues when plugins are disabled but
     * the shortcode will still show up in the post or content.
     *
     * @since 2.5.0
     *
     * @uses $shortcode_tags
     * @uses get_shortcode_regex() Gets the search pattern for searching shortcodes.
     *
     * @param string $content Content to search for shortcodes
     * @return string Content with shortcodes filtered out.
     */
    public static function do_shortcode($content) {
        //global $shortcode_tags;

        if ( false === strpos( $content, '[' ) ) {
            return $content;
        }

        if (empty(self::$shortcode_tags) || !is_array(self::$shortcode_tags))
            return $content;

        $pattern = self::get_shortcode_regex();
        return preg_replace_callback( "/$pattern/s", array('ElementParser','do_shortcode_tag'), $content );
    }

    /**
     * Retrieve the shortcode regular expression for searching.
     *
     * The regular expression combines the shortcode tags in the regular expression
     * in a regex class.
     *
     * The regular expression contains 6 different sub matches to help with parsing.
     *
     * 1 - An extra [ to allow for escaping shortcodes with double [[]]
     * 2 - The shortcode name
     * 3 - The shortcode argument list
     * 4 - The self closing /
     * 5 - The content of a shortcode when it wraps some content.
     * 6 - An extra ] to allow for escaping shortcodes with double [[]]
     *
     * @since 2.5.0
     *
     * @uses $shortcode_tags
     *
     * @return string The shortcode search regular expression
     */
    private static function get_shortcode_regex() {
        //global $shortcode_tags;
        $tagnames = array_keys(self::$shortcode_tags);
        $tagregexp = join( '|', array_map('preg_quote', $tagnames) );

        // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
        // Also, see shortcode_unautop() and shortcode.js.
        return
              '\\['                              // Opening bracket
            . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
            . "($tagregexp)"                     // 2: Shortcode name
            . '(?![\\w-])'                       // Not followed by word character or hyphen
            . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
            .     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
            .     '(?:'
            .         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
            .         '[^\\]\\/]*'               // Not a closing bracket or forward slash
            .     ')*?'
            . ')'
            . '(?:'
            .     '(\\/)'                        // 4: Self closing tag ...
            .     '\\]'                          // ... and closing bracket
            . '|'
            .     '\\]'                          // Closing bracket
            .     '(?:'
            .         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
            .             '[^\\[]*+'             // Not an opening bracket
            .             '(?:'
            .                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
            .                 '[^\\[]*+'         // Not an opening bracket
            .             ')*+'
            .         ')'
            .         '\\[\\/\\2\\]'             // Closing shortcode tag
            .     ')?'
            . ')'
            . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
    }

    /**
     * Regular Expression callable for do_shortcode() for calling shortcode hook.
     * @see get_shortcode_regex for details of the match array contents.
     *
     * @since 2.5.0
     * @access private
     * @uses $shortcode_tags
     *
     * @param array $m Regular expression match array
     * @return mixed False on failure.
     */
    private static function do_shortcode_tag( $m ) {
        //global $shortcode_tags;

        // allow [[foo]] syntax for escaping a tag
        if ( $m[1] == '[' && $m[6] == ']' ) {
            return substr($m[0], 1, -1);
        }

        $tag = $m[2];
        $attr = self::shortcode_parse_atts( $m[3] );

        if ( isset( $m[5] ) ) {
            // enclosing tag - extra parameter
            return $m[1] . call_user_func( self::$shortcode_tags[$tag], $attr, $m[5], $tag ) . $m[6];
        } else {
            // self-closing tag
            return $m[1] . call_user_func( self::$shortcode_tags[$tag], $attr, null,  $tag ) . $m[6];
        }
    }

    /**
     * Retrieve all attributes from the shortcodes tag.
     *
     * The attributes list has the attribute name as the key and the value of the
     * attribute as the value in the key/value pair. This allows for easier
     * retrieval of the attributes, since all attributes have to be known.
     *
     * @since 2.5.0
     *
     * @param string $text
     * @return array List of attributes and their value.
     */
    private static function shortcode_parse_atts($text) {
        $atts = array();
        $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
        $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
        if ( preg_match_all($pattern, $text, $match, PREG_SET_ORDER) ) {
            foreach ($match as $m) {
                if (!empty($m[1]))
                    $atts[strtolower($m[1])] = stripcslashes($m[2]);
                elseif (!empty($m[3]))
                    $atts[strtolower($m[3])] = stripcslashes($m[4]);
                elseif (!empty($m[5]))
                    $atts[strtolower($m[5])] = stripcslashes($m[6]);
                elseif (isset($m[7]) and strlen($m[7]))
                    $atts[] = stripcslashes($m[7]);
                elseif (isset($m[8]))
                    $atts[] = stripcslashes($m[8]);
            }
        } else {
            $atts = ltrim($text);
        }
        return $atts;
    }

    /**
     * Combine user attributes with known attributes and fill in defaults when needed.
     *
     * The pairs should be considered to be all of the attributes which are
     * supported by the caller and given as a list. The returned attributes will
     * only contain the attributes in the $pairs list.
     *
     * If the $atts list has unsupported attributes, then they will be ignored and
     * removed from the final returned list.
     *
     * @since 2.5.0
     *
     * @param array $pairs Entire list of supported attributes and their defaults.
     * @param array $atts User defined attributes in shortcode tag.
     * @param string $shortcode Optional. The name of the shortcode, provided for context to enable filtering
     * @return array Combined and filtered attribute list.
     */
    public static function shortcode_atts( $pairs, $atts, $shortcode = '' ) {
        $atts = (array)$atts;
        $out = array();
        foreach($pairs as $name => $default) {
            if ( array_key_exists($name, $atts) )
                $out[$name] = $atts[$name];
            else
                $out[$name] = $default;
        }
        /**
         * Filter a shortcode's default attributes.
         *
         * If the third parameter of the shortcode_atts() function is present then this filter is available.
         * The third parameter, $shortcode, is the name of the shortcode.
         *
         * @since 3.6.0
         *
         * @param array $out The output array of shortcode attributes.
         * @param array $pairs The supported attributes and their defaults.
         * @param array $atts The user defined shortcode attributes.
         */
        // if ( $shortcode )
        //     $out = apply_filters( "shortcode_atts_{$shortcode}", $out, $pairs, $atts );

        return $out;
    }

    /**
     * Remove all shortcode tags from the given content.
     *
     * @since 2.5.0
     *
     * @uses $shortcode_tags
     *
     * @param string $content Content to remove shortcode tags.
     * @return string Content without shortcode tags.
     */
    public static function strip_shortcodes( $content ) {
        //global $shortcode_tags;

        if ( false === strpos( $content, '[' ) ) {
            return $content;
        }

        if (empty(self::$shortcode_tags) || !is_array(self::$shortcode_tags))
            return $content;

        $pattern = self::get_shortcode_regex();

        return preg_replace_callback( "/$pattern/s", array('ElementParser','strip_shortcode_tag'), $content );
    }

    private static function strip_shortcode_tag( $m ) {
        // allow [[foo]] syntax for escaping a tag
        if ( $m[1] == '[' && $m[6] == ']' ) {
            return substr($m[0], 1, -1);
        }

        return $m[1] . $m[6];
    }

    // add_filter('the_content', 'do_shortcode', 11); // AFTER wpautop()

    // add new for shortcode edit

    public static function do_shortcode_edit($content) {
        //global $shortcode_tags;

        if ( false === strpos( $content, '[' ) ) {
            return $content;
        }

        if (empty(self::$shortcode_tags) || !is_array(self::$shortcode_tags))
            return $content;

        $pattern = self::get_shortcode_regex();
        return preg_replace_callback( "/$pattern/s", array('ElementParser','do_shortcode_edit_tag'), $content );
    }

    private static function do_shortcode_edit_tag( $m ) {
        //global $shortcode_tags;

        // allow [[foo]] syntax for escaping a tag
        if ( $m[1] == '[' && $m[6] == ']' ) {
            return substr($m[0], 1, -1);
        }

        // $tag = $m[2];
        // $attr = shortcode_parse_atts( $m[3] );

        $result = array();
        $result['type'] = $m[2];
        //$result['attrs'] = json_encode(shortcode_parse_atts( $m[3] ));
        $result['attrs'] = self::shortcode_parse_atts( $m[3] );

        if($m[5]){
            $result['content'] = $m[5];
        }else{
            $result['content'] = null;
        }

        return json_encode($result);

        // if ( isset( $m[5] ) ) {
        //     // enclosing tag - extra parameter
        //     return $m[1] . call_user_func( $shortcode_tags[$tag], $attr, $m[5], $tag ) . $m[6];
        // } else {
        //     // self-closing tag
        //     return $m[1] . call_user_func( $shortcode_tags[$tag], $attr, null,  $tag ) . $m[6];
        // }
    }

    /* Extra Shortcode Functions */

    public static function slug($str){
        return preg_replace('/[^a-z0-9_]/i', '-', strtolower($str));
    }
    public static function addShortcodeTemplate($file){
        //jimport( 'joomla.filesystem.file' );
        $tempOverride       = JPATH_THEMES .'/'.JFactory::getApplication()->getTemplate().'/html/com_azurapagebuilder/plugin/shortcodes_template/'.$file.'.php';
        $tempBase   = JPATH_ROOT.'/administrator/components/com_azurapagebuilder/elements/shortcodes_template/'.$file.'.php';
        if(JFile::exists($tempOverride)){
            return $tempOverride;
        }else if(JFile::exists($tempBase)){
            return $tempBase;
        }else{
            return false;
        }
    }

    
    public static function parseStyle($styleArr = array()){
        if(empty($styleArr)){
            return '';
        }
        else {
            //echo '<pre>';var_dump($styleArr);die;
            //margin
            $margin_style = '';
            if(!empty($styleArr['margin_top'])||!empty($styleArr['margin_right'])||!empty($styleArr['margin_bottom'])||!empty($styleArr['margin_left'])){
                if($styleArr['simplified'] == '1'){
                    if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['margin_top'])){
                        $margin_style = 'margin: '.$styleArr['margin_top'].'px;';
                    }else{
                        $margin_style = 'margin: '.$styleArr['margin_top'].';';
                    }
                }else{
                    if(!empty($styleArr['margin_top'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['margin_top'])){
                            $margin_style = 'margin-top: '.$styleArr['margin_top'].'px;';
                        }else{
                            $margin_style = 'margin-top: '.$styleArr['margin_top'].';';
                        }
                    }

                    if(!empty($styleArr['margin_right'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['margin_right'])){
                            $margin_style .= 'margin-right: '.$styleArr['margin_right'].'px;';
                        }else{
                            $margin_style .= 'margin-right: '.$styleArr['margin_right'].';';
                        }
                    }

                    if(!empty($styleArr['margin_bottom'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['margin_bottom'])){
                            $margin_style .= 'margin-bottom: '.$styleArr['margin_bottom'].'px;';
                        }else{
                            $margin_style .= 'margin-bottom: '.$styleArr['margin_bottom'].';';
                        }
                    }

                    if(!empty($styleArr['margin_left'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['margin_left'])){
                            $margin_style .= 'margin-left: '.$styleArr['margin_left'].'px;';
                        }else{
                            $margin_style .= 'margin-left: '.$styleArr['margin_left'].';';
                        }
                    }
                }
            }

            //padding
            $padding_style = '';
            if(!empty($styleArr['padding_top'])||!empty($styleArr['padding_right'])||!empty($styleArr['padding_bottom'])||!empty($styleArr['padding_left'])){
                if($styleArr['simplified'] == '1'){
                    if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['padding_top'])){
                        $padding_style = 'padding: '.$styleArr['padding_top'].'px;';
                    }else{
                        $padding_style = 'padding: '.$styleArr['padding_top'].';';
                    }
                }else{
                    if(!empty($styleArr['padding_top'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['padding_top'])){
                            $padding_style = 'padding-top: '.$styleArr['padding_top'].'px;';
                        }else{
                            $padding_style = 'padding-top: '.$styleArr['padding_top'].';';
                        }
                    }

                    if(!empty($styleArr['padding_right'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['padding_right'])){
                            $padding_style .= 'padding-right: '.$styleArr['padding_right'].'px;';
                        }else{
                            $padding_style .= 'padding-right: '.$styleArr['padding_right'].';';
                        }
                    }

                    if(!empty($styleArr['padding_bottom'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['padding_bottom'])){
                            $padding_style .= 'padding-bottom: '.$styleArr['padding_bottom'].'px;';
                        }else{
                            $padding_style .= 'padding-bottom: '.$styleArr['padding_bottom'].';';
                        }
                    }

                    if(!empty($styleArr['padding_left'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['padding_left'])){
                            $padding_style .= 'padding-left: '.$styleArr['padding_left'].'px;';
                        }else{
                            $padding_style .= 'padding-left: '.$styleArr['padding_left'].';';
                        }
                    }
                }
            }

            //border
            $border_width_style = '';
            if(!empty($styleArr['border_top_width'])||!empty($styleArr['border_right_width'])||!empty($styleArr['border_bottom_width'])||!empty($styleArr['border_left_width'])){
                if($styleArr['simplified'] == '1'){
                    if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['border_top_width'])){
                        $border_width_style = 'border-width: '.$styleArr['border_top_width'].'px;';
                    }else{
                        $border_width_style = 'border-width: '.$styleArr['border_top_width'].';';
                    }
                }else{
                    if(!empty($styleArr['border_top_width'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['border_top_width'])){
                            $border_width_style = 'border-top-width: '.$styleArr['border_top_width'].'px;';
                        }else{
                            $border_width_style = 'border-top-width: '.$styleArr['border_top_width'].';';
                        }
                    }

                    if(!empty($styleArr['border_right_width'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['border_right_width'])){
                            $border_width_style .= 'border-right-width: '.$styleArr['border_right_width'].'px;';
                        }else{
                            $border_width_style .= 'border-right-width: '.$styleArr['border_right_width'].';';
                        }
                    }

                    if(!empty($styleArr['border_bottom_width'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['border_bottom_width'])){
                            $border_width_style .= 'border-bottom-width: '.$styleArr['border_bottom_width'].'px;';
                        }else{
                            $border_width_style .= 'border-bottom-width: '.$styleArr['border_bottom_width'].';';
                        }
                    }

                    if(!empty($styleArr['border_left_width'])){
                        if(!preg_match('/\d*\.?\d*\s*(%|in|cm|mm|em|ex|pt|pc|px)$/i', $styleArr['border_left_width'])){
                            $border_width_style .= 'border-left-width: '.$styleArr['border_left_width'].'px;';
                        }else{
                            $border_width_style .= 'border-left-width: '.$styleArr['border_left_width'].';';
                        }
                    }
                }
            }

            if(!empty($styleArr['border_color'])){
                $border_color = 'border-color: '.$styleArr['border_color'].';';
            }else{
                $border_color = '';
            }



            if(!empty($styleArr['border_style'])){
                $border_style_style = 'border-style: '.$styleArr['border_style'].';';
            }else{
                $border_style_style = '';
            }

            $border_style = $border_color. ' '.$border_width_style .' '. $border_style_style;

            // background;

            if(!empty($styleArr['background_color'])){
                $background_color = 'background-color: '.$styleArr['background_color'].';';
            }else{
                $background_color = '';
            }

            if(!empty($styleArr['background_image'])){
                $background_image = 'background-image: url(\''.JURI::root(true).'/'.$styleArr['background_image'].'\');';
            }else{
                $background_image = '';
            }

            if(!empty($styleArr['background_repeat'])){
                $background_repeat_style = 'background-repeat: '.$styleArr['background_repeat'].';';
                
            }else{
                $background_repeat_style = '';
            }

            if(!empty($styleArr['background_attachment'])){
                $background_attachment_style = 'background-attachment: '.$styleArr['background_attachment'].';';
                
            }else{
                $background_attachment_style = '';
            }

            if(!empty($styleArr['background_size'])){
                $background_size_style = '-webkit-background-size: '.$styleArr['background_size'].'; -moz-background-size: '.$styleArr['background_size'].';-o-background-size: '.$styleArr['background_size'].';background-size: '.$styleArr['background_size'].';';
                
            }else{
                $background_size_style = '';
            }

            $background_style = $background_color .' '.$background_image . ' '.$background_repeat_style. ' '.$background_attachment_style. ' '.$background_size_style;

            // additional style
            if(!empty($styleArr['additional_style'])){
                $additional_style = $styleArr['additional_style'];
            }else{
                $additional_style ='';
            }

            $return = array();

            $return['margin'] = $margin_style;
            $return['padding'] = $padding_style;
            $return['border'] = $border_style;
            $return['background'] = $background_style;
            $return['additional_style'] = $additional_style;

            return $return;
        }
    }

    // Parse Column Responsive 
    public static function parseResponsive($atts,$pre='azp_'){
        //echo'<pre>';var_dump($atts);die;
        if(empty($atts)){
            return '';
        }

        $responsiveText = '';
        // Mobile - Extra Small View
        if($atts['xswidthclass']){
            $responsiveText .= ' '.$pre.$atts['xswidthclass'];
        }
        if($atts['xsoffsetclass']){
            $responsiveText .= ' '.$pre.$atts['xsoffsetclass'];
        }
        if($atts['hidden-xs'] && $atts['hidden-xs'] === '1'){
            $responsiveText .= ' '.$pre.'hidden-xs';
        }
        //Tablet Vertical - Small View
        if($atts['smoffsetclass']){
            $responsiveText .= ' '.$pre.$atts['smoffsetclass'];
        }
        // if($atts['xsoffsetclass']){
        //  $responsiveText .= ' '.$atts['xsoffsetclass'];
        // }
        // Inherit from $columnwidthclass

        if($atts['hidden-sm'] && $atts['hidden-sm'] === '1'){
            $responsiveText .= ' '.$pre.'hidden-sm';
        }

        // Tablet Horizontal - Medium view
        if($atts['mdwidthclass']){
            $responsiveText .= ' '.$pre.$atts['mdwidthclass'];
        }
        if($atts['mdoffsetclass']){
            $responsiveText .= ' '.$pre.$atts['mdoffsetclass'];
        }
        if($atts['hidden-md'] && $atts['hidden-md'] === '1'){
            $responsiveText .= ' '.$pre.'hidden-md';
        }

        // Desktop - Large view
        if($atts['lgwidthclass']){
            $responsiveText .= ' '.$pre.$atts['lgwidthclass'];
        }
        if($atts['lgoffsetclass']){
            $responsiveText .= ' '.$pre.$atts['lgoffsetclass'];
        }
        if($atts['hidden-lg'] && $atts['hidden-lg'] === '1'){
            $responsiveText .= ' '.$pre.'hidden-lg';
        }


        $responsiveText = trim($responsiveText);
//echo'<pre>';var_dump($responsiveText);die;
        return $responsiveText;
    }

    public static function loadModule($id,$style = 'none'){
        //require_once JPATH_PLUGINS.'/system/cthshortcodes/core/cthmodulehelper.php';
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("title,module")->from("#__modules")->where('id='.(int)$id);
        $db->setQuery($query);
        $result = $db->loadObject();
        $title = $result->title;
        $mod = $result->module;
        //echo'<pre>';var_dump($result);die;
        $module = AzuraModuleHelper::getModule( $mod, $title );
        //echo'<pre>';var_dump($module);die;
        $module->content = AzuraModuleHelper::renderModule( $module,array('style'=>$style));

        if($module->content){
            $app = JFactory::getApplication();
            $user = JFactory::getUser();
            $frontediting = ($app->isSite() && $app->get('frontediting', 1) && !$user->guest);

            $menusEditing = ($app->get('frontediting', 1) == 2) && $user->authorise('core.edit', 'com_menus');
            if ($frontediting && trim($module->content) != '' && $user->authorise('module.edit.frontend', 'com_modules.module.' . $module->id))
            {
                $displayData = array('moduleHtml' => &$module->content, 'module' => $module, 'position' => $module->position, 'menusediting' => $menusEditing);
                JLayoutHelper::render('joomla.edit.frontediting_modules', $displayData);
            }

        }
        return $module;
    }



    // Content Component Intergrated

    public static function getContentItems($catid, $limit='All', $order='created', $orderDir='ASC', $addFields = '',$child = '0'){
        //static $itemArray = array();
        //echo'<pre>';var_dump($child);die;
        $child = '0';

        if($child == '1'){
            return self::getContentItemsChild($catid, $limit, $order, $orderDir, $addFields);
        }

        $order = 'a.'.$order;
        if((int)$limit){
            $limit = (int) $limit;
        }else{
            $limit = 'All';
        }
        $db =  JFactory::getDbo();
        $query=$db->getQuery(true);
        $where = array('a.state=1');
        if($catid!=0){
            $where[]='catid='.(int)$catid;
        }
        $query  ->select('a.id,a.title,a.alias,a.introtext,a.fulltext,a.catid,c.alias as catalias,c.title as cattitle, c.description as catdesc')
                ->select('a.created,a.created_by,a.created_by_alias,a.ordering,a.images,a.urls,a.attribs');
       if(!empty($addFields)){
        $query  ->select($addFields);
       }

        $query  ->from('#__content AS a')
                ->join('INNER', '#__categories AS c ON (a.catid = c.id)')
                ->where($where)
                ->order($db->escape($order . ' ' . $orderDir));
        $db     ->setQuery($query,0,$limit);

        $articles = array();

        $temp = $db->loadObjectList();

        if(isset($temp) && count($temp)){
            foreach ($temp as $art) {
                $art->tags = new JHelperTags;
                $art->tags->getItemTags('com_content.article', $art->id);

                $articles[] = $art;
            }
        }


        return $articles;
    }

    public static function getArticlesTagsFilter($items){

        $catTags = array();

        //$allTags = array();

        $tags = array();

        if(count($items)){


            //require_once JPATH_BASE.'/components/com_k2/models/item.php';

            //$K2ModelItem = new K2ModelItem;

            foreach ($items as $item) {
                if(count($item->tags->itemTags)){
                    foreach ($item->tags->itemTags as $tag) {
                        $catTags[] = $tag->title;
                    }
                }
            }
            
            // if(!empty($catTags)){
            //     foreach ($catTags as $catTag) {
            //         if (!empty($catTag)) {
            //             foreach ($catTag as $tag) {
            //                 $allTags[] = $tag->name;
            //             }
            //         }
            //     }
            // }

            // $tags = array_unique($allTags);

            $tags = array_unique($catTags);
        }
        return $tags;
    }

    public static function getArticleTagsFilter($item,$implode = " ",$ucf = false){
        
        $tags = array();

        if(count($item->tags->itemTags)) {
            foreach ($item->tags->itemTags as $tag) {
                $tagName = str_replace(" ", "-", $tag->title);
                if($ucf === true){
                    $tags[] = ucfirst($tagName);
                }else{
                    $tags[] = strtolower($tagName);
                }
                
            }
        }
        
        return implode($implode, $tags);
    }


    // K2 Component Intergrated

    public static function getK2Items($catid, $limit='All', $order='created', $orderDir='DESC', $addFields = '',$child = '0'){
        //static $itemArray = array();
        //echo'<pre>';var_dump($child);die;
        if($child == '1'){
            return self::getK2ItemsChild($catid, $limit, $order, $orderDir, $addFields);
        }
        $order = 'a.'.$order;
        if((int)$limit){
            $limit = $limit;
        }else{
            $limit = 'All';
        }
        $db =  JFactory::getDbo();
        $query=$db->getQuery(true);
        $where = array('a.published=1','a.trash=0');
        if($catid!=0){
            $where[]='catid='.(int)$catid;
        }
        $query  ->select('a.id,a.title,a.alias,a.extra_fields,a.introtext,a.fulltext,a.catid,c.alias as categoryalias,c.name as c_name, c.description as c_desc')
                ->select('a.created,a.created_by,a.created_by_alias,a.ordering,a.image_caption,a.image_credits,a.params');
       if(!empty($addFields)){
        $query  ->select($addFields);
       }

        $query  ->from('#__k2_items AS a')
                ->join('INNER', '#__k2_categories AS c ON (a.catid = c.id)')
                ->where($where)
                ->order($db->escape($order . ' ' . $orderDir));
        $db     ->setQuery($query,0,$limit);

        //$return = $db->loadObjectList();

        return $db->loadObjectList();
    }

    public static function getK2ItemsChild($catid, $limit = 'All', $order = 'created', $orderDir='ASC',$addFields=''){
        $catarray = self::getK2CategoryChildren($catid);
        array_unshift($catarray, $catid);
        //echo'<pre>';var_dump($catarray);die;
        $catsitemsarray = array();

        foreach ($catarray as $cat) {
            $catitemsarray = self::getK2Items($cat,'All',$order,$orderDir);
            foreach ($catitemsarray as $item) {
                $itempush = array();
                $itempush['id'] = $item->id;
                $itempush['catname'] = $item->c_name;
                $itempush['catalias'] = $item->categoryalias;
                array_push($catsitemsarray, $itempush);
            }
        }

        $return = array();

        if(is_numeric($limit)){
            for ($i=0; $i < $limit ; $i++) { 
                if($i < count($catsitemsarray)){
                    $itemreturn = self::getK2Item($catsitemsarray[$i]['id']);
                    $itemreturn->catname = $catsitemsarray[$i]['catname'];
                    $itemreturn->catalias = $catsitemsarray[$i]['catalias'];
                    array_push($return, $itemreturn);
                }
            }
        }else{
            foreach ($catsitemsarray as $value) {
                $itemreturn = self::getK2Item($value['id']);
                $itemreturn->catname = $value['catname'];
                $itemreturn->catalias = $value['catalias'];
                array_push($return, $itemreturn);
            }
        }

        return $return;
    }

    public static function getK2Item($id,$addFields = ''){
        
        $db =  JFactory::getDbo();
        $query=$db->getQuery(true);
        $where = array('a.published=1','a.trash=0');
        if($id!=0){
            $where[]='id='.(int)$id;
        }
        $query  ->select('a.id,a.title,a.alias,a.extra_fields,a.introtext,a.fulltext,a.catid')
                ->select('a.created,a.modified,a.created_by,a.created_by_alias,a.ordering,a.image_caption,a.image_credits,a.params');
       if(!empty($addFields)){
                $query  ->select($addFields);
       }

        $query  ->from('#__k2_items AS a')

                ->where($where);
                //->join('INNER', '#__k2_categories AS c ON (a.catid = c.id)');
        $db     ->setQuery($query);

        $item = $db->loadObject();
        require_once (JPATH_SITE.'/components/com_k2/helpers/route.php');
        require_once JPATH_BASE.'/components/com_k2/models/item.php';
        require_once JPATH_BASE.'/components/com_k2/helpers/permissions.php';

        JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');

        $K2ModelItem = new K2ModelItem;


        $item = $K2ModelItem->prepareItem($item, 'category', 'itemlist');

        return $item;
    }

    public static function getK2Cat($catid=0){
        $db =  JFactory::getDbo();
        $query=$db->getQuery(true);
        //$where = array('a.id=1');
        if((int)$catid!=0){
            $where ='a.id='.(int)$catid;
        }
        $query      ->select('a.id,a.name,a.alias,a.description')
            ->from('#__k2_categories AS a')
            ->where($where)
            ->order('a.ordering ASC');
        $db->setQuery($query,0,1);

        return $db->loadObject();
    }

    public static function k2CatHasChildren($id)
    {

        $mainframe = JFactory::getApplication();
        $user = JFactory::getUser();
        $aid = (int)$user->get('aid');
        $id = (int)$id;
        $db = JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories  WHERE parent={$id} AND published=1 AND trash=0 ";
        if (K2_JVERSION != '15')
        {
            $query .= " AND access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
            if ($mainframe->getLanguageFilter())
            {
                $languageTag = JFactory::getLanguage()->getTag();
                $query .= " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
            }

        }
        else
        {
            $query .= " AND access <= {$aid}";
        }

        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo $db->stderr();
            return false;
        }

        if (count($rows))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function getK2CategoryChildren($catid)
    {

        static $array = array();
        $mainframe = JFactory::getApplication();
        $user = JFactory::getUser();
        $aid = (int)$user->get('aid');
        $catid = (int)$catid;
        $db = JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories WHERE parent={$catid} AND published=1 AND trash=0 ";
        if (K2_JVERSION != '15')
        {
            $query .= " AND access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
            if ($mainframe->getLanguageFilter())
            {
                $languageTag = JFactory::getLanguage()->getTag();
                $query .= " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
            }
        }
        else
        {
            $query .= " AND access <= {$aid}";
        }
        $query .= " ORDER BY ordering ";

        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo $db->stderr();
            return false;
        }
        foreach ($rows as $row)
        {
            array_push($array, $row->id);
            if (self::k2CatHasChildren($row->id))
            {
                self::getK2CategoryChildren($row->id);
            }
        }
        return $array;
    }


    public static function getK2ItemTagsFilter($item,$implode = " ",$ucf = false,$return_array = false){
        require_once JPATH_BASE.'/components/com_k2/models/item.php';

        $K2ModelItem = new K2ModelItem;

        $tags = array();
        $itemTags = $K2ModelItem->getItemTags($item->id);
        if(count($itemTags)) {
            foreach ($itemTags as $tag) {
                $tagName = str_replace(" ", "-", $tag->name);
                if($ucf === true){
                    $tags[] = ucfirst($tagName);
                }else{
                    $tags[] = strtolower($tagName);
                }
                
            }
        }
        if(!$return_array){
            $filter = implode($implode, $tags);
        }
        
        return $filter;
    }

    public static function getK2TagsFilter($items){

        $catTags = array();

        $allTags = array();

        $tags = array();

        if(count($items)){


            require_once JPATH_BASE.'/components/com_k2/models/item.php';

            $K2ModelItem = new K2ModelItem;

            foreach ($items as $item) {
                $catTags[] = $K2ModelItem->getItemTags($item->id);
            }
            
            if(!empty($catTags)){
                foreach ($catTags as $catTag) {
                    if (!empty($catTag)) {
                        foreach ($catTag as $tag) {
                            $allTags[] = $tag->name;
                        }
                    }
                }
            }

            $tags = array_unique($allTags);
        }
        return $tags;
    }

    public static function getK2ItemLink($id,$alias,$catid,$categoryalias){
        require_once (JPATH_SITE.'/components/com_k2/helpers/route.php');
        return urldecode(JRoute::_(K2HelperRoute::getItemRoute($id.':'.urlencode($alias), $catid.':'.urlencode($categoryalias))));
    }

    public static function getK2CategoryLink($catid){
        require_once (JPATH_SITE.'/components/com_k2/helpers/route.php');
        return urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($catid)));
    }

    public static function userGetName($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("name")->from("#__users")->where('id='.(int)$id);
        $db->setQuery($query);
        
        return $db->loadResult();
    }

    public static function getK2ItemRates($id){
        require_once JPATH_BASE.'/components/com_k2/models/item.php';

        $K2ModelItem = new K2ModelItem;

        $itemnumOfvotes = $K2ModelItem->getVotesNum($id);
        $itemvotingPercentage = $K2ModelItem->getVotesPercentage($id);

        if($itemnumOfvotes){
            if(preg_match('/([0-9]*)\s/', $itemnumOfvotes,$matches)){
                if($matches[1]){
                    $itemRated = round(($itemvotingPercentage/(int)$matches[1])*0.05);
                }else{
                    $itemRated = JText::_('COM_AZURAPAGEBUILDER_K2_ITEM_UN_RATED');
                }
            }else{
                $itemRated = JText::_('COM_AZURAPAGEBUILDER_K2_ITEM_UN_RATED');
            }

        }else{
            $itemRated = JText::_('COM_AZURAPAGEBUILDER_K2_ITEM_UN_RATED');
        }

        return $itemRated;
    }

    public static function getK2PostLikes($pk){
        if($pk > 0){
            $user   = JFactory::getUser();
            $db = JFactory::getDbo();

            $query = $db->getQuery(true);

            $query->select('*')
                ->from($db->quoteName('#__azurapagebuilder_likes'))
                ->where($db->quoteName('pageID') . ' = ' . (int) $pk .' AND '.$db->quoteName('option') . ' = ' . $db->quote("com_k2"));

            // Set the query and load the result.
            $db->setQuery($query);

            // Check for a database error.
            try
            {
                $like = $db->loadObject();
            }
            catch (RuntimeException $e)
            {
                JError::raiseWarning(500, $e->getMessage());

                return false;
            }

            $post_likes = new JRegistry;

            if(isset($like->like_count)){
                $post_likes->set('like_count',$like->like_count);
                if(!$user->guest){
                    $likedUsers_Reg = new JRegistry;
                    $likedUsers_Reg->loadString($like->likedUsers);
                    $likedUsers_Reg = $likedUsers_Reg->toArray();
                    if(array_search($user->id, $likedUsers_Reg) !== false){
                        $post_likes->set('like_status','liked');
                    }else{
                        $post_likes->set('like_status','unliked');
                    }
                }else{
                    $likedIPs_Reg = new JRegistry;
                    $likedIPs_Reg->loadString($like->likedIPs);
                    $likedIPs_Reg = $likedIPs_Reg->toArray();

                    $userIP = $_SERVER['REMOTE_ADDR'];

                    if(array_search($userIP, $likedIPs_Reg) !== false){
                        $post_likes->set('like_status','liked');
                    }else{
                        $post_likes->set('like_status','unliked');
                    }
                }
            }else{
                $post_likes->set('like_count',0);
                $post_likes->set('like_status','unliked');
            }

            return $post_likes;

        }

        return false;
    }

    /**
     * Get list of available two factor methods
     *
     * @return array
     */
    public static function getTwoFactorMethods()
    {
        require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';

        return UsersHelper::getTwoFactorMethods();
    }

    /**
     * Retrieve the url where the user should be returned after logging in
     *
     * @param   JRegistry  $params  module parameters
     * @param   string     $type    return type
     *
     * @return string
     */
    public static function getReturnURL($itemid='')
    {
        $app    = JFactory::getApplication();
        $router = $app::getRouter();
        $url = null;

        if ($itemid)
        {
            $db     = JFactory::getDbo();
            $query  = $db->getQuery(true)
                ->select($db->quoteName('link'))
                ->from($db->quoteName('#__menu'))
                ->where($db->quoteName('published') . '=1')
                ->where($db->quoteName('id') . '=' . $db->quote($itemid));

            $db->setQuery($query);

            if ($link = $db->loadResult())
            {
                if ($router->getMode() == JROUTER_MODE_SEF)
                {
                    $url = 'index.php?Itemid=' . $itemid;
                }
                else
                {
                    $url = $link . '&Itemid=' . $itemid;
                }
            }
        }

        if (!$url)
        {
            // Stay on the same page
            $uri = clone JUri::getInstance();
            $vars = $router->parse($uri);
            unset($vars['lang']);

            if ($router->getMode() == JROUTER_MODE_SEF)
            {
                if (isset($vars['Itemid']))
                {
                    $itemid = $vars['Itemid'];
                    $menu = $app->getMenu();
                    $item = $menu->getItem($itemid);
                    unset($vars['Itemid']);

                    if (isset($item) && $vars == $item->query)
                    {
                        $url = 'index.php?Itemid=' . $itemid;
                    }
                    else
                    {
                        $url = 'index.php?' . JUri::buildQuery($vars) . '&Itemid=' . $itemid;
                    }
                }
                else
                {
                    $url = 'index.php?' . JUri::buildQuery($vars);
                }
            }
            else
            {
                $url = 'index.php?' . JUri::buildQuery($vars);
            }
        }

        return base64_encode($url);
    }
}

function cth_shortcode_atts( $pairs, $atts, $shortcode = '' ) {
    $atts = (array)$atts;
    $out = array();
    foreach($pairs as $name => $default) {
        if ( array_key_exists($name, $atts) )
            $out[$name] = $atts[$name];
        else
            $out[$name] = $default;
    }
    /**
     * Filter a shortcode's default attributes.
     *
     * If the third parameter of the shortcode_atts() function is present then this filter is available.
     * The third parameter, $shortcode, is the name of the shortcode.
     *
     * @since 3.6.0
     *
     * @param array $out The output array of shortcode attributes.
     * @param array $pairs The supported attributes and their defaults.
     * @param array $atts The user defined shortcode attributes.
     */
    // if ( $shortcode )
    //     $out = apply_filters( "shortcode_atts_{$shortcode}", $out, $pairs, $atts );

    return $out;
}

ElementParser::addShortcodeFiles();


class AzuraModuleHelper extends JModuleHelper {

    /**
     * Get module by name (real, eg 'Breadcrumbs' or folder, eg 'mod_breadcrumbs')
     *
     * @param   string  $name   The name of the module
     * @param   string  $title  The title of the module, optional
     *
     * @return  object  The Module object
     *
     * @since   1.5
     */
    public static function &getModule($name, $title = null)
    {
        $result = null;
        $modules =& static::load();
        //echo'<pre>';var_dump($modules);die;
        $total = count($modules);

        for ($i = 0; $i < $total; $i++)
        {
            // Match the name of the module
            if ($modules[$i]->name == $name || $modules[$i]->module == $name)
            {
                // Match the title if we're looking for a specific instance of the module
                if (!$title || $modules[$i]->title == $title)
                {
                    // Found it
                    $result = &$modules[$i];
                    break;
                }
            }
        }

        // If we didn't find it, and the name is mod_something, create a dummy object
        if (is_null($result) && substr($name, 0, 4) == 'mod_')
        {
            $result            = new stdClass;
            $result->id        = 0;
            $result->title     = '';
            $result->module    = $name;
            $result->position  = '';
            $result->content   = '';
            $result->showtitle = 0;
            $result->control   = '';
            $result->params    = '';
        }

        return $result;
    }

    /**
     * Load published modules.
     *
     * @return  array
     *
     * @since   3.2
     */
    protected static function &load()
    {
        static $clean;

        if (isset($clean))
        {
            return $clean;
        }

        $app = JFactory::getApplication();
        $Itemid = $app->input->getInt('Itemid');
        $user = JFactory::getUser();
        $groups = implode(',', $user->getAuthorisedViewLevels());
        $lang = JFactory::getLanguage()->getTag();
        $clientId = (int) $app->getClientId();

        $db = JFactory::getDbo();

        $query = $db->getQuery(true)
            ->select('m.id, m.title, m.module, m.position, m.content, m.showtitle, m.params, mm.menuid')
            ->from('#__modules AS m')
            ->join('LEFT', '#__modules_menu AS mm ON mm.moduleid = m.id')
            ->where('m.published = 1')

            ->join('LEFT', '#__extensions AS e ON e.element = m.module AND e.client_id = m.client_id')
            ->where('e.enabled = 1');

        $date = JFactory::getDate();
        $now = $date->toSql();
        $nullDate = $db->getNullDate();
        $query->where('(m.publish_up = ' . $db->quote($nullDate) . ' OR m.publish_up <= ' . $db->quote($now) . ')')
            ->where('(m.publish_down = ' . $db->quote($nullDate) . ' OR m.publish_down >= ' . $db->quote($now) . ')')

            ->where('m.access IN (' . $groups . ')')
            ->where('m.client_id = ' . $clientId);
            //->where('(mm.menuid = ' . (int) $Itemid . ' OR mm.menuid <= 0)');

        // Filter by language
        if ($app->isSite() && $app->getLanguageFilter())
        {
            $query->where('m.language IN (' . $db->quote($lang) . ',' . $db->quote('*') . ')');
        }

        $query->order('m.position, m.ordering');

        // Set the query
        $db->setQuery($query);
        $clean = array();

        try
        {
            $modules = $db->loadObjectList();
            // all modules loaded after here
            //echo'<pre>';var_dump($modules);die;
        }
        catch (RuntimeException $e)
        {
            JLog::add(JText::sprintf('JLIB_APPLICATION_ERROR_MODULE_LOAD', $e->getMessage()), JLog::WARNING, 'jerror');

            return $clean;
        }

        // Apply negative selections and eliminate duplicates
        $negId = $Itemid ? -(int) $Itemid : false;
        $dupes = array();

        for ($i = 0, $n = count($modules); $i < $n; $i++)
        {
            $module = &$modules[$i];

            // The module is excluded if there is an explicit prohibition
            // Forced this false to load all module
            $negHit = false;//($negId === (int) $module->menuid);

            if (isset($dupes[$module->id]))
            {
                // If this item has been excluded, keep the duplicate flag set,
                // but remove any item from the cleaned array.
                if ($negHit)
                {
                    unset($clean[$module->id]);
                }

                continue;
            }

            $dupes[$module->id] = true;

            // Only accept modules without explicit exclusions.
            if (!$negHit)
            {
                $module->name = substr($module->module, 4);
                $module->style = null;
                $module->position = strtolower($module->position);
                $clean[$module->id] = $module;
            }
        }

        unset($dupes);

        // Return to simple indexing that matches the query order.
        $clean = array_values($clean);

        return $clean;
    }

    /**
     * Render the module.
     *
     * @param   object  $module   A module object.
     * @param   array   $attribs  An array of attributes for the module (probably from the XML).
     *
     * @return  string  The HTML content of the module output.
     *
     * @since   1.5
     */
    public static function renderModule($module, $attribs = array())
    {
        static $chrome;

        // Check that $module is a valid module object
        if (!is_object($module) || !isset($module->module) || !isset($module->params))
        {
            if (defined('JDEBUG') && JDEBUG)
            {
                JLog::addLogger(array('text_file' => 'jmodulehelper.log.php'), JLog::ALL, array('modulehelper'));
                JLog::add('JModuleHelper::renderModule($module) expects a module object', JLog::DEBUG, 'modulehelper');
            }

            return;
        }

        if (defined('JDEBUG'))
        {
            JProfiler::getInstance('Application')->mark('beforeRenderModule ' . $module->module . ' (' . $module->title . ')');
        }

        $app = JFactory::getApplication();

        // Record the scope.
        $scope = $app->scope;

        // Set scope to component name
        $app->scope = $module->module;

        // Get module parameters
        $params = new JRegistry;
        $params->loadString($module->params);

        // Get the template
        $template = $app->getTemplate();

        // Get module path
        $module->module = preg_replace('/[^A-Z0-9_\.-]/i', '', $module->module);
        $path = JPATH_BASE . '/modules/' . $module->module . '/' . $module->module . '.php';

        // Load the module
        if (file_exists($path))
        {
            $lang = JFactory::getLanguage();

            // 1.5 or Core then 1.6 3PD
            $lang->load($module->module, JPATH_BASE, null, false, true) ||
                $lang->load($module->module, dirname($path), null, false, true);

            $content = '';
            ob_start();
            include $path;
            $module->content = ob_get_contents() . $content;
            ob_end_clean();
        }

        // Load the module chrome functions
        if (!$chrome)
        {
            $chrome = array();
        }

        include_once JPATH_THEMES . '/system/html/modules.php';
        $chromePath = JPATH_THEMES . '/' . $template . '/html/modules.php';

        if (!isset($chrome[$chromePath]))
        {
            if (file_exists($chromePath))
            {
                include_once $chromePath;
            }

            $chrome[$chromePath] = true;
        }
        // Check if the current module has a style param to override template module style
        // $paramsChromeStyle = $params->get('style');

        // if ($paramsChromeStyle)
        // {
        //     $attribs['style'] = preg_replace('/^(system|' . $template . ')\-/i', '', $paramsChromeStyle);
        // }

        $attribs['style'] = preg_replace('/^(system|' . $template . ')\-/i', '', $attribs['style']);

        // Make sure a style is set
        if (!isset($attribs['style']))
        {
            $attribs['style'] = 'none';
        }

        // Dynamically add outline style
        if ($app->input->getBool('tp') && JComponentHelper::getParams('com_templates')->get('template_positions_display'))
        {
            $attribs['style'] .= ' outline';
        }

        foreach (explode(' ', $attribs['style']) as $style)
        {
            $chromeMethod = 'modChrome_' . $style;

            // Apply chrome and render module
            if (function_exists($chromeMethod))
            {
                $module->style = $attribs['style'];

                ob_start();
                $chromeMethod($module, $params, $attribs);
                $module->content = ob_get_contents();
                ob_end_clean();
            }
        }

        // Revert the scope
        $app->scope = $scope;

        if (defined('JDEBUG'))
        {
            JProfiler::getInstance('Application')->mark('afterRenderModule ' . $module->module . ' (' . $module->title . ')');
        }

        return $module->content;
    }

    public static function loadposition($position, $style = -2)
    {
        $document   = JFactory::getDocument();
        $renderer   = $document->loadRenderer('module');
        $params     = array('style'=>$style);

        $contents = '';
        foreach (JModuleHelper::getModules($position) as $mod)  {
            $contents .= $renderer->render($mod, $params);
        }
        return $contents;
    }

    public static function treerecurse(&$params, $id = 0, $level = 0, $begin = false)
    {

        static $output;
        if ($begin)
        {
            $output = '';
        }
        $mainframe = JFactory::getApplication();
        $root_id = (int)$params->get('root_id');
        $end_level = $params->get('end_level', NULL);
        $id = (int)$id;
        $catid = JRequest::getInt('id');
        $option = JRequest::getCmd('option');
        $view = JRequest::getCmd('view');

        $user = JFactory::getUser();
        $aid = (int)$user->get('aid');
        $db = JFactory::getDBO();

        switch ($params->get('categoriesListOrdering'))
        {

            case 'alpha' :
                $orderby = 'name';
                break;

            case 'ralpha' :
                $orderby = 'name DESC';
                break;

            case 'order' :
                $orderby = 'ordering';
                break;

            case 'reversedefault' :
                $orderby = 'id DESC';
                break;

            default :
                $orderby = 'id ASC';
                break;
        }

        if (($root_id != 0) && ($level == 0))
        {
            $query = "SELECT * FROM #__k2_categories WHERE parent={$root_id} AND published=1 AND trash=0 ";

        }
        else
        {
            $query = "SELECT * FROM #__k2_categories WHERE parent={$id} AND published=1 AND trash=0 ";
        }

        if (K2_JVERSION != '15')
        {
            $query .= " AND access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
            if ($mainframe->getLanguageFilter())
            {
                $languageTag = JFactory::getLanguage()->getTag();
                $query .= " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
            }

        }
        else
        {
            $query .= " AND access <= {$aid}";
        }

        $query .= " ORDER BY {$orderby}";

        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo $db->stderr();
            return false;
        }

        if ($level < intval($end_level) || is_null($end_level))
        {
            $output .= '<ul './*.($params->get('moduleclass_sfx')? 'class="'.$params->get('moduleclass_sfx').'"': '').*/'>';
            foreach ($rows as $row)
            {
                if ($params->get('categoriesListItemsCounter'))
                {
                    $row->numOfItems = modK2ToolsHelper::countCategoryItems($row->id);
                }
                else
                {
                    $row->numOfItems = '';
                }

                if (($option == 'com_k2') && ($view == 'itemlist') && ($catid == $row->id))
                {
                    $active = ' class="active"';
                }
                else
                {
                    $active = '';
                }


                if (modK2ToolsHelper::hasChildren($row->id))
                {
                    $output .= '<li'.$active.'><p><a href="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.':'.urlencode($row->alias)))).'">'.$row->name.'</a> <span>'.$row->numOfItems.'</span></p>';
                    treerecurse($params, $row->id, $level + 1);
                    $output .= '</li>';
                }
                else
                {
                    $output .= '<li'.$active.'><p><a href="'.urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($row->id.':'.urlencode($row->alias)))).'">'.$row->name.'</a> <span>'.$row->numOfItems.'</span></p>';
                }
            }
            $output .= '</ul>';
        }

        return $output;
    }

    public static function calendar($params)
    {
        require_once (JPATH_SITE.DS.'administrator/components/com_azurapagebuilder/helpers/k2calendarhelper.php');

        $month = JRequest::getInt('month');
        $year = JRequest::getInt('year');

        $months = array(
            JText::_('K2_JANUARY'),
            JText::_('K2_FEBRUARY'),
            JText::_('K2_MARCH'),
            JText::_('K2_APRIL'),
            JText::_('K2_MAY'),
            JText::_('K2_JUNE'),
            JText::_('K2_JULY'),
            JText::_('K2_AUGUST'),
            JText::_('K2_SEPTEMBER'),
            JText::_('K2_OCTOBER'),
            JText::_('K2_NOVEMBER'),
            JText::_('K2_DECEMBER'),
        );
        $days = array(
            JText::_('CTH_K2_SUN'),
            JText::_('CTH_K2_MON'),
            JText::_('CTH_K2_TUE'),
            JText::_('CTH_K2_WED'),
            JText::_('CTH_K2_THU'),
            JText::_('CTH_K2_FRI'),
            JText::_('CTH_K2_SAT'),
        );

        $cal = new CTHCalendar;
        $cal->category = $params->get('calendarCategory', 0);
        $cal->setStartDay(1);
        $cal->setMonthNames($months);
        $cal->setDayNames($days);

        if (($month) && ($year))
        {
            return $cal->getMonthView($month, $year);
        }
        else
        {
            return $cal->getCurrentMonthView();
        }
    }

}