<?php
/**
 * The file is for displaying the portfolio grid after single post content (pages and posts).
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */
	?>

<hr class="projects--divide">

<div id="projects" class="projects--more">

	<?php

	/**
	 * Check what post type we are using.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/get_post_type
	 */

	if ( 'post' == get_post_type() ) {
		$post_type = 'post';
	} else {
		$post_type = 'portfolio';
	}

	$args = array(
		'post_type'      => $post_type,
		'orderby'        => 'rand',
		'order'          => 'ASC',
		'posts_per_page' => '14',
		'post__not_in'   => array( $post->ID ),
	);

	$wp_query = new WP_Query( $args );

	if ( $wp_query->have_posts() ) :

		// Start the loop.
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();

			get_template_part( 'template-parts/portfolio-loop' );

			// End of the loop.
		endwhile;

	endif;

	wp_reset_postdata();
	?>

</div><!-- END #projects -->
