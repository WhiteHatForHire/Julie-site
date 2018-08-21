jQuery(function( $ ) {
	'use strict';

	var $body = $('body');

	/* -----------------------------------------
	Responsive Menus Init with mmenu
	----------------------------------------- */
	var $mainNav   = $( '.navigation' );
	var $mobileNav = $( '#mobilemenu' );

	$mainNav.clone().removeAttr( 'id' ).removeClass().appendTo( $mobileNav );
	$mobileNav.find( 'li' ).removeAttr( 'id' );

	$mobileNav.mmenu({
		offCanvas: {
			position: 'top',
			zposition: 'front'
		},
		"autoHeight": true,
		"navbars": [
			{
				"position": "top",
				"content": [
					"prev",
					"title",
					"close"
				]
			}
		]
	});

	/* -----------------------------------------
	Main Navigation Init
	----------------------------------------- */
	$mainNav.superfish({
		delay: 300,
		animation: { opacity: 'show', height: 'show' },
		speed: 'fast',
		dropShadows: false
	});

	/* -----------------------------------------
	Header search bar hide/show and head cart
	----------------------------------------- */
	var $searchTrigger = $('.main-search-trigger');
	var $headSearch = $('.header-search-wrap');
	var $cartToggle = $('.cart-dropdown-toggle');
	var $headCart = $cartToggle.parent();

	$cartToggle.on('click', function(e) {
		e.preventDefault();

		var $this = $(this);
		$this.parent().toggleClass('cart-dropdown-open');
	});

	$searchTrigger.on('click', function(e) {
		e.preventDefault();
		$headSearch.toggleClass('searchform-visible');
		if ( $headSearch.hasClass('searchform-visible') ) {
			$headSearch.find('input').focus();
		}
	});

	document.onkeydown = function(e) {
		e = e || window.e;
		if ( e.keyCode === 27 && $headSearch.hasClass('searchform-visible') ) {
			$headSearch.removeClass('searchform-visible');
		}
	};

	$body.on('click', function() {
		if ( $headSearch.hasClass('searchform-visible') ) {
			$headSearch.removeClass('searchform-visible');
		}

		if ( $headCart.hasClass('cart-dropdown-open') ) {
			$headCart.removeClass('cart-dropdown-open');
		}
	}).find('.searchform, .main-search-trigger, .cart-dropdown').on('click', function(e) {
		e.stopPropagation();
	});


	/* -----------------------------------------
	 Instagram Widget
	 ----------------------------------------- */
	var $instagramWidget = $('section').find('.instagram-pics');
	var $instagramWrap = $instagramWidget.parent('div');

	if ( $instagramWidget.length ) {
		var auto = $instagramWrap.data('auto'),
			speed = $instagramWrap.data('speed');

		$instagramWidget.slick({
			slidesToShow: 6,
			slidesToScroll: 1,
			arrows: false,
			autoplay: auto === 1,
			speed: speed,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 4
					}
				}
			]
		});
	}

	/* -----------------------------------------
	Slick Slider Homepage
	----------------------------------------- */
	var $slickSlider = $('.home-full-slider');
	if ( $slickSlider.length ) {
		var slideshow      = $slickSlider.data( 'slideshow' );
		var slideshowspeed = $slickSlider.data( 'slideshowspeed' );

		$slickSlider.slick({
			autoplay: slideshow == 1,
			autoplaySpeed: slideshowspeed,
			centerMode: true,
			centerPadding: '30px',
			slidesToShow: 1,
			variableWidth: true,
			arrows: false,
			responsive: [
				{
					breakpoint: 1200,
					settings: {
						variableWidth: false
					}
				},
				{
					breakpoint: 768,
					settings: {
						centerMode: false,
						variableWidth: false,
						centerPadding: '5px'
					}
				}
			]
		});
	}

	/* -----------------------------------------
	Responsive Videos with fitVids
	----------------------------------------- */
	$body.fitVids();

	/* -----------------------------------------
	Image Lightbox
	----------------------------------------- */
	$( ".ci-lightbox, a[data-lightbox^='gal']" ).magnificPopup({
		type: 'image',
		mainClass: 'mfp-with-zoom',
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true
		}
	} );
	
	$( window ).on( 'load', function() {
		/* -----------------------------------------
		Masonry Layout
		----------------------------------------- */
		var $masonry = $('.row-masonry');
		if ( $masonry.length ) {
			var grid = $masonry.isotope({
				layoutMode: 'masonry'
			});
		}

		/* -----------------------------------------
		FlexSlider Init
		----------------------------------------- */
		var $mainSlider = $( '.ci-main-slider' ).not( '.home-full-slider' );

		if ( $mainSlider.length ) {
			$mainSlider.flexslider({
				slideshow     : $mainSlider.data( 'slideshow' ),
				slideshowSpeed: $mainSlider.data( 'slideshowspeed' ),
				animationSpeed: $mainSlider.data( 'animationspeed' ),
				namespace: 'ci-',
				directionNav: false,
				controlNav: false,
				prevText: '',
				nextText: '',
				start: function( slider ) {
					slider.removeClass( 'loading' );
				}
			});
		}

		/**
		 * Slide custom control interface
		 *
		 * @param $slider slider jQuery object
		 * @param {string} direction next|prev
		 */
		var slide = function($slider, direction) {
			if ( $slider.hasClass('ci-slider') ) {
				$slider.flexslider(direction);
			} else if ( $slider.hasClass('home-full-slider') ) {
				if ( direction === 'next' ) {
					$slider.slick('slickNext');
				} else {
					$slider.slick('slickPrev');
				}
			}
		};

		var $slideControl = $( '.entry-slide-control' ).find( 'a' );
		$slideControl.on( 'click', function( e ) {
			e.preventDefault();
			var $this = $(this);
			var $slider = $this.parents( '.ci-main-slider' );

			if ( $this.hasClass( 'entry-slide-prev' ) ) {
				slide( $slider, 'prev' );
			} else {
				slide( $slider, 'next' );
			}
		});
	});
});
