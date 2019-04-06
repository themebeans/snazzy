<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main site-main--wrapper site-main--index" role="main">
		<div id="hfeed" class="hfeed">

			<?php
			if ( have_posts() ) :

				// Add a title to the posts list.
				printf( '<h1 class="entry-title archive-title">%s</h1>', esc_html( 'Latest Articles', 'snazzy' ) );

				// Start the loop.
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				/**
				 * Previous/next page navigation or JetPack infinite scroll, if active.
				 * The following function is located in inc/template-tags.php
				 */
				snazzy_pagination();

			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>

		</div><!-- #hfeed -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
