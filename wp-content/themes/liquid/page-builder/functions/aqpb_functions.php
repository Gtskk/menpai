<?php
if(class_exists('AQ_Page_Builder')) {

	/* Select field */
	function field_select($field_id, $block_id, $options, $selected) {
		$options = is_array($options) ? $options : array();
		$output = '<select id="'. $block_id .'_'.$field_id.'" name="aq_blocks['.$block_id.']['.$field_id.']" class="select of-input chosen-select">';
		foreach($options as $key=>$value) {
			$output .= '<option value="'.$key.'" '.selected( $selected, $key, false ).'>'.htmlspecialchars($value).'</option>';
		}
		$output .= '</select>';
		
		return $output;
	}
	
	/* Multiselect field */
	function field_multiselect($field_id, $block_id, $options, $selected_keys = array()) {
		
		if($selected_keys!='' && is_array($selected_keys)){
			$new_array = array();
			foreach ($selected_keys as $k){
				$new_array[$k]=$options[$k];
			}
			$sortlist = $new_array + $options;
		}else{
			$sortlist = $options;
		}
				
		$output = '<select id="'. $block_id .'_'.$field_id.'" multiple="multiple" class="select of-input chosen-select chosen-sortable" name="aq_blocks['.$block_id.']['.$field_id.'][]">';
		foreach ($sortlist as $key => $option) {
			$selected = (is_array($selected_keys) && in_array($key, $selected_keys)) ? $selected = 'selected="selected"' : '';			
			$output .= '<option id="'. $block_id .'_'.$field_id.'_'. $key .'" value="'.$key.'" '. $selected .' />'.$option.'</option>';
		}
		$output .= '</select>';
		
		return $output;
	}
	
}