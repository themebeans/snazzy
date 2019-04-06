<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function snazzy_customizer_css() {

	$theme_accent_color     = get_theme_mod( 'theme_accent_color', '#44bba4' );
	$body_text_color        = get_theme_mod( 'body_text_color', '#1c1c1c' );
	$header_bg_color        = get_theme_mod( 'header_bg_color', '#1c1c1c' );
	$header_text_color      = get_theme_mod( 'header_text_color', '#888' );
	$header_title_color     = get_theme_mod( 'header_title_color', '#fff' );
	$overlay_bg_color       = get_theme_mod( 'overlay_bg_color', '#1c1c1c' );
	$overlay_text_color     = get_theme_mod( 'overlay_text_color', '#888' );
	$overlay_title_color    = get_theme_mod( 'overlay_title_color', '#ffffff' );
	$site_logo_width        = get_theme_mod( 'custom_logo_max_width', '40' );
	$site_logo_mobile_width = get_theme_mod( 'custom_logo_mobile_max_width', '40' );

	$css =
	'

	body .custom-logo-link img.custom-logo {
		width: ' . esc_attr( $site_logo_mobile_width ) . 'px;
	}

	@media (min-width: 600px) {
		body .custom-logo-link img.custom-logo {
			width: ' . esc_attr( $site_logo_width ) . 'px;
		}
	}

	body {
		color:' . $body_text_color . ' !important;
	}

	body .site-header {
		background-color:' . $header_bg_color . ';
	}

	body .site-header,
	body .site-header p,
	body .site-header a {
		color:' . $header_text_color . ';
	}

	body .site-header .widget-title,
	body .site-header .site-title a {
		color:' . $header_title_color . ';
	}

	body .project .overlay {
		background-color:' . $overlay_bg_color . ';
		color:' . $overlay_text_color . ';
	}

	body .project .entry-intro:before {
		color:' . $overlay_text_color . ';
	}

	body .project .overlay h2 {
		color:' . $overlay_title_color . ';
	}

	a:hover,
	a:focus,
	a:active,
	.entry-content li a,
	.entry-content p a,
	body .site-footer a:hover,
	body .header .project-filter a:hover,
	body .header .main-navigation a:hover,
	body .header .project-filter a.active,
	.logo_text:hover,
	.widget ul li a:hover,
	.current-menu-item a,
	.portfolio .project-meta a:hover,
	body .site-header .project-filter .js--active,
	.page-links a span:not(.page-links-title):hover,
	.page-links span:not(.page-links-title),
	.archive[class*="1"] .filter-group .term-1,
	.archive[class*="2"] .filter-group .term-2,
	.archive[class*="3"] .filter-group .term-3,
	.archive[class*="4"] .filter-group .term-4,
	.archive[class*="5"] .filter-group .term-5,
	.archive[class*="6"] .filter-group .term-6,
	.archive[class*="7"] .filter-group .term-7,
	.archive[class*="8"] .filter-group .term-8,
	.archive[class*="9"] .filter-group .term-9,
	.archive[class*="10"] .filter-group .term-10,
	.archive[class*="11"] .filter-group .term-11,
	.archive[class*="12"] .filter-group .term-12,
	.archive[class*="13"] .filter-group .term-13,
	.archive[class*="14"] .filter-group .term-14,
	.archive[class*="15"] .filter-group .term-15,
	.archive[class*="16"] .filter-group .term-16,
	.archive[class*="17"] .filter-group .term-17,
	.archive[class*="18"] .filter-group .term-18,
	.archive[class*="19"] .filter-group .term-19,
	.archive[class*="20"] .filter-group .term-20,
	.archive[class*="21"] .filter-group .term-21,
	.archive[class*="22"] .filter-group .term-22,
	.archive[class*="23"] .filter-group .term-23,
	.archive[class*="24"] .filter-group .term-24,
	.archive[class*="25"] .filter-group .term-25,
	.archive[class*="26"] .filter-group .term-26,
	.archive[class*="27"] .filter-group .term-27,
	.archive[class*="28"] .filter-group .term-28,
	.archive[class*="29"] .filter-group .term-29,
	.archive[class*="30"] .filter-group .term-30,
	.archive[class*="31"] .filter-group .term-31,
	.archive[class*="32"] .filter-group .term-32,
	.archive[class*="33"] .filter-group .term-33,
	.archive[class*="34"] .filter-group .term-34,
	.archive[class*="35"] .filter-group .term-35,
	.archive[class*="36"] .filter-group .term-36,
	.archive[class*="37"] .filter-group .term-37,
	.archive[class*="38"] .filter-group .term-38,
	.archive[class*="39"] .filter-group .term-39,
	.archive[class*="40"] .filter-group .term-40,
	.archive[class*="41"] .filter-group .term-41,
	.archive[class*="42"] .filter-group .term-42,
	.archive[class*="43"] .filter-group .term-43,
	.archive[class*="44"] .filter-group .term-44,
	.archive[class*="45"] .filter-group .term-45,
	.archive[class*="46"] .filter-group .term-46,
	.archive[class*="47"] .filter-group .term-47,
	.archive[class*="48"] .filter-group .term-48,
	.archive[class*="49"] .filter-group .term-49,
	.archive[class*="50"] .filter-group .term-50,
	.archive[class*="51"] .filter-group .term-51,
	.archive[class*="52"] .filter-group .term-52,
	.archive[class*="53"] .filter-group .term-53,
	.archive[class*="54"] .filter-group .term-54,
	.archive[class*="55"] .filter-group .term-55,
	.archive[class*="56"] .filter-group .term-56,
	.archive[class*="57"] .filter-group .term-57,
	.archive[class*="58"] .filter-group .term-58,
	.archive[class*="59"] .filter-group .term-59,
	.archive[class*="60"] .filter-group .term-60,
	.archive[class*="61"] .filter-group .term-61,
	.archive[class*="62"] .filter-group .term-62,
	.archive[class*="63"] .filter-group .term-63,
	.archive[class*="64"] .filter-group .term-64,
	.archive[class*="65"] .filter-group .term-65,
	.archive[class*="66"] .filter-group .term-66,
	.archive[class*="67"] .filter-group .term-67,
	.archive[class*="68"] .filter-group .term-68,
	.archive[class*="69"] .filter-group .term-69,
	.archive[class*="70"] .filter-group .term-70  { color:' . $theme_accent_color . '; }

	.cats,
	h1 a:hover,
	.logo a h1:hover,
	.tagcloud a:hover,
	nav ul li a:hover,
	.widget li a:hover,
	.entry-meta a:hover,
	.header-alt a:hover,
	.pagination a:hover,
	.post-after a:hover,
	.bean-tabs > li.active > a,
	.bean-panel-title > a:hover,
	.archives-list ul li a:hover,
	nav ul li.current-menu-item a,
	.bean-tabs > li.active > a:hover,
	.bean-tabs > li.active > a:focus,
	.bean-pricing-table .pricing-column li.info:hover {
		color:' . $theme_accent_color . '!important;
	}

	body button,
	body article .button a,
	body button[disabled]:hover,
	body button[disabled]:focus,
	body input[type="button"],
	body body.wp-autoresize .button a,
	body input[type="button"][disabled]:hover,
	body input[type="button"][disabled]:focus,
	body input[type="reset"],
	body input[type="reset"][disabled]:hover,
	body input[type="reset"][disabled]:focus,
	body input[type="submit"],
	body input[type="submit"][disabled]:hover,
	body input[type="submit"][disabled]:focus,
	.bean-btn,
	.tagcloud a,
	.bean-direction-nav a:hover,
	.bean-pricing-table .table-mast,
	.entry-categories a:hover {
		background-color:' . $theme_accent_color . ';
	}

	.bean-btn { border: 1px solid ' . $theme_accent_color . '!important; }
	.bean-quote { background-color:' . $theme_accent_color . '!important; }
	';

	/**
	 * Combine the values from above and minifiy them.
	 */
	$css_minified = $css;

	$css_minified = preg_replace( '#/\*.*?\*/#s', '', $css_minified );
	$css_minified = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $css_minified );
	$css_minified = preg_replace( '/\s\s+(.*)/', '$1', $css_minified );

	wp_add_inline_style( 'snazzy-style', wp_strip_all_tags( $css_minified ) );

}
add_action( 'wp_enqueue_scripts', 'snazzy_customizer_css' );
