/**
 * Theme javascript functions file.
 *
 */
( function( $ ) {
	"use strict";

	var
	body	   	= $("body"),
	loaded	 	= ("js--loaded"),
	animating  	= ("js--animating"),
	active	 	= ("js--active");

	/**
	 * Removes "no-js" and adds "js" classes to the body tag.
	 */
	(function(html){html.className = html.className.replace(/\bno-js\b/,'js');})(document.documentElement);

	/**
	 * Test if inline SVGs are supported.
	 * @link https://github.com/Modernizr/Modernizr/
	 */
	function supportsInlineSVG() {
		var div = document.createElement( 'div' );
		div.innerHTML = '<svg/>';
		return 'http://www.w3.org/2000/svg' === ( 'undefined' !== typeof SVGRect && div.firstChild && div.firstChild.namespaceURI );
	}

	/* FitVids */
	$( 'body' ).fitVids();

	$( document ).ready( function() {

		supportsInlineSVG();

		if ( true === supportsInlineSVG() ) {
			document.documentElement.className = document.documentElement.className.replace( /(\s*)no-svg(\s*)/, '$1svg$2' );
		}

		/* Validation */
		if ( jQuery().validate ) {
			jQuery("#commentform").validate();
		}

		/* Project Lazy Loading */
		if( body.hasClass('single-portfolio') ) {
			$(".lazy-load img").unveil(25, function() {
				$(this).load(function() {
					this.style.opacity = 1;
				});
			});
		}

		/* Enable menu toggle for small screens */
		$( '.mobile-menu-toggle' ).on( 'click', function() {
			body.toggleClass( active );

			if ( body.hasClass( animating ) ) {
				setTimeout(function() {
					body.removeClass( animating );
				}, 400);
			} else {
				body.addClass( animating );
			}
		} );

	});

	/* Portfolio Isotope */
	function isotope() {

		var container = $( '#projects' );

		container.imagesLoaded( function(){

			container.isotope({
				transitionDuration: '0.2s',
				itemSelector: '.project',
		 		resizesContainer: true,
		 		isResizeBound: true,
		 		layoutMode: 'masonry',
		 		getSortData: {
					 views: '[data-views]',
					 date: '[data-date]',
				},
				sortAscending: {
					views: false,
					date: false,
				},
				hiddenStyle: {
					opacity: 0
				},
				visibleStyle: {
					opacity: 1
				}
			});

			container.isotope();


			if ( body.is( '.post-type-archive-portfolio, .is-snazzy-home' ) ) {
				/* Portfolio Filtering */
				$( '.filter-group a' ).on( 'click', function(e) {
					var
					d = $(this),
					b = d.attr('data-filter'),
					c = $(".filter-group a");

					e.preventDefault();
					container.isotope({ filter: b });
					c.removeClass(active);
					jQuery(this).addClass(active);
					return false;
				});

				/* Portfolio Sorting */
				$('.sort-group a').on( 'click', function(e) {
					var
					d = $(this),
					b = d.attr('data-sort-by'),
					c = $(".sort-group a");

					e.preventDefault();
					container.isotope({ sortBy: b });
					c.removeClass(active);
					jQuery(this).addClass(active);
				});

				/* Portfolio Random Suffle */
				$('.shuffle-btn').on( 'click', function() {
					container.isotope('shuffle');
				});

			}

			/* Portfolio Infinite scrolling */
			container.infinitescroll({
				navSelector  : '#page_nav',
				nextSelector : '#page_nav a',
				itemSelector : '#projects .project',
				loading: {
					loadingText: 'Loading',
					finishedMsg: 'Done Loading',
					img: ''
				}
			},
			function( newElements ) {
				var  newElems = $( newElements ).css({ opacity: 0 });
					picturefill();
					newElems.imagesLoaded(function(){
						newElems.animate({ opacity: 1 });
						container.isotope( 'appended', newElems );
					});
				});
		});

	}

	$(window).load(function() {
		isotope();
	});

} )( jQuery );
