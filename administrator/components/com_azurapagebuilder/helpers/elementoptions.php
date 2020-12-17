<?php
defined('_JEXEC') or die;

/**
* ElementOptions
*/
class ElementOptions
{
    public static function renderCustomStyle($optionFormName = '', $data = null){



        $formOption = JForm::getInstance('com_azurapagebuilder.element.'.$optionFormName, $optionFormName);

        $html = '<h2 class="element_config_header"><i class="fa fa-paint-brush"></i> Your Custom Style for this page</h2>';
            
        $html .='<div class="row-fluid ">
                    <div class="span12">';
                        $html .= '<div class="form-vertical">';

                        // content
                        $eleSettingContent = '';

                        foreach ($formOption->getFieldsets('elementContent') as $fieldsets => $fieldset) {
                            foreach($formOption->getFieldset($fieldset->name) as $field){

                                preg_match('/elementContent\[(.+)\]/', $field->name, $matches);

                                if(count($matches) > 1){
                                    $attr = $matches[1];

                                    if(isset($data)){
                                        //$value = $dataObject->attrs->{$content};
                                        $field->setValue(rawurldecode($data));
                                    }
                                }

                                if ($field->hidden) {
                                    $eleSettingContent .= $field->input;
                                }else{
                                    //echo'<pre>';var_dump($field->name);
                                    $eleSettingContent .= $field->input;
                                }
                            }
                        }


                                
                        $html .= $eleSettingContent;
                        
                        $html .='</div>
                        <!-- /.form-vertical -->';

        $html .='   </div>
                    <!-- /.span12 -->
                </div>
                <!-- /.row-fluid -->';
             
            $html .='
            <div class="clearfix" ></div>
            <div class="row-fluid fancy-option-bottom" style="text-align: center;">
                <hr>
                <a href="#" id="azura-cusstyle-btn-save" class="btn btn-primary azp_btn-primary azura-cusstyle-btn-save">Save</a>
                <a href="#" id="azura-setting-btn-cancel" class="btn btn-default azp_btn-default azura-setting-btn-cancel">Close</a>
            </div>';

            return $html;
    }
	
