/**
 Core layout handlers and component wrappers
 **/

// BEGIN: Layout Brand
var LayoutBrand = function () {

	return {
		//main function to initiate the module
		init: function () {
			$('body').on('click', '.c-hor-nav-toggler', function () {
				var target = $(this).data('target');
				$(target).toggleClass("c-shown");
			});
		}

	};
}();
// END

// BEGIN: Layout Brand
var LayoutHeaderCart = function () {

	return {
		//main function to initiate the module
		init: function () {
			var cart = $('.c-cart-menu');

			if (cart.size() === 0) {
				return;
			}

			if (App.getViewPort().width < App.getBreakpoint('md')) { // mpbile mode
				$('body').on('click', '.c-cart-toggler', function (e) {
					e.preventDefault();
					e.stopPropagation();
					$('body').toggleClass("c-header-cart-shown");
				});

				$('body').on('click', function (e) {
					if (!cart.is(e.target) && cart.has(e.target).length === 0) {
						$('body').removeClass('c-header-cart-shown');
					}
				});
			} else { // desktop
				$('body').on('hover', '.c-cart-toggler, .c-cart-menu', function (e) {
					$('body').addClass("c-header-cart-shown");
				});

				$('body').on('hover', '.c-mega-menu > .navbar-nav > li:not(.c-cart-toggler-wrapper)', function (e) {
					$('body').removeClass("c-header-cart-shown");
				});

				$('body').on('mouseleave', '.c-cart-menu', function (e) {
					$('body').removeClass("c-header-cart-shown");
				});
			}
		}
	};
}();
// END

// BEGIN: Layout Header
var LayoutHeader = function () {
	var offset = parseInt($('.c-layout-header').attr('data-minimize-offset') > 0 ? parseInt($('.c-layout-header').attr('data-minimize-offset')) : 0);
	var _handleHeaderOnScroll = function () {
		if ($(window).scrollTop() > offset) {
			$("body").addClass("c-page-on-scroll");
		} else {
			$("body").removeClass("c-page-on-scroll");
		}
	}

	var _handleTopbarCollapse = function () {
		$('.c-layout-header .c-topbar-toggler').on('click', function (e) {
			$('.c-layout-header-topbar-collapse').toggleClass("c-topbar-expanded");
		});
	}

	return {
		//main function to initiate the module
		init: function () {
			if ($('body').hasClass('c-layout-header-fixed-non-minimized')) {
				return;
			}

			_handleHeaderOnScroll();
			_handleTopbarCollapse();

			$(window).scroll(function () {
				_handleHeaderOnScroll();
			});
		}
	};
}();
// END

// BEGIN: Layout Mega Menu
var LayoutMegaMenu = function () {

	return {
		//main function to initiate the module
		init: function () {
			$('.c-mega-menu').on('click', '.c-toggler', function (e) {
				if (App.getViewPort().width < App.getBreakpoint('md')) {
					e.preventDefault();
					if ($(this).closest("li").hasClass('c-open')) {
						$(this).closest("li").removeClass('c-open');
					} else {
						$(this).closest("li").addClass('c-open');
					}
				}
			});

			$('.c-layout-header .c-hor-nav-toggler:not(.c-quick-sidebar-toggler)').on('click', function () {
				$('.c-layout-header').toggleClass('c-mega-menu-shown');

				if ($('body').hasClass('c-layout-header-mobile-fixed')) {
					var height = App.getViewPort().height - $('.c-layout-header').outerHeight(true) - 60;
					$('.c-mega-menu').css('max-height', height);
				}
			});
		}
	};
}();
// END

// BEGIN: Layout Mega Menu
var LayoutSidebarMenu = function () {

	return {
		//main function to initiate the module
		init: function () {
			$('.c-layout-sidebar-menu > .c-sidebar-menu .c-toggler').on('click', function (e) {
				e.preventDefault();
                $(this).closest('.c-dropdown').toggleClass('c-open').siblings().removeClass('c-open');
			});
		}
	};
}();
// END

