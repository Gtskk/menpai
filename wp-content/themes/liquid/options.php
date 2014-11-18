<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'presslayer'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Skin data
	$skin_array = array(
		'magenta' => array('color'=>'FF0094', 'bgcolor'=>'eeeeee','bgimg'=>'bg00'),
		'purple'  => array('color'=>'A500FF', 'bgcolor'=>'eeeeee','bgimg'=>'bg01'),
		'teal'    => array('color'=>'00AAAD', 'bgcolor'=>'eeeeee','bgimg'=>'bg02'),
		'lime'    => array('color'=>'8CBE29', 'bgcolor'=>'eeeeee','bgimg'=>'bg03'),
		'brown'   => array('color'=>'9C5100', 'bgcolor'=>'eeeeee','bgimg'=>'bg04'),
		'pink'    => array('color'=>'E671B5', 'bgcolor'=>'eeeeee','bgimg'=>'bg05'),
		'orange'  => array('color'=>'f8a82a', 'bgcolor'=>'eeeeee','bgimg'=>'bg06'),
		'blue'    => array('color'=>'19A2DE', 'bgcolor'=>'eeeeee','bgimg'=>'bg07'),
		'red'     => array('color'=>'E61400', 'bgcolor'=>'eeeeee','bgimg'=>'bg08'),
		'green'   => array('color'=>'319A31', 'bgcolor'=>'eeeeee','bgimg'=>'bg09')
	);
	
	//Background Images Reader
	$bg_images_path = THEME_DIR. 'assets/images/bg/'; // change this to where you store your bg images
	$bg_images_url = THEME_URI .'assets/images/bg/'; // change this to where you store your bg images
	$bg_images = array();
	
	if ( is_dir($bg_images_path) ) {
		if ($bg_images_dir = opendir($bg_images_path) ) { 
			while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
				if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
					$bg_images[] = $bg_images_url . $bg_images_file;
				}
			}    
		}
	}
		
	// Test data
	$test_array = array(
		'one' => __('One', 'presslayer'),
		'two' => __('Two', 'presslayer'),
		'three' => __('Three', 'presslayer'),
		'four' => __('Four', 'presslayer'),
		'five' => __('Five', 'presslayer')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'presslayer'),
		'two' => __('Pancake', 'presslayer'),
		'three' => __('Omelette', 'presslayer'),
		'four' => __('Crepe', 'presslayer'),
		'five' => __('Waffle', 'presslayer')
	);
	
	// Ads Hook array
	$ads_hook_array = array(
		'before_index_page' => __('Before Index Page','presslayer'),
		'after_index_page' => __('After Index Page','presslayer'),
		'before_post_content' => __('Before Post Content','presslayer'),
		'after_post_content' => __('After Post Content','presslayer'),
		'before_papge_content' => __('Before Papge Content','presslayer'),
		'after_papge_content' => __('After Papge Content','presslayer'),
		'archives' => __('Archives','presslayer')
	);
	
	// Google fonts
	$google_fonts = array(
		"none" => __('Default','presslayer'),//please, always use this key: "none"
		'Arial'=>'Arial',
		'Tahoma'=>'Tahoma',
		'Lucida Sans Unicode'=>'Lucida Sans Unicode',
		'Times New Roman'=>'Times New Roman',
		'Verdana'=>'Verdana', 
		'Courier New'=>'Courier New', 
		'Courier'=>'Courier', 
		'Georgia'=>'Georgia',
		'Geneva'=>'Geneva', 
		'Helvetica'=>'Helvetica',
		"Roboto Slab" => "Roboto Slab",
		"Lato" => "Lato",
		"Oswald" => "Oswald",
		"Open Sans" => "Open Sans",
		"Alegreya Sans SC" => "Alegreya Sans SC",
		"Roboto Condensed" => "Roboto Condensed",
		"Cousine" => "Cousine",
		"Prosto One" => "Prosto One",
		"Coda Caption" => "Coda Caption",
		"Droid Sans Mono" => "Droid Sans Mono",
		"Yesteryear" => "Yesteryear",
		"Arbutus Slab" => "Arbutus Slab",
		"Francois One" => "Francois One",
		"Michroma" => "Michroma",
		"Copse" => "Copse",
		"Ropa Sans" => "Ropa Sans",
		"Patua One" => "Patua One",
		"Belgrano" => "Belgrano",
		"Cookie" => "Cookie",
		"Kaushan Script" => "Kaushan Script",
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/framework/images/';

	$options = array();
	
	$options[] = array(
		'name' => __('General Settings', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-wrench');
	
	$options[] = array(
		'name' => __('Custom Logo', 'presslayer'),
		'desc' => __('Upload your custom logo.', 'presslayer'),
		'id'   => 'custom_logo',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Custom Mobile Logo', 'presslayer'),
		'desc' => __('Upload your custom logo for mobile screen.', 'presslayer'),
		'id'   => 'custom_mobile_logo',
		'type' => 'upload');	
	
	$options[] = array(
		'name' => __('Custom Favicon', 'presslayer'),
		'desc' => __('Upload your custom favicon.', 'presslayer'),
		'id'   => 'custom_favicon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Footer Widget', 'presslayer'),
		'desc' => __('Check this box to enable Footer Widget.', 'presslayer'),
		'id' => 'footer_widget',
		'std' => '1',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Tracking Code', 'presslayer'),
		'desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'presslayer'),
		'id' => 'tracking_code',
		'type' => 'textarea');		

	$options[] = array(
		'name' => __('Switcher', 'presslayer'),
		'desc' => __('Check this box to enable Switcher.', 'presslayer'),
		'id' => 'switcher',
		'std' => '0',
		'type' => 'checkbox');								
	
	$options[] = array(
		'name' => __('Navigation', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-exchange');

	$options[] = array(
		'name' => __('Navagation Label', 'presslayer'),
		'id' => 'nav_label',
		'std' => 'NAVIGATION',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Sticky Navagation', 'presslayer'),
		'desc' => __('Check this box to enable sticky navigation.', 'presslayer'),
		'id' => 'sticky_nav',
		'std' => '1',
		'type' => 'checkbox');	
	
	// Nav Social Icons
	$options[] = array(
		"name" 		=> "Navagation Icons",
		"desc" 		=> "Add the icons and order them.",
		"id" 		=> "nav_icons",
		"type" 		=> "sorter",
		"std" 		=> array( 
			array('title'=>'Facebook','icon'=>'fa fa-facebook','url'=>'#'),
			array('title'=>'Twitter','icon'=>'fa fa-twitter','url'=>'#'),
			array('title'=>'Google Plus','icon'=>'fa fa-google-plus','url'=>'#'),
			array('title'=>'Pinterest','icon'=>'fa fa-pinterest','url'=>'#'),
			array('title'=>'LinkedIn','icon'=>'fa fa-linkedin','url'=>'#'),
			array('title'=>'Youtube','icon'=>'fa fa-youtube','url'=>'#')),
		"support"	=> array('title','icon','url'));
	
	$options[] = array(
		'name' => __('Contact Page', 'presslayer'),
		'desc' => __('Select a page to link', 'presslayer'),
		'id' => 'contact_page',
		'type' => 'select',
		'options' => $options_pages);
	
	//Blog Settings
	$options[] = array(
		'name' => __('Blog Settings', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-wordpress');
	
	$options[] = array(
		'name' => "Blog Layout",
		'desc' => "Choose layout for default archive page (Categories, Tags, Single ..., ect).",
		'id' => "site_layout",
		'std' => "right_sidebar",
		'type' => "images",
		'options' => array(			
			'right_sidebar' => $imagepath . 'right_sidebar.png',
			'left_sidebar' => $imagepath . 'left_sidebar.png',
			'no_sidebar' => $imagepath . 'no_sidebar.png')
	);			

	$options[] = array(
		'name' => __('Excerpt Length', 'presslayer'),
		'desc' => __('If you selected to auto trim excerpts, how many words do you wish to show?', 'presslayer'),
		'id' => 'blog_entry_excerpt_trim',
		'std' => '35',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('Related Posts Box', 'presslayer'),
		'desc' => __('Check this box to enable Related Posts Box.', 'presslayer'),
		'id' => 'related_posts_box',
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('Next & Previous Posts', 'presslayer'),
		'desc' => __('Check this box to enable Next & Previous post links.', 'presslayer'),
		'id' => 'next_previous',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Like Button', 'presslayer'),
		'desc' => __('Check this box to enable like button for posts.', 'presslayer'),
		'id' => 'like_button',
		'std' => '1',
		'type' => 'checkbox');
	
	//Fonts
	$options[] = array(
		'name' => __('Font Settings', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-font');
		
	$options[] = array(
		'name' => "Heading Font",
		'desc' => __('Select heading (h1,h2,h3 ...) font for theme.', 'presslayer'),
		'id' => "heading_font",
		'std' => "Roboto Slab",
		'type' => "google_font",
		'preview' => array(
			'text' => 'Font preview', //this is the text from preview box
			'size' => '30px' //this is the text size from preview box
		),
		"options" 	=> $google_fonts
	);
	
	$options[] = array(
		'name' => __('Heading Font Custom', 'presslayer'),
		'desc' => __('You can type Google font name here to set heading font. It will replace selected font from previous dropdown list.', 'presslayer'),
		'id' => 'heading_font_custom',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Font Weight', 'presslayer'),
		'desc' => __('Select font weight heading.', 'presslayer'),
		'id' => 'heading_weight',
		'type' => 'select',
		'std' => 'normal',
		'options' => array('normal'=>__('Normal','presslayer'),'bold'=>__('Bold','presslayer'),'italic'=>__('Italic','presslayer')));
	
	//Custom sidebars
	$options[] = array(
		'name' => __('Styling Options', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-paint-brush');
	
	$options[] = array(
		'name' => __('Use Custom Styling', 'presslayer'),
		'desc' => __('Check this to use styling options in this page.', 'presslayer'),
		'id' => 'custom_styling',
		'std' => '1',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Predefined Skins', 'presslayer'),
		'desc' => __('Select a predefined skin then you can change everything that you want.', 'presslayer'),
		'id' => 'example_skin',
		'class' => 'hidden',
		'std' => 'orange',
		'type' => 'skin',
		'options' => $skin_array);
	
	$options[] = array(
		'name' => __('Primary Color', 'presslayer'),
		'desc' => __('No color selected by default.', 'presslayer'),
		'id' => 'primary_color',
		'class' => 'hidden',
		'std' => '#f8a82a',
		'type' => 'color' );
	
	$options[] = array(
		'name' => __('Background Color', 'presslayer'),
		'desc' => __('No color selected by default.', 'presslayer'),
		'id' => 'bg_color',
		'class' => 'hidden',
		'std' => '',
		'type' => 'color' );	

	$options[] = array( 
		"name" 		=> "Background Patterns",
		"desc" 		=> __('To add more patterns, you can copy them to <strong>assets/images/bg</strong>','presslayer'),
		"id" 		=> "bg_pattern",
		'class' => 'hidden',
		"std" 		=> $bg_images_url."bg00.png",
		"type" 		=> "tile",
		"options" 	=> $bg_images
	);

	//Custom sidebars
	$options[] = array(
		'name' => __('Custom Sidebars', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-bars');
	
	$options[] = array(
		"name" 		=> "Sidebars",
		"desc" 		=> sprintf( __( 'Add the sidebars and use them in <a href="%1$s" target="_blank">Widgets</a>', 'presslayer' ), admin_url().'widgets.php'),
		"id" 		=> "custom_sidebar",
		"type" 		=> "sorter",
		"std" 		=> array(array('title'=>'Page sidebar')),
		"support"	=> array('title'));											
						
	//Ads
	$options[] = array(
		'name' => __('Ads Management', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-bullhorn' );	
	
	$options[] = array(
		"name" 		=> "Site Ads Management",
		"desc" 		=> __('Unlimited Ads with drag and drop sortings. Choose Archive for hook if you want to store it and reuse later.', 'presslayer'),
		"id" 		=> "ads",
		"type" 		=> "sorter",
		"std" 		=> "",
		"hook"		=> $ads_hook_array,
		"hook_name" => __('Apply to','presslayer'),
		"support"	=> array('title','hook','content','autop'));		

	return $options;
}