<?php
if ( ! isset( $content_width ) ) $content_width = 1020;
define( 'THEME_DIR', get_template_directory() .'/' );
define( 'THEME_URI', get_template_directory_uri() .'/' );

if ( !function_exists( 'presslayer_theme_setup' ) ) {
    function presslayer_theme_setup() {
		
		// Allow shortcodes in widgets	 
		add_filter('widget_text', 'do_shortcode');
		
		// Localization
		load_theme_textdomain('presslayer', get_template_directory() . '/languages/');

		// Menu
		register_nav_menu('main_nav', 'Navigation'); 
		register_nav_menu('mobile_nav', 'MobileNav'); 
		
		// Add post thumbnail
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size( 60, 60, true ); // Normal post thumbnails
		add_image_size( 'blog-large', 660 ); // (no crop)
		add_image_size( 'blog-index-gallery', 660, 400, true); // (cropped)
		add_image_size( 'post-thumb-rel', 210, 140, true ); // (cropped) - related posts
		
		// Add post format
		add_theme_support( 'post-formats', array( 'aside','audio','image','gallery','link','quote','video'));
		
		// Auto feed link
		add_theme_support( 'automatic-feed-links' );
		
		// Add custom background
		add_theme_support( 'custom-background' );
	
	}
}
add_action( 'after_setup_theme', 'presslayer_theme_setup' );
	
// Register Sidebars
if ( !function_exists( 'presslayer_sidebars_init' ) ) {
	function presslayer_sidebars_init() {
		register_sidebar(array(
			'name' => 'Default Sidebar',
			'id' => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget w-box %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title"><span>',
			'after_title' => '</span></h3>',
		));
		
		$sbs  = of_get_option('custom_sidebar');
		if($sbs and is_array($sbs)){
			foreach($sbs as $sidebar){
				register_sidebar(array(
					'name' => $sidebar['title'],
					'id' => tuSidebar($sidebar['title']),
					'before_widget' => '<div id="%1$s" class="widget w-box %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3 class="widget-title"><span>',
					'after_title' => '</span></h3>',
				));
				$tu_sidebars[tuSidebar($sidebar['title'])] = $sidebar['title'];	
			}
		}
		
		if(of_get_option('footer_widget')==true):
			for($i=1;$i<=3;$i++){
				register_sidebar(array(
					'name' => 'Footer Sidebar #'.$i,
					'id' => 'footer_'.$i,
					'before_widget' => '<div id="%1$s" class="widget w-box %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3 class="widget-title"><span>',
					'after_title' => '</span></h3>',
				));
			}
		endif;	
	}	
}
add_action( 'widgets_init', 'presslayer_sidebars_init' );

