<?php
add_filter( 'rwmb_meta_boxes', 'register_meta_boxes' );

function register_meta_boxes( $meta_boxes )
{

	$tu_sidebars['sidebar'] = 'Default';
	$sbs  = of_get_option('custom_sidebar');
	if($sbs and is_array($sbs)){
		foreach($sbs as $sidebar){
			$tu_sidebars[tuSidebar($sidebar['title'])] = $sidebar['title'];	
		}
	}
	
	$prefix = 'tu_';

	// video options
	$meta_boxes[] = array(
		'id' => 'video_options',
		'title' => __( 'Video Options', 'presslayer' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'default',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => __( 'oEmbed', 'presslayer' ),
				'id'    => "{$prefix}oembed",
				'desc'  => __( 'Enter in a video URL that is compatible with WordPress\'s built-in oEmbed feature. <a href="http://codex.wordpress.org/Embeds" target="_blank">Learn More</a>', 'presslayer' ),
				'type'  => 'oembed',
			),

			array(
				'name'     => __( 'Video Thumbnail', 'presslayer' ),
				'id'       => "{$prefix}video_thumb",
				'type'     => 'select',
				'options'  => array(
					'oembed' => __( 'oEmbed', 'presslayer' ),
					'lightbox' => __( 'Lightbox', 'presslayer' ),
				),
				'std'         => 'oembed'
			)
		)
	);
	
	
	// audio options
	$meta_boxes[] = array(
		'id' => 'audio_options',
		'title' => __( 'Audio Options', 'presslayer' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'  => __( 'Audio File URL', 'presslayer' ),
				'id'    => "{$prefix}audio_file",
				'desc'  => __( 'The URL to the audio file.', 'presslayer' ),
				'type'  => 'text'
			),
			array(
				'name' => __( 'Audio Embed', 'meta-box' ),
				'id'   => "{$prefix}audio_embed",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
		)
	);
	
	// gallery options
	$meta_boxes[] = array(
		'id' => 'gallery_options',
		'title' => __( 'Gallery Options', 'presslayer' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'             => __( 'Upload images to gallery', 'presslayer' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',
				'max_file_uploads' => 20,
				'desc'			   => __('Hold Ctrl + click to select multiple images. Maximum 20 images.','presslayer')	
			),
		)
	);
	
	// link options
	$meta_boxes[] = array(
		'id' => 'link_options',
		'title' => __( 'Link Options', 'presslayer' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => __( 'Link URL', 'meta-box' ),
				'id'   => "{$prefix}link_url",
				'type' => 'text',
				'cols' => 20,
				'rows' => 3,
			),
		)
	);
	
	
	// quote options
	$meta_boxes[] = array(
		'id' => 'quote_options',
		'title' => __( 'Quote Options', 'presslayer' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => __( 'Quote', 'meta-box' ),
				'id'   => "{$prefix}quote",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 5,
			),
		)
	);
	
	// lightbox options
	$meta_boxes[] = array(
		'id' => 'lightbox_options',
		'title' => __( 'Lightbox Options', 'presslayer' ),
		'pages' => array( 'post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			
			array(
				'name'  => __( 'Lightbox', 'presslayer' ),
				'id'    => "{$prefix}lightbox",
				'desc'  => __( 'Enter URL of videos or Google map. You can use all of these:','presslayer') . ' <a href="https://www.youtube.com" target="_blank">Youtube</a>, <a href="https://vimeo.com" target="_blank">Vimeo</a>, <a href="http://www.metacafe.com" target="_blank">MetaCafe</a>, <a href="http://www.dailymotion.com" target="_blank">DailyMotion</a>, <a href="http://wistia.com" target="_blank">Wistia</a>, <a href="http://www.ustream.tv" target="_blank">Ustream</a>, <a href="https://www.screenr.com" target="_blank">Screenr</a>, <a href="https://www.veoh.com" target="_blank">Veoh</a>, <a href="https://vine.co" target="_blank">Vine</a>, <a href="https://www.google.com/maps/mm" target="_blank">Google map</a>',
				'type'  => 'text',
				'clone' => false,
			)
		)
	);
	
	
	// layout sidebar options
	$meta_boxes[] = array(
		'id' => 'layout_sidebar_options',
		'title' => __( 'Layout and Sidebar', 'presslayer' ),
		'pages' => array( 'post','page'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'     => __( 'Layout', 'presslayer' ),
				'id'       => "{$prefix}post_layout",
				'type'     => 'select',
				'options'  => array(
					'default' => __( 'Default', 'presslayer' ),
					'left_sidebar' => __( 'Left sidebar', 'presslayer' ),
					'right_sidebar' => __( 'Right sidebar', 'presslayer' ),
					'no_sidebar' => __( 'No sidebar', 'presslayer' ),
				),
				'std'         => 'default',
				'desc'	=> sprintf( __( 'See default setting here: <strong>Theme Options</strong> >> <a href="%1$s" target="_blank"><strong>Blog Settings</strong></a>', 'presslayer' ), admin_url().'themes.php?page=options-framework#options-group-3')
			),
			
			array(
				'name'     => __( 'Select Sidebar', 'presslayer' ),
				'id'       => "{$prefix}sidebar",
				'type'     => 'select',
				'options'  => $tu_sidebars,
				'std'         => 'default',
				'desc'	=> sprintf( __( 'Create custom sidebars: <strong>Theme Options</strong> >> <a href="%1$s" target="_blank"><strong>Custom Sidebars</strong></a>', 'presslayer' ), admin_url().'themes.php?page=options-framework')
			),
		)
	);
	
	// page options
	$meta_boxes[] = array(
		'id' => 'page_options',
		'title' => __( 'Page Options', 'presslayer' ),
		'pages' => array( 'page'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name'     => __( 'Page Title', 'presslayer' ),
				'id'       => "{$prefix}page_title",
				'type'     => 'select',
				'options'  => array(
					'show' => __( 'Show', 'presslayer' ),
					'hide' => __( 'Hide', 'presslayer' )
				),
				'std'         => 'show',
				'desc'	=> __( 'Show/Hide the page title.', 'presslayer' )
			),
			
			array(
				'name'     => __( 'Page Content Box', 'presslayer' ),
				'id'       => "{$prefix}page_content_box",
				'type'     => 'select',
				'options'  => array(
					'show' => __( 'Show', 'presslayer' ),
					'hide' => __( 'Hide', 'presslayer' )
				),
				'std'         => 'show',
				'desc'	=> __( 'Wrap a post by white box.', 'presslayer' )
			)
		)
	);
	
	// custom background
	$meta_boxes[] = array(
		'id' => 'custom_background',
		'title' => __( 'Custom Background', 'presslayer' ),
		'pages' => array( 'page'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(

			array(
				'name'             => __( 'Background Image', 'presslayer' ),
				'id'               => "{$prefix}page_bg",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
			array(
				'name'     => __( 'Background Align', 'presslayer' ),
				'id'       => "{$prefix}page_bg_align",
				'type'     => 'select',
				'options'  => array('top left' => 'Top Left','top right' => 'Top Right','top center' => 'Top Center','bottom left' => 'Bottom Left','bottom right' => 'Bottom Right', 'bottom center' => 'Bottom Center','center center'=>'Center Center'),
				'std'         => 'top center'
			),
			array(
				'name'     => __( 'Background Attachment', 'presslayer' ),
				'id'       => "{$prefix}page_bg_attachment",
				'type'     => 'select',
				'options'  => array('scroll' => 'Scroll','fixed' => 'Fixed'),
				'std'      => 'scroll'
			),
			array(
				'name'     => __( 'Background Repeat', 'presslayer' ),
				'id'       => "{$prefix}page_bg_repeat",
				'type'     => 'select',
				'options'  => array('repeat' => 'Repeat','repeat-x' => 'Repeat X','repeat-y' => 'Repeat Y','no-repeat' => 'No repeat'),
				'std'      => 'top center'
			),
			array(
				'name'     => __( 'Background Size', 'presslayer' ),
				'id'       => "{$prefix}page_bg_size",
				'type'     => 'select',
				'options'  => array('none'=>'No scale','100% auto' => '100% - Auto','auto 100%' => 'Auto - 100%','100% 100%' => '100% - 100%'),
				'std'      => 'none'
			),

		)
	);


	return $meta_boxes;
}


