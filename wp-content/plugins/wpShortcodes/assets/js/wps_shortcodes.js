jQuery(document).ready(function($) {
	// Accordion
	$(".wps_accordiongroup").accordion({animate: {duration: 250}});
	
	// Tabs
	$(".wps_tabgroup").tabs();
	
	// Toggle
	$(".wps-toggle-title").on( 'click', function () {
		$(this).next('div').slideToggle(250);
		var $s = $(this).find('span');
		$s.toggleClass('ui-icon-plus ui-icon-minus');
	});
});
