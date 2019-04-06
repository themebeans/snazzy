<?php
/**
 * The sidebar containing the main widget area for pages.
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
} ?>

<div id="sidebar" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
