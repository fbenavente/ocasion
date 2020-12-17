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

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
// Load jQuery 
JHtml::_('jquery.framework');
// Load Mootools Core and More
JHtml::_('behavior.framework', 'More');

JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
//JHtml::_('formbehavior.chosen', 'select');
//new in 2.1
//new update for 3.5
JHTML::_('behavior.modal');
$assoc = JLanguageAssociations::isEnabled();

$doc = JFactory::getDocument();

$scr = 'var adComBaseUrl ="'. JURI::base().'";';

$doc->addScriptDeclaration($scr);

$doc->addStyleSheet(JURI::base(true).'/components/com_azurapagebuilder/assets/css/bootstrap.custom.css');
$doc->addStyleSheet(JURI::base(true).'/components/com_azurapagebuilder/assets/css/azura-modal.css');
$doc->addStyleSheet(JURI::base(true).'/components/com_azurapagebuilder/assets/fancybox/jquery.fancybox.css');
$doc->addStyleSheet(JURI::base(true).'/components/com_azurapagebuilder/assets/css/jquery-ui.min.css');
$doc->addStyleSheet(JURI::base(true).'/components/com_azurapagebuilder/assets/font-awesome/css/font-awesome.min.css');
$doc->addStyleSheet(JURI::base(true).'/components/com_azurapagebuilder/assets/css/style.css');

$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/jquery-ui.min.js');

$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/jquery.mousewheel-3.0.6.pack.js');
//$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/fancybox/jquery.fancybox.pack.js');

$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/fancybox/jquery.fancybox.pack.js');
$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/fancybox/helpers/jquery.fancybox-media.js');
$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/outerHTML-2.1.0-min.js');
//$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/isotope.pkgd.js');
$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/jquery.mixitup.min.js');
$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/azura-modal.js');
$doc->addScript(JURI::base(true).'/components/com_azurapagebuilder/assets/js/core.js');



?>

