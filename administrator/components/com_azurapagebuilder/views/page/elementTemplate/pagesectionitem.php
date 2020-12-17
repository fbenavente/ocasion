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
<div class="column-parent pagesection <?php echo (!empty($element->attrs->columnwidthclass)? $element->attrs->columnwidthclass : 'col-md-12');?><?php echo (isset($element->attrs->smoffsetclass)? ' '.$element->attrs->smoffsetclass : ' col-sm-offset-0');?>"  data-typeName="<?php echo $element->type;?>">
	<div class="section-item">
        <h3><?php echo (!empty($element->name)? $element->name : "Section Item");?></h3>

        <div class="azura-element-tools">
            <a href="javascrip:void(0)" class="sec-child-configs"><i class="fa fa-pencil"></i></a>
            <a href="javascrip:void(0)" class="sec-child-copy"><i class="fa fa-copy"></i></a>
            <a href="javascrip:void(0)" class="sec-child-remove"><i class="fa fa-times"></i></a>
        </div>

    </div>
	<?php
	$storedData = $element;
	unset($storedData->children); ?>

	<div class="azura-element-settings-saved saved" data="<?php echo rawurlencode(json_encode($storedData));?>"></div>
</div>

