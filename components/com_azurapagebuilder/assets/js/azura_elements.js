var azura_js = function () {
    azura_articlesSlider();
    azura_Carousel();
    azura_prettyPhoto();
    azura_galleryGrid();
    azura_nivoSlider();
    azura_googleplus();
    azura_pinterest();
    azura_fitvids();
    azura_googleMap();
    azura_flickrFeed();
    azura_contactAJAX();
    //azura_loginAjax();
    azura_tweetSlider();
    // new in envor
    azura_flexslider();

    //azura_post_like();
};

jQuery(document).ready(function ($) {

   window.azura_js();

  


   // jQuery('.azura_tweet_slider').owlCarousel({
   //    navigation: true,
   //    pagination: false,
   //    items: 1,
   //    navigationText: false,
   //    autoPlay:3000,
   //    itemsDesktop : [1000,1], //5 items between 1000px and 901px
   //    itemsDesktopSmall : [900,1], // betweem 900px and 601px
   //    itemsTablet: [600,1], //2 items between 600 and 0
   //    transitionStyle : "goDown"
   // });

});

/* Azura Like Posts
 ---------------------------------------------------------- */

// if(typeof window['azura_post_like'] !== 'function'){
//   function azura_post_like(){
//       jQuery('body').on('click','.azura_like_page',function(event){
//     event.preventDefault();
//     var like = jQuery(this),
//     pageid = like.data('id');

//     jQuery.post(
//         window.azuraUrl,
//         {
//           id      :   pageid,
//           option  :   'com_azurapagebuilder',
//           task    :   'ajax.doLike',
//           opt    :   'com_azurapagebuilder',

//         },
//         function(data){
//           if(data.info == 'error'){
//             console.log(data);
//           }else{
//             //console.log(data);
//             if(data.msg == 'liked'){
//                 like.html('<i class="stand_icon icon-heart"></i> <span>'+data.like_count+'</span>');
//             }else{
//                 like.html('<i class="stand_icon icon-heart-o"></i> <span>'+data.like_count+'</span>');
//             }
//           }
            
//         },
        
//         'json'
//     );
//   });

//   jQuery('body').on('click','.k2_like_post',function(event){
//     event.preventDefault();
//     var like = jQuery(this),
//     pageid = like.data('id');

//     jQuery.post(
//         window.azuraUrl,
//         {
//           id      :   pageid,
//           option  :   'com_azurapagebuilder',
//           task    :   'ajax.doLike',
//           opt    :   'com_k2',

//         },
//         function(data){
//           if(data.info == 'error'){
//             console.log(data);
//           }else{
//             //console.log(data);
//             if(data.msg == 'liked'){
//                 like.html('<i class="stand_icon icon-heart"></i> <span>'+data.like_count+'</span>');
//             }else{
//                 like.html('<i class="stand_icon icon-heart-o"></i> <span>'+data.like_count+'</span>');
//             }
//           }
            
//         },
        
//         'json'
//     );
//   });
//   }
// }

/* Tweets Slider
 ---------------------------------------------------------- */

