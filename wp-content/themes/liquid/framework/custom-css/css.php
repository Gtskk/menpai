<?php
define( 'CSS_PAGE_SLUG', 'css-editor');

function add_header_script(){
	global $option_name;
	$css_code = stripcslashes(get_option($option_name));
	if($css_code!=''){
		echo "\n<!--  CUSTOM CSS -->\n" . ' <style type="text/css">' . "\n";
			echo $css_code;
		echo "\n" . '</style>' . "\n";
	}
}
add_action('wp_head','add_header_script', 99);

if(is_admin()):
	function custom_css_admin_menu(){
	   if(defined('OPTIONS_MENU_SLUG') && OPTIONS_MENU_SLUG!=''){
			add_submenu_page( OPTIONS_MENU_SLUG ,__('自定义样式','presslayer'), __('自定义样式','presslayer'), 'manage_options', CSS_PAGE_SLUG, 'css_admin_view' );
	   }else{
			add_menu_page(__('自定义样式','presslayer'),__('自定义样式','presslayer'),'manage_options', CSS_PAGE_SLUG ,'css_admin_view');
	   }   
	}
	add_action( 'admin_enqueue_scripts', 'css_admin_script' );
	add_action('admin_menu','custom_css_admin_menu',99);
endif;

$option_name = sanitize_title(THEME_NAME).'_custom_css';

function css_admin_view(){
    global $option_name;
	$text= '';
    if(isset($_POST['pl_css'])){
        update_option($option_name,$_POST['pl_css']);
        $text = '<div class="updated below-h2" id="message"><p>'.__('Options saved','presslayer').'.</p></div>';
    }
	?>
    
    <div class="wrap">
        <h2><?php _e('Custom CSS','presslayer');?></h2>
        <?php echo $text; ?> 
        <div class="pl-css">
            <form method="post"> 
            <textarea id="pl_css" name="pl_css"><?php echo esc_textarea(stripcslashes(get_option($option_name))); ?></textarea>
             <p><input type="submit" value="<?php _e('Save Changes','presslayer');?>" class="button-primary" /></p>
            </form>
        </div>
    </div>
    <script>
      var editor = CodeMirror.fromTextArea(document.getElementById("pl_css"), {
            lineNumbers: true,
            firstLineNumber: 1, mode: 'css',
            viewportMargin: Infinity,
            fixedGutter: true,
			theme: 'monokai'
        });
    </script>
    <?php
}

function css_admin_script($hook){
	if ( substr( $hook, -strlen( CSS_PAGE_SLUG ) ) !== CSS_PAGE_SLUG )
	        return;	 
	
	wp_enqueue_style('codemirror', OPTIONS_FRAMEWORK_DIRECTORY . 'custom-css/lib/codemirror.css');
	wp_enqueue_style('monokai', OPTIONS_FRAMEWORK_DIRECTORY . 'custom-css/theme/monokai.css');
	wp_enqueue_script('codemirror', OPTIONS_FRAMEWORK_DIRECTORY . 'custom-css/lib/codemirror.js', array('jquery'));
	wp_enqueue_script('custom-css', OPTIONS_FRAMEWORK_DIRECTORY . 'custom-css/css.js', array('jquery'));
}