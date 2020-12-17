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
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
//echo'<pre>';var_dump($this->item);die;
// Create shortcuts to some parameters.
$params  = $this->item->params;
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author'));


$doc = JFactory::getDocument();

JHtml::_('jquery.framework');

//$user    = JFactory::getUser();
// Add Glyphicon and Awsome fonts
if($params->get('minify_css','1')){
	// If minnify css and js
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/css/azp-style.min.css');
}else{
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/fonts/azura-fonts.css');
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/plugins/animations/animations.min.css');
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/css/azura.grid.css');
	$doc->addStylesheet(JURI::root(true).'/components/com_azurapagebuilder/assets/css/azura_elements.css');

}
if($params->get('minify_js','1')){
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/plugins/animations/animations.min.js');
}else{
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/plugins/animations/appear.min.js');
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/plugins/animations/animations.js');
}

// if($this->item->jQueryLinkType == '1'){
// 	$doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
// }elseif($this->item->jQueryLinkType == '2') {
// 	$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/jquery.min.js');
// }
// if($this->item->noConflict == '1') {
// 	$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/jquery.noconflict.js');
// }

$azuraRootURL = 'var azuraUrl="'.JURI::root().'";';
$doc->addScriptDeclaration($azuraRootURL);

//$this->addCustomJs($this->item->customJsLinks);
$this->item->text = '';
AzuraJs::setData('hits',$this->item->hits);
AzuraJs::setData('pageid',$this->item->id);
AzuraJs::setData('page_likes',$this->item->page_likes);
?>

<?php 
if(isset($this->item->pagecontent)){
	$pageContent = json_decode(rawurldecode($this->item->pagecontent));
	//$this->item->pagecontent = '';
	unset($this->item->pagecontent);
	foreach ($pageContent as $key => $row) {
		$this->item->text .= ElementParser::do_shortcode($this->parseElement($row));
	}
	unset($pageContent);
	//$this->item->text = $this->item->pagecontent;

}
AzuraJs::writeStyles();
AzuraJs::writeJScripts();
if($params->get('minify_js','1')){
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/js/azp-elements.min.js');
}else{
	$doc->addScript(JURI::root(true).'/components/com_azurapagebuilder/assets/js/azura_elements.js');
}
// new in version 2.2
if(!empty($this->item->customCssLinks)){
	$doc->addStyleDeclaration($this->item->customCssLinks);
}
//echo'<pre>';var_dump($this->item->text);die;
$this->item->text .= '{emailcloak=off}';
$dispatcher = JEventDispatcher::getInstance();
JPluginHelper::importPlugin('content');
$dispatcher->trigger('onContentPrepare', array ('com_azurapagebuilder.page', &$this->item, &$this->params, 1));
?>
<div class="azp-page <?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<div class="page-header">
		<h1><?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
	</div>
	<?php endif; ?>
	<?php if ($params->get('show_title') || $params->get('show_author')) : ?>
	<div class="page-header">
		<h2>
			<?php if ($params->get('show_title')) : ?>
				<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
					<a href="<?php echo $this->item->readmore_link; ?>"> <?php echo $this->escape($this->item->title); ?></a>
				<?php else : ?>
					<?php echo $this->escape($this->item->title); ?>
				<?php endif; ?>
			<?php endif; ?>
		</h2>
		<?php if ($this->item->state == 0) : ?>
			<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
		<?php endif; ?>
		<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
			<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
		<?php endif; ?>
		<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != '0000-00-00 00:00:00') : ?>
			<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if ($useDefList) : ?>
		<div class="page-info muted">
			<dl class="page-info">
			<dt class="page-info-term"><?php echo JText::_('COM_AZP_PAGE_INFO'); ?></dt>

			<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
				<dd class="createdby">
					<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
					<?php $author = '<span>' . $author . '</span>'; ?>
					<?php if (!empty($this->item->contact_link) && $params->get('link_author') == true) : ?>
						<?php echo JText::sprintf('COM_AZP_BUILT_BY', JHtml::_('link', $this->item->contact_link, $author, array())); ?>
					<?php else: ?>
						<?php echo JText::sprintf('COM_AZP_BUILT_BY', $author); ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_parent_category') && !empty($this->item->parent_slug)) : ?>
				<dd class="parent-category-name">
					<?php $title = $this->escape($this->item->parent_title); ?>
					<?php if ($params->get('link_parent_category') && !empty($this->item->parent_slug)) : ?>
						<?php $url = '<a href="' . JRoute::_(AzuraPagebuilderHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>'; ?>
						<?php echo JText::sprintf('COM_AZP_PARENT', $url); ?>
					<?php else : ?>
						<?php echo JText::sprintf('COM_AZP_PARENT', '<span>' . $title . '</span>'); ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_category')) : ?>
				<dd class="category-name">
					<?php $title = $this->escape($this->item->category_title); ?>
					<?php if ($params->get('link_category') && $this->item->catslug) : ?>
						<?php $url = '<a href="' . JRoute::_(AzuraPagebuilderHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>'; ?>
						<?php echo JText::sprintf('COM_AZP_CATEGORY', $url); ?>
					<?php else : ?>
						<?php echo JText::sprintf('COM_AZP_CATEGORY', '<span>' . $title . '</span>'); ?>
					<?php endif; ?>
				</dd>
			<?php endif; ?>

			<?php if ($params->get('show_publish_date')) : ?>
				<dd class="published">
					<span class="icon-calendar"></span>
					<span>
						<?php echo JText::sprintf('COM_AZP_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
					</span>
				</dd>
			<?php endif; ?>

			<?php if ($params->get('show_modify_date')) : ?>
				<dd class="modified">
					<span class="icon-calendar"></span>
					<span>
						<?php echo JText::sprintf('COM_AZP_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
					</span>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_create_date')) : ?>
				<dd class="create">
					<span class="icon-calendar"></span>
					<span>
						<?php echo JText::sprintf('COM_AZP_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
					</span>
						
				</dd>
			<?php endif; ?>

			<?php if ($params->get('show_hits')) : ?>
				<dd class="hits">
					<span class="icon-eye-open"></span>
					<span>
						<?php echo JText::sprintf('COM_AZP_ARTICLE_HITS', $this->item->hits); ?>
					</span>
					
				</dd>
			<?php endif; ?>
			</dl>
		</div>
	<?php endif; ?>
	<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
		<br>
	<?php endif; ?>

	<div class="page-body"><?php echo $this->item->text; ?></div>

</div>
<?php echo AzuraJs::writePageScript();?>


