<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

if ( ! defined( 'SNAZZY_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'SNAZZY_DEBUG', true );
endif;

if ( ! defined( 'SNAZZY_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'SNAZZY_DEBUG' ) || true === SNAZZY_DEBUG ) {
		define( 'SNAZZY_ASSET_SUFFIX', null );
	} else {
		define( 'SNAZZY_ASSET_SUFFIX', '.min' );
	}
endif;

if ( ! function_exists( 'snazzy_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function snazzy_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Snazzy, use a find and replace
		 * to change 'snazzy' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'snazzy', get_theme_file_path( '/languages' ) );

		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Filter Snazzy's custom-background support argument.
		 */
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 140, 140, true );
		add_image_size( 'sml-thumbnail', 50, 50, true );
		add_image_size( 'post-thumbnail', 750, 9999, false );
		add_image_size( 'port-full', 9999, 9999, false );
		add_image_size( 'port-grid', 500, 9999 );
		add_image_size( 'port-grid@2x', 1000, 9999 );
		add_image_size( 'port-grid-mobile', 375, 9999 );

		/*
		 * This theme uses wp_nav_menu() in the following locations.
		 */
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'snazzy' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats', array(
				'video',
				'image',
			)
		);

		/*
		 * Enable support for the WordPress default Theme Logo
		 * See: https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo', array(
				'height'      => 200,
				'width'       => 300,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style.
		 */
		add_editor_style( array( 'assets/css/editor' . SNAZZY_ASSET_SUFFIX . '.css', snazzy_fonts_url() ) );

		/*
		 * Enable support for Customizer Selective Refresh.
		 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Define starter content for the theme.
		 * See: https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
		 */
		$starter_content = array(

			'options'     => array(
				'show_on_front'   => 'page',
				'page_on_front'   => '{{home}}',
				'page_for_posts'  => '{{blog}}',
				'blogname'        => _x( 'Snazzy', 'Theme starter content', 'snazzy' ),
				'blogdescription' => _x( 'A snazzy portfolio WordPress theme by ThemeBeans', 'Theme starter content', 'snazzy' ),
			),

			'posts'       => array(
				'about',
				'contact',
				'blog',
				'home' => array(
					'post_type'    => 'page',
					'post_title'   => _x( 'Portfolio', 'Theme starter content', 'snazzy' ),
					'post_content' => '',
				),
			),

			'attachments' => array(
				'image-logo' => array(
					'post_title' => _x( 'Logo', 'Theme starter content', 'snazzy' ),
					'file'       => 'inc/customizer/images/logo.png',
				),
			),

			'theme_mods'  => array(
				'custom_logo'           => '{{image-logo}}',
				'custom_logo_max_width' => '40',
				'contact_button'        => _x( 'Send Message', 'Theme starter content', 'snazzy' ),
			),

			// Set up nav menus for each of the two areas registered in the theme.
			'nav_menus'   => array(
				// Assign a menu to the "primary" location.
				'primary' => array(
					'name'  => __( 'Top Menu', 'snazzy' ),
					'items' => array(
						'page_about',
						'page_blog',
						'page_contact',
					),
				),
			),
		);

		/**
		 * Filters @@pkg.name array of starter content.
		 *
		 * @since @@pkg.name 1.0
		 *
		 * @param array $starter_content Array of starter content.
		 */
		$starter_content = apply_filters( 'snazzy_starter_content', $starter_content );

		add_theme_support( 'starter-content', $starter_content );
	}
	endif;
add_action( 'after_setup_theme', 'snazzy_setup' );

/**
 * Checks to see if we're on the homepage or not.
 */
