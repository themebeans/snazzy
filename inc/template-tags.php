<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Snazzy
 * @link        https://themebeans.com/themes/snazzy
 */

if ( ! function_exists( 'snazzy_pagination' ) ) :
	/**
	 * Returns the pagination for index, search and archivial views.
	 *
	 * Checks if the Jetpack infinite-scroll module is activated.
	 * If not, use the standard the_posts_pagination function. Create your own
	 * snazzy_pagination() to override the the_posts_pagination function in a child theme.
	 *
	 * @see http://wptheming.com/2013/04/check-if-jetpack-modules-are-enabled/
	 * @see https://codex.wordpress.org/Function_Reference/the_posts_pagination
	 */
	function snazzy_pagination() {

		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) :
		else :
			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => esc_html__( 'Previous', 'snazzy' ),
					'next_text'          => esc_html__( 'Next', 'snazzy' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'snazzy' ) . ' </span>',
				)
			);

		endif;
	}
endif;



if ( ! function_exists( 'snazzy_comment_nav' ) ) :
	/**
	 * Display navigation to next/previous comments when applicable.
	 * Create your own snazzy_comment_nav() to override in a child theme.
	 */
	function snazzy_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'snazzy' ); ?></h2>
		<div class="nav-links">
			<?php
			if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'snazzy' ) ) ) :
				printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

			if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'snazzy' ) ) ) :
				printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php
		endif;
	}
endif;



if ( ! function_exists( 'snazzy_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function snazzy_post_thumbnail() {
		global $post;

		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if ( has_post_thumbnail() ) {
			echo '<div class="entry-media">';
		}

		$embed = get_post_meta( $post->ID, '_bean_post_embed', true );

		/*
	         * Check if this post is a video post format and an embed.
	         * If so, we just want to display the iframe, not the post thumbnail below.
	         */
		if ( has_post_format( 'video' ) && $embed ) :

			echo balanceTags( $embed );

			/*
			* Check if this post is an image post format and has a featured image.
			* If so, let's pull the image and a full version of it, and add a lightbox.
			*/
			elseif ( has_post_format( 'standard' ) || has_post_format( 'image' ) && has_post_thumbnail() ) :

				$src     = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );
				$src_lrg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'port-full' );

				echo '<a href="' . esc_html( $src_lrg[0] ) . '" class="lightbox-link" data-lity ><img src="' . esc_html( $src[0] ) . '"></a>';

			else :

				if ( ! has_post_thumbnail() ) {
					/*
					 * If there's no post thumbnail, we don't need to proceed.
					 */
					return;
				}

				snazzy_video_lightbox();

				if ( is_singular() ) :
			?>

					<div class="post-thumbnail">
						<?php the_post_thumbnail( 'post-thumbnail' ); ?>
					</div><!-- .post-thumbnail -->

					<?php else : ?>

				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
					<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
				</a>

			<?php
			endif;

		endif;

			if ( has_post_thumbnail() ) {
				echo '</div>';
			}

	}
endif;



if ( ! function_exists( 'snazzy_video_lightbox' ) ) :
	/**
	 * Display a video lightbox.
	 */
	function snazzy_video_lightbox() {

		global $post;

		/*
		 * Check if this is a post, post type, and if this is a video post format.
		 */
		if ( 'post' == get_post_type() and has_post_format( 'video' ) ) {

			/*
			 * Now let's check if there is an embed url. If so, let's show the "play" icon
			 * and add an lightbox iframe to display the video.
			 */
			$embed_url = get_post_meta( $post->ID, '_bean_post_embed_url', true );

			if ( $embed_url ) :
				printf( '<a href="%s" class="lightbox-link lightbox-play" data-lity></a>', esc_url( $embed_url ) );
			endif;
		}
	}
endif;



if ( ! function_exists( 'snazzy_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * Create your own snazzy_entry_meta() to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 */
	function snazzy_entry_meta() {
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			snazzy_entry_date();
		}

		if ( 'post' == get_post_type() ) {
			snazzy_entry_taxonomies();
		}

		if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			$allowed_html_array = array(
				'span' => array(),
			);

			echo '<span class="comments-link">';
				comments_popup_link( sprintf( wp_kses( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'snazzy' ), $allowed_html_array ), get_the_title() ) );
			echo '</span>';
		}
	}
endif;



if ( ! function_exists( 'snazzy_entry_date' ) ) :
	/**
	 * Print HTML with date information for current post.
	 *
	 * Create your own snazzy_entry_date() to override in a child theme.
	 */
	function snazzy_entry_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			esc_html_x( 'Posted on', 'Used before publish date.', 'snazzy' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
endif;



if ( ! function_exists( 'snazzy_entry_taxonomies' ) ) :
	/**
	 * Print HTML with category and tags for current post.
	 *
	 * Create your own snazzy_entry_taxonomies() to override in a child theme.
	 */
	function snazzy_entry_taxonomies() {
		$categories_list = get_the_category_list( esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'snazzy' ) );
		if ( $categories_list && snazzy_categorized_blog() ) {
			printf(
				'<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Categories', 'Used before category names.', 'snazzy' ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'snazzy' ) );
		if ( $tags_list ) {
			printf(
				'<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				esc_html_x( 'Tags', 'Used before tag names.', 'snazzy' ),
				$tags_list
			);
		}
	}
