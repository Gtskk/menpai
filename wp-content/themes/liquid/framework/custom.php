<?php
if(of_get_option('custom_styling')==1):

add_action('wp_head', 'custom_style');
function custom_style() {
	global $post;
	
	$color = array('magenta'=>'#FF0094','purple'=>'#7059ac','teal' => '#00AAAD','lime' => '#8CBE29','brown' => '#9C5100','pink' => '#E671B5','orange' => '#EF9608','blue' => '#19A2DE','red'=>'#E61400','green'=>'#319A31');
	
	echo '<style type="text/css" id="custom_css">';
	
	if(of_get_option('bg_pattern')!='') echo 'body{ background-image: url('.of_get_option('bg_pattern').')}';
	if(of_get_option('bg_color')!='') echo 'body{ background-color: '.of_get_option('bg_color').'}';
	
	// Custom page background 
	if(is_page() or is_single()){
		$backgrounds = wp_get_attachment_image_src( rwmb_meta( 'tu_page_bg') , 'full-size');
		$background = $backgrounds[0];
	
		if($background!='') {
			echo 'body.page-id-'.$post->ID.'{ background-image: url('.$background.'); background-position: '.rwmb_meta( 'tu_page_bg_align').'; background-repeat: '.rwmb_meta( 'tu_page_bg_repeat').'; background-attachment: '.rwmb_meta( 'tu_page_bg_attachment').';';
			if($bg_size!='none') echo 'background-size: '.rwmb_meta( 'tu_page_bg_size').'!important';
			echo '} /*page id: '.get_queried_object_id().'*/';
		}
	}
	
	//Primary color
	if(of_get_option('primary_color')!=''):
		echo '.navbar.navbar-main .navbar-btn .navbar-toggle, .sf-menu li:hover,.sf-menu li.sfHover,.flex-control-paging li a.flex-active, .entry-quote, button, input[type=submit], input[type=button], .prl-button, .widget_categories li a:hover,.widget_categories li.current-cat a,.widget_pages li a:hover,.widget_pages li.current_page_item a,.widget_meta li a:hover,.widget_archive li a:hover,.widget_nav_menu li a:hover,.widget_tag_cloud .tagcloud a:hover,.widget.social-widget a:hover, #cancel-comment-reply-link, .wp-pagenavi span.current, .prl-article-tags a:hover, .audioplayer-bar-played, .audioplayer-volume-adjust div div { background-color:'.of_get_option('primary_color').';}';
		
		echo 'a, .widget.twitter-widget a, .navbar-toggle, .prl-article-bottom a:hover, .tu_flex-caption h3 a, .flex-direction-nav a, .bypostauthor > .prl-comment > .prl-comment-body .prl-comment-title { color:'.of_get_option('primary_color').';}';
		echo 'h3.widget-title span, .flex-control-paging li a.flex-active, .flex-direction-nav a, .prl-overlay:hover .prl-overlay-area{ border-color:'.of_get_option('primary_color').';}';
	endif;
	
	echo '</style>';
}
endif;

add_action('wp_head', 'custom_font');
function custom_font() {
	global $head_font;
	echo '<style type="text/css" id="custom_css">';
		if($head_font!='none'):		
			echo 'h1,h2,h3,h4,h5,h6{font-family: "'.$head_font.'", Arial, Helvetica, sans-serif;}';
		endif;
		if(of_get_option('heading_weight')!='normal'){
			echo 'h1,h2,h3,h4,h5,h6{font-weight: '.of_get_option('heading_weight').'}';
		}
	echo '</style>';
}

$fonts = array('Arial','Tahoma','Lucida Sans Unicode','Times New Roman','Verdana','Courier New','Courier','Georgia','Geneva','Helvetica' );
if(of_get_option('heading_font_custom')!='') $head_font = of_get_option('heading_font_custom');
else $head_font = of_get_option('heading_font');

if($head_font!='none' && !in_array($head_font, $fonts)):
	array_push($fonts, $head_font);
	function add_google_font(){
		global $head_font;
		wp_enqueue_style(str_replace(' ','-',$head_font), get_template_directory_uri().'/assets/fonts/googlefont.css');
	}
	add_action('wp_enqueue_scripts','add_google_font');
endif;
?>