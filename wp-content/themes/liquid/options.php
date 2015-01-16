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
		'name' => __('基本设置', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-wrench');
	
	$options[] = array(
		'name' => __('自定义logo', 'presslayer'),
		'desc' => __('上传你的logo', 'presslayer'),
		'id'   => 'custom_logo',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('自定义移动版logo', 'presslayer'),
		'desc' => __('上传你的移动版logo', 'presslayer'),
		'id'   => 'custom_mobile_logo',
		'type' => 'upload');	
	
	$options[] = array(
		'name' => __('自定义网站图标', 'presslayer'),
		'desc' => __('上传你的自定义网站图标', 'presslayer'),
		'id'   => 'custom_favicon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('底部小工具', 'presslayer'),
		'desc' => __('选中启动底部小工具', 'presslayer'),
		'id' => 'footer_widget',
		'std' => '1',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('统计代码', 'presslayer'),
		'desc' => __('将你的google或者其他统计代码粘贴到此处。', 'presslayer'),
		'id' => 'tracking_code',
		'type' => 'textarea');		

	$options[] = array(
		'name' => __('控制开关', 'presslayer'),
		'desc' => __('选中以启用控制开关', 'presslayer'),
		'id' => 'switcher',
		'std' => '0',
		'type' => 'checkbox');								
	
	$options[] = array(
		'name' => __('导航', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-exchange');

	$options[] = array(
		'name' => __('导航标签文字', 'presslayer'),
		'id' => 'nav_label',
		'std' => 'NAVIGATION',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('粘性导航', 'presslayer'),
		'desc' => __('选中以启用粘性导航', 'presslayer'),
		'id' => 'sticky_nav',
		'std' => '1',
		'type' => 'checkbox');	
	
	// Nav Social Icons
	$options[] = array(
		"name" 		=> "导航小图标",
		"desc" 		=> "添加小图标",
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
		'name' => __('联系页面', 'presslayer'),
		'desc' => __('选择一个页面', 'presslayer'),
		'id' => 'contact_page',
		'type' => 'select',
		'options' => $options_pages);
	
	//Blog Settings
	$options[] = array(
		'name' => __('博客设置', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-wordpress');
	
	$options[] = array(
		'name' => "博客布局",
		'desc' => "选择默认文档页面的布局.",
		'id' => "site_layout",
		'std' => "right_sidebar",
		'type' => "images",
		'options' => array(			
			'right_sidebar' => $imagepath . 'right_sidebar.png',
			'left_sidebar' => $imagepath . 'left_sidebar.png',
			'no_sidebar' => $imagepath . 'no_sidebar.png')
	);			

	$options[] = array(
		'name' => __('文章摘要长度', 'presslayer'),
		'desc' => __('自动过滤文章内容作为摘要的长度', 'presslayer'),
		'id' => 'blog_entry_excerpt_trim',
		'std' => '35',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('关联文章', 'presslayer'),
		'desc' => __('选中以启用关联文章', 'presslayer'),
		'id' => 'related_posts_box',
		'std' => '0',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => __('下一篇和上一篇文章', 'presslayer'),
		'desc' => __('选中以启用上一篇和下一篇导航', 'presslayer'),
		'id' => 'next_previous',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('喜欢按钮', 'presslayer'),
		'desc' => __('选中以启用文章喜欢按钮', 'presslayer'),
		'id' => 'like_button',
		'std' => '1',
		'type' => 'checkbox');
	
	//Fonts
	$options[] = array(
		'name' => __('字体设置', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-font');
		
	$options[] = array(
		'name' => "头部字体",
		'desc' => __('选择主题h1，h2等的字体', 'presslayer'),
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
		'name' => __('头部字体自定义', 'presslayer'),
		'desc' => __('选择一个字体', 'presslayer'),
		'id' => 'heading_font_custom',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('字体大小', 'presslayer'),
		'desc' => __('选择头部字体的大小', 'presslayer'),
		'id' => 'heading_weight',
		'type' => 'select',
		'std' => 'normal',
		'options' => array('normal'=>__('Normal','presslayer'),'bold'=>__('Bold','presslayer'),'italic'=>__('Italic','presslayer')));
	
	//Custom sidebars
	$options[] = array(
		'name' => __('样式选项', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-paint-brush');
	
	$options[] = array(
		'name' => __('使用自定义样式', 'presslayer'),
		'desc' => __('选中以启用自定义样式', 'presslayer'),
		'id' => 'custom_styling',
		'std' => '1',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('预定义皮肤', 'presslayer'),
		'desc' => __('选中以启用预定义皮肤', 'presslayer'),
		'id' => 'example_skin',
		'class' => 'hidden',
		'std' => 'orange',
		'type' => 'skin',
		'options' => $skin_array);
	
	$options[] = array(
		'name' => __('初始化颜色', 'presslayer'),
		'desc' => __('默认无颜色', 'presslayer'),
		'id' => 'primary_color',
		'class' => 'hidden',
		'std' => '#f8a82a',
		'type' => 'color' );
	
	$options[] = array(
		'name' => __('背景颜色', 'presslayer'),
		'desc' => __('默认无颜色', 'presslayer'),
		'id' => 'bg_color',
		'class' => 'hidden',
		'std' => '',
		'type' => 'color' );	

	$options[] = array( 
		"name" 		=> "背景图案",
		"desc" 		=> __('选择背景图案','presslayer'),
		"id" 		=> "bg_pattern",
		'class' => 'hidden',
		"std" 		=> $bg_images_url."bg00.png",
		"type" 		=> "tile",
		"options" 	=> $bg_images
	);

	//Custom sidebars
	$options[] = array(
		'name' => __('自定义侧边栏', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-bars');
	
	$options[] = array(
		"name" 		=> "侧边栏",
		"desc" 		=> sprintf( __( 'Add the sidebars and use them in <a href="%1$s" target="_blank">Widgets</a>', 'presslayer' ), admin_url().'widgets.php'),
		"id" 		=> "custom_sidebar",
		"type" 		=> "sorter",
		"std" 		=> array(array('title'=>'Page sidebar')),
		"support"	=> array('title'));											
						
	//Ads
	$options[] = array(
		'name' => __('广告管理', 'presslayer'),
		'type' => 'heading',
		'icon' => 'fa-bullhorn' );	
	
	$options[] = array(
		"name" 		=> "网站广告管理",
		"desc" 		=> __('无限制的广告添加和管理', 'presslayer'),
		"id" 		=> "ads",
		"type" 		=> "sorter",
		"std" 		=> "",
		"hook"		=> $ads_hook_array,
		"hook_name" => __('应用于','presslayer'),
		"support"	=> array('title','hook','content','autop'));		

	return $options;
}