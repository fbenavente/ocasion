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

$jUser = JFactory::getUser();
$isGuest = $jUser->get('guest');
if($isGuest){
    $classes = 'azura_ajaxlogin azp_font_edit';
}else{
    $classes = 'azura_ajaxlogout azp_font_edit';
}


$animationData = '';
if($animationArgs['animation'] == '1'){
    $classes .= ' animate-in';
    $animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';   
}
if(!empty( $extraclass)){
    $classes .=' '.$extraclass;
}
$classes = 'class="'.$classes.'"';
if(!empty( $id)){
    $id .='id="'.$id.'"';
}
?>
<!--contact form -->

<div <?php echo $id.' '. $classes.' '.$ajaxloginstyle.' '.$animationData;?>>
    <div class="azura-form-title">
        <span class="form-title"><?php echo JText::_('COM_AZURAPAGEBUILDER_LOGIN_TITLE_TEXT');?></span>
    </div>
    <?php 
        $jUser = JFactory::getUser();
        if(!$jUser->get('guest')) : ?>
        
        <form action="<?php echo JRoute::_('index.php', true); ?>" method="post" id="login-form" class="form-vertical">
            <div class="logout-button">
                <p>It seems that you're already loggedin, <input type="submit" class="btn-link" value="<?php echo JText::_('JLOGOUT'); ?>"> to login with different account.</p>
                <input type="hidden" name="option" value="com_users" />
                <input type="hidden" name="task" value="user.logout" />
                <input type="hidden" name="return" value="<?php echo base64_encode(JURI::root());?>" />
                <?php echo JHtml::_('form.token'); ?>
            </div>
        </form>
    <?php else : ?>
        <div id="azuraajaxloginemessage"></div>

        <form class="azura_ajaxlogin-form" method="post" action="<?php echo JURI::root();?>" name="azuraajaxloginform" id="azuraajaxloginform">

            <div class="azura_form-group">
                <label for="username" class="sr-only"><?php echo JText::_('COM_AZURAPAGEBUILDER_LOGIN_VALUE_USERNAME');?></label>
                <input type="text" tabindex="0" name="username" class="azura_form-control input-lg" id="username" placeholder="<?php echo JText::_('COM_AZURAPAGEBUILDER_LOGIN_VALUE_USERNAME');?>">
            </div>
            <div class="azura_form-group">
                <label for="password" class="sr-only"><?php echo JText::_('JGLOBAL_PASSWORD');?></label>
                <input type="password" tabindex="0" name="password" class="azura_form-control input-lg" id="password" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD');?>">
            </div>

            <?php if (count($twofactormethods) > 1): ?>
            <div class="azura_form-group">
                <label for="secretkey" class="sr-only"><?php echo JText::_('JGLOBAL_SECRETKEY');?></label>
                <input type="text" tabindex="0" autocomplete="off" name="secretkey" class="azura_form-control input-lg" id="secretkey" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY');?>">
                <span class="btn width-auto hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
                    <i class="glyphicon glyphicon-question-sign"></i>
                </span>
            </div>

            <?php endif; ?>

            <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
            <div id="form-login-remember" class="control-group checkbox">
                <label for="modlgn-remember" class="control-label"><?php echo JText::_('COM_AZURAPAGEBUILDER_LOGIN_REMEMBER_ME') ?></label> <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
            </div>
            <?php endif; ?>
            
            <input type="submit" id="azuraajaxloginsubmit" value="<?php echo JText::_('JLOGIN') ?>" class="btn btn-primary btn-lg">

            <input type="hidden" name="option" value="com_azurapagebuilder">
            <input type="hidden" name="task" value="ajaxelement.login">
            <input type="hidden" name="return" value="<?php echo $returnUrl; ?>" />
            <?php echo JHtml::_('form.token'); ?>
        </form>
    <?php endif;?>
</div>