if(typeof window['azura_tweetSlider'] !== 'function'){
  function azura_tweetSlider(){
      jQuery('.azura_tweet_slider').each(function(index){
         var slider = jQuery(this);
         slider.owlCarousel({
            navigation: true,
            pagination: false,
            items: 1,
            navigationText: false,
            autoPlay:3000,
            itemsDesktop : [1000,1], //5 items between 1000px and 901px
            itemsDesktopSmall : [900,1], // betweem 900px and 601px
            itemsTablet: [600,1], //2 items between 600 and 0
            transitionStyle : "goDown"
         });   
      })
  }
}
if(typeof window['azura_loginAjax'] !== 'function'){
   function azura_loginAjax() {
      // Login
      //jQuery('.azura_ajaxlogin').each(function(){

         var $login = jQuery(".azura_ajaxlogin");
         console.log($login);
         
         $login.find('#azuraajaxloginform').submit(function(){

             alert('submited');

             // var action = jQuery(this).attr('action');
             // var username = $login.find('#username').val(),
             // password = $login.find('#password').val();

             // $login.find('#azuraajaxloginemessage').slideUp(300);

             // if(username === ''){
             //     $login.find('#azuraajaxloginemessage').html('Please enter your username');
             //     $login.find('#azuraajaxloginemessage').slideDown(300);
             //     $login.find('#username').focus();
             //     return false;
             // }
             // if(password === ''){
             //     $login.find('#azuraajaxloginemessage').html('Please enter your password');
             //     $login.find('#azuraajaxloginemessage').slideDown(300);
             //     $login.find('#password').focus();
             //     return false;
             // }

             // //$login.find("#azuraajaxloginemessage").slideUp(300,function() {

             //     $login.find('#azuraajaxloginemessage').hide();

             //     $login.find('#azuraajaxloginsubmit').attr('disabled','disabled');

             //     jQuery.post(
             //         action,

             //         $login.find('#azuraajaxloginform').serialize(),

             //         function(data){
                         
             //             $login.find('#azurasubscribemessage').html(data.msg);
             //             $login.find('#azurasubscribemessage').slideDown('slow');
             //             $login.find('#azuraajaxloginsubmit').removeAttr('disabled');

             //             if(data.info == 'success'){
             //                 $login.find('#azurasubscribemessage').addClass('success');
             //                 $login.find('#azuraajaxloginform').slideUp(300);
             //                 window.location = data.returnurl;
             //             }
             //         },
                     
             //         'json'
             //     );

             //});

             return false;

         }); 
     //});
   }
}

/* Contact
 ---------------------------------------------------------- */
if (typeof window['azura_contactAJAX'] !== 'function') {
   function azura_contactAJAX() {
        jQuery('.azura_contactform').each(function(index){
            var $contact = jQuery(this);
            
            $contact.find('#azuracontactform').submit(function(){
                var action = jQuery(this).attr('action');
                
                var name = $contact.find('#name').val();
                var email = $contact.find('#email').val();
                var message = $contact.find('#message').val();

                $contact.find('#azuramessage').slideUp(300);

                if(name == ''){
                    $contact.find('#azuramessage').html('Please enter your name');
                    $contact.find('#azuramessage').slideDown(300);
                    $contact.find('#name').focus();
                    return false;
                }

                if(email == ''){
                    $contact.find('#azuramessage').html('Please enter your email');
                    $contact.find('#azuramessage').slideDown(300);
                    $contact.find('#email').focus();
                    return false;
                }

                if(message == ''){
                    $contact.find('#azuramessage').html('Please enter your message');
                    $contact.find('#azuramessage').slideDown(300);
                    $contact.find('#message').focus();
                    return false;
                }

                $contact.find("#azuramessage").slideUp(300,function() {
                    $contact.find('#azuramessage').hide();
                    $contact.find('#azurasubmit')
                        .attr('disabled','disabled');
                    jQuery.post(
                        action,
                        $contact.find('#azuracontactform').serialize(),
                        function(data){
                            //console.log(data);
                            $contact.find('#azuramessage').html(data.msg);
                            $contact.find('#azuramessage').slideDown('slow');
                            $contact.find('#azurasubmit').removeAttr('disabled');
                            if(data.info == 'success'){
                                $contact.find('#azuramessage').addClass('success');
                                $contact.find('#azuracontactform').slideUp('slow');
                            }
                        },
                        
                        'json'
                    );

                });

                return false;

            });
        });
        // Subscribe
        jQuery('.azura_subscribeform').each(function(index){

            var $subscribe = jQuery(this);
            
            $subscribe.find('#azurasubscribeform').submit(function(){
                var action = jQuery(this).attr('action');
                var email = $subscribe.find('#subscribe_email').val();

                $subscribe.find('#azurasubscribemessage').slideUp(300);

                if(email == ''){
                    $subscribe.find('#azurasubscribemessage').html('Please enter your email');
                    $subscribe.find('#azurasubscribemessage').slideDown(300);
                    $subscribe.find('#subscribe_email').focus();
                    return false;
                }

                $subscribe.find("#azurasubscribemessage").slideUp(300,function() {

                    $subscribe.find('#azurasubscribemessage').hide();

                    $subscribe.find('#azurasubscribesubmit').attr('disabled','disabled');

                    jQuery.post(
                        action,

                        $subscribe.find('#azurasubscribeform').serialize(),

                        function(data){
                            
                            $subscribe.find('#azurasubscribemessage').html(data.msg);
                            $subscribe.find('#azurasubscribemessage').slideDown('slow');
                            $subscribe.find('#azurasubscribesubmit').removeAttr('disabled');
                            if(data.info == 'success'){
                                $subscribe.find('#azurasubscribemessage').addClass('success');
                                $subscribe.find('#subscribe_email').val('');
                            }
                        },
                        
                        'json'
                    );

                });

                return false;

            });
        });
        
    }
}


