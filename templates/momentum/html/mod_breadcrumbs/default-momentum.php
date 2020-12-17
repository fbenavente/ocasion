<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$separator = '<i class="breadcrumbs-arrow icon-right-dir"></i>';

// Find last and penultimate items in breadcrumbs list
end($list);
$last_item_key = key($list);
prev($list);
$penult_item_key = key($list);

?>
<!-- Title -->
<div class="row title">
	<h2><?php echo strip_tags($list[$last_item_key]->name);?></h2>
	<hr>
</div>