// BEGIN: Layout Mega Menu
var LayoutQuickSearch = function () {

	return {
		//main function to initiate the module
		init: function () {
			// desktop mode
			$('.c-layout-header').on('click', '.c-mega-menu .c-search-toggler', function (e) {
				e.preventDefault();

				$('body').addClass('c-layout-quick-search-shown');

				if (App.isIE() === false) {
					$('.c-quick-search > .form-control').focus();
				}
			});

			// mobile mode
			$('.c-layout-header').on('click', '.c-brand .c-search-toggler', function (e) {
				e.preventDefault();

				$('body').addClass('c-layout-quick-search-shown');

				if (App.isIE() === false) {
					$('.c-quick-search > .form-control').focus();
				}
			});

			// handle close icon for mobile and desktop
			$('.c-quick-search').on('click', '> span', function (e) {
				e.preventDefault();
				$('body').removeClass('c-layout-quick-search-shown');
			});
		}
	};
}();
// END

var LayoutCartMenu = function () {

	return {
		//main function to initiate the module
		init: function () {
			// desktop mode
			$('.c-layout-header').on('mouseenter', '.c-mega-menu .c-cart-toggler-wrapper', function (e) {
				e.preventDefault();

				$('.c-cart-menu').addClass('c-layout-cart-menu-shown');

			});

			$('.c-cart-menu, .c-layout-header').on('mouseleave', function (e) {
				e.preventDefault();

				$('.c-cart-menu').removeClass('c-layout-cart-menu-shown');

			});

			// mobile mode
			$('.c-layout-header').on('click', '.c-brand .c-cart-toggler', function (e) {
				e.preventDefault();

				$('.c-cart-menu').toggleClass('c-layout-cart-menu-shown');

			});
		}
	};
}();
// END

// BEGIN: Layout Mega Menu
var LayoutQuickSidebar = function () {

	return {
		//main function to initiate the module
		init: function () {
			// desktop mode
			$('.c-layout-header').on('click', '.c-quick-sidebar-toggler', function (e) {
				e.preventDefault();
				e.stopPropagation();

				if ($('body').hasClass("c-layout-quick-sidebar-shown")) {
					$('body').removeClass("c-layout-quick-sidebar-shown");
				} else {
					$('body').addClass("c-layout-quick-sidebar-shown");
				}
			});

			$('.c-layout-quick-sidebar').on('click', '.c-close', function (e) {
				e.preventDefault();

				$('body').removeClass("c-layout-quick-sidebar-shown");
			});

			$('.c-layout-quick-sidebar').on('click', function (e) {
				e.stopPropagation();
			});

			$(document).on('click', '.c-layout-quick-sidebar-shown', function (e) {
				$(this).removeClass("c-layout-quick-sidebar-shown");
			});
		}
	};
}();
// END

// BEGIN: Layout Go To Top
var LayoutGo2Top = function () {

	var handle = function () {
		var currentWindowPosition = $(window).scrollTop(); // current vertical position
		if (currentWindowPosition > 300) {
			$(".c-layout-go2top").show();
		} else {
			$(".c-layout-go2top").hide();
		}
	};

	return {

		//main function to initiate the module
		init: function () {

			handle(); // call headerFix() when the page was loaded

			if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
				$(window).bind("touchend touchcancel touchleave", function (e) {
					handle();
				});
			} else {
				$(window).scroll(function () {
					handle();
				});
			}

			$(".c-layout-go2top").on('click', function (e) {
				e.preventDefault();
				$("html, body").animate({
					scrollTop: 0
				}, 600);
			});
		}

	};
}();
// END: Layout Go To Top

// BEGIN: Onepage Nav
var LayoutOnepageNav = function () {

	var handle = function () {
		var offset;
		var scrollspy;
		var speed;
		var nav;

		$('body').addClass('c-page-on-scroll');
		offset = $('.c-layout-header-onepage').outerHeight(true);
		$('body').removeClass('c-page-on-scroll');

		if ($('.c-mega-menu-onepage-dots').size() > 0) {
			if ($('.c-onepage-dots-nav').size() > 0) {
				$('.c-onepage-dots-nav').css('margin-top', -($('.c-onepage-dots-nav').outerHeight(true) / 2));
			}
			scrollspy = $('body').scrollspy({
				target: '.c-mega-menu-onepage-dots',
				offset: offset
			});
			speed = parseInt($('.c-mega-menu-onepage-dots').attr('data-onepage-animation-speed'));
		} else {
			scrollspy = $('body').scrollspy({
				target: '.c-mega-menu-onepage',
				offset: offset
			});
			speed = parseInt($('.c-mega-menu-onepage').attr('data-onepage-animation-speed'));
		}

		scrollspy.on('activate.bs.scrollspy', function () {
			$(this).find('.c-onepage-link.c-active').removeClass('c-active');
			$(this).find('.c-onepage-link.active').addClass('c-active');
		});

		$('.c-onepage-link > a').on('click', function (e) {
			var section = $(this).attr('href');
			var top = 0;

			if (section !== "#home") {
				top = $(section).offset().top - offset + 1;
			}

			$('html, body').stop().animate({
				scrollTop: top,
			}, speed, 'easeInExpo');

			e.preventDefault();

			if (App.getViewPort().width < App.getBreakpoint('md')) {
				$('.c-hor-nav-toggler').click();
			}
		});
	};

	return {

		//main function to initiate the module
		init: function () {
			handle(); // call headerFix() when the page was loaded
		}

	};
}();
// END: Onepage Nav