/* GoogleMap
 ---------------------------------------------------------- */
if (typeof window['azura_googleMap'] !== 'function') {
   function azura_googleMap() {
        jQuery('.azura_gmap').each(function(index){
            var $gmap = jQuery(this);
            var mapData = JSON.parse(decodeURIComponent($gmap.data('map')));


            $gmap.find('.azura_gmap_wrapper').height(mapData.gmapheight).gmap3({
                map:{
                    options:{
                        center:[mapData.gmaplat, mapData.gmaplog],
                        zoom:mapData.gmapzoom,
                        mapTypeId: google.maps.MapTypeId[mapData.gmaptypeid],
                        
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                        },
                        panControl: mapData.gmappancontrol,
                        zoomControl: mapData.gmapzoomcontrol,
                        mapTypeControl: mapData.gmaptypecontrol,
                        streetViewControl: mapData.gmapstreetviewcontrol,
                        scrollwheel: mapData.gmapscrollwheel,
                        navigationControl: true,
                        //new
                        //styles: [ {stylers: [ { "saturation":-100 }, { "lightness": 0 }, { "gamma": 2 }]},],
                        /*styles : [
                                    {
                                      stylers: [
                                        { hue: "#e14d43" },
                                        { saturation: -20 }
                                      ]
                                    },{
                                      featureType: "road",
                                      elementType: "geometry",
                                      stylers: [
                                        { color: "#ffffff" },
                                        { lightness: -20 },
                                        { visibility: "simplified" }
                                      ]
                                    },{
                                      featureType: "road",
                                      elementType: "labels",
                                      stylers: [
                                        { visibility: "on" }
                                      ]
                                    }
                                  ],*/
                        disableDefaultUI: true,
                    }
                },
                marker:{
                    latLng:[mapData.gmaplat, mapData.gmaplog],
                    //new
                    //options:{ icon: "templates/"+window.templateName+"/images/marker.png"}
                }
            });
        });
    }
}

/* FitVids
 ---------------------------------------------------------- */
if (typeof window['azura_fitvids'] !== 'function') {
   function azura_fitvids() {
      jQuery('.azura_video_fitvids').each(function(index){
          var video = jQuery(this);
          video.fitVids();
      });
   }
}

/* Articles Slider
 ---------------------------------------------------------- */
if (typeof window['azura_articlesSlider'] !== 'function') {
   function azura_articlesSlider() {
      jQuery('.azura_articlesslider').each(function(index){
         var articlesSlider = jQuery(this);
         if(articlesSlider.hasClass('azura_slider_flex_fade')){
            articlesSlider.find('.flexslider').flexslider({animation: "fade"});
         }else if(articlesSlider.hasClass('azura_slider_flex_slide')){
            articlesSlider.find('.flexslider').flexslider({animation: "slide"});
         }else if(articlesSlider.hasClass('azura_slider_nivo')){
            articlesSlider.find('.nivoSlider').nivoSlider();
         }
      });
   }
}

/* Image Carousel
 ---------------------------------------------------------- */
if (typeof window['azura_Carousel'] !== 'function') {
   function azura_Carousel() {
      jQuery('.azura_carousel').azuracarousel();
   }
}

