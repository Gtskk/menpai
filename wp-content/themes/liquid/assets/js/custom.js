(function ($) {
	
	"use strict";
	
	//Audio
	$( 'audio' ).audioPlayer(); 
	
	// fitVids
	$("body").fitVids();
	
	// Scroll to top 
	$("#toTop").jTotop();
	
	//Placeholder
	$('input, textarea').placeholder();
	
	//Tooltips
	$('.navbar-social a, .social-widget a').tipsy({fade: true, gravity: 's' });
	
	

	// Navbar search
	$('.navbar .navbar-toggle-search').on('click', function(){
		$(this).siblings('.navbar-search-input').toggleClass('navbar-search-open');
		$(this).toggleClass('navbar-toggle-close');
		return false;
	});
	
	// Popup
	if($('.popup-link-video').length){
		$('.popup-link-video').magnificPopup({type:'iframe'});
	}
	
	if($('.popup-link-image').length){
		$('.popup-link-image').magnificPopup({
			type: 'image',
			fixedContentPos: true,
			mainClass: 'mfp-no-margins mfp-with-zoom', 
			image: {
			verticalFit: true
			},
			zoom: {
				enabled: true,
				duration: 300
			},
			gallery:{
				enabled:true
			}
		});
	}
	
	//Flexslider
	$('.small-flexslider').flexslider({
		selector: ".tu_slides > li", 
		animation: "fade",
		//smoothHeight: true,
		controlNav: false,
		directionNav: true,
		slideshow: true,				
	});
	//Nav
	$('#main-nav').superfish({
		delay:       100,
		animation:   {opacity:'show',height:'show'}
	});
	
})(jQuery);