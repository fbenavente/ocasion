<?php 
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die;

$app = JFactory::getApplication();
//echo'<pre>';var_dump($element->attrs->columnwidthclass);die;
?>
<div class="azura-element iscontainer"  data-typeName="AzuraContainer">
	<div class="azura-element-wrapper azura-element-type-azuracontainer clearfix">
        <div class="azura-element-tools">
	        <a href="javascrip:void(0)" class="container-addele"><i class="fa fa-plus"></i></a>
	        <a href="javascrip:void(0)" class="element-configs"><i class="fa fa-pencil"></i></a>
	        <a href="javascrip:void(0)" class="element-copy"><i class="fa fa-copy"></i></a>
	        <a href="javascrip:void(0)" class="element-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <div class="azura-elements-container">
		<?php
		if(count($element->children)) {
			foreach ($element->children as $child) {
				$this->parseElement($child);
			}
		}
		  ?>
	</div>
		<?php
		$storedData = $element;
		unset($storedData->children);

	 //echo'<pre>';var_dump($storedData);die;?>

	<div class="azura-element-settings-saved saved" data="<?php echo rawurlencode(json_encode($storedData));?>"></div>
</div>

