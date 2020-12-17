<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>


<?php if(isset($this->leading) && count($this->leading)): 
$leadingCount = count($this->leading);
?>
<!-- Leading items -->
	<?php foreach($this->leading as $item): ?>

		<?php
			// Load category_item.php by default
			$this->item=$item;
			echo $this->loadTemplate('item');
		?>
	<?php endforeach; ?>
<?php endif; ?>

<?php if(isset($this->primary) && count($this->primary)): ?>
<!-- Primary items -->
	<?php foreach($this->primary as $item): ?>

		<?php
			// Load category_item.php by default
			$this->item=$item;
			echo $this->loadTemplate('item');
		?>
	<?php endforeach; ?>
<?php endif; ?>

<?php if(isset($this->secondary) && count($this->secondary)): ?>
<!-- Secondary items -->
	<?php foreach($this->secondary as $item): ?>
	
	
		<?php
			// Load category_item.php by default
			$this->item=$item;
			echo $this->loadTemplate('item');
		?>

	<?php endforeach; ?>
<?php endif; ?>
	
<!-- Pagination -->
<?php if($this->pagination->getPagesLinks()): ?>
<!-- Unofficial pagination -->
<div class="grid-mb">
	<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
</div>
<?php endif; ?>
