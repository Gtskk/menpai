<?php
class Options_Framework_Sorter {

	public function init() {
		add_action( 'admin_enqueue_scripts', array( $this, 'optionsframework_sorter_scripts' ) );
	}

	static function optionsframework_sorter( $value, $val ) {

		$optionsframework_settings = get_option( 'optionsframework' );
		$option_name = $optionsframework_settings['id'];
		
		if ( !isset($value['hook_name']) ) $hook_name = __('Apply to','presslayer');
		else $hook_name = $value['hook_name'];
		
		$supports = array('title','hook','icon','image','url','content','autop');	
		foreach($supports as $k => $v){
            if(in_array($v,$value['support'])){
                $cur_support[$v] = true;
            }else{
                $cur_support[$v] = false;
            }
       }

		$output = '<div class="of-sorter">';
		$output .= '<input type="hidden" class="sorter-temp" value="'.esc_attr( $option_name . '[' . $value['id'] . ']' ).'" />';
		$output .= '<ul id="'.$value['id'].'" class="sorter-list">';
		
		/* Retrieve fields */
		if($val != ''){
			$count = 0;
			foreach ($val as $sorter):
				$output .= '<li class="list-item"><div class="sorter-widget">';
				$output .= '<div class="sorter-handle"><strong>'.esc_attr(stripslashes($sorter['title'])).'</strong><a class="handle-toggle sorter-edit" href="#"></a></div>';
				$output .= '<div class="sorter-body">';
				
				// Title
				if($cur_support['title']) 
				$output .= '<p class="sorter-row"><label>'.__('Title','presslayer').'</label><input name="'.esc_attr($option_name.'['. $value['id'] .']['.$count.'][title]').'" type="text" value="'.$sorter['title'].'" class="sorter-title"></p>';
				
				// Hook
				if($cur_support['hook']){
				$output .= '<p class="sorter-row"><label>'.$hook_name.'</label><select name="'.esc_attr($option_name.'['. $value['id'] .']['.$count.'][hook]').'" class="sorter-hook">';
				foreach ($value['hook'] as $k => $v) {
					$selected = '';
					if ( $sorter['hook'] ==  $k ) $selected = 'selected="selected"';						
					$output .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
				}
				
				$output .= '</select></p>';
				}
				
				// Icon
				if($cur_support['icon']) {
				$output .= '<p class="sorter-row"><label>Icon</label><input type="hidden" class="sorter-icon icon_picker_'.$value['id'].'" name="'.esc_attr($option_name.'['. $value['id'] .']['.$count.'][icon]').'" value="'.esc_attr($sorter['icon']).'"/>';
				
				$icon_class = '';
				if( isset( $sorter['icon'] ) ) { 
					$icon_class = str_replace('|',' ',$sorter['icon']); 
				}
				
				$output .= '<span type="button" class="button icon-picker '.$icon_class.'"></span></p>';
				}
				
				// Image
				if($cur_support['image']){
				$output .= '<p class="sorter-row"><label>'.__('Image','presslayer').'</label><input name="'.esc_attr($option_name.'['. $value['id'] .']['.$count.'][image]').'" type="text" value="'.esc_attr($sorter['image']).'" class="sorter-image">';
				$output .= '<input type="button" class="button sorter_media_upload_btn" value="'. __('Upload','presslayer') .'" /></p>';
				}
				
				// URL
				if($cur_support['url']) $output .= '<p class="sorter-row"><label>'.__('URL','presslayer').'</label><input name="'.esc_attr($option_name.'['. $value['id'] .']['.$count.'][url]').'" type="text" value="'.esc_url($sorter['url']).'" class="sorter-url"></p>';
				
				// Content
				if($cur_support['content'])
				$output .= '<p class="sorter-row"><label>'.__('Content','presslayer').'</label><textarea name="'.esc_attr($option_name.'['. $value['id'] .']['.$count.'][content]').'" rows="6" class="sorter-content" >'.esc_textarea(stripslashes($sorter['content'])).'</textarea></p>';

				// Autop
				if($cur_support['autop']) {
					$checked = '';
					if ( isset($sorter['autop']) ) $checked = checked($sorter['autop'], 1, false);
					$output .= '<p class="sorter-row"><label><input name="'.esc_attr($option_name.'['. $value['id'] .']['.$count.'][autop]').'" type="checkbox" class="sorter-autop" value="1" '.$checked.' /> '.__('Automatically add paragraphs','presslayer').'</label></p>';
				}
				$output .= '<p class="sorter-row"><a class="sorter-delete" href="#">'.__('Delete','presslayer').'</a> | <a class="sorter-close" href="#">'.__('Close','presslayer').'</a></p>';
				$output .= '</div></div></li>';	
				$count ++;
			endforeach;
		}
		$output .=	'</ul>';
		$output .= '<input type="button" class="button sorter-more" value="'. __('Add More','presslayer') .'" />';

		/* Source to clone */
		$output .= '<div class="sorter-source temphide"><div class="sorter-widget">';
		$output .= '<div class="sorter-handle"><strong>'.__('Title','presslayer').'</strong>';
		$output .= '<a class="handle-toggle sorter-edit" href="#"></a></div>';
		$output .= '<div class="sorter-body">';
		if($cur_support['title']) $output .= '<p class="sorter-row"><label>'.__('Title','presslayer').'</label><input type="text" value="" class="sorter-title"></p>';
		if($cur_support['hook']){
			$output .= '<p class="sorter-row"><label>'.$hook_name.'</label><select class="sorter-hook">';
				foreach ($value['hook'] as $k => $v) {
					$output .= '<option value="'.$k.'">'.$v.'</option>';
				}
			$output .= '</select></p>';
		};
		
		if($cur_support['icon']) {
		$output .= '<p class="sorter-row"><label>Icon</label><input type="hidden" value="" class="sorter-icon icon_picker_'.$value['id'].'" />';
		$output .= '<span type="button" class="button icon-picker "></span></p>';
		}
		
		if($cur_support['image']){
		$output .= '<p class="sorter-row"><label>'.__('Image','presslayer').'</label><input type="text" value="" class="sorter-image">';
		$output .= '<input type="button" class="button sorter_media_upload_btn" value="'. __('Upload','presslayer') .'" /></p>';
		}
		
		if($cur_support['url']) $output .= '<p class="sorter-row"><label>'.__('URL','presslayer').'</label><input type="text" value="" class="sorter-url"></p>';
		
		if($cur_support['content']) $output .= '<p class="sorter-row"><label>'.__('Content','presslayer').'</label><textarea rows="6" class="sorter-content" ></textarea></p>';
		
		if($cur_support['autop']) $output .= '<p class="sorter-row"><label><input type="checkbox" class="sorter-autop" value="1" /> '.__('Automatically add paragraphs','presslayer').'</label></p>';
		
		$output .= '<p class="sorter-row"><a class="sorter-delete" href="#">'.__('Delete','presslayer').'</a> | <a class="sorter-close" href="#">'.__('Close','presslayer').'</a></p>';
		$output .= '</div></div></div>';
		$output .= '</div>';
		
		return $output;
	}

	/**
	 * Enqueue scripts for sorter ui
	 */
	function optionsframework_sorter_scripts( $hook ) {
		$menu = Options_Framework_Admin::menu_settings();

        if ( substr( $hook, -strlen( $menu['menu_slug'] ) ) !== $menu['menu_slug'] )
	        return;

		wp_register_script( 'of-sorter', OPTIONS_FRAMEWORK_DIRECTORY .'js/sorter-script.js', array( 'jquery' ), Options_Framework::VERSION );
		wp_enqueue_script( 'of-sorter' );
		
	}
}