var Core = (function(Core){
	"use strict";

	Core = {

		/**
		** static constants
		**/
		ANIMATIONEND : "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
		TRANSITIONEND : "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",
		ISTOUCH : $('html').hasClass('md_touch'),
		TRANSITIONSUPPORTED : $('html').hasClass('md_csstransitions'),
		XHRLEVEL2 : !!window.FormData,

		/**
		** initialize after DOM has been loaded
		**/
		afterDOMReady : function(){

			$("body").queryLoader2({
    			barHeight : 4,
    			backgroundColor : '#fff',
    			barColor : '#018bc8',
    			minimumTime : 2000,
    			onComplete : function(){

					// show promo popup
    				if($.arcticmodal && $('body').hasClass('promo_popup')){
						$.arcticmodal({
							url : "modals/promo.html"
						});
					}

    			}
    		});

			this.fancyboxValidationFix();
			this.generateBackToTopButton();
			this.attachButton();
			this.events.closeButton();
			this.events.acceptCookies();
			this.events.productRating();
			this.events.backToTop(500);
			this.events.socialFeeds();
			this.events.qty();
			this.events.resetFilter();
			this.events.openModalWindow();
			this.events.contactForm.init();
			this.events.subscribe.init();
			this.events.tableLayoutType();
			this.responsiveSideMegaMenu.init();
			this.responsiveTopBar.init();
			this.stickyMenu.initVars();
			this.events.sellerInfoDropdown();

		},

		/**
		** initialize after all images, scripts, etc. have been loaded
		**/
		afterWindowLoaded: function(){

			this.animatedContent();
			this.mainAnimation.init();

			var addthis_config = addthis_config||{};
			addthis_config.pubid = 'xa-5306f8f674bfda4c';
			
		},

		/**
		** extends jQuery by own mini plugins
		**/
		extend : function(){

			$.fn.extend({

				/**
				**	Emulates select form element
				**	@return jQuery
				**/
				customSelect : function(){

					// template
					var template = "<div class='active_option open_select'></div><ul class='options_list dropdown'></ul>";

					return this.each(function(){

						var $this = $(this),
							tableCellParent = $this.closest('.table_cell');
						$this.prepend(template);

						/* z-index fix */
						if(tableCellParent.length){
							var zIndex = +tableCellParent.next().css('z-index');
							tableCellParent.css('z-index', ++zIndex);
						}

						var active = $this.children('.active_option'),
							list = $this.children('.options_list'),
							select = $this.children('select').hide(),
							options = select.children('option');


						active.text( 
							select.children('option[selected]').val() ? 
								select.children('option[selected]').val() : 
								options.eq(0).val()
						);

						options.each(function(){

							var optionOuter = $('<li></li>',{
									class : 'animated_item'
								}),
								optionInner = $('<a></a>',{
									text : $(this).val(),
									href : '#'
								}),
								tpl = optionOuter.append(optionInner);


							list.append(tpl);
							
						});

						list.on("click", "a", function(event){

							event.preventDefault();

							var v = $(this).text();
							active.text(v);
							select.val(v);

							if(Core.TRANSITIONSUPPORTED){
								$(this).closest('.dropdown').add(active).removeClass("active");
							}else{
								$(this).closest('.dropdown').add(active).removeClass("active visible");
							}

						});

						Core.mainAnimation.prepareDropdown.call(list);

					});

				},

				/**
				**	@return jQuery
				**/
				tabs : function(options){

					return this.each(function(){

						var $container = $(this),

							tabs = {

								init : function(){

									$container.addClass('initialized');

									this.nav = $container.children('.tabs_nav').length ? $container.children('.tabs_nav') : $container.children('.ts_nav');
									this.subContainer = $container.children('.tab_containers_wrap').length ? $container.children('.tab_containers_wrap') : $container.children('.ts_containers_wrap');
									this.tab = this.subContainer.children('.tab_container').length ? this.subContainer.children('.tab_container') : this.subContainer.children('.ts_container');

									this.detectManyTabs(this.nav);

									this.startState();

									var self = this;

									$(window).afterResize(function(){
										self.responsive.bind(self)();
									}, 300);

									this.nav.on('click', 'a:not(.all)', { tabs : this }, this.openSubContainer);

								},

								detectManyTabs : function(collection){

									if(collection.hasClass('tabs_nav') && collection.children('li').length >= 5 && $container.hasClass('type_2')){

										$container.addClass('many_tabs');

									}

								},

								startState : function(){

									var i = this.nav.children('.active').index();

									if(i < 0){
										i = 0;
										this.nav.children().eq(i).addClass('active');
									}

									var active = this.tab.eq(i);

									active.siblings().addClass('invisible');

									this.showTab(active);

								},

								openSubContainer : function(event){

									var tabs = event.data.tabs,
										tab = $($(this).attr('href'));

									$(this).parent().addClass('active').siblings().removeClass('active');

									tabs.showTab(tab);

									event.preventDefault();

								},

								showTab : function(element){

									var height = element.outerHeight();

									element.removeClass('invisible').siblings().addClass('invisible');

									this.subContainer.css('height', height);

								},

								responsive : function(){

									var height = this.tab.not('.invisible').outerHeight();
									this.subContainer.css('height', height);

								}

							}

							tabs.init();

					});

				},

				/**
				**	Call function after window resize and delay
				**	@param fn - function that will be called
				**	@param delay - Delay, after which function will be called
				**	@param namepsace - namespace for event
				**/
				afterResize : function(fn, delay, namespace){

					var ns = namespace || "";
            
		            return this.each(function(){
		            
		                $(this).on('resize' + ns, function(){

		                    setTimeout(function(){
		                        fn();
		                    }, delay);
		                    
		                });
		                
		            });
		            
		        },

		        /**
		        **	Accordion plugin
		        **	@param toggle - set to true, if need to be toggle
		        **	@return jQuery
		        **/
		        accordion : function(toggle){

		        	return this.each(function(){

		        		var $this = $(this),
		        			active = $this.children('dt.active').length ? $this.children('dt.active') : $this.children('dt:first').addClass('active');

		        		$this.children('dt').not(active).next().hide();
		        		
		        		$this.on('click', 'dt', function(){
		        			
		        			if(!toggle){
		        				$(this).addClass('active')
		        						.siblings('dt')
		        						.removeClass('active')
		        						.end()
		        						.next('dd')
		        						.stop()
		        						.slideDown(300)
		        						.siblings('dd')
		        						.stop()
		        						.slideUp(300);
		        			}
		        			else{
		        				$(this).toggleClass('active').next().stop().slideToggle();
		        			}

		        		});

		        	});

		        }

			});

		},

		generateBackToTopButton : function(){

			$('<button></button>', {

				id : "back_to_top",
				class : "def_icon_btn middle_btn theme_button animated transparent"
				
			}).appendTo($('body'));

		},

		/**
		**	Generate stylized button instead default browser's button with type="file"
		**/
		attachButton: function(){

			$('input[type="file"]').each(function(){

				var wrap = $('<div></div>'),
					btn = $('<button></button>', {
						class: 'button_dark_grey middle_btn attach_file_btn',
						type: 'button',
						text: 'Browse'
					});

				wrap.append(btn);

				$(this).before(wrap).hide();

			});

			$('.attach_file_btn').on('click', function(){
				$(this).parent().next().trigger('click');
			});

		},

		/**
		**	Generate rel attribute from valid data-rel attribute
		**/
		fancyboxValidationFix : function(){

			var fb = $('[class*="fancybox_item"]');

			if(!fb.length) return;

			fb.each(function(){

				$(this).attr('rel', $(this).data('rel'));

			});

		},

		/**
		**	Handling animation when page has been scrolled
		**/
		animatedContent : function(){

			$("[data-animation]").each(function() {

				var self = $(this);

				if($(window).width() > 767) {

					self.appear(function() {

						var delay = (self.attr("data-animation-delay") ? self.attr("data-animation-delay") : 1);

						if(delay > 1) self.css("animation-delay", delay + "ms");
						self.removeClass('transparent').addClass("visible " + self.attr("data-animation"));	

					}, {accX: 0, accY: -250});

				}
				else {

					self.removeClass("transparent").addClass("visible");

				}

			});

		},

		/**
		** handling main animation of theme
		**/
		mainAnimation : {

			container : $('.dropdown'),

			init : function(){

				this.prepareEachDropdown();
				this.bindEvents();

			},

			prepareDropdown : function(){

				var self = Core.mainAnimation;

				var $this = $(this),
					hasDropdown = $this.find('.dropdown').length ? 'children' : 'find';

				$this.data("fn", hasDropdown);

				var items = $this[$this.data('fn')]('.animated_item'),
					len = items.length;

				$this.data("len", len);

				self.defaultState($this);

				if(Core.TRANSITIONSUPPORTED){

					items.children('a').on(Core.TRANSITIONEND, function(event){

						event.stopPropagation();

					});

					items.eq(0).on(Core.TRANSITIONEND, function(event){



						if($this.hasClass("active") || event.originalEvent.propertyName !== "transform" || !event.target.classList.contains("animated_item")) return false;
						self.defineNewState($this);
						$this.removeClass("visible");

					});

					items.eq($this.data("len") - 1).on(Core.TRANSITIONEND, function(){

						if(!$this.hasClass("active")) return false;
						self.defineNewState($this,true);

					});

				}

			},

			prepareEachDropdown : function(){

				var self = this;
				self.container.each(self.prepareDropdown);

			},

			bindEvents : function(){

				$('body').on('click.dropdown','[class*="open_"]',function(event){

					$(this).add($(this).next()).toggleClass('active');

					if(Core.TRANSITIONSUPPORTED){
						$(this).next().addClass("visible");
					}
					else{
						$(this).next().toggleClass('visible');
					}

				});

			},

			defineNewState : function(container, reverse){

				container.addClass(container.data('fn'));

				if(reverse){

					var len = container.data("len"),
						items = container[container.data('fn')]('.animated_item');

					for(var i = len,j = 0; i >= 0, j < len; i--, j++){
						items.eq(j).attr('style','transition-delay:' + i / 10 + 's');
					}

				}
				else{

					this.defaultState(container);

				}

			},

			defaultState : function(container){
				
				var	items = container[container.data('fn')]('.animated_item');

				items.each(function(i){

					$(this).attr('style', 'transition-delay:' +  (i+1) / 10 + 's');

				});

			}

		},

		/**
		** store small events
		**/
		events: {

			closeButton : function(){

				$('body').on('click.close_button', '.close',function(){

					$(this).parent().animate({

						opacity : 0

					},function(){

						/* shopping cart addition*/
						var $this = $(this),
							ISSC = $this.closest('.shopping_cart').length,
							collection = $this.parent().index() != 0 && ISSC ?
								 $this.add($this.parent()) : $this;
						/* end shopping cart addition*/

						collection.slideUp(function(){

							if(!ISSC) return;

							var parent = $(this).closest('.shopping_cart'),len;

							$(this).remove();

							len = parent.find('.animated_item').length;
							parent.data("len", len);

							Core.mainAnimation.defineNewState(parent,true);

						});

					});

				});

			},

			/**
			** product raring
			**/
			productRating : function(){

				$('.rating').each(function(){

					var i = $(this).children('.active:last').index();

					$(this).on('mouseenter mouseleave','li',function(){

						$(this).add($(this).siblings()).removeClass('active');

						$(this).add($(this).prevAll()).addClass('active');

					}).on('mouseleave',function(){
						$(this).children('li').removeClass('active').eq(i).addClass('active').prevAll().addClass('active');
					});

				});

			},

			backToTop : function(offset){	

				var w = $(window),
					b = $('#back_to_top');

				w.on("scroll", function(){

					if(w.scrollTop() > offset && !b.hasClass('visible')){
						b.removeClass('transparent').addClass('bounceInRight visible');
					}
					else if(w.scrollTop() <= offset && b.hasClass('visible')){
						b.removeClass('bounceInRight').addClass('bounceOutRight');
					}

				});

				b.on('click', function(){

					$('html,body').animate({
						scrollTop : 0
					},400,'swing');

				}).on(Core.ANIMATIONEND, function(){

					if(b.hasClass('bounceOutRight')){
						b.removeClass('visible bounceOutRight').addClass('transparent');
					}

				});

			},

			socialFeeds : function(){

				$('.social_feeds').find('[class*="open_"]').on('click', function(){
					$(this).parent().siblings().children('.dropdown.active').removeClass(Core.TRANSITIONSUPPORTED ? 'active' : 'active visible');
				});

			},

			qty : function(){

				$('body').on('click.qty','.qty [data-direction]', function(){

					var $this = $(this),
						d = $this.data('direction'),
						input = $this.siblings('input'),
						c = +input.val();

					if(c == 1 && d == "minus") return;

					input.val(d == "minus" ? --c : ++c);

				}).on('keydown.qty','.qty input', function(event){

					var kC = event.keyCode;

					if( !((kC >= 48 && kC <= 57) || (kC >= 96 && kC <= 105) || kC == 8) ) event.preventDefault();

				});

			},

			productPreview : function(){

				var cContainer = $('[data-output]'),
					output = $(cContainer.data('output'));

				cContainer.find('[data-large-image]:first').addClass('active');

				cContainer.on('click','[data-large-image]', function(){

					var $this = $(this);

					if($this.hasClass('active')) return;

					$this.addClass('active').parent().siblings().children('img').removeClass('active');

					var src = $(this).data('large-image');

					output.children('img').stop().animate({
						opacity : 0
					},
					function(){
						$(this).attr('src',src).stop().animate({
							opacity : 1
						});
					});

				});

			},

			openModalWindow : function(){

				$('body').on('click.modal', '[data-modal-url]', function(event){

					$.arcticmodal({
						url : $(this).data('modal-url')
					});

					event.preventDefault();

				});

			},

			/**
			** Object that handles and sends user data
			**/
			contactForm : {

				init : function(){

					$('body').on('submit.contactform', '.contactform', { cf : this }, this.checkValidation);

				},

				checkValidation : function( event ){

					var $this = $(this),
						cf = event.data.cf,
						errorMessage = "";

					event.preventDefault();

					errorMessage += cf.emptyFields($this.find('input, textarea'));
					errorMessage += cf.minLength($this.find('textarea'),20);

					if(errorMessage){

						cf.showMessage(errorMessage, $this, 'error');

						return false;

					}

					if(Core.XHRLEVEL2){

						var fd = new FormData();

					    $.each($this.find("input[type='file']"), function(i, tag) {
					        $.each($(tag)[0].files, function(i, file) {
					            fd.append(tag.name, file);
					        });
					    });

					    var params = $this.serializeArray();

					    $.each(params, function (i, val) {

					        fd.append(val.name, val.value);

					    });

					    cf.ajaxSend(fd, $this);
					}
					else cf.ajaxSend($this.serialize(), $this);

				},

				emptyFields : function(collection){

					var message = "";

					var sortedCollection = $.map(collection, function(el){

						if(el.hasAttribute('required')) return el;

					});

					sortedCollection.forEach(function(el){

						if(!$(el).val()){

							message = "All required fields must be filled!\n";

						}

					});

					return message;

				},

				minLength : function(el, len){

					if(!el[0].hasAttribute('required')) return '';

					var message = "";

					if(el.val().length < len) message = el[0].title + " must contain at least "+len+" characters!\n";

					return message;

				},

				ajaxSend : function(data, container){

					var cf = this;

					$.ajax({

						url: 'php/contact-send.php',
						type: 'POST',
						data: data,
						cache: false,
						contentType: false,
						processData: false,
						success : function(data){
							
							cf.showMessage(data, container, data.indexOf('success') != -1 ? 'success' : 'error');

							if(data.indexOf('success') != -1){
								container.find('input, textarea').val('');
							}

						},
						error : function(data){
							
							cf.showMessage(data, container, 'error');
							
						}

					});

				},

				createFeedBackTemplate : function(message, type){

					return $('<div></div>', {
						text : message,
						class : 'alert_box_' + type
					}).hide();

				},

				showMessage : function(message, container, type){

					var form = container;
					if(form.hasClass('showed_message')) return false;

					var alert = this.createFeedBackTemplate(message, type);

					form.append(alert).addClass('showed_message');

					alert.slideDown(300).delay(3000).slideUp(300, function(){

						$(this).remove();

						form.removeClass('showed_message');

					});

				}

			},

			/**
			** Object that handles and sends user data
			**/
			subscribe : {

				init : function(){

					$('body').on('submit.subscribe', '.subscribe', { cf : this }, this.checkValidation);

				},

				checkValidation : function( event ){

					var $this = $(this),
						cf = event.data.cf;

					event.preventDefault();

					if(!$this.find('input').val()){

						cf.showMessage("Enter your email address!", $this, 'error');

						return false;

					}

					cf.ajaxSend($this.serialize(), $this);

				},

				ajaxSend : function(data, container){

					var cf = this;

					$.ajax({

						url: 'php/subscribe.php',
						type: 'POST',
						data: data,
						success : function(data){
							
							cf.showMessage(data, container, data.indexOf('success') != -1 ? 'success' : 'error');

							if(data.indexOf('success') != -1){
								container.find('input').val('');
							}

						},
						error : function(data){
							
							cf.showMessage(data, container, 'error');

						}

					});

				},

				createFeedBackTemplate : function(message, type){

					return $('<div></div>', {
						text : message,
						class : 'alert_box_' + type
					}).hide();

				},

				showMessage : function(message, container, type){

					var form = container;
					if(form.hasClass('showed_message')) return false;

					var alert = this.createFeedBackTemplate(message, type);

					form.append(alert).addClass('showed_message');

					alert.slideDown(300).delay(3000).slideUp(300, function(){

						$(this).remove();

						form.removeClass('showed_message');

					});

				}

			},

			/**
			**	Blog's layout type
			**/
			tableLayoutType : function(){

				$('.layout_type').on('click', '[data-table-layout]', function(event){

					event.preventDefault();

					var $this = $(this),
						container = $($this.parent().data('table-container'));

					$this.addClass('active').siblings().removeClass('active');

					container.removeClass('grid_view list_view list_view_products').addClass($this.data('table-layout'));

				});

			},

			/**
			**	Reset filter
			**/
			resetFilter : function(){

				if(!window.startRangeValues) return;

				var startValues = window.startRangeValues,
					min = startValues[0].toFixed(2),
					max = startValues[1].toFixed(2);

				$('.filter_reset').on('click', function(){

					var form = $(this).closest('form'),
						range = form.find('.range');

						console.log(startValues);

					// form.find('#slider').slider('option','values', startValues);

					form.find('#slider').slider('values', 0, min);
					form.find('#slider').slider('values', 1, max);

					form.find('.options_list').children().eq(0).children().trigger('click');

					range.children('.min_value').val(min).next().val(max);

					range.children('.min_val').text('$' + min).next().text('$' + max);

				});

			},

			sellerInfoDropdown: function(){

				$('.seller_info_wrap').on('click', '.seller_name', function(){

					$(this).next('.seller_info_dropdown').fadeToggle();

				});

			},

			acceptCookies: function(){

				$('.accept_cookie').on('click', function(event){

					event.preventDefault();

					$(this).closest('.cookie_message').fadeOut();

				});

			}
		},

		helpers : {

			/**
			**	find the maximum height
			**/
			sameheight : function(){

				var $this = $(this), max = 0;

				$this.find('.owl-item').children().css('height','auto').each(function(){

					max = Math.max( max, $(this).outerHeight() );

				}).promise().done(function(){

					$this.find('.owl-item').children().css('height', max);

				});

			},

			/**
			**	Get first and last visible elements in carousel
			**/
			owlGetVisibleElements : function(){

				var $this = $(this);

				$this.find('.owl-item').removeClass('first last');
				$this.find('.owl-item.active').first().addClass('first');
				$this.find('.owl-item.active').last().addClass('last');

			}

		},

		responsiveTopBar : {

			/**
			**	initialize events for the responsive version of mega menu in the side menu
			**/
			init : function(){

				this.container = $('#header').find('.topbar');
				this.menu = this.container.find('.submenu');

				this.createResponsiveButton(this.container);

				this.checkViewPort();

				$(window).afterResize(this.checkViewPort.bind(this),300);

			},

			/**
			** activated the desired handler relative to window size
			**/
			checkViewPort : function(){

				var wW = $(window).width();

				// landscape
				if(wW > 767 && wW < 1192){
					this.activateTablet();
				}
				// mobile && portrait
				else if(wW <= 767){
					this.activateMobile();
				}
				// desktop
				else{
					this.deactivateResponsive();
				}

			},

			/**
			**	Reset tablet handler and add mobile handler
			**/
			activateMobile : function(){

				this.deactivateResponsive();

				this.menu.add(this.container).hide();

				this.menu.parent().off('click.tablet').on('click.mobile', this.mobileHandler);

			},

			/**
			**	Reset mobile handler and add tablet handler
			**/
			activateTablet : function(){

				this.deactivateResponsive();

				this.menu.parent().off('click.mobile').on('click.tablet', this.tabletHandler);

			},

			/**
			**	Reset all handlers and return default state
			**/
			deactivateResponsive : function(){

				$('.tb_toggle_menu').removeClass('active');

				this.container.add(this.menu).show();

				this.menu.parent().removeClass('tablet_active mobile_active');

				this.container.find('.prevented').removeClass('prevented');

				this.menu.parent().off('click.mobile click.tablet');

			},

			/**
			** Mobile handler
			** @param event - event handler
			**/
			mobileHandler : function(event){

				var link = $(this).children('a'),
					menu = $(this).children('.mega_menu, .submenu');

				if(!link.hasClass('prevented') && menu.length){

					link.addClass('prevented');

					menu.stop().slideDown();

					$(this).addClass('mobile_active').siblings().removeClass('mobile_active').children('a').removeClass('prevented').next().stop().slideUp();

					event.preventDefault();

				}

			},	

			/**
			** Tablet handler
			** @param event - event handler
			**/
			tabletHandler : function(event){

				var link = $(this).children('a'),
					menu = $(this).children('.mega_menu, .submenu');

				if(!link.hasClass('prevented') && menu.length){

					link.addClass('prevented');

					$(this).addClass('tablet_active').siblings().removeClass('tablet_active').children('a').removeClass('prevented');

					event.preventDefault();

				}

			},

			/**
			** Create button for main navigation
			**/
			createResponsiveButton : function(container){

				var el = $('<button></button>',{
					class: 'tb_toggle_menu'
				}).insertBefore(container);

				el.on('click.responsiveButton', function(){

					$(this).toggleClass('active').next().slideToggle();

				});

			}

		},

		responsiveSideMegaMenu : {

			/**
			**	initialize events for the responsive version of mega menu in the side menu
			**/
			init : function(){

				this.menu = $('.mega_menu, .submenu');

				this.menu.data('in_main_nav', this.menu.closest('.main_navigation').length ? true : false);

				this.createResponsiveButton();

				this.checkViewPort();

				$(window).afterResize(this.checkViewPort.bind(this),300);

			},

			/**
			** activated the desired handler relative to window size
			**/
			checkViewPort : function(){

				var wW = $(window).width();

				// landscape
				if(wW > 991 && wW < 1400 && Core.ISTOUCH){
					this.activateTablet();
				}
				// mobile && portrait
				else if(wW <= 991){
					this.activateMobile();
				}
				// desktop
				else{
					this.deactivateResponsive();
				}

			},

			/**
			**	Reset tablet handler and add mobile handler
			**/
			activateMobile : function(){

				this.deactivateResponsive();

				this.menu.add($('.main_navigation')).hide();

				this.menu.parent().children('a').off('click.tablet').on('click.mobile', this.mobileHandler);

			},

			/**
			**	Reset mobile handler and add tablet handler
			**/
			activateTablet : function(){

				this.deactivateResponsive();

				this.menu.parent().children('a').off('click.mobile').on('click.tablet', this.tabletHandler);

			},

			/**
			**	Reset all handlers and return default state
			**/
			deactivateResponsive : function(){

				$('.toggle_menu').removeClass('active');

				this.menu.add($('.main_navigation')).show();

				this.menu.parent().removeClass('tablet_active mobile_active');

				this.menu.siblings('.prevented').removeClass('prevented');

				this.menu.parent().children('a').off('click.mobile click.tablet');

			},

			/**
			** Mobile handler
			** @param event - event handler
			**/
			mobileHandler : function(event){

				var link = $(this),
					menu = link.next('.mega_menu, .submenu');

				if(!link.hasClass('prevented') && menu.length){

					link.addClass('prevented');

					menu.stop().slideDown();

					$(this).parent().addClass('mobile_active').siblings().removeClass('mobile_active').children('a').removeClass('prevented').next().stop().slideUp();

					event.preventDefault();

				}

			},	

			/**
			** Tablet handler
			** @param event - event handler
			**/
			tabletHandler : function(event){

				var link = $(this),
					menu = link.next('.mega_menu, .submenu');

				if(!link.hasClass('prevented') && menu.length){

					link.addClass('prevented');

					$(this).parent().addClass('tablet_active').siblings().removeClass('tablet_active').children('a').removeClass('prevented');

					event.preventDefault();

				}

			},

			/**
			** Create button for main navigation
			**/
			createResponsiveButton : function(){

				var el = $('<button></button>',{
					class: 'toggle_menu'
				}).insertBefore($('.main_navigation'));

				el.on('click.responsiveButton', function(){

					$(this).toggleClass('active').next().slideToggle();

				});

			}

		},

		stickyMenu : {

			/**
			**	Initialize variables
			**/
			initVars: function(){

				this.NAVIGATION = $('#main_navigation_wrap, .sticky_part');

				if(!this.NAVIGATION.length) return false; // temp

				this.HEADER = $('#header');
				this.updatesInfo();

				this.needToBeSticky();
				$(window).afterResize(this.needToBeSticky.bind(this), 300);

			},

			/**
			**	Initialize sticky menu
			**/
			initializeSticky: function(){

				this.NAVIGATION.addClass('sticky_initialized');

				this.activateSticky();
				$(window).on('scroll.sticky', this.activateSticky.bind(this));

			},

			/**
			**	Checks if sticky menu need to initialize
			**/
			needToBeSticky: function(){

				if($(window).width() > 991 && this.NAVIGATION.hasClass('sticky_initialized')){

					this.updatesInfo();
					this.activateSticky();

				}
				else if($(window).width() > 991 && !this.NAVIGATION.hasClass('sticky_initialized')){

					this.initializeSticky();

				}
				else if($(window).width() <= 991){

					this.destroy();

				}

			},

			/**
			**	Method that checks scrollbar position and adds/removes 
			**	fixed class on main navigation wrapper element
			**/
			activateSticky: function(){

				if($(window).scrollTop() >= this.navTopOffset && !this.NAVIGATION.hasClass('sticky')){

					this.NAVIGATION.addClass('sticky');
					this.headerSizeCompensation(true);

				}
				else if($(window).scrollTop() < this.navTopOffset && this.NAVIGATION.hasClass('sticky')){

					this.NAVIGATION.removeClass('sticky');
					this.headerSizeCompensation(false);

				}				

			},

			/**
			**	Returns main navigation wrapper element to default position
			**/
			resetStickyPosition: function(){

				this.NAVIGATION.removeClass('sticky');
				this.headerSizeCompensation(false);

			},

			/**
			**	Updates information about main navigation wrapper element (height, offset)
			**/
			updatesInfo: function(){

				this.resetStickyPosition();

				this.navTopOffset = this.NAVIGATION.offset().top;
				this.navHeight = this.NAVIGATION.outerHeight();

			},

			/**
			**	Add padding-bottom to header for compensation sticky menu size
			**/
			headerSizeCompensation: function(on){

				if(on){
					this.HEADER.css('padding-bottom', this.navHeight);
				}
				else{
					this.HEADER.css('padding-bottom', 0);
				}

			},

			/**
			**	Destroy sticky menu
			**/
			destroy : function(){

				this.NAVIGATION.removeClass('sticky_initialized');
				this.resetStickyPosition();
				$(window).off('scroll.sticky');
				this.headerSizeCompensation(false);

			}

		}

	};

	Core.extend();

	$(document).ready(function(){
		Core.afterDOMReady();
	});

	$(window).load(function(){
		Core.afterWindowLoaded();
	});

	return Core;

}(Core || {}));