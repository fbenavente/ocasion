 <?php
 /**
 * @package Hoxa - Responsive Multipurpose Joomla Template
 * @author Cththemes - www.cththemes.com
 * @date: 01-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
 // No direct access
 defined('_JEXEC') or die('Restricted access');
 
 jimport('joomla.form.formfield');
 
 /**
  * Book form field class
  */
 class JFormFieldFontReset extends JFormField
 {
        /**
         * field type
         * @var string
         */
        protected $type = 'FontReset';


        /**
   * Method to get the field input markup
   */
  protected function getInput()
  {
      $doc = JFactory::getDocument();
  
  			$scripts = array();

        $scripts[] = 'jQuery(document).ready(function($){';
            $scripts[] = '$(\'#resetFontButton\').click(function(){';
                $scripts[] = "$('#jform_params_importfont').val(\"<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,300,700' rel='stylesheet' type='text/css'><link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>\");";
                $scripts[] = "$('#jform_params_fontstyle').val(\"body {font-family: 'Open Sans', Helvetica, Arial, sans-serif;}h1, h2, h3, h4, h5, h6,.h1, .h2, .h3, .h4, .h5, .h6 {font-family: 'Raleway', 'Open Sans', Helvetica, Arial, sans-serif;}\");";
                
            $scripts[] = '});';
        $scripts[] = '});';


        $doc->addScriptDeclaration(implode("\n", $scripts));

$html[] = '<a role="button" id="resetFontButton" class="btn btn-warning">Reset Fonts</a>';
 
 
       
 
          return implode("\n", $html);
  }
 
 }