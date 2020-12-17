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
<div class="column-parent <?php echo (!empty($element->attrs->columnwidthclass)? str_replace("col-md-", "col-sm-", $element->attrs->columnwidthclass) : 'col-sm-12');?><?php echo (isset($element->attrs->smoffsetclass)? ' '.$element->attrs->smoffsetclass : ' col-sm-offset-0');?><?php echo (isset($element->attrs->mdwidthclass)? ' '.$element->attrs->mdwidthclass : '');?><?php echo (isset($element->attrs->mdoffsetclass)? ' '.$element->attrs->mdoffsetclass : '');?><?php echo (isset($element->attrs->lgwidthclass)? ' '.$element->attrs->lgwidthclass : '');?><?php echo (isset($element->attrs->lgoffsetclass)? ' '.$element->attrs->lgoffsetclass : '');?>"  data-typeName="AzuraColumn">
	<div class="column-wrapper">
		<div class="col-name">
			<span><?php if(!empty($element->name)) echo strip_tags($element->name);?></span>
		</div>
		<div class="col-settings">
			<a class="col-tools-name" href="javascript:void(0);">Column Tools</a>
			<a class="add-container" href="javascript:void(0)" title="Add Container element"><i class="fa fa-plus-circle"></i></a>
			<a class="add-element" href="javascript:void(0)" title="Add elements"><i class="fa fa-plus-circle"></i></a>
			<a class="column-configs" href="javascript:void(0)" title="Config"><i class="fa fa-cog"></i></a>
			<a class="column-duplicate" href="javascript:void(0)" title="Copy Column"><i class="fa fa-copy"></i></a>
			<a class="column-delete" href="javascript:void(0)" title="Delete Column"><i class="fa fa-times"></i></a>
		</div>
		<div class="clearfix"></div>
		<div class="column"><?php
			if(count($element->children)) {
				foreach ($element->children as $child) {
					$this->parseElement($child);
				}
			}
			  ?></div>
	</div>
	
		<?php
		$storedData = $element;
		unset($storedData->children);

	 //echo'<pre>';var_dump($storedData);die;?>

	<div class="azura-element-settings-saved saved" data="<?php echo rawurlencode(json_encode($storedData));?>"></div>
</div>

