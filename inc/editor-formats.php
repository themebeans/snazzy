<?php
/**
 * Custom TinyMCE editor formats for this theme.
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

/**
 * TinyMCE callback function to insert 'styleselect' into the $buttons array.
 */
function snazzy_mce_formats_button( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
add_filter( 'mce_buttons_2', 'snazzy_mce_formats_button' );

/**
 * TinyMCE Callback function to filter the MCE settings.
 */
function snazzy_mce_before_init_insert_formats( $init_array ) {

	$style_formats = array(
		array(
			'title'   => 'Button',
			'inline'  => 'span',
			'classes' => 'button',
			'wrapper' => false,
		),
	);

	// Insert the array, JSON ENCODED, into 'style_formats'.
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'snazzy_mce_before_init_insert_formats' );
