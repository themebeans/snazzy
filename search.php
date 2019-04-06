<?php
/**
 * The template for displaying search results pages
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main site-main--wrapper" role="main">

		<section id="hfeed" class="hfeed">

			<?php if ( have_posts() ) : ?>

				<header class="entry-header">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'snazzy' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
				</header>

				<?php
				while ( have_posts() ) :
					the_post();

					/*
		               		 * Include the Post-Format-specific template for the content.
		                	 * If you want to override this in a child theme, then include a file
		                	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		                	*/
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				if ( have_posts() ) :
					/**
					 * Previous/next page navigation or JetPack infinite scroll, if active.
					 * The following function is located in inc/template-tags.php
					 */
					snazzy_pagination();
				endif;

			else :
				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</section>

	</main>

</div>

<?php
get_footer();
