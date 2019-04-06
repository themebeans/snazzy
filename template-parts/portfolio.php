<?php
/**
 * The template for displaying portfolio posts.
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

?>
<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<div id="projects">

			<?php
			$portfolio_posts_count = get_theme_mod( 'portfolio_posts_count' );

			$paged = 1;

			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			}

			if ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			}

			if ( is_tax() ) {

				global $query_string;

				query_posts( "{$query_string}&posts_per_page=-1" );

				if ( have_posts() ) :

					while ( have_posts() ) :

						the_post();

						get_template_part( 'template-parts/portfolio-loop' );

					endwhile;

				endif;

				wp_reset_postdata();

			} else {

				do_action( 'snazzy_before_portfolio' );

				$args = array(
					'post_type'      => 'portfolio',
					'order'          => 'ASC',
					'orderby'        => 'menu_order',
					'paged'          => $paged,
					'posts_per_page' => $portfolio_posts_count,
				);

				$wp_query = new WP_Query( apply_filters( 'snazzy_portfolio_args', $args ) );

				if ( $wp_query->have_posts() ) :

					while ( $wp_query->have_posts() ) :

						$wp_query->the_post();

						get_template_part( 'template-parts/portfolio-loop' );

					endwhile;

				endif;

				wp_reset_postdata();

				do_action( 'snazzy_after_portfolio' );

			}
			?>

		</div>

	<div id="page_nav">
		<?php next_posts_link(); ?>
	</div>

	</main>

</div>
