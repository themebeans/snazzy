<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<div id="page" class="hfeed site page-container clearfix">

		<?php if ( ! is_404() ) : ?>

		<div id="content" class="site-content content-wrap">

			<header id="masthead" class="site-header">

			<?php snazzy_site_logo(); ?>

			<?php
			// Add site description to the header.
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) :
				printf( '<p class="site-description">%s</p>', esc_html( $description ) );
			endif;
			?>

			<?php if ( has_nav_menu( 'primary' ) ) : ?>

				<nav id="site-navigation" class="main-navigation" role="navigation">

					<h6 class="widget-title"><?php esc_html_e( 'Menu', 'snazzy' ); ?></h6>

					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav>

				<div class="mobile-menu-toggle"><span></span><span></span><span></span></div>

			<?php endif; ?>

			<?php
			// Retrieve the portfolio fitler, only for the Portfolio template.
			if ( snazzy_is_frontpage() || is_post_type_archive( 'portfolio' ) ) {
				get_template_part( 'template-parts/portfolio-filter' );
			}

			get_sidebar();
			?>

			<div class="site-info">

				<div class="copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( $name ); ?></a></div>

				<?php $visibility = ( false === get_theme_mod( 'powered_by_snazzy' ) ) ? 'hidden' : ''; ?>

				<a href="https://themebeans.com/themes/snazzy/" class="powered-by-snazzy <?php echo esc_attr( $visibility ); ?>"><?php printf( esc_html__( 'Powered by %s', 'snazzy' ), 'Snazzy' ); ?></a>

				<?php $visibility = ( false === get_theme_mod( 'powered_by_wordpress' ) ) ? 'hidden' : ''; ?>

				<a href="http://wordpress.org/" class="powered-by-wordpress <?php echo esc_attr( $visibility ); ?>"><?php printf( esc_html__( '& %s', 'snazzy' ), 'WordPress' ); ?></a>

			</div>

			</header>

		<?php
		endif;