// BEGIN: Handle Theme Settings
var LayoutThemeSettings = function () {

	var handle = function () {

		$('.c-settings .c-color').on('click', function () {
			var val = $(this).attr('data-color');
            var demo = App.getURLParameter('d') || 'default';
			$('#style_theme').attr('href', '../assets/demos/' + demo + '/css/themes/' + val + '.css');

			$('.c-settings .c-color').removeClass('c-active');
			$(this).addClass('c-active');
		});

		$('.c-setting_header-type').on('click', function () {
			var val = $(this).attr('data-value');
			if (val == 'fluid') {
				$('.c-layout-header .c-topbar > .container').removeClass('container').addClass('container-fluid');
				$('.c-layout-header .c-navbar > .container').removeClass('container').addClass('container-fluid');
			} else {
				$('.c-layout-header .c-topbar > .container-fluid').removeClass('container-fluid').addClass('container');
				$('.c-layout-header .c-navbar > .container-fluid').removeClass('container-fluid').addClass('container');
			}
			$('.c-setting_header-type').removeClass('active');
			$(this).addClass('active');
		});

		$('.c-setting_header-mode').on('click', function () {
			var val = $(this).attr('data-value');
			if (val == 'static') {
				$('body').removeClass('c-layout-header-fixed').addClass('c-layout-header-static');
			} else {
				$('body').removeClass('c-layout-header-static').addClass('c-layout-header-fixed');
			}
			$('.c-setting_header-mode').removeClass('active');
			$(this).addClass('active');
		});

		$('.c-setting_font-style').on('click', function () {
			var val = $(this).attr('data-value');

			if (val == 'light') {
				$('.c-font-uppercase').addClass('c-font-uppercase-reset').removeClass('c-font-uppercase');
				$('.c-font-bold').addClass('c-font-bold-reset').removeClass('c-font-bold');

				$('.c-fonts-uppercase').addClass('c-fonts-uppercase-reset').removeClass('c-fonts-uppercase');
				$('.c-fonts-bold').addClass('c-fonts-bold-reset').removeClass('c-fonts-bold');
			} else {
				$('.c-font-uppercase-reset').addClass('c-font-uppercase').removeClass('c-font-uppercase-reset');
				$('.c-font-bold-reset').addClass('c-font-bold').removeClass('c-font-bold-reset');

				$('.c-fonts-uppercase-reset').addClass('c-fonts-uppercase').removeClass('c-fonts-uppercase-reset');
				$('.c-fonts-bold-reset').addClass('c-fonts-bold').removeClass('c-fonts-bold-reset');
			}

			$('.c-setting_font-style').removeClass('active');
			$(this).addClass('active');
		});

		$('.c-setting_megamenu-style').on('click', function () {
			var val = $(this).attr('data-value');
			if (val == 'dark') {
				$('.c-mega-menu').removeClass('c-mega-menu-light').addClass('c-mega-menu-dark');
			} else {
				$('.c-mega-menu').removeClass('c-mega-menu-dark').addClass('c-mega-menu-light');
			}
			$('.c-setting_megamenu-style').removeClass('active');
			$(this).addClass('active');
		});

	};

	return {

		//main function to initiate the module
		init: function () {

			handle();
		}

	};
}();
// END: Handle Theme Settings

