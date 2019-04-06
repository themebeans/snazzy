<?php
/**
 * The file is for creating the portfolio post type meta.
 * Meta output is defined on the portfolio single editor.
 * Corresponding meta functions are located in framework/metaboxes.php
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

add_action( 'add_meta_boxes', 'bean_metabox_portfolio' );
function bean_metabox_portfolio() {

	$prefix = '_bean_';

	/*
	===================================================================*/
	/*
	  PORTFOLIO FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'          => 'portfolio-type',
		'title'       => esc_html__( 'Portfolio Format', 'snazzy' ),
		'description' => esc_html__( '', 'snazzy' ),
		'page'        => 'portfolio',
		'context'     => 'side',
		'priority'    => 'core',
		'fields'      => array(
			array(
				'name' => esc_html__( 'Gallery', 'snazzy' ),
				'desc' => esc_html__( '', 'snazzy' ),
				'id'   => $prefix . 'portfolio_type_gallery',
				'type' => 'checkbox',
				'std'  => true,
			),
			array(
				'name' => esc_html__( 'Video', 'snazzy' ),
				'desc' => esc_html__( '', 'snazzy' ),
				'id'   => $prefix . 'portfolio_type_video',
				'type' => 'checkbox',
				'std'  => false,
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  PORTFOLIO META SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'          => 'portfolio-meta',
		'title'       => esc_html__( 'Portfolio Settings', 'snazzy' ),
		'description' => esc_html__( '', 'snazzy' ),
		'page'        => 'portfolio',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => esc_html__( 'Gallery Images:', 'snazzy' ),
				'desc' => esc_html__( 'Upload, reorder and caption the post gallery.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_upload_images',
				'type' => 'images',
				'std'  => esc_html__( 'Browse & Upload', 'snazzy' ),
			),
			array(
				'name' => esc_html__( 'Date:', 'snazzy' ),
				'id'   => $prefix . 'portfolio_date',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the date.', 'snazzy' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Views:', 'snazzy' ),
				'id'   => $prefix . 'portfolio_views',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the view count.', 'snazzy' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Categories:', 'snazzy' ),
				'id'   => $prefix . 'portfolio_cats',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the portfolio categories.', 'snazzy' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Tags:', 'snazzy' ),
				'id'   => $prefix . 'portfolio_tags',
				'type' => 'checkbox',
				'desc' => esc_html__( 'Display the portfolio tags.', 'snazzy' ),
				'std'  => false,
			),
			array(
				'name' => esc_html__( 'Role:', 'snazzy' ),
				'desc' => esc_html__( 'Display the role.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_role',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Client:', 'snazzy' ),
				'desc' => esc_html__( 'Display the client meta.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_client',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'URL:', 'snazzy' ),
				'desc' => esc_html__( 'Display a URL to link to.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_url',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'External URL:', 'snazzy' ),
				'desc' => esc_html__( 'Link this portfolio post to an external URL. For example, link this post to your Behance portfolio post.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_external_url',
				'type' => 'text',
				'std'  => '',
			),
		),
	);
	bean_add_meta_box( $meta_box );

	/*
	===================================================================*/
	/*
	  VIDEO POST FORMAT SETTINGS
	/*===================================================================*/
	$meta_box = array(
		'id'       => 'bean-meta-box-portfolio-video',
		'title'    => esc_html__( 'Video Settings', 'snazzy' ),
		'page'     => 'portfolio',
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => esc_html__( 'Lightbox Embed URL:', 'snazzy' ),
				'desc' => esc_html__( 'Insert your embeded URL to play in the blogroll grid pages.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_embed_url',
				'type' => 'text',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 1:', 'snazzy' ),
				'desc' => esc_html__( 'Insert your embeded code here.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_embed_code',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 2:', 'snazzy' ),
				'desc' => esc_html__( 'Insert your embeded code here.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_embed_code_2',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 3:', 'snazzy' ),
				'desc' => esc_html__( 'Insert your embeded code here.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_embed_code_3',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Embed 4:', 'snazzy' ),
				'desc' => esc_html__( 'Insert your embeded code here.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_embed_code_4',
				'type' => 'textarea',
				'std'  => '',
			),
			array(
				'name' => esc_html__( 'Video Shortcodes:', 'snazzy' ),
				'desc' => __( 'Insert any <a target="_blank" href="https://codex.wordpress.org/Video_Shortcode">video shortcodes</a> here.', 'snazzy' ),
				'id'   => $prefix . 'portfolio_video_shortcodes',
				'type' => 'textarea',
				'std'  => '',
			),
		),

	);
	bean_add_meta_box( $meta_box );
} // END function bean_metabox_portfolio()