if (typeof window['azura_prettyPhoto'] !== 'function') {
  function azura_prettyPhoto() {
    try {
      // just in case. maybe prettyphoto isnt loaded on this site
      jQuery('a.prettyphoto, .gallery-icon a[href*=".jpg"]').prettyPhoto({
        animationSpeed:'normal', /* fast/slow/normal */
        padding:15, /* padding for each side of the picture */
        opacity:0.7, /* Value betwee 0 and 1 */
        showTitle:true, /* true/false */
        allowresize:true, /* true/false */
        counter_separator_label:'/', /* The separator for the gallery counter 1 "of" 2 */
        //theme: 'light_square', /* light_rounded / dark_rounded / light_square / dark_square */
        hideflash:false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
        deeplinking:false, /* Allow prettyPhoto to update the url to enable deeplinking. */
        modal:false, /* If set to true, only the close button will close the window */
        callback:function () {
          var url = location.href;
          var hashtag = (url.indexOf('#!prettyPhoto')) ? true : false;
          if (hashtag) location.hash = "!";
        } /* Called when prettyPhoto is closed */,
        social_tools:''
      });

      jQuery('a[rel^="prettyPhoto"],a.azura_prettyPhoto').prettyPhoto({
        callback:function () {
          var url = location.href;
          var hashtag = (url.indexOf('#!prettyPhoto')) ? true : false;
          if (hashtag) location.hash = "!";
        } /* Called when prettyPhoto is closed */,
      });
      
    } catch (err) {
    }
  }
}

/* Gallery Grid
 ---------------------------------------------------------- */
if (typeof window['azura_galleryGrid'] !== 'function') {
   function azura_galleryGrid() {
      jQuery('.azura_gallery_grid').each(function(index){
         var gallery_grid = jQuery(this);
         if(gallery_grid.hasClass('azura_gallery_grid')){

            gallery_grid.find('.image_grid_wrap').isotope({
               itemSelector: '.isotope-item',
               //layoutMode: 'fitRows',

               masonry: {
                  columnWidth : '.grid-sizer',
               }
            });
         }
      });

      // var $container = jQuery('#articlesGrid_Wrap').isotope({
      //    itemSelector: '.articleWrapper',
      //    layoutMode: 'fitRows',

      // });

      // filter items on button click
      jQuery('body').on( 'click', '.azura_filter', function() {
          var filterValue = jQuery(this).attr('data-filter');
          jQuery(this).closest('.azuraFilterWrapper').find('.active').removeClass('active');
          jQuery(this).addClass('active');
          $container.isotope({ filter: filterValue });
      });

   }
}

/* Nivo Slider
 ---------------------------------------------------------- */
if (typeof window['azura_nivoSlider'] !== 'function') {
   function azura_nivoSlider() {
      jQuery('.azura_slider').each(function(index){
         var gallery_ele = jQuery(this);
         if(gallery_ele.hasClass('azura_slider_nivo')){
            gallery_ele.find('.nivoSlider').nivoSlider();
         }
      });
   }
}

/* Google plus
 ---------------------------------------------------------- */
if (typeof window['azura_googleplus'] !== 'function') {
  function azura_googleplus() {
    if (jQuery('.azura_googleplus').length > 0) {
      (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
      })();
    }
  }
}

/* Pinterest
 ---------------------------------------------------------- */
if (typeof window['azura_pinterest'] !== 'function') {
  function azura_pinterest() {
    if (jQuery('.azura_pinterest').length > 0) {
      (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'http://assets.pinterest.com/js/pinit.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
      })();
    }
  }
}


/* Flickr Feed
 ---------------------------------------------------------- */
