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
            


	<?php if(count($items)): ?>
  <ul>
    <?php foreach ($items as $item):	?>
      <?php if($params->get('itemImage')) : ?>
            <a href="<?php echo $item->link; ?>" class="pull-left">
              <img width="48px" height="45px" src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>" class="media-object img-responsive">
            </a>
      <?php endif;?>
            <li>
              <a href="<?php echo $item->link; ?>"><?php echo $item->title;?></a></li>
            </li>

    <?php endforeach; ?>
  </ul>
  <?php endif;?>