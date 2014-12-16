<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Liquid Box (only for Liquid theme)
 * @since 1.0
 */
function wps_shortcode_lqbox($atts, $content = NULL) {
	extract( shortcode_atts( array(
		'class' => ''
	), $atts ) );
   
   $content = do_shortcode( shortcode_unautop( $content ) );
	if ( '</p>' == substr( $content, 0, 4 )
	and '<p>' == substr( $content, strlen( $content ) - 3 ) )
		$content = substr( $content, 4, strlen( $content ) - 7 );
	return '<div class="w-box tu-panel"><div class="w-box-inner">' . $content . '</div></div>';
   
}
add_shortcode('wps_lqbox', 'wps_shortcode_lqbox');

/**
 * Button
 * @since 1.0
 */
function wps_button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'color' => '',
		'url' => '',
		'size' => '',
		'target' => '',
		'type' => '',
		'rel' => '',
		'icon_left' => '',
		'icon_right' => ''
	), $atts ) );
	
	$btn_rel = '';
	if($rel == 'nofollow') $btn_rel = ' rel="nofollow"';
	$ico_l = '';
	if($icon_left != '') $ico_l = '<i class="fa '.$icon_left.'"></i> ';
	$ico_r = '';
	if($icon_right != '') $ico_r = ' <i class="fa '.$icon_right.'"></i>';

	return '<a href="' . $url . '" class="wps-button ' . $color . ' ' . $size . ' ' . $type . '" target="_' . $target . '" '.$btn_rel.'>' .$ico_l . do_shortcode($content) . $ico_r . '</a>';
}

add_shortcode('wps_button', 'wps_button_shortcode');


/**
 * Info Box
 * @since 1.0
 */
function wps_info_box_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => '',
		'icon' => ''
	), $atts ) );

	if ( $icon == "yes" ? $icon : $icon = "no-icon" )

	return '<div class="wps-box ' . $type . ' ' . $icon . '">' . do_shortcode($content) . '</div>';
}

add_shortcode('wps_info_box', 'wps_info_box_shortcode');


/**
 * Highlight
 * @since 1.0
 */
function wps_highlight_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'color' => ''
	), $atts ) );

	return '<span class="wps-highlight ' . $color . '">' . do_shortcode($content) . '</span>';
}

add_shortcode('wps_highlight', 'wps_highlight_shortcode');

/**
 * Tabs
 * @since 1.0
 */
function wps_shortcode_tabgroup( $atts, $content = NULL){
    $GLOBALS['wps_tab_count'] = 0;
    $GLOBALS['wps_tabs'] = '';
    do_shortcode( $content );
	if( is_array( $GLOBALS['wps_tabs'] ) ){
        foreach( $GLOBALS['wps_tabs'] as $tab ){
            $tabs[] = '<li><a href="#'.$tab['id'].'Tab">'.$tab['title'].'</a></li>';
            $panes[] = '<div id="'.$tab['id'].'Tab" class="wps-tabs-content">'.$tab['content'].'</div>';
        }
	
	$return = "\n".'<div class="wps_tabgroup wps-tabs"><ul>'.implode( "\n", $tabs ).'</ul>'."\n".implode( "\n", $panes ).'</div>'."\n";
    }
    return $return;
}
add_shortcode( 'wps_tabgroup', 'wps_shortcode_tabgroup' );

function wps_shortcode_tab( $atts, $content = NULL ){
	extract( shortcode_atts( array(
		'title' => '%d',
        'id' => '%d'
	), $atts ) );
   
    $i = $GLOBALS['wps_tab_count'];
    $GLOBALS['wps_tabs'][$i] = array(
        'title' => sprintf( $title, $GLOBALS['wps_tab_count']),
        'content' => do_shortcode($content),
        'id' =>  $id);

    $GLOBALS['wps_tab_count']++;
}
add_shortcode( 'wps_tab', 'wps_shortcode_tab' );



/**
 * Accordion
 * @since 1.0
 */
function wps_shortcode_accordiongroup( $atts, $content = NULL){
    $GLOBALS['wps_accordion_count'] = 0;
    $GLOBALS['wps_accordions'] = '';
    do_shortcode( $content );
	if( is_array( $GLOBALS['wps_accordions'] ) ){
        foreach( $GLOBALS['wps_accordions'] as $accordion ){
            $accordions[] = '<h3 class="wps-accordion-title">'.$accordion['title'].'</h3><div class="wps-accordion-content"><p>'.$accordion['content'].'</p></div>';
        }
	
	$return = "\n".'<div class="wps_accordiongroup wps-accordion">'.implode( "\n", $accordions ).'</div>'."\n";
    }
    return $return;
}
add_shortcode( 'wps_accordiongroup', 'wps_shortcode_accordiongroup' );

function wps_shortcode_accordion( $atts, $content = NULL ){
	extract( shortcode_atts( array(
		'title' => '%d'
	), $atts ) );
   
    $i = $GLOBALS['wps_accordion_count'];
    $GLOBALS['wps_accordions'][$i] = array(
        'title' => sprintf( $title, $GLOBALS['wps_accordion_count']),
        'content' => do_shortcode($content));

    $GLOBALS['wps_accordion_count']++;
}
add_shortcode( 'wps_accordion', 'wps_shortcode_accordion' );

/**
 * Toggle
 * @since 1.0
 */
function wps_toggle_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title'	=> 'Toggle Title',
		'state'	=> 'open'
	), $atts ) );

	if ( $state == 'open' ) {
		$span_class = 'ui-icon-minus';
	} else {
		$span_class = 'ui-icon-plus';
	}

	return '<div class="wps-toggle"><div class="wps-toggle-title"><span class="ui-icon ' . $span_class . '"></span>' . $title . '</div><div class="wps-toggle-content wps-toggle-state-' . $state . '">' . do_shortcode($content) . '</div></div>';
}

add_shortcode('wps_toggle', 'wps_toggle_shortcode');

/**
 * Columns
 * @since 1.0
 */
function wps_column_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title'	=> '',
		'type'	=> ''
	), $atts ) );

	$c = '<div class="wps-columns wps-columns-color-' . $color . ' wps-columns-' . $type . '">
			<h4 class="wps-columns-title">' .
				$title .
			'</h4>
		<div class="wps-columns-content">' . do_shortcode($content) . '</div></div>';

	return $c;
}

add_shortcode('wps_column', 'wps_column_shortcode');

/*
 * Google Maps
 * @since v1.1
 */
function wps_shortcode_googlemaps($atts, $content = null) {
	
	extract(shortcode_atts(array(
			'title'			=> '',
			'location'		=> '',
			'width'			=> '',
			'height'		=> '300',
			'zoom'			=> 8,
			'align'			=> '',
			'class'			=> '',
			'visibility'	=> 'all',
	), $atts));
	
	// load scripts
	wp_enqueue_script('wps_googlemap');
	wp_enqueue_script('wps_googlemap_api');
	
	
	$output = '<div id="map_canvas_'.rand(1, 100).'" class="wps_googlemap '. $class .' wps-'. $visibility .'" style="height:'.$height.'px;width:100%">';
		$output .= (!empty($title)) ? '<input class="title" type="hidden" value="'.$title.'" />' : '';
		$output .= '<input class="location" type="hidden" value="'.$location.'" />';
		$output .= '<input class="zoom" type="hidden" value="'.$zoom.'" />';
		$output .= '<div class="wps_map_canvas"></div>';
	$output .= '</div>';
	
	return $output;
}
add_shortcode("wps_googlemap", "wps_shortcode_googlemaps");

?>