if (typeof window['azura_flickrFeed'] !== 'function') {
   function azura_flickrFeed() {
        jQuery('.azura_flickr').each(function(index){
            var $flickr = jQuery(this);
            var flickrData = JSON.parse(decodeURIComponent($flickr.data('flickr')));

            //console.log(flickrData);
            if(flickrData.viewtype === 'grid'){
                jQuery("#"+flickrData.wrapperid).jflickrfeed({
                    limit: flickrData.count,
                    qstrings: {
                        id: flickrData.accountid,
                    },
                    itemTemplate: '<li>' + '<a href="{{image_b}}" ><img src="{{image_s}}" alt="{{title}}" /></a>' +'</li>'
                });
            }else if(flickrData.viewtype === 'colorbox'){
                jQuery("#"+flickrData.wrapperid).jflickrfeed({
                    limit: flickrData.count,
                    qstrings: {
                        id: flickrData.accountid
                    },
                    itemTemplate:
                    '<li>' +
                        '<a rel="colorbox" href="{{image}}" title="{{title}}">' +
                            '<img src="{{image_s}}" alt="{{title}}" />' +
                        '</a>' +
                    '</li>'
                }, function(data) {
                    jQuery("#"+flickrData.wrapperid+" a").colorbox();
                });
            }else if(flickrData.viewtype === 'cycle'){
                jQuery("#"+flickrData.wrapperid).jflickrfeed({
                    limit: flickrData.count,
                    qstrings: {
                        id: flickrData.accountid
                    },
                    itemTemplate: '<li><img src="{{image_b}}" alt="" /><div>{{title}}</div></li>'
                }, function(data) {
                    jQuery("#"+flickrData.wrapperid+" div").hide();
                    jQuery("#"+flickrData.wrapperid).cycle({
                        timeout: 5000
                    });
                    jQuery("#"+flickrData.wrapperid+" li").hover(function(){
                        $(this).children('div').show();
                    },function(){
                        $(this).children('div').hide();
                    });
                });
            }

            
        });
    }
}

/* Articles Slider
 ---------------------------------------------------------- */
if (typeof window['azura_flexslider'] !== 'function') {
    function azura_flexslider() {
        jQuery('.azura_flexslider').each(function(index){
            var $slider = jQuery(this);
            $slider.flexslider({
                animation: $slider.data('animation')? $slider.data('animation') : "fade",
                slideDirection: $slider.data('drection')? $slider.data('drection') : 'horizontal',
                slideshow: $slider.data('slideshow')? $slider.data('slideshow') : false,
                slideshowSpeed: $slider.data('slideshowspeed')? $slider.data('slideshowspeed') : 700,
                animationSpeed: $slider.data('animationspeed')? $slider.data('animationspeed') : 600,

            });
        });
    }
}





/*!
 * Bootstrap v3.3.1 (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

/*!
 * Generated using the Bootstrap Customizer (http://getbootstrap.com/customize/?id=b5657678fb21feedb71d)
 * Config saved to config.json and https://gist.github.com/b5657678fb21feedb71d
 */
if (typeof jQuery === 'undefined') {
  throw new Error('Bootstrap\'s JavaScript requires jQuery')
}
+function ($) {
  var version = $.fn.jquery.split(' ')[0].split('.')
  if ((version[0] < 2 && version[1] < 9) || (version[0] == 1 && version[1] == 9 && version[2] < 1)) {
    throw new Error('Bootstrap\'s JavaScript requires jQuery version 1.9.1 or higher')
  }
}(jQuery);

