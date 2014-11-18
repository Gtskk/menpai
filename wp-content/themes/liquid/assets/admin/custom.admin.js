jQuery(document).ready(function($){
	var 
		audioOptions = $('#audio_options'), audioTrigger = $('#post-format-audio'),
    	videoOptions = $('#video_options'), videoTrigger = $('#post-format-video'),
    	galleryOptions = $('#gallery_options'), galleryTrigger = $('#post-format-gallery'),
    	linkOptions = $('#link_options'), linkTrigger = $('#post-format-link'),
    	quoteOptions = $('#quote_options'), quoteTrigger = $('#post-format-quote'),
		lightboxOptions = $('#lightbox_options'), lightboxTrigger = $('#post-format-0'),
    	flist = $('#post-formats-select input');
	
	HideMetabox(null);
	
	flist.change( function() {
		$this = $(this);
        HideMetabox(null);
		
		if( $this.val() == 'audio' ) {
			audioOptions.css('display', 'block');
		} else if( $this.val() == 'video' ) {
			videoOptions.css('display', 'block');
			lightboxOptions.css('display', 'block');
		} else if( $this.val() == 'gallery' ) {
		    galleryOptions.css('display', 'block');
		} else if( $this.val() == 'link' ) {
		    linkOptions.css('display', 'block');
		} else if( $this.val() == 'quote' ) {
		    quoteOptions.css('display', 'block');
		} else if( $this.val() == '0') {
		    lightboxOptions.css('display', 'block');
		}

	});
	
	if(lightboxTrigger.is(':checked')) lightboxOptions.css('display', 'block');
	if(audioTrigger.is(':checked')) audioOptions.css('display', 'block');
	if(videoTrigger.is(':checked')) {
		videoOptions.css('display', 'block');
		lightboxOptions.css('display', 'block');
	}
    if(galleryTrigger.is(':checked')) galleryOptions.css('display', 'block');
    if(linkTrigger.is(':checked')) linkOptions.css('display', 'block');
    if(quoteTrigger.is(':checked')) quoteOptions.css('display', 'block');
	if(lightboxOptions.is(':checked')) lightboxOptions.css('display', 'block');
		
	function HideMetabox(notThisOne) {
		videoOptions.css('display', 'none');
		audioOptions.css('display', 'none');
		galleryOptions.css('display', 'none');
		linkOptions.css('display', 'none');
		quoteOptions.css('display', 'none');
		lightboxOptions.css('display', 'none');
    }
	
	// For sidebars
	var $sbwrap = $('#tu_sidebar').closest('.rwmb-select-wrapper');
	$sbwrap.hide();
	$('#tu_post_layout').change( function() {
		$this = $(this);
		if($this.val()!='no_sidebar'){
			$sbwrap.slideDown(400);	
		}else{
			$sbwrap.slideUp(400);
		}
	});
	
	$layout_val = $("#tu_post_layout option:selected").val();
	if($layout_val!='no_sidebar') $sbwrap.show();	
	else $sbwrap.hide();
});