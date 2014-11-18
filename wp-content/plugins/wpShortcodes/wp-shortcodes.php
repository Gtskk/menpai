<?php
/*
Plugin Name: WP Shortcodes by PressLayer
Plugin URI: http://presslayer.com/wpshortcodes
Description: A simple shortcodes plugin for WordPress
Author: PressLayer
Author URI: http://presslayer.com
Version: 1.0
License: GNU General Public License version 2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if( is_admin() ) {
	add_action( 'init', 'wps_shortcodes_buttons' );
	function wps_shortcodes_buttons() {
		add_action( "admin_head", "wps_shortcodes_add_button" );
		add_action( 'admin_enqueue_scripts', 'wps_shortcodes_ed_css' );
	}
	
	function wps_shortcodes_add_button() {
		// check user permissions
		if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}
		// check if WYSIWYG is enabled
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', 'wps_shortcodes_ed_plugin' );
			add_filter( 'mce_buttons', 'wps_shortcodes_register_buttons' );
		}
	}
	
	function wps_shortcodes_ed_plugin( $plugin_array ) {
		$plugin_array['wps_shortcodes_ed_button'] = plugins_url( '/tinymce/wps_shortcodes_plugin.js', __FILE__ );
		return $plugin_array;
	}
	
	function wps_shortcodes_register_buttons( $buttons ) {
		array_push( $buttons, 'wps_shortcodes_ed_button' );
		return $buttons;
	}
	
	function wps_shortcodes_ed_css() {
		wp_enqueue_style('wps_shortcodes_ed_css', plugins_url('/tinymce/wps_shortcodes_admin.css', __FILE__) );
	}

} else {	
	include_once( dirname(__FILE__) . '/inc/shortcodes.php');
	add_action('wp_enqueue_scripts','wps_shortcode_script');	
	function wps_shortcode_script(){
		//CSS
		wp_enqueue_style('jquery-ui-delta', plugins_url('/assets/delta/jquery-ui.css', __FILE__) );
		wp_enqueue_style('wps_shortcodes', plugins_url('/assets/css/wps_shortcodes.css', __FILE__) );
		
		//JS
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('wps_shortcodes', plugins_url('/assets/js/wps_shortcodes.js', __FILE__), array('jquery'), false, true);
		wp_register_script('wps_googlemap', plugins_url('/assets/js/wps_googlemap.js', __FILE__), array('jquery'), false, true );
		wp_register_script('wps_googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), false, true );
	}
}
?>