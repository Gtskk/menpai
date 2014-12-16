<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! class_exists( 'TU_LikePost' ) )
{

	class TU_LikePost {
		
		var $ext_class = '';

		function __construct()
		{
			add_action( 'wp_enqueue_scripts', array( &$this, 'tu_enqueue_scripts' ) );
			add_action( 'wp_ajax_tu-likepost', array( &$this, 'ajax_callback' ) );
			add_action( 'wp_ajax_nopriv_tu-likepost', array( &$this, 'ajax_callback' ) );
		} 

		function tu_enqueue_scripts()
		{
			
			wp_register_script('tu_likepost',  get_template_directory_uri() . '/assets/js/tu_likepost.js', false, false, true );
			wp_enqueue_script( 'tu_likepost' );
			wp_localize_script( 'tu_likepost', 'tu_likepost_ajax', array( 'ajaxurl' => admin_url('admin-ajax.php')) );

		}

		function ajax_callback($post_id)
		{
			$text_zero_suffix = '';
			$text_one_suffix = '';
			$text_more_suffix = '';

			if( isset($_POST['recommend_id']) ) {
				$post_id = str_replace('tu-likepost-', '', $_POST['recommend_id']);
				echo $this->tu_like_post($post_id, $text_zero_suffix, $text_one_suffix, $text_more_suffix, 'update');
			} else {
				$post_id = str_replace('tu-likepost-', '', $_POST['post_id']);
				echo $this->tu_like_post($post_id, $text_zero_suffix, $text_one_suffix, $text_more_suffix, 'get');
			}

			exit;

		}

		function tu_like_post($post_id, $text_zero_suffix = false, $text_one_suffix = false, $text_more_suffix = false, $action = 'get')
		{
			if(!is_numeric($post_id)) return;
			$text_zero_suffix = strip_tags($text_zero_suffix);
			$text_one_suffix = strip_tags($text_one_suffix);
			$text_more_suffix = strip_tags($text_more_suffix);

			switch($action) {

				case 'get':
					$recommended = get_post_meta($post_id, '_recommended', true);
					if( !$recommended ){
						$recommended = 0;
						add_post_meta($post_id, '_recommended', $recommended, true);
					}

					if( $recommended == 0 ) { $suffix = $text_zero_suffix; }
					elseif( $recommended == 1 ) { $suffix = $text_one_suffix; }
					else { $suffix = $text_more_suffix; }

					$output = '<span class="tu-likepost-count">'. $recommended .'</span> <span class="tu-likepost-suffix">'. $suffix .'</span>';
					return $output;

					break;


				case 'update':

					$recommended = get_post_meta($post_id, '_recommended', true);
					
					if ( isset($_COOKIE['dot_irecommendthis_'. $post_id]) ) {
							return $recommended;
					}

					$recommended++;
					update_post_meta($post_id, '_recommended', $recommended);
					setcookie('dot_irecommendthis_'. $post_id, time(), time()+3600*24*365, '/');
					
					if( $recommended == 0 ) { $suffix = $text_zero_suffix; }
					elseif( $recommended == 1 ) { $suffix = $text_one_suffix; }
					else { $suffix = $text_more_suffix; }

					$output = '<span class="tu-likepost-count">'. $recommended .'</span> <span class="tu-likepost-suffix">'. $suffix .'</span>';

					$dot_irt_html = apply_filters( 'dot_irt_before_count', $output );

					return $dot_irt_html;

					break;

			}
		}	//tu_like_post


		function tu_likepost($id=null)
		{

			global $wpdb;
			$post_ID = $id ? $id : get_the_ID();
			global $post;
			
			$text_zero_suffix = '';
			$text_one_suffix = '';
			$text_more_suffix = '';

			$output = $this->tu_like_post($post_ID, $text_zero_suffix, $text_one_suffix, $text_more_suffix);			

			if (!isset($_COOKIE['dot_irecommendthis_'.$post_ID])) {
				$class = 'tu-likepost';
				$title = __('Like this post', 'presslayer');
			}
			else {

				$class = 'tu-likepost active';
				$title = __('You already liked this post', 'presslayer');
			}

			$dot_irt_html = '<a href="#" class="'.$this->ext_class.' '. $class .'" id="tu-likepost-'. $post_ID .'" title="'. $title .'">';
			$dot_irt_html .= apply_filters( 'dot_irt_before_count', $output );
			$dot_irt_html .= '</a>';

			return $dot_irt_html;
		}

	} // End Class

	global $dot_irecommendthis;

	// Initiation call of plugin
	$dot_irecommendthis = new TU_LikePost();

}

	function tu_likepostthis($new_class)
	{
		global $dot_irecommendthis;
		$dot_irecommendthis->ext_class = $new_class;
		echo $dot_irecommendthis->tu_likepost();

	}
?>