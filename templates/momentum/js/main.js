/*

	Main.js

	01. Menu toggle
	02. Top bar height effect
	03. Home content slider
	04. Home background slider
	05. Home background and content slider
	06. Quote slider
	07. Image slider
	08. Services slider
	09. Employee slider
	10. Work slider
	11. Footer promo
	12. Contact form
	13. Scrollto
	14. Magnific popup
	15. Equal height
	16. fitVids

*/


(function(){
	"use strict";

	/* ==================== 01. Menu toggle ==================== */
	jQuery(function($){
		$('#toggle').click(function (e){
			e.stopPropagation();
		});
		$('html').click(function (e){
			if (!$('.toggle').is($(e.target))){
				$('#toggle').prop("checked", false);
			}
		});
	});

	/* ==================== 02. Top bar height effect ==================== */
	jQuery(window).bind("scroll", function() {
		if (jQuery(this).scrollTop() > 100) {
			jQuery(".top-bar").removeClass("tb-large").addClass("tb-small");
		} else {
			jQuery(".top-bar").removeClass("tb-small").addClass("tb-large");
		}
	});

	/* ==================== 03. Home content slider ==================== */
	jQuery('.home-c-slider').each(function(){
		var c_sl = jQuery(this);
    	var optionsData = c_sl.data('options') ? JSON.parse(decodeURIComponent(c_sl.data('options'))) : {speed:500,auto:false,mode:'horizontal',pager:false,controls:true};
		c_sl.bxSlider({
			mode: optionsData.mode,
			pager: optionsData.pager,
			controls: optionsData.controls,
			nextText: '<i class="bs-right fa fa-angle-right"></i>',
			prevText: '<i class="bs-left fa fa-angle-left"></i>',
			speed: optionsData.speed,
        	auto  : optionsData.auto,
		});
	});
	// jQuery('.home-c-slider').bxSlider({
	// 	mode: 'horizontal',
	// 	pager: false,
	// 	controls: true,
	// 	nextText: '<i class="bs-right fa fa-angle-right"></i>',
	// 	prevText: '<i class="bs-left fa fa-angle-left"></i>'
	// });

	// /* ==================== 04. Home background slider ==================== */
	jQuery('.home-bg-slider').each(function(){
		var bg_sl = jQuery(this);
    	var optionsData = bg_sl.data('options') ? JSON.parse(decodeURIComponent(bg_sl.data('options'))) : {speed:1000,auto:true,mode:'fade',pager:false,controls:false};
		bg_sl.bxSlider({
			mode: optionsData.mode,
			pager: optionsData.pager,
			controls: optionsData.controls,
			nextText: '<i class="bs-right fa fa-angle-right"></i>',
			prevText: '<i class="bs-left fa fa-angle-left"></i>',
			speed: optionsData.speed,
        	auto  : optionsData.auto,
		});
	});
	// jQuery('.home-bg-slider').bxSlider({
	// 	mode: 'fade',
	// 	auto: true,
	// 	speed: 1000,
	// 	pager: false,
	// 	controls: false,
	// 	nextText: '<i class="bs-right fa fa-angle-right"></i>',
	// 	prevText: '<i class="bs-left fa fa-angle-left"></i>'
	// });

	/* ==================== 05. Home background and content slider ==================== */
	jQuery('.home-bgc-slider').each(function(){
		var bgc_sl = jQuery(this);
    	var optionsData = bgc_sl.data('options') ? JSON.parse(decodeURIComponent(bgc_sl.data('options'))) : {speed:500,auto:false,mode:'fade',pager:true,controls:true};
		bgc_sl.bxSlider({
			mode: optionsData.mode,
			pager: optionsData.pager,
			controls: optionsData.controls,
			nextText: '<i class="bs-right fa fa-angle-right"></i>',
			prevText: '<i class="bs-left fa fa-angle-left"></i>',
			speed: optionsData.speed,
        	auto  : optionsData.auto,
		});
	});

	// jQuery('.home-bgc-slider').bxSlider({
	// 	mode: 'fade',
	// 	pager: true,
	// 	controls: true,
	// 	nextText: '<i class="bs-right fa fa-angle-right"></i>',
	// 	prevText: '<i class="bs-left fa fa-angle-left"></i>'
	// });

	// /* ==================== 06. Quote slider ==================== */
	// jQuery('.quote-slider').bxSlider({
	// 	mode: 'horizontal',
	// 	controls: false,
	// 	adaptiveHeight: true
	// });

	/* ==================== 07. Image slider ==================== */
	jQuery('.img-slider').bxSlider({
		mode: 'fade',
		pager: false,
		controls: true,
		nextText: '<i class="bs-right fa fa-angle-right"></i>',
		prevText: '<i class="bs-left fa fa-angle-left"></i>'
	});

	jQuery(function($) {
		/* ==================== 08. Services slider ==================== */
    	$(".services-slider").each(function(){
    		var owl_sl = $(this);
    		var optionsData = owl_sl.data('options') ? JSON.parse(decodeURIComponent(owl_sl.data('options'))) : {slidespeed:200,items:4,singleitem:false,autoplay:false};
    		owl_sl.owlCarousel({
				pagination: false,
				navigation: false,
				items: optionsData.items,
				itemsDesktop: [1000,3],
				itemsTablet: [600,2],
				itemsMobile: [321,1],
				slideSpeed: optionsData.slidespeed,
        		singleItem: optionsData.singleitem,
        		autoPlay  : optionsData.autoplay,
			});
			// Custom navigation
			owl_sl.closest('.services-slider-wrap').children(".serv-next").click(function(){
				owl_sl.trigger('owl.next');
			})
			owl_sl.closest('.services-slider-wrap').children(".serv-prev").click(function(){
				owl_sl.trigger('owl.prev');
			})

    	});

    	/* ==================== 09. Employee slider ==================== */
	 	$(".employee-slider").each(function(){
    		var em_sl = $(this);
    		var optionsData = em_sl.data('options') ? JSON.parse(decodeURIComponent(em_sl.data('options'))) : {slidespeed:200,items:4,singleitem:false,autoplay:false};
    		em_sl.owlCarousel({
				pagination: false,
				navigation: false,
				items: optionsData.items,
				itemsDesktop: [1000,3],
				itemsTablet: [600,2],
				itemsMobile: [321,1],
				slideSpeed: optionsData.slidespeed,
        		singleItem: optionsData.singleitem,
        		autoPlay  : optionsData.autoplay,
			});
			// Custom navigation
			em_sl.closest('.employee-slider-wrap').find(".emp-next").click(function(){
				em_sl.trigger('owl.next');
			})
			em_sl.closest('.employee-slider-wrap').find(".emp-prev").click(function(){
				em_sl.trigger('owl.prev');
			})

    	});

	 	/* ==================== 10. Work slider ==================== */
    	$(".work-slider").each(function(){
    		var w_sl = $(this);
    		var optionsData = w_sl.data('options') ? JSON.parse(decodeURIComponent(w_sl.data('options'))) : {slidespeed:200,items:3,singleitem:false,autoplay:false};
    		//console.log(optionsData);
    		w_sl.owlCarousel({
				pagination: false,
				navigation: false,
				items: optionsData.items,
				itemsDesktop: [1000,3],
				itemsTablet: [600,2],
				itemsMobile: [321,1],
				slideSpeed: optionsData.slidespeed,
        		singleItem: optionsData.singleitem,
        		autoPlay  : optionsData.autoplay,
			});
			// Custom navigation
			w_sl.closest('.work-slider-wrap').children(".work-next").click(function(){
				w_sl.trigger('owl.next');
			})
			w_sl.closest('.work-slider-wrap').children(".work-prev").click(function(){
				w_sl.trigger('owl.prev');
			})

    	});
		
	 
	});

	
	/* ==================== 11. Footer promo ==================== */
	jQuery('.promo-control').click(function () {
		jQuery('.footer-promo').slideToggle(500);
		if(jQuery('.footer-promo').is(':visible')){
			jQuery('html, body').animate({
				scrollTop: jQuery('.footer-promo').offset().top
			}, 500);
		}
	});

	/* ==================== 13. Scrollto ==================== */
	jQuery(function($){
		$('.scrollto').bind('click.scrollto',function (e){
			e.preventDefault();

			var target = this.hash,
			$target = $(target);

			$('html, body').stop().animate({
				'scrollTop': $target.offset().top-0
			}, 900, 'swing', function () {
				window.location.hash = target;
			});
		});
	});

	/* ==================== 14. Magnific popup ==================== */
	// Image popup
	jQuery('.popup').magnificPopup({ 
		type: 'image',
		fixedContentPos: false,
		fixedBgPos: false,
		removalDelay: 300,
		mainClass: 'mfp-fade'
	});

	// YouTube, Vimeo and Google Maps popup
	jQuery('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		fixedContentPos: false,
		fixedBgPos: false,
		removalDelay: 300,
		mainClass: 'mfp-fade',
		preloader: false
	});

	// Soundcloud
	jQuery('.popup-soundcloud').magnificPopup({
	  type: 'iframe',
	  iframe: {
	    patterns: {
	      soundcloud: {
	       
	        index: 'soundcloud.com',
	        
	        id: function(url) {        
	            var m = url.match(/^.+soundcloud.com\/tracks\/([^_&]+)?/);
	            if (m !== null) {
	                if(m[1] !== undefined) {
	                  
	                    return m[1];
	                }
	            }
	            return null;
	        },
	        
	        src: 'https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/%id%&amp;auto_play=false&amp;hide_related=false&amp;visual=true'
	        
	      }
	    }
	  },
	  fixedContentPos: false,
	  fixedBgPos: false,
	  removalDelay: 300,
	  mainClass: 'mfp-fade',
	  preloader: false
	  
	  
	});

	// Gallery popup
	jQuery('.popup-gallery').magnificPopup({
		type: 'image',
		gallery:{
			enabled:true
		},
		fixedContentPos: false,
		fixedBgPos: false,
		removalDelay: 300,
		mainClass: 'mfp-fade'
	});

	jQuery('.gallery-link').on('click', function () {
		jQuery(this).next().magnificPopup('open');
	});

	jQuery('.gallery').each(function () {
		jQuery(this).magnificPopup({
			delegate: 'a',
			type: 'image',
			gallery: {
				enabled: true,
				navigateByImgClick: true
			},
			fixedContentPos: false,
			fixedBgPos: false,
			removalDelay: 300,
			mainClass: 'mfp-fade'
		});
	});



	/* ==================== 15. Equal height ==================== */
	/* Use the .equal class on a row if you want the columns to be equal in height */
	jQuery('.equal').children('.col').equalizeHeight();
	jQuery( window ).resize( function() {
		jQuery( '.equal' ).children( '.col' ).equalizeHeight();
		setTimeout( function() {
			jQuery( '.equal' ).children( '.col' ).equalizeHeight();
		}, 100 );
		setTimeout( function() {
			jQuery( '.equal' ).children( '.col' ).equalizeHeight();
		}, 400 );
		setTimeout( function() {
			jQuery( '.equal' ).children( '.col' ).equalizeHeight();
		}, 1400 );
		setTimeout( function() {
			jQuery( '.equal' ).children( '.col' ).equalizeHeight();
		}, 2400 );
	});
	setTimeout( function() {
			jQuery( window ).trigger( 'resize scroll' );
	}, 1000 );
	setTimeout( function() {
			jQuery( window ).trigger( 'resize scroll' );
	}, 3000 );
	jQuery( window ).load( function() {
		jQuery( '.equal' ).children( '.col' ).equalizeHeight();
		jQuery( window ).trigger( 'resize scroll' );
		setTimeout( function() {
			jQuery( '.equal' ).children( '.col' ).equalizeHeight();
		}, 1000 );
		setTimeout( function() {
			jQuery( '.equal' ).children( '.col' ).equalizeHeight();
		}, 1300 );
	});

	/* ==================== 16. fitVids ==================== */
	jQuery(".responsive-video").fitVids();

	jQuery(".responsive-video").fitVids({ customSelector: "iframe[src^='https://w.soundcloud.com']"});


})(jQuery);