<form action="<?php echo JRoute::_('index.php?option=com_azurapagebuilder&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">

	<?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'pageTab', array('active' => 'details')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'pageTab', 'details', empty($this->item->id) ? JText::_('COM_AZURAPAGEBUILDER_NEW_PAGE', true) : JText::sprintf('COM_AZURAPAGEBUILDER_EDIT_PAGE', $this->item->id, true)); ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="form-vertical">
					<div class="row-fluid">
						
						<div class="span12">
							<div class="pull-left">
								<a href="#" class="btn btn-primary azura-add-new-row" id="azura-add-new-row"><i class="icon-list-2 icon-primary"></i> Add Row</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo JURI::root().'index.php?option=com_azurapagebuilder&view=page&id='.$this->item->id;?>" class="btn btn-default" target="_blank"><i class="icon-eye-open"></i> Preview</a>
								
							</div>
							<div class="pull-right">
								<?php echo $this->form->getInput('alt_layout'); ?>
								<a href="javascript:void(0);" id="azuraPageTemplate" class="btn btn-default" target="_blank"><i class="icon-download"></i> Load Templates</a>
								<a href="javascript:void(0);" id="azuraPageCustomStyle" class="btn btn-primary" target="_blank"><i class="fa fa-paint-brush"></i> Custom Style</a>
							</div>
							<br>
							<hr>
							<div class="azura-pagebuilder-footer mgbt30">
								<a href="javascript:void(0)" id="azuraPrependPageSection"><i class="fa fa-plus-square-o"></i></a>
							</div>
							<!-- <div class="azuraAddElementPageWrapper hide-in-elements"  style="text-align: center; vertical-align: bottom; background-color:#f5f5f5;"><i class="fa fa-plus azuraAddElementPage"  style="color: rgb(204, 204, 204); margin: 0px auto; font-size: 32px; cursor: pointer;"></i></div> -->
							<div class="azura-pagebuilder clearfix" id="azura-pagebuilder">
								<div class="clearfix">
									<div class="azura-pagebuilder-area">
										<?php 
											
											if(isset($this->item->pagecontent) && !empty($this->item->pagecontent)){
												$pageSections = json_decode(rawurldecode($this->item->pagecontent));
												
												if(count($pageSections)){
													foreach ($pageSections as $key => $sec) {
														
														$this->parseElement($sec);
													}
												}else{
													$this->loadDefaultSection();
												}
											}else{
												$this->loadDefaultSection();
											}





											// if(isset($this->elements) && count($this->elements)) {
											// 	foreach ($this->elements as $element) {

											// 		$this->parseElement($element);

											// 	}
											// } 
										?>
									</div>
								</div>
							</div>
							<div class="azura-pagebuilder-footer">
								<a href="javascript:void(0)" id="azuraAddPageSection"><i class="fa fa-plus-square-o"></i></a>
							</div>
						</div>
						<!-- <div class="span12">
							<div>
								<a href="<?php echo JURI::root().'index.php?option=com_azurapagebuilder&view=page&id='.$this->item->id;?>" class="btn btn-default" target="_blank">Preview</a>
								<a href="<?php echo JURI::root().'index.php?option=com_azurapagebuilder&view=edit&id='.$this->item->id;?>" class="btn btn-primary"  target="_blank">Frontend Edit</a>


							</div>
							<br>
							<div class="form-vertical" >
								<?php echo $this->form->getControlGroup('alt_layout'); ?>
								<?php echo $this->form->getControlGroup('customCssLinks'); ?>
								<?php echo $this->form->getControlGroup('customJsLinks'); ?>
								<?php echo $this->form->getControlGroup('customJsButtonLinks'); ?>
								<?php echo $this->form->getControlGroup('customJsBottomScript'); ?>
								<?php echo $this->form->getControlGroup('jQueryLinkType'); ?>
								<?php echo $this->form->getControlGroup('noConflict'); ?>
							</div>


							
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<div id="azp_global_edit">
			<a href="javascript:void(0)" id="azp_open_global_edit"><span class="icon icon-cog"></span></a>
			<div class="pd30 form-horizontal-desktop">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php if ($assoc) : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'pageTab', 'associations', JText::_('JGLOBAL_FIELDSET_ASSOCIATIONS', true)); ?>
				<?php echo $this->loadTemplate('associations'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>


		<?php echo JHtml::_('bootstrap.addTab', 'pageTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
				<hr>
				<?php //echo JLayoutHelper::render('joomla.edit.global', $this); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php //echo JLayoutHelper::render('joomla.edit.params', $this); ?>

		<?php if ($this->canDo->get('core.admin')) : ?>
			<?php echo JHtml::_('bootstrap.addTab', 'pageTab', 'permissions', JText::_('COM_AZURAPAGEBUILDER_FIELDSET_PERMISSIONS', true)); ?>
				<?php echo $this->form->getInput('rules'); ?>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
		<?php endif; ?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

	</div>

	<input type="hidden" name="task" value="" />
	<?php echo $this->form->getInput('customCssLinks'); ?>
	<?php echo $this->form->getInput('pagecontent'); ?>
	<?php echo $this->form->getInput('shortcode'); ?>
	<?php echo $this->form->getInput('elementsArray'); ?>
	<?php echo $this->form->getInput('elementsSettingArray'); ?>
	<?php echo $this->form->getInput('elementsShortcodeArray');?>
	<?php echo JHtml::_('form.token'); ?>
</form>

<?php $azuraelements = AzuraElements::getElements(false);
	//cats array
	$eleCats = AzuraElements::getElementCats(); //echo'<pre>';var_dump($eleCats);die;?>
<!-- Page Elements Modal -->
<div id="azuraPagebuilderModalElement" class="azura-modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="azura-modal-dialog azura-modal-lg">
    <div class="azura-modal-content">
     	<div class="azura-modal-header">
			<button type="button" class="close" data-dismiss="azura-modal" aria-hidden="true">×</button>
			<h3 id="myLargeModalLabel">Azura Elements</h3>
			<div id="ele_filters" class="button-group">
			  	<a class="filter-btn" href="javascript:void(0)" data-filter="all">Show all</a>
			<?php if(count($eleCats)) :
			foreach ($eleCats as $key => $fil) : ?>
			  	<a class="filter-btn" href="javascript:void(0)" data-filter=".<?php echo strtolower(str_replace(" ", "_", $fil));?>"><?php echo ucwords($fil);?></a>
			<?php endforeach; endif;?>
			</div>
		</div>

		<div class="azura-modal-body azura-elements-body">
			<div id="azura-element-container" class="azura-elements clearfix">
			<?php
				foreach ($azuraelements as $key => $ele) {
					require(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'components/com_azurapagebuilder/views/page/elementTemplate/elements.php'); 
				}

			?>
			</div>
		</div>
    </div>
  </div>
</div>

<!-- Template Modal -->
<div id="templateModal" class="modal hide fade<?php if ( version_compare( JVERSION, '3.4', '>=' ) == 1) echo ' modal-template';?>" tabindex="-1" role="dialog" aria-labelledby="templateModalLabel" aria-hidden="true">
  <div class="modal-header">
    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
    <h3 id="templateModalLabel">Load Templates</h3>
  </div>
  <div class="modal-body">
  	<ul class="nav nav-tabs log-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#PageTemplate" role="tab" data-toggle="tab">Page Templates</a></li>
		<li role="presentation"><a href="#SectionTemplate" role="tab" data-toggle="tab">Section Element Templates</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="PageTemplate">

		    <p><strong>Save current layout as a template</strong></p>
		    <div class="input-append">
			  <input class="input-xlarge" placeholder="Tempalte name" id="templateName" type="text">
			  <button class="btn btn-primary" id="templateSaveBtn" type="button">Save Template</button>
			</div>
			<p><i>Save your layout and reuse it on different sections of your website.</i></p>
			<br>
			<p><strong>Saved Page Templates</strong></p>
			<p><i>Append previosly saved template to the current layout</i></p>
			<ul id="templateList" class="nav nav-list template-list">
				<?php //echo '<pre>';var_dump($this->pageTemplates);die;?>
				<?php if(count($this->pageTemplates)) {
					foreach ($this->pageTemplates as  $temp) {
						if(isset($temp->savename)){
							echo '<li data-template="'.$temp->savename.'"><a class="appendTemplate" href="javascript:void(0)">'.$temp->templatename.'</a><a class="pull-right deleteTemplate" href="javascript:void(0)"><span class="badge badge-important">Delete</span></a></li>';
						}
					}
				}
				?>
			</ul>
		</div>
		<div role="tabpanel" class="tab-pane" id="SectionTemplate">
			<br>
			<p><strong>Saved Section Templates</strong></p>
			<p><i>Append previously saved template to the current layout</i></p>
			<ul id="secTemplateList" class="nav nav-list template-list">
				<?php if(count($this->secTemplates)) {
					foreach ($this->secTemplates as  $temp) {
						if(isset($temp->savename)){
							echo '<li data-template="'.$temp->savename.'"><a class="appendSecTemplate" href="javascript:void(0)">'.$temp->templatename.'</a><a class="pull-right deleteSecTemplate" href="javascript:void(0)"><span class="badge badge-important">Delete</span></a></li>';
						}
					}
				}
				?>
			</ul>
		</div>
	</div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <!-- <button class="btn btn-primary">Save changes</button> -->
  </div>
</div>
<!-- End Template Modal -->

<div id="azuraBackdrop" class="azura-backdrop"></div>	

<div class="copyright">
	<p><small style="float:left;">Azura - Joomla Page Builder &copy; 2014 by <a href="http://cththemes.com" title="Cththemes.com">Cththemes</a></small><small style="float:right;">Version <?php echo AZURA_VERSION;?></small></p>
</div>
