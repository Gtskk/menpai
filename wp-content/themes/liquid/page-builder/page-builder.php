<?php
if(class_exists('AQ_Page_Builder')) {

    define('AQPB_CUSTOM_DIR', get_template_directory() . '/page-builder/');
    define('AQPB_CUSTOM_URI', get_template_directory_uri() . '/page-builder/');

    require_once(AQPB_CUSTOM_DIR . 'functions/aqpb_config.php');
	require_once(AQPB_CUSTOM_DIR . 'functions/aqpb_functions.php');
   	
	//pagebuilder blocks
    require_once(AQPB_CUSTOM_DIR . 'blocks/aq-slider-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/aq-blog-block.php');
	require_once(AQPB_CUSTOM_DIR . 'blocks/aq-cats-masonry-block.php');

    //register the blocks
    aq_register_block('AQ_Slider_Block');
	aq_register_block('AQ_Blog_Block');
	aq_register_block('AQ_Cats_Masonry_Block');

	//custom admin css/js
	add_action('aq-page-builder-admin-enqueue', 'custom_admin_cssjs');
	function custom_admin_cssjs() {
		
		//CSS
		wp_dequeue_style('aqpb-blocks-css');
		wp_enqueue_style('aqpb-blocks-custom-css', AQPB_CUSTOM_URI . 'assets/css/aqpb_blocks_custom.css', 'all');
		wp_enqueue_style('chosen', THEME_URI . 'assets/admin/chosen/chosen.min.css', 'all');
		
		//JS
		wp_deregister_script('aqpb-js');
		wp_register_script('aqpb-js', AQPB_CUSTOM_URI . 'assets/js/aqpb-custom.js', array('jquery'), time(), true);
		wp_enqueue_script('chosen', THEME_URI . 'assets/admin/chosen/chosen.jquery.min.js', array('jquery'), time(), true);
		wp_enqueue_script('chosen-sortable', THEME_URI . 'assets/admin/chosen/chosen-sortable.js', array('jquery','chosen'), time(), true);
        
    }
	
   	/*add_action('aq-page-builder-view-enqueue', 'custom_block_css');
    function custom_block_css() {
        wp_register_style( 'custom-block-css',  AQPB_CUSTOM_URI . 'css/aqpb-custom-admin.css', array(), time(), 'all');
        wp_enqueue_style('custom-block-css');
    }*/
}
?>