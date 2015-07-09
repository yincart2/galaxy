;(function(){
	"use strict";

	$(document).ready(function(){

		window.ISRTL = getComputedStyle(document.body).direction === 'rtl';

		/* ------------------------------------------------
				Sliders
		------------------------------------------------ */

			/* ------------------------------------------------
					Royal slider
			------------------------------------------------ */

			if($('.royalSlider').length){
				jQuery.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)'; // add easeOutBack easing support
				$(".royalSlider").royalSlider({
					autoScaleSlider : true,
					autoScaleSliderWidth : 1325,
					autoScaleSliderHeight : 925,
					imageScaleMode : "fill",
					imageScalePadding : 0,
					slidesSpacing : 0,
					controlNavigation : 'none',
					loop : true,
					block : {
						speed : 700,
						easing : 'easeOutBack'
					},
		            keyboardNavEnabled: true
		        });  
		    }
	        
			/* ------------------------------------------------
					End Royal slider
			------------------------------------------------ */

			/* ------------------------------------------------
					Revolution slider
			------------------------------------------------ */

			if($('.rev_slider').length){
				$('.rev_slider').revolution({
			        delay:4000,
			        startwidth:848,
			        startheight:387,
			        hideTimerBar : "on",
			        hideThumbs : 100,
			        navigationType:"none",
					navigationStyle:"round"
			 	});
			 }

			/* ------------------------------------------------
					End Revolution slider
			------------------------------------------------ */

			/* ------------------------------------------------
					Layer slider
			------------------------------------------------ */

			if($('.layerslider').length){
				$('.layerslider').layerSlider({
					responsive: false,
					responsiveUnder: 1140,
					layersContainer: 1140,
					skinsPath: 'js/layerslider/skins/',
					hoverPrevNext: false,
					navButtons: false,
					navStartStop: false,
					showCircleTimer: false
				});
			}

			/* ------------------------------------------------
					End Layer slider
			------------------------------------------------ */

		/* ------------------------------------------------
				End sliders
		------------------------------------------------ */

		/* ------------------------------------------------
				Countdown
		------------------------------------------------ */

		$('.countdown').each(function(){
			var $this = $(this),
				endDate = $this.data(),
				until = new Date(
					endDate.year,
					endDate.month || 0,
					endDate.day || 1,
					endDate.hours || 0,
					endDate.minutes || 0,
					endDate.seconds || 0
				);
			// initialize
			$this.countdown({
				until : until,
				format : 'dHMS',
				labels : ['years', 'month', 'weeks', 'days', 'hours', 'min', 'sec']
			});
		});

		/* ------------------------------------------------
				End countdown
		------------------------------------------------ */

		/* ------------------------------------------------
				Tweets
		------------------------------------------------ */

		window.twitterConfig = {
			username : 'fanfbmltemplate',
			modpath: 'twitter/',
			count : 2,
			loading_text : '<div class="animated_item">Loading tweets...</div>',
			template : '<li class="animated_item"><p class="tweet_inner"><a href="{user_url}">{screen_name}</a> {text}</p><ul class="tw_actions"><li><a target="_blank" href={tweet_url}>{tweet_date}</a></li><li>{reply_action}</li><li>{retweet_action}</li><li>{favorite_action}</li></ul></li>'
		};

		$('.tweet_list_wrap').tweet(window.twitterConfig);
		$('.twitter_follow').attr({
			'href' : 'http://www.twitter.com/' + window.twitterConfig.username,
			'target' : '_blank'
		});
		

		/* ------------------------------------------------
				End tweets
		------------------------------------------------ */

		/* ------------------------------------------------
				Custom select
		------------------------------------------------ */

		$('.custom_select').customSelect();
			
		/* ------------------------------------------------
				End custom select
		------------------------------------------------ */

		/* ------------------------------------------------
				Arctic modal
		------------------------------------------------ */

		if($.arcticmodal){
			$.arcticmodal('setDefault',{
				type : 'ajax',
				ajax : {
					cache : false
				},
				afterOpen : function(obj){

					setTimeout(function(){

       var mw = $('.modal_window');
 
       mw.find('.custom_select').customSelect();

       mw.find('.product_preview .owl_carousel').owlCarousel({
        margin : 10,
        themeClass : 'thumbnails_carousel',
        nav : true,
        navText : [],
        rtl: window.ISRTL ? true : false
       });

       Core.events.productPreview();

       addthis.toolbox('.addthis_toolbox');

      }, 500);
					
				}
			});
		}
			
		/* ------------------------------------------------
				End arctic modal
		------------------------------------------------ */

		/* ------------------------------------------------
				Accordion
		------------------------------------------------ */

		$('.accordion').accordion(false);

		/* ------------------------------------------------
				End accordion
		------------------------------------------------ */

		/* ------------------------------------------------
				Toggle
		------------------------------------------------ */

		$('.toggle').accordion(true);

		/* ------------------------------------------------
				End toggle
		------------------------------------------------ */

		/* ------------------------------------------------
				Fancybox
		------------------------------------------------ */

		if($.fancybox){
			$.fancybox.defaults.direction = {
				next: 'left',
				prev: 'right'
			}
		}

		if($('.fancybox_item').length){
			$('.fancybox_item').fancybox({
				openEffect : 'elastic',
				closeEffect : 'elastic',
				helpers : {
					overlay: {
						css : {
							'background' : 'rgba(0,0,0, .6)'
						}
					},
					thumbs	: {
						width	: 50,
						height	: 50
					}
				}
			});
		}

		if($('.fancybox_item_media').length){
			$('.fancybox_item_media').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',
				helpers : {
					media : {}
				}
			});
		}

		/* ------------------------------------------------
				End fancybox
		------------------------------------------------ */

		/* ------------------------------------------------
				Elevate Zoom
		------------------------------------------------ */

			if($('#img_zoom').length){
				$('#img_zoom').elevateZoom({
					zoomType: "inner",
					gallery:'thumbnails',
					galleryActiveClass: 'active',
					cursor: "crosshair",
					responsive:true,
					easing:true,
					zoomWindowFadeIn: 500,
					zoomWindowFadeOut: 500,
					lensFadeIn: 500,
					lensFadeOut: 500
				});

				$(".open_qv").on("click", function(e) { 
					var ez = $(this).siblings('img').data('elevateZoom');
					$.fancybox(ez.getGalleryList());
					e.preventDefault();
				});

			}

		/* ------------------------------------------------
				End Elevate Zoom
		------------------------------------------------ */

		/* ------------------------------------------------
				Range slider
		------------------------------------------------ */


		if($('#slider').length){

			window.startRangeValues = [28.00, 562.00];

			$('#slider').slider({

				range : true,
				min : 10.00,
				max : 580.00,
				values : window.startRangeValues,
				step : 0.01,

				slide : function(event, ui){

					var min = ui.values[0].toFixed(2),
						max = ui.values[1].toFixed(2),
						range = $(this).siblings('.range');


					range.children('.min_value').val(min).next().val(max);

					range.children('.min_val').text('$' + min).next().text('$' + max);

				},

				create : function(event, ui){

					var $this = $(this),
						min = $this.slider("values", 0).toFixed(2),
						max = $this.slider("values", 1).toFixed(2),
						range = $this.siblings('.range');

					range.children('.min_value').val(min).next().val(max);

					range.children('.min_val').text('$' + min).next().text('$' + max);
					
				}

			});

		}

		/* ------------------------------------------------
				End range slider
		------------------------------------------------ */

	});

	$(window).load(function(){

		/* ------------------------------------------------
				Owl-carousel
		------------------------------------------------ */

			// required
			$('.owl_carousel:not(.widgets_carousel)').on('initialized.owl.carousel resized.owl.carousel', Core.helpers.sameheight)
								.on('initialized.owl.carousel translated.owl.carousel', Core.helpers.owlGetVisibleElements);

			$('.carousel_in_tabs:not([class*="type"])').owlCarousel({
				responsive : {
					0 : {
						items : 1
					},
					480 : {
						items : 2
					},
					992 : {
						items : 3
					}
				},
				nav : true,
				navText : [],
				rtl: window.ISRTL ? true : false
			});

			$('.brands').owlCarousel({
				responsive : {
					0 : {
						items : 2
					},
					480 : {
						items : 3
					},
					992 : {
						items : 4
					}
				},
				margin : 30,
				loop: true,
				nav : true,
				navText : [],
				themeClass : 'brands_carousel',
				rtl: window.ISRTL ? true : false
			});

			$('.brands_full_width').owlCarousel({
				responsive : {
					0 : {
						items : 2
					},
					480 : {
						items: 3
					},
					768 : {
						items : 4
					},
					992 : {
						items : 5
					},
					1199 : {
						items : 6
					}
				},
				margin : 30,
				loop: true,
				nav : true,
				navText : [],
				themeClass : 'brands_carousel',
				rtl: window.ISRTL ? true : false
			});

			$('.sellers_carousel, .other_products').owlCarousel({
				responsive : {
					0 : {
						items : 1
					},
					487 : {
						items : 2
					},
					992 : {
						items : 3
					}
				},
				nav : true,
				navText : [],
				rtl: window.ISRTL ? true : false
			});

			$('.carousel_of_entries').owlCarousel({
				responsive : {
					0 : {
						items : 1
					},
					485 : {
						items : 2
					},
					992 : {
						items : 3
					}
				},
				nav : true,
				navText : [],
				rtl: window.ISRTL ? true : false
			});

			$('.carousel_in_tabs.type_2, .owl_carousel.four_items').owlCarousel({
				responsive : {
					0 : {
						items : 1
					},
					490 : {
						items : 2
					},
					684 : {
						items : 3
					},
					992 : {
						items : 4
					}
				},
				nav : true,
				navText : [],
				rtl: window.ISRTL ? true : false
			});

			$('.carousel_in_tabs.type_3').owlCarousel({
				responsive : {
					0 : {
						items : 1
					},
					490 : {
						items : 2
					},
					992 : {
						items : 3
					},
					1199 : {
						items : 4
					}
				},
				nav : true,
				navText : [],
				rtl: window.ISRTL ? true : false
			});

			$('.widgets_carousel').owlCarousel({
				items : 1,
				autoHeight : true,
				loop : true,
				nav : true,
				navText : [],
				themeClass : 'single_visible_element',
				onResized : function(){
					$('.widgets_carousel').trigger('next.owl.carousel');
				},
				rtl: window.ISRTL ? true : false
			});

			$('.owl_carousel.six_items').owlCarousel({
				responsive : {
					0 : {
						items : 1
					},
					420 : {
						items : 2
					},
					580 : {
						items : 3
					},
					992 : {
						items : 5
					},
					1199 : {
						items : 6
					}
				},
				nav : true,
				navText : [],
				themeClass : 'carousel_with_six_items',
				rtl: window.ISRTL ? true : false
			});

			$('.owl_carousel.five_items').owlCarousel({
				responsive : {
					0 : {
						items : 1
					},
					465 : {
						items : 2
					},
					580 : {
						items : 3
					},
					991 : {
						items : 4
					},
					1199 : {
						items : 5
					}
				},
				nav : true,
				navText : [],
				rtl: window.ISRTL ? true : false
			});

			if($('.product_preview').length){

				$('.product_preview .owl_carousel').owlCarousel({
					margin : 10,
					themeClass : 'thumbnails_carousel',
					nav : true,
					navText : [],
					rtl: window.ISRTL ? true : false
				});

			}

			if($('.related_products').length){

				$('.related_products').owlCarousel({
					responsive : {
						0 : {
							items : 1
						},
						465 : {
							items : 2
						},
						991 : {
							items : 4
						}
					},
					nav : true,
					navText : [],
					rtl: window.ISRTL ? true : false
				});

			}

		/* ------------------------------------------------
				End owl-carousel
		------------------------------------------------ */		

		/* ------------------------------------------------
				Tabs
		------------------------------------------------ */

		$('.tabs, .tour_section').tabs();

		/* ------------------------------------------------
				End tabs
		------------------------------------------------ */

	});

}());