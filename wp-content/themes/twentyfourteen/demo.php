<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */


add_filter( 'rwmb_meta_boxes', 'your_prefix_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function your_prefix_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'gtskk_';

	// 2nd meta box
	$meta_boxes[] = array(
		'title'  => '群组属性',

		'fields' => array(
			array(
				'name'             => '群组名称',
				'id'               => "{$prefix}groupname",
				'type'             => 'text',
			),
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => '群组logo',
				'id'               => "{$prefix}grouplogo",
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
		)
	);

	return $meta_boxes;
}


