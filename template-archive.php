<?php
/**
 * Template Name: Archive
 * The template for displaying the post archives.
 *
 * This template simply defaults to the standard page layout,
 * for which specialized content is loaded based on a is_page_template check.
 *
 * Reference page.php and template-parts/content-page.php.
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main site-main--wrapper" role="main">

		<?php
		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile;
		?>

	</main>

</div>

<?php
get_footer();
