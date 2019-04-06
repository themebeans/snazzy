<?php
/**
 * Jetpack Compatibility
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

if ( ! function_exists( 'snazzy_jetpack_setup' ) ) :
	/**
	 * JetPack compatibilites.
	 */
	function snazzy_jetpack_setup() {
		/**
		 * Add theme support for Infinite Scroll.
		 * See: http://jetpack.me/support/infinite-scroll/
		 */
		add_theme_support(
			'infinite-scroll', array(
				'container' => 'hfeed',
				'render'    => 'snazzy_scroll_render',
				'footer'    => 'page',
				'wrapper'   => false,
			)
		);

	}
	add_action( 'after_setup_theme', 'snazzy_jetpack_setup' );
endif;

if ( ! function_exists( 'snazzy_scroll_render' ) ) :
	/**
	 * Define the code that is used to render the posts added by Infinite Scroll.
	 * Create your own snazzy_scroll_render() to override in a child theme.
	 */
	function snazzy_scroll_render() {

		while ( have_posts() ) {

			the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() );
		}
	}
endif;

if ( ! function_exists( 'snazzy_remove_infinitescroll_css' ) ) :

	// First, make sure Jetpack doesn't concatenate all its CSS.
	add_filter( 'jetpack_implode_frontend_css', '__return_false' );

	/**
	 * Let's remove unnessary CSS loading.
	 */
	function snazzy_remove_infinitescroll_css() {
		wp_deregister_style( 'the-neverending-homepage' );
		wp_deregister_style( 'infinity-twentyten' );
		wp_deregister_style( 'infinity-twentyeleven' );
		wp_deregister_style( 'infinity-twentytwelve' );
	}

	add_action( 'wp_print_styles', 'snazzy_remove_infinitescroll_css' );
endif;
