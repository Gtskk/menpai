/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {

	// Chosen select
	$(".chosen-select").chosen();
	
	// Skin
	$('.section-skin span.of-radio-skin-img').click(function(){
		var p = $(this).parents('.section-skin');
		var color = $(this).data('color');
		var bgcolor = $(this).data('bgcolor');
		var bgimg = $(this).data('bgimg');

		$('.of-radio-skin-img',p).removeClass('of-radio-skin-selected');
		$(this).addClass('of-radio-skin-selected');
		
		// Set values (Primary|BgColor|BgPattern)
		$('#section-primary_color .wp-color-result').css('background-color', '#' + color);
		$('#section-primary_color .of-color').val('#' + color);
		
		$('#section-bg_color .wp-color-result').css('background-color', '#' + bgcolor);
		$('#section-bg_color .of-color').val('#' + bgcolor);
		
		$('#section-bg_pattern').find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$('#tile-'+bgimg).trigger( "click" );
		
	});
	$('.of-radio-skin').hide();
	
	// Tile
	$('.section-tile span.of-radio-tile-img').click(function(){
		var p = $(this).parents('.section-tile');

		$('.of-radio-tile-img',p).removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');

	});
	$('.of-radio-tile').hide();
	
	// Loads the color pickers
	$('.of-color').wpColorPicker();

	// Image Options
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});

	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	// Loads tabbed sections if they exist
	if ( $('.nav-tab-wrapper').length > 0 ) {
		options_framework_tabs();
	}

	function options_framework_tabs() {

		var $group = $('.group'),
			$navtabs = $('.nav-tab-wrapper a'),
			active_tab = '';

		// Hides all the .group sections to start
		$group.hide();

		// Find if a selected tab is saved in localStorage
		if ( typeof(localStorage) != 'undefined' ) {
			active_tab = localStorage.getItem('active_tab');
		}

		// If active tab is saved and exists, load it's .group
		if ( active_tab != '' && $(active_tab).length ) {
			$(active_tab).fadeIn();
			$(active_tab + '-tab').addClass('nav-tab-active').append('<span class="tab-arrow" />');
		} else {
			$('.group:first').fadeIn();
			$('.nav-tab-wrapper a:first').addClass('nav-tab-active').append('<span class="tab-arrow" />');
		}

		// Bind tabs clicks
		$navtabs.click(function(e) {

			e.preventDefault();

			// Remove active class from all tabs
			$navtabs.removeClass('nav-tab-active').find('.tab-arrow').remove();

			$(this).addClass('nav-tab-active').append('<span class="tab-arrow" />').blur();

			if (typeof(localStorage) != 'undefined' ) {
				localStorage.setItem('active_tab', $(this).attr('href') );
			}

			var selected = $(this).attr('href');

			$group.hide();
			$(selected).fadeIn();

		});
	}
	
	/**
	* Google Fonts
	* Dependencies 	 : google.com, jquery
	* Feature added by : Smartik - http://smartik.ws/
	* Date 			 : 03.17.2013
	*/
	function GoogleFontSelect( slctr, mainID ){
		
		var _selected = $(slctr).val(); 						//get current value - selected and saved
		var _linkclass = 'style_link_'+ mainID;
		var _previewer = mainID +'_ggf_previewer';
		
		if( _selected ){ //if var exists and isset
			
			//Check if selected is not equal with "Select a font" and execute the script.
			if ( _selected !== 'none' && _selected !== 'Select a font' ) {
				
				//remove other elements crested in <head>
				$( '.'+ _linkclass ).remove();
				
				//replace spaces with "+" sign
				var the_font = _selected.replace(/\s+/g, '+');
				
				//add reference to google font family
				$('head').append('<link href="http://fonts.googleapis.com/css?family='+ the_font +'" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');
				
				//show in the preview box the font
				$('.'+ _previewer ).css('font-family', _selected +', sans-serif' );
				
			}else{
				
				//if selected is not a font remove style "font-family" at preview box
				$('.'+ _previewer ).css('font-family', '' );
				
			}
		
		}
	
	}
	
	//init for each element
	$( '.google_font_select' ).each(function(){ 
		var mainID = $(this).attr('id');
		GoogleFontSelect( this, mainID );
	});
	
	//init when value is changed
	$( '.google_font_select' ).change(function(){ 
		var mainID = $(this).attr('id');
		GoogleFontSelect( this, mainID );
	});
	
	// Custom script
	jQuery('#custom_styling').click(function() {
  		jQuery('#section-example_skin, #section-primary_color, #section-bg_color, #section-bg_pattern, #section-custom_bg').slideToggle(400);
	});

	if (jQuery('#custom_styling:checked').val() !== undefined) {
		jQuery('#section-example_skin, #section-primary_color, #section-bg_color, #section-bg_pattern, #section-custom_bg').show();
	}
	
});