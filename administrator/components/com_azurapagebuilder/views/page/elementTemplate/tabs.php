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
//echo'<pre>';var_dump($element);die;
?>
<div class="azura-element" data-typeName="AzuraTabs">
	<div class="azura-element-wrapper azura-element-type-azuratabs clearfix">
		<img class="element-icon" src="<?php echo JURI::base(true).'/components/com_azurapagebuilder/assets/images/elements/'. strtolower(substr($element->type, 5));?>-icon.png" alt="<?php echo strtolower(substr($element->type, 5));?>" width="24" height="24">
		<!-- <span class="azura-element-title"><?php echo $element->elementTypeName;?><?php if(!empty($element->name)) echo ' - '.$element->name;?></span> -->
		<h3><?php echo $element->elementTypeName;?></h3>
		<div class="azura-element-tools">
			<a href="javascrip:void(0)" class="element-configs"><i class="fa fa-pencil"></i></a>
			<a href="javascrip:void(0)" class="element-copy"><i class="fa fa-copy"></i></a>
			<a href="javascrip:void(0)" class="element-remove"><i class="fa fa-times"></i></a>
		</div>

	</div>

	<div class="azura-element-children">
		<?php
		if(count($element->children)) {
			foreach ($element->children as $child) {
				$this->parseElement($child);
			}
		}else{ ?>

		<div class="azura-element-child" data-typeName="AzuraTabsItem">
			<div class="azura-element-wrapper azura-element-type-azuratabsitem clearfix">
				<h3>Tab Item</h3>
				
				<div class="azura-element-tools">
					<a href="javascrip:void(0)" class="element-child-configs"><i class="fa fa-pencil"></i></a>
					<a href="javascrip:void(0)" class="element-child-copy"><i class="fa fa-copy"></i></a>
					<a href="javascrip:void(0)" class="element-child-remove"><i class="fa fa-times"></i></a>
				</div>

			</div>
			<div class="azura-element-settings-saved saved" data="<?php echo rawurlencode('{"type":"AzuraTabsItem","id": "0","published":"1","language":"*", "content":"","attrs":{}}');?>"></div>
		</div>

		<?php } ?>
	</div>
	<?php
		$storedData = $element;
		//unset($storedData->children);?>
	<div class="azura-element-settings-saved saved" data="<?php echo rawurlencode(json_encode($storedData));?>"></div>
	
</div>
