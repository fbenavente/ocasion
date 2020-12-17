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

<?php if(count($comments)): ?>
<ul id="recentcomments">
	<?php foreach ($comments as $key=>$comment):	?>
	<li class="recentcomments">
		<?php echo $comment->userName.' '. JText::_('TPL_MOMENTUM_COMMENTS_ON_TEXT');?> <a href="<?php echo $comment->link; ?>"><?php echo $comment->title; ?></a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>