function snazzy_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function snazzy_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'snazzy_front_page_template' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function snazzy_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'snazzy_content_width', 750 );
}
add_action( 'after_setup_theme', 'snazzy_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function snazzy_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Theme Sidebar', 'snazzy' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Appears site-wide in the header block.', 'snazzy' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);
}
add_action( 'widgets_init', 'snazzy_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function snazzy_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'snazzy-fonts', snazzy_fonts_url(), array(), null );

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'snazzy-style', get_parent_theme_file_uri( '/style' . SNAZZY_ASSET_SUFFIX . '.css' ) );
		wp_enqueue_style( 'snazzy-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'snazzy-style', get_theme_file_uri( '/style' . SNAZZY_ASSET_SUFFIX . '.css' ) );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( SCRIPT_DEBUG || SNAZZY_DEBUG ) {
		// Vendor scripts.
		wp_enqueue_script( 'picturefill', get_theme_file_uri( '/assets/js/vendors/picturefill.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'unveil', get_theme_file_uri( '/assets/js/vendors/unveil.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'isotope', get_theme_file_uri( '/assets/js/vendors/isotope.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'infinitescroll', get_theme_file_uri( '/assets/js/vendors/infinitescroll.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'fitvids', get_theme_file_uri( '/assets/js/vendors/fitvids.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'snazzy-photoswipe', get_theme_file_uri( '/assets/js/vendors/photoswipe.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'snazzy-photoswipe-ui', get_theme_file_uri( '/assets/js/vendors/photoswipe-ui-default.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'lity', get_theme_file_uri( '/assets/js/vendors/lity.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Custom scripts.
		wp_enqueue_script( 'snazzy-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'snazzy-imagesloaded', get_theme_file_uri( '/assets/js/vendors/images-loaded.js' ), array( 'jquery' ), '@@pkg.version', true );

	} else {
		wp_enqueue_script( 'snazzy-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'snazzy-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load the contact and comment form validation scripts.
	if ( is_page_template( 'template-contact.php' ) ) {
		wp_enqueue_script( 'validation', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array( 'jquery' ), '@@pkg.version', true );
	}
}
add_action( 'wp_enqueue_scripts', 'snazzy_scripts' );


/**
 * Remove the duplicate stylesheet enqueue for older versions of the child theme.
 *
 * Since v3.2.3 @@pkg.name has a built-in auto-loader for loading the appropriate
 * parent theme stylesheet, without the need for a wp_enqueue_scripts function within
 * the child theme. This means that stylesheets will "just work" and there's less chance
 * that users will accidently disrupt stylesheet loading.
 */
function snazzy_remove_duplicate_child_parent_enqueue_scripts() {
	remove_action( 'wp_enqueue_scripts', 'snazzy_child_scripts', 10 );
}
add_action( 'init', 'snazzy_remove_duplicate_child_parent_enqueue_scripts' );


if ( ! function_exists( 'snazzy_fonts_url' ) ) :
	/**
	 * Register Google fonts for Snazzy.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function snazzy_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = '';

		/* translators: If there are characters in your language that are not supported by Karla, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== esc_html_x( 'on', 'Karla font: on or off', 'snazzy' ) ) {
			$fonts[] = 'Karla';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family' => rawurlencode( implode( '|', $fonts ) ),
					'subset' => rawurlencode( $subsets ),
				), 'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array  $urls        URLs to print for resource hints.
 * @param  string $relation_type  The relation type the URLs are printed.
 * @return array  $urls        URLs to print for resource hints.
 */
function snazzy_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'snazzy-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'snazzy_resource_hints', 10, 2 );

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function snazzy_enqueue_admin_style() {
	wp_enqueue_style( 'snazzy-admin', get_theme_file_uri( '/assets/css/admin-style.css' ), false, '@@pkg.version', 'all' );
}
add_action( 'admin_enqueue_scripts', 'snazzy_enqueue_admin_style' );

/**
 * Enqueue a script in the WordPress admin, for edit.php, post.php and post-new.php.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function snazzy_enqueue_admin_script( $hook ) {
	if ( 'edit.php' !== $hook ) {
		wp_enqueue_script( 'snazzy-post-meta', get_theme_file_uri( '/assets/js/admin/post-meta.js' ), array( 'jquery' ), '@@pkg.version', true );
	}
}
add_action( 'admin_enqueue_scripts', 'snazzy_enqueue_admin_script' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function snazzy_body_classes( $classes ) {
	global $post;

	// Adds a class of post-thumbnail to pages with post thumbnails for hero areas.
	if ( is_customize_preview() ) {
		$classes[] = 'is-customize-preview';
	}

	// Add a class on the front page.
	if ( snazzy_is_frontpage() ) {
		$classes[] = 'is-snazzy-home';
	}

	return $classes;
}
add_filter( 'body_class', 'snazzy_body_classes' );

if ( ! function_exists( 'snazzy_get_post_views' ) ) :
	/**
	 * Loop by post view count.
	 * Create your own snazzy_get_post_views() to override in a child theme.
	 */
	function snazzy_get_post_views( $post_id ) {
		$count_key = 'post_views_count';
		$count     = get_post_meta( $post_id, $count_key, true );

		if ( '' == $count ) {
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );
			return '0';
		}

		return $count;
	}
endif;

if ( ! function_exists( 'snazzy_set_post_views' ) ) :
	/**
	 * Output the view count.
	 * Create your own snazzy_set_post_views() to override in a child theme.
	 */
	function snazzy_set_post_views( $post_id ) {
		$count_key = 'post_views_count';
		$count     = get_post_meta( $post_id, $count_key, true );

		if ( '' == $count ) {
			$count = 0;
			delete_post_meta( $post_id, $count_key );
			add_post_meta( $post_id, $count_key, '0' );
		} else {
			$count++;
			update_post_meta( $post_id, $count_key, $count );
		}
	}
endif;

if ( ! function_exists( 'snazzy_protected_title_format' ) ) :
	/**
	 * Filter the text prepended to the post title for protected posts.
	 * Create your own snazzy_protected_title_format() to override in a child theme.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/protected_title_format/
	 */
	function snazzy_protected_title_format( $title ) {
		return '%s';
	}
	add_filter( 'protected_title_format', 'snazzy_protected_title_format' );
endif;

if ( ! function_exists( 'snazzy_protected_form' ) ) :
	/**
	 * Filter the HTML output for the protected post password form.
	 * Create your own snazzy_protected_form() to override in a child theme.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/the_password_form/
	 * @link https://codex.wordpress.org/Using_Password_Protection
	 */
	function snazzy_protected_form() {
		global $post;

		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

		$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<label for="' . $label . '">' . esc_html__( 'Password:', 'snazzy' ) . ' </label><input name="post_password" placeholder="' . esc_html__( 'Enter password here & press enter...', 'snazzy' ) . '" type="password" placeholder=""/><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'snazzy' ) . '" />
		</form>
		';

		return $o;
	}
	add_filter( 'the_password_form', 'snazzy_protected_form' );
endif;

if ( ! function_exists( 'snazzy_comments' ) ) :
	/**
	 * Define custom callback for comment output.
	 * Based strongly on the output from Twenty Sixteen.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
	 * @link https://wordpress.org/themes/twentysixteen/
	 *
	 * Create your own snazzy_comments() to override in a child theme.
	 */
	function snazzy_comments( $comment, $args, $depth ) {

		global $post;

		$GLOBALS['comment'] = $comment;
		extract( $args, EXTR_SKIP );

		if ( 'div' == $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}

		$allowed_html_array = array(
			'a'      => array(
				'href'  => array(),
				'title' => array(),
			),
			'br'     => array(),
			'cite'   => array(),
			'em'     => array(),
			'strong' => array(),
		);
		?>

		<<?php echo esc_html( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">

		<?php if ( 'div' != $args['style'] ) : ?>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		<?php endif; ?>

			<footer class="comment-meta">

				<div class="comment-author vcard">
					<div class="avatar-wrapper">
						<?php
						if ( $args['avatar_size'] != 0 ) {
							echo get_avatar( $comment, $args['avatar_size'] );}
?>
					</div>

					<div class="comment-metadata">

						<?php printf( wp_kses( __( '<cite class="fn">%s</cite> ', 'snazzy' ), $allowed_html_array ), get_comment_author_link() ); ?>

						<span class="comment-date">
							<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
							/* translators: 1: date, 2: time */
							printf( esc_html__( '%1$s at %2$s', 'snazzy' ), get_comment_date(), get_comment_time() );
							?>
							</a>
							<?php
							edit_comment_link( __( 'Edit', 'snazzy' ), '', '' );

							comment_reply_link(
								array_merge(
									$args, array(
										'add_below' => $add_below,
										'depth'     => $depth,
										'max_depth' => $args['max_depth'],
									)
								)
							);
?>
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<span class="comment-awaiting-moderation"><?php esc_html_e( 'Awaiting moderation', 'snazzy' ); ?></span>
							<?php endif; ?>
						</span>
					</div>

				</div>

			</footer>

			<div class="comment-content">
				<?php comment_text(); ?>
			</div>

		<?php if ( 'div' != $args['style'] ) : ?>
			</article>
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'snazzy_comment_submit_button' ) ) :
	/**
	 * Filter the value of the comments submit button on single posts and pages.
	 * Create your own snazzy_comment_submit_button() to override in a child theme.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/comment_form_submit_button/
	 */
	function snazzy_comment_submit_button( $button ) {
		$button = '<input name="submit" type="submit" class="form-submit" value="' . __( 'Submit', 'snazzy' ) . '" />';
		return $button;
	}
	add_filter( 'comment_form_submit_button', 'snazzy_comment_submit_button' );
endif;

if ( ! function_exists( 'snazzy_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function snazzy_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'snazzy_pingback_header' );
endif;

/**
 * Post meta.
 */
if ( is_admin() ) {
	require get_theme_file_path( '/inc/meta/meta.php' );
	require get_theme_file_path( '/inc/meta/meta-post.php' );
	require get_theme_file_path( '/inc/meta/meta-portfolio.php' );
}

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/sanitization.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Load Jetpack compatibility file.
 */
require get_theme_file_path( '/inc/jetpack.php' );

/**
 * Load editor formats.
 */
require get_theme_file_path( '/inc/editor-formats.php' );

/**
 * Add Widgets.
 */
require get_theme_file_path( '/inc/widgets/widget-flickr.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}

/**
 * Disable Merlin WP.
 */
function themebeans_merlin() {}
