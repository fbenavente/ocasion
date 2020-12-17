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

<!-- Start K2 Generic (search/date) Layout -->

	<?php if(count($this->items)): 
$total = count($this->items);
	?>
	<?php foreach($this->items as $key=>$item): ?>

	<!-- Start K2 Item Layout -->
	<?php 
	$item->isLast = false;
		if($key+1 === $total){
			$item->isLast = true;
		}

	$this->item = $item;
	echo $this->loadTemplate('item'); ?>
	<!-- End K2 Item Layout -->

	<?php endforeach; ?>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<!-- Unofficial pagination -->
	<div class="grid-mb">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>

	<?php else: ?>

	<?php if(!$this->params->get('googleSearch')): ?>
	<!-- No results found -->
	<div id="genericItemListNothingFound">
		<p><?php echo JText::_('K2_NO_RESULTS_FOUND'); ?></p>
	</div>
	<?php endif; ?>

	<?php endif; ?>

<!-- End K2 Generic (search/date) Layout -->