endif;



if ( ! function_exists( 'snazzy_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function snazzy_site_logo() {

		if ( has_custom_logo() ) {

			echo '<div class="site-logo" itemscope itemtype="http://schema.org/Organization">';
				the_custom_logo();
			echo '</div>';
			?>

		<?php } else { ?>
			<h1 class="site-title" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
}
	}

endif;



if ( ! function_exists( 'snazzy_picturefill' ) ) :
	/**
	 * Utilizes picturefill.js to serve specific image assets where it makes sense to.
	 * Create your own snazzy_picturefill() to override in a child theme.
	 */
	function snazzy_picturefill( $post_id ) {
		$feat_image        = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'port-grid' );
		$feat_image_2x     = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'port-grid@2x' );
		$feat_image_mobile = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'port-grid-mobile' );

		echo '<span class="project-img" data-picture data-alt="' . esc_attr( get_the_title( $post_id ) ) . '">';
		echo '<span data-src="' . esc_html( $feat_image[0] ) . '"></span>';
		echo '<span data-src="' . esc_html( $feat_image_mobile[0] ) . '" data-media="(max-width: 414px)"></span>';
		echo '<span data-src="' . esc_html( $feat_image_2x[0] ) . '" data-media="(min-device-pixel-ratio: 2.0),(-webkit-min-device-pixel-ratio: 2),(min--moz-device-pixel-ratio: 2),(-o-min-device-pixel-ratio: 2/1),(min-device-pixel-ratio: 2),(min-resolution: 192dpi),(min-resolution: 2dppx)"></span>';
		echo '<span data-src="' . esc_html( $feat_image[0] ) . '" data-media="(max-width : 414px) and (-webkit-device-pixel-ratio: 2)"></span>';
		echo '<noscript><img src="' . esc_html( $feat_image[0] ) . '" alt="' . esc_attr( get_the_title( $post_id ) ) . '"></noscript>';
		echo '</span>';
	}
endif;



