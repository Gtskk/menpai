<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( is_child_theme() ) {
	$temp_obj = wp_get_theme();
	$themeInfo = wp_get_theme( $temp_obj['Template'] );
} else {
	$themeInfo = wp_get_theme();    
}

define( 'OPTIONS_FRAMEWORK_DIRECTORY', THEME_URI . 'framework/' );
define( 'OPTIONS_MENU_TITLE', '主题设置' );
define( 'OPTIONS_MENU_SLUG', 'options-framework');
define( 'OPTIONS_PAGE_TITLE', $themeInfo['Name']);
define( 'THEME_NAME', $themeInfo['Name']);
define( 'THEME_VERSION', $themeInfo['Version']);


function options_menu_filter( $menu ) {
	
	$menu['mode'] = 'menu';
	$menu['menu_title'] = OPTIONS_MENU_TITLE;
	$menu['menu_slug'] = OPTIONS_MENU_SLUG;
	$menu['page_title'] = OPTIONS_PAGE_TITLE;
	$menu['position'] = '61.7'; //reduced risk of conflict 

	return $menu;
}
add_filter( 'optionsframework_menu', 'options_menu_filter' );


// Don't load if optionsframework_init is already defined
if (is_admin() && ! function_exists( 'optionsframework_init' ) ) :

function optionsframework_init() {

	//  If user can't edit theme options, exit
	if ( ! current_user_can( 'edit_theme_options' ) )
		return;

	// Loads the required Options Framework classes.
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-framework.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-framework-admin.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-interface.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-media-uploader.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-sorter.php';
	require plugin_dir_path( __FILE__ ) . 'includes/class-options-sanitization.php';

	// Instantiate the main plugin class.
	$options_framework = new Options_Framework;
	$options_framework->init();

	// Instantiate the options page.
	$options_framework_admin = new Options_Framework_Admin;
	$options_framework_admin->init();

	// Instantiate the media uploader class
	$options_framework_media_uploader = new Options_Framework_Media_Uploader;
	$options_framework_media_uploader->init();
	
	// Instantiate the sorter ui class
	$options_framework_sorter = new Options_Framework_Sorter;
	$options_framework_sorter->init();

}

add_action( 'init', 'optionsframework_init', 20 );

endif;


/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */

if ( ! function_exists( 'of_get_option' ) ) :

function of_get_option( $name, $default = false ) {
	$config = get_option( 'optionsframework' );

	if ( ! isset( $config['id'] ) ) {
		return $default;
	}

	$options = get_option( $config['id'] );

	if ( isset( $options[$name] ) ) {
		return $options[$name];
	}

	return $default;
}

endif;

//load custom styling
require_once plugin_dir_path( __FILE__ ) . 'custom.php';

//load custom CSS
require_once plugin_dir_path( __FILE__ ) . 'custom-css/css.php';
