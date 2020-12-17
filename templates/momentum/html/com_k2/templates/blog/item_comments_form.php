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
<!-- Comment form -->
    <div class="commentform-bg">

      <!-- Respond -->
      <div id="respond" class="respondform">

        <h3 id="reply-title"><?php echo JText::_('K2_LEAVE_A_COMMENT') ?></h3>

        <!-- Form -->
        <div>
          <form action="<?php echo JURI::root(true); ?>/index.php" method="post" id="comment-form" class="form-validate form form-blog" name="comment-form">
          <?php if(JText::_('TPL_MOMENTUM_COMMENT_FORM_NOTE') != ''): ?>
            <p class="comment-notes"><?php echo JText::_('TPL_MOMENTUM_COMMENT_FORM_NOTE');?><span class="required">*</span></p>
          <?php endif;?>
            <div class="comment-form-author">
              <input class="comment-input" id="userName" name="userName" type="text" value="" size="30" aria-required="true" />
              <label class="control-label" for="userName"><?php echo JText::_('TPL_MOMENTUM_NAME_TEXT') ?> <span class="required">*</span></label>
            </div>

            <div class="comment-form-email">
              <input class="comment-input" id="commentEmail" name="commentEmail" type="text" value="" size="30" aria-required="true" />
              <label class="control-label" for="commentEmail"><?php echo JText::_('TPL_MOMENTUM_EMAIL_TEXT') ?> <span class="required">*</span></label>
            </div>

            <div class="comment-form-url">
              <input class="comment-input" id="website" name="website" type="text" value="" size="30" />
              <label class="control-label" for="website"><?php echo JText::_('TPL_MOMENTUM_WEBSITE_TEXT') ?></label>
            </div>

            <div class="comment-form-comment">
              <textarea id="commentText" name="commentText" cols="45" rows="8" aria-required="true" placeholder="<?php echo JText::_('TPL_MOMENTUM_YOUR_COMMENT_HERE_TEXT');?>"></textarea>
            </div>

            <div class="comment-form-recaptcha">
              <?php if($this->params->get('recaptcha') && ($this->user->guest || $this->params->get('recaptchaForRegistered', 1))): ?>
                <label class="formRecaptcha"><?php echo JText::_('K2_ENTER_THE_TWO_WORDS_YOU_SEE_BELOW'); ?></label>
                <div id="recaptcha"></div>
              <?php endif; ?>
            </div>

            <div class="form-submit">
              <button class="btn" id="submitCommentButton" type="submit"><?php echo JText::_('TPL_MOMENTUM_POST_COMMENT_TEXT') ?></button>
               <br/><br/><span id="formLog"></span>
            </div>
            <input type="hidden" name="option" value="com_k2" />
            <input type="hidden" name="view" value="item" />
            <input type="hidden" name="task" value="comment" />
            <input type="hidden" name="itemID" value="<?php echo JRequest::getInt('id'); ?>" />
            <?php echo JHTML::_('form.token'); ?>
          </form>
        </div><!-- End comment form -->
      </div><!-- End respond -->
    </div><!-- End comment form bg -->