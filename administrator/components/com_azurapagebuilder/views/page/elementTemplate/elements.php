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
//echo'<pre>';var_dump($ele);die;
?>
<?php if($ele->typename === 'AzuraRow') :?>
<div class="mix azura-element pagesection <?php echo strtolower(str_replace(" ", "_", $ele->category));?> isrow" data-ele="<?php echo rawurlencode(json_encode($ele));?>">
	<div class="azura-element-wrapper azura-element-type-<?php echo strtolower($ele->typename);?> clearfix">
		<img class="element-icon" src="<?php echo JURI::root(true).'/media/com_azurapagebuilder/elements-icon/'. strtolower(substr($ele->typename, 5));?>-icon.png" alt="<?php echo strtolower(substr($ele->typename, 5));?>" width="24" height="24">
		<h3><?php echo $ele->name;?></h3>
		<?php if(!empty($ele->description)) :?>
			<span class="element-description"><?php echo $ele->description;?></span>
		<?php endif;?>

	</div>
</div>
<?php else :?>
	<?php if($ele->ispagesection === 'yes') :?>
	<div class="mix azura-element pagesection <?php echo strtolower(str_replace(" ", "_", $ele->category));?>" data-ele="<?php echo rawurlencode(json_encode($ele));?>">
		<div class="azura-element-wrapper azura-element-type-<?php echo strtolower($ele->typename);?> clearfix">
			<img class="element-icon" src="<?php echo JURI::root(true).'/media/com_azurapagebuilder/elements-icon/'. strtolower(substr($ele->typename, 5));?>-icon.png" alt="<?php echo strtolower(substr($ele->typename, 5));?>" width="24" height="24">
			<h3><?php echo $ele->name;?></h3>
			<?php if(!empty($ele->description)) :?>
				<span class="element-description"><?php echo $ele->description;?></span>
			<?php endif;?>

		</div>
	</div>
	<?php else :?>
	<div class="mix azura-element <?php echo strtolower(str_replace(" ", "_", $ele->category));?>" data-typeName="<?php echo $ele->typename;?>">
		<div class="azura-element-wrapper azura-element-type-<?php echo strtolower($ele->typename);?> clearfix">
			<img class="element-icon" src="<?php echo JURI::root(true).'/media/com_azurapagebuilder/elements-icon/'. strtolower(substr($ele->typename, 5));?>-icon.png" alt="<?php echo strtolower(substr($ele->typename, 5));?>" width="24" height="24">
			<h3><?php echo $ele->name;?></h3>
			<?php if(!empty($ele->description)) :?>
				<span class="element-description"><?php echo $ele->description;?></span>
			<?php endif;?>
			<div class="azura-element-tools">
				<a href="javascrip:void(0)" class="element-configs"><i class="fa fa-pencil"></i></a>
				<a href="javascrip:void(0)" class="element-copy"><i class="fa fa-copy"></i></a>
				<a href="javascrip:void(0)" class="element-remove"><i class="fa fa-times"></i></a>
			</div>

		</div>

		<?php if($ele->hasownchild === 'yes') :?>
		<div class="azura-element-children">

			<div class="azura-element-child" data-typeName="<?php echo $ele->childtypename;?>">
				<div class="azura-element-wrapper azura-element-type-<?php echo strtolower($ele->childtypename);?> clearfix">
					<h3><?php echo $ele->childname;?></h3>
					
					<div class="azura-element-tools">
						<a href="javascrip:void(0)" class="element-child-configs"><i class="fa fa-pencil"></i></a>
						<a href="javascrip:void(0)" class="element-child-copy"><i class="fa fa-copy"></i></a>
						<a href="javascrip:void(0)" class="element-child-remove"><i class="fa fa-times"></i></a>
					</div>

				</div>
				<div class="azura-element-settings-saved saved" data="<?php echo rawurlencode('{"type":"'.$ele->childtypename.'","id": "0","published":"1","language":"*", "content":"","attrs":{}}');?>"></div>
			</div>

		</div>

		<?php endif;?>

		<div class="azura-element-settings-saved saved" data="<?php echo rawurlencode('{"type":"'.$ele->typename.'","id": "0","published":"1","language":"*", "content":"","attrs":{}}');?>"></div>
		
	</div>
	<?php endif;?>
	
<?php endif;?>