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
?>
<div class="azura-element-child" data-typeName="<?php echo $element->type;?>">
	<div class="azura-element-wrapper azura-element-type-<?php echo strtolower($element->type);?> clearfix">
		
		<?php if(!empty($element->name)):?>
				<h3><?php echo strip_tags($element->name);?></h3>
		<?php else :
		echo '<h3>'.$azuraelements[$element->type]->name.'</h3>';

		endif; ?>
		<div class="azura-element-tools">
			<a href="javascrip:void(0)" class="element-child-configs"><i class="fa fa-pencil"></i></a>
			<a href="javascrip:void(0)" class="element-child-copy"><i class="fa fa-copy"></i></a>
			<a href="javascrip:void(0)" class="element-child-remove"><i class="fa fa-times"></i></a>
		</div>

	</div>
	<?php
		$storedData = $element;
		unset($storedData->children);?>
	<div class="azura-element-settings-saved saved" data="<?php echo rawurlencode(json_encode($storedData));?>"></div>
	
</div>
