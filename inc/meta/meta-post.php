<?php
/**
 * The file is for creating the blog post type meta.
 * Meta output is defined on the page editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

add_action( 'add_meta_boxes', 'bean_metabox_post' );
function bean_metabox_post() {

	$prefix = '_bean_';

	/*
	===================================================================*/
	/*
	  VIDEO POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-video',
		'title'    => esc_html__( 'Video Settings', 'snazzy' ),
		'page'     => 'post',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Lightbox Embed:', 'snazzy' ),
				'desc' => esc_html__( 'Insert a embeded URL for a video lightbox.', 'snazzy' ),
				'id'   => $prefix . 'post_embed_url',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed:', 'snazzy' ),
				'desc' => esc_html__( 'Alternatively, insert an embed code.', 'snazzy' ),
				'id'   => $prefix . 'post_embed',
				'type' => 'textarea',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );
} // END function bean_metabox_post()
