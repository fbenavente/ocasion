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

/*
Important note:
If you wish to use the live search option, it's important that you maintain the same class names for wrapping elements, e.g. the wrapping div and form.
*/

?>

<form method="post" action="<?php echo $action; ?>" method="get" autocomplete="off" >
	<input type="text"  class="search" placeholder="<?php echo JText::_('TPL_MOMENTUM_SEARCH_TEXT');?>" name="searchword" />
   	
  	<input type="submit" value="<?php echo JText::_('TPL_MOMENTUM_GO_TEXT');?>" />
  	<input type="hidden" name="categories" value="<?php echo $categoryFilter; ?>" />
		<?php if(!$app->getCfg('sef')): ?>
		<input type="hidden" name="option" value="com_k2" />
		<input type="hidden" name="view" value="itemlist" />
		<input type="hidden" name="task" value="search" />
		<?php endif; ?>
		<?php if($params->get('liveSearch')): ?>
		<input type="hidden" name="format" value="html" />
		<input type="hidden" name="t" value="" />
		<input type="hidden" name="tpl" value="search" />
		<?php endif; ?>
</form>
<?php if($params->get('liveSearch')): ?>
	<div class="k2LiveSearchResults"></div>
<?php endif; ?>
