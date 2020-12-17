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

// Define default image size (do not change)
//K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);

$extraFields = json_decode($this->item->extra_fields);
$postType = $extraFields[0]->value;
$postLink = $extraFields[1]->value;

// $filter = getItemTagsFilter($this->item);
?>

<!-- Post -->
<div class="post post-single grid-mb">

	<div class="post-media">
		<?php if($postType == '1') : ?>
		<img alt="<?php echo $this->item->title;?>" src="<?php echo JURI::root(true).$postLink;?>">
		<?php elseif($postType == '4') : ?>
		<ul class="img-slider">
		<?php
	    	foreach ($extraFields as $key => $field) :
	    	if($key > 1) :
        ?>
			<li>
				<img alt="Image <?php echo ($key+1);?>" src="<?php echo JURI::root(true).$field->value;?>" >
			</li>
		<?php endif; endforeach; ?>
		</ul>
		<?php elseif($postType == '2') : 
			$id = array();
			// get youtube video id from link
			preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $postLink, $id);
	        //support embed link pasted at link
	        if(empty($id) || !is_array($id)){
	            preg_match('/embed[\/]([^\\?\\&]+)[\\?]/', $postLink, $id);
	        }
        	if(!empty($id[1])) :
		?>
		<div class="responsive-video">
			<!-- youtube -->
			<iframe src="http://www.youtube.com/embed/<?php echo $id[1];?>?" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			<!-- End youtube -->
		</div>
			<?php endif;?>
		<?php elseif($postType == '3') :

		$id = array();
		// get vimeo video id from link
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $postLink, $id);

		if(!empty($id[1])) :

		?>
		<div class="responsive-video">
			<!-- Vimeo -->
			<iframe  src="http://player.vimeo.com/video/<?php echo $id[1];?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			<!-- End Vimeo -->
		</div>
		<?php endif;?>
		
		<?php elseif($postType == '5') : 
			$url = str_replace(":", "%3A", $postLink);
		?>
		<div class="responsive-video">
			<iframe src="https://w.soundcloud.com/player/?url=<?php echo $url;?>&amp;auto_play=false&amp;hide_related=false&amp;visual=true" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		</div>
		<?php endif;?>
	</div>

	<div class="post-bg">

		<div class="post-title">
		<?php if($this->item->params->get('catItemTitle')): ?>
			<!-- Item title -->
			<?php if(isset($this->item->editLink)): ?>
			<!-- Item edit link -->
			<span class="catItemEditLink">
				<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>">
					<?php echo JText::_('K2_EDIT_ITEM'); ?>
				</a>
			</span>
			<?php endif; ?>

		  	<?php if ($this->item->params->get('catItemTitleLinked')): ?>
				<h3>
				<a href="<?php echo $this->item->link; ?>"><?php echo $this->item->title; ?></a>
				</h3>
		  		
		  	<?php else: ?>
		  	<h3><?php echo $this->item->title; ?></h3>
		  	<?php endif; ?>	
		<?php endif; ?>

			<div class="post-meta">
				
				<?php if($this->item->params->get('catItemAuthor')): ?>
				<?php echo JText::_('TPL_MOMENTUM_BY_TEXT');?> 
					<!-- Item Author -->
					<?php if(isset($this->item->author->link) && $this->item->author->link): ?>
					<a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
					<?php else: ?>
					<?php echo $this->item->author->name; ?>
					<?php endif; ?>
				<?php endif; ?> 
				<?php echo JText::_('TPL_MOMENTUM_ON_TEXT');?> 

				<?php echo JHTML::_('date', $this->item->created, 'F d, Y'); ?> 
				<?php if($this->item->params->get('catItemCategory')): ?>
					<!-- Item category name -->
					<?php echo JText::_('TPL_MOMENTUM_IN_TEXT');?> 
					<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
				<?php endif; ?>
			</div>
		</div>

		<div class="post-body">
			<?php if($this->item->params->get('catItemIntroText')): ?>
				<!-- Item introtext -->
			  	<?php echo $this->item->introtext; ?>
			
			<?php endif; ?>

			<?php if ($this->item->params->get('catItemReadMore')): ?>
			<!-- Item "read more..." link -->
			<div>
				<a href="<?php echo $this->item->link; ?>" class="arrow-link"><?php echo JText::_('TPL_MOMENTUM_CONTINUE_READING_TEXT'); ?></a>
			</div>
			<?php endif; ?>
			
		</div>


		<?php if($this->item->params->get('catItemTags') && count($this->item->tags)): ?>
		<!-- Item tags -->
	    <div class="tags">
	    	<?php foreach ($this->item->tags as $tag): ?>
                <a href="<?php echo $tag->link;?>"><?php echo strtoupper($tag->name); ?></a>
              <?php endforeach; ?>
		</div>
		<?php endif;?>

	</div>
</div><!-- End post -->