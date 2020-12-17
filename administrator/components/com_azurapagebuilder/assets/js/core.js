/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
 //console.log($);

 (function ($) {



    //Row Sortable
    $.fn.rowEleSortable = function(){
        $(this).sortable({
            placeholder: "ui-state-highlight",
            forcePlaceholderSize: true,
            //axis: 'x',
            cursor: "move",
            opacity: 0.8,
            tolerance: 'pointer',

            start: function(event, ui) {
                $( ".pagebuilder-section > .row" ).find('.ui-state-highlight').addClass( $(ui.item).attr('class') );
                $( ".pagebuilder-section > .row" ).find('.ui-state-highlight').css( 'height', $(ui.item).outerHeight() );
            }

        }).disableSelection();
    };

    //Section Sortable
    $.fn.secEleSortable = function(){
        $(this).sortable({
            placeholder: "ui-state-highlight",
            forcePlaceholderSize: true,
            //axis: 'x',
            cursor: "move",
            opacity: 0.8,
            tolerance: 'pointer',

            start: function(event, ui) {
                $( ".pagebuilder-section > .row" ).find('.ui-state-highlight').addClass( $(ui.item).attr('class') );
                $( ".pagebuilder-section > .row" ).find('.ui-state-highlight').css( 'height', $(ui.item).outerHeight() );
            }

        }).disableSelection();
    };

    //Column Sortable
    $.fn.colEleSortable = function() {
        //Sorting items
        $(this).sortable({
            connectWith: ".column,.azura-elements-container",
            items: ".azura-element",
            placeholder: "ui-state-highlight",
            forcePlaceholderSize: true,
            opacity: 0.8,
            dropOnEmpty: true,
            distance: 0.5,
            tolerance: 'pointer',
            cursor: "move"

        }).disableSelection();

        return $(this);
    };

    //Container Sortable
    $.fn.containerEleSortable = function() {
        //Sorting items
        $(this).sortable({
            connectWith: ".column",
            items: ".azura-element",
            placeholder: "ui-state-highlight",
            forcePlaceholderSize: true,
            opacity: 0.8,
            dropOnEmpty: true,
            distance: 0.5,
            tolerance: 'pointer',
            cursor: "move"

        }).disableSelection();

        return $(this);
    };

    //Remove Chosen
    $.fn.childEleSortable = function(){
        $(this).sortable({
            placeholder: "ui-state-highlight",
            forcePlaceholderSize: true,
            axis: 'y',
            opacity: 0.8,
            tolerance: 'pointer',
            cursor: "move"

        });

        return $(this);
    };

})(jQuery);

