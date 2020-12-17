<?php
/**
 * @version     2.6.x
 * @package     K2
 * @author      JoomlaWorks http://www.joomlaworks.net
 * @copyright   Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
//echo'<pre>';var_dump($this->item);die;
$extraFields = null;
if(!empty($this->item->extra_fields)){
  $extraFields = json_decode($this->item->extra_fields);
  
}
$postType = $extraFields[0]->value;
$postLink = $extraFields[1]->value;

// $postType = $extraFields[0]->value;
// $postLink = substr(JUtility::parseAttributes($extraFields[1]->value)['src'], strlen(JURI::base(true)));
?>

<!-- Post -->
<div class="post post-single grid-mb">
  <?php if(JRequest::getInt('print')==1): ?>
    <!-- Print button at the top of the print page only -->
    <a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print();return false;">
        <span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
    </a>
  <?php endif; ?>

  <!-- Start K2 Item Layout -->
  <!-- Plugins: BeforeDisplay -->
  <?php echo $this->item->event->BeforeDisplay; ?>

  <!-- K2 Plugins: K2BeforeDisplay -->
  <?php echo $this->item->event->K2BeforeDisplay; ?>

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
    <?php if($this->item->params->get('itemTitle')): ?>
      <!-- Item title -->
      <?php if(isset($this->item->editLink)): ?>
      <!-- Item edit link -->
      <span class="itemEditLink">
          <a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo $this->item->editLink; ?>">
              <?php echo JText::_('K2_EDIT_ITEM'); ?>
          </a>
      </span>
      <?php endif;?>

      <h1 class="h3"><?php echo $this->item->title; ?></h1>

      <?php if($this->item->params->get('itemFeaturedNotice') && $this->item->featured): ?>
      <!-- Featured flag -->
      <span>
          <sup>
              <?php echo JText::_('K2_FEATURED'); ?>
          </sup>
      </span>
      <?php endif; ?>

    <?php endif; ?>

      <div class="post-meta">

        <?php if($this->item->params->get('itemAuthor')): ?>
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
        <?php if($this->item->params->get('itemCategory')): ?>
          <!-- Item category name -->
          <?php echo JText::_('TPL_MOMENTUM_IN_TEXT');?> 
          <a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
        <?php endif; ?>

      </div>
    </div>

    <div class="post-body">
      <?php if(!empty($this->item->fulltext)): ?>
          <?php if($this->item->params->get('itemIntroText')): ?>
          <!-- Item introtext -->
            <?php echo $this->item->introtext; ?>
          <?php endif; ?>
          <?php if($this->item->params->get('itemFullText')): ?>
          <!-- Item fulltext -->
            <?php echo $this->item->fulltext; ?>
          <?php endif; ?>
      <?php else: ?>
          <?php if($this->item->params->get('itemIntroText')): ?>
          <!-- Item introtext -->
            <?php echo $this->item->introtext; ?>
          <?php endif; ?>
      <?php endif; ?>
    </div>

    <?php if($this->item->params->get('itemTags') && count($this->item->tags)): ?>
      <!-- Item tags -->
      <div class="tags">
        
        <?php foreach ($this->item->tags as $tag): ?>
          <a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</div><!-- End post -->

<?php if($this->item->params->get('itemTwitterButton',1) || $this->item->params->get('itemFacebookButton',1) || $this->item->params->get('itemGooglePlusOneButton',1)): ?>
<!-- Socials section -->
<div class="grid-mb" id="socials">
  <!-- Social sharing -->
  <p><?php echo JText::_('TPL_MOMENTUM_SHARE_THIS_POST_TEXT');?></p>
  <ul class="social-box">
    <?php if($this->item->params->get('itemFacebookButton',1)): ?>
    <!-- Facebook Button -->
    <li class="itemFacebookButton">
        <div id="fb-root"></div>
        <script type="text/javascript">
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <div class="fb-like" data-send="false" data-width="200" data-show-faces="true"></div>
    </li>
    <?php endif; ?>

    <?php if($this->item->params->get('itemTwitterButton',1)): ?>
    <!-- Twitter Button -->
    <li class="itemTwitterButton">
        <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal"<?php if($this->item->params->get('twitterUsername')): ?> data-via="<?php echo $this->item->params->get('twitterUsername'); ?>"<?php endif; ?>>
            <?php echo JText::_('K2_TWEET'); ?>
        </a>
        <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
    </li>
    <?php endif; ?>

    

    <?php if($this->item->params->get('itemGooglePlusOneButton',1)): ?>
    <!-- Google +1 Button -->
    <li class="itemGooglePlusOneButton">
        <g:plusone annotation="inline" width="120"></g:plusone>
        <script type="text/javascript">
          (function() {
            window.___gcfg = {lang: 'en'}; // Define button default language here
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>
    </li>
    <?php endif; ?>
  </ul>
</div>
<?php endif;?> 

<!-- Comment section -->
<div class="grid-mb" id="comments">
  <div class="commentsWrap">

  <?php if($this->item->params->get('commentsFormPosition')=='above' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
  <!-- Item comments form -->
    <?php echo $this->loadTemplate('comments_form'); ?>

  <?php endif; ?>  

  <!-- Plugins: AfterDisplay -->
  <?php echo $this->item->event->AfterDisplay; ?>

  <!-- K2 Plugins: K2AfterDisplay -->
  <?php echo $this->item->event->K2AfterDisplay; ?>

  <?php if($this->item->params->get('itemComments') && ( ($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1'))): ?>
  <!-- K2 Plugins: K2CommentsBlock -->
  <?php echo $this->item->event->K2CommentsBlock; ?>
  <?php endif; ?>

  <?php if($this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2')) && empty($this->item->event->K2CommentsBlock)): ?>
    <?php if($this->item->numOfComments>0 && $this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2'))): ?>
      <!-- Item user comments -->
      <div class="comments-title-bg">
        <h3 class="comments-title"><?php echo ($this->item->numOfComments>1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?> <span>(<?php echo $this->item->numOfComments; ?>)</span></h3>
      </div>
    
    

    <!-- Commentlist -->
    <ul class="commentlist">
    <?php foreach ($this->item->comments as $key=>$comment): 
      if(($key+1)% 2 == 0){
        $class = "even thread-even";
      }else{
        $class = "odd thread-odd";
      }
    ?>
      <li class="comment <?php echo $class;?> depth-1" id="comment-<?php echo $key+1;?>">

        <!-- Comment body -->
        <div class="comment-body" id="div-comment-2">
          <div class="comment-author vcard"><img alt='<?php echo JFilterOutput::cleanText($comment->userName); ?>' src="<?php echo $comment->userImage; ?>"></div>

          <cite class="fn"><a href="<?php echo (!empty($comment->userLink))? JFilterOutput::cleanText($comment->userLink): '#'; ?>"><?php echo $comment->userName; ?></a></cite> <span class="says"><?php echo JText::_('TPL_MOMENTUM_SAYS_TEXT');?></span>

          <div class="comment-meta commentmetadata">
            <a href="#"><?php echo JHTML::_('date', $comment->commentDate, JText::_('K2_DATE_FORMAT_LC2')); ?></a>
          </div>

          <?php echo $comment->commentText; ?>

          <div class="reply pull-right">
            <?php if($this->inlineCommentsModeration || ($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest)))): ?>
                        
                <?php if($this->inlineCommentsModeration): ?>
                    <?php if(!$comment->published): ?>
                    <a class="comment-reply-link label" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=publish&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_APPROVE')?></a>
                    <?php endif; ?>

                    <a class="comment-reply-link label" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=remove&commentID='.$comment->id.'&format=raw')?>"><?php echo JText::_('K2_REMOVE')?></a>
                <?php endif; ?>

                    <?php if($comment->published && ($this->params->get('commentsReporting')=='1' || ($this->params->get('commentsReporting')=='2' && !$this->user->guest))): ?>
                    <a class="modal comment-reply-link label" rel="{handler:'iframe',size:{x:560,y:480}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=report&commentID='.$comment->id)?>"><?php echo JText::_('K2_REPORT')?></a>
                    <?php endif; ?>

                    <?php if($comment->reportUserLink): ?>
                    <a class="comment-reply-link label" href="<?php echo $comment->reportUserLink; ?>"><?php echo JText::_('K2_FLAG_AS_SPAMMER'); ?></a>
                    <?php endif; ?>
                
              <?php endif; ?>
            
          </div>
        </div>

      </li>
  
      <?php endforeach; ?>
    </ul><!-- End comment list -->

    <div class="itemCommentsPagination">
      <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
    <?php endif;?>
  <?php endif;?>
  
  <?php if($this->item->params->get('commentsFormPosition')=='below' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
    <!-- Item comments form -->
    <?php echo $this->loadTemplate('comments_form'); ?>
  <?php endif; ?>

  <?php $user = JFactory::getUser(); if ($this->item->params->get('comments') == '2' && $user->guest): ?>
    <div><a href="<?php echo JRoute::_('index.php?option=com_users&view=login');?>"><?php echo JText::_('K2_LOGIN_TO_POST_COMMENTS'); ?></a></div>
  <?php endif; ?>

  </div><!-- End comments wrap -->
</div><!-- End comments -->