/* ========================================================================
 * Bootstrap: transition.js v3.3.1
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
  // ============================================================

  function transitionEnd() {
    var el = document.createElement('bootstrap')

    var transEndEventNames = {
      WebkitTransition : 'webkitTransitionEnd',
      MozTransition    : 'transitionend',
      OTransition      : 'oTransitionEnd otransitionend',
      transition       : 'transitionend'
    }

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return { end: transEndEventNames[name] }
      }
    }

    return false // explicit for ie8 (  ._.)
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.emulateTransitionEnd = function (duration) {
    var called = false
    var $el = this
    $(this).one('bsTransitionEnd', function () { called = true })
    var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
    setTimeout(callback, duration)
    return this
  }

  $(function () {
    $.support.transition = transitionEnd()

    if (!$.support.transition) return

    $.event.special.bsTransitionEnd = {
      bindType: $.support.transition.end,
      delegateType: $.support.transition.end,
      handle: function (e) {
        if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
      }
    }
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: alert.js v3.3.1
 * http://getbootstrap.com/javascript/#alerts
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // ALERT CLASS DEFINITION
  // ======================

  var dismiss = '[data-dismiss="azura_alert"]'
  var AzuraAlert   = function (el) {
    $(el).on('click', dismiss, this.close)
  }

  AzuraAlert.VERSION = '3.3.1'

  AzuraAlert.TRANSITION_DURATION = 150

  AzuraAlert.prototype.close = function (e) {
    var $this    = $(this)
    var selector = $this.attr('data-target')

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
    }

    var $parent = $(selector)

    if (e) e.preventDefault()

    if (!$parent.length) {
      $parent = $this.closest('.azura_alert')
    }

    $parent.trigger(e = $.Event('close.bs.azuraalert'))

    if (e.isDefaultPrevented()) return

    $parent.removeClass('in')

    function removeElement() {
      // detach from parent, fire event then clean up data
      $parent.detach().trigger('closed.bs.azuraalert').remove()
    }

    $.support.transition && $parent.hasClass('azura_fade') ?
      $parent
        .one('bsTransitionEnd', removeElement)
        .emulateTransitionEnd(AzuraAlert.TRANSITION_DURATION) :
      removeElement()
  }


  // ALERT PLUGIN DEFINITION
  // =======================

  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data('bs.azuraalert')

      if (!data) $this.data('bs.azuraalert', (data = new AzuraAlert(this)))
      if (typeof option == 'string') data[option].call($this)
    })
  }

  var old = $.fn.azuraalert

  $.fn.azuraalert             = Plugin
  $.fn.azuraalert.Constructor = AzuraAlert


  // ALERT NO CONFLICT
  // =================

  $.fn.azuraalert.noConflict = function () {
    $.fn.azuraalert = old
    return this
  }


  // ALERT DATA-API
  // ==============

  $(document).on('click.bs.azuraalert.data-api', dismiss, AzuraAlert.prototype.close)

}(jQuery);

/* ========================================================================
 * Bootstrap: carousel.js v3.3.1
 * http://getbootstrap.com/javascript/#carousel
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // CAROUSEL CLASS DEFINITION
  // =========================

  var AzuraCarousel = function (element, options) {
    this.$element    = $(element)
    this.$indicators = this.$element.find('.azura_carousel-indicators')
    this.options     = options
    this.paused      =
    this.sliding     =
    this.interval    =
    this.$active     =
    this.$items      = null

    this.options.keyboard && this.$element.on('keydown.bs.azuracarousel', $.proxy(this.keydown, this))

    this.options.pause == 'hover' && !('ontouchstart' in document.documentElement) && this.$element
      .on('mouseenter.bs.azuracarousel', $.proxy(this.pause, this))
      .on('mouseleave.bs.azuracarousel', $.proxy(this.cycle, this))
  }

  AzuraCarousel.VERSION  = '3.3.1'

  AzuraCarousel.TRANSITION_DURATION = 600

  AzuraCarousel.DEFAULTS = {
    interval: 5000,
    pause: 'hover',
    wrap: true,
    keyboard: true
  }

  AzuraCarousel.prototype.keydown = function (e) {
    if (/input|textarea/i.test(e.target.tagName)) return
    switch (e.which) {
      case 37: this.prev(); break
      case 39: this.next(); break
      default: return
    }

    e.preventDefault()
  }

  AzuraCarousel.prototype.cycle = function (e) {
    e || (this.paused = false)

    this.interval && clearInterval(this.interval)

    this.options.interval
      && !this.paused
      && (this.interval = setInterval($.proxy(this.next, this), this.options.interval))

    return this
  }

  AzuraCarousel.prototype.getItemIndex = function (item) {
    this.$items = item.parent().children('.item')
    return this.$items.index(item || this.$active)
  }

  AzuraCarousel.prototype.getItemForDirection = function (direction, active) {
    var delta = direction == 'prev' ? -1 : 1
    var activeIndex = this.getItemIndex(active)
    var itemIndex = (activeIndex + delta) % this.$items.length
    return this.$items.eq(itemIndex)
  }

  AzuraCarousel.prototype.to = function (pos) {
    var that        = this
    var activeIndex = this.getItemIndex(this.$active = this.$element.find('.item.active'))

    if (pos > (this.$items.length - 1) || pos < 0) return

    if (this.sliding)       return this.$element.one('slid.bs.azuracarousel', function () { that.to(pos) }) // yes, "slid"
    if (activeIndex == pos) return this.pause().cycle()

    return this.slide(pos > activeIndex ? 'next' : 'prev', this.$items.eq(pos))
  }

  AzuraCarousel.prototype.pause = function (e) {
    e || (this.paused = true)

    if (this.$element.find('.next, .prev').length && $.support.transition) {
      this.$element.trigger($.support.transition.end)
      this.cycle(true)
    }

    this.interval = clearInterval(this.interval)

    return this
  }

  AzuraCarousel.prototype.next = function () {
    if (this.sliding) return
    return this.slide('next')
  }

  AzuraCarousel.prototype.prev = function () {
    if (this.sliding) return
    return this.slide('prev')
  }

  AzuraCarousel.prototype.slide = function (type, next) {
    var $active   = this.$element.find('.item.active')
    var $next     = next || this.getItemForDirection(type, $active)
    var isCycling = this.interval
    var direction = type == 'next' ? 'left' : 'right'
    var fallback  = type == 'next' ? 'first' : 'last'
    var that      = this

    if (!$next.length) {
      if (!this.options.wrap) return
      $next = this.$element.find('.item')[fallback]()
    }

    if ($next.hasClass('active')) return (this.sliding = false)

    var relatedTarget = $next[0]
    var slideEvent = $.Event('slide.bs.azuracarousel', {
      relatedTarget: relatedTarget,
      direction: direction
    })
    this.$element.trigger(slideEvent)
    if (slideEvent.isDefaultPrevented()) return

    this.sliding = true

    isCycling && this.pause()

    if (this.$indicators.length) {
      this.$indicators.find('.active').removeClass('active')
      var $nextIndicator = $(this.$indicators.children()[this.getItemIndex($next)])
      $nextIndicator && $nextIndicator.addClass('active')
    }

    var slidEvent = $.Event('slid.bs.azuracarousel', { relatedTarget: relatedTarget, direction: direction }) // yes, "slid"
    if ($.support.transition && this.$element.hasClass('slide')) {
      $next.addClass(type)
      $next[0].offsetWidth // force reflow
      $active.addClass(direction)
      $next.addClass(direction)
      $active
        .one('bsTransitionEnd', function () {
          $next.removeClass([type, direction].join(' ')).addClass('active')
          $active.removeClass(['active', direction].join(' '))
          that.sliding = false
          setTimeout(function () {
            that.$element.trigger(slidEvent)
          }, 0)
        })
        .emulateTransitionEnd(AzuraCarousel.TRANSITION_DURATION)
    } else {
      $active.removeClass('active')
      $next.addClass('active')
      this.sliding = false
      this.$element.trigger(slidEvent)
    }

    isCycling && this.cycle()

    return this
  }


  // CAROUSEL PLUGIN DEFINITION
  // ==========================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.azuracarousel')
      var options = $.extend({}, AzuraCarousel.DEFAULTS, $this.data(), typeof option == 'object' && option)
      var action  = typeof option == 'string' ? option : options.slide

      if (!data) $this.data('bs.azuracarousel', (data = new AzuraCarousel(this, options)))
      if (typeof option == 'number') data.to(option)
      else if (action) data[action]()
      else if (options.interval) data.pause().cycle()
    })
  }

  var old = $.fn.azuracarousel

  $.fn.azuracarousel             = Plugin
  $.fn.azuracarousel.Constructor = AzuraCarousel


  // CAROUSEL NO CONFLICT
  // ====================

  $.fn.azuracarousel.noConflict = function () {
    $.fn.azuracarousel = old
    return this
  }


  // CAROUSEL DATA-API
  // =================

  var clickHandler = function (e) {
    var href
    var $this   = $(this)
    var $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) // strip for ie7
    if (!$target.hasClass('azura_carousel')) return
    var options = $.extend({}, $target.data(), $this.data())
    var slideIndex = $this.attr('data-slide-to')
    if (slideIndex) options.interval = false

    Plugin.call($target, options)

    if (slideIndex) {
      $target.data('bs.azuracarousel').to(slideIndex)
    }

    e.preventDefault()
  }

  $(document)
    .on('click.bs.azuracarousel.data-api', '[data-slide]', clickHandler)
    .on('click.bs.azuracarousel.data-api', '[data-slide-to]', clickHandler)

  $(window).on('load', function () {
    $('[data-ride="azura_carousel"]').each(function () {
      var $carousel = $(this)
      Plugin.call($carousel, $carousel.data())
    })
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: tab.js v3.3.1
 * http://getbootstrap.com/javascript/#tabs
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // TAB CLASS DEFINITION
  // ====================

  var AzuraTab = function (element) {
    this.element = $(element)
  }

  AzuraTab.VERSION = '3.3.1'

  AzuraTab.TRANSITION_DURATION = 150

  AzuraTab.prototype.show = function () {
    var $this    = this.element
    var $ul      = $this.closest('ul:not(.dropdown-menu)')
    var selector = $this.data('target')

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
    }

    if ($this.parent('li').hasClass('active')) return

    var $previous = $ul.find('.active:last a')
    var hideEvent = $.Event('hide.bs.azuratab', {
      relatedTarget: $this[0]
    })
    var showEvent = $.Event('show.bs.azuratab', {
      relatedTarget: $previous[0]
    })

    $previous.trigger(hideEvent)
    $this.trigger(showEvent)

    if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented()) return

    var $target = $(selector)

    this.activate($this.closest('li'), $ul)
    this.activate($target, $target.parent(), function () {
      $previous.trigger({
        type: 'hidden.bs.azuratab',
        relatedTarget: $this[0]
      })
      $this.trigger({
        type: 'shown.bs.azuratab',
        relatedTarget: $previous[0]
      })
    })
  }

  AzuraTab.prototype.activate = function (element, container, callback) {
    var $active    = container.find('> .active')
    var transition = callback
      && $.support.transition
      && (($active.length && $active.hasClass('fade')) || !!container.find('> .fade').length)

    function next() {
      $active
        .removeClass('active')
        .find('> .dropdown-menu > .active')
          .removeClass('active')
        .end()
        .find('[data-toggle="azura_tab"]')
          .attr('aria-expanded', false)

      element
        .addClass('active')
        .find('[data-toggle="azura_tab"]')
          .attr('aria-expanded', true)

      if (transition) {
        element[0].offsetWidth // reflow for transition
        element.addClass('in')
      } else {
        element.removeClass('fade')
      }

      if (element.parent('.dropdown-menu')) {
        element
          .closest('li.dropdown')
            .addClass('active')
          .end()
          .find('[data-toggle="azura_tab"]')
            .attr('aria-expanded', true)
      }

      callback && callback()
    }

    $active.length && transition ?
      $active
        .one('bsTransitionEnd', next)
        .emulateTransitionEnd(AzuraTab.TRANSITION_DURATION) :
      next()

    $active.removeClass('in')
  }


  // TAB PLUGIN DEFINITION
  // =====================

  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data('bs.azuratab')

      if (!data) $this.data('bs.azuratab', (data = new AzuraTab(this)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.azuratab

  $.fn.azuratab             = Plugin
  $.fn.azuratab.Constructor = AzuraTab


  // TAB NO CONFLICT
  // ===============

  $.fn.azuratab.noConflict = function () {
    $.fn.azuratab = old
    return this
  }


  // TAB DATA-API
  // ============

  var clickHandler = function (e) {
    e.preventDefault()
    Plugin.call($(this), 'show')
  }

  $(document)
    .on('click.bs.azuratab.data-api', '[data-toggle="azura_tab"]', clickHandler)
    .on('click.bs.azuratab.data-api', '[data-toggle="azura_pill"]', clickHandler)

}(jQuery);