jQuery(function($) {
    // mixItUp filter 
    $("#azp_open_global_edit").click(function(){
        if($("#azp_global_edit").css('right') == '0px'){
            $("#azp_global_edit").animate({right:-300});
        }else{
            $("#azp_global_edit").animate({right:0});
        }
        
    });
    var $eleContainer = jQuery("#azura-element-container");

    jQuery('body').on('click','#azuraAddPageSection', function(event) {
        event.preventDefault();
        jQuery('.current-adding-element').removeClass('current-adding-element');
        jQuery('#azuraPagebuilderModalElement').azuramodal('show');
        $eleContainer.mixItUp({
            load: {
                filter: '.pagesection'
            },
            selectors: {
                filter: '.filter-btn'
            },
            animation: {
                enable: false       
            }
        });
        
    });

    jQuery('body').on('click','#azuraPrependPageSection', function(event) {
        event.preventDefault();
        jQuery('.current-adding-element').removeClass('current-adding-element');
        jQuery('body').addClass('page-prepend');
        jQuery('#azuraPagebuilderModalElement').azuramodal('show');
        $eleContainer.mixItUp({
            load: {
                filter: '.pagesection'
            },
            selectors: {
                filter: '.filter-btn'
            },
            animation: {
                enable: false       
            }
        });
        
    });

    jQuery('body').on('click','.add-element', function(event) {
        event.preventDefault();
        jQuery('.current-adding-element').removeClass('current-adding-element');
        jQuery(this).closest('.column-parent').addClass('current-adding-element');
        jQuery('#azuraPagebuilderModalElement').azuramodal('show');
        $eleContainer.mixItUp({
            load: {
                filter: ':not(.pagesection)'
            },
            selectors: {
                filter: '.filter-btn'
            },
            animation: {
                enable: false       
            }
            
        });
    });

    jQuery('body').on('click','.container-addele', function(event) {
        event.preventDefault();
        jQuery('.current-adding-element').removeClass('current-adding-element');
        jQuery(this).closest('.azura-element').addClass('current-adding-element');
        jQuery('#azuraPagebuilderModalElement').azuramodal('show');
        $eleContainer.mixItUp({
            load: {
                filter: ':not(.pagesection)'
            },
            selectors: {
                filter: '.filter-btn'
            },
            animation: {
                enable: false       
            }
            
        });
    });

    jQuery('body').on('click','.add-container', function(event) {
        event.preventDefault();
        jQuery(this).closest('.column-parent').children('.column-wrapper').children('.column').append(containerEleHtml());
        addSortable();
    });

    jQuery('body').on('click','.azura-elements > .azura-element', function(event){
        event.preventDefault();

        var $ele = jQuery(this);

        if($ele.is('.pagesection')){
            jQuery('.current-adding-element').removeClass('.current-adding-element');
            if($ele.is('.isrow')){
                if(jQuery('body').is('.page-prepend')){
                    jQuery('.azura-pagebuilder-area').prepend(rowEleHtml());
                    jQuery('body').removeClass('page-prepend');
                }else{
                    jQuery('.azura-pagebuilder-area').append(rowEleHtml());
                }
                
            }else{
                var eleData = JSON.parse(decodeURIComponent($ele.data('ele')));
                if(jQuery('body').is('.page-prepend')){
                    jQuery('.azura-pagebuilder-area').prepend(pageSectionEleHtml(eleData));
                    jQuery('body').removeClass('page-prepend');
                }else{
                    jQuery('.azura-pagebuilder-area').append(pageSectionEleHtml(eleData));
                }
            }

            addSortable();
        }else{
            var elementHtml = jQuery($ele.outerHTML()).removeClass('mix');
            if(jQuery('.current-adding-element').is('.iscontainer')){
                jQuery('.azura-element.current-adding-element').children('.azura-elements-container').append(elementHtml);

                jQuery('.azura-element.current-adding-element').removeClass('.current-adding-element');
            }else{
                jQuery('.column-parent.current-adding-element').children('.column-wrapper').children('.column').append(elementHtml);

                jQuery('.column-parent.current-adding-element').removeClass('.current-adding-element');
            }
        }
        
        jQuery('#azuraPagebuilderModalElement').azuramodal('hide');
        jQuery('body').removeClass('azura-modal-open').css('padding-right','');
        
    });

    function pageSectionEleHtml(eleData){
        var itemHtml = '<div class="azura-element-block pagebuilder-section pagesection" data-typeName="'+eleData.typename+'">';
            itemHtml += '<div class="section-header clearfix">';

                itemHtml += '<div class="pull-left">';

                    itemHtml += '<a class="move-icon" href="javascript:void(0)"><i class="fa fa-arrows"></i></a>';
                    if(eleData.hasonechild === 'no'&& eleData.hasownchild === 'yes'){
                        itemHtml += '<div class="azura-row-layout">';

                            itemHtml += '<a class="columns-layout" href="javascript:void(0)"><i class="fa fa-plus"></i> Section Layout</a>';
                            itemHtml += '<ul>';

                                itemHtml += '<li><a class="sec-set-width l_1" data-layout="11" href="#" title="1"></a></li>';
                                itemHtml += '<li><a class="sec-set-width l_12_12" href="#" data-layout="12_12" title="1/2+1/2"></a></li>';
                                itemHtml += '<li><a class="sec-set-width l_23_13" href="#" data-layout="23_13" title="2/3+1/3"></a></li>';

                                itemHtml += '<li><a class="sec-set-width l_13_13_13" href="#" data-layout="13_13_13" title="1/3+1/3+1/3"></a></li>';
                                itemHtml += '<li><a class="sec-set-width l_14_14_14_14" href="#" data-layout="14_14_14_14" title="1/4+1/4+1/4+1/4"></a></li>';
                                itemHtml += '<li><a class="sec-set-width l_14_34" href="#" data-layout="14_34" title="1/4+3/4"></a></li>';

                                itemHtml += '<li><a class="sec-set-width l_14_12_14" href="#" data-layout="14_12_14" title="1/4+1/2+1/4"></a></li>';
                                itemHtml += '<li><a class="sec-set-width l_56_16" href="#" data-layout="56_16" title="5/6+1/6"></a></li>';
                                itemHtml += '<li><a class="sec-set-width l_16_16_16_16_16_16" data-layout="16_16_16_16_16_16" href="#" title="1/6+1/6+1/6+1/6+1/6+1/6"></a></li>';

                                itemHtml += '<li><a class="sec-set-width l_16_46_16" data-layout="16_46_16" href="#" title="1/6+4/6+1/6"></a></li>';
                                itemHtml += '<li><a class="sec-set-width l_16_16_16_12" data-layout="16_16_16_12" href="#" title="1/6+1/6+1/6+1/2"></a></li>';
                                itemHtml += '<li class="custom">';
                                    itemHtml += '<ul>';
                                        itemHtml += '<li>Custom Layout</li>';
                                        itemHtml += '<li>&nbsp;&nbsp;&nbsp;<input type="text" class="set-width-column inputbox" placeholder="5/12+7/12 or 1/5+4/5"></li>';
                                        itemHtml += '<li>&nbsp;&nbsp;&nbsp;<button class="btn btn-small set-sec-width-custom-button">Set</button></li>';
                                    itemHtml += '</ul>';
                                itemHtml += '</li>';

                            itemHtml += '</ul>';
                        itemHtml += '</div>';
                    }
                    

                itemHtml += '</div>';
                /*end pull-left */

                itemHtml += '<div class="azura-element-tools pull-right">';
                    itemHtml += '<a href="javascript:void(0)" class="row-showhide"><i class="fa fa-chevron-up"></i></a>';
                    itemHtml += '<a href="javascript:void(0)" class="row-configs"><i class="fa fa-cog"></i></a>';
                    itemHtml += '<a  href="javascript:void(0)" class="row-duplicate"><i class="fa fa-copy"></i></a>';
                    itemHtml += '<a  href="javascript:void(0)" class="row-delete"><i class="fa fa-times"></i></a>';
                itemHtml += '</div>';
                /*end pull-right */

            itemHtml += '</div>';
            /*end section-header */
        
            /*section container */
            itemHtml += '<div class="row">';

            if(eleData.hasownchild === 'yes'){

                itemHtml += '<div class="column-parent pagesection col-md-12" data-typeName="'+eleData.childtypename+'">';

                    itemHtml += '<div class="section-item">';
                    
                        itemHtml += '<h3>'+eleData.childname+'</h3>';

                        itemHtml += '<div class="azura-element-tools">';
                            itemHtml += '<a href="javascrip:void(0)" class="sec-child-configs"><i class="fa fa-pencil"></i></a>';
                            itemHtml += '<a href="javascrip:void(0)" class="sec-child-copy"><i class="fa fa-copy"></i></a>';
                            itemHtml += '<a href="javascrip:void(0)" class="sec-child-remove"><i class="fa fa-times"></i></a>';
                        itemHtml += '</div>';

                    itemHtml += '</div>';

                    itemHtml += '<div class="azura-element-settings-saved saved" data="'+ encodeURIComponent('{"type":"'+eleData.childtypename+'","ispagesectionitem": true ,"parenttypename": "'+eleData.typename+'","id": "0","published":"1","language":"*", "content":"","attrs":{"columnwidthclass":"col-md-12"}}')+ '"></div>';

                itemHtml += '</div>';

            }

            itemHtml += '</div>';
            /*end section container */


            /*section data */
            itemHtml += '<div class="azura-element-settings-saved saved" data="'+encodeURIComponent('{"type":"'+eleData.typename+'","ispagesection": true ,"childtypename": "'+eleData.childtypename+'","hasonechild": "'+eleData.hasonechild+'","hasownchild": "'+eleData.hasownchild+'","id": "0","published":"1","language":"*", "content":"","attrs":{}}')+'"></div>';
            /*end section data */

        itemHtml += '</div>';

        return itemHtml;
    }

    function containerEleHtml(){
        var itemHtml = '<div class="azura-element iscontainer" data-typeName="AzuraContainer">';
            itemHtml += '<div class="azura-element-wrapper azura-element-type-azuracontainer clearfix">';
                // itemHtml += '<h3>Elements Container</h3>';
                itemHtml += '<div class="azura-element-tools">';
                    itemHtml += '<a href="javascrip:void(0)" class="container-addele"><i class="fa fa-plus"></i></a>';
                    itemHtml += '<a href="javascrip:void(0)" class="element-configs"><i class="fa fa-pencil"></i></a>';
                    itemHtml += '<a href="javascrip:void(0)" class="element-copy"><i class="fa fa-copy"></i></a>';
                    itemHtml += '<a href="javascrip:void(0)" class="element-remove"><i class="fa fa-times"></i></a>';
                itemHtml += '</div>';

            itemHtml += '</div>';

            itemHtml += '<div class="azura-elements-container">';
                
            itemHtml += '</div>';
            itemHtml += '<div class="azura-element-settings-saved saved" data="'+encodeURIComponent('{"type":"AzuraContainer","iscontainer":true,"id": "0","published":"1","language":"*", "content":"","attrs":{}}')+'"></div>';
            
        itemHtml += '</div>';

        return itemHtml;
    }

    jQuery('body').on('click','#azuraPageTemplate', function(event) {
        event.preventDefault();
        jQuery('#templateModal').modal('show');

    });

    jQuery('body').on('click','#azuraPageCustomStyle', function(event) {
        event.preventDefault();
        showCustomStyle(jQuery('#jform_customCssLinks').val(),600,620);

    });
    
    jQuery('body').on('click','.azuraAddElementPage', function(event) {
        event.preventDefault();
        SqueezeBox.initialize({});
        SqueezeBox.open('index.php?option=com_azurapagebuilder&view=elements&topage=1&tmpl=component', {
            handler: 'iframe',
            size: {x: 890, y: 390}
        });
    });
    jQuery('body').on('click','.azuraAddElement', function(event) {
        event.preventDefault();
        jQuery('.current-adding-element').removeClass('current-adding-element');
        jQuery(this).parent().parent().addClass('current-adding-element');
        SqueezeBox.initialize({});
        SqueezeBox.open('index.php?option=com_azurapagebuilder&view=elements&topage=0&tmpl=component', {
            handler: 'iframe',
            size: {x: 890, y: 390}
        });
    });
    function azuraAddElement(data,topage){
        if(topage == '1'){
            jQuery('.azura-elements-page').append(decodeURIComponent(data));
        }else{
            jQuery('.current-adding-element').children('.column-wrapper').children('.column').append(decodeURIComponent(data));
            jQuery('.current-adding-element').removeClass('current-adding-element');
        }
        
        SqueezeBox.close();
    }

    function addSortable(){
        jQuery( ".azura-pagebuilder-area" ).sortable({
            placeholder: "ui-state-highlight",
            forcePlaceholderSize: true,
            axis: 'y',
            opacity: 0.8,
            tolerance: 'pointer',
            cursor: "move"
        });//.disableSelection();


        jQuery('.pagebuilder-section.isrow').find('>.row').rowEleSortable();
        jQuery('.pagebuilder-section.pagesection').find('>.row').secEleSortable();
        jQuery('.column').colEleSortable();
        jQuery('.azura-elements-container').containerEleSortable();
        jQuery('.azura-element-children').childEleSortable();
    }

	addSortable();

    function rowEleHtml(){
        var itemHtml = '<div class="azura-element-block pagebuilder-section isrow" data-typeName="AzuraRow">';
            itemHtml += '<div class="section-header clearfix">';

                itemHtml += '<div class="pull-left">';

                    itemHtml += '<a class="move-icon" href="javascript:void(0)"><i class="fa fa-arrows"></i></a>';
                    itemHtml += '<div class="azura-row-layout">';

                        itemHtml += '<a class="columns-layout" href="javascript:void(0)"><i class="fa fa-plus"></i> Add Columns</a>';
                        itemHtml += '<ul>';

                            itemHtml += '<li><a class="set-width l_1" data-layout="11" href="#" title="1"></a></li>';
                            itemHtml += '<li><a class="set-width l_12_12" href="#" data-layout="12_12" title="1/2+1/2"></a></li>';
                            itemHtml += '<li><a class="set-width l_23_13" href="#" data-layout="23_13" title="2/3+1/3"></a></li>';

                            itemHtml += '<li><a class="set-width l_13_13_13" href="#" data-layout="13_13_13" title="1/3+1/3+1/3"></a></li>';
                            itemHtml += '<li><a class="set-width l_14_14_14_14" href="#" data-layout="14_14_14_14" title="1/4+1/4+1/4+1/4"></a></li>';
                            itemHtml += '<li><a class="set-width l_14_34" href="#" data-layout="14_34" title="1/4+3/4"></a></li>';

                            itemHtml += '<li><a class="set-width l_14_12_14" href="#" data-layout="14_12_14" title="1/4+1/2+1/4"></a></li>';
                            itemHtml += '<li><a class="set-width l_56_16" href="#" data-layout="56_16" title="5/6+1/6"></a></li>';
                            itemHtml += '<li><a class="set-width l_16_16_16_16_16_16" data-layout="16_16_16_16_16_16" href="#" title="1/6+1/6+1/6+1/6+1/6+1/6"></a></li>';

                            itemHtml += '<li><a class="set-width l_16_46_16" data-layout="16_46_16" href="#" title="1/6+4/6+1/6"></a></li>';
                            itemHtml += '<li><a class="set-width l_16_16_16_12" data-layout="16_16_16_12" href="#" title="1/6+1/6+1/6+1/2"></a></li>';
                            itemHtml += '<li class="custom">';
                                itemHtml += '<ul>';
                                    itemHtml += '<li>Custom Layout</li>';
                                    itemHtml += '<li>&nbsp;&nbsp;&nbsp;<input type="text" class="set-width-column inputbox" placeholder="5/12+7/12 or 1/5+4/5"></li>';
                                    itemHtml += '<li>&nbsp;&nbsp;&nbsp;<button class="btn btn-small set-width-custom-button">Set</button></li>';
                                itemHtml += '</ul>';
                            itemHtml += '</li>';

                        itemHtml += '</ul>';
                    itemHtml += '</div>';

                    itemHtml += '<a class="row-add-new-col" href="javascript:void(0)" title="Add New Column"><i class="fa fa-plus"></i></a>';

                itemHtml += '</div>';
                /*end pull-left */

                itemHtml += '<div class="azura-element-tools pull-right">';
                    itemHtml += '<a href="javascript:void(0)" class="row-showhide"><i class="fa fa-chevron-up"></i></a>';
                    itemHtml += '<a href="javascript:void(0)" class="row-configs"><i class="fa fa-cog"></i></a>';
                    itemHtml += '<a  href="javascript:void(0)" class="row-duplicate"><i class="fa fa-copy"></i></a>';
                    itemHtml += '<a  href="javascript:void(0)" class="row-delete"><i class="fa fa-times"></i></a>';
                itemHtml += '</div>';
                /*end pull-right */

            itemHtml += '</div>';
            /*end section-header */

            /*section container */
            itemHtml += '<div class="azura-element-type-azurarow-container row">';

                itemHtml += '<div class="column-parent col-md-12" data-typeName="AzuraColumn">';
                    itemHtml += '<div class="column-wrapper">';
                        itemHtml += '<div class="col-settings">';
                            itemHtml += '<a class="col-tools-name" href="javascript:void(0);">Column Tools</a>';
                            itemHtml += '<a class="add-container" href="javascript:void(0)" title="Add Container element"><i class="fa fa-plus-circle"></i></a>';
                            itemHtml += '<a class="add-element" href="javascript:void(0)" title="Add elements"><i class="fa fa-plus-circle"></i></a>';
                            itemHtml += '<a class="column-configs" href="javascript:void(0)" title="Config"><i class="fa fa-cog"></i></a>';
                            itemHtml += '<a class="column-duplicate" href="javascript:void(0)" title="Copy Column"><i class="fa fa-copy"></i></a>';
                            itemHtml += '<a class="column-delete" href="javascript:void(0)" title="Delete Column"><i class="fa fa-times"></i></a>';
                        itemHtml += '</div>';
                        itemHtml += '<div class="clearfix"></div>';

                        itemHtml += '<div class="column"></div>';

                    itemHtml += '</div>';
                    

                    itemHtml += '<div class="azura-element-settings-saved saved" data="'+ encodeURIComponent('{"type":"AzuraColumn","id": "0","published":"1","language":"*", "content":"","attrs":{"columnwidthclass":"col-md-12"}}')+ '"></div>';

                itemHtml += '</div>';

            itemHtml += '</div>';
            /*end section container */

            /*section data */
            itemHtml += '<div class="azura-element-settings-saved saved" data="'+encodeURIComponent('{"type":"AzuraRow","id": "0","published":"1","language":"*", "content":"","attrs":{}}')+'"></div>';
            /*end section data */

        itemHtml += '</div>';

        return itemHtml;
    }

    function colEleHtml(){
        var html = '<div class="column-parent col-md-12"  data-typeName="AzuraColumn">';
                html += '<div class="column-wrapper">';
                    html += '<div class="col-settings">';
                        html += '<a class="col-tools-name" href="javascript:void(0);">Column Tools</a>';
                        html += '<a class="add-container" href="javascript:void(0)" title="Add Container element"><i class="fa fa-plus-circle"></i></a>';
                        html += '<a class="add-element" href="javascript:void(0)" title="Add elements"><i class="fa fa-plus-circle"></i></a>';
                        html += '<a class="column-configs" href="javascript:void(0)" title="Config"><i class="fa fa-cog"></i></a>';
                        html += '<a class="column-duplicate" href="javascript:void(0)" title="Copy Column"><i class="fa fa-copy"></i></a>';
                        html += '<a class="column-delete" href="javascript:void(0)" title="Delete Column"><i class="fa fa-times"></i></a>';

                    html += '</div>';
                    html += '<div class="clearfix"></div>';
                    html += '<div class="column"></div>';
                html += '</div>';

                html += '<div class="azura-element-settings-saved saved" data="'+encodeURIComponent('{"type":"AzuraColumn","id": "0","published":"1","language":"*", "content":"","attrs":{"columnwidthclass":"col-md-12"}}')+'"></div>';
            html += '</div>';

        return html;
    }
    

    /* Add row to page */
    jQuery('body').on('click', '#azura-add-new-row', function(event){
        event.stopPropagation();
        event.preventDefault();

        jQuery('.azura-pagebuilder-area').append(rowEleHtml());

        addSortable();
    });

    /* Row Showhide Button */
    jQuery('body').on('click', '.row-showhide', function(event) {
        event.stopPropagation();
        event.preventDefault();

        var rowP = jQuery(this).closest('.pagebuilder-section');

        if(rowP.is('.rowhide')){
            rowP.removeClass('rowhide');
        }else{
            rowP.addClass('rowhide');
        }

    });

    /* Row Add New Column Button */
    jQuery('body').on('click', '.row-add-new-col', function(event) {
        event.stopPropagation();
        event.preventDefault();

        var parent = jQuery(this).closest('.pagebuilder-section');

        parent.children('.row').append(colEleHtml());

        addSortable();

    });
        
    /* Row Duplicate Button */
    jQuery('body').on('click', '.row-duplicate', function(event) {
        event.stopPropagation();
        event.preventDefault();

        var parent = jQuery(this).closest('.pagebuilder-section');

        parent.after(parent.outerHTML());

        addSortable();

    });

    /* Column Duplicate Button */
    jQuery('body').on('click', '.column-duplicate', function(event) {
        event.stopPropagation();
        event.preventDefault();

        var parent = jQuery(this).closest('.column-parent');

        parent.after(parent.outerHTML());

        addSortable();

    });

    /* Row Delete button */
    jQuery('body').on('click','.row-delete',function(event){
        event.stopPropagation();
        event.preventDefault();

        var confirmWin = confirm('Are you sure to delete this page section?');

        if(confirmWin === true){
            var row = jQuery(this).closest('.pagebuilder-section');
            row.remove();
        }

    });

    /* Column Delete button */
    jQuery('body').on('click','.column-delete',function(event){
        event.stopPropagation();
        event.preventDefault();

        var confirmWin = confirm('Are you sure to delete this column?');

        if(confirmWin === true){
            jQuery(this).closest('.column-parent').remove();
        }

    });

    /* Element Delete button */
    jQuery('body').on('click','.element-remove',function(event){
        event.stopPropagation();
        event.preventDefault();

        var confirmWin = confirm('Are you sure to delete this element?');

        if(confirmWin === true){
            var el = jQuery(this).closest('.azura-element')
            el.remove();
        }

        
    });

    /* Element Child Delete button */
    jQuery('body').on('click','.element-child-remove',function(event){
        event.stopPropagation();
        event.preventDefault();
        
        var confirmWin = confirm('Are you sure to delete this element?');

        if(confirmWin === true){
            var el = jQuery(this).closest('.azura-element-child')
            el.remove();
        }
        
    });

    /* Section Child Delete button */
    jQuery('body').on('click','.sec-child-remove',function(event){
        event.stopPropagation();
        event.preventDefault();
        
        var confirmWin = confirm('Are you sure to delete this element?');

        if(confirmWin === true){
            var el = jQuery(this).closest('.column-parent.pagesection')
            el.remove();
        }
        
    });
   	// jQuery('body').on('click','.azura-element-tools-remove',function(event){
   	// 	event.stopPropagation();
    // 	event.preventDefault();

    // 	var el = jQuery(this).parent().parent().parent();
    // 	el.remove();
   	// });

    
    
    function showConfigs(type,elementData,width,height){
        jQuery("#azuraBackdrop").addClass('in');
        var dataObject = decodeURIComponent(elementData);
            dataObject = JSON.parse(dataObject);
            dataObject.content = encodeURIComponent(dataObject.content);
            dataObject.shortcode = '';

            elementData = JSON.stringify(dataObject);
            elementData = encodeURIComponent(elementData);

        var action = window.adComBaseUrl+'index.php?option=com_azurapagebuilder&task=element.config';
            
        jQuery.post(
            action,
            {
                eletype : type.toLowerCase(),
                data : elementData
            },
            function(data){
                jQuery.fancybox.open({
                    wrapCSS     : 'fancy_'+type.toLowerCase(),
                    padding     : 0,
                    maxWidth    : 1000,
                    //maxHeight   : 650,
                    fitToView   : false,
                    width       : width,
                    height      : height,
                    autoSize    : false,
                    //autoHeight  : true,
                    modal       : true,
                    afterShow: function () {
                        jQuery('.fancybox-wrap').resizable({
                            //alsoResize: ".fancybox-inner, .fancybox-image"
                        });
                    },
                    closeClick  : false,
                    openEffect  : 'none',
                    closeEffect : 'none',
                    type : 'html',
                    content: data,
                    closeBtn : false,
                    helpers: {
                        overlay : {
                            closeClick : false,
                            locked : false
                        }
                    }


                });
                jQuery("#azuraBackdrop").removeClass('in');
            },

            'html'

        ).fail(function(err){
        
        });
    }

    function showCustomStyle(cusStyle,width,height){
        jQuery("#azuraBackdrop").addClass('in');
        // var dataObject = decodeURIComponent(elementData);
        //     dataObject = JSON.parse(dataObject);
        //     dataObject.content = encodeURIComponent(dataObject.content);
        //     dataObject.shortcode = '';

        //     elementData = JSON.stringify(dataObject);
        //     elementData = encodeURIComponent(elementData);

        var action = window.adComBaseUrl+'index.php?option=com_azurapagebuilder&task=element.cusStyle';
            
        jQuery.post(
            action,
            {
                //eletype : type.toLowerCase(),
                data : cusStyle
            },
            function(data){
                jQuery.fancybox.open({
                    padding     : 0,
                    maxWidth    : 1000,
                    maxHeight   : 650,
                    fitToView   : true,
                    width       : width,
                    height      : height,
                    autoSize    : false,
                    afterShow: function () {
                        jQuery('.fancybox-wrap').resizable({
                            //alsoResize: ".fancybox-inner, .fancybox-image"
                        });
                    },
                    closeClick  : false,
                    openEffect  : 'none',
                    closeEffect : 'none',
                    type : 'html',
                    content: data,
                    closeBtn : false,
                    helpers: {
                        overlay : {
                            closeClick : false,
                            locked : false
                        }
                    }


                });
                jQuery("#azuraBackdrop").removeClass('in');
            },

            'html'

        ).fail(function(err){
        
        });
    }

    /* Row Configs */
    jQuery('body').on('click', '.row-configs', function(event) {
        event.stopPropagation();
        event.preventDefault();

        //jQuery('.azura-element-block.current-editing').removeClass('current-editing');
        jQuery('.current-editing').removeClass('current-editing');

        var parent = jQuery(this).closest('.pagebuilder-section');//jQuery(this).parent().parent().parent();

        var type = parent.attr('data-typeName');

        var height = 620;
        var width = 600;

        parent.addClass('current-editing');


        var elementData = parent.children('.azura-element-settings-saved').attr('data');

        
        showConfigs(type,elementData,width,height);

    });

    /* Column Configs */
    jQuery('body').on('click', '.column-configs', function(event) {
        event.stopPropagation();
        event.preventDefault();

        //jQuery('.azura-element-block.current-editing').removeClass('current-editing');
        jQuery('.current-editing').removeClass('current-editing');

        var parent = jQuery(this).closest('.column-parent');//jQuery(this).parent().parent().parent();

        var type = 'AzuraColumn';//parent.attr('data-typeName');

        var height = 620;
        var width = 600;

        parent.addClass('current-editing');


        var elementData = parent.children('.azura-element-settings-saved').attr('data');

        
        showConfigs(type,elementData,width,height);

    });

    /* Section child Configs */
    jQuery('body').on('click', '.sec-child-configs', function(event) {
        event.stopPropagation();
        event.preventDefault();

        jQuery('.current-editing').removeClass('current-editing');

        var parent = jQuery(this).closest('.column-parent');

        var type = parent.attr('data-typeName');

        var height = 620;
        var width = 600;

        if(type === 'AzuraHtml'){
            width = 1000;
            height = 800;
        }

        if(type === 'AzuraTinyMce'){
            width = 1000;
            height = 800;
        }

        parent.addClass('current-editing');


        var elementData = parent.children('.azura-element-settings-saved').attr('data');

        
        showConfigs(type,elementData,width,height);

    });

    /* Element Configs */
    jQuery('body').on('click', '.element-configs', function(event) {
        event.stopPropagation();
        event.preventDefault();

        jQuery('.current-editing').removeClass('current-editing');

        var parent = jQuery(this).closest('.azura-element');

        var type = parent.attr('data-typeName');

        var height = 620;
        var width = 600;

        if(type === 'AzuraHtml'){
            width = 1000;height = 800;
        }
        if(type === 'AzuraTinyMce'){
            width = 1000;height = 800;
        }

        parent.addClass('current-editing');


        var elementData = parent.children('.azura-element-settings-saved').attr('data');

        
        showConfigs(type,elementData,width,height);

    });

    /* Element Child Configs */
    jQuery('body').on('click', '.element-child-configs', function(event) {
        event.stopPropagation();
        event.preventDefault();

        jQuery('.current-editing').removeClass('current-editing');

        var parent = jQuery(this).closest('.azura-element-child');

        var type = parent.attr('data-typeName');

        var height = 620;
        var width = 600;

        if(type === 'AzuraHtml'){
            width = 1000;
        }

        if(type === 'AzuraTinyMce'){
            width = 1000;
            
        }

        parent.addClass('current-editing');


        var elementData = parent.children('.azura-element-settings-saved').attr('data');

        
        showConfigs(type,elementData,width,height);

    });

    /* Element Copy */
    jQuery('body').on('click', '.element-copy', function(event) {
        event.stopPropagation();
        event.preventDefault();

        var parent = jQuery(this).closest('.azura-element');

        parent.after(parent.outerHTML());

        addSortable();

    });

    /* Element Child Copy */
    jQuery('body').on('click', '.element-child-copy', function(event) {
        event.stopPropagation();
        event.preventDefault();

        var parent = jQuery(this).closest('.azura-element-child');

        parent.after(parent.outerHTML());

        addSortable();

    });

    /* Section Child Copy */
    jQuery('body').on('click', '.sec-child-copy', function(event) {
        event.stopPropagation();
        event.preventDefault();

        var parent = jQuery(this).closest('.column-parent');

        parent.after(parent.outerHTML());

        addSortable();

    });
    jQuery('body').on('click', '.azura-setting-btn-cancel', function(event) {
    	event.stopPropagation();
    	event.preventDefault();
        var parent = jQuery(this).closest('.fancybox-inner');
        if(parent.find('#tiny_mce_editor').length > 0){
            tinymce.activeEditor.destroy();
        }
    	jQuery.fancybox.close();

    });

    function parseLayout(layout){
        var tu = layout.substr(0,1);
        var mau = layout.substr(1,1);
        var col_layout = 'col-md-12';
        switch (mau){
            case '2': 
                if(tu == '1'){
                    col_layout = 'col-md-6';
                }
                break;
            case '3':
                if(tu == '1'){
                    col_layout = 'col-md-4';
                }else if(tu == '2'){
                    col_layout = 'col-md-8';
                }
                break;
            case '4':
                if(tu == '1'){
                    col_layout = 'col-md-3';
                }else if(tu == '2'){
                    col_layout = 'col-md-6';
                }else if(tu == '3'){
                    col_layout = 'col-md-9';
                }
                break;
            case '6':
                if(tu == '1'){
                    col_layout = 'col-md-2';
                }else if(tu == '2'){
                    col_layout = 'col-md-4';
                }else if(tu == '3'){
                    col_layout = 'col-md-6';
                }else if(tu == '4'){
                    col_layout = 'col-md-8';
                }else if(tu == '5'){
                    col_layout = 'col-md-10';
                }
                break;
        }

        return col_layout;
    }

    function parseCustomLayout(layout){

        layout = layout.split("/");
        if(layout.length == 2){
            var tu = layout[0];
            var mau = layout[1];
            var col_layout = 'col-md-12';
            switch (mau){
                case '2': 
                    if(tu == '1'){
                        col_layout = 'col-md-6';
                    }
                    break;
                case '3':
                    if(tu == '1'){
                        col_layout = 'col-md-4';
                    }else if(tu == '2'){
                        col_layout = 'col-md-8';
                    }
                    break;
                case '4':
                    if(tu == '1'){
                        col_layout = 'col-md-3';
                    }else if(tu == '2'){
                        col_layout = 'col-md-6';
                    }else if(tu == '3'){
                        col_layout = 'col-md-9';
                    }
                    break;
                case '5':
                    if(tu == '1'){
                        col_layout = 'col-md-15';
                    }else if(tu == '2'){
                        col_layout = 'col-md-25';
                    }else if(tu == '3'){
                        col_layout = 'col-md-35';
                    }else if(tu == '4'){
                        col_layout = 'col-md-45';
                    }
                    break;
                case '6':
                    if(tu == '1'){
                        col_layout = 'col-md-2';
                    }else if(tu == '2'){
                        col_layout = 'col-md-4';
                    }else if(tu == '3'){
                        col_layout = 'col-md-6';
                    }else if(tu == '4'){
                        col_layout = 'col-md-8';
                    }else if(tu == '5'){
                        col_layout = 'col-md-10';
                    }
                    break;
                case '12':
                    if(tu < 12){
                        col_layout = 'col-md-'+tu;
                    }

                    break;
            }

            return col_layout;             
        }
        
    }

    function addColumnEle(parent, layout,restored,iscustom){
        if(iscustom){
            var col_layout = parseCustomLayout(layout);
        }else{
            var col_layout = parseLayout(layout);
        }
        if(restored === undefined){
            restored = new Array();
            restored['coldata'] = encodeURIComponent('{"type":"AzuraColumn","id": "0","published":"1","language":"*", "content":"","attrs":{"columnwidthclass": "col-md-12"}}');
            restored['children'] = '';
        }
        var colEleData = JSON.parse(decodeURIComponent(restored['coldata']));
            colEleData.attrs.columnwidthclass = col_layout;

        var html = '<div class="'+col_layout+' column-parent" data-typeName="AzuraColumn">';
                html += '<div class="column-wrapper">'; 
                    html += '<div class="col-settings">';
                        html += '<a class="col-tools-name" href="javascript:void(0);">Column Tools</a>';
                        html += '<a class="add-container" href="javascript:void(0)" title="Add Container element"><i class="fa fa-plus-circle"></i></a>';
                        html += '<a class="add-element" href="javascript:void(0)" title="Add elements"><i class="fa fa-plus-circle"></i></a>';
                        html += '<a class="column-configs" href="javascript:void(0)" title="Config"><i class="fa fa-cog"></i></a>';
                        html += '<a class="column-duplicate" href="javascript:void(0)" title="Copy Column"><i class="fa fa-copy"></i></a>';
                        html += '<a class="column-delete" href="javascript:void(0)" title="Delete Column"><i class="fa fa-times"></i></a>';

                    html += '</div>';
                    html += '<div class="clearfix"></div>';


                    html += '<div class="column">';

                        if(restored['children'] != undefined){

                            html += restored['children'];
                        }

                    html += '</div>';

                html += '</div>';

                html += '<div class="azura-element-settings-saved saved" data="'+encodeURIComponent(JSON.stringify(colEleData))+'"></div>';
            html += '</div>'

        parent.append(html);
    }

    function restoreCol(parent){
        var restored = new Array();
        var index = 0;
        jQuery('>.column-parent', parent).each(function(){
            restored[index] = new Array();
            restored[index]['children'] = jQuery(this).children('.column-wrapper').children('.column').html();
            restored[index]['coldata'] = jQuery(this).children('.azura-element-settings-saved').attr('data');
            index++;
        });
        return restored;
    }

    jQuery('body').on('click', '.set-width', function(event) {
        event.stopPropagation();
        event.preventDefault();

        jQuery('.set-width.active').removeClass('active');
        jQuery(this).addClass('active');

        var rowContainer = jQuery(this).closest('.pagebuilder-section').children('.row');

        var layout = jQuery(this).attr('data-layout').trim();

        layout = layout.split("_");

        var restored = restoreCol(rowContainer);

        rowContainer.html('');

        if(restored !== undefined){
                for (index = 0; index < layout.length; ++index) {
                    addColumnEle(rowContainer,layout[index],restored[index],false);
                }
        }

        addSortable();
    });

    jQuery('body').on('click','.set-width-custom-button', function(event){
        event.stopPropagation();
        event.preventDefault();

        var rowContainer = jQuery(this).closest('.pagebuilder-section').children('.row');

        var layout = jQuery(this).parent().parent().children().children('.set-width-column').val().trim();

        layout = layout.split("+");

        var restored = restoreCol(rowContainer);

        rowContainer.html('');

        if(restored !== undefined){
            //if(restored.length <= layout.length){
                for (index = 0; index < layout.length; ++index) {
                    addColumnEle(rowContainer,layout[index],restored[index],true);
                }
            // }else{
            //     var lastlayout = '12/12';
            //     for (index = 0; index < restored.length; ++index) {
            //         if((index+1) > layout.length){
            //             addColumnEle(rowContainer,lastlayout,restored[index],true);
            //         }else{
            //             addColumnEle(rowContainer,layout[index],restored[index],true);
            //             lastlayout = layout[index];
            //         }
            //     }
            // }
        }

        addSortable();
    });


    function addSectionItems(parent, layout,restored,iscustom){
        if(iscustom){
            var col_layout = parseCustomLayout(layout);
        }else{
            var col_layout = parseLayout(layout);
        }
        

        if(restored !== undefined){
            var sectionEleData = JSON.parse(decodeURIComponent(restored));
            sectionEleData.attrs.columnwidthclass = col_layout;

            //console.log(JSON.parse(decodeURIComponent(restored)).attrs);
            var html = '<div class="column-parent pagesection '+col_layout+'" data-typeName="'+sectionEleData.type+'">';
                html += '<div class="section-item">';
                if(sectionEleData.name !== undefined && sectionEleData.name !== ''){
                    html += '<h3>'+sectionEleData.name+'</h3>';
                }else{
                    html += '<h3>Section Item</h3>';
                }
                    

                    html += '<div class="azura-element-tools">';
                        html += '<a href="javascrip:void(0)" class="sec-child-configs"><i class="fa fa-pencil"></i></a>';
                        html += '<a href="javascrip:void(0)" class="sec-child-copy"><i class="fa fa-copy"></i></a>';
                        html += '<a href="javascrip:void(0)" class="sec-child-remove"><i class="fa fa-times"></i></a>';
                    html += '</div>';

                html += '</div>';

                html += '<div class="azura-element-settings-saved saved" data="'+encodeURIComponent(JSON.stringify(sectionEleData))+'"></div>';
            html += '</div>';

            //console.log(encodeURIComponent(JSON.stringify(sectionEleData)));

            parent.append(html);
        }
        
    }

    function restoreSecItems(parent){
        var restored = new Array();
        var index = 0;
        jQuery('>.column-parent', parent).each(function(){
            restored[index] = jQuery(this).children('.azura-element-settings-saved').attr('data')
            index++;
        });
        return restored;
    }

    jQuery('body').on('click', '.sec-set-width', function(event) {
        event.stopPropagation();
        event.preventDefault();

        jQuery('.sec-set-width.active').removeClass('active');
        jQuery(this).addClass('active');

        var rowContainer = jQuery(this).closest('.pagebuilder-section').children('.row');

        var layout = jQuery(this).attr('data-layout').trim();

        layout = layout.split("_");

        var restored = restoreSecItems(rowContainer);

        rowContainer.html('');

        if(restored !== undefined){
            if(restored.length <= layout.length){
                for (index = 0; index < layout.length; ++index) {
                    addSectionItems(rowContainer,layout[index],restored[index],false);
                }
            }else{
                var lastlayout = '11';
                for (index = 0; index < restored.length; ++index) {
                    if((index+1) > layout.length){
                        addSectionItems(rowContainer,lastlayout,restored[index],false);
                    }else{
                        addSectionItems(rowContainer,layout[index],restored[index],false);
                        lastlayout = layout[index];
                    }
                }
            }
        }

        

        addSortable();
    });
    
    jQuery('body').on('click','.set-sec-width-custom-button', function(event){
        event.stopPropagation();
        event.preventDefault();

        var rowContainer = jQuery(this).closest('.pagebuilder-section').children('.row');

        var layout = jQuery(this).parent().parent().children().children('.set-width-column').val().trim();

        layout = layout.split("+");

        var restored = restoreSecItems(rowContainer);

        rowContainer.html('');

        if(restored !== undefined){
            if(restored.length <= layout.length){
                for (index = 0; index < layout.length; ++index) {
                    addSectionItems(rowContainer,layout[index],restored[index],true);
                }
            }else{
                var lastlayout = '12/12';
                for (index = 0; index < restored.length; ++index) {
                    if((index+1) > layout.length){
                        addSectionItems(rowContainer,lastlayout,restored[index],true);
                    }else{
                        addSectionItems(rowContainer,layout[index],restored[index],true);
                        lastlayout = layout[index];
                    }
                }
            }
        }

        addSortable();
    });

    

    

    jQuery('body').on('click', '.azura-setting-btn-save', function(event) {
    	event.stopPropagation();
    	event.preventDefault();
    	var parent = jQuery(this).closest('.fancybox-inner');//jQuery(this).parent().parent();

    	var elementName = parent.find('input[name="elementName"]').val();

    	var elementPublished = parent.find('input[name="elementPubLang[published]"]:checked').val();

    	var elementCurrentEditing = jQuery('.current-editing');

    	var elementCurrentEditingType = elementCurrentEditing.attr('data-typeName');// elementCurrentEditing.children('.azura-element').attr('data-typeName');

    	var elementData = elementCurrentEditing.children('.azura-element-settings-saved');

    	var elementDataObject = JSON.parse(decodeURIComponent(elementData.attr('data')));

        //console.log(elementDataObject);

    	elementDataObject.name = elementName;
    	elementDataObject.published = elementPublished; 

        //console.log(elementPublished);

        if(elementCurrentEditingType == 'AzuraHtml'){
            AzuraHtmlSetting(parent, elementDataObject);
        }else{
            autoSaveElement(elementDataObject,parent);
        }
        //console.log('after saved');
        //console.log(elementDataObject);

    	elementData.attr('data', encodeURIComponent(JSON.stringify(elementDataObject)));
        if(elementCurrentEditingType === 'AzuraColumn'){
            elementCurrentEditing.removeClass('col-sm-1 col-sm-2 col-sm-3 col-sm-4 col-sm-5 col-sm-6 col-sm-7 col-sm-8 col-sm-9 col-sm-10 col-sm-11 col-sm-12 col-md-1 col-md-2 col-md-3 col-md-4 col-md-5 col-md-6 col-md-7 col-md-8 col-md-9 col-md-10 col-md-11 col-md-12 col-lg-1 col-lg-2 col-lg-3 col-lg-4 col-lg-5 col-lg-6 col-lg-7 col-lg-8 col-lg-9 col-lg-10 col-lg-11 col-lg-12');
            elementCurrentEditing.removeClass('col-sm-offset-0 col-sm-offset-1 col-sm-offset-2 col-sm-offset-3 col-sm-offset-4 col-sm-offset-5 col-sm-offset-6 col-sm-offset-7 col-sm-offset-8 col-sm-offset-9 col-sm-offset-10 col-sm-offset-11 col-sm-offset-12 col-md-offset-0 col-md-offset-1 col-md-offset-2 col-md-offset-3 col-md-offset-4 col-md-offset-5 col-md-offset-6 col-md-offset-7 col-md-offset-8 col-md-offset-9 col-md-offset-10 col-md-offset-11 col-md-offset-12 col-lg-offset-0 col-lg-offset-1 col-lg-offset-2 col-lg-offset-3 col-lg-offset-4 col-lg-offset-5 col-lg-offset-6 col-lg-offset-7 col-lg-offset-8 col-lg-offset-9 col-lg-offset-10 col-lg-offset-11 col-lg-offset-12');
            //console.log(elementDataObject.attrs);
            if(elementDataObject.attrs.xswidthclass !== ''){
                elementCurrentEditing.addClass(elementDataObject.attrs.xswidthclass);
            }
            if(elementDataObject.attrs.xsoffsetclass !== ''){
                elementCurrentEditing.addClass(elementDataObject.attrs.xsoffsetclass);
            }
            if(elementDataObject.attrs.columnwidthclass !== ''){
                elementCurrentEditing.addClass(elementDataObject.attrs.columnwidthclass.replace('col-md-','col-sm-'));
            }
            if(elementDataObject.attrs.smoffsetclass !== ''){
                elementCurrentEditing.addClass(elementDataObject.attrs.smoffsetclass);
            }
            if(elementDataObject.attrs.mdwidthclass !== ''){
                elementCurrentEditing.addClass(elementDataObject.attrs.mdwidthclass);
            }
            if(elementDataObject.attrs.mdoffsetclass !== ''){
                elementCurrentEditing.addClass(elementDataObject.attrs.mdoffsetclass);
            }
            if(elementDataObject.attrs.lgwidthclass !== ''){
                elementCurrentEditing.addClass(elementDataObject.attrs.lgwidthclass);
            }
            if(elementDataObject.attrs.lgoffsetclass !== ''){
                elementCurrentEditing.addClass(elementDataObject.attrs.lgoffsetclass);
            }
        }
    	elementCurrentEditing.removeClass('current-editing');
        if(parent.find('#tiny_mce_editor').length > 0){
            tinymce.activeEditor.destroy();
        }
    	jQuery.fancybox.close();

    });

    jQuery('body').on('click', '.azura-cusstyle-btn-save', function(event) {
        event.stopPropagation();
        event.preventDefault();
        var parent = jQuery(this).closest('.fancybox-inner');

        if(parent.find('#ace_editor').length > 0){
            jQuery('#jform_customCssLinks').val(ace_editor.getValue());
        }

        jQuery.fancybox.close();

    });



	function autoSaveElementAttrs(elementDataObject, parent){
        parent.find('[name^="elementAttrs"]').each(function(){
            var attrArr = /elementAttrs\[(.+)\]/g.exec(jQuery(this).attr('name'));
            if(attrArr.length > 1){
                var attrName = attrArr[1];
            }else{
                var attrName = '';
            }

            if(attrName !== ''){
                if(jQuery(this).is('input')){
                    var inputType = jQuery(this).attr('type');
                    if(typeof inputType !== undefined){
                        if(inputType == 'radio'|| inputType == 'checkbox'){
                            elementDataObject.attrs[attrName] = parent.find('input[name="elementAttrs['+attrName+']"]:checked').val();
                        }else{
                            elementDataObject.attrs[attrName] = parent.find('input[name="elementAttrs['+attrName+']"]').val();
                        }
                    }
                }else if(jQuery(this).is('select')){
                    elementDataObject.attrs[attrName] = parent.find('select[name="elementAttrs['+attrName+']"] option:selected').val();
                }else if(jQuery(this).is('textarea')){
                    elementDataObject.attrs[attrName] = parent.find('textarea[name="elementAttrs['+attrName+']"]').val();
                }
            }
            
        });

     
	}

	function autoSaveElementContent(elementDataObject, parent){
        if(parent.find('[name^="elementContent"]').length > 0){
            if(parent.find('[name^="elementContent"]').length === 1){
                var contentEle = parent.find('[name^="elementContent"]').eq(0);
                var contentArr = /elementContent\[(.+)\]/g.exec(contentEle.attr('name'));
                if(contentArr.length > 1){
                    var contentName = contentArr[1];
                }else{
                    var contentName = '';
                }

                if(contentName !== ''){
                    if(contentEle.is('input')){
                        var inputType = contentEle.attr('type');
                        if(typeof inputType !== undefined){
                            if(inputType == 'radio'|| inputType == 'checkbox'){
                                elementDataObject.content = parent.find('input[name="elementContent['+contentName+']"]:checked').val();
                            }else{
                                elementDataObject.content = parent.find('input[name="elementContent['+contentName+']"]').val();
                            }
                        }
                    }else if(contentEle.is('select')){
                        elementDataObject.content = parent.find('select[name="elementContent['+contentName+']"] option:selected').val();
                    }else if(contentEle.is('textarea')){
                        elementDataObject.content = parent.find('textarea[name="elementContent['+contentName+']"]').val();
                    }
                }
            }else{
                elementDataObject.content = {};

                parent.find('[name^="elementContent"]').each(function(){
                    var contentArr = /elementContent\[(.+)\]/g.exec(jQuery(this).attr('name'));
                    if(contentArr.length > 1){
                        var contentName = contentArr[1];
                    }else{
                        var contentName = '';
                    }

                    if(contentName !== ''){
                        if(jQuery(this).is('input')){
                            var inputType = jQuery(this).attr('type');
                            if(typeof inputType !== undefined){
                                if(inputType == 'radio'|| inputType == 'checkbox'){
                                    elementDataObject.content[contentName] = parent.find('input[name="elementContent['+contentName+']"]:checked').val();
                                }else{
                                    elementDataObject.content[contentName] = parent.find('input[name="elementContent['+contentName+']"]').val();
                                }
                            }
                        }else if(jQuery(this).is('select')){
                            elementDataObject.content[contentName] = parent.find('select[name="elementContent['+contentName+']"] option:selected').val();
                        }else if(jQuery(this).is('textarea')){
                            elementDataObject.content[contentName] = parent.find('textarea[name="elementContent['+contentName+']"]').val();
                        }
                    }
                    
                });

            }
        }else if(parent.find('#ace_editor').length > 0){
            elementDataObject.content = ace_editor.getValue();
        }else if(parent.find('#tiny_mce_editor').length > 0){
            elementDataObject.content = tinymce.activeEditor.getContent({format: 'raw'});
        }
        
        //console.log(ace_editor.getValue());

	}

    function autoSaveElement(elementDataObject, parent){
        autoSaveElementAttrs(elementDataObject, parent);
        autoSaveElementContent(elementDataObject, parent);
    }

	
	function AzuraHtmlSetting(parent, elementDataObject) {
        autoSaveElementAttrs(elementDataObject, parent);
		var html = '';
        html = parent.find('iframe').contents().find('iframe').contents().find('body').html();
		if(!html){
			html = parent.find('iframe').contents().find('textarea#AzuraTextEditor').val();
		}
		elementDataObject.content = html;
	}
	

	function f() {
	  	f.count = ++f.count || 1
	  	return f.count;
	}


	function hasChildRecurse(parent, AzuraElementDatasObject,PageShortcodeArrayObjects,elementsSettingArrayObjects,level){
		 AzuraElementDatasObject.hasChild = 0;
		 AzuraElementDatasObject.level = level;
		 if(parent.children().children().is('.azura-sortable')){
		 	var hasChildID = f();
		 	AzuraElementDatasObject.hasChild = 1;
		 	AzuraElementDatasObject.hasChildID = hasChildID;

		 	PageShortcodeArrayObjects[PageShortcodeArrayObjects.length] = AzuraElementDatasObject;

		 	elementsSettingArrayObjects[elementsSettingArrayObjects.length] = AzuraElementDatasObject;
		 	var context = parent.children().children('.azura-sortable');
            var isHasChild = false;
		 	jQuery('>.azura-element-block', context).each(function(){
		 		var parent = jQuery(this);
		 		var AzuraElementDatas =  decodeURIComponent(parent.children('.azura-element-settings-saved').attr('data'));
		 		var AzuraElementDatasObject = jQuery.parseJSON(AzuraElementDatas);

		 		AzuraElementDatasObject.hasParentID = hasChildID;
		 		
                isHasChild = true;

		 		AzuraElementDatasObject.level = level+1;

		 		hasChildRecurse(parent, AzuraElementDatasObject,PageShortcodeArrayObjects,elementsSettingArrayObjects,level+1);

		 	});
            if(isHasChild){
                level++;
            }
		 }else{
		 	PageShortcodeArrayObjects[PageShortcodeArrayObjects.length] = AzuraElementDatasObject;

		 	elementsSettingArrayObjects[elementsSettingArrayObjects.length] = AzuraElementDatasObject;

		 }
	}

    // Save page v1.3
    function genPageContentShortcodes(item,parent){

        var item = item? item : [];
        var parent = parent ? parent : jQuery('.azura-pagebuilder-area');
        jQuery('>.pagebuilder-section', parent).each(function(index) {

            /* Page section element */
            if(jQuery(this).is('.pagesection')){
                var $sec = jQuery(this),
                secIndex = index,
                secData = $sec.children('.azura-element-settings-saved').attr('data');

                item[secIndex] = JSON.parse(decodeURIComponent(secData));
                //item[secIndex].hasownchild = 'yes';
                item[secIndex].children = [];

                $sec.find('.column-parent').each(function(index){
                    var $secItem = jQuery(this),
                    secItemIndex = index,
                    //className = $secItem.attr('class').replace("column-parent",""),
                    secItemData = $secItem.children('.azura-element-settings-saved').attr('data');

                    item[secIndex].children[secItemIndex] = JSON.parse(decodeURIComponent(secItemData));
                    item[secIndex].children[secItemIndex].children = [];
                });
            }
            /* end page section element */
            /* row elements */
            else{
                var $row = jQuery(this),
                rowIndex = index,
                rowData = $row.children('.azura-element-settings-saved').attr('data');

                item[rowIndex] = JSON.parse(decodeURIComponent(rowData));
                item[rowIndex].children = [];
                /* column elements */
                $row.find('.column-parent').each(function(index){

                    var $column = jQuery(this),
                    colIndex = index,
                    className = $column.attr('class').replace("column-parent",""),
                    colData = $column.children('.azura-element-settings-saved').attr('data');

                    item[rowIndex].children[colIndex] = JSON.parse(decodeURIComponent(colData));
                    item[rowIndex].children[colIndex].children = [];

                    /* elements in column element */
                    $column.find('> .column-wrapper > .column > .azura-element').each(function(index){

                        var $element = jQuery(this),
                        eleIndex = index,
                        eleData = $element.children('.azura-element-settings-saved').attr('data');
                        /* container element */
                        if($element.is('.iscontainer')){
                            /*is column container element //eleIndex = containerIndex */
                            item[rowIndex].children[colIndex].children[eleIndex] = JSON.parse(decodeURIComponent(eleData));
                            item[rowIndex].children[colIndex].children[eleIndex].children = [];
                            
                            $element.find('> .azura-elements-container > .azura-element').each(function(index){
                                var $celement = jQuery(this),
                                celeIndex = index,
                                celeData = $celement.children('.azura-element-settings-saved').attr('data');

                                item[rowIndex].children[colIndex].children[eleIndex].children[celeIndex] = JSON.parse(decodeURIComponent(celeData));
                                item[rowIndex].children[colIndex].children[eleIndex].children[celeIndex].children = [];

                                if($celement.find('.azura-element-children .azura-element-child')){
                                    $celement.find('.azura-element-children .azura-element-child').each(function(index){

                                        var $childele = jQuery(this),
                                        childeleIndex = index,
                                        childeleData = $childele.children('.azura-element-settings-saved').attr('data');

                                        item[rowIndex].children[colIndex].children[eleIndex].children[celeIndex].children[childeleIndex] = JSON.parse(decodeURIComponent(childeleData));
                                        item[rowIndex].children[colIndex].children[eleIndex].children[celeIndex].children[childeleIndex].children = [];
                                    });
                                }
                            });

                        }
                        /* end container element */
                        else{
                            item[rowIndex].children[colIndex].children[eleIndex] = JSON.parse(decodeURIComponent(eleData));
                            item[rowIndex].children[colIndex].children[eleIndex].children = [];




                            if($element.find('.azura-element-children .azura-element-child')){
                                $element.find('.azura-element-children .azura-element-child').each(function(index){

                                    var $childele = jQuery(this),
                                    childeleIndex = index,
                                    childeleData = $childele.children('.azura-element-settings-saved').attr('data');

                                    item[rowIndex].children[colIndex].children[eleIndex].children[childeleIndex] = JSON.parse(decodeURIComponent(childeleData));
                                    item[rowIndex].children[colIndex].children[eleIndex].children[childeleIndex].children = [];
                                });
                            }
                        }

                    });
                    /* end elemenents in column element */

                });
                /* end column elements */
            }
            /* end row element */

        });
        
        return item;

    }

    /* Save templte */

    jQuery('body').on('click','#templateSaveBtn', function(event) {
        event.preventDefault();
        var tempName = jQuery('#templateName').val();
        if(tempName === ''){
            alert('Please enter a name');
            // return false;
        }else{

            saveTemplateAjax(tempName);
        }

    });


    function saveTemplateAjax(tempName){
        var pageData = encodeURIComponent(JSON.stringify(genPageContentShortcodes())) ;

        var action = window.adComBaseUrl+'index.php?option=com_azurapagebuilder&task=pagetemplate.save';
            
        jQuery.post(
            action,
            {
                name : tempName,
                data : pageData
            },
            function(data){
                if(data.info === 'error'){
                    alert(data.msg);
                }else if(data.info === 'success'){
                    jQuery("#templateList").prepend('<li data-template="'+data.savename+'"><a class="appendTemplate" href="javascript:void(0)">'+data.templatename+'</a><a class="pull-right deleteTemplate" href="javascript:void(0)"><span class="badge badge-important">Delete</span></a></li>');
                    jQuery('#templateModal').modal('hide');
                }
                
            },

            'json'

        ).fail(function(err){
        
        });

        
    }

    /* Delete templte */

    function deleteTemplateAjax(savename,parent){

        var action = window.adComBaseUrl+'index.php?option=com_azurapagebuilder&task=pagetemplate.delete';
            
        jQuery.post(
            action,
            {
                name : savename
            },
            function(data){
        
                if(data.info === 'error'){
                    alert(data.msg);
                }else if(data.info === 'success'){
                    parent.remove();
                    
                    //jQuery('#templateModal').modal('hide');
                }
                
            },

            'json'

        ).fail(function(err){
        
        });

        
    }

    jQuery('body').on('click','.deleteTemplate', function(event) {
        event.preventDefault();
        var confirmWin = confirm('Are you sure to delete this template?');

        if(confirmWin === true){
            var $parent = jQuery(this).closest('li');
            var savename = $parent.data('template');
            if(savename !== ''){

                deleteTemplateAjax(savename,$parent);
            }
        }

    });

    /* Append templte */

    function appendTemplateAjax(savename){

        var action = window.adComBaseUrl+'index.php?option=com_azurapagebuilder&task=pagetemplate.append';
            
        jQuery.post(
            action,
            {
                name : savename
            },
            function(data){
                //console.log(data);

                if(data === false){
                    alert('Error on loading page template.');
                }else{
                    jQuery('.azura-pagebuilder-area').append(data);
                    jQuery('#templateModal').modal('hide');
                }
        
                // if(data.info === 'error'){
                //     alert(data.msg);
                // }else if(data.info === 'success'){
                //     //parent.remove();

                //     console.log(data.data);
                    
                //     //jQuery('#templateModal').modal('hide');
                // }
                
            },

            'html'

        ).fail(function(err){
        
        });

        
    }

    jQuery('body').on('click','.appendTemplate', function(event) {
        event.preventDefault();
        var savename = jQuery(this).closest('li').data('template');
        if(savename !== ''){

            appendTemplateAjax(savename);
        }

    });

    // Save page v1.3
    function genSectionContentShortcodes(section){

        var item = {};

        /* Page section element */
        if(section.is('.pagesection')){
            // var $sec = jQuery(this),
            // secIndex = index,
            secData = section.children('.azura-element-settings-saved').attr('data');

            item = JSON.parse(decodeURIComponent(secData));
            item.children = [];

            section.find('.column-parent').each(function(index){
                var $secItem = jQuery(this),
                secItemIndex = index,
                //className = $secItem.attr('class').replace("column-parent",""),
                secItemData = $secItem.children('.azura-element-settings-saved').attr('data');

                item.children[secItemIndex] = JSON.parse(decodeURIComponent(secItemData));
                item.children[secItemIndex].children = [];
            });
        }
        /* end page section element */
        /* row elements */
        else{
            rowData = section.children('.azura-element-settings-saved').attr('data');

            item = JSON.parse(decodeURIComponent(rowData));
            item.children = [];
            /* column elements */
            section.find('.column-parent').each(function(index){

                var $column = jQuery(this),
                colIndex = index,
                className = $column.attr('class').replace("column-parent",""),
                colData = $column.children('.azura-element-settings-saved').attr('data');

                item.children[colIndex] = JSON.parse(decodeURIComponent(colData));
                item.children[colIndex].children = [];

                /* elements in column element */
                $column.find('> .column-wrapper > .column > .azura-element').each(function(index){

                    var $element = jQuery(this),
                    eleIndex = index,
                    eleData = $element.children('.azura-element-settings-saved').attr('data');
                    /* container element */
                    if($element.is('.iscontainer')){
                        /*is column container element //eleIndex = containerIndex */
                        item.children[colIndex].children[eleIndex] = JSON.parse(decodeURIComponent(eleData));
                        item.children[colIndex].children[eleIndex].children = [];
                        
                        $element.find('> .azura-elements-container > .azura-element').each(function(index){
                            var $celement = jQuery(this),
                            celeIndex = index,
                            celeData = $celement.children('.azura-element-settings-saved').attr('data');

                            item.children[colIndex].children[eleIndex].children[celeIndex] = JSON.parse(decodeURIComponent(celeData));
                            item.children[colIndex].children[eleIndex].children[celeIndex].children = [];

                            if($celement.find('.azura-element-children .azura-element-child')){
                                $celement.find('.azura-element-children .azura-element-child').each(function(index){

                                    var $childele = jQuery(this),
                                    childeleIndex = index,
                                    childeleData = $childele.children('.azura-element-settings-saved').attr('data');

                                    item.children[colIndex].children[eleIndex].children[celeIndex].children[childeleIndex] = JSON.parse(decodeURIComponent(childeleData));
                                    item.children[colIndex].children[eleIndex].children[celeIndex].children[childeleIndex].children = [];
                                });
                            }
                        });

                    }
                    /* end container element */
                    else{
                        item.children[colIndex].children[eleIndex] = JSON.parse(decodeURIComponent(eleData));
                        item.children[colIndex].children[eleIndex].children = [];




                        if($element.find('.azura-element-children .azura-element-child')){
                            $element.find('.azura-element-children .azura-element-child').each(function(index){

                                var $childele = jQuery(this),
                                childeleIndex = index,
                                childeleData = $childele.children('.azura-element-settings-saved').attr('data');

                                item.children[colIndex].children[eleIndex].children[childeleIndex] = JSON.parse(decodeURIComponent(childeleData));
                                item.children[colIndex].children[eleIndex].children[childeleIndex].children = [];
                            });
                        }
                    }

                });
                /* end elemenents in column element */

            });
            /* end column elements */
        }
        /* end row element */

        
        return item;

    }

    function saveSectionTemplateAjax(section,sectionname){
        var secData = encodeURIComponent(JSON.stringify(genSectionContentShortcodes(section))) ;

        //console.log(secData);

        var action = window.adComBaseUrl+'index.php?option=com_azurapagebuilder&task=pagetemplate.saveSec';
            
        jQuery.post(
            action,
            {
                name : sectionname,
                data : secData
            },
            function(data){
                if(data.info === 'error'){
                    alert(data.msg);
                }else if(data.info === 'success'){
                    jQuery("#secTemplateList").prepend('<li data-template="'+data.savename+'"><a class="appendSecTemplate" href="javascript:void(0)">'+data.templatename+'</a><a class="pull-right deleteSecTemplate" href="javascript:void(0)"><span class="badge badge-important">Delete</span></a></li>');
                    jQuery('#templateModal').modal('hide');
                }
                
            },

            'json'

        ).fail(function(err){
        
        });

        
    }

    /* Delete section templte */

    function deleteSecTemplateAjax(savename,parent){

        var action = window.adComBaseUrl+'index.php?option=com_azurapagebuilder&task=pagetemplate.deleteSec';
            
        jQuery.post(
            action,
            {
                name : savename
            },
            function(data){
        
                if(data.info === 'error'){
                    alert(data.msg);
                }else if(data.info === 'success'){
                    parent.remove();
                    
                    jQuery('#templateModal').modal('hide');
                }
                
            },

            'json'

        ).fail(function(err){
        
        });

        
    }

    jQuery('body').on('click','.deleteSecTemplate', function(event) {
        event.preventDefault();
        var confirmWin = confirm('Are you sure to delete this template?');

        if(confirmWin === true){
            var $parent = jQuery(this).closest('li');
            var savename = $parent.data('template');
            if(savename !== ''){

                deleteSecTemplateAjax(savename,$parent);
            }
        }

    });

    /* Append Section templte */

    function appendSecTemplateAjax(savename){

        var action = window.adComBaseUrl+'index.php?option=com_azurapagebuilder&task=pagetemplate.appendSec';
            
        jQuery.post(
            action,
            {
                name : savename
            },
            function(data){
                //console.log(data);

                if(data === false){
                    alert('Error on loading page template.');
                }else{
                    //console.log(data);
                    jQuery('.azura-pagebuilder-area').append(data);
                    jQuery('#templateModal').modal('hide');
                }
        
                // if(data.info === 'error'){
                //     alert(data.msg);
                // }else if(data.info === 'success'){
                //     //parent.remove();

                //     console.log(data.data);
                    
                //     //jQuery('#templateModal').modal('hide');
                // }
                
            },

            'html'

        ).fail(function(err){
        
        });

        
    }

    jQuery('body').on('click','.appendSecTemplate', function(event) {
        event.preventDefault();
        var savename = jQuery(this).closest('li').data('template');
        if(savename !== ''){

            appendSecTemplateAjax(savename);
        }

    });

    /* Save templte */

    jQuery('body').on('click','.sec-to-templates', function(event) {
        event.preventDefault();
        var sectionname = prompt("Please enter section's name", "Page Section");
        var sec = jQuery(this).closest('.pagebuilder-section');
        if (sectionname != null) {
            saveSectionTemplateAjax(sec,sectionname);
        }else{
            alert("Please enter section's name");
        }
        

    });

	function savePage(){
		var PageShortcodeArrayObjects = new Array();

		var elementsSettingArrayObjects = new Array();

		jQuery('.azura-sortable.azura-elements-page >.azura-element-block').each(function(index, val) {

			 var $this = jQuery(this);

			 var AzuraElementDatas =  decodeURIComponent($this.children('.azura-element-settings-saved').attr('data')); 

			 var AzuraElementDatasObject = jQuery.parseJSON(AzuraElementDatas);

			 var level = 0;

			 hasChildRecurse($this,AzuraElementDatasObject,PageShortcodeArrayObjects,elementsSettingArrayObjects,level);

		});


		var PageElementsArrayText = new Array();
		var elementsSettingArrayObjectsText = new Array();

		for	(index = 0; index < PageShortcodeArrayObjects.length; ++index) {

			var ElementArrayText = '{ "type" :"'+ PageShortcodeArrayObjects[index].type + '", "id" :"' + PageShortcodeArrayObjects[index].id + '"}';

			PageElementsArrayText[PageElementsArrayText.length] = ElementArrayText;

			elementsSettingArrayObjectsText[elementsSettingArrayObjectsText.length] = JSON.stringify(PageShortcodeArrayObjects[index]);

		}

		PageElementsArrayText = JSON.stringify(PageElementsArrayText);

		//jQuery('#jform_elementsArray').val(encodeURIComponent(PageElementsArrayText));
        jQuery('#jform_elementsArray').val('');
		jQuery('#jform_elementsSettingArray').val(encodeURIComponent(JSON.stringify(elementsSettingArrayObjectsText)));
		var PageShortcodeText = '';
		var ElementsShortcodeArray = new Array();
		for	(index = 0; index < PageShortcodeArrayObjects.length; ++index) {
			var attrsText = '';
			var attrs = PageShortcodeArrayObjects[index].attrs;
			for(var attr in attrs){
				if(attrs.hasOwnProperty(attr)){
			       attrsText += (attr + "=\"" + attrs[attr]+"\" ");
			    }
			}

		    PageShortcodeText += ('['+PageShortcodeArrayObjects[index].type + ' ' + attrsText + ']' + PageShortcodeArrayObjects[index].content + '['+'/'+PageShortcodeArrayObjects[index].type+']');

		    ElementsShortcodeArray[ElementsShortcodeArray.length] = encodeURIComponent('['+PageShortcodeArrayObjects[index].type + ' ' + attrsText + ']' + PageShortcodeArrayObjects[index].content + '['+'/'+PageShortcodeArrayObjects[index].type+']');
		}

		//jQuery('#jform_elementsShortcodeArray').val(encodeURIComponent(JSON.stringify(ElementsShortcodeArray)));
        jQuery('#jform_elementsShortcodeArray').val('');

		//jQuery('#jform_shortcode').val(encodeURIComponent(PageShortcodeText));
        jQuery('#jform_shortcode').val('');

        //console.log(encodeURIComponent(JSON.stringify(genPageContentShortcodes())) );

        jQuery('#jform_pagecontent').val( encodeURIComponent(JSON.stringify(genPageContentShortcodes())) );
	}

	jQuery('#toolbar-apply button').click(function(event){
		event.preventDefault();
		event.stopPropagation();

		jQuery('#jform_pagecontent').val( encodeURIComponent(JSON.stringify(genPageContentShortcodes())) );

		jQuery('#adminForm input[name="task"]').val('page.apply');
		jQuery('#adminForm').submit();
	});

    jQuery('#toolbar-apply button').attr('onclick','');

    jQuery('#toolbar-save button').attr('onclick','');

    jQuery('#toolbar-save-new button').attr('onclick','');

    jQuery('#toolbar-save-copy button').attr('onclick','');


    jQuery('#toolbar-save button').click(function(event){
        event.preventDefault();
        event.stopPropagation();

        jQuery('#jform_pagecontent').val( encodeURIComponent(JSON.stringify(genPageContentShortcodes())) );

        jQuery('#adminForm input[name="task"]').val('page.save');
        jQuery('#adminForm').submit();
    });

    jQuery('#toolbar-save-new button').click(function(event){
        event.preventDefault();
        event.stopPropagation();

        jQuery('#jform_pagecontent').val( encodeURIComponent(JSON.stringify(genPageContentShortcodes())) );

        jQuery('#adminForm input[name="task"]').val('page.save2new');
        jQuery('#adminForm').submit();
    });

    jQuery('#toolbar-save-copy button').click(function(event){
        event.preventDefault();
        event.stopPropagation();

        jQuery('#jform_pagecontent').val( encodeURIComponent(JSON.stringify(genPageContentShortcodes())) );

        jQuery('#adminForm input[name="task"]').val('page.save2copy');
        jQuery('#adminForm').submit();
    });

});