	public static function renderElementOptions($optionFormName = '', $dataObject, $data = null){
        //return $optionFormName;

        // azura element option plugin
        // Import the appropriate plugin group.
        JPluginHelper::importPlugin('azura');

        // Get the dispatcher.
        $dispatcher = JEventDispatcher::getInstance();

        $dispatcher->trigger('onAzuraBeforePrepareElementForm');



        $dataObject->formOption = JForm::getInstance('com_azurapagebuilder.element.'.$optionFormName, $optionFormName);

        

        // Trigger the element form preparation event.
        $results = $dispatcher->trigger('onAzuraPrepareElementForm', array($dataObject->formOption, $dataObject));

        // Check for errors encountered while preparing the form.
        if (count($results) && in_array(false, $results, true))
        {
            // Get the last error.
            $error = $dispatcher->getError();

            if (!($error instanceof Exception))
            {
                throw new Exception($error);
            }
        }
        //echo'<pre>';var_dump($dataObject);die;

        // settings

        $eleSettings = array();

        foreach ($dataObject->formOption->getFieldsets('elementSettings') as $fieldsets => $fieldset) {
            foreach($dataObject->formOption->getFieldset($fieldset->name) as $field){

                //$eleSettings[$field->name] = $field->getAttribute('setting');

                preg_match('/elementSettings\[(.+)\]/', $field->name, $matches);

                if(count($matches) > 1){
                    $sett = $matches[1];
                    $eleSettings[$sett] = $field->getAttribute('setting');
                }

            }
        }

        $showStyleTab = 'true';
        if(isset($eleSettings['showStyleTab'])){
            $showStyleTab = $eleSettings['showStyleTab'];
        }

        $showAnimationTab = 'true';
        if(isset($eleSettings['showAnimationTab'])){
            $showAnimationTab = $eleSettings['showAnimationTab'];
        }

        $showResponsiveTab = 'false';
        if(isset($eleSettings['showResponsiveTab'])){
            $showResponsiveTab = $eleSettings['showResponsiveTab'];
        }

        $numberLeftSettings = 'all';
        if(isset($eleSettings['numberLeftSettings'])){
            if(is_numeric($eleSettings['numberLeftSettings'])){
                $numberLeftSettings = (int)$eleSettings['numberLeftSettings'];
            }
        }

        $contentFirst = 'true';
        if(isset($eleSettings['contentFirst'])){
            $contentFirst = $eleSettings['contentFirst'];
        }

        $html = '
            <h2 class="element_config_header"><i class="fa fa-cog"></i> Config-'. substr($dataObject->type, 5).(!empty($dataObject->name)? ': '.strip_tags($dataObject->name) : '').'</h2>
            <div class="row-fluid" style="padding-top:20px;">
                <div class="span5">
                    <div class="input-prepend">
                        <span class="add-on">Name</span>
                        <input class="inputbox" name="elementName" placeholder="Element name" type="text" value="'.(isset($dataObject->name)? strip_tags($dataObject->name) : '').'">
                    </div>
                </div>
                <div class="span7">
                    <div class="form-horizontal">
                        <div class="control-group elementPubLang">
                            <div class="control-label">
                                <label id="elementPubLang_published-lbl" for="elementPubLang_published">Published</label>
                            </div>
                            <div class="controls">
                                <fieldset id="elementPubLang_published" class="radio btn-group btn-group-yesno">
                                    <input id="elementPubLang_published1" name="elementPubLang[published]" value="1" '.((isset($dataObject->published) && $dataObject->published == '1')? 'checked="checked"' : '').' type="radio">
                                    <label  for="elementPubLang_published1">Yes</label>
                                    <input id="elementPubLang_published0" name="elementPubLang[published]" value="0" '.((isset($dataObject->published) && $dataObject->published == '0')? 'checked="checked"' : '').' type="radio">
                                    <label for="elementPubLang_published0">No</label>
                                </fieldset>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- /.row-fluid -->';

            if($showStyleTab == 'true' || $showAnimationTab == 'true' || $showResponsiveTab == 'true'){
                $html .= '<div id="azp_tabs" class="ui-tabs ui-widget ui-widget-content">
                 <ul id="azp_setting_tabs_ul" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header">
                    <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a class="ui-tabs-anchor" href="#azp_tab_option">Options</a></li>';
                 if($showStyleTab == 'true'){
                    $html .='<li class="ui-state-default ui-corner-top"><a class="ui-tabs-anchor" href="#azp_tab_style">Styles</a></li>';
                 }
                 if($showAnimationTab == 'true'){
                    $html .='<li class="ui-state-default ui-corner-top"><a class="ui-tabs-anchor" href="#azp_tab_animation">Animation</a></li>';
                 }  
                 if($showResponsiveTab == 'true'){
                    $html .='<li class="ui-state-default ui-corner-top"><a class="ui-tabs-anchor" href="#azp_tab_responsive">Responsive</a></li>';
                 } 
                    
                $html .='</ul>';
            }else{
                $html .='<hr>';
            }

            // if($showStyleTab == 'true'){
            //     $html .= '<div id="azp_tabs" class="ui-tabs ui-widget ui-widget-content">
            //      <ul id="azp_setting_tabs_ul" class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header">
            //         <li class="ui-state-default ui-corner-top ui-tabs-active ui-state-active"><a class="ui-tabs-anchor" href="#azp_tab_option">Options</a></li>
            //         <li class="ui-state-default ui-corner-top"><a class="ui-tabs-anchor" href="#azp_tab_style">Styles</a></li>
            //     </ul>';
            // }else{
            //     $html .='<hr>';
            // }

            
                $html .='<div class="row-fluid azp_setting_tabs_content ui-tabs-panel'.(($dataObject->type == 'AzuraHtml')? ' type-html':'').'" id="azp_tab_option">
                    <div class="span12">';
                    if($dataObject->type == 'AzuraHtml'){
                        $html .='<iframe class="AzuraHtml-editor" src="'.JURI::base().'index.php?option=com_azurapagebuilder&task=edit.getEditor&tmpl=component" width="100%" height="600"></iframe>';
                    }else{
                        $html .= '<div class="form-vertical">';

                        // content
                        $eleSettingContent = '';

                        foreach ($dataObject->formOption->getFieldsets('elementContent') as $fieldsets => $fieldset) {
                            foreach($dataObject->formOption->getFieldset($fieldset->name) as $field){

                                preg_match('/elementContent\[(.+)\]/', $field->name, $matches);

                                if(count($matches) > 1){
                                    $attr = $matches[1];

                                    if(isset($dataObject->content)){
                                        //$value = $dataObject->attrs->{$content};
                                        $field->setValue(rawurldecode($dataObject->content));
                                    }
                                }

                                if ($field->hidden) {
                                    $eleSettingContent .= $field->input;
                                }else{
                                    //echo'<pre>';var_dump($field->name);
                                    $eleSettingContent .= $field->getControlGroup();
                                }
                            }
                        }

                        // attrs
                        $fieldsetsTotal = count($dataObject->formOption->getFieldsets('elementAttrs'));
                        if($fieldsetsTotal > 0){
                            $fieldsetKey = 1;
                            foreach ($dataObject->formOption->getFieldsets('elementAttrs') as $fieldsets => $fieldset) {
                                if($numberLeftSettings != 'all'){
                                    $html .= '<div class="row-fluid">';
                                        $html .='<div class="span6">';
                                        $key = 0;
                                }

                                if($contentFirst == 'true' && $fieldsetKey == 1){
                                    $html .= $eleSettingContent;
                                }
                                

                                $fields = $dataObject->formOption->getFieldset($fieldset->name);

                                foreach($fields as $field){

                                    preg_match('/elementAttrs\[(.+)\]/', $field->name, $matches);

                                    if(count($matches) > 1){
                                        $attr = $matches[1];

                                        if(isset($dataObject->attrs->{$attr})){
                                            $value = $dataObject->attrs->{$attr};
                                            $field->setValue($value);
                                        }
                                    }

                                    if ($field->hidden) {
                                        $html .= $field->input;
                                    }else{
                                        //echo'<pre>';var_dump($field->name);
                                        $html .= $field->getControlGroup();
                                        if($numberLeftSettings != 'all'){
                                            $key++;
                                        }
                                        
                                    }

                                    if($numberLeftSettings != 'all'){
                                        if($key == $numberLeftSettings && count($fields) >= $numberLeftSettings){
                                            $html .= '</div><div class="span6">';
                                        }
                                    }
                                }

                                if($contentFirst != 'true' && $fieldsetKey == $fieldsetsTotal){
                                    $html .= $eleSettingContent;
                                }


                                if($numberLeftSettings != 'all'){
                                        $html .='</div>';
                                    $html .='</div>';
                                }

                                $fieldsetKey++;
                            }
                        }else{
                            $html .= $eleSettingContent;
                        }
                        
                        $html .='</div>
                        <!-- /.form-horizontal -->';
                    }

                $html .='
                    </div>
                    <!-- /.span12 -->

                </div>
                <!-- /.row-fluid -->';

                if($showStyleTab == 'true'){
                    $html .='<div class="row-fluid azp_setting_tabs_content ui-tabs-panel" id="azp_tab_style">
                    '.self::renderElementStyle($dataObject->attrs).'

                    

                    </div>

                    <!-- /.row-fluid -->';
                }

                if($showAnimationTab == 'true'){
                    $html .='<div class="row-fluid azp_setting_tabs_content ui-tabs-panel" id="azp_tab_animation">
                    '.self::renderElementAnimation($dataObject->attrs).'

                    

                    </div>

                    <!-- /.row-fluid -->';
                }

                if($showResponsiveTab == 'true'){
                    $html .='<div class="row-fluid azp_setting_tabs_content ui-tabs-panel" id="azp_tab_responsive">
                    '.self::renderElementResponsive($dataObject->attrs).'

                    

                    </div>

                    <!-- /.row-fluid -->';
                }

            if($showStyleTab == 'true' || $showAnimationTab == 'true' || $showResponsiveTab == 'true'){
            $html .='</div>

            <!-- /#azp_Tabs -->';
                }

             
            $html .='
            <div class="clearfix" ></div>
            <div class="row-fluid fancy-option-bottom" style="text-align: center;">
                <hr>
                <a href="#" id="azura-setting-btn-save" class="btn btn-primary azp_btn-primary azura-setting-btn-save">Save</a>
                <a href="#" id="azura-setting-btn-cancel" class="btn btn-default azp_btn-default azura-setting-btn-cancel">Close</a>
            </div>';

            $html .='
            <script>
                function jInsertFieldValue(value, id) {
                        var old_value = jQuery("#" + id).val();
                        if (old_value != value) {
                            var $elem = jQuery("#" + id);
                            $elem.val(value);
                            $elem.trigger("change");
                            if (typeof($elem.get(0).onchange) === "function") {
                                $elem.get(0).onchange();
                            }
                        }
                }

                jQuery(function($) {
                    SqueezeBox.initialize({});
                    SqueezeBox.assign($(\'a.modal_jform_azuragmapselect\').get(), {
                        parse: \'rel\'
                    });
                    
                }); 
                
                jQuery(function($) {
                    SqueezeBox.initialize({});
                    SqueezeBox.assign($(\'a.modal\').get(), {
                        parse: \'rel\'
                    });
                    
                }); 
                
                function jSelectItem(id, title, object) {
                    document.getElementById(\'elementAttrs[\'+object.substring(12)+\']_id\').value = id;
                    document.getElementById(\'elementAttrs[\'+object.substring(12)+\']_name\').value = title;
                    if(typeof(window.parent.SqueezeBox.close==\'function\')){
                        window.parent.SqueezeBox.close();
                    }
                    else {
                        document.getElementById(\'sbox-window\').close();
                    }
                }

                jQuery(function($) {
                    SqueezeBox.initialize({});
                    SqueezeBox.assign($(\'a.modal_jform_azuramedia\').get(), {
                        parse: \'rel\'
                    });
                    
                   
                    
                    // jQuery(\'body\').on(\'change\',\'#elementAttrs_src\', function(event){
                    //     event.preventDefault();
                    //     var value = event.currentTarget.value;
                        
                    //     jQuery(\'.fancybox-inner\').find(\'#elementAttrs_src\').val(value);
                    // });
                });
            
            </script>';


            $html .='
            <script>
                function jInsertIconClassValue(value, id) {
                        var old_value = jQuery("#" + id).val();
                        if (old_value != value) {
                            var $elem = jQuery("#" + id);
                            $elem.val(value);
                            $elem.trigger("change");
                            if (typeof($elem.get(0).onchange) === "function") {
                                $elem.get(0).onchange();
                            }
                        }
                }

                jQuery(function($) {
                    SqueezeBox.initialize({});
                    SqueezeBox.assign($(\'a.modal_jform_azurafont\').get(), {
                        parse: \'rel\'
                    });
                });
            
            </script>';

            $html .='
            <script>

                jQuery(document).ready(function($) {';
                    if($showStyleTab == 'true'|| $showAnimationTab == 'true' || $showResponsiveTab == 'true'){
                        //$html .='$( "#azp_tabs" ).tabs();';

                        $html .='

                            
                            $(".azp_setting_tabs_content").hide(); 
                            $("ul#azp_setting_tabs_ul li:first").addClass("ui-tabs-active ui-state-active").show();
                            $(".azp_setting_tabs_content:first").show(); 

                            
                            $("ul#azp_setting_tabs_ul li").click(function() {

                                $("ul#azp_setting_tabs_ul li").removeClass("ui-tabs-active ui-state-active"); 
                                $(this).addClass("ui-tabs-active ui-state-active"); 
                                $(".azp_setting_tabs_content").hide(); 

                                var activeTab = $(this).find("a").attr("href"); 
                                $(activeTab).fadeIn(); 
                                return false;
                            });

                        ';
                    }

                $html .='$(\'.radio.btn-group label\').addClass(\'btn btn-small\');
                    $(\'body\').on(\'click\',\'.btn-group label:not(.active)\',function()
                    {
                        var label = $(this);
                        var input = $(\'#\' + label.attr(\'for\'));

                        if (!input.prop(\'checked\')) {
                            label.closest(\'.btn-group\').find(\'label\').removeClass(\'active btn-success btn-danger btn-primary\');
                            if (input.val() == \'\') {
                                label.addClass(\'active btn-primary\');
                            } else if (input.val() == 0) {
                                label.addClass(\'active btn-danger\');
                            } else {
                                label.addClass(\'active btn-success\');
                            }
                            input.prop(\'checked\', \'checked\');
                        }
                    });
                    $(\'.btn-group input[checked=checked]\').each(function()
                    {
                        if ($(this).val() == \'\') {
                            $(\'label[for=\' + $(this).attr(\'id\') + \']\').addClass(\'active btn-primary\');
                        } else if ($(this).val() == 0) {
                            $(\'label[for=\' + $(this).attr(\'id\') + \']\').addClass(\'active btn-danger\');
                        } else {
                            $(\'label[for=\' + $(this).attr(\'id\') + \']\').addClass(\'active btn-success\');
                        }
                    });
                });
            
            </script>';

            $html .='
            <link rel="stylesheet" href="'.JURI::root(true).'/media/jui/css/jquery.minicolors.css" type="text/css" />
            <script src="'.JURI::root(true).'/media/system/js/html5fallback.js" type="text/javascript"></script>
            <script src="'.JURI::root(true).'/media/jui/js/jquery.minicolors.min.js" type="text/javascript"></script>
            <script>
                jQuery(document).ready(function (){
                    jQuery(\'.minicolors\').each(function() {
                        jQuery(this).minicolors({
                            control: jQuery(this).attr(\'data-control\') || \'hue\',
                            position: jQuery(this).attr(\'data-position\') || \'right\',
                            theme: \'bootstrap\'
                        });
                    });
                });
            </script>';

            return $html;
    }

    private static function renderElementStyle($styleAttrs){

        $margin_top = '';
        $margin_right = '';
        $margin_bottom = '';
        $margin_left = '';

        $border_top_width = '';
        $border_right_width = '';
        $border_bottom_width = '';
        $border_left_width = '';

        $padding_top = '';
        $padding_right = '';
        $padding_bottom = '';
        $padding_left = '';

        // margin

        if(isset($styleAttrs->margin_top)){
            $margin_top = $styleAttrs->margin_top;
        }
        if(isset($styleAttrs->margin_right)){
            $margin_right = $styleAttrs->margin_right;
        }
        if(isset($styleAttrs->margin_bottom)){
            $margin_bottom = $styleAttrs->margin_bottom;
        }
        if(isset($styleAttrs->margin_left)){
            $margin_left = $styleAttrs->margin_left;
        }

        //border

        if(isset($styleAttrs->border_top_width)){
            $border_top_width = $styleAttrs->border_top_width;
        }
        if(isset($styleAttrs->border_right_width)){
            $border_right_width = $styleAttrs->border_right_width;
        }
        if(isset($styleAttrs->border_bottom_width)){
            $border_bottom_width = $styleAttrs->border_bottom_width;
        }
        if(isset($styleAttrs->border_left_width)){
            $border_left_width = $styleAttrs->border_left_width;
        }

        //padding

        if(isset($styleAttrs->padding_top)){
            $padding_top = $styleAttrs->padding_top;
        }
        if(isset($styleAttrs->padding_right)){
            $padding_right = $styleAttrs->padding_right;
        }
        if(isset($styleAttrs->padding_bottom)){
            $padding_bottom = $styleAttrs->padding_bottom;
        }
        if(isset($styleAttrs->padding_left)){
            $padding_left = $styleAttrs->padding_left;
        }

        $eleStyleAddForm = JForm::getInstance('com_azurapagebuilder.page.optionelementstyle', 'formoptionelementstyle');

        $elementAttrsFields = array("border_color","border_style","background_color","background_image","background_repeat","background_attachment","background_size","additional_style","simplified");
        foreach ($elementAttrsFields as $key => $attr) {
            $value = null;
            if(isset($styleAttrs->{$attr})){
                $value = $styleAttrs->{$attr};
            }
            $eleStyleAddForm->setValue("{$attr}","elementAttrs", $value);
        }

        $simplifiedField = $eleStyleAddForm->getField('simplified',"elementAttrs")->value;


        $html = '<div class="azp_layout-onion'.(($simplifiedField == '1')? ' azp_simplified ': ' ').'span7">';
            $html .= '<div class="azp_margin">';
                $html .= '<label>margin</label>';
                $html .= '<input name="elementAttrs[margin_top]" data-name="margin-top" class="azp_top" placeholder="-" value="'.$margin_top.'" data-attribute="margin" type="text">';
                $html .= '<input name="elementAttrs[margin_right]" data-name="margin-right" class="azp_right" placeholder="-" data-attribute="margin" value="'.$margin_right.'" type="text">';
                $html .= '<input name="elementAttrs[margin_bottom]" data-name="margin-bottom" class="azp_bottom" placeholder="-" data-attribute="margin" value="'.$margin_bottom.'" type="text">';
                $html .= '<input name="elementAttrs[margin_left]" data-name="margin-left" class="azp_left" placeholder="-" data-attribute="margin" value="'.$margin_left.'" type="text"> ';     
                $html .= '<div class="azp_border">';
                    $html .= '<label>border</label>';
                    $html .= '<input name="elementAttrs[border_top_width]" data-name="border-width-top" class="azp_top" placeholder="-" data-attribute="border" value="'.$border_top_width.'" type="text">';
                    $html .= '<input name="elementAttrs[border_right_width]" data-name="border-width-right" class="azp_right" placeholder="-" data-attribute="border" value="'.$border_right_width.'" type="text">';
                    $html .= '<input name="elementAttrs[border_bottom_width]" data-name="border-width-bottom" class="azp_bottom" placeholder="-" data-attribute="border" value="'.$border_bottom_width.'" type="text">';
                    $html .= '<input name="elementAttrs[border_left_width]" data-name="border-width-left" class="azp_left" placeholder="-" data-attribute="border" value="'.$border_left_width.'" type="text">    ';      
                    $html .= '<div class="azp_padding">';
                        $html .= '<label>padding</label>';
                        $html .= '<input name="elementAttrs[padding_top]" data-name="padding-top" class="azp_top" placeholder="-" data-attribute="padding" value="'.$padding_top.'" type="text">';
                        $html .= '<input name="elementAttrs[padding_right]" data-name="padding-right" class="azp_right" placeholder="-" data-attribute="padding" value="'.$padding_right.'" type="text">';
                        $html .= '<input name="elementAttrs[padding_bottom]" data-name="padding-bottom" class="azp_bottom" placeholder="-" data-attribute="padding" value="'.$padding_bottom.'" type="text">';
                        $html .= '<input name="elementAttrs[padding_left]" data-name="padding-left" class="azp_left" placeholder="-" data-attribute="padding" value="'.$padding_left.'" type="text">  ';            
                        $html .= '<div class="azp_content">Azura</div>   ';       
                    $html .= '</div>      ';
                $html .= '</div>    ';
            $html .= '</div>';
        $html .= '</div>';

        $html .= '<!-- /.span7 -->';

        

        $html .= '<div class="span5 azp_settings">    ';

            $html .= '<div class="form-vertical">    ';
                           
            


		        foreach ($eleStyleAddForm->getFieldsets('elementAttrs') as $fieldsets => $fieldset) {

		            if($fieldset->name == 'elementAttrsStyle'){
		                foreach($eleStyleAddForm->getFieldset($fieldset->name) as $field){

		                    if ($field->hidden) {
		                        $html .= $field->input;
		                    }else{
		                        //echo'<pre>';var_dump($field);
		                        $html .= $field->getControlGroup();
		                    }
		                }
		            }
		        }

                

        


            $html .= '</div>';

            $html .= '<!-- /.form-vertical -->';
                           
        $html .= '</div>';

        $html .= '<!-- /.span5 -->';

         $html .=' 
            <script>

                jQuery(document).ready(function (){                  
                    
                    //jQuery("body").on("change","#elementAttrs_simplified", function(event){
                    jQuery("#elementAttrs_simplified").change(function(event){
                        jQuery(".azp_layout-onion").toggleClass("azp_simplified");
                    });
                    jQuery("body").on("blur",".azp_top",function(event){
                        event.preventDefault();
                        var azp_layout_onion = jQuery(this).closest(".azp_layout-onion");
                        if(azp_layout_onion.is(".azp_simplified")){
                            var val = jQuery(this).val();
                            jQuery(this).closest("div").children("input").val(val);
                        }
                        
                    });

                        //event.preventDefault();
                        //var value = event.currentTarget.value;
                        
                        //var azp_layout_onion = jQuery(".azp_layout-onion");

                        //if(azp_layout_onion.hasClass("azp_simplified")){
                        //    azp_layout_onion.removeClass("azp_simplified");
                        //}else{
                        //    azp_layout_onion.addClass("azp_simplified");
                        //}

                        //console.log(jQuery(".azp_layout-onion"));

                        //jQuery("body").on("blur",".azp_top",function(event){
                        //    event.preventDefault();
                        //    var val = jQuery(this).val();
                        //    jQuery(this).closest("div").children("input").val(val);
                        //});
                    //});
                });
            
            </script>';

        /*$html .='
            <link rel="stylesheet" href="'.JURI::root(true).'/media/jui/css/jquery.minicolors.css" type="text/css" />
            <script src="'.JURI::root(true).'/media/system/js/html5fallback.js" type="text/javascript"></script>
            <script src="'.JURI::root(true).'/media/jui/js/jquery.minicolors.min.js" type="text/javascript"></script>
            <script>
                jQuery(document).ready(function (){
                    jQuery(\'.minicolors\').each(function() {
                        jQuery(this).minicolors({
                            control: jQuery(this).attr(\'data-control\') || \'hue\',
                            position: jQuery(this).attr(\'data-position\') || \'right\',
                            theme: \'bootstrap\'
                        });
                    });
                });
			</script>';*/


        return $html;

    }

    private static function renderElementAnimation($styleAttrs){

        $eleStyleAddForm = JForm::getInstance('com_azurapagebuilder.page.optionelementanimation', 'formoptionelementanimation');

        // $elementAttrsFields = array("animation","trigger","animationtype","animationdelay","animationduration");
        // foreach ($elementAttrsFields as $key => $attr) {
        //     $value = null;
        //     if(isset($styleAttrs->{$attr})){
        //         $value = $styleAttrs->{$attr};
        //     }
        //     $eleStyleAddForm->setValue("{$attr}","elementAttrs", $value);
        // }

        $html = '<div class="span12">';

            $html .= '<div class="form-vertical">';
                           
	        foreach ($eleStyleAddForm->getFieldsets('elementAttrs') as $fieldsets => $fieldset) {

	            if($fieldset->name == 'elementAttrsAnimation'){
	                foreach($eleStyleAddForm->getFieldset($fieldset->name) as $field){
                        preg_match('/elementAttrs\[(.+)\]/', $field->name, $matches);

                        if(count($matches) > 1){
                            $attr = $matches[1];

                            if(isset($styleAttrs->{$attr})){
                                $value = $styleAttrs->{$attr};
                                $field->setValue($value);
                            }
                        }

	                    if ($field->hidden) {
	                        $html .= $field->input;
	                    }else{
	                        //echo'<pre>';var_dump($field);
	                        $html .= $field->getControlGroup();
	                    }
	                }
	            }
	        }

            $html .= '</div>';

            $html .= '<!-- /.form-horizontal -->';
                           
        $html .= '</div>';

        $html .= '<!-- /.span12 -->';

        return $html;

    }

    private static function renderElementResponsive($styleAttrs){
        //echo'<pre>';var_dump($styleAttrs);die;

        $eleResponsiveAddForm = JForm::getInstance('com_azurapagebuilder.page.optionelementresponsive', 'formoptionelementresponsive');

        // $elementAttrsFields = array("columnwidthclass",);
        // foreach ($elementAttrsFields as $key => $attr) {
        //     $value = null;
        //     if(isset($styleAttrs->{$attr})){
        //         $value = $styleAttrs->{$attr};
        //     }
        //     $eleResponsiveAddForm->setValue("{$attr}","elementAttrs", $value);
        // }



        $html = '<div class="span12">';

            $html .= '<div class="form-vertical">';
                           
            foreach ($eleResponsiveAddForm->getFieldsets('elementAttrs') as $fieldsets => $fieldset) {

                if($fieldset->name == 'elementAttrsResponsive'){
                    foreach($eleResponsiveAddForm->getFieldset($fieldset->name) as $field){

                        preg_match('/elementAttrs\[(.+)\]/', $field->name, $matches);

                        if(count($matches) > 1){
                            $attr = $matches[1];

                            if(isset($styleAttrs->{$attr})){
                                $value = $styleAttrs->{$attr};
                                $field->setValue($value);
                            }
                        }

                        if ($field->hidden) {
                            $html .= $field->input;
                        }else{
                            //echo'<pre>';var_dump($field);
                            $html .= $field->renderField();//array('hiddenLabel'=>true)
                        }
                    }
                }
            }

        $html .= '<table class="table table-bordered devices-table">
                
                <thead>
                    <tr>
                        <th style="width: 54px;">Device</th>
                        <th style="width: 200px;">Offset</th>
                        <th style="width: 200px;">Width</th>
                        <th style="width: 126px;">Hide on device</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($eleResponsiveAddForm->getFieldsets('elementAttrs') as $fieldsets => $fieldset) {

                    if($fieldset->name == 'elementAttrsResponsiveDesktop'){
                        $html .= '<tr><td>Desktop</td>';
                        foreach($eleResponsiveAddForm->getFieldset($fieldset->name) as $field){
                            preg_match('/elementAttrs\[(.+)\]/', $field->name, $matches);

                            if(count($matches) > 1){
                                $attr = $matches[1];

                                if(isset($styleAttrs->{$attr})){
                                    $value = $styleAttrs->{$attr};
                                    $field->setValue($value);
                                }
                            }

                            
                            if ($field->hidden) {
                                $html .= $field->input;
                            }else{
                                //echo'<pre>';var_dump($field);
                                if($field->type == 'Spacer'){
                                    $html .= '<td class="text-center">'.$field->renderField().'</td>';//array('hiddenLabel'=>true)
                                }else{
                                    $html .= '<td>'.$field->renderField(array('hiddenLabel'=>true)).'</td>';//array('hiddenLabel'=>true)
                                }
                            }
                            
                        }
                        $html .'</tr>';
                    }elseif($fieldset->name == 'elementAttrsResponsiveTablet1'){
                        $html .= '<tr><td>Tablet Horizontal</td>';
                        foreach($eleResponsiveAddForm->getFieldset($fieldset->name) as $field){
                            preg_match('/elementAttrs\[(.+)\]/', $field->name, $matches);

                            if(count($matches) > 1){
                                $attr = $matches[1];

                                if(isset($styleAttrs->{$attr})){
                                    $value = $styleAttrs->{$attr};
                                    $field->setValue($value);
                                }
                            }
                            
                            if ($field->hidden) {
                                $html .= $field->input;
                            }else{
                                //echo'<pre>';var_dump($field->type);
                                if($field->type == 'Spacer'){
                                    $html .= '<td class="text-center">'.$field->renderField().'</td>';//array('hiddenLabel'=>true)
                                }else{
                                    $html .= '<td>'.$field->renderField(array('hiddenLabel'=>true)).'</td>';//array('hiddenLabel'=>true) 
                                }
                                
                            }
                            
                        }
                        $html .'</tr>';
                    }elseif($fieldset->name == 'elementAttrsResponsiveTablet2'){
                        $html .= '<tr><td>Tablet Vertical</td>';
                        foreach($eleResponsiveAddForm->getFieldset($fieldset->name) as $field){
                            preg_match('/elementAttrs\[(.+)\]/', $field->name, $matches);

                            if(count($matches) > 1){
                                $attr = $matches[1];

                                if(isset($styleAttrs->{$attr})){
                                    $value = $styleAttrs->{$attr};
                                    $field->setValue($value);
                                }
                            }

                            if ($field->hidden) {
                                $html .= $field->input;
                            }else{
                                if($field->type == 'Spacer'){
                                    $html .= '<td class="text-center">'.$field->renderField().'</td>';//array('hiddenLabel'=>true)
                                }else{
                                    $html .= '<td>'.$field->renderField(array('hiddenLabel'=>true)).'</td>';//array('hiddenLabel'=>true) 
                                }
                            }
                            
                        }
                        $html .'</tr>';
                    }elseif($fieldset->name == 'elementAttrsResponsiveMobile'){
                        $html .= '<tr><td>Mobile</td>';
                        foreach($eleResponsiveAddForm->getFieldset($fieldset->name) as $field){
                            preg_match('/elementAttrs\[(.+)\]/', $field->name, $matches);

                            if(count($matches) > 1){
                                $attr = $matches[1];

                                if(isset($styleAttrs->{$attr})){
                                    $value = $styleAttrs->{$attr};
                                    $field->setValue($value);
                                }
                            }

                            if ($field->hidden) {
                                $html .= $field->input;
                            }else{
                                //echo'<pre>';var_dump($field);
                                if($field->type == 'Spacer'){
                                    $html .= '<td class="text-center">'.$field->renderField().'</td>';//array('hiddenLabel'=>true)
                                }else{
                                    $html .= '<td>'.$field->renderField(array('hiddenLabel'=>true)).'</td>';//array('hiddenLabel'=>true)
                                }
                            }
                            
                        }
                        $html .'</tr>';
                    }
                }

            $html .= '</tbody></table>';


            $html .= '</div>';

            $html .= '<!-- /.form-horizontal -->';
                           
        $html .= '</div>';

        $html .= '<!-- /.span12 -->';

        return $html;

    }

	
}