// BEGIN: OwlCarousel
var ContentOwlcarousel = function () {

	var _initInstances = function () {
		$("[data-slider='owl'] .owl-carousel").each(function () {

			var parent = $(this);

			var items;
			var itemsDesktop;
			var itemsDesktopSmall;
			var itemsTablet;
			var itemsTabletSmall;
			var itemsMobile;

			var rtl_mode = (parent.data('rtl')) ? parent.data('rtl') : false ; 
			var items_loop = (parent.data('loop')) ? parent.data('loop') : true ; 
			var items_nav_dots = (parent.attr('data-navigation-dots')) ? parent.data('navigation-dots') : true ; 
			var items_nav_label = (parent.attr('data-navigation-label')) ? parent.data('navigation-label') : false ; 

			if (parent.data("single-item") == true) {
				items = 1;
				itemsDesktop = 1;
				itemsDesktopSmall = 1;
				itemsTablet = 1;
				itemsTabletSmall = 1;
				itemsMobile = 1;
			} else {
				items = parent.data('items');
				itemsDesktop = parent.data('desktop-items') ? parent.data('desktop-items') : items;
				itemsDesktopSmall = parent.data('desktop-small-items') ? parent.data('desktop-small-items') : 3;
				itemsTablet = parent.data('tablet-items') ? parent.data('tablet-items') : 2;
				itemsMobile = parent.data('mobile-items') ? parent.data('mobile-items') : 1;
			}

			parent.owlCarousel({

				rtl: rtl_mode,
				loop: items_loop,
				items: items,
				responsive: {
					0:{
						items: itemsMobile
					},
					480:{
						items: itemsMobile
					},
					768:{
						items: itemsTablet
					},
					980:{
						items: itemsDesktopSmall
					},
					1200:{
						items: itemsDesktop
					}
				},

				dots: items_nav_dots,
				nav: items_nav_label,
				navText: false,
				autoplay: (parent.data("auto-play")) ? parent.data("auto-play") : true,
				autoplayTimeout: (parent.data('slide-speed')) ? parent.data('slide-speed') : 5000,
				autoplayHoverPause: (parent.data('auto-play-hover-pause')) ? parent.data('auto-play-hover-pause') : false,
			});
		});
	};

	return {

		//main function to initiate the module
		init: function () {

			_initInstances();
		}

	};
}();
// END: OwlCarousel