if ( ! function_exists( 'snazzy_gallery' ) ) :
	/**
	 * Return the portfolio and post galleries.
	 *
	 * Checks if there are images uploaded to the post or portfolio post and outputs them.
	 * Create your own snazzy_gallery() to override in a child theme.
	 *
	 * @param  string $postid The post id.
	 * @param  array  $imagesize The size of the thumbnails.
	 */
	function snazzy_gallery( $postid, $imagesize ) {

		$thumb_id         = get_post_thumbnail_id( $postid );
		$image_ids_raw    = get_post_meta( $postid, '_bean_image_ids', true );
		$embed            = get_post_meta( $postid, '_bean_portfolio_embed_code', true );
		$embed2           = get_post_meta( $postid, '_bean_portfolio_embed_code_2', true );
		$embed3           = get_post_meta( $postid, '_bean_portfolio_embed_code_3', true );
		$embed4           = get_post_meta( $postid, '_bean_portfolio_embed_code_4', true );
		$video_shortcodes = get_post_meta( $postid, '_bean_portfolio_video_shortcodes', true );

		wp_reset_postdata();

		if ( '' !== $image_ids_raw ) {
			$image_ids   = explode( ',', $image_ids_raw );
			$post_parent = null;
		} else {
			$image_ids   = '';
			$post_parent = $postid;
		}

		$i = 1;

		$args = array(
			'exclude'        => $thumb_id,
			'include'        => $image_ids,
			'orderby'        => 'post__in',
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => $post_parent,
			'post_mime_type' => 'image',
			'post_status'    => null,
		);

		$attachments = get_posts( $args );
		?>

		<div class="project-assets">

			<?php
			if ( ! post_password_required() ) {

				$allowed_iframe_html_array = array(
					'iframe' => array(
						'src'                   => array(),
						'height'                => array(),
						'width'                 => array(),
						'frameborder'           => array(),
						'webkitallowfullscreen' => array(),
						'mozallowfullscreen'    => array(),
						'allowfullscreen'       => array(),
					),
				);

				if ( $embed ) {
					echo '<figure class="video-frame">';
						echo wp_kses( $embed, $allowed_iframe_html_array );
					echo '</figure>';
				}

				if ( $embed2 ) {
					echo '<figure class="video-frame">';
						echo wp_kses( $embed2, $allowed_iframe_html_array );
					echo '</figure>';
				}

				if ( $embed3 ) {
					echo '<figure class="video-frame">';
						echo wp_kses( $embed3, $allowed_iframe_html_array );
					echo '</figure>';
				}

				if ( $embed4 ) {
					echo '<figure class="video-frame">';
						echo wp_kses( $embed4, $allowed_iframe_html_array );
					echo '</figure>';
				}

				if ( $video_shortcodes ) {
					echo '<figure class="video-frame">';
						echo do_shortcode( $video_shortcodes );
					echo '</figure>';
				}
			}
			?>

			<div itemscope itemtype="http://schema.org/ImageGallery" class="
			<?php
			if ( get_theme_mod( 'portfolio_lazyload', true ) === true ) {
				echo 'lazy-load'; }
				?>
				">

				<?php
				if ( ! empty( $attachments ) ) {

					if ( ! post_password_required() ) {

						foreach ( $attachments as $attachment ) {

							$caption = $attachment->post_excerpt;
							$caption = ( $caption ) ? "$caption" : '';
							$alt     = ( ! empty( $attachment->post_content ) ) ? $attachment->post_content : $attachment->post_title;
							$src     = wp_get_attachment_image_src( $attachment->ID, $imagesize );

							$allowed_html_array = array(
								'span'   => array(
									'class' => array(),
								),
								'b'      => array(
									'class' => array(),
								),
								'a'      => array(
									'href' => array(),
								),
								'i'      => array(),
								'em'     => array(),
								'strong' => array(),
							);
							?>

							<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">

								<?php
								if ( true === get_theme_mod( 'portfolio_lightbox', true ) ) {
									echo '<a href="' . esc_url( $src[0] ) . '" class="lightbox-link" title="' . wp_kses( $caption, $allowed_html_array ) . '" alt="' . esc_attr( $alt ) . '" itemprop="contentUrl" data-size="' . esc_attr( $src[1] ) . 'x' . esc_attr( $src[2] ) . '">';
								}

								if ( true === get_theme_mod( 'portfolio_lazyload', true ) ) {
									echo '<img data-src="' . esc_url( $src[0] ) . '" class="lazy-img" alt=""/>';
									echo '<noscript>';
									echo '<img src="' . esc_url( $src[0] ) . '"/>';
									echo '</noscript>';
								} else {
									echo '<img src="' . esc_url( $src[0] ) . '"/>';
								}

								if ( true === get_theme_mod( 'portfolio_lightbox', true ) ) {
									echo '</a>'; }

								if ( $caption ) {
									echo '<div class="project-caption">' . wp_kses( $caption, $allowed_html_array ) . '</div>';
								}
								?>

							</figure>

							<?php
						}
					}
				}
				?>

			</div>
		</div>
	<?php
	}
endif;

if ( ! function_exists( 'snazzy_site_map' ) ) :
	/**
	 * Prints HTML containing the site map.
	 * This function is currently pulled by content-page.php, which checks if
	 * the Site Map template (template-site-map.php) is in use.
	 * Create your own snazzy_site_map() to override in a child theme.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_pages
	 */

	function snazzy_site_map() {
		if ( is_singular() && 'page' == get_post_type() ) {

			printf( '<ul class="site-archive">' );
			printf( esc_html( wp_list_pages( 'title_li=' ) ) );
			printf( '</ul>' );

		}
	}
endif;



if ( ! function_exists( 'snazzy_site_archive' ) ) :
	/**
	 * Prints HTML containing the site archives by month, year and category.
	 * This function is currently pulled by content-page.php, which checks if
	 * the Archive template (template-archive.php) is in use.
	 * Create your own snazzy_site_archive() to override in a child theme.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_get_archives
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_categories
	 */

	function snazzy_site_archive() {
		if ( is_singular() && 'page' == get_post_type() ) {

			printf( '<div class="site-archive">' );
			printf( '<p>%s</p>', esc_html( 'Monthly', 'snazzy' ) );
			printf(
				'<ul>%s</ul>', wp_get_archives(
					array(
						'type'  => 'monthly',
						'limit' => 10,
					)
				)
			);
			printf( '<p>%s</p>', esc_html( 'Yearly', 'snazzy' ) );
			printf(
				'<ul>%s</ul>', wp_get_archives(
					array(
						'type'  => 'yearly',
						'limit' => 10,
					)
				)
			);
			printf( '<p>%s</p>', esc_html( 'Categories', 'snazzy' ) );
			printf(
				'<ul>%s</ul>', wp_list_categories( 'title_li=' )
			);
			printf( '</div>' );

		}
	}
endif;



/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function snazzy_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'snazzy_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'snazzy_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so snazzy_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so snazzy_categorized_blog should return false.
		return false;
	}
}



/**
 * Flush out the transients used in { @see snazzy_categorized_blog() }.
 */
function snazzy_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'snazzy_categories' );
}
add_action( 'edit_category', 'snazzy_category_transient_flusher' );
add_action( 'save_post', 'snazzy_category_transient_flusher' );
