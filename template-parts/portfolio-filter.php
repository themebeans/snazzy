<?php
/**
 * The file for displaying the more portfolio page filter.
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */


/**
 * Loop Variables
 */
if ( 'post' == get_post_type() ) {
	$loop_terms = 'category';
} else {
	$loop_terms = 'portfolio_category';
} ?>

<?php $visibility = ( false == get_theme_mod( 'portfolio_filter', true ) ) ? 'hidden' : ''; ?>

<div class="widget project-filter project-filterer <?php echo esc_html( $visibility ); ?>">

	<h6 class="widget-title">
		<?php
		/**
		 * Change the widget title based on the view.
		 * 'Filter' for the standard filter, and 'Archive' for the archivial views.
		 */
		if ( ! is_tax() ) :
			esc_html_e( 'Filter', 'snazzy' );
		else :
			esc_html_e( 'Archive', 'snazzy' );
		endif;
		?>
	</h6>

	<ul class="filter-group">

		<?php if ( ! is_tax() ) : ?>
			<li><a href="javascript:void(0);" id="filter-close" data-filter="*"><?php esc_html_e( 'All', 'snazzy' ); ?></a></li>
		<?php
		endif;

		$terms = get_terms( $loop_terms );
foreach ( $terms as $term ) {
	/**
			 * The $term_url utilizes the filter on the portfolio template,
			 * and the term_link on categorical pages.
			 */
	$term_url = ( is_tax() ) ? esc_url( get_term_link( $term ) ) : 'javascript:void(0);';
	echo balanceTags( '<li><a href="' . $term_url . '" data-filter=".' . $term->term_id . '" class="term-' . $term->term_id . '">' . $term->name . '</a></li>' );
}
		?>

	</ul><!-- END .filter-group -->

</div>

<?php $visibility = ( false == get_theme_mod( 'portfolio_sorting', true ) ) ? 'hidden' : ''; ?>

<?php
if ( ! is_tax() ) :
	/**
 * We don't need to show the project sorter on the taxonomy pages.
 * There's no point showing it really.
 */
	?>

<div class="widget project-filter project-sorter <?php echo esc_html( $visibility ); ?>">

	<h6 class="widget-title"><?php esc_html_e( 'Sort', 'snazzy' ); ?></h6>

	<ul class="sort-group">

		<li><a href="javascript:void(0);" class="shuffle-btn"><?php esc_html_e( 'Random', 'snazzy' ); ?></a></li>
		<li><a href="javascript:void(0);" data-sort-by="views"><?php esc_html_e( 'Popularity', 'snazzy' ); ?></a></li>
		<li><a href="javascript:void(0);" data-sort-by="date"><?php esc_html_e( 'Date', 'snazzy' ); ?></a></li>

	</ul><!-- END .sort-group -->

</div>

<?php endif; ?>
