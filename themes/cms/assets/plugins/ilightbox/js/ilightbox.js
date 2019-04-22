/**
 * jQuery iLightBox - Revolutionary Lightbox Plugin
 * http://www.ilightbox.net/
 *
 * @version: 2.2.0 - September 23, 2014
 *
 * @author: Hemn Chawroka
 *          http://www.iprodev.com/
 *
 */
(function($, window, undefined) {

	var extensions = {
			flash: ['swf'],
			image: ['bmp', 'gif', 'jpeg', 'jpg', 'png', 'tiff', 'tif', 'jfif', 'jpe'],
			iframe: ['asp', 'aspx', 'cgi', 'cfm', 'htm', 'html', 'jsp', 'php', 'pl', 'php3', 'php4', 'php5', 'phtml', 'rb', 'rhtml', 'shtml', 'txt'],
			video: ['avi', 'mov', 'mpg', 'mpeg', 'movie', 'mp4', 'webm', 'ogv', 'ogg', '3gp', 'm4v']
		},

		// Global DOM elements
		$win = $(window),
		$doc = $(document),

		// Support indicators
		browser,
		transform,
		gpuAcceleration,
		fullScreenApi = '',
		supportTouch = !!('ontouchstart' in window) && (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)),

		// Events
		clickEvent = supportTouch ? "itap.iLightBox" : "click.iLightBox",
		touchStartEvent = supportTouch ? "touchstart.iLightBox" : "mousedown.iLightBox",
		touchStopEvent = supportTouch ? "touchend.iLightBox" : "mouseup.iLightBox",
		touchMoveEvent = supportTouch ? "touchmove.iLightBox" : "mousemove.iLightBox",

		// Math shorthands
		abs = Math.abs,
		sqrt = Math.sqrt,
		round = Math.round,
		max = Math.max,
		min = Math.min,
		floor = Math.floor,
		random = Math.random,

		pluginspages = {
			quicktime: 'http://www.apple.com/quicktime/download',
			flash: 'http://www.adobe.com/go/getflash'
		},

		iLightBox = function(el, options, items, instant) {
			var iL = this;

			iL.options = options,
				iL.selector = el.selector || el,
				iL.context = el.context,
				iL.instant = instant;

			if (items.length < 1) iL.attachItems();
			else iL.items = items;

			iL.vars = {
				total: iL.items.length,
				start: 0,
				current: null,
				next: null,
				prev: null,
				BODY: $('body'),
				loadRequests: 0,
				overlay: $('<div class="ilightbox-overlay"></div>'),
				loader: $('<div class="ilightbox-loader"><div></div></div>'),
				toolbar: $('<div class="ilightbox-toolbar"></div>'),
				innerToolbar: $('<div class="ilightbox-inner-toolbar"></div>'),
				title: $('<div class="ilightbox-title"></div>'),
				closeButton: $('<a class="ilightbox-close" title="' + iL.options.text.close + '"></a>'),
				fullScreenButton: $('<a class="ilightbox-fullscreen" title="' + iL.options.text.enterFullscreen + '"></a>'),
				innerPlayButton: $('<a class="ilightbox-play" title="' + iL.options.text.slideShow + '"></a>'),
				innerNextButton: $('<a class="ilightbox-next-button" title="' + iL.options.text.next + '"></a>'),
				innerPrevButton: $('<a class="ilightbox-prev-button" title="' + iL.options.text.previous + '"></a>'),
				holder: $('<div class="ilightbox-holder' + (supportTouch ? ' supportTouch' : '') + '" ondragstart="return false;"><div class="ilightbox-container"></div></div>'),
				nextPhoto: $('<div class="ilightbox-holder' + (supportTouch ? ' supportTouch' : '') + ' ilightbox-next" ondragstart="return false;"><div class="ilightbox-container"></div></div>'),
				prevPhoto: $('<div class="ilightbox-holder' + (supportTouch ? ' supportTouch' : '') + ' ilightbox-prev" ondragstart="return false;"><div class="ilightbox-container"></div></div>'),
				nextButton: $('<a class="ilightbox-button ilightbox-next-button" ondragstart="return false;" title="' + iL.options.text.next + '"><span></span></a>'),
				prevButton: $('<a class="ilightbox-button ilightbox-prev-button" ondragstart="return false;" title="' + iL.options.text.previous + '"><span></span></a>'),
				thumbnails: $('<div class="ilightbox-thumbnails" ondragstart="return false;"><div class="ilightbox-thumbnails-container"><a class="ilightbox-thumbnails-dragger"></a><div class="ilightbox-thumbnails-grid"></div></div></div>'),
				thumbs: false,
				nextLock: false,
				prevLock: false,
				hashLock: false,
				isMobile: false,
				mobileMaxWidth: 980,
				isInFullScreen: false,
				isSwipe: false,
				mouseID: 0,
				cycleID: 0,
				isPaused: 0
			};

			// Hideable elements with mousemove event
			iL.vars.hideableElements = iL.vars.nextButton.add(iL.vars.prevButton);

			iL.normalizeItems();

			//Check necessary plugins
			iL.availPlugins();

			//Set startFrom
			iL.options.startFrom = (iL.options.startFrom > 0 && iL.options.startFrom >= iL.vars.total) ? iL.vars.total - 1 : iL.options.startFrom;

			//If randomStart
			iL.options.startFrom = (iL.options.randomStart) ? floor(random() * iL.vars.total) : iL.options.startFrom;
			iL.vars.start = iL.options.startFrom;

			if (instant) iL.instantCall();
			else iL.patchItemsEvents();

			if (iL.options.linkId) {
				iL.hashChangeHandler();
				$win.iLightBoxHashChange(function() {
					iL.hashChangeHandler();
				});
			}

			if (supportTouch) {
				var RegExp = /(click|mouseenter|mouseleave|mouseover|mouseout)/ig,
					replace = "itap";
				iL.options.caption.show = iL.options.caption.show.replace(RegExp, replace),
					iL.options.caption.hide = iL.options.caption.hide.replace(RegExp, replace),
					iL.options.social.show = iL.options.social.show.replace(RegExp, replace),
					iL.options.social.hide = iL.options.social.hide.replace(RegExp, replace);
			}

			if (iL.options.controls.arrows) {
				$.extend(iL.options.styles, {
					nextOffsetX: 0,
					prevOffsetX: 0,
					nextOpacity: 0,
					prevOpacity: 0
				});
			}
		};

	//iLightBox helpers
	iLightBox.prototype = {
		showLoader: function() {
			var iL = this;
			iL.vars.loadRequests += 1;
			if (iL.options.path.toLowerCase() == "horizontal") iL.vars.loader.stop().animate({
				top: '-30px'
			}, iL.options.show.speed, 'easeOutCirc');
			else iL.vars.loader.stop().animate({
				left: '-30px'
			}, iL.options.show.speed, 'easeOutCirc');
		},

		hideLoader: function() {
			var iL = this;
			iL.vars.loadRequests -= 1;
			iL.vars.loadRequests = (iL.vars.loadRequests < 0) ? 0 : iL.vars.loadRequests;
			if (iL.options.path.toLowerCase() == "horizontal") {
				if (iL.vars.loadRequests <= 0) iL.vars.loader.stop().animate({
					top: '-192px'
				}, iL.options.show.speed, 'easeInCirc');
			} else {
				if (iL.vars.loadRequests <= 0) iL.vars.loader.stop().animate({
					left: '-192px'
				}, iL.options.show.speed, 'easeInCirc');
			}
		},

		createUI: function() {
			var iL = this;

			iL.ui = {
				currentElement: iL.vars.holder,
				nextElement: iL.vars.nextPhoto,
				prevElement: iL.vars.prevPhoto,
				currentItem: iL.vars.current,
				nextItem: iL.vars.next,
				prevItem: iL.vars.prev,
				hide: function() {
					iL.closeAction();
				},
				refresh: function() {
					(arguments.length > 0) ? iL.repositionPhoto(true): iL.repositionPhoto();
				},
				fullscreen: function() {
					iL.fullScreenAction();
				}
			};
		},

		attachItems: function() {
			var iL = this,
				itemsObject = new Array(),
				items = new Array();

			$(iL.selector, iL.context).each(function() {
				var t = $(this),
					URL = t.attr(iL.options.attr) || null,
					options = t.data("options") && eval("({" + t.data("options") + "})") || {},
					caption = t.data('caption'),
					title = t.data('title'),
					type = t.data('type') || getTypeByExtension(URL);

				items.push({
					URL: URL,
					caption: caption,
					title: title,
					type: type,
					options: options
				});

				if (!iL.instant) itemsObject.push(t);
			});

			iL.items = items,
				iL.itemsObject = itemsObject;
		},

		normalizeItems: function() {
			var iL = this,
				newItems = new Array();

			$.each(iL.items, function(key, val) {

				if (typeof val == "string") val = {
					url: val
				};

				var URL = val.url || val.URL || null,
					options = val.options || {},
					caption = val.caption || null,
					title = val.title || null,
					type = (val.type) ? val.type.toLowerCase() : getTypeByExtension(URL),
					ext = (typeof URL != 'object') ? getExtension(URL) : '';

				options.thumbnail = options.thumbnail || ((type == "image") ? URL : null),
				options.videoType = options.videoType || null,
				options.skin = options.skin || iL.options.skin,
				options.width = options.width || null,
				options.height = options.height || null,
				options.mousewheel = (typeof options.mousewheel != 'undefined') ? options.mousewheel : true,
				options.swipe = (typeof options.swipe != 'undefined') ? options.swipe : true,
				options.social = (typeof options.social != 'undefined') ? options.social : iL.options.social.buttons && $.extend({}, {}, iL.options.social.buttons);

				if (type == "video") {
					options.html5video = (typeof options.html5video != 'undefined') ? options.html5video : {};

					options.html5video.webm = options.html5video.webm || options.html5video.WEBM || null;
					options.html5video.controls = (typeof options.html5video.controls != 'undefined') ? options.html5video.controls : "controls";
					options.html5video.preload = options.html5video.preload || "metadata";
					options.html5video.autoplay = (typeof options.html5video.autoplay != 'undefined') ? options.html5video.autoplay : false;
				}

				if (!options.width || !options.height) {
					if (type == "video") options.width = 1280, options.height = 720;
					else if (type == "iframe") options.width = '100%', options.height = '90%';
					else if (type == "flash") options.width = 1280, options.height = 720;
				}

				delete val.url;
				val.index = key;
				val.URL = URL;
				val.caption = caption;
				val.title = title;
				val.type = type;
				val.options = options;
				val.ext = ext;

				newItems.push(val);
			});

			iL.items = newItems;
		},

		instantCall: function() {
			var iL = this,
				key = iL.vars.start;

			iL.vars.current = key;
			iL.vars.next = (iL.items[key + 1]) ? key + 1 : null;
			iL.vars.prev = (iL.items[key - 1]) ? key - 1 : null;

			iL.addContents();
			iL.patchEvents();
		},

		addContents: function() {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				viewport = getViewport(),
				path = opts.path.toLowerCase(),
				recognizingItems = vars.total > 0 && iL.items.filter(function(e, i, arr) {
					return ['image', 'flash', 'video'].indexOf(e.type) === -1 && typeof e.recognized === 'undefined' && (opts.smartRecognition || e.options.smartRecognition);
				}),
				needRecognition = recognizingItems.length > 0;

			if (opts.mobileOptimizer && !opts.innerToolbar)
				vars.isMobile = viewport.width <= vars.mobileMaxWidth;

			vars.overlay.addClass(opts.skin).hide().css('opacity', opts.overlay.opacity);

			if (opts.linkId)
				vars.overlay[0].setAttribute('linkid', opts.linkId);

			//Add Toolbar Buttons
			if (opts.controls.toolbar) {
				vars.toolbar.addClass(opts.skin).append(vars.closeButton);
				if (opts.controls.fullscreen)
					vars.toolbar.append(vars.fullScreenButton);
				if (opts.controls.slideshow)
					vars.toolbar.append(vars.innerPlayButton);
				if (vars.total > 1)
					vars.toolbar.append(vars.innerPrevButton).append(vars.innerNextButton);
			}

			//Append elements to body
			vars.BODY.addClass('ilightbox-noscroll').append(vars.overlay).append(vars.loader).append(vars.holder).append(vars.nextPhoto).append(vars.prevPhoto);

			if (!opts.innerToolbar)
				vars.BODY.append(vars.toolbar);
			if (opts.controls.arrows)
				vars.BODY.append(vars.nextButton).append(vars.prevButton);

			if (opts.controls.thumbnail && vars.total > 1) {
				vars.BODY.append(vars.thumbnails);
				vars.thumbnails.addClass(opts.skin).addClass('ilightbox-' + path);
				$('div.ilightbox-thumbnails-grid', vars.thumbnails).empty();
				vars.thumbs = true;
			}

			//Configure loader and arrows
			var loaderCss = (opts.path.toLowerCase() == "horizontal") ? {
				left: parseInt((viewport.width / 2) - (vars.loader.outerWidth() / 2))
			} : {
				top: parseInt((viewport.height / 2) - (vars.loader.outerHeight() / 2))
			};
			vars.loader.addClass(opts.skin).css(loaderCss);
			vars.nextButton.add(vars.prevButton).addClass(opts.skin);
			if (path == "horizontal")
				vars.loader.add(vars.nextButton).add(vars.prevButton).addClass('horizontal');

			// Configure arrow buttons
			vars.BODY[vars.isMobile ? 'addClass' : 'removeClass']('isMobile');

			if (!opts.infinite) {
				vars.prevButton.add(vars.prevButton).add(vars.innerPrevButton).add(vars.innerNextButton).removeClass('disabled');

				if (vars.current == 0)
					vars.prevButton.add(vars.innerPrevButton).addClass('disabled');
				if (vars.current >= vars.total - 1)
					vars.nextButton.add(vars.innerNextButton).addClass('disabled');
			}

			if (opts.show.effect) {
				vars.overlay.stop().fadeIn(opts.show.speed);
				vars.toolbar.stop().fadeIn(opts.show.speed);
			} else {
				vars.overlay.show();
				vars.toolbar.show();
			}

			var length = recognizingItems.length;
			if (needRecognition) {
				iL.showLoader();

				$.each(recognizingItems, function(key, val) {
					var resultFnc = function(result) {
							var key = -1,
								filter = iL.items.filter(function(e, i, arr) {
									if (e.URL == result.url)
										key = i;

									return e.URL == result.url;
								}),
								self = iL.items[key];

							if (result)
								$.extend(true, self, {
									URL: result.source,
									type: result.type,
									recognized: true,
									options: {
										html5video: result.html5video,
										width: (result.type == "image") ? 0 : (result.width || self.width),
										height: (result.type == "image") ? 0 : (result.height || self.height),
										thumbnail: self.options.thumbnail || result.thumbnail
									}
								});

							length--;

							if (length == 0) {
								iL.hideLoader();

								vars.dontGenerateThumbs = false;
								iL.generateThumbnails();

								if (opts.show.effect)
									setTimeout(function() {
										iL.generateBoxes();
									}, opts.show.speed);
								else
									iL.generateBoxes();
							}
						};

					iL.ogpRecognition(this, resultFnc);
				});
			}
			else {
				if (opts.show.effect)
					setTimeout(function() {
						iL.generateBoxes();
					}, opts.show.speed);
				else
					iL.generateBoxes();
			}

			iL.createUI();

			window.iLightBox = {
				close: function() {
					iL.closeAction();
				},
				fullscreen: function() {
					iL.fullScreenAction();
				},
				moveNext: function() {
					iL.moveTo('next');
				},
				movePrev: function() {
					iL.moveTo('prev');
				},
				goTo: function(index) {
					iL.goTo(index);
				},
				refresh: function() {
					iL.refresh();
				},
				reposition: function() {
					(arguments.length > 0) ? iL.repositionPhoto(true): iL.repositionPhoto();
				},
				setOption: function(options) {
					iL.setOption(options);
				},
				destroy: function() {
					iL.closeAction();
					iL.dispatchItemsEvents();
				}
			};

			if (opts.linkId) {
				vars.hashLock = true;
				window.location.hash = opts.linkId + '/' + vars.current;
				setTimeout(function() {
					vars.hashLock = false;
				}, 55);
			}

			if (!opts.slideshow.startPaused) {
				iL.resume();
				vars.innerPlayButton.removeClass('ilightbox-play').addClass('ilightbox-pause');
			}

			//Trigger the onOpen callback
			if (typeof iL.options.callback.onOpen == 'function') iL.options.callback.onOpen.call(iL);
		},

		loadContent: function(obj, opt, speed) {
			var iL = this,
				holder, item;

			iL.createUI();

			obj.speed = speed || iL.options.effects.loadedFadeSpeed;

			if (opt == 'current') {
				if (!obj.options.mousewheel) iL.vars.lockWheel = true;
				else iL.vars.lockWheel = false;

				if (!obj.options.swipe) iL.vars.lockSwipe = true;
				else iL.vars.lockSwipe = false;
			}

			switch (opt) {
				case 'current':
					holder = iL.vars.holder, item = iL.vars.current;
					break;
				case 'next':
					holder = iL.vars.nextPhoto, item = iL.vars.next;
					break;
				case 'prev':
					holder = iL.vars.prevPhoto, item = iL.vars.prev;
					break;
			}

			holder.removeAttr('style class').addClass('ilightbox-holder' + (supportTouch ? ' supportTouch' : '')).addClass(obj.options.skin);
			$('div.ilightbox-inner-toolbar', holder).remove();

			if (obj.title || iL.options.innerToolbar) {
				var innerToolbar = iL.vars.innerToolbar.clone();
				if (obj.title && iL.options.show.title) {
					var title = iL.vars.title.clone();
					title.empty().html(obj.title);
					innerToolbar.append(title);
				}
				if (iL.options.innerToolbar) {
					innerToolbar.append((iL.vars.total > 1) ? iL.vars.toolbar.clone() : iL.vars.toolbar);
				}
				holder.prepend(innerToolbar);
			}

			iL.loadSwitcher(obj, holder, item, opt);
		},

		loadSwitcher: function(obj, holder, item, opt) {
			var iL = this,
				opts = iL.options,
				api = {
					element: holder,
					position: item
				};

			switch (obj.type) {
				case 'image':
					//Trigger the onBeforeLoad callback
					if (typeof opts.callback.onBeforeLoad == 'function') opts.callback.onBeforeLoad.call(iL, iL.ui, item);
					if (typeof obj.options.onBeforeLoad == 'function') obj.options.onBeforeLoad.call(iL, api);

					iL.loadImage(obj.URL, function(img) {
						//Trigger the onAfterLoad callback
						if (typeof opts.callback.onAfterLoad == 'function') opts.callback.onAfterLoad.call(iL, iL.ui, item);
						if (typeof obj.options.onAfterLoad == 'function') obj.options.onAfterLoad.call(iL, api);

						var width = (img) ? img.width : 400,
							height = (img) ? img.height : 200;

						holder.data({
							naturalWidth: width,
							naturalHeight: height
						});
						$('div.ilightbox-container', holder).empty().append((img) ? '<img src="' + obj.URL + '" class="ilightbox-image" />' : '<span class="ilightbox-alert">' + opts.errors.loadImage + '</span>');

						//Trigger the onRender callback
						if (typeof opts.callback.onRender == 'function') opts.callback.onRender.call(iL, iL.ui, item);
						if (typeof obj.options.onRender == 'function') obj.options.onRender.call(iL, api);

						iL.configureHolder(obj, opt, holder);
					});

					break;

				case 'video':
					holder.data({
						naturalWidth: obj.options.width,
						naturalHeight: obj.options.height
					});

					iL.addContent(holder, obj);

					//Trigger the onRender callback
					if (typeof opts.callback.onRender == 'function') opts.callback.onRender.call(iL, iL.ui, item);
					if (typeof obj.options.onRender == 'function') obj.options.onRender.call(iL, api);

					iL.configureHolder(obj, opt, holder);

					break;

				case 'iframe':
					iL.showLoader();
					holder.data({
						naturalWidth: obj.options.width,
						naturalHeight: obj.options.height
					});
					var el = iL.addContent(holder, obj);

					//Trigger the onRender callback
					if (typeof opts.callback.onRender == 'function') opts.callback.onRender.call(iL, iL.ui, item);
					if (typeof obj.options.onRender == 'function') obj.options.onRender.call(iL, api);

					//Trigger the onBeforeLoad callback
					if (typeof opts.callback.onBeforeLoad == 'function') opts.callback.onBeforeLoad.call(iL, iL.ui, item);
					if (typeof obj.options.onBeforeLoad == 'function') obj.options.onBeforeLoad.call(iL, api);

					el.bind('load', function() {
						//Trigger the onAfterLoad callback
						if (typeof opts.callback.onAfterLoad == 'function') opts.callback.onAfterLoad.call(iL, iL.ui, item);
						if (typeof obj.options.onAfterLoad == 'function') obj.options.onAfterLoad.call(iL, api);

						iL.hideLoader();
						iL.configureHolder(obj, opt, holder);
						el.unbind('load');
					});

					break;

				case 'inline':
					var el = $(obj.URL),
						content = iL.addContent(holder, obj),
						images = findImageInElement(holder);

					holder.data({
						naturalWidth: (iL.items[item].options.width || el.outerWidth()),
						naturalHeight: (iL.items[item].options.height || el.outerHeight())
					});
					content.children().eq(0).show();

					//Trigger the onRender callback
					if (typeof opts.callback.onRender == 'function') opts.callback.onRender.call(iL, iL.ui, item);
					if (typeof obj.options.onRender == 'function') obj.options.onRender.call(iL, api);

					//Trigger the onBeforeLoad callback
					if (typeof opts.callback.onBeforeLoad == 'function') opts.callback.onBeforeLoad.call(iL, iL.ui, item);
					if (typeof obj.options.onBeforeLoad == 'function') obj.options.onBeforeLoad.call(iL, api);

					iL.loadImage(images, function() {
						//Trigger the onAfterLoad callback
						if (typeof opts.callback.onAfterLoad == 'function') opts.callback.onAfterLoad.call(iL, iL.ui, item);
						if (typeof obj.options.onAfterLoad == 'function') obj.options.onAfterLoad.call(iL, api);

						iL.configureHolder(obj, opt, holder);
					});

					break;

				case 'flash':
					var el = iL.addContent(holder, obj);

					holder.data({
						naturalWidth: (iL.items[item].options.width || el.outerWidth()),
						naturalHeight: (iL.items[item].options.height || el.outerHeight())
					});

					//Trigger the onRender callback
					if (typeof opts.callback.onRender == 'function') opts.callback.onRender.call(iL, iL.ui, item);
					if (typeof obj.options.onRender == 'function') obj.options.onRender.call(iL, api);

					iL.configureHolder(obj, opt, holder);

					break;

				case 'ajax':
					var ajax = obj.options.ajax || {};
					//Trigger the onBeforeLoad callback
					if (typeof opts.callback.onBeforeLoad == 'function') opts.callback.onBeforeLoad.call(iL, iL.ui, item);
					if (typeof obj.options.onBeforeLoad == 'function') obj.options.onBeforeLoad.call(iL, api);

					iL.showLoader();
					$.ajax({
						url: obj.URL || opts.ajaxSetup.url,
						data: ajax.data || null,
						dataType: ajax.dataType || "html",
						type: ajax.type || opts.ajaxSetup.type,
						cache: ajax.cache || opts.ajaxSetup.cache,
						crossDomain: ajax.crossDomain || opts.ajaxSetup.crossDomain,
						global: ajax.global || opts.ajaxSetup.global,
						ifModified: ajax.ifModified || opts.ajaxSetup.ifModified,
						username: ajax.username || opts.ajaxSetup.username,
						password: ajax.password || opts.ajaxSetup.password,
						beforeSend: ajax.beforeSend || opts.ajaxSetup.beforeSend,
						complete: ajax.complete || opts.ajaxSetup.complete,
						success: function(data, textStatus, jqXHR) {
							iL.hideLoader();

							var el = $(data),
								container = $('div.ilightbox-container', holder),
								elWidth = iL.items[item].options.width || parseInt(el[0].getAttribute('width')),
								elHeight = iL.items[item].options.height || parseInt(el[0].getAttribute('height')),
								css = (el[0].getAttribute('width') && el[0].getAttribute('height')) ? {
									'overflow': 'hidden'
								} : {};

							container.empty().append($('<div class="ilightbox-wrapper"></div>').css(css).html(el));
							holder.show().data({
								naturalWidth: (elWidth || container.outerWidth()),
								naturalHeight: (elHeight || container.outerHeight())
							}).hide();

							//Trigger the onRender callback
							if (typeof opts.callback.onRender == 'function') opts.callback.onRender.call(iL, iL.ui, item);
							if (typeof obj.options.onRender == 'function') obj.options.onRender.call(iL, api);

							var images = findImageInElement(holder);
							iL.loadImage(images, function() {
								//Trigger the onAfterLoad callback
								if (typeof opts.callback.onAfterLoad == 'function') opts.callback.onAfterLoad.call(iL, iL.ui, item);
								if (typeof obj.options.onAfterLoad == 'function') obj.options.onAfterLoad.call(iL, api);

								iL.configureHolder(obj, opt, holder);
							});

							opts.ajaxSetup.success(data, textStatus, jqXHR);
							if (typeof ajax.success == 'function') ajax.success(data, textStatus, jqXHR);
						},
						error: function(jqXHR, textStatus, errorThrown) {
							//Trigger the onAfterLoad callback
							if (typeof opts.callback.onAfterLoad == 'function') opts.callback.onAfterLoad.call(iL, iL.ui, item);
							if (typeof obj.options.onAfterLoad == 'function') obj.options.onAfterLoad.call(iL, api);

							iL.hideLoader();
							$('div.ilightbox-container', holder).empty().append('<span class="ilightbox-alert">' + opts.errors.loadContents + '</span>');
							iL.configureHolder(obj, opt, holder);

							opts.ajaxSetup.error(jqXHR, textStatus, errorThrown);
							if (typeof ajax.error == 'function') ajax.error(jqXHR, textStatus, errorThrown);
						}
					});

					break;

				case 'html':
					var object = obj.URL,
						el
					container = $('div.ilightbox-container', holder);

					if (object[0].nodeName) el = object.clone();
					else {
						var dom = $(object);
						if (dom.selector) el = $('<div>' + dom + '</div>');
						else el = dom;
					}

					var elWidth = iL.items[item].options.width || parseInt(el.attr('width')),
						elHeight = iL.items[item].options.height || parseInt(el.attr('height'));

					iL.addContent(holder, obj);

					el.appendTo(document.documentElement).hide();

					//Trigger the onRender callback
					if (typeof opts.callback.onRender == 'function') opts.callback.onRender.call(iL, iL.ui, item);
					if (typeof obj.options.onRender == 'function') obj.options.onRender.call(iL, api);

					var images = findImageInElement(holder);

					//Trigger the onBeforeLoad callback
					if (typeof opts.callback.onBeforeLoad == 'function') opts.callback.onBeforeLoad.call(iL, iL.ui, item);
					if (typeof obj.options.onBeforeLoad == 'function') obj.options.onBeforeLoad.call(iL, api);

					iL.loadImage(images, function() {
						//Trigger the onAfterLoad callback
						if (typeof opts.callback.onAfterLoad == 'function') opts.callback.onAfterLoad.call(iL, iL.ui, item);
						if (typeof obj.options.onAfterLoad == 'function') obj.options.onAfterLoad.call(iL, api);

						holder.show().data({
							naturalWidth: (elWidth || container.outerWidth()),
							naturalHeight: (elHeight || container.outerHeight())
						}).hide();
						el.remove();

						iL.configureHolder(obj, opt, holder);
					});

					break;
			}
		},

		configureHolder: function(obj, opt, holder) {
			var iL = this,
				vars = iL.vars,
				opts = iL.options;

			if (opt != "current")(opt == "next") ? holder.addClass('ilightbox-next') : holder.addClass('ilightbox-prev');

			if (opt == "current")
				var item = vars.current;
			else if (opt == "next")
				var opacity = opts.styles.nextOpacity,
					item = vars.next;
			else
				var opacity = opts.styles.prevOpacity,
					item = vars.prev;

			var api = {
				element: holder,
				position: item
			};

			iL.items[item].options.width = iL.items[item].options.width || 0,
				iL.items[item].options.height = iL.items[item].options.height || 0;

			if (opt == "current") {
				if (opts.show.effect) holder.css(transform, gpuAcceleration).fadeIn(obj.speed, function() {
					holder.css(transform, '');
					if (obj.caption) {
						iL.setCaption(obj, holder);
						var caption = $('div.ilightbox-caption', holder),
							percent = parseInt((caption.outerHeight() / holder.outerHeight()) * 100);
						if (opts.caption.start & percent <= 50) caption.fadeIn(opts.effects.fadeSpeed);
					}

					var social = obj.options.social;
					if (social) {
						iL.setSocial(social, obj.URL, holder);
						if (opts.social.start) $('div.ilightbox-social', holder).fadeIn(opts.effects.fadeSpeed);
					}

					//Generate thumbnails
					iL.generateThumbnails();

					//Trigger the onShow callback
					if (typeof opts.callback.onShow == 'function') opts.callback.onShow.call(iL, iL.ui, item);
					if (typeof obj.options.onShow == 'function') obj.options.onShow.call(iL, api);
				});
				else {
					holder.show();

					//Generate thumbnails
					iL.generateThumbnails();

					//Trigger the onShow callback
					if (typeof opts.callback.onShow == 'function') opts.callback.onShow.call(iL, iL.ui, item);
					if (typeof obj.options.onShow == 'function') obj.options.onShow.call(iL, api);
				}
			} else {
				if (opts.show.effect) holder.fadeTo(obj.speed, opacity, function() {
					if (opt == "next") vars.nextLock = false;
					else vars.prevLock = false;

					//Generate thumbnails
					iL.generateThumbnails();

					//Trigger the onShow callback
					if (typeof opts.callback.onShow == 'function') opts.callback.onShow.call(iL, iL.ui, item);
					if (typeof obj.options.onShow == 'function') obj.options.onShow.call(iL, api);
				});
				else {
					holder.css({
						opacity: opacity
					}).show();
					if (opt == "next") vars.nextLock = false;
					else vars.prevLock = false;

					//Generate thumbnails
					iL.generateThumbnails();

					//Trigger the onShow callback
					if (typeof opts.callback.onShow == 'function') opts.callback.onShow.call(iL, iL.ui, item);
					if (typeof obj.options.onShow == 'function') obj.options.onShow.call(iL, api);
				}
			}

			setTimeout(function() {
				iL.repositionPhoto();
			}, 0);
		},

		generateBoxes: function() {
			var iL = this,
				vars = iL.vars,
				opts = iL.options;

			if (opts.infinite && vars.total >= 3) {
				if (vars.current == vars.total - 1) vars.next = 0;
				if (vars.current == 0) vars.prev = vars.total - 1;
			} else opts.infinite = false;

			iL.loadContent(iL.items[vars.current], 'current', opts.show.speed);

			if (iL.items[vars.next]) iL.loadContent(iL.items[vars.next], 'next', opts.show.speed);
			if (iL.items[vars.prev]) iL.loadContent(iL.items[vars.prev], 'prev', opts.show.speed);
		},

		generateThumbnails: function() {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				timeOut = null;

			if (vars.thumbs && !iL.vars.dontGenerateThumbs) {
				var thumbnails = vars.thumbnails,
					container = $('div.ilightbox-thumbnails-container', thumbnails),
					grid = $('div.ilightbox-thumbnails-grid', container),
					i = 0;

				grid.removeAttr('style').empty();

				$.each(iL.items, function(key, val) {
					var isActive = (vars.current == key) ? 'ilightbox-active' : '',
						opacity = (vars.current == key) ? opts.thumbnails.activeOpacity : opts.thumbnails.normalOpacity,
						thumb = val.options.thumbnail,
						thumbnail = $('<div class="ilightbox-thumbnail"></div>'),
						icon = $('<div class="ilightbox-thumbnail-icon"></div>');

					thumbnail.css({
						opacity: 0
					}).addClass(isActive);

					if ((val.type == "video" || val.type == "flash") && typeof val.options.icon == 'undefined') {
						icon.addClass('ilightbox-thumbnail-video');
						thumbnail.append(icon);
					} else if (val.options.icon) {
						icon.addClass('ilightbox-thumbnail-' + val.options.icon);
						thumbnail.append(icon);
					}

					if (thumb) iL.loadImage(thumb, function(img) {
						i++;
						if (img) thumbnail.data({
							naturalWidth: img.width,
							naturalHeight: img.height
						}).append('<img src="' + thumb + '" border="0" />');
						else thumbnail.data({
							naturalWidth: opts.thumbnails.maxWidth,
							naturalHeight: opts.thumbnails.maxHeight
						});

						clearTimeout(timeOut);
						timeOut = setTimeout(function() {
							iL.positionThumbnails(thumbnails, container, grid);
						}, 20);
						setTimeout(function() {
							thumbnail.fadeTo(opts.effects.loadedFadeSpeed, opacity);
						}, i * 20);
					});

					grid.append(thumbnail);
				});
				iL.vars.dontGenerateThumbs = true;
			}
		},

		positionThumbnails: function(thumbnails, container, grid) {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				viewport = getViewport(),
				path = opts.path.toLowerCase();

			if (!thumbnails) thumbnails = vars.thumbnails;
			if (!container) container = $('div.ilightbox-thumbnails-container', thumbnails);
			if (!grid) grid = $('div.ilightbox-thumbnails-grid', container);

			var thumbs = $('.ilightbox-thumbnail', grid),
				widthAvail = (path == 'horizontal') ? viewport.width - opts.styles.pageOffsetX : thumbs.eq(0).outerWidth() - opts.styles.pageOffsetX,
				heightAvail = (path == 'horizontal') ? thumbs.eq(0).outerHeight() - opts.styles.pageOffsetY : viewport.height - opts.styles.pageOffsetY,
				gridWidth = (path == 'horizontal') ? 0 : widthAvail,
				gridHeight = (path == 'horizontal') ? heightAvail : 0,
				active = $('.ilightbox-active', grid),
				gridCss = {},
				css = {};

			if (arguments.length < 3) {
				thumbs.css({
					opacity: opts.thumbnails.normalOpacity
				});
				active.css({
					opacity: opts.thumbnails.activeOpacity
				});
			}

			thumbs.each(function(i) {
				var t = $(this),
					data = t.data(),
					width = (path == 'horizontal') ? 0 : opts.thumbnails.maxWidth;
				height = (path == 'horizontal') ? opts.thumbnails.maxHeight : 0;
				dims = iL.getNewDimenstions(width, height, data.naturalWidth, data.naturalHeight, true);

				t.css({
					width: dims.width,
					height: dims.height
				});
				if (path == 'horizontal') t.css({
					'float': 'left'
				});

				(path == 'horizontal') ? (
					gridWidth += t.outerWidth()
				) : (
					gridHeight += t.outerHeight()
				);
			});

			gridCss = {
				width: gridWidth,
				height: gridHeight
			};

			grid.css(gridCss);

			gridCss = {};

			var gridOffset = grid.offset(),
				activeOffset = (active.length) ? active.offset() : {
					top: parseInt(heightAvail / 2),
					left: parseInt(widthAvail / 2)
				};

			gridOffset.top = (gridOffset.top - $doc.scrollTop()),
				gridOffset.left = (gridOffset.left - $doc.scrollLeft()),
				activeOffset.top = (activeOffset.top - gridOffset.top - $doc.scrollTop()),
				activeOffset.left = (activeOffset.left - gridOffset.left - $doc.scrollLeft());

			(path == 'horizontal') ? (
				gridCss.top = 0,
				gridCss.left = parseInt((widthAvail / 2) - activeOffset.left - (active.outerWidth() / 2))
			) : (
				gridCss.top = parseInt(((heightAvail / 2) - activeOffset.top - (active.outerHeight() / 2))),
				gridCss.left = 0
			);

			if (arguments.length < 3) grid.stop().animate(gridCss, opts.effects.repositionSpeed, 'easeOutCirc');
			else grid.css(gridCss);
		},

		loadImage: function(image, callback) {
			if (!$.isArray(image)) image = [image];

			var iL = this,
				length = image.length;

			if (length > 0) {
				iL.showLoader();
				$.each(image, function(index, value) {
					var img = new Image();
					img.onload = function() {
						length -= 1;
						if (length == 0) {
							iL.hideLoader();
							callback(img);
						}
					};
					img.onerror = img.onabort = function() {
						length -= 1;
						if (length == 0) {
							iL.hideLoader();
							callback(false);
						}
					};
					img.src = image[index];
				});
			} else callback(false);
		},

		patchItemsEvents: function() {
			var iL = this,
				vars = iL.vars,
				clickEvent = supportTouch ? "itap.iL" : "click.iL",
				vEvent = supportTouch ? "click.iL" : "itap.iL";

			if (iL.context && iL.selector) {
				var $items = $(iL.selector, iL.context);

				$(iL.context).on(clickEvent, iL.selector, function() {
					var $this = $(this),
						key = $items.index($this);

					vars.current = key;
					vars.next = iL.items[key + 1] ? key + 1 : null;
					vars.prev = iL.items[key - 1] ? key - 1 : null;

					iL.addContents();
					iL.patchEvents();

					return false;
				}).on(vEvent, iL.selector, function() {
					return false;
				});
			} else
				$.each(iL.itemsObject, function(key, val) {
					val.on(clickEvent, function() {
						vars.current = key;
						vars.next = iL.items[key + 1] ? key + 1 : null;
						vars.prev = iL.items[key - 1] ? key - 1 : null;

						iL.addContents();
						iL.patchEvents();

						return false;
					}).on(vEvent, function() {
						return false;
					});
				});
		},

		dispatchItemsEvents: function() {
			var iL = this,
				vars = iL.vars,
				opts = iL.options;

			if (iL.context && iL.selector)
				$(iL.context).off('.iL', iL.selector);
			else
				$.each(iL.itemsObject, function(key, val) {
					val.off('.iL');
				});
		},

		refresh: function() {
			var iL = this;

			iL.dispatchItemsEvents();
			iL.attachItems();
			iL.normalizeItems();
			iL.patchItemsEvents();
		},

		patchEvents: function() {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				path = opts.path.toLowerCase(),
				holders = $('.ilightbox-holder'),
				fullscreenEvent = fullScreenApi.fullScreenEventName + '.iLightBox',
				durationThreshold = 1000,
				horizontalDistanceThreshold =
				verticalDistanceThreshold = 100,
				buttonsArray = [vars.nextButton[0], vars.prevButton[0], vars.nextButton[0].firstChild, vars.prevButton[0].firstChild];

			$win.bind('resize.iLightBox', function() {
				var viewport = getViewport();

				if (opts.mobileOptimizer && !opts.innerToolbar) vars.isMobile = viewport.width <= vars.mobileMaxWidth;
				vars.BODY[vars.isMobile ? 'addClass' : 'removeClass']('isMobile');

				iL.repositionPhoto(null);
				if (supportTouch) {
					clearTimeout(vars.setTime);
					vars.setTime = setTimeout(function() {
						var scrollTop = getScrollXY().y;
						window.scrollTo(0, scrollTop - 30);
						window.scrollTo(0, scrollTop + 30);
						window.scrollTo(0, scrollTop);
					}, 2000);
				}
				if (vars.thumbs) iL.positionThumbnails();
			}).bind('keydown.iLightBox', function(event) {
				if (opts.controls.keyboard) {
					switch (event.keyCode) {
						case 13:
							if (event.shiftKey && opts.keyboard.shift_enter) iL.fullScreenAction();
							break;
						case 27:
							if (opts.keyboard.esc) iL.closeAction();
							break;
						case 37:
							if (opts.keyboard.left && !vars.lockKey) iL.moveTo('prev');
							break;
						case 38:
							if (opts.keyboard.up && !vars.lockKey) iL.moveTo('prev');
							break;
						case 39:
							if (opts.keyboard.right && !vars.lockKey) iL.moveTo('next');
							break;
						case 40:
							if (opts.keyboard.down && !vars.lockKey) iL.moveTo('next');
							break;
					}
				}
			});

			if (fullScreenApi.supportsFullScreen) $win.bind(fullscreenEvent, function() {
				iL.doFullscreen();
			});

			var holderEventsArr = [opts.caption.show + '.iLightBox', opts.caption.hide + '.iLightBox', opts.social.show + '.iLightBox', opts.social.hide + '.iLightBox'].filter(function(e, i, arr) {
					return arr.lastIndexOf(e) === i;
				}),
				holderEvents = "";

			$.each(holderEventsArr, function(key, val) {
				if (key != 0) holderEvents += ' ';
				holderEvents += val;
			});

			$doc.on(clickEvent, '.ilightbox-overlay', function() {
				if (opts.overlay.blur) iL.closeAction();
			}).on(clickEvent, '.ilightbox-next, .ilightbox-next-button', function() {
				iL.moveTo('next');
			}).on(clickEvent, '.ilightbox-prev, .ilightbox-prev-button', function() {
				iL.moveTo('prev');
			}).on(clickEvent, '.ilightbox-thumbnail', function() {
				var t = $(this),
					thumbs = $('.ilightbox-thumbnail', vars.thumbnails),
					index = thumbs.index(t);

				if (index != vars.current) iL.goTo(index);
			}).on(holderEvents, '.ilightbox-holder:not(.ilightbox-next, .ilightbox-prev)', function(e) {
				var caption = $('div.ilightbox-caption', vars.holder),
					social = $('div.ilightbox-social', vars.holder),
					fadeSpeed = opts.effects.fadeSpeed;

				if (vars.nextLock || vars.prevLock) {
					if (e.type == opts.caption.show && !caption.is(':visible')) caption.fadeIn(fadeSpeed);
					else if (e.type == opts.caption.hide && caption.is(':visible')) caption.fadeOut(fadeSpeed);

					if (e.type == opts.social.show && !social.is(':visible')) social.fadeIn(fadeSpeed);
					else if (e.type == opts.social.hide && social.is(':visible')) social.fadeOut(fadeSpeed);
				} else {
					if (e.type == opts.caption.show && !caption.is(':visible')) caption.stop().fadeIn(fadeSpeed);
					else if (e.type == opts.caption.hide && caption.is(':visible')) caption.stop().fadeOut(fadeSpeed);

					if (e.type == opts.social.show && !social.is(':visible')) social.stop().fadeIn(fadeSpeed);
					else if (e.type == opts.social.hide && social.is(':visible')) social.stop().fadeOut(fadeSpeed);
				}
			}).on('mouseenter.iLightBox mouseleave.iLightBox', '.ilightbox-wrapper', function(e) {
				if (e.type == 'mouseenter') vars.lockWheel = true;
				else vars.lockWheel = false;
			}).on(clickEvent, '.ilightbox-toolbar a.ilightbox-close, .ilightbox-toolbar a.ilightbox-fullscreen, .ilightbox-toolbar a.ilightbox-play, .ilightbox-toolbar a.ilightbox-pause', function() {
				var t = $(this);

				if (t.hasClass('ilightbox-fullscreen')) iL.fullScreenAction();
				else if (t.hasClass('ilightbox-play')) {
					iL.resume();
					t.addClass('ilightbox-pause').removeClass('ilightbox-play');
				} else if (t.hasClass('ilightbox-pause')) {
					iL.pause();
					t.addClass('ilightbox-play').removeClass('ilightbox-pause');
				} else iL.closeAction();
			}).on(touchMoveEvent, '.ilightbox-overlay, .ilightbox-thumbnails-container', function(e) {
				// prevent scrolling
				e.preventDefault();
			});

			function mouseMoveHandler(e) {
				if (!vars.isMobile) {
					if (!vars.mouseID) {
						vars.hideableElements.show();
					}

					vars.mouseID = clearTimeout(vars.mouseID);

					if (buttonsArray.indexOf(e.target) === -1)
						vars.mouseID = setTimeout(function() {
							vars.hideableElements.hide();
							vars.mouseID = clearTimeout(vars.mouseID);
						}, 3000);
				}
			}

			if (opts.controls.arrows && !supportTouch) $doc.on('mousemove.iLightBox', mouseMoveHandler);

			if (opts.controls.slideshow && opts.slideshow.pauseOnHover) $doc.on('mouseenter.iLightBox mouseleave.iLightBox', '.ilightbox-holder:not(.ilightbox-next, .ilightbox-prev)', function(e) {
				if (e.type == 'mouseenter' && vars.cycleID) iL.pause();
				else if (e.type == 'mouseleave' && vars.isPaused) iL.resume();
			});

			var switchers = $('.ilightbox-overlay, .ilightbox-holder, .ilightbox-thumbnails');

			if (opts.controls.mousewheel) switchers.on('mousewheel.iLightBox', function(event, delta) {
				if (!vars.lockWheel) {
					event.preventDefault();
					if (delta < 0) iL.moveTo('next');
					else if (delta > 0) iL.moveTo('prev');
				}
			});

			if (opts.controls.swipe) holders.on(touchStartEvent, function(event) {
				if (vars.nextLock || vars.prevLock || vars.total == 1 || vars.lockSwipe) return;

				vars.BODY.addClass('ilightbox-closedhand');

				var data = event.originalEvent.touches ? event.originalEvent.touches[0] : event,
					scrollTop = $doc.scrollTop(),
					scrollLeft = $doc.scrollLeft(),
					offsets = [
						holders.eq(0).offset(),
						holders.eq(1).offset(),
						holders.eq(2).offset()
					],
					offSet = [{
						top: offsets[0].top - scrollTop,
						left: offsets[0].left - scrollLeft
					}, {
						top: offsets[1].top - scrollTop,
						left: offsets[1].left - scrollLeft
					}, {
						top: offsets[2].top - scrollTop,
						left: offsets[2].left - scrollLeft
					}],
					start = {
						time: (new Date()).getTime(),
						coords: [data.pageX - scrollLeft, data.pageY - scrollTop]
					},
					stop;

				function moveEachHandler(i) {
					var t = $(this),
						offset = offSet[i],
						scroll = [(start.coords[0] - stop.coords[0]), (start.coords[1] - stop.coords[1])];

					t[0].style[path == "horizontal" ? 'left' : 'top'] = (path == "horizontal" ? offset.left - scroll[0] : offset.top - scroll[1]) + 'px';
				}

				function moveHandler(event) {

					if (!start) return;

					var data = event.originalEvent.touches ? event.originalEvent.touches[0] : event;

					stop = {
						time: (new Date()).getTime(),
						coords: [data.pageX - scrollLeft, data.pageY - scrollTop]
					};

					holders.each(moveEachHandler);

					// prevent scrolling
					event.preventDefault();
				}

				function repositionHolders() {
					holders.each(function() {
						var t = $(this),
							offset = t.data('offset') || {
								top: t.offset().top - scrollTop,
								left: t.offset().left - scrollLeft
							},
							top = offset.top,
							left = offset.left;

						t.css(transform, gpuAcceleration).stop().animate({
							top: top,
							left: left
						}, 500, 'easeOutCirc', function() {
							t.css(transform, '');
						});
					});
				}

				holders.bind(touchMoveEvent, moveHandler);
				$doc.one(touchStopEvent, function(event) {
					holders.unbind(touchMoveEvent, moveHandler);

					vars.BODY.removeClass('ilightbox-closedhand');

					if (start && stop) {
						if (path == "horizontal" && stop.time - start.time < durationThreshold && abs(start.coords[0] - stop.coords[0]) > horizontalDistanceThreshold && abs(start.coords[1] - stop.coords[1]) < verticalDistanceThreshold) {
							if (start.coords[0] > stop.coords[0]) {
								if (vars.current == vars.total - 1 && !opts.infinite) repositionHolders();
								else {
									vars.isSwipe = true;
									iL.moveTo('next');
								}
							} else {
								if (vars.current == 0 && !opts.infinite) repositionHolders();
								else {
									vars.isSwipe = true;
									iL.moveTo('prev');
								}
							}
						} else if (path == "vertical" && stop.time - start.time < durationThreshold && abs(start.coords[1] - stop.coords[1]) > horizontalDistanceThreshold && abs(start.coords[0] - stop.coords[0]) < verticalDistanceThreshold) {
							if (start.coords[1] > stop.coords[1]) {
								if (vars.current == vars.total - 1 && !opts.infinite) repositionHolders();
								else {
									vars.isSwipe = true;
									iL.moveTo('next');
								}
							} else {
								if (vars.current == 0 && !opts.infinite) repositionHolders();
								else {
									vars.isSwipe = true;
									iL.moveTo('prev');
								}
							}
						} else repositionHolders();
					}
					start = stop = undefined;
				});
			});

		},

		goTo: function(index) {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				diff = (index - vars.current);

			if (opts.infinite) {
				if (index == vars.total - 1 && vars.current == 0) diff = -1;
				if (vars.current == vars.total - 1 && index == 0) diff = 1;
			}

			if (diff == 1) iL.moveTo('next');
			else if (diff == -1) iL.moveTo('prev');
			else {

				if (vars.nextLock || vars.prevLock) return false;

				//Trigger the onBeforeChange callback
				if (typeof opts.callback.onBeforeChange == 'function') opts.callback.onBeforeChange.call(iL, iL.ui);

				if (opts.linkId) {
					vars.hashLock = true;
					window.location.hash = opts.linkId + '/' + index;
				}

				if (iL.items[index]) {
					if (!iL.items[index].options.mousewheel) vars.lockWheel = true;
					else iL.vars.lockWheel = false;

					if (!iL.items[index].options.swipe) vars.lockSwipe = true;
					else vars.lockSwipe = false;
				}

				$.each([vars.holder, vars.nextPhoto, vars.prevPhoto], function(key, val) {
					val.css(transform, gpuAcceleration).fadeOut(opts.effects.loadedFadeSpeed);
				});

				vars.current = index;
				vars.next = index + 1;
				vars.prev = index - 1;

				iL.createUI();

				setTimeout(function() {
					iL.generateBoxes();
				}, opts.effects.loadedFadeSpeed + 50);

				$('.ilightbox-thumbnail', vars.thumbnails).removeClass('ilightbox-active').eq(index).addClass('ilightbox-active');
				iL.positionThumbnails();

				if (opts.linkId) setTimeout(function() {
					vars.hashLock = false;
				}, 55);

				// Configure arrow buttons
				if (!opts.infinite) {
					vars.nextButton.add(vars.prevButton).add(vars.innerPrevButton).add(vars.innerNextButton).removeClass('disabled');

					if (vars.current == 0) {
						vars.prevButton.add(vars.innerPrevButton).addClass('disabled');
					}
					if (vars.current >= vars.total - 1) {
						vars.nextButton.add(vars.innerNextButton).addClass('disabled');
					}
				}

				// Reset next cycle timeout
				iL.resetCycle();

				//Trigger the onAfterChange callback
				if (typeof opts.callback.onAfterChange == 'function') opts.callback.onAfterChange.call(iL, iL.ui);
			}
		},

		moveTo: function(side) {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				path = opts.path.toLowerCase(),
				viewport = getViewport(),
				switchSpeed = opts.effects.switchSpeed;

			if (vars.nextLock || vars.prevLock) return false;
			else {

				var item = (side == "next") ? vars.next : vars.prev;

				if (opts.linkId) {
					vars.hashLock = true;
					window.location.hash = opts.linkId + '/' + item;
				}

				if (side == "next") {
					if (!iL.items[item]) return false;
					var firstHolder = vars.nextPhoto,
						secondHolder = vars.holder,
						lastHolder = vars.prevPhoto,
						firstClass = 'ilightbox-prev',
						secondClass = 'ilightbox-next';
				} else if (side == "prev") {
					if (!iL.items[item]) return false;
					var firstHolder = vars.prevPhoto,
						secondHolder = vars.holder,
						lastHolder = vars.nextPhoto,
						firstClass = 'ilightbox-next',
						secondClass = 'ilightbox-prev';
				}

				//Trigger the onBeforeChange callback
				if (typeof opts.callback.onBeforeChange == 'function')
					opts.callback.onBeforeChange.call(iL, iL.ui);

				(side == "next") ? vars.nextLock = true: vars.prevLock = true;

				var captionFirst = $('div.ilightbox-caption', secondHolder),
					socialFirst = $('div.ilightbox-social', secondHolder);

				if (captionFirst.length)
					captionFirst.stop().fadeOut(switchSpeed, function() {
						$(this).remove();
					});
				if (socialFirst.length)
					socialFirst.stop().fadeOut(switchSpeed, function() {
						$(this).remove();
					});

				if (iL.items[item].caption) {
					iL.setCaption(iL.items[item], firstHolder);
					var caption = $('div.ilightbox-caption', firstHolder),
						percent = parseInt((caption.outerHeight() / firstHolder.outerHeight()) * 100);
					if (opts.caption.start && percent <= 50) caption.fadeIn(switchSpeed);
				}

				var social = iL.items[item].options.social;
				if (social) {
					iL.setSocial(social, iL.items[item].URL, firstHolder);
					if (opts.social.start) $('div.ilightbox-social', firstHolder).fadeIn(opts.effects.fadeSpeed);
				}

				$.each([firstHolder, secondHolder, lastHolder], function(key, val) {
					val.removeClass('ilightbox-next ilightbox-prev');
				});

				var firstOffset = firstHolder.data('offset'),
					winW = (viewport.width - (opts.styles.pageOffsetX)),
					winH = (viewport.height - (opts.styles.pageOffsetY)),
					width = firstOffset.newDims.width,
					height = firstOffset.newDims.height,
					thumbsOffset = firstOffset.thumbsOffset,
					diff = firstOffset.diff,
					top = parseInt((winH / 2) - (height / 2) - diff.H - (thumbsOffset.H / 2)),
					left = parseInt((winW / 2) - (width / 2) - diff.W - (thumbsOffset.W / 2));

				firstHolder.css(transform, gpuAcceleration).animate({
					top: top,
					left: left,
					opacity: 1
				}, switchSpeed, (vars.isSwipe) ? 'easeOutCirc' : 'easeInOutCirc', function() {
					firstHolder.css(transform, '');
				});

				$('div.ilightbox-container', firstHolder).animate({
					width: width,
					height: height
				}, switchSpeed, (vars.isSwipe) ? 'easeOutCirc' : 'easeInOutCirc');

				var secondOffset = secondHolder.data('offset'),
					object = secondOffset.object;

				diff = secondOffset.diff;

				width = secondOffset.newDims.width,
					height = secondOffset.newDims.height;

				width = parseInt(width * opts.styles[side == 'next' ? 'prevScale' : 'nextScale']),
					height = parseInt(height * opts.styles[side == 'next' ? 'prevScale' : 'nextScale']),
					top = (path == 'horizontal') ? parseInt((winH / 2) - object.offsetY - (height / 2) - diff.H - (thumbsOffset.H / 2)) : parseInt(winH - object.offsetX - diff.H - (thumbsOffset.H / 2));

				if (side == 'prev')
					left = (path == 'horizontal') ? parseInt(winW - object.offsetX - diff.W - (thumbsOffset.W / 2)) : parseInt((winW / 2) - (width / 2) - diff.W - object.offsetY - (thumbsOffset.W / 2));
				else {
					top = (path == 'horizontal') ? top : parseInt(object.offsetX - diff.H - height - (thumbsOffset.H / 2)),
						left = (path == 'horizontal') ? parseInt(object.offsetX - diff.W - width - (thumbsOffset.W / 2)) : parseInt((winW / 2) - object.offsetY - (width / 2) - diff.W - (thumbsOffset.W / 2));
				}

				$('div.ilightbox-container', secondHolder).animate({
					width: width,
					height: height
				}, switchSpeed, (vars.isSwipe) ? 'easeOutCirc' : 'easeInOutCirc');

				secondHolder.addClass(firstClass).css(transform, gpuAcceleration).animate({
					top: top,
					left: left,
					opacity: opts.styles.prevOpacity
				}, switchSpeed, (vars.isSwipe) ? 'easeOutCirc' : 'easeInOutCirc', function() {
					secondHolder.css(transform, '');

					$('.ilightbox-thumbnail', vars.thumbnails).removeClass('ilightbox-active').eq(item).addClass('ilightbox-active');
					iL.positionThumbnails();

					if (iL.items[item]) {
						if (!iL.items[item].options.mousewheel) vars.lockWheel = true;
						else vars.lockWheel = false;

						if (!iL.items[item].options.swipe) vars.lockSwipe = true;
						else vars.lockSwipe = false;
					}

					vars.isSwipe = false;

					if (side == "next") {
						vars.nextPhoto = lastHolder,
							vars.prevPhoto = secondHolder,
							vars.holder = firstHolder;

						vars.nextPhoto.hide();

						vars.next = vars.next + 1,
							vars.prev = vars.current,
							vars.current = vars.current + 1;

						if (opts.infinite) {
							if (vars.current > vars.total - 1) vars.current = 0;
							if (vars.current == vars.total - 1) vars.next = 0;
							if (vars.current == 0) vars.prev = vars.total - 1;
						}

						iL.createUI();

						if (!iL.items[vars.next])
							vars.nextLock = false;
						else
							iL.loadContent(iL.items[vars.next], 'next');
					} else {
						vars.prevPhoto = lastHolder;
						vars.nextPhoto = secondHolder;
						vars.holder = firstHolder;

						vars.prevPhoto.hide();

						vars.next = vars.current;
						vars.current = vars.prev;
						vars.prev = vars.current - 1;

						if (opts.infinite) {
							if (vars.current == vars.total - 1) vars.next = 0;
							if (vars.current == 0) vars.prev = vars.total - 1;
						}

						iL.createUI();

						if (!iL.items[vars.prev])
							vars.prevLock = false;
						else
							iL.loadContent(iL.items[vars.prev], 'prev');
					}

					if (opts.linkId) setTimeout(function() {
						vars.hashLock = false;
					}, 55);

					// Configure arrow buttons
					if (!opts.infinite) {
						vars.nextButton.add(vars.prevButton).add(vars.innerPrevButton).add(vars.innerNextButton).removeClass('disabled');

						if (vars.current == 0)
							vars.prevButton.add(vars.innerPrevButton).addClass('disabled');
						if (vars.current >= vars.total - 1)
							vars.nextButton.add(vars.innerNextButton).addClass('disabled');
					}

					iL.repositionPhoto();

					// Reset next cycle timeout
					iL.resetCycle();

					//Trigger the onAfterChange callback
					if (typeof opts.callback.onAfterChange == 'function')
						opts.callback.onAfterChange.call(iL, iL.ui);
				});

				top = (path == 'horizontal') ? getPixel(lastHolder, 'top') : ((side == "next") ? parseInt(-(winH / 2) - lastHolder.outerHeight()) : parseInt(top * 2)),
					left = (path == 'horizontal') ? ((side == "next") ? parseInt(-(winW / 2) - lastHolder.outerWidth()) : parseInt(left * 2)) : getPixel(lastHolder, 'left');

				lastHolder.css(transform, gpuAcceleration).animate({
					top: top,
					left: left,
					opacity: opts.styles.nextOpacity
				}, switchSpeed, (vars.isSwipe) ? 'easeOutCirc' : 'easeInOutCirc', function() {
					lastHolder.css(transform, '');
				}).addClass(secondClass);
			}
		},

		setCaption: function(obj, target) {
			var iL = this,
				caption = $('<div class="ilightbox-caption"></div>');

			if (obj.caption) {
				caption.html(obj.caption);
				$('div.ilightbox-container', target).append(caption);
			}
		},

		normalizeSocial: function(obj, url) {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				baseURL = window.location.href;

			$.each(obj, function(key, value) {
				if (!value)
					return true;

				var item = key.toLowerCase(),
					source, text;

				switch (item) {
					case 'facebook':
						source = "http://www.facebook.com/share.php?v=4&src=bm&u={URL}",
							text = "Share on Facebook";
						break;
					case 'twitter':
						source = "http://twitter.com/home?status={URL}",
							text = "Share on Twitter";
						break;
					case 'googleplus':
						source = "https://plus.google.com/share?url={URL}",
							text = "Share on Google+";
						break;
					case 'delicious':
						source = "http://delicious.com/post?url={URL}",
							text = "Share on Delicious";
						break;
					case 'digg':
						source = "http://digg.com/submit?phase=2&url={URL}",
							text = "Share on Digg";
						break;
					case 'reddit':
						source = "http://reddit.com/submit?url={URL}",
							text = "Share on reddit";
						break;
				}

				obj[key] = {
					URL: value.URL && absolutizeURI(baseURL, value.URL) || opts.linkId && window.location.href || typeof url !== 'string' && baseURL || url && absolutizeURI(baseURL, url) || baseURL,
					source: value.source || source || value.URL && absolutizeURI(baseURL, value.URL) || url && absolutizeURI(baseURL, url),
					text: value.text || text || "Share on " + key,
					width: (typeof(value.width) != 'undefined' && !isNaN(value.width)) ? parseInt(value.width) : 640,
					height: value.height || 360
				};

			});

			return obj;
		},

		setSocial: function(obj, url, target) {
			var iL = this,
				socialBar = $('<div class="ilightbox-social"></div>'),
				buttons = '<ul>';

			obj = iL.normalizeSocial(obj, url);

			$.each(obj, function(key, value) {
				var item = key.toLowerCase(),
					source = value.source.replace(/\{URL\}/g, encodeURIComponent(value.URL).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+'));
				buttons += '<li class="' + key + '"><a href="' + source + '" onclick="javascript:window.open(this.href' + ((value.width <= 0 || value.height <= 0) ? '' : ', \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=' + value.height + ',width=' + value.width + ',left=40,top=40\'') + ');return false;" title="' + value.text + '" target="_blank"></a></li>';
			});

			buttons += '</ul>';

			socialBar.html(buttons);
			$('div.ilightbox-container', target).append(socialBar);
		},

		fullScreenAction: function() {
			var iL = this,
				vars = iL.vars;

			if (fullScreenApi.supportsFullScreen) {
				if (fullScreenApi.isFullScreen()) fullScreenApi.cancelFullScreen(document.documentElement);
				else fullScreenApi.requestFullScreen(document.documentElement);
			} else {
				iL.doFullscreen();
			}
		},

		doFullscreen: function() {
			var iL = this,
				vars = iL.vars,
				viewport = getViewport(),
				opts = iL.options;

			if (opts.fullAlone) {
				var currentHolder = vars.holder,
					current = iL.items[vars.current],
					windowWidth = viewport.width,
					windowHeight = viewport.height,
					elements = [currentHolder, vars.nextPhoto, vars.prevPhoto, vars.nextButton, vars.prevButton, vars.overlay, vars.toolbar, vars.thumbnails, vars.loader],
					hideElements = [vars.nextPhoto, vars.prevPhoto, vars.nextButton, vars.prevButton, vars.loader, vars.thumbnails];

				if (!vars.isInFullScreen) {
					vars.isInFullScreen = vars.lockKey = vars.lockWheel = vars.lockSwipe = true;
					vars.overlay.css({
						opacity: 1
					});

					$.each(hideElements, function(i, element) {
						element.hide();
					});

					vars.fullScreenButton.attr('title', opts.text.exitFullscreen);

					if (opts.fullStretchTypes.indexOf(current.type) != -1) currentHolder.data({
						naturalWidthOld: currentHolder.data('naturalWidth'),
						naturalHeightOld: currentHolder.data('naturalHeight'),
						naturalWidth: windowWidth,
						naturalHeight: windowHeight
					});
					else {
						var viewport = current.options.fullViewPort || opts.fullViewPort || '',
							newWidth = windowWidth,
							newHeight = windowHeight,
							width = currentHolder.data('naturalWidth'),
							height = currentHolder.data('naturalHeight');

						if (viewport.toLowerCase() == 'fill') {
							newHeight = (newWidth / width) * height;

							if (newHeight < windowHeight) {
								newWidth = (windowHeight / height) * width,
									newHeight = windowHeight;
							}
						} else if (viewport.toLowerCase() == 'fit') {
							var dims = iL.getNewDimenstions(newWidth, newHeight, width, height, true);

							newWidth = dims.width,
								newHeight = dims.height;
						} else if (viewport.toLowerCase() == 'stretch') {
							newWidth = newWidth,
								newHeight = newHeight;
						} else {
							var scale = (width > newWidth || height > newHeight) ? true : false,
								dims = iL.getNewDimenstions(newWidth, newHeight, width, height, scale);
							newWidth = dims.width,
								newHeight = dims.height;
						}

						currentHolder.data({
							naturalWidthOld: currentHolder.data('naturalWidth'),
							naturalHeightOld: currentHolder.data('naturalHeight'),
							naturalWidth: newWidth,
							naturalHeight: newHeight
						});
					}

					$.each(elements, function(key, val) {
						val.addClass('ilightbox-fullscreen');
					});

					//Trigger the onEnterFullScreen callback
					if (typeof opts.callback.onEnterFullScreen == 'function') opts.callback.onEnterFullScreen.call(iL, iL.ui);
				} else {
					vars.isInFullScreen = vars.lockKey = vars.lockWheel = vars.lockSwipe = false;
					vars.overlay.css({
						opacity: iL.options.overlay.opacity
					});

					$.each(hideElements, function(i, element) {
						element.show();
					});

					vars.fullScreenButton.attr('title', opts.text.enterFullscreen);

					currentHolder.data({
						naturalWidth: currentHolder.data('naturalWidthOld'),
						naturalHeight: currentHolder.data('naturalHeightOld'),
						naturalWidthOld: null,
						naturalHeightOld: null
					});

					$.each(elements, function(key, val) {
						val.removeClass('ilightbox-fullscreen');
					});

					//Trigger the onExitFullScreen callback
					if (typeof opts.callback.onExitFullScreen == 'function') opts.callback.onExitFullScreen.call(iL, iL.ui);
				}
			} else {
				if (!vars.isInFullScreen) vars.isInFullScreen = true;
				else vars.isInFullScreen = false;
			}
			iL.repositionPhoto(true);
		},

		closeAction: function() {
			var iL = this,
				vars = iL.vars,
				opts = iL.options;

			$win.unbind('.iLightBox');
			$doc.off('.iLightBox');

			if (vars.isInFullScreen) fullScreenApi.cancelFullScreen(document.documentElement);

			$('.ilightbox-overlay, .ilightbox-holder, .ilightbox-thumbnails').off('.iLightBox');

			if (opts.hide.effect) vars.overlay.stop().fadeOut(opts.hide.speed, function() {
				vars.overlay.remove();
				vars.BODY.removeClass('ilightbox-noscroll').off('.iLightBox');
			});
			else {
				vars.overlay.remove();
				vars.BODY.removeClass('ilightbox-noscroll').off('.iLightBox');
			}

			var fadeOuts = [vars.toolbar, vars.holder, vars.nextPhoto, vars.prevPhoto, vars.nextButton, vars.prevButton, vars.loader, vars.thumbnails];

			$.each(fadeOuts, function(i, element) {
				element.removeAttr('style').remove();
			});

			vars.dontGenerateThumbs = vars.isInFullScreen = false;

			window.iLightBox = null;

			if (opts.linkId) {
				vars.hashLock = true;
				removeHash();
				setTimeout(function() {
					vars.hashLock = false;
				}, 55);
			}

			//Trigger the onHide callback
			if (typeof opts.callback.onHide == 'function') opts.callback.onHide.call(iL, iL.ui);
		},

		repositionPhoto: function() {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				path = opts.path.toLowerCase(),
				viewport = getViewport(),
				winWidth = viewport.width,
				winHeight = viewport.height;

			var thumbsOffsetW = (vars.isInFullScreen && opts.fullAlone || vars.isMobile) ? 0 : ((path == 'horizontal') ? 0 : vars.thumbnails.outerWidth()),
				thumbsOffsetH = vars.isMobile ? vars.toolbar.outerHeight() : ((vars.isInFullScreen && opts.fullAlone) ? 0 : ((path == 'horizontal') ? vars.thumbnails.outerHeight() : 0)),
				width = (vars.isInFullScreen && opts.fullAlone) ? winWidth : (winWidth - (opts.styles.pageOffsetX)),
				height = (vars.isInFullScreen && opts.fullAlone) ? winHeight : (winHeight - (opts.styles.pageOffsetY)),
				offsetW = (path == 'horizontal') ? parseInt((iL.items[vars.next] || iL.items[vars.prev]) ? ((opts.styles.nextOffsetX + opts.styles.prevOffsetX)) * 2 : (((width / 10) <= 30) ? 30 : (width / 10))) : parseInt(((width / 10) <= 30) ? 30 : (width / 10)) + thumbsOffsetW,
				offsetH = (path == 'horizontal') ? parseInt(((height / 10) <= 30) ? 30 : (height / 10)) + thumbsOffsetH : parseInt((iL.items[vars.next] || iL.items[vars.prev]) ? ((opts.styles.nextOffsetX + opts.styles.prevOffsetX)) * 2 : (((height / 10) <= 30) ? 30 : (height / 10)));

			var elObject = {
				type: 'current',
				width: width,
				height: height,
				item: iL.items[vars.current],
				offsetW: offsetW,
				offsetH: offsetH,
				thumbsOffsetW: thumbsOffsetW,
				thumbsOffsetH: thumbsOffsetH,
				animate: arguments.length,
				holder: vars.holder
			};

			iL.repositionEl(elObject);

			if (iL.items[vars.next]) {
				elObject = $.extend(elObject, {
					type: 'next',
					item: iL.items[vars.next],
					offsetX: opts.styles.nextOffsetX,
					offsetY: opts.styles.nextOffsetY,
					holder: vars.nextPhoto
				});

				iL.repositionEl(elObject);
			}

			if (iL.items[vars.prev]) {
				elObject = $.extend(elObject, {
					type: 'prev',
					item: iL.items[vars.prev],
					offsetX: opts.styles.prevOffsetX,
					offsetY: opts.styles.prevOffsetY,
					holder: vars.prevPhoto
				});

				iL.repositionEl(elObject);
			}

			var loaderCss = (path == "horizontal") ? {
				left: parseInt((width / 2) - (vars.loader.outerWidth() / 2))
			} : {
				top: parseInt((height / 2) - (vars.loader.outerHeight() / 2))
			};
			vars.loader.css(loaderCss);
		},

		repositionEl: function(obj) {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				path = opts.path.toLowerCase(),
				widthAvail = (obj.type == 'current') ? ((vars.isInFullScreen && opts.fullAlone) ? obj.width : (obj.width - obj.offsetW)) : (obj.width - obj.offsetW),
				heightAvail = (obj.type == 'current') ? ((vars.isInFullScreen && opts.fullAlone) ? obj.height : (obj.height - obj.offsetH)) : (obj.height - obj.offsetH),
				itemParent = obj.item,
				item = obj.item.options,
				holder = obj.holder,
				offsetX = obj.offsetX || 0,
				offsetY = obj.offsetY || 0,
				thumbsOffsetW = obj.thumbsOffsetW,
				thumbsOffsetH = obj.thumbsOffsetH;

			if (obj.type == 'current') {
				if (typeof item.width == 'number' && item.width) widthAvail = ((vars.isInFullScreen && opts.fullAlone) && (opts.fullStretchTypes.indexOf(itemParent.type) != -1 || item.fullViewPort || opts.fullViewPort)) ? widthAvail : ((item.width > widthAvail) ? widthAvail : item.width);
				if (typeof item.height == 'number' && item.height) heightAvail = ((vars.isInFullScreen && opts.fullAlone) && (opts.fullStretchTypes.indexOf(itemParent.type) != -1 || item.fullViewPort || opts.fullViewPort)) ? heightAvail : ((item.height > heightAvail) ? heightAvail : item.height);
			} else {
				if (typeof item.width == 'number' && item.width) widthAvail = (item.width > widthAvail) ? widthAvail : item.width;
				if (typeof item.height == 'number' && item.height) heightAvail = (item.height > heightAvail) ? heightAvail : item.height;
			}

			heightAvail = parseInt(heightAvail - $('.ilightbox-inner-toolbar', holder).outerHeight());

			var width = (typeof item.width == 'string' && item.width.indexOf('%') != -1) ? percentToValue(parseInt(item.width.replace('%', '')), obj.width) : holder.data('naturalWidth'),
				height = (typeof item.height == 'string' && item.height.indexOf('%') != -1) ? percentToValue(parseInt(item.height.replace('%', '')), obj.height) : holder.data('naturalHeight');

			var dims = ((typeof item.width == 'string' && item.width.indexOf('%') != -1 || typeof item.height == 'string' && item.height.indexOf('%') != -1) ? {
					width: width,
					height: height
				} : iL.getNewDimenstions(widthAvail, heightAvail, width, height)),
				newDims = $.extend({}, dims, {});

			if (obj.type == 'prev' || obj.type == 'next')
				width = parseInt(dims.width * ((obj.type == 'next') ? opts.styles.nextScale : opts.styles.prevScale)),
				height = parseInt(dims.height * ((obj.type == 'next') ? opts.styles.nextScale : opts.styles.prevScale));
			else
				width = dims.width,
				height = dims.height;

			var widthDiff = parseInt((getPixel(holder, 'padding-left') + getPixel(holder, 'padding-right') + getPixel(holder, 'border-left-width') + getPixel(holder, 'border-right-width')) / 2),
				heightDiff = parseInt((getPixel(holder, 'padding-top') + getPixel(holder, 'padding-bottom') + getPixel(holder, 'border-top-width') + getPixel(holder, 'border-bottom-width') + $('.ilightbox-inner-toolbar', holder).outerHeight()) / 2);

			switch (obj.type) {
				case 'current':
					var top = parseInt((obj.height / 2) - (height / 2) - heightDiff - (thumbsOffsetH / 2)),
						left = parseInt((obj.width / 2) - (width / 2) - widthDiff - (thumbsOffsetW / 2));
					break;

				case 'next':
					var top = (path == 'horizontal') ? parseInt((obj.height / 2) - offsetY - (height / 2) - heightDiff - (thumbsOffsetH / 2)) : parseInt(obj.height - offsetX - heightDiff - (thumbsOffsetH / 2)),
						left = (path == 'horizontal') ? parseInt(obj.width - offsetX - widthDiff - (thumbsOffsetW / 2)) : parseInt((obj.width / 2) - (width / 2) - widthDiff - offsetY - (thumbsOffsetW / 2));
					break;

				case 'prev':
					var top = (path == 'horizontal') ? parseInt((obj.height / 2) - offsetY - (height / 2) - heightDiff - (thumbsOffsetH / 2)) : parseInt(offsetX - heightDiff - height - (thumbsOffsetH / 2)),
						left = (path == 'horizontal') ? parseInt(offsetX - widthDiff - width - (thumbsOffsetW / 2)) : parseInt((obj.width / 2) - offsetY - (width / 2) - widthDiff - (thumbsOffsetW / 2));
					break;
			}

			holder.data('offset', {
				top: top,
				left: left,
				newDims: newDims,
				diff: {
					W: widthDiff,
					H: heightDiff
				},
				thumbsOffset: {
					W: thumbsOffsetW,
					H: thumbsOffsetH
				},
				object: obj
			});

			if (obj.animate > 0 && opts.effects.reposition) {
				holder.css(transform, gpuAcceleration).stop().animate({
					top: top,
					left: left
				}, opts.effects.repositionSpeed, 'easeOutCirc', function() {
					holder.css(transform, '');
				});
				$('div.ilightbox-container', holder).stop().animate({
					width: width,
					height: height
				}, opts.effects.repositionSpeed, 'easeOutCirc');
				$('div.ilightbox-inner-toolbar', holder).stop().animate({
					width: width
				}, opts.effects.repositionSpeed, 'easeOutCirc', function() {
					$(this).css('overflow', 'visible');
				});
			} else {
				holder.css({
					top: top,
					left: left
				});
				$('div.ilightbox-container', holder).css({
					width: width,
					height: height
				});
				$('div.ilightbox-inner-toolbar', holder).css({
					width: width
				});
			}
		},

		resume: function(priority) {
			var iL = this,
				vars = iL.vars,
				opts = iL.options;

			if (!opts.slideshow.pauseTime || opts.controls.slideshow && vars.total <= 1 || priority < vars.isPaused) {
				return;
			}

			vars.isPaused = 0;

			if (vars.cycleID) {
				vars.cycleID = clearTimeout(vars.cycleID);
			}

			vars.cycleID = setTimeout(function() {
				if (vars.current == vars.total - 1) iL.goTo(0);
				else iL.moveTo('next');
			}, opts.slideshow.pauseTime);
		},

		pause: function(priority) {
			var iL = this,
				vars = iL.vars,
				opts = iL.options;

			if (priority < vars.isPaused) {
				return;
			}

			vars.isPaused = priority || 100;

			if (vars.cycleID) {
				vars.cycleID = clearTimeout(vars.cycleID);
			}
		},

		resetCycle: function() {
			var iL = this,
				vars = iL.vars,
				opts = iL.options;

			if (opts.controls.slideshow && vars.cycleID && !vars.isPaused) {
				iL.resume();
			}
		},

		getNewDimenstions: function(width, height, width_old, height_old, thumb) {
			var iL = this;

			if (!width) factor = height / height_old;
			else if (!height) factor = width / width_old;
			else factor = min(width / width_old, height / height_old);

			if (!thumb) {
				if (factor > iL.options.maxScale) factor = iL.options.maxScale;
				else if (factor < iL.options.minScale) factor = iL.options.minScale;
			}

			var final_width = (iL.options.keepAspectRatio) ? round(width_old * factor) : width,
				final_height = (iL.options.keepAspectRatio) ? round(height_old * factor) : height;

			return {
				width: final_width,
				height: final_height,
				ratio: factor
			};
		},

		setOption: function(options) {
			var iL = this;

			iL.options = $.extend(true, iL.options, options || {});
			iL.refresh();
		},

		availPlugins: function() {
			var iL = this,
				testEl = document.createElement("video");

			iL.plugins = {
				flash: (parseInt(PluginDetect.getVersion("Shockwave")) >= 0 || parseInt(PluginDetect.getVersion("Flash")) >= 0) ? true : false,
				quicktime: (parseInt(PluginDetect.getVersion("QuickTime")) >= 0) ? true : false,
				html5H264: !!(testEl.canPlayType && testEl.canPlayType('video/mp4').replace(/no/, '')),
				html5WebM: !!(testEl.canPlayType && testEl.canPlayType('video/webm').replace(/no/, '')),
				html5Vorbis: !!(testEl.canPlayType && testEl.canPlayType('video/ogg').replace(/no/, '')),
				html5QuickTime: !!(testEl.canPlayType && testEl.canPlayType('video/quicktime').replace(/no/, ''))
			};
		},

		addContent: function(element, obj) {
			var iL = this,
				el;

			switch (obj.type) {
				case 'video':
					var HTML5 = false,
						videoType = obj.videoType,
						html5video = obj.options.html5video;

					if (((videoType == 'video/mp4' || obj.ext == 'mp4' || obj.ext == 'm4v') || html5video.h264) && iL.plugins.html5H264)
						obj.ext = 'mp4',
						obj.URL = html5video.h264 || obj.URL;
					else if (html5video.webm && iL.plugins.html5WebM)
						obj.ext = 'webm',
						obj.URL = html5video.webm || obj.URL;
					else if (html5video.ogg && iL.plugins.html5Vorbis)
						obj.ext = 'ogv',
						obj.URL = html5video.ogg || obj.URL;

					if (iL.plugins.html5H264 && (videoType == 'video/mp4' || obj.ext == 'mp4' || obj.ext == 'm4v')) HTML5 = true, videoType = "video/mp4";
					else if (iL.plugins.html5WebM && (videoType == 'video/webm' || obj.ext == 'webm')) HTML5 = true, videoType = "video/webm";
					else if (iL.plugins.html5Vorbis && (videoType == 'video/ogg' || obj.ext == 'ogv')) HTML5 = true, videoType = "video/ogg";
					else if (iL.plugins.html5QuickTime && (videoType == 'video/quicktime' || obj.ext == 'mov' || obj.ext == 'qt')) HTML5 = true, videoType = "video/quicktime";

					if (HTML5) {
						el = $('<video />', {
							"width": "100%",
							"height": "100%",
							"preload": html5video.preload,
							"autoplay": html5video.autoplay,
							"poster": html5video.poster,
							"controls": html5video.controls
						}).append($('<source />', {
							"src": obj.URL,
							"type": videoType
						}));
					} else {
						if (!iL.plugins.quicktime) el = $('<span />', {
							"class": "ilightbox-alert",
							html: iL.options.errors.missingPlugin.replace('{pluginspage}', pluginspages.quicktime).replace('{type}', 'QuickTime')
						});
						else {

							el = $('<object />', {
								"type": "video/quicktime",
								"pluginspage": pluginspages.quicktime
							}).attr({
								"data": obj.URL,
								"width": "100%",
								"height": "100%"
							}).append($('<param />', {
								"name": "src",
								"value": obj.URL
							})).append($('<param />', {
								"name": "autoplay",
								"value": "false"
							})).append($('<param />', {
								"name": "loop",
								"value": "false"
							})).append($('<param />', {
								"name": "scale",
								"value": "tofit"
							}));

							if (browser.msie) el = QT_GenerateOBJECTText(obj.URL, '100%', '100%', '', 'SCALE', 'tofit', 'AUTOPLAY', 'false', 'LOOP', 'false');
						}
					}

					break;

				case 'flash':
					if (!iL.plugins.flash) el = $('<span />', {
						"class": "ilightbox-alert",
						html: iL.options.errors.missingPlugin.replace('{pluginspage}', pluginspages.flash).replace('{type}', 'Adobe Flash player')
					});
					else {
						var flashvars = "",
							i = 0;

						if (obj.options.flashvars) $.each(obj.options.flashvars, function(k, v) {
							if (i != 0) flashvars += "&";
							flashvars += k + "=" + encodeURIComponent(v);
							i++;
						});
						else flashvars = null;

						el = $('<embed />').attr({
							"type": "application/x-shockwave-flash",
							"src": obj.URL,
							"width": (typeof obj.options.width == 'number' && obj.options.width && iL.options.minScale == '1' && iL.options.maxScale == '1') ? obj.options.width : "100%",
							"height": (typeof obj.options.height == 'number' && obj.options.height && iL.options.minScale == '1' && iL.options.maxScale == '1') ? obj.options.height : "100%",
							"quality": "high",
							"bgcolor": "#000000",
							"play": "true",
							"loop": "true",
							"menu": "true",
							"wmode": "transparent",
							"scale": "showall",
							"allowScriptAccess": "always",
							"allowFullScreen": "true",
							"flashvars": flashvars,
							"fullscreen": "yes"
						});
					}

					break;

				case 'iframe':
					el = $('<iframe />').attr({
						"width": (typeof obj.options.width == 'number' && obj.options.width && iL.options.minScale == '1' && iL.options.maxScale == '1') ? obj.options.width : "100%",
						"height": (typeof obj.options.height == 'number' && obj.options.height && iL.options.minScale == '1' && iL.options.maxScale == '1') ? obj.options.height : "100%",
						src: obj.URL,
						frameborder: 0,
						'hspace': 0,
						'vspace': 0,
						'scrolling': supportTouch ? 'auto' : 'scroll',
						'webkitAllowFullScreen': '',
						'mozallowfullscreen': '',
						'allowFullScreen': ''
					});

					break;

				case 'inline':
					el = $('<div class="ilightbox-wrapper"></div>').html($(obj.URL).clone(true));

					break;

				case 'html':
					var object = obj.URL,
						el;

					if (object[0].nodeName) {
						el = $('<div class="ilightbox-wrapper"></div>').html(object);
					} else {
						var dom = $(obj.URL),
							html = (dom.selector) ? $('<div>' + dom + '</div>') : dom;
						el = $('<div class="ilightbox-wrapper"></div>').html(html);
					}

					break;
			}

			$('div.ilightbox-container', element).empty().html(el);

			// For fixing Chrome about just playing the video for first time
			if (el[0].tagName.toLowerCase() === 'video' && browser.webkit) setTimeout(function() {
				var src = el[0].currentSrc + '?' + floor(random() * 30000);
				el[0].currentSrc = src;
				el[0].src = src;
			});

			return el;
		},

		ogpRecognition: function(obj, callback) {
			var iL = this,
				url = obj.URL;

			iL.showLoader();
			doAjax(url, function(data) {
				iL.hideLoader();
				
				if (data) {
					var object = new Object();

					object.length = false,
					object.url = data.url;

					if (data.status == 200) {
						var result = data.results,
							type = result.type,
							source = result.source;

						object.source = source.src,
						object.width = source.width && parseInt(source.width) || 0,
						object.height = source.height && parseInt(source.height) || 0,
						object.type = type,
						object.thumbnail = source.thumbnail || result.images[0],
						object.html5video = result.html5video || {},
						object.length = true;

						if (source.type == 'application/x-shockwave-flash') object.type = "flash";
						else if (source.type.indexOf("video/") != -1) object.type = "video";
						else if (source.type.indexOf("/html") != -1) object.type = "iframe";
						else if (source.type.indexOf("image/") != -1) object.type = "image";

					} else if (typeof data.response != 'undefined')
						throw data.response;

					callback.call(this, object.length ? object : false);
				}
			});
		},

		hashChangeHandler: function(url) {
			var iL = this,
				vars = iL.vars,
				opts = iL.options,
				URL = url || window.location.href,
				hash = parseURI(URL).hash,
				split = hash.split('/'),
				index = split[1];

			if (vars.hashLock || ('#' + opts.linkId != split[0] && hash.length > 1)) return;

			if (index) {
				var target = split[1] || 0;
				if (iL.items[target]) {
					var overlay = $('.ilightbox-overlay');
					if (overlay.length && overlay.attr('linkid') == opts.linkId) {
						iL.goTo(target);
					} else {
						iL.itemsObject[target].trigger(supportTouch ? 'itap' : 'click');
					}
				} else {
					var overlay = $('.ilightbox-overlay');
					if (overlay.length) iL.closeAction();
				}
			} else {
				var overlay = $('.ilightbox-overlay');
				if (overlay.length) iL.closeAction();
			}
		}
	};

	/**
	 * Parse style to pixels.
	 *
	 * @param {Object}   $element   jQuery object with element.
	 * @param {Property} property   CSS property to get the pixels from.
	 *
	 * @return {Int}
	 */
	function getPixel($element, property) {
		return parseInt($element.css(property), 10) || 0;
	}

	/**
	 * Make sure that number is within the limits.
	 *
	 * @param {Number} number
	 * @param {Number} min
	 * @param {Number} max
	 *
	 * @return {Number}
	 */
	function within(number, min, max) {
		return number < min ? min : number > max ? max : number;
	}

	/**
	 * Get viewport/window size (width and height).
	 *
	 * @return {Object}
	 */
	function getViewport() {
		var e = window,
			a = 'inner';
		if (!('innerWidth' in window)) {
			a = 'client';
			e = document.documentElement || document.body;
		}
		return {
			width: e[a + 'Width'],
			height: e[a + 'Height']
		}
	}

	/**
	 * Remove hash tag from the URL
	 *
	 * @return {Void}
	 */
	function removeHash() {
		var scroll = getScrollXY();

		window.location.hash = "";

		// Restore the scroll offset, should be flicker free
		window.scrollTo(scroll.x, scroll.y);
	}

	/**
	 * Do the ajax requests with callback.
	 *
	 * @param {String}   url
	 * @param {Function} callback
	 *
	 * @return {Void}
	 */
	function doAjax(url, callback) {
		var url = "http://ilightbox.net/getSource/jsonp.php?url=" + encodeURIComponent(url).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A');
		$.ajax({
			url: url,
			dataType: 'jsonp'
		});

		iLCallback = function(data) {
			callback.call(this, data);
		};
	}

	/**
	 * Find image from DOM elements
	 *
	 * @param {Element} element
	 *
	 * @return {Void}
	 */
	function findImageInElement(element) {
		var elements = $('*', element),
			imagesArr = new Array();

		elements.each(function() {
			var url = "",
				element = this;

			if ($(element).css("background-image") != "none") {
				url = $(element).css("background-image");
			} else if (typeof($(element).attr("src")) != "undefined" && element.nodeName.toLowerCase() == "img") {
				url = $(element).attr("src");
			}

			if (url.indexOf("gradient") == -1) {
				url = url.replace(/url\(\"/g, "");
				url = url.replace(/url\(/g, "");
				url = url.replace(/\"\)/g, "");
				url = url.replace(/\)/g, "");

				var urls = url.split(",");

				for (var i = 0; i < urls.length; i++) {
					if (urls[i].length > 0 && $.inArray(urls[i], imagesArr) == -1) {
						var extra = "";
						if (browser.msie && browser.version < 9) {
							extra = "?" + floor(random() * 3000);
						}
						imagesArr.push(urls[i] + extra);
					}
				}
			}
		});

		return imagesArr;
	}

	/**
	 * Get file extension.
	 *
	 * @param {String} URL
	 *
	 * @return {String}
	 */
	function getExtension(URL) {
		var ext = URL.split('.').pop().toLowerCase(),
			extra = ext.indexOf('?') !== -1 ? ext.split('?').pop() : '';

		return ext.replace(extra, '');
	}

	/**
	 * Get type via extension.
	 *
	 * @param {String} URL
	 *
	 * @return {String}
	 */
	function getTypeByExtension(URL) {
		var type,
			ext = getExtension(URL);

		if (extensions.image.indexOf(ext) !== -1) type = 'image';
		else if (extensions.flash.indexOf(ext) !== -1) type = 'flash';
		else if (extensions.video.indexOf(ext) !== -1) type = 'video';
		else type = 'iframe';

		return type;
	}

	/**
	 * Return value from percent of a number.
	 *
	 * @param {Number} percent
	 * @param {Number} total
	 *
	 * @return {Number}
	 */
	function percentToValue(percent, total) {
		return parseInt((total / 100) * percent);
	}

	/**
	 * A JavaScript equivalent of PHP’s parse_url.
	 *
	 * @param {String} url           The URL to parse.
	 *
	 * @return {Mixed}
	 */
	function parseURI(url) {
		var m = String(url).replace(/^\s+|\s+$/g, '').match(/^([^:\/?#]+:)?(\/\/(?:[^:@]*(?::[^:@]*)?@)?(([^:\/?#]*)(?::(\d*))?))?([^?#]*)(\?[^#]*)?(#[\s\S]*)?/);
		// authority = '//' + user + ':' + pass '@' + hostname + ':' port
		return (m ? {
			href: m[0] || '',
			protocol: m[1] || '',
			authority: m[2] || '',
			host: m[3] || '',
			hostname: m[4] || '',
			port: m[5] || '',
			pathname: m[6] || '',
			search: m[7] || '',
			hash: m[8] || ''
		} : null);
	}

	/**
	 * Gets the absolute URI.
	 *
	 * @param {String} href     The relative URL.
	 * @param {String} base     The base URL.
	 *
	 * @return {String}         The absolute URL.
	 */
	function absolutizeURI(base, href) { // RFC 3986
		var iL = this;

		function removeDotSegments(input) {
			var output = [];
			input.replace(/^(\.\.?(\/|$))+/, '')
				.replace(/\/(\.(\/|$))+/g, '/')
				.replace(/\/\.\.$/, '/../')
				.replace(/\/?[^\/]*/g, function(p) {
					if (p === '/..') {
						output.pop();
					} else {
						output.push(p);
					}
				});
			return output.join('').replace(/^\//, input.charAt(0) === '/' ? '/' : '');
		}

		href = parseURI(href || '');
		base = parseURI(base || '');

		return !href || !base ? null : (href.protocol || base.protocol) +
			(href.protocol || href.authority ? href.authority : base.authority) +
			removeDotSegments(href.protocol || href.authority || href.pathname.charAt(0) === '/' ? href.pathname : (href.pathname ? ((base.authority && !base.pathname ? '/' : '') + base.pathname.slice(0, base.pathname.lastIndexOf('/') + 1) + href.pathname) : base.pathname)) +
			(href.protocol || href.authority || href.pathname ? href.search : (href.search || base.search)) +
			href.hash;
	}

	/**
	 * A JavaScript equivalent of PHP’s version_compare.
	 *
	 * @param {String} v1
	 * @param {String} v2
	 * @param {String} operator
	 *
	 * @return {Boolean}
	 */
	function version_compare(v1, v2, operator) {
		this.php_js = this.php_js || {};
		this.php_js.ENV = this.php_js.ENV || {};
		var i = 0,
			x = 0,
			compare = 0,
			vm = {
				'dev': -6,
				'alpha': -5,
				'a': -5,
				'beta': -4,
				'b': -4,
				'RC': -3,
				'rc': -3,
				'#': -2,
				'p': 1,
				'pl': 1
			},
			prepVersion = function(v) {
				v = ('' + v).replace(/[_\-+]/g, '.');
				v = v.replace(/([^.\d]+)/g, '.$1.').replace(/\.{2,}/g, '.');
				return (!v.length ? [-8] : v.split('.'));
			},
			numVersion = function(v) {
				return !v ? 0 : (isNaN(v) ? vm[v] || -7 : parseInt(v, 10));
			};
		v1 = prepVersion(v1);
		v2 = prepVersion(v2);
		x = max(v1.length, v2.length);
		for (i = 0; i < x; i++) {
			if (v1[i] == v2[i]) {
				continue;
			}
			v1[i] = numVersion(v1[i]);
			v2[i] = numVersion(v2[i]);
			if (v1[i] < v2[i]) {
				compare = -1;
				break;
			} else if (v1[i] > v2[i]) {
				compare = 1;
				break;
			}
		}
		if (!operator) {
			return compare;
		}

		switch (operator) {
			case '>':
			case 'gt':
				return (compare > 0);
			case '>=':
			case 'ge':
				return (compare >= 0);
			case '<=':
			case 'le':
				return (compare <= 0);
			case '==':
			case '=':
			case 'eq':
				return (compare === 0);
			case '<>':
			case '!=':
			case 'ne':
				return (compare !== 0);
			case '':
			case '<':
			case 'lt':
				return (compare < 0);
			default:
				return null;
		}
	}


	// Begin the iLightBox plugin
	$.fn.iLightBox = function() {

		var args = arguments,
			opt = ($.isPlainObject(args[0])) ? args[0] : args[1],
			items = ($.isArray(args[0]) || typeof args[0] == 'string') ? args[0] : args[1];

		if (!opt) opt = {};

		// Default options. Play carefully.
		var options = $.extend(true, {
			attr: 'href',
			path: 'vertical',
			skin: 'dark',
			linkId: false,
			infinite: false,
			startFrom: 0,
			randomStart: false,
			keepAspectRatio: true,
			maxScale: 1,
			minScale: .2,
			innerToolbar: false,
			smartRecognition: false,
			mobileOptimizer: true,
			fullAlone: true,
			fullViewPort: null,
			fullStretchTypes: 'flash, video',
			overlay: {
				blur: true,
				opacity: .85
			},
			controls: {
				arrows: false,
				slideshow: false,
				toolbar: true,
				fullscreen: true,
				thumbnail: true,
				keyboard: true,
				mousewheel: true,
				swipe: true
			},
			keyboard: {
				left: true, // previous
				right: true, // next
				up: true, // previous
				down: true, // next
				esc: true, // close
				shift_enter: true // fullscreen
			},
			show: {
				effect: true,
				speed: 300,
				title: true
			},
			hide: {
				effect: true,
				speed: 300
			},
			caption: {
				start: true,
				show: 'mouseenter',
				hide: 'mouseleave'
			},
			social: {
				start: true,
				show: 'mouseenter',
				hide: 'mouseleave',
				buttons: false
			},
			styles: {
				pageOffsetX: 0,
				pageOffsetY: 0,
				nextOffsetX: 45,
				nextOffsetY: 0,
				nextOpacity: 1,
				nextScale: 1,
				prevOffsetX: 45,
				prevOffsetY: 0,
				prevOpacity: 1,
				prevScale: 1
			},
			thumbnails: {
				maxWidth: 120,
				maxHeight: 80,
				normalOpacity: 1,
				activeOpacity: .6
			},
			effects: {
				reposition: true,
				repositionSpeed: 200,
				switchSpeed: 500,
				loadedFadeSpeed: 180,
				fadeSpeed: 200
			},
			slideshow: {
				pauseTime: 5000,
				pauseOnHover: false,
				startPaused: true
			},
			text: {
				close: "Press Esc to close",
				enterFullscreen: "Enter Fullscreen (Shift+Enter)",
				exitFullscreen: "Exit Fullscreen (Shift+Enter)",
				slideShow: "Slideshow",
				next: "Next",
				previous: "Previous"
			},
			errors: {
				loadImage: "An error occurred when trying to load photo.",
				loadContents: "An error occurred when trying to load contents.",
				missingPlugin: "The content your are attempting to view requires the <a href='{pluginspage}' target='_blank'>{type} plugin<\/a>."
			},
			ajaxSetup: {
				url: '',
				beforeSend: function(jqXHR, settings) {},
				cache: false,
				complete: function(jqXHR, textStatus) {},
				crossDomain: false,
				error: function(jqXHR, textStatus, errorThrown) {},
				success: function(data, textStatus, jqXHR) {},
				global: true,
				ifModified: false,
				username: null,
				password: null,
				type: 'GET'
			},
			callback: {}
		}, opt);

		var instant = ($.isArray(items) || typeof items == 'string') ? true : false;

		items = $.isArray(items) ? items : new Array();

		if (typeof args[0] == 'string') items[0] = args[0];

		if (version_compare($.fn.jquery, '1.8', '>=')) {
			var iLB = new iLightBox($(this), options, items, instant);
			return {
				close: function() {
					iLB.closeAction();
				},
				fullscreen: function() {
					iLB.fullScreenAction();
				},
				moveNext: function() {
					iLB.moveTo('next');
				},
				movePrev: function() {
					iLB.moveTo('prev');
				},
				goTo: function(index) {
					iLB.goTo(index);
				},
				refresh: function() {
					iLB.refresh();
				},
				reposition: function() {
					(arguments.length > 0) ? iLB.repositionPhoto(true): iLB.repositionPhoto();
				},
				setOption: function(options) {
					iLB.setOption(options);
				},
				destroy: function() {
					iLB.closeAction();
					iLB.dispatchItemsEvents();
				}
			};
		} else {
			throw "The jQuery version that was loaded is too old. iLightBox requires jQuery 1.8+";
		}

	};


	$.iLightBox = function() {
		return $.fn.iLightBox(arguments[0], arguments[1]);
	};


	$.extend($.easing, {
		easeInCirc: function(x, t, b, c, d) {
			return -c * (sqrt(1 - (t /= d) * t) - 1) + b;
		},
		easeOutCirc: function(x, t, b, c, d) {
			return c * sqrt(1 - (t = t / d - 1) * t) + b;
		},
		easeInOutCirc: function(x, t, b, c, d) {
			if ((t /= d / 2) < 1) return -c / 2 * (sqrt(1 - t * t) - 1) + b;
			return c / 2 * (sqrt(1 - (t -= 2) * t) + 1) + b;
		}
	});

	function getScrollXY() {
		var scrOfX = 0,
			scrOfY = 0;
		if (typeof(window.pageYOffset) == 'number') {
			//Netscape compliant
			scrOfY = window.pageYOffset;
			scrOfX = window.pageXOffset;
		} else if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
			//DOM compliant
			scrOfY = document.body.scrollTop;
			scrOfX = document.body.scrollLeft;
		} else if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
			//IE6 standards compliant mode
			scrOfY = document.documentElement.scrollTop;
			scrOfX = document.documentElement.scrollLeft;
		}
		return {
			x: scrOfX,
			y: scrOfY
		};
	}

	(function() {
		// add new event shortcuts
		$.each(("touchstart touchmove touchend " +
			"tap taphold " +
			"swipe swipeleft swiperight " +
			"scrollstart scrollstop").split(" "), function(i, name) {

			$.fn[name] = function(fn) {
				return fn ? this.bind(name, fn) : this.trigger(name);
			};

			// jQuery < 1.8
			if ($.attrFn) {
				$.attrFn[name] = true;
			}
		});

		var tapSettings = {
			startEvent: 'touchstart.iTap',
			endEvent: 'touchend.iTap'
		};

		// tap Event:
		$.event.special.itap = {
			setup: function() {

				var self = this,
					$self = $(this),
					start, stop;

				$self.bind(tapSettings.startEvent, function(event) {
					start = getScrollXY();

					$self.one(tapSettings.endEvent, function(event) {
						stop = getScrollXY();

						var orgEvent = event || window.event;
						event = $.event.fix(orgEvent);
						event.type = "itap";

						if ((start && stop) && (start.x == stop.x && start.y == stop.y))($.event.dispatch || $.event.handle).call(self, event);

						start = stop = undefined;
					});
				});
			},

			teardown: function() {
				$(this).unbind(tapSettings.startEvent);
			}
		};
	}());


	//Fullscreen API
	(function() {
		fullScreenApi = {
				supportsFullScreen: false,
				isFullScreen: function() {
					return false;
				},
				requestFullScreen: function() {},
				cancelFullScreen: function() {},
				fullScreenEventName: '',
				prefix: ''
			},
			browserPrefixes = 'webkit moz o ms khtml'.split(' ');

		// check for native support
		if (typeof document.cancelFullScreen != 'undefined') {
			fullScreenApi.supportsFullScreen = true;
		} else {
			// check for fullscreen support by vendor prefix
			for (var i = 0, il = browserPrefixes.length; i < il; i++) {
				fullScreenApi.prefix = browserPrefixes[i];

				if (typeof document[fullScreenApi.prefix + 'CancelFullScreen'] != 'undefined') {
					fullScreenApi.supportsFullScreen = true;

					break;
				}
			}
		}

		// update methods to do something useful
		if (fullScreenApi.supportsFullScreen) {
			fullScreenApi.fullScreenEventName = fullScreenApi.prefix + 'fullscreenchange';

			fullScreenApi.isFullScreen = function() {
				switch (this.prefix) {
					case '':
						return document.fullScreen;
					case 'webkit':
						return document.webkitIsFullScreen;
					default:
						return document[this.prefix + 'FullScreen'];
				}
			}
			fullScreenApi.requestFullScreen = function(el) {
				return (this.prefix === '') ? el.requestFullScreen() : el[this.prefix + 'RequestFullScreen']();
			}
			fullScreenApi.cancelFullScreen = function(el) {
				return (this.prefix === '') ? document.cancelFullScreen() : document[this.prefix + 'CancelFullScreen']();
			}
		}
	}());

	// Browser detect
	(function() {
		function uaMatch(ua) {
			ua = ua.toLowerCase();

			var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
				/(webkit)[ \/]([\w.]+)/.exec(ua) ||
				/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
				/(msie) ([\w.]+)/.exec(ua) ||
				ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) || [];

			return {
				browser: match[1] || "",
				version: match[2] || "0"
			};
		}

		var matched = uaMatch(navigator.userAgent);
		browser = {};

		if (matched.browser) {
			browser[matched.browser] = true;
			browser.version = matched.version;
		}

		// Chrome is Webkit, but Webkit is also Safari.
		if (browser.chrome) {
			browser.webkit = true;
		} else if (browser.webkit) {
			browser.safari = true;
		}
	}());

	// Feature detects
	(function() {
		var prefixes = ['', 'webkit', 'moz', 'ms', 'o'];
		var el = document.createElement('div');

		function testProp(prop) {
			for (var p = 0, pl = prefixes.length; p < pl; p++) {
				var prefixedProp = prefixes[p] ? prefixes[p] + prop.charAt(0).toUpperCase() + prop.slice(1) : prop;
				if (el.style[prefixedProp] !== undefined) {
					return prefixedProp;
				}
			}
		}

		// Global support indicators
		transform = testProp('transform') || '';
		gpuAcceleration = testProp('perspective') ? 'translateZ(0) ' : '';
	}());


	/*
		PluginDetect v0.7.9
		www.pinlady.net/PluginDetect/license/
		[ getVersion onWindowLoaded BetterIE ]
		[ Flash QuickTime Shockwave ]
	*/
	var PluginDetect={version:"0.7.9",name:"PluginDetect",handler:function(c,b,a){return function(){c(b,a)}},openTag:"<",isDefined:function(b){return typeof b!="undefined"},isArray:function(b){return(/array/i).test(Object.prototype.toString.call(b))},isFunc:function(b){return typeof b=="function"},isString:function(b){return typeof b=="string"},isNum:function(b){return typeof b=="number"},isStrNum:function(b){return(typeof b=="string"&&(/\d/).test(b))},getNumRegx:/[\d][\d\.\_,-]*/,splitNumRegx:/[\.\_,-]/g,getNum:function(b,c){var d=this,a=d.isStrNum(b)?(d.isDefined(c)?new RegExp(c):d.getNumRegx).exec(b):null;return a?a[0]:null},compareNums:function(h,f,d){var e=this,c,b,a,g=parseInt;if(e.isStrNum(h)&&e.isStrNum(f)){if(e.isDefined(d)&&d.compareNums){return d.compareNums(h,f)}c=h.split(e.splitNumRegx);b=f.split(e.splitNumRegx);for(a=0;a<min(c.length,b.length);a++){if(g(c[a],10)>g(b[a],10)){return 1}if(g(c[a],10)<g(b[a],10)){return -1}}}return 0},formatNum:function(b,c){var d=this,a,e;if(!d.isStrNum(b)){return null}if(!d.isNum(c)){c=4}c--;e=b.replace(/\s/g,"").split(d.splitNumRegx).concat(["0","0","0","0"]);for(a=0;a<4;a++){if(/^(0+)(.+)$/.test(e[a])){e[a]=RegExp.$2}if(a>c||!(/\d/).test(e[a])){e[a]="0"}}return e.slice(0,4).join(",")},$$hasMimeType:function(a){return function(c){if(!a.isIE&&c){var f,e,b,d=a.isArray(c)?c:(a.isString(c)?[c]:[]);for(b=0;b<d.length;b++){if(a.isString(d[b])&&/[^\s]/.test(d[b])){f=navigator.mimeTypes[d[b]];e=f?f.enabledPlugin:0;if(e&&(e.name||e.description)){return f}}}}return null}},findNavPlugin:function(l,e,c){var j=this,h=new RegExp(l,"i"),d=(!j.isDefined(e)||e)?/\d/:0,k=c?new RegExp(c,"i"):0,a=navigator.plugins,g="",f,b,m;for(f=0;f<a.length;f++){m=a[f].description||g;b=a[f].name||g;if((h.test(m)&&(!d||d.test(RegExp.leftContext+RegExp.rightContext)))||(h.test(b)&&(!d||d.test(RegExp.leftContext+RegExp.rightContext)))){if(!k||!(k.test(m)||k.test(b))){return a[f]}}}return null},getMimeEnabledPlugin:function(k,m,c){var e=this,f,b=new RegExp(m,"i"),h="",g=c?new RegExp(c,"i"):0,a,l,d,j=e.isString(k)?[k]:k;for(d=0;d<j.length;d++){if((f=e.hasMimeType(j[d]))&&(f=f.enabledPlugin)){l=f.description||h;a=f.name||h;if(b.test(l)||b.test(a)){if(!g||!(g.test(l)||g.test(a))){return f}}}}return 0},getPluginFileVersion:function(f,b){var h=this,e,d,g,a,c=-1;if(h.OS>2||!f||!f.version||!(e=h.getNum(f.version))){return b}if(!b){return e}e=h.formatNum(e);b=h.formatNum(b);d=b.split(h.splitNumRegx);g=e.split(h.splitNumRegx);for(a=0;a<d.length;a++){if(c>-1&&a>c&&d[a]!="0"){return b}if(g[a]!=d[a]){if(c==-1){c=a}if(d[a]!="0"){return b}}}return e},AXO:window.ActiveXObject,getAXO:function(a){var f=null,d,b=this,c={};try{f=new b.AXO(a)}catch(d){}return f},convertFuncs:function(f){var a,g,d,b=/^[\$][\$]/,c=this;for(a in f){if(b.test(a)){try{g=a.slice(2);if(g.length>0&&!f[g]){f[g]=f[a](f);delete f[a]}}catch(d){}}}},initObj:function(e,b,d){var a,c;if(e){if(e[b[0]]==1||d){for(a=0;a<b.length;a=a+2){e[b[a]]=b[a+1]}}for(a in e){c=e[a];if(c&&c[b[0]]==1){this.initObj(c,b)}}}},initScript:function(){var d=this,a=navigator,h,i=document,l=a.userAgent||"",j=a.vendor||"",b=a.platform||"",k=a.product||"";d.initObj(d,["$",d]);for(h in d.Plugins){if(d.Plugins[h]){d.initObj(d.Plugins[h],["$",d,"$$",d.Plugins[h]],1)}}d.convertFuncs(d);d.OS=100;if(b){var g=["Win",1,"Mac",2,"Linux",3,"FreeBSD",4,"iPhone",21.1,"iPod",21.2,"iPad",21.3,"Win.*CE",22.1,"Win.*Mobile",22.2,"Pocket\\s*PC",22.3,"",100];for(h=g.length-2;h>=0;h=h-2){if(g[h]&&new RegExp(g[h],"i").test(b)){d.OS=g[h+1];break}}};d.head=i.getElementsByTagName("head")[0]||i.getElementsByTagName("body")[0]||i.body||null;d.isIE=new Function("return/*@cc_on!@*/!1")();d.verIE=d.isIE&&(/MSIE\s*(\d+\.?\d*)/i).test(l)?parseFloat(RegExp.$1,10):null;d.verIEfull=null;d.docModeIE=null;if(d.isIE){var f,n,c=document.createElement("div");try{c.style.behavior="url(#default#clientcaps)";d.verIEfull=(c.getComponentVersion("{89820200-ECBD-11CF-8B85-00AA005B4383}","componentid")).replace(/,/g,".")}catch(f){}n=parseFloat(d.verIEfull||"0",10);d.docModeIE=i.documentMode||((/back/i).test(i.compatMode||"")?5:n)||d.verIE;d.verIE=n||d.docModeIE};d.ActiveXEnabled=false;if(d.isIE){var h,m=["Msxml2.XMLHTTP","Msxml2.DOMDocument","Microsoft.XMLDOM","ShockwaveFlash.ShockwaveFlash","TDCCtl.TDCCtl","Shell.UIHelper","Scripting.Dictionary","wmplayer.ocx"];for(h=0;h<m.length;h++){if(d.getAXO(m[h])){d.ActiveXEnabled=true;break}}};d.isGecko=(/Gecko/i).test(k)&&(/Gecko\s*\/\s*\d/i).test(l);d.verGecko=d.isGecko?d.formatNum((/rv\s*\:\s*([\.\,\d]+)/i).test(l)?RegExp.$1:"0.9"):null;d.isChrome=(/Chrome\s*\/\s*(\d[\d\.]*)/i).test(l);d.verChrome=d.isChrome?d.formatNum(RegExp.$1):null;d.isSafari=((/Apple/i).test(j)||(!j&&!d.isChrome))&&(/Safari\s*\/\s*(\d[\d\.]*)/i).test(l);d.verSafari=d.isSafari&&(/Version\s*\/\s*(\d[\d\.]*)/i).test(l)?d.formatNum(RegExp.$1):null;d.isOpera=(/Opera\s*[\/]?\s*(\d+\.?\d*)/i).test(l);d.verOpera=d.isOpera&&((/Version\s*\/\s*(\d+\.?\d*)/i).test(l)||1)?parseFloat(RegExp.$1,10):null;d.addWinEvent("load",d.handler(d.runWLfuncs,d))},init:function(d){var c=this,b,d,a={status:-3,plugin:0};if(!c.isString(d)){return a}if(d.length==1){c.getVersionDelimiter=d;return a}d=d.toLowerCase().replace(/\s/g,"");b=c.Plugins[d];if(!b||!b.getVersion){return a}a.plugin=b;if(!c.isDefined(b.installed)){b.installed=null;b.version=null;b.version0=null;b.getVersionDone=null;b.pluginName=d}c.garbage=false;if(c.isIE&&!c.ActiveXEnabled&&d!=="java"){a.status=-2;return a}a.status=1;return a},fPush:function(b,a){var c=this;if(c.isArray(a)&&(c.isFunc(b)||(c.isArray(b)&&b.length>0&&c.isFunc(b[0])))){a.push(b)}},callArray:function(b){var c=this,a;if(c.isArray(b)){for(a=0;a<b.length;a++){if(b[a]===null){return}c.call(b[a]);b[a]=null}}},call:function(c){var b=this,a=b.isArray(c)?c.length:-1;if(a>0&&b.isFunc(c[0])){c[0](b,a>1?c[1]:0,a>2?c[2]:0,a>3?c[3]:0)}else{if(b.isFunc(c)){c(b)}}},getVersionDelimiter:",",$$getVersion:function(a){return function(g,d,c){var e=a.init(g),f,b,h={};if(e.status<0){return null};f=e.plugin;if(f.getVersionDone!=1){f.getVersion(null,d,c);if(f.getVersionDone===null){f.getVersionDone=1}}a.cleanup();b=(f.version||f.version0);b=b?b.replace(a.splitNumRegx,a.getVersionDelimiter):b;return b}},cleanup:function(){var a=this;if(a.garbage&&a.isDefined(window.CollectGarbage)){window.CollectGarbage()}},isActiveXObject:function(d,b){var f=this,a=false,g,c='<object width="1" height="1" style="display:none" '+d.getCodeBaseVersion(b)+">"+d.HTML+f.openTag+"/object>";if(!f.head){return a}f.head.insertBefore(document.createElement("object"),f.head.firstChild);f.head.firstChild.outerHTML=c;try{f.head.firstChild.classid=d.classID}catch(g){}try{if(f.head.firstChild.object){a=true}}catch(g){}try{if(a&&f.head.firstChild.readyState<4){f.garbage=true}}catch(g){}f.head.removeChild(f.head.firstChild);return a},codebaseSearch:function(f,b){var c=this;if(!c.ActiveXEnabled||!f){return null}if(f.BIfuncs&&f.BIfuncs.length&&f.BIfuncs[f.BIfuncs.length-1]!==null){c.callArray(f.BIfuncs)}var d,o=f.SEARCH,k={};if(c.isStrNum(b)){if(o.match&&o.min&&c.compareNums(b,o.min)<=0){return true}if(o.match&&o.max&&c.compareNums(b,o.max)>=0){return false}d=c.isActiveXObject(f,b);if(d&&(!o.min||c.compareNums(b,o.min)>0)){o.min=b}if(!d&&(!o.max||c.compareNums(b,o.max)<0)){o.max=b}return d};var e=[0,0,0,0],l=[].concat(o.digits),a=o.min?1:0,j,i,h,g,m,n=function(p,r){var q=[].concat(e);q[p]=r;return c.isActiveXObject(f,q.join(","))};if(o.max){g=o.max.split(c.splitNumRegx);for(j=0;j<g.length;j++){g[j]=parseInt(g[j],10)}if(g[0]<l[0]){l[0]=g[0]}}if(o.min){m=o.min.split(c.splitNumRegx);for(j=0;j<m.length;j++){m[j]=parseInt(m[j],10)}if(m[0]>e[0]){e[0]=m[0]}}if(m&&g){for(j=1;j<m.length;j++){if(m[j-1]!=g[j-1]){break}if(g[j]<l[j]){l[j]=g[j]}if(m[j]>e[j]){e[j]=m[j]}}}if(o.max){for(j=1;j<l.length;j++){if(g[j]>0&&l[j]==0&&l[j-1]<o.digits[j-1]){l[j-1]+=1;break}}};for(j=0;j<l.length;j++){h={};for(i=0;i<20;i++){if(l[j]-e[j]<1){break}d=round((l[j]+e[j])/2);if(h["a"+d]){break}h["a"+d]=1;if(n(j,d)){e[j]=d;a=1}else{l[j]=d}}l[j]=e[j];if(!a&&n(j,e[j])){a=1};if(!a){break}};return a?e.join(","):null},addWinEvent:function(d,c){var e=this,a=window,b;if(e.isFunc(c)){if(a.addEventListener){a.addEventListener(d,c,false)}else{if(a.attachEvent){a.attachEvent("on"+d,c)}else{b=a["on"+d];a["on"+d]=e.winHandler(c,b)}}}},winHandler:function(d,c){return function(){d();if(typeof c=="function"){c()}}},WLfuncs0:[],WLfuncs:[],runWLfuncs:function(a){var b={};a.winLoaded=true;a.callArray(a.WLfuncs0);a.callArray(a.WLfuncs);if(a.onDoneEmptyDiv){a.onDoneEmptyDiv()}},winLoaded:false,$$onWindowLoaded:function(a){return function(b){if(a.winLoaded){a.call(b)}else{a.fPush(b,a.WLfuncs)}}},div:null,divID:"plugindetect",divWidth:50,pluginSize:1,emptyDiv:function(){var d=this,b,h,c,a,f,g;if(d.div&&d.div.childNodes){for(b=d.div.childNodes.length-1;b>=0;b--){c=d.div.childNodes[b];if(c&&c.childNodes){for(h=c.childNodes.length-1;h>=0;h--){g=c.childNodes[h];try{c.removeChild(g)}catch(f){}}}if(c){try{d.div.removeChild(c)}catch(f){}}}}if(!d.div){a=document.getElementById(d.divID);if(a){d.div=a}}if(d.div&&d.div.parentNode){try{d.div.parentNode.removeChild(d.div)}catch(f){}d.div=null}},DONEfuncs:[],onDoneEmptyDiv:function(){var c=this,a,b;if(!c.winLoaded){return}if(c.WLfuncs&&c.WLfuncs.length&&c.WLfuncs[c.WLfuncs.length-1]!==null){return}for(a in c){b=c[a];if(b&&b.funcs){if(b.OTF==3){return}if(b.funcs.length&&b.funcs[b.funcs.length-1]!==null){return}}}for(a=0;a<c.DONEfuncs.length;a++){c.callArray(c.DONEfuncs)}c.emptyDiv()},getWidth:function(c){if(c){var a=c.scrollWidth||c.offsetWidth,b=this;if(b.isNum(a)){return a}}return -1},getTagStatus:function(m,g,a,b){var c=this,f,k=m.span,l=c.getWidth(k),h=a.span,j=c.getWidth(h),d=g.span,i=c.getWidth(d);if(!k||!h||!d||!c.getDOMobj(m)){return -2}if(j<i||l<0||j<0||i<0||i<=c.pluginSize||c.pluginSize<1){return 0}if(l>=i){return -1}try{if(l==c.pluginSize&&(!c.isIE||c.getDOMobj(m).readyState==4)){if(!m.winLoaded&&c.winLoaded){return 1}if(m.winLoaded&&c.isNum(b)){if(!c.isNum(m.count)){m.count=b}if(b-m.count>=10){return 1}}}}catch(f){}return 0},getDOMobj:function(g,a){var f,d=this,c=g?g.span:0,b=c&&c.firstChild?1:0;try{if(b&&a){d.div.focus()}}catch(f){}return b?c.firstChild:null},setStyle:function(b,g){var f=b.style,a,d,c=this;if(f&&g){for(a=0;a<g.length;a=a+2){try{f[g[a]]=g[a+1]}catch(d){}}}},insertDivInBody:function(i,g){var f,c=this,h="pd33993399",b=null,d=g?window.top.document:window.document,a=d.getElementsByTagName("body")[0]||d.body;if(!a){try{d.write('<div id="'+h+'">.'+c.openTag+"/div>");b=d.getElementById(h)}catch(f){}}a=d.getElementsByTagName("body")[0]||d.body;if(a){a.insertBefore(i,a.firstChild);if(b){a.removeChild(b)}}},insertHTML:function(f,b,g,a,k){var l,m=document,j=this,p,o=m.createElement("span"),n,i;var c=["outlineStyle","none","borderStyle","none","padding","0px","margin","0px","visibility","visible"];var h="outline-style:none;border-style:none;padding:0px;margin:0px;visibility:visible;";if(!j.isDefined(a)){a=""}if(j.isString(f)&&(/[^\s]/).test(f)){f=f.toLowerCase().replace(/\s/g,"");p=j.openTag+f+' width="'+j.pluginSize+'" height="'+j.pluginSize+'" ';p+='style="'+h+'display:inline;" ';for(n=0;n<b.length;n=n+2){if(/[^\s]/.test(b[n+1])){p+=b[n]+'="'+b[n+1]+'" '}}p+=">";for(n=0;n<g.length;n=n+2){if(/[^\s]/.test(g[n+1])){p+=j.openTag+'param name="'+g[n]+'" value="'+g[n+1]+'" />'}}p+=a+j.openTag+"/"+f+">"}else{p=a}if(!j.div){i=m.getElementById(j.divID);if(i){j.div=i}else{j.div=m.createElement("div");j.div.id=j.divID}j.setStyle(j.div,c.concat(["width",j.divWidth+"px","height",(j.pluginSize+3)+"px","fontSize",(j.pluginSize+3)+"px","lineHeight",(j.pluginSize+3)+"px","verticalAlign","baseline","display","block"]));if(!i){j.setStyle(j.div,["position","absolute","right","0px","top","0px"]);j.insertDivInBody(j.div)}}if(j.div&&j.div.parentNode){j.setStyle(o,c.concat(["fontSize",(j.pluginSize+3)+"px","lineHeight",(j.pluginSize+3)+"px","verticalAlign","baseline","display","inline"]));try{o.innerHTML=p}catch(l){};try{j.div.appendChild(o)}catch(l){};return{span:o,winLoaded:j.winLoaded,tagName:f,outerHTML:p}}return{span:null,winLoaded:j.winLoaded,tagName:"",outerHTML:p}},Plugins:{quicktime:{mimeType:["video/quicktime","application/x-quicktimeplayer","image/x-macpaint","image/x-quicktime"],progID:"QuickTimeCheckObject.QuickTimeCheck.1",progID0:"QuickTime.QuickTime",classID:"clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B",minIEver:7,HTML:'<param name="src" value="" /><param name="controller" value="false" />',getCodeBaseVersion:function(a){return'codebase="#version='+a+'"'},SEARCH:{min:0,max:0,match:0,digits:[16,128,128,0]},getVersion:function(c){var f=this,d=f.$,a=null,e=null,b;if(!d.isIE){if(d.hasMimeType(f.mimeType)){e=d.OS!=3?d.findNavPlugin("QuickTime.*Plug-?in",0):null;if(e&&e.name){a=d.getNum(e.name)}}}else{if(d.isStrNum(c)){b=c.split(d.splitNumRegx);if(b.length>3&&parseInt(b[3],10)>0){b[3]="9999"}c=b.join(",")}if(d.isStrNum(c)&&d.verIE>=f.minIEver&&f.canUseIsMin()>0){f.installed=f.isMin(c);f.getVersionDone=0;return}f.getVersionDone=1;if(!a&&d.verIE>=f.minIEver){a=f.CDBASE2VER(d.codebaseSearch(f))}if(!a){e=d.getAXO(f.progID);if(e&&e.QuickTimeVersion){a=e.QuickTimeVersion.toString(16);a=parseInt(a.charAt(0),16)+"."+parseInt(a.charAt(1),16)+"."+parseInt(a.charAt(2),16)}}}f.installed=a?1:(e?0:-1);f.version=d.formatNum(a,3)},cdbaseUpper:["7,60,0,0","0,0,0,0"],cdbaseLower:["7,50,0,0",null],cdbase2ver:[function(c,b){var a=b.split(c.$.splitNumRegx);return[a[0],a[1].charAt(0),a[1].charAt(1),a[2]].join(",")},null],CDBASE2VER:function(f){var e=this,c=e.$,b,a=e.cdbaseUpper,d=e.cdbaseLower;if(f){f=c.formatNum(f);for(b=0;b<a.length;b++){if(a[b]&&c.compareNums(f,a[b])<0&&d[b]&&c.compareNums(f,d[b])>=0&&e.cdbase2ver[b]){return e.cdbase2ver[b](e,f)}}}return f},canUseIsMin:function(){var f=this,d=f.$,b,c=f.canUseIsMin,a=f.cdbaseUpper,e=f.cdbaseLower;if(!c.value){c.value=-1;for(b=0;b<a.length;b++){if(a[b]&&d.codebaseSearch(f,a[b])){c.value=1;break}if(e[b]&&d.codebaseSearch(f,e[b])){c.value=-1;break}}}f.SEARCH.match=c.value==1?1:0;return c.value},isMin:function(c){var b=this,a=b.$;return a.codebaseSearch(b,c)?0.7:-1}},flash:{mimeType:"application/x-shockwave-flash",progID:"ShockwaveFlash.ShockwaveFlash",classID:"clsid:D27CDB6E-AE6D-11CF-96B8-444553540000",getVersion:function(){var b=function(i){if(!i){return null}var e=/[\d][\d\,\.\s]*[rRdD]{0,1}[\d\,]*/.exec(i);return e?e[0].replace(/[rRdD\.]/g,",").replace(/\s/g,""):null};var j=this,g=j.$,k,h,l=null,c=null,a=null,f,m,d;if(!g.isIE){m=g.hasMimeType(j.mimeType);if(m){f=g.getDOMobj(g.insertHTML("object",["type",j.mimeType],[],"",j));try{l=g.getNum(f.GetVariable("$version"))}catch(k){}}if(!l){d=m?m.enabledPlugin:null;if(d&&d.description){l=b(d.description)}if(l){l=g.getPluginFileVersion(d,l)}}}else{for(h=15;h>2;h--){c=g.getAXO(j.progID+"."+h);if(c){a=h.toString();break}}if(!c){c=g.getAXO(j.progID)}if(a=="6"){try{c.AllowScriptAccess="always"}catch(k){return"6,0,21,0"}}try{l=b(c.GetVariable("$version"))}catch(k){}if(!l&&a){l=a}}j.installed=l?1:-1;j.version=g.formatNum(l);return true}},shockwave:{mimeType:"application/x-director",progID:"SWCtl.SWCtl",classID:"clsid:166B1BCA-3F9C-11CF-8075-444553540000",getVersion:function(){var a=null,b=null,g,f,d=this,c=d.$;if(!c.isIE){f=c.findNavPlugin("Shockwave\\s*for\\s*Director");if(f&&f.description&&c.hasMimeType(d.mimeType)){a=c.getNum(f.description)}if(a){a=c.getPluginFileVersion(f,a)}}else{try{b=c.getAXO(d.progID).ShockwaveVersion("")}catch(g){}if(c.isString(b)&&b.length>0){a=c.getNum(b)}else{if(c.getAXO(d.progID+".8")){a="8"}else{if(c.getAXO(d.progID+".7")){a="7"}else{if(c.getAXO(d.progID+".1")){a="6"}}}}}d.installed=a?1:-1;d.version=c.formatNum(a)}},zz:0}};PluginDetect.initScript();

	var gArgCountErr='The "%%" function requires an even number of arguments.\nArguments should be in the form "atttributeName", "attributeValue", ...',gTagAttrs=null,gQTGeneratorVersion=1;function AC_QuickTimeVersion(){return gQTGeneratorVersion}function _QTComplain(a,b){b=b.replace("%%",a);alert(b)}function _QTAddAttribute(a,b,c){var d;d=gTagAttrs[a+b];null==d&&(d=gTagAttrs[b]);return null!=d?(0==b.indexOf(a)&&null==c&&(c=b.substring(a.length)),null==c&&(c=b),c+'="'+d+'" '):""}function _QTAddObjectAttr(a,b){if(0==a.indexOf("emb#"))return"";0==a.indexOf("obj#")&&null==b&&(b=a.substring(4));return _QTAddAttribute("obj#",a,b)}function _QTAddEmbedAttr(a,b){if(0==a.indexOf("obj#"))return"";0==a.indexOf("emb#")&&null==b&&(b=a.substring(4));return _QTAddAttribute("emb#",a,b)}function _QTAddObjectParam(a,b){var c,d="",e=b?" />":">";-1==a.indexOf("emb#")&&(c=gTagAttrs["obj#"+a],null==c&&(c=gTagAttrs[a]),0==a.indexOf("obj#")&&(a=a.substring(4)),null!=c&&(d='  <param name="'+a+'" value="'+c+'"'+e+"\n"));return d}function _QTDeleteTagAttrs(){for(var a=0;a<arguments.length;a++){var b=arguments[a];delete gTagAttrs[b];delete gTagAttrs["emb#"+b];delete gTagAttrs["obj#"+b]}}function _QTGenerate(a,b,c){if(4>c.length||0!=c.length%2)return _QTComplain(a,gArgCountErr),"";gTagAttrs=[];gTagAttrs.src=c[0];gTagAttrs.width=c[1];gTagAttrs.height=c[2];gTagAttrs.classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B";gTagAttrs.pluginspage="http://www.apple.com/quicktime/download/";a=c[3];if(null==a||""==a)a="6,0,2,0";gTagAttrs.codebase="http://www.apple.com/qtactivex/qtplugin.cab#version="+a;for(var d,e=4;e<c.length;e+=2)d=c[e].toLowerCase(),a=c[e+1],"name"==d||"id"==d?gTagAttrs.name=a:gTagAttrs[d]=a;c="<object "+_QTAddObjectAttr("classid")+_QTAddObjectAttr("width")+_QTAddObjectAttr("height")+_QTAddObjectAttr("codebase")+_QTAddObjectAttr("name","id")+_QTAddObjectAttr("tabindex")+_QTAddObjectAttr("hspace")+_QTAddObjectAttr("vspace")+_QTAddObjectAttr("border")+_QTAddObjectAttr("align")+_QTAddObjectAttr("class")+_QTAddObjectAttr("title")+_QTAddObjectAttr("accesskey")+_QTAddObjectAttr("noexternaldata")+">\n"+_QTAddObjectParam("src",b);e="  <embed "+_QTAddEmbedAttr("src")+_QTAddEmbedAttr("width")+_QTAddEmbedAttr("height")+_QTAddEmbedAttr("pluginspage")+_QTAddEmbedAttr("name")+_QTAddEmbedAttr("align")+_QTAddEmbedAttr("tabindex");_QTDeleteTagAttrs("src","width","height","pluginspage","classid","codebase","name","tabindex","hspace","vspace","border","align","noexternaldata","class","title","accesskey");for(d in gTagAttrs)a=gTagAttrs[d],null!=a&&(e+=_QTAddEmbedAttr(d),c+=_QTAddObjectParam(d,b));return c+e+"> </embed>\n</object>"}function QT_GenerateOBJECTText(){return _QTGenerate("QT_GenerateOBJECTText",!1,arguments)};


	/*
		jQuery hashchange event v1.3
		https://github.com/cowboy/jquery-hashchange
		Copyright (c) 2010 "Cowboy" Ben Alman
		Dual licensed under the MIT and GPL licenses.
	*/
	(function(){function e(a){a=a||location.href;return"#"+a.replace(/^[^#]*#?(.*)$/,"$1")}var k=document,b,f=$.event.special,p=k.documentMode,m="oniLightBoxHashChange"in window&&(void 0===p||7<p);$.fn.iLightBoxHashChange=function(a){return a?this.bind("iLightBoxHashChange",a):this.trigger("iLightBoxHashChange")};$.fn.iLightBoxHashChange.delay=50;f.iLightBoxHashChange=$.extend(f.iLightBoxHashChange,{setup:function(){if(m)return!1;$(b.start)},teardown:function(){if(m)return!1;$(b.stop)}});b=function(){function a(){var c=
	e(),d=f(l);c!==l?(n(l=c,d),$(window).trigger("iLightBoxHashChange")):d!==l&&(location.href=location.href.replace(/#.*/,"")+d);g=setTimeout(a,$.fn.iLightBoxHashChange.delay)}var h={},g,l=e(),b=function(c){return c},n=b,f=b;h.start=function(){g||a()};h.stop=function(){g&&clearTimeout(g);g=void 0};browser.msie&&!m&&function(){var c,d;h.start=function(){c||(d=(d=$.fn.iLightBoxHashChange.src)&&d+e(),c=$('<iframe tabindex="-1" title="empty"/>').hide().one("load",function(){d||n(e());a()}).attr("src",d||
	"javascript:0").insertAfter("body")[0].contentWindow,k.onpropertychange=function(){try{"title"===event.propertyName&&(c.document.title=k.title)}catch(a){}})};h.stop=b;f=function(){return e(c.location.href)};n=function(a,d){var b=c.document,e=$.fn.iLightBoxHashChange.domain;a!==d&&(b.title=k.title,b.open(),e&&b.write('<script>document.domain="'+e+'"\x3c/script>'),b.close(),c.location.hash=a)}}();return h}()})();

	if (!Array.prototype.filter) {
		Array.prototype.filter = function(fun /*, thisp */ ) {
			"use strict";

			if (this == null)
				throw new TypeError();

			var t = Object(this);
			var len = t.length >>> 0;
			if (typeof fun != "function")
				throw new TypeError();

			var res = [];
			var thisp = arguments[1];
			for (var i = 0; i < len; i++) {
				if (i in t) {
					var val = t[i]; // in case fun mutates this
					if (fun.call(thisp, val, i, t))
						res.push(val);
				}
			}

			return res;
		};
	}

	if (!Array.prototype.indexOf) {
		Array.prototype.indexOf = function(searchElement, fromIndex) {
			var k;

			if (this == null) {
				throw new TypeError('"this" is null or not defined');
			}

			var O = Object(this);

			var len = O.length >>> 0;

			if (len === 0) {
				return -1;
			}

			var n = +fromIndex || 0;

			if (abs(n) === Infinity) {
				n = 0;
			}

			if (n >= len) {
				return -1;
			}

			k = max(n >= 0 ? n : len - abs(n), 0);

			while (k < len) {
				var kValue;
				if (k in O && O[k] === searchElement) {
					return k;
				}
				k++;
			}
			return -1;
		};
	}

	if (!Array.prototype.lastIndexOf) {
		Array.prototype.lastIndexOf = function(searchElement /*, fromIndex*/ ) {
			"use strict";

			if (this == null)
				throw new TypeError();

			var t = Object(this);
			var len = t.length >>> 0;
			if (len === 0)
				return -1;

			var n = len;
			if (arguments.length > 1) {
				n = Number(arguments[1]);
				if (n != n)
					n = 0;
				else if (n != 0 && n != (1 / 0) && n != -(1 / 0))
					n = (n > 0 || -1) * floor(abs(n));
			}

			var k = n >= 0 ? min(n, len - 1) : len - abs(n);

			for (; k >= 0; k--) {
				if (k in t && t[k] === searchElement)
					return k;
			}
			return -1;
		};
	}
})(jQuery, this);