// BEGIN: ContentCubeLatestPortfolio
var ContentCubeLatestPortfolio = function () {

	var _initInstances = function () {

		// init cubeportfolio
		$('.c-content-latest-works').cubeportfolio({
			filters: '#filters-container',
			loadMore: '#loadMore-container',
			loadMoreAction: 'click',
			layoutMode: 'grid',
			defaultFilter: '*',
			animationType: 'quicksand',
			gapHorizontal: 20,
			gapVertical: 23,
			gridAdjustment: 'responsive',
			mediaQueries: [{
				width: 1100,
				cols: 4
			}, {
				width: 800,
				cols: 3
			}, {
				width: 500,
				cols: 2
			}, {
				width: 320,
				cols: 1
			}],
			caption: 'zoom',
			displayType: 'lazyLoading',
			displayTypeSpeed: 100,

			// lightbox
			lightboxDelegate: '.cbp-lightbox',
			lightboxGallery: true,
			lightboxTitleSrc: 'data-title',
			lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',

			// singlePage popup
			singlePageDelegate: '.cbp-singlePage',
			singlePageDeeplinking: true,
			singlePageStickyNavigation: true,
			singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
			singlePageCallback: function (url, element) {
				// to update singlePage content use the following method: this.updateSinglePage(yourContent)
				var t = this;

				$.ajax({
					url: url,
					type: 'GET',
					dataType: 'html',
					timeout: 5000
				})
					.done(function (result) {
						t.updateSinglePage(result);
					})
					.fail(function () {
						t.updateSinglePage("Error! Please refresh the page!");
					});
			},
		});

		$('.c-content-latest-works-fullwidth').cubeportfolio({
			loadMoreAction: 'auto',
			layoutMode: 'grid',
			defaultFilter: '*',
			animationType: 'fadeOutTop',
			gapHorizontal: 0,
			gapVertical: 0,
			gridAdjustment: 'responsive',
			mediaQueries: [{
				width: 1600,
				cols: 5
			}, {
				width: 1200,
				cols: 4
			}, {
				width: 800,
				cols: 3
			}, {
				width: 500,
				cols: 2
			}, {
				width: 320,
				cols: 1
			}],
			caption: 'zoom',
			displayType: 'lazyLoading',
			displayTypeSpeed: 100,

			// lightbox
			lightboxDelegate: '.cbp-lightbox',
			lightboxGallery: true,
			lightboxTitleSrc: 'data-title',
			lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
		});

	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END: ContentCubeLatestPortfolio

// BEGIN: CounterUp
var ContentCounterUp = function () {

	var _initInstances = function () {

		// init counter up
		$("[data-counter='counterup']").counterUp({
			delay: 10,
			time: 1000
		});
	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END: CounterUp

// BEGIN: Fancybox
var ContentFancybox = function () {

	var _initInstances = function () {
		// init fancybox
		$("[data-lightbox='fancybox']").fancybox();
	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END: Fancybox

// BEGIN: Twitter
var ContentTwitter = function () {

	var _initInstances = function () {
		// init twitter
		if ($(".twitter-timeline")[0]) {
			!function (d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
				if (!d.getElementById(id)) {
					js = d.createElement(s);
					js.id = id;
					js.src = p + "://platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js, fjs);
				}
			}(document, "script", "twitter-wjs");
		}
	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END: Twitter


// BEGIN : SCROLL TO VIEW DETECTION
function isScrolledIntoView(elem)
{
    var $elem = $(elem);
    var $window = $(window);

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
// END : SCROLL TO VIEW FUNCTION

// BEGIN : PROGRESS BAR 
var LayoutProgressBar = function ($) {

    return {
        init: function () {
        	var id_count = 0; // init progress bar id number
        	$('.c-progress-bar-line').each(function(){
        		id_count++; // progress bar id running number
        		// build progress bar class selector with running id number
        		var this_id = $(this).attr('data-id', id_count);
        		var this_bar = '.c-progress-bar-line[data-id="'+id_count+'"]';

        		// build progress bar object key
        		var progress_data = $(this).data('progress-bar');
				progress_data = progress_data.toLowerCase().replace(/\b[a-z]/g, function(letter) {
				    return letter.toUpperCase();
				});
				if(progress_data == 'Semicircle') { progress_data = 'SemiCircle'; }

				// grab options
				var bar_color = $(this).css('border-top-color'); // color	
				var this_animation = $(this).data('animation'); // animation type : linear, easeIn, easeOut, easeInOut, bounce
				var stroke_width = $(this).data('stroke-width'); // stroke width
				var bar_duration = $(this).data('duration'); // duration
				var trail_width = $(this).data('trail-width'); // trail width
				var trail_color = $(this).data('trail-color'); // trail color
				var bar_progress = $(this).data('progress'); // progress value
				var font_color = $(this).css('color'); // progress font color

				// set default data if options is null / undefinded
				if (bar_color == 'rgb(92, 104, 115)'){ bar_color = '#32c5d2'; } // set default color 
				if (trail_color == ''){ trail_color = '#5c6873'; }
				if (trail_width == ''){ trail_width = '0'; }
				if (bar_progress == ""){ bar_progress = '1'; }
				if (stroke_width == ""){ stroke_width = '3'; }
				if (this_animation == ""){ this_animation = 'easeInOut'; }
				if (bar_duration == ""){ bar_duration = '1500'; }
	         

	         	// set progress bar
	         	var bar = new ProgressBar[progress_data](this_bar, {
		            strokeWidth: stroke_width,
		            easing: this_animation,
		            duration: bar_duration,
		            color: bar_color,
		            trailWidth: trail_width,
		            trailColor: trail_color,
		            svgStyle: null,		            
	            	step: function (state, bar) {
						bar.setText(Math.round(bar.value() * 100) + '%');
					},									   
					text: {
						style: {
							color: font_color,
						}
					},
		        });

	         	// init animation when progress bar in view without scroll
	         	var check_scroll = isScrolledIntoView(this_bar); // check if progress bar is in view - return true / false
			    if (check_scroll == true){
		        	bar.animate(bar_progress);  // Number from 0.0 to 1.0
		        }
		        
	         	// start progress bar animation upon scroll view
		        $(window).scroll(function (event) {
				    var check_scroll = isScrolledIntoView(this_bar); // check if progress bar is in view - return true / false
				    if (check_scroll == true){
			        	bar.animate(bar_progress);  // Number from 0.0 to 1.0
			        }
				});
				

        	});

        	
         
           
        }
    }
}(jQuery);
// END : PROGRESS BAR

// BEGIN : COOKIES NOTIFICATION BAR
var LayoutCookies = function () {

	var _initInstances = function () {

		$('.c-cookies-bar-close').click(function(){
			$('.c-cookies-bar').animate({
				opacity: 0,
			  }, 500, function() {
			    $('.c-cookies-bar').css('display', 'none');
			  });
		});
	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END : COOKIES NOTIFICATION BAR

// BEGIN : JQUERY SMOOTH SCROLL
var LayoutSmoothScroll = function () {

	var _initInstances = function () {

		$('.js-smoothscroll').on('click', function() {
			var scroll_target = $(this).data('target');
			var scroll_offset = ($(this).data('scroll-offset')) ? $(this).data('scroll-offset') : 0;
			$.smoothScroll({
				scrollTarget: '#'+scroll_target,
				offset: scroll_offset,
			});
			return false;
		});
	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END : JQUERY SMOOTH SCROLL

// BEGIN : TYPED.JS
var ContentTyped = function () {

	var _initInstances = function () {

		$('.c-typed-animation').each(function(){
			var final_string = [];
			if($(this).data('first-sentence')){
				final_string.push($(this).data('first-sentence'));
			}
			if($(this).data('second-sentence')){
				final_string.push($(this).data('second-sentence'));
			}
			if($(this).data('third-sentence')){
				final_string.push($(this).data('third-sentence'));
			}
			if($(this).data('forth-sentence')){
				final_string.push($(this).data('forth-sentence'));
			}
			if($(this).data('fifth-sentence')){
				final_string.push($(this).data('fifth-sentence'));
			}
			var type_speed = ($(this).attr('data-type-speed')) ? $(this).attr('data-type-speed') : 0;
			var delay = ($(this).attr('data-delay')) ? $(this).attr('data-delay') : 0;
			var backSpeed = ($(this).attr('data-backspace-speed')) ? $(this).attr('data-backspace-speed') : 0;
			var shuffle = ($(this).attr('data-shuffle')) ? $(this).attr('data-shuffle') : false;
			var backDelay = ($(this).attr('data-backspace-delay')) ? $(this).attr('data-bakcspace-delay') : 500;
			var fadeOut = ($(this).attr('data-fadeout')) ? $(this).attr('data-fadeout') : false;
			var fadeOutDelay = ($(this).attr('data-fadeout-delay')) ? $(this).attr('data-fadeout-delay') : 500;
			var loop = ($(this).attr('data-loop')) ? $(this).attr('data-loop') : false;
			var loopCount = ($(this).attr('data-loop-count')) ? $(this).attr('data-loop-count') : null;
			var showCursor = ($(this).attr('data-cursor')) ? $(this).attr('data-cursor') : true;
			var cursorChar = ($(this).attr('data-cursor-char')) ? $(this).attr('data-cursor-char') : "|";

			$(this).typed({
				strings: final_string,
				typeSpeed: type_speed,
				startDelay: delay,
				backSpeed: backSpeed,
				shuffle: shuffle,
				backDelay: backDelay,
				fadeOut: fadeOut,
				fadeOutClass: 'typed-fade-out',
				fadeOutDelay: fadeOutDelay,
				loop: loop,
				loopCount: loopCount,
				showCursor: showCursor,
				cursorChar: cursorChar,
			});
		});
		
	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END : TYPED.JS

// BEGIN : DATEPICKERS
var ContentDatePickers = function () {

    var handleDatePickers = function () {

    	$('.date-picker').each(function(){
    		$(this).datepicker({
    			rtl: $(this).data('rtl'),
                orientation: "left",
                autoclose: true,
                container: $(this),
                format: $(this).data('date-format'),
    		});
    	});
    }

    return {
        //main function to initiate the module
        init: function () {
            handleDatePickers();
        }
    };

}();
// END : DATEPICKERS

// Main theme initialization
$(document).ready(function () {
	// init layout handlers
	LayoutBrand.init();
	LayoutHeaderCart.init();
	LayoutMegaMenu.init();
	LayoutSidebarMenu.init();
	LayoutQuickSearch.init();
	LayoutCartMenu.init();
	LayoutQuickSidebar.init();
	LayoutGo2Top.init();
	LayoutOnepageNav.init();
	LayoutThemeSettings.init();
	LayoutProgressBar.init();
	LayoutCookies.init();
	LayoutSmoothScroll.init();
	LayoutHeader.init();

	// init plugin wrappers
	ContentOwlcarousel.init();
	ContentCubeLatestPortfolio.init();
	ContentCounterUp.init();
	ContentFancybox.init();
	ContentTwitter.init();
	ContentDatePickers.init();
	ContentTyped.init();
});