// Configure Default Title
if ( !function_exists( 'presslayer_wp_title' ) ) {
	function presslayer_wp_title($title, $sep) {
		global $page, $paged;
		
		$title .= get_bloginfo( 'name' );
		$site_desc = get_bloginfo( 'description', 'display' );
		if( $site_desc && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_desc";
		if ( $paged >= 2 || $page >= 2 )
			$title .= ' | ' . sprintf( __( 'Page %s', 'presslayer' ), max( $paged, $page ) );
		return $title;
	}
}
add_filter('wp_title', 'presslayer_wp_title', 10, 2);
	
// Theme scripts
if( ! function_exists('presslayer_theme_scripts' ) ){
	function presslayer_theme_scripts() {
		global $post;
		//CSS
		wp_enqueue_style('framework', THEME_URI . 'assets/css/framework.css');
		wp_enqueue_style('style', get_bloginfo('stylesheet_url'));
		wp_enqueue_style('flexslider', THEME_URI . 'assets/css/flexslider.css');
		wp_enqueue_style('magnific', THEME_URI . 'assets/css/magnific-popup.css');
		wp_enqueue_style('audioplayer', THEME_URI . 'assets/css/audioplayer.css');
		wp_enqueue_style('superfish', THEME_URI . 'assets/css/superfish.css');
		wp_enqueue_style('superfish-vertical', THEME_URI . 'assets/css/superfish-vertical.css');
		wp_enqueue_style('infinitypush', THEME_URI . 'assets/css/infinitypush.css');
		wp_enqueue_style('print', THEME_URI . 'assets/css/print.css', false, false, 'print');
		wp_enqueue_style('font-awesome', THEME_URI . 'assets/fonts/font-awesome/font-awesome.min.css');
		wp_enqueue_style('dashicons');
		
		//JS
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-masonry', array('jquery'), false, true);
		wp_enqueue_script('infinitescroll', THEME_URI . 'assets/js/jquery.infinitescroll.min.js', array('jquery'), false, true);
		wp_enqueue_script('flexslider', THEME_URI . 'assets/js/jquery.flexslider-min.js', array('jquery'), false, true);
		wp_enqueue_script('plugins', THEME_URI . 'assets/js/plugins.js', array('jquery'), false, true);
		wp_enqueue_script('magnific', THEME_URI . 'assets/js/magnific-popup.js', array('jquery'), false, true);
		wp_enqueue_script('audioplayer', THEME_URI . 'assets/js/audioplayer.min.js', array('jquery'), false, true);
		wp_enqueue_script('superfish', THEME_URI . 'assets/js/superfish.min.js', array('jquery'), false, true);
		wp_enqueue_script('infinitypush', THEME_URI . 'assets/js/jquery.ma.infinitypush.js', array('jquery'), false, true);
		wp_enqueue_script('custom', THEME_URI . 'assets/js/custom.js', array('jquery'), false, true);
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	}
}
add_action('wp_enqueue_scripts','presslayer_theme_scripts');

// Admin script
if( ! function_exists('presslayer_admin_scripts' ) ){
    function presslayer_admin_scripts() {
		global $pagenow;
		if( 'post.php' == $pagenow || 'post-new.php' == $pagenow ){
		wp_enqueue_script('custom.admin', THEME_URI .'assets/admin/custom.admin.js', array('jquery') );
		}
    }
}
add_action( 'admin_enqueue_scripts', 'presslayer_admin_scripts' );

// Filter some things
function prl_exceprt_more( $excerpt ){
    return ' <a href="'.get_permalink().'" title="'.__( 'Read more', 'presslayer' ).'" >...</a>';
}
add_filter( 'excerpt_more', 'prl_exceprt_more' );

function posts_link_attributes_1() {
    return 'class="prl-button light fullwidth infscr-button"';
}
add_filter('next_posts_link_attributes', 'posts_link_attributes_1');


function posts_link_next_class($format){
     $format = str_replace('href=', 'class="prl-button floatright" href=', $format);
     return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="prl-button floatleft" href=', $format);
     return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');

function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='prl-button small light", $class);
    return $class;
}
add_filter('comment_reply_link', 'replace_reply_link_class');

function categories_postcount_filter ($variable) {
   $variable = str_replace('</a> (', ' (', $variable);
   $variable = str_replace(')', ')</a>', $variable);
   return $variable;
}
add_filter('wp_list_categories','categories_postcount_filter');

function archive_postcount_filter ($variable) {
   $variable = str_replace('</a>&nbsp;(', ' (', $variable);
   $variable = str_replace(')', ')</a>', $variable);
   return $variable;
}
add_filter('get_archives_link', 'archive_postcount_filter');

// Load framework
if(class_exists('AQ_Page_Builder')) 
require_once ( THEME_DIR . '/page-builder/page-builder.php' );
require_once ( THEME_DIR . '/framework/load.php' );
require_once ( THEME_DIR . '/inc/init.php');


// ssl的gravatar头像
function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
// add_filter('get_avatar', 'get_ssl_avatar');
// 利用多说缓存头像
function duoshuo_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'duoshuo_avatar', 10, 3 );
// 本地缓存gravatar
function my_avatar($avatar) {
  	$tmp = strpos($avatar, 'http');
  	$g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
  	$tmp = strpos($g, 'avatar/') + 7;
  	$f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
  	$w = get_bloginfo('wpurl');
  	$e = ABSPATH .'avatar/'. $f .'.jpg';
  	$t = 1209600; //設定14天, 單位:秒
  	if ( !is_file($e) || (time() - filemtime($e)) > $t ) { //當頭像不存在或文件超過14天才更新
    	copy(htmlspecialchars_decode($g), $e);
  	} else  $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.jpg'));
  	if (filesize($e) < 500) copy($w.'/avatar/default.jpg', $e);
  	return $avatar;
}
add_filter('get_avatar', 'my_avatar');

/**
 * 添加/移除 WordPress 多站点网络的默认页面
 */
add_action('wpmu_new_blog', 'wpb_create_my_pages', 10, 2);
 
function wpb_create_my_pages($blog_id, $user_id){
  	switch_to_blog($blog_id);
 
	// 创建一个新页面
  	$page_id = wp_insert_post(array(
	    'post_title'     => 'About',
	    'post_name'      => 'about',
	    'post_content'   => 'This is an about page. Feel free to edit or delete this page.',
	    'post_status'    => 'publish',
	    'post_author'    => $user_id, // or "1" (super-admin?)
	    'post_type'      => 'page',
	    'menu_order'     => 1,
	    'comment_status' => 'closed',
	    'ping_status'    => 'closed',
 	));  
 
	// 查找和删除WordPress默认页面'Sample Page'
	//如果是简体中文，你可能需要修改'Sample Page'为'示例页面'
	$defaultPage = get_page_by_title( '示例页面' );
	wp_delete_post( $defaultPage->ID );
	restore_current_blog();
}