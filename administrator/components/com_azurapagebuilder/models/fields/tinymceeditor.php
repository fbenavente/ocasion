<?php
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Form Field class for the Joomla Platform.
 * Supports a multi line area for entry of plain text
 *
 * @link   http://www.w3.org/TR/html-markup/textarea.html#textarea
 * @since  11.1
 */
class JFormFieldTinyMCEEditor extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'TinyMCEEditor';

	/**
	 * The number of rows in textarea.
	 *
	 * @var    mixed
	 * @since  3.2
	 */
	//protected $rows;

	/**
	 * The number of columns in textarea.
	 *
	 * @var    mixed
	 * @since  3.2
	 */
	//protected $mode;

	/**
	 * Method to get certain otherwise inaccessible properties from the form field object.
	 *
	 * @param   string  $name  The property name for which to the the value.
	 *
	 * @return  mixed  The property value or null.
	 *
	 * @since   3.2
	 */
	// public function __get($name)
	// {
	// 	switch ($name)
	// 	{
	// 		case 'mode':
	// 			return $this->$name;
	// 	}

	// 	return parent::__get($name);
	// }

	/**
	 * Method to set certain otherwise inaccessible properties of the form field object.
	 *
	 * @param   string  $name   The property name for which to the the value.
	 * @param   mixed   $value  The value of the property.
	 *
	 * @return  void
	 *
	 * @since   3.2
	 */
	// public function __set($name, $value)
	// {
	// 	switch ($name)
	// 	{
	// 		case 'mode':
	// 			$this->$name = $value;
	// 			break;

	// 		default:
	// 			parent::__set($name, $value);
	// 	}
	// }

	/**
	 * Method to attach a JForm object to the field.
	 *
	 * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the <field /> tag for the form field object.
	 * @param   mixed             $value    The form field value to validate.
	 * @param   string            $group    The field name group control value. This acts as as an array container for the field.
	 *                                      For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                      full field name would end up being "bar[foo]".
	 *
	 * @return  boolean  True on success.
	 *
	 * @see     JFormField::setup()
	 * @since   3.2
	 */
	// public function setup(SimpleXMLElement $element, $value, $group = null)
	// {
	// 	$return = parent::setup($element, $value, $group);

	// 	if ($return)
	// 	{
	// 		$this->mode    = isset($this->element['mode']) ? $this->element['mode'] : 'html';
	// 		//$this->columns = isset($this->element['cols']) ? (int) $this->element['cols'] : false;
	// 	}

	// 	return $return;
	// }

	/**
	 * Method to get the textarea field input markup.
	 * Use the rows and columns attributes to specify the dimensions of the area.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		// Translate placeholder text
		$hint = $this->translateHint ? JText::_($this->hint) : $this->hint;

		// Initialize some field attributes.
		$class        = !empty($this->class) ? ' class="' . $this->class . '"' : '';
		// $disabled     = $this->disabled ? ' disabled' : '';
		// $readonly     = $this->readonly ? ' readonly' : '';
		// $columns      = $this->columns ? ' cols="' . $this->columns . '"' : '';
		// $rows         = $this->rows ? ' rows="' . $this->rows . '"' : '';
		// $required     = $this->required ? ' required aria-required="true"' : '';
		// $hint         = $hint ? ' placeholder="' . $hint . '"' : '';
		// $autocomplete = !$this->autocomplete ? ' autocomplete="off"' : ' autocomplete="' . $this->autocomplete . '"';
		// $autocomplete = $autocomplete == ' autocomplete="on"' ? '' : $autocomplete;
		// $autofocus    = $this->autofocus ? ' autofocus' : '';
		// $spellcheck   = $this->spellcheck ? '' : ' spellcheck="false"';

		// // Initialize JavaScript field attributes.
		// $onchange = $this->onchange ? ' onchange="' . $this->onchange . '"' : '';
		// $onclick = $this->onclick ? ' onclick="' . $this->onclick . '"' : '';

		// Including fallback code for HTML5 non supported browsers.
		JHtml::_('jquery.framework');
		JHtml::_('script', 'system/html5fallback.js', false, true);
		//$tem_name = JFactory::getApplication('site')->getTemplate();

		return 	'<div class="tiny_mce_wrapper"><div class="tiny_mce_wrapper_wrapper"><textarea id="tiny_mce_editor"'.$class.'>'
					. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8')
				.'</textarea></div></div>'
				.'<script src="'.JURI::root(true).'/administrator/components/com_azurapagebuilder/assets/tinymce/tinymce.min.js" type="text/javascript" charset="utf-8"></script>'
				.'<script>'
				    //.'var ace_editor = ace.edit("ace_editor");'
				    //.'ace_editor.setTheme("ace/theme/monokai");'
				    //.'ace_editor.getSession().setMode("ace/mode/'.$this->mode.'");'
					.'tinymce.init({selector: "textarea#tiny_mce_editor",'
						.'theme: "modern",'
					    //.'width: 300,'
					    //.'height: 300,'
					    .'plugins: ['
					        .'"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",'
					        .'"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",'
					        .'"save table contextmenu directionality emoticons template paste textcolor"'
					   	.'],'
					   	//.'content_css: "'.JURI::root(true).'/templates/'.$tem_name.'/css/editor-style.css",'
					   	.'toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", '
					   	.'style_formats: ['
					        .'{title: "Bold text", inline: "b"},'
					        .'{title: \'Red text\', inline: \'span\', styles: {color: \'#ff0000\'}},'
					        .'{title: \'Red header\', block: \'h1\', styles: {color: \'#ff0000\'}},'
					        .'{title: \'Example 1\', inline: \'span\', classes: \'example1\'},'
					        .'{title: \'Example 2\', inline: \'span\', classes: \'example2\'},'
					        .'{title: \'Table styles\'},'
					        .'{title: \'Table row 1\', selector: \'tr\', classes: \'tablerow1\'}'
					    .']'
					.'});'
				.'</script>';
	}
}
