(function ($) {

	// Example skins
	$( "#predefined_skins a" ).each(function( index ) {
		$(this).css('background-color', '#' + $(this).data('primary_color'));  
	});
	$('#predefined_skins a').click(function(e) {
		e.preventDefault();									  
		$(this).parent().find('a').removeClass('selected');
		$(this).addClass('selected');
		
		var skin = $(this).attr('id');
		var primary_color = $(this).data('primary_color');
		var bgcolor = $(this).data('bgcolor');
		var pattern = $(this).data('pattern');
		
		//Change primary color input
		$('#primary_color').val('#' + primary_color);
		$('#primary_color').minicolors('value', primary_color);
		
		
		$('#custom_bg_color').val('#' + bgcolor);
		$('#custom_bg_color').minicolors('value', bgcolor);
		
		$('body').css('background-image', 'url(' + template + '/assets/images/bg/' + pattern + '.png)');
		$('#custom_bg_image').find("img.selected").removeClass('selected');
		$('#custom_bg_image').find("img[data-img='"+ pattern +"']").addClass('selected');
		
		return false;
	});
	
	// Primary color
	$('#primary_color').minicolors({
		change: function(hex, rgba) {
			$('#style_selector').remove();
			$('body').append('<style id="style_selector" type="text/css"> .navbar.navbar-main .navbar-btn .navbar-toggle, .sf-menu li:hover,.sf-menu li.sfHover,.flex-control-paging li a.flex-active, .entry-quote, button, input[type=submit], input[type=button], .prl-button, .widget_categories li a:hover,.widget_categories li.current-cat a,.widget_pages li a:hover,.widget_pages li.current_page_item a,.widget_meta li a:hover,.widget_archive li a:hover,.widget_nav_menu li a:hover,.widget_tag_cloud .tagcloud a:hover,.widget.social-widget a:hover, #cancel-comment-reply-link, .wp-pagenavi span.current, .audioplayer-bar-played, .audioplayer-volume-adjust div div{ background-color: '+hex+'} h3.widget-title span, .flex-control-paging li a.flex-active, .flex-direction-nav a, .prl-overlay:hover .prl-overlay-area {border-color:'+hex+'} a, .widget.twitter-widget a, .navbar-toggle, .prl-article-bottom a:hover, .tu_flex-caption h3 a, .flex-direction-nav a, .bypostauthor > .prl-comment > .prl-comment-body .prl-comment-title {color:'+hex+'} </style>');
			$('body').append('<style id="style_selector" type="text/css"></style>');
		}
	});
	
	// Background color
	$('#custom_bg_color').minicolors({
		change: function(hex, rgba) {
			$('body').css('background-color', hex);
		}
	});
	
	// Background pattern
	$( "#custom_bg_image img" ).each(function( index ) {
		var pattern =  $(this).data('img');									  
		$(this).css('background-image',  'url(' + template + '/assets/images/bg/'+ pattern +'.png)');  
	});
	
	$('#custom_bg_image img').click(function(e) {
		var pattern =  $(this).data('img');	
		e.preventDefault();
		$('body').css('background-image', 'url(' + template + '/assets/images/bg/' + pattern + '.png)');
		$(this).parent().find('img').removeClass('selected');
		$(this).addClass('selected');
	});
	
	// Reset
	$('#reset_style').click(function(e) {
		setTimeout('location.reload(true);', 0);
	});
	
	// Control panel
	$('#panel_control').click(function(){
										   
		if ( $(this).hasClass('control-open') ) {
			$('#pl_control_panel').css( { left: 0 });
			$(this).removeClass('control-open');
			$(this).addClass('control-close');
			
		} else {
			$('#pl_control_panel').css( { left: -302 });
			$(this).removeClass('control-close');
			$(this).addClass('control-open');
		}
		return false;
	});	

})(jQuery);