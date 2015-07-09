/*
 * RoyalSlider
 *
 * @version 9.5.4:
 *
 * Copyright, Dmitry Semenov
 *
 */
(function($) {

	"use strict";

	if(!$.rsModules) {
		$.rsModules = {uid:0};
	}

	function RoyalSlider(element, options) {
		var i,
			self = this,
			navigator = window.navigator,
			ua = navigator.userAgent.toLowerCase();

		self.uid = $.rsModules.uid++;
		self.ns = '.rs' + self.uid; // unique namespace for events

		// feature detection, some ideas taken from Modernizr
		var tempStyle = document.createElement('div').style,
			vendors = ['webkit','Moz','ms','O'],
			vendor = '',
			lastTime = 0,
			tempV;

		for (i = 0; i < vendors.length; i++ ) {
			tempV = vendors[i];
			if (!vendor && (tempV + 'Transform') in tempStyle ) {
				vendor = tempV;
			}
			tempV = tempV.toLowerCase();
			
			if(!window.requestAnimationFrame) {
				window.requestAnimationFrame = window[tempV+'RequestAnimationFrame'];
				window.cancelAnimationFrame = window[tempV+'CancelAnimationFrame'] || window[tempV+'CancelRequestAnimationFrame'];
			}
		}

		// requestAnimationFrame polyfill by Erik Möller
		// fixes from Paul Irish and Tino Zijdel
		if (!window.requestAnimationFrame) {
			window.requestAnimationFrame = function(callback, element) {
				var currTime = new Date().getTime(),
					timeToCall = Math.max(0, 16 - (currTime - lastTime)),
					id = window.setTimeout(function() { callback(currTime + timeToCall); }, timeToCall);
					lastTime = currTime + timeToCall;
				return id;
			};
		}

		if (!window.cancelAnimationFrame) {
			window.cancelAnimationFrame = function(id) { clearTimeout(id); };
		}
			

		self.isIPAD = ua.match(/(ipad)/);
		self.isIOS = self.isIPAD || ua.match(/(iphone|ipod)/);


		// browser UA sniffing, sadly still required
		var uaMatch = function( ua ) {
			var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
				/(webkit)[ \/]([\w.]+)/.exec( ua ) ||
				/(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
				/(msie) ([\w.]+)/.exec( ua ) ||
				ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
				[];

			return {
				browser: match[ 1 ] || "",
				version: match[ 2 ] || "0"
			};
		};
		var matched = uaMatch( ua );
		var br = {};
		if ( matched.browser ) {
			br[ matched.browser ] = true;
			br.version = matched.version;
		}

		if(br.chrome) { 
			br.webkit = true;
		}

		self._browser = br;
		self.isAndroid = ua.indexOf("android") > -1;



		self.slider = $(element); // DOM reference
		self.ev = $(self); // event object
		self._doc = $(document);
		self.st = $.extend({}, $.fn.royalSlider.defaults, options); 
		self._currAnimSpeed = self.st.transitionSpeed;
		self._minPosOffset = 0;
		if(self.st.allowCSS3) {
			if((!br.webkit || self.st.allowCSS3OnWebkit) ) {
				var bT = vendor + (vendor ? 'T' : 't' );
				self._useCSS3Transitions = ( (bT + 'ransform') in tempStyle ) && ( (bT + 'ransition') in tempStyle );
				if(self._useCSS3Transitions) {
					self._use3dTransform = (vendor + (vendor ? 'P' : 'p'  ) + 'erspective') in tempStyle;
				}
			}
		}
		
		vendor = vendor.toLowerCase();
		self._vendorPref = '-'+vendor+'-';
		
		self._slidesHorizontal = (self.st.slidesOrientation === 'vertical') ? false : true;
		self._reorderProp = self._slidesHorizontal ? 'left' : 'top';
		self._sizeProp = self._slidesHorizontal ? 'width' : 'height';
		self._prevNavItemId = -1;
		self._isMove = (self.st.transitionType === 'fade') ? false : true;
		if(!self._isMove) {
			self.st.sliderDrag = false;
			self._fadeZIndex = 10;
		}
		self._opacityCSS = 'z-index:0; display:none; opacity:0;';

		self._newSlideId = 0;
		self._sPosition = 0;
		self._nextSlidePos = 0;

		// init modules
		$.each($.rsModules, function (helper, opts) {
			if(helper !== 'uid')
				opts.call(self);
		});

		// parse all slides
		self.slides = [];
		self._idCount = 0;
		var returnVal;
		var ts = self.st.slides ? $(self.st.slides) : self.slider.children().detach();
		
		ts.each(function() {
			self._parseNode(this, true);
		});

		if(self.st.randomizeSlides) {
			self.slides.sort(function() { return 0.5 - Math.random(); });
		}
		self.numSlides = self.slides.length;
		self._refreshNumPreloadImages();

		if(!self.st.startSlideId) {
			self.st.startSlideId = 0;
		} else if(self.st.startSlideId > self.numSlides - 1) {
			self.st.startSlideId = self.numSlides - 1;
		}

		self._newSlideId = self.staticSlideId = self.currSlideId = self._realId =  self.st.startSlideId;
		self.currSlide = self.slides[self.currSlideId];

		self._accelerationPos = 0;
		self.pointerMultitouch = false;
		self.slider.addClass( (self._slidesHorizontal ? 'rsHor' : 'rsVer') + (self._isMove ? '' : ' rsFade') );

		var sliderHTML = '<div class="rsOverflow"><div class="rsContainer">';
		self.slidesSpacing = self.st.slidesSpacing;
		self._slideSize = ( self._slidesHorizontal ? self.slider.width() : self.slider.height() ) + self.st.slidesSpacing;

		self._preload = Boolean(self._numPreloadImages > 0);
		
		if(self.numSlides <= 1) {
			self._loop = false;
		}
		var loopHelpers = (self._loop && self._isMove) ? ( self.numSlides === 2 ? 1 : 2) : 0;
		self._loopHelpers = loopHelpers;

		self._maxImages = self.numSlides < 6 ? self.numSlides : 6;
		self._currBlockIndex = 0;


		self._idOffset = 0;
		self.slidesJQ = [];
		
		for(i =0; i < self.numSlides; i++) {
			self.slidesJQ.push( $(createItemHTML(i)) );
		}
		self._sliderOverflow = sliderHTML = $(sliderHTML + '</div></div>');


		var addCursors = function() {
			if(self.st.sliderDrag) {
				self._hasDrag = true;
				if (br.msie || br.opera) {
					self._grabCursor = self._grabbingCursor = "move";
				} else if(br.mozilla) {
					self._grabCursor = "-moz-grab";
					self._grabbingCursor = "-moz-grabbing";
				} else if(br.webkit && (navigator.platform.indexOf("Mac")!=-1)) {
					self._grabCursor = "-webkit-grab";
					self._grabbingCursor = "-webkit-grabbing";
				}
				self._setGrabCursor();
			}
		};
		var rsNS = self.ns;
		var addEventNames = function(pref, down, move, up, cancel) {
			self._downEvent = pref + down + rsNS;
			self._moveEvent = pref + move + rsNS;
			self._upEvent = pref + up + rsNS;
			if(cancel)
				self._cancelEvent = pref + cancel + rsNS;
		};


		// Pointer events support
		var nPointerEnabled = navigator.pointerEnabled;
		self.pointerEnabled = nPointerEnabled || navigator.msPointerEnabled;

		if(self.pointerEnabled) {
			self.hasTouch = false;
			self._lastItemFriction = 0.2;
			// Hardware supports multitouch
			self.pointerMultitouch = Boolean(navigator[ (nPointerEnabled ? 'm' : 'msM') + 'axTouchPoints' ] > 1);
			if(nPointerEnabled) {
				// >= IE11 & other devices that support pointer events
				addEventNames('pointer', 'down', 'move', 'up', 'cancel');
			} else {
				// IE10
				addEventNames('MSPointer', 'Down', 'Move', 'Up', 'Cancel');
			}
		} else {

			// IOS can't handle both touch and mouse events at once
			if(!self.isIOS) {
				addEventNames('mouse', 'down', 'move', 'up');
			} else {
				self._downEvent = self._moveEvent = self._upEvent = self._cancelEvent = '';
			}

			if('ontouchstart' in window || 'createTouch' in document) {
				self.hasTouch = true;
				self._downEvent += ' touchstart' + rsNS;
				self._moveEvent += ' touchmove' + rsNS;
				self._upEvent += ' touchend' + rsNS;
				self._cancelEvent += ' touchcancel' + rsNS;
				self._lastItemFriction = 0.5;
				if(self.st.sliderTouch) {
					self._hasDrag = true;
				}
			} else {
				self.hasTouch = false;
				self._lastItemFriction = 0.2;
			}
		}
		addCursors();
	
		self.slider.html(sliderHTML);

		
		self._controlsContainer = self.st.controlsInside ? self._sliderOverflow : self.slider;
		
		self._slidesContainer = self._sliderOverflow.children('.rsContainer');
		if(self.pointerEnabled) {
			self._slidesContainer.css( (nPointerEnabled ? '' : '-ms-') + 'touch-action', self._slidesHorizontal ? 'pan-y' : 'pan-x');
		}
		self._preloader = $('<div class="rsPreloader"></div>');
		var slides = self._slidesContainer.children('.rsSlide');

		self._currHolder = self.slidesJQ[self.currSlideId];
		self._selectedSlideHolder = 0;

		function createItemHTML(i, className) {
			return '<div style="'+ (self._isMove ? '' : (i !== self.currSlideId  ? self._opacityCSS : 'z-index:0;') ) +'" class="rsSlide '+ (className || '')+'"></div>';
		}
		
		if(self._useCSS3Transitions) {

			// some constants for CSS3
			self._TP = 'transition-property';
			self._TD = 'transition-duration';
			self._TTF = 'transition-timing-function';

			self._yProp = self._xProp = self._vendorPref +'transform';

			if(self._use3dTransform) {
				if(br.webkit && !br.chrome) {
					self.slider.addClass('rsWebkit3d');
				}

				self._tPref1 = 'translate3d(';
				self._tPref2 = 'px, ';
				self._tPref3 = 'px, 0px)';
			} else {
				self._tPref1 = 'translate(';
				self._tPref2 = 'px, ';
				self._tPref3 = 'px)';
			}
			if(!self._isMove) {
				var animObj = {};
				animObj[(self._vendorPref + self._TP)] = 'opacity';
				animObj[(self._vendorPref + self._TD)] = self.st.transitionSpeed + 'ms';
				animObj[(self._vendorPref + self._TTF)] = self.st.css3easeInOut;
				slides.css(animObj);
			} else {
				self._slidesContainer[(self._vendorPref + self._TP)] = (self._vendorPref + 'transform');
			}
			

		} else {
			self._xProp = 'left';
			self._yProp = 'top';
		}

		

		// window resize
		var resizeTimer;
		$(window).on('resize'+self.ns, function() {	
			if(resizeTimer) {
				clearTimeout(resizeTimer);			
			}
			resizeTimer = setTimeout(function() { self.updateSliderSize(); }, 50);			
		});	
		self.ev.trigger('rsAfterPropsSetup'); // navigation (bullets, thumbs...) are created here

		self.updateSliderSize();


		// keyboard nav
		if(self.st.keyboardNavEnabled) {
			self._bindKeyboardNav();
		}

		if(self.st.arrowsNavHideOnTouch && (self.hasTouch || self.pointerMultitouch) ) {
			self.st.arrowsNav = false;
		}

		//Direction navigation (arrows)
		if(self.st.arrowsNav) {
			var rArr = 'rsArrow',
				container = self._controlsContainer;
			$('<div class="'+rArr+' '+rArr+'Left"><div class="'+rArr+'Icn"></div></div><div class="'+rArr+' '+rArr+'Right"><div class="'+rArr+'Icn"></div></div>').appendTo(container);

			self._arrowLeft = container.children('.'+rArr+'Left').click(function(e) {
				e.preventDefault();
				self.prev();
			});
			self._arrowRight = container.children('.'+rArr+'Right').click(function(e) {
				e.preventDefault();
				self.next();
			});

			if(self.st.arrowsNavAutoHide && !self.hasTouch) {
				self._arrowLeft.addClass('rsHidden');
				self._arrowRight.addClass('rsHidden');

				var hoverEl = container;
				hoverEl.one("mousemove.arrowshover",function() {
					self._arrowLeft.removeClass('rsHidden');
					self._arrowRight.removeClass('rsHidden');			
				});


				hoverEl.hover(
					function() {
						if(!self._arrowsAutoHideLocked) {
							self._arrowLeft.removeClass('rsHidden');
							self._arrowRight.removeClass('rsHidden');
						}
					},
					function() {
						if(!self._arrowsAutoHideLocked) {
							self._arrowLeft.addClass('rsHidden');
							self._arrowRight.addClass('rsHidden');
						}
					}
				);	
			}	
			self.ev.on('rsOnUpdateNav', function() {
				self._updateArrowsNav();
			});
			self._updateArrowsNav();
		}

			
		
		if( self._hasDrag ) {
			self._slidesContainer.on(self._downEvent, function(e) { self._onDragStart(e); });	
		} else {
			self.dragSuccess = false;
		}
		var videoClasses = ['rsPlayBtnIcon', 'rsPlayBtn', 'rsCloseVideoBtn', 'rsCloseVideoIcn'];
		self._slidesContainer.click(function(e) {
			if(!self.dragSuccess) {
				var t = $(e.target);
				var tClass = t.attr('class');
				if( $.inArray(tClass, videoClasses) !== -1) {
					if( self.toggleVideo() ) {
						return false;
					}
				}
				if(self.st.navigateByClick && !self._blockActions) {
					if($(e.target).closest('.rsNoDrag', self._currHolder).length) {
						return true;
					}
					self._mouseNext(e);
				} 
				self.ev.trigger('rsSlideClick', e);
			} 
		}).on('click.rs', 'a', function(e) {	
			if(self.dragSuccess) {						
				return false;
			} else {
				self._blockActions = true;
				//e.stopPropagation();
				//e.stopImmediatePropagation();
				setTimeout(function() {
					self._blockActions = false;
				}, 3);
			}
		});
		self.ev.trigger('rsAfterInit');
	} /* RoyalSlider Constructor End */

	/**
	 *
	 * RoyalSlider Core Prototype
	 * 
	 */
	RoyalSlider.prototype = {
		constructor: RoyalSlider,
		_mouseNext: function(e) {
			var self = this,
				relativePos = e[self._slidesHorizontal ? 'pageX' : 'pageY'] - self._sliderOffset;

			if(relativePos >= self._nextSlidePos) {
				self.next();
			} else if(relativePos < 0) {
				self.prev();
			}
		},
		_refreshNumPreloadImages: function() {
			var self = this,
				n;
			n = self.st.numImagesToPreload;
			self._loop = self.st.loop;

			if(self._loop) {
				if(self.numSlides === 2) {
					self._loop = false;
					self.st.loopRewind = true;
				} else if(self.numSlides < 2) {
					self.st.loopRewind = self._loop = false;
				}
				
			}
			if(self._loop && n > 0) {
				if(self.numSlides <= 4) {
					n = 1;
				} else {
					if(self.st.numImagesToPreload > (self.numSlides - 1) / 2 ) {
						n = Math.floor( (self.numSlides - 1) / 2 );
					}
				} 
			}
			self._numPreloadImages = n;
		},
		_parseNode: function(content, pushToSlides) {
			var self = this,
				hasImg,
				isRoot,
				hasCover,
				obj = {},
				tempEl,
				first = true;
			content = $(content);
			self._currContent = content;
			self.ev.trigger('rsBeforeParseNode', [content, obj]);
			if(obj.stopParsing) {
				return;
			}
			content = self._currContent;
			obj.id = self._idCount;
			obj.contentAdded = false;
			self._idCount++;
			obj.images = [];
			obj.isBig = false;

			if(!obj.hasCover) {
				if(content.hasClass('rsImg')) {
					tempEl = content;
					hasImg = true;
				} else {
					tempEl = content.find('.rsImg');
					if(tempEl.length) {
						hasImg = true;
					}
				}

				if(hasImg) {
					obj.bigImage = tempEl.eq(0).attr('data-rsBigImg');
					tempEl.each(function() {
						var item = $(this);
						if(item.is('a')) {
							parseEl(item, 'href');
						} else if(item.is('img')) {
							parseEl(item, 'src');
						} else {
							parseEl(item);
						}
					});
				} else if(content.is('img')) {
					content.addClass('rsImg rsMainSlideImage');
					parseEl(content, 'src');
				}
			}
			tempEl = content.find('.rsCaption');
			if(tempEl.length) {
				obj.caption = tempEl.remove();
			}
			obj.content = content;

			self.ev.trigger('rsAfterParseNode', [content, obj]);
			function parseEl(el, s) {
				if(s) {
					obj.images.push( el.attr(s) );
				} else {
					obj.images.push( el.text() );
				}
				if(first) {
					first = false;
					obj.caption = (s === 'src') ? el.attr('alt') : el.contents();
					obj.image = obj.images[0];
					obj.videoURL = el.attr('data-rsVideo');
					
					
					var wAtt = el.attr('data-rsw'),
						hAtt = el.attr('data-rsh');
					if (typeof wAtt !== 'undefined' && wAtt !== false && typeof hAtt !== 'undefined' && hAtt !== false ) {
						obj.iW = parseInt(wAtt, 10);
						obj.iH = parseInt(hAtt, 10);
					} else if(self.st.imgWidth && self.st.imgHeight ) {
						obj.iW = self.st.imgWidth;
						obj.iH = self.st.imgHeight;
					}
				}
			}
			if(pushToSlides) {
				self.slides.push(obj);
			}
			if(obj.images.length === 0) {
				obj.isLoaded = true;
				obj.isRendered = false;
				obj.isLoading = false;
				obj.images = null;
			}
			return obj;
		},
		_bindKeyboardNav: function() {
			var self = this,
				interval,
				keyCode,
				onKeyboardAction = function (keyCode) {
					if(keyCode === 37) {
						self.prev();
					} else if (keyCode === 39) {
						self.next();
					}
				};

			self._doc.on('keydown' + self.ns, function(e) {
				if(!self._isDragging) {
					keyCode = e.keyCode;
					if(keyCode === 37 || keyCode === 39) {
						if(!interval) {
							onKeyboardAction(keyCode);
							interval = setInterval(function() {
								onKeyboardAction(keyCode);
							}, 700);
						}
					}
				}
			}).on('keyup' + self.ns, function(e) {
				if(interval) {
					clearInterval(interval); 
					interval = null;
				}
			});

			
			
		},




		goTo: function(id, notUserAction) {
			var self = this;
			if(id !== self.currSlideId) {
				self._moveTo(id,self.st.transitionSpeed, true, !notUserAction);
			}
		},
		destroy: function(remove) {
			var self = this;
			self.ev.trigger('rsBeforeDestroy');
			self._doc.off('keydown' +self.ns+ ' keyup' + self.ns + ' ' + self._moveEvent +' '+ self._upEvent );
			self._slidesContainer.off(self._downEvent + ' click');	
			self.slider.data('royalSlider', null);
			$.removeData(self.slider, 'royalSlider');
			$(window).off('resize' + self.ns);
			if(self.loadingTimeout) {
			  clearTimeout(self.loadingTimeout);
			}
			if(remove) {
				self.slider.remove();
			}
			self.slides = null;
			self.slider = null;
			self.ev = null;
		},
		_updateBlocksContent: function(beforeTransition, getId) {
			var self = this,
				item,
				i,
				n,
				pref,
				group,
				groupId,
				slideCode,
				loop = self._loop,
				numSlides = self.numSlides;
			if(!isNaN(getId) ) {
				return getCorrectLoopedId(getId);
			}


			var id = self.currSlideId;
			var groupOffset;
			
			var itemsOnSide = beforeTransition ? (Math.abs(self._prevSlideId - self.currSlideId) >= self.numSlides - 1 ? 0 : 1) : self._numPreloadImages;
			var itemsToCheck = Math.min(2, itemsOnSide); 
			
			var updateAfter = false;
			var updateBefore = false;
			var tempId;


			
			for(i = id; i < id + 1 + itemsToCheck; i++) {
				tempId = getCorrectLoopedId(i);
				item = self.slides[tempId];
				if(item && (!item.isAdded || !item.positionSet) ) {
					updateAfter = true;
					break;
				}
			}
			for(i = id - 1; i > id - 1 - itemsToCheck; i--) {
				tempId = getCorrectLoopedId(i);
				item = self.slides[tempId];
				if(item && (!item.isAdded || !item.positionSet) ) {
					updateBefore = true;
					break;
				}
			}
			if(updateAfter) {
				for(i = id; i < id + itemsOnSide + 1; i++) {
					tempId = getCorrectLoopedId(i);
					groupOffset = Math.floor( (self._realId - (id - i)) / self.numSlides) * self.numSlides;
					item = self.slides[tempId];
					if(item) {
						updateItem(item, tempId);	
					}
				}
			}
			if(updateBefore) {
				for(i = id - 1; i > id - 1 - itemsOnSide; i--) {
					tempId = getCorrectLoopedId(i);
					groupOffset = Math.floor( (self._realId - (id - i) ) / numSlides) * numSlides;
					item = self.slides[tempId];
					if(item) {
						updateItem(item, tempId);
					}
				}
			}
			if(!beforeTransition) {
				var start = id;
				var distance = itemsOnSide;
				var min = getCorrectLoopedId(id - itemsOnSide);
				var max = getCorrectLoopedId(id + itemsOnSide);
				
				var nmin = min > max ? 0 : min;
				
				for (i = 0; i < numSlides; i++) { 
					if(min > max) {
						if(i > min - 1) {
							continue;
						}
					}
					if(i < nmin || i > max) {
						item = self.slides[i];
						if(item && item.holder) {
							item.holder.detach();
							item.isAdded = false;
						}     
					}                               
				}   
			}

			
			
				
				
			function updateItem(item , i, slideCode) {

				if(!item.isAdded) {
					if(!slideCode)
						slideCode = self.slidesJQ[i];

					if(!item.holder) {
						slideCode = self.slidesJQ[i] = $(slideCode);
						item.holder = slideCode;
					} else {
						slideCode = item.holder;
					}

					item.appendOnLoaded = false;

					
					updatePos(i, item, slideCode);
					addContent(i, item);
					self._addBlockToContainer(item, slideCode, beforeTransition);
					item.isAdded = true;
				} else {
					addContent(i, item);
					updatePos(i, item);
				}
			}
			function addContent(i, item) {
				if(!item.contentAdded) {
					self.setItemHtml(item, beforeTransition);
					if(!beforeTransition) {
						item.contentAdded = true;
					}
					
				}
			}
			function updatePos(i, item, slideCode) {
				if(self._isMove) {
					if(!slideCode) {
						slideCode = self.slidesJQ[i];
					}

					slideCode.css(self._reorderProp, (i + self._idOffset + groupOffset) * self._slideSize);
				}
			}
			function getCorrectLoopedId(index) {
				var changed = false;
				if(loop) {
					if(index > numSlides - 1) {
						return getCorrectLoopedId(index - numSlides);
					} else  if(index < 0) {
						return getCorrectLoopedId(numSlides + index);
					}
				}
				return index;
			}
			
		},

		/**
		 * Sets or loads HTML for specified slide
		 * @param {Object} currSlideObject  holds data about curr slide (read about rsAfterParseNode for more info)
		 * @param {Boolean} beforeTransition determines if setItemHTML method is called before or after transition
		 */
		setItemHtml: function(currSlideObject, beforeTransition) {
			var self = this;

			var parseDataAndLoad = function() {
				if(!currSlideObject.images) {
					currSlideObject.isRendered = true;
					currSlideObject.isLoaded = true;
					currSlideObject.isLoading = false;
					appendContent(true);
					return;
				}
				if(currSlideObject.isLoading) {
					return;
				}
				
				var el,
					isRoot;
				if(currSlideObject.content.hasClass('rsImg') ) {
					el = currSlideObject.content;
					isRoot = true;
				} else {
					el = currSlideObject.content.find('.rsImg:not(img)');
				}
				if(el && !el.is('img')) {
					el.each(function() {
						var item = $(this),
							newEl = '<img class="rsImg" src="'+ ( item.is('a') ? item.attr('href') : item.text() ) +'" />';

						if(!isRoot) {
							item.replaceWith( newEl );
						} else {
							currSlideObject.content = $(newEl);
						}
					});
				}
				
				el = isRoot ? currSlideObject.content : currSlideObject.content.find('img.rsImg');
				setPreloader();
				
				el.eq(0).addClass('rsMainSlideImage');
				if(currSlideObject.iW && currSlideObject.iH) {
					if(!currSlideObject.isLoaded) {
						self._resizeImage( currSlideObject );
					}
					appendContent();
				}

				currSlideObject.isLoading = true;
				var newEl;

				var eNames = 'load.rs error.rs';
				if(currSlideObject.isBig) {
					$('<img />').on(eNames, function(e){
						$(this).off(eNames);
						onLoad( [this], true );
					}).attr('src', currSlideObject.image);
				} else {
					currSlideObject.loaded = [];
					currSlideObject.numStartedLoad = 0;
					var onLoaded = function(e) {
						$(this).off(eNames);
						currSlideObject.loaded.push( this );
						if(currSlideObject.loaded.length === currSlideObject.numStartedLoad) {
							onLoad( currSlideObject.loaded, false );
						}
					};
					for(var i = 0; i < currSlideObject.images.length; i++) {
						var image = $('<img />');
						currSlideObject.numStartedLoad++;
						image.on('load.rs error.rs', onLoaded).attr('src', currSlideObject.images[i]);
					}
				}
			};

			var onLoad = function($images, isBig) {
				if($images.length) {
					var img = $images[0],
					src = img.src;

					if(isBig !== currSlideObject.isBig) {
						var c = currSlideObject.holder.children();
						if(c && c.length > 1) {
							removePreloader();
						}
						return;
					}

					if(currSlideObject.iW && currSlideObject.iH) {
						imageLoadingComplete();
						return;
					}
					currSlideObject.iW = img.width;
					currSlideObject.iH = img.height;
					if(currSlideObject.iW && currSlideObject.iH) {
						imageLoadingComplete();
						return;
					} else {
						// if no size, try again
						var loader = new Image();
						loader.onload = function() {
							if(loader.width) {
								currSlideObject.iW = loader.width;
								currSlideObject.iH = loader.height;
								imageLoadingComplete();
							} else {
								setTimeout(function() {
									if(loader.width) {
										currSlideObject.iW = loader.width;
										currSlideObject.iH = loader.height;
									}

									// failed to get size on last tier, just output image
									imageLoadingComplete();
								}, 1000);
							}
						};
						loader.src = img.src;
					}
				} else {
					imageLoadingComplete();
				}
			};

			var imageLoadingComplete = function () {
				currSlideObject.isLoaded = true;
				currSlideObject.isLoading = false;

				appendContent();
				removePreloader();
				triggerLoaded();
			};

			var waitForTransition = function () {
				if(!self._isMove && currSlideObject.images && currSlideObject.iW && currSlideObject.iH) {
					parseDataAndLoad();
					return;
				}
				currSlideObject.holder.isWaiting = true;
				setPreloader();
				currSlideObject.holder.slideId = -99;
			};
			
			var appendContent = function() {
				if(!currSlideObject.isAppended && self.ev) {

					var visibleNearby = self.st.visibleNearby,
					bId = currSlideObject.id - self._newSlideId;
					if(!beforeTransition && !currSlideObject.appendOnLoaded && self.st.fadeinLoadedSlide  && ( bId === 0 || ( (visibleNearby || self._isAnimating || self._isDragging) && (bId === -1 || bId === 1) ) ) ) {
						var css = {
							visibility: 'visible', 
							opacity: 0
						};
						css[self._vendorPref + 'transition'] = 'opacity 400ms ease-in-out';
						currSlideObject.content.css(css);

						setTimeout(function() {
							currSlideObject.content.css('opacity', 1);
						}, 16);
					}

					if(currSlideObject.holder.find('.rsPreloader').length) {
						currSlideObject.holder.append( currSlideObject.content );
					} else {
						currSlideObject.holder.html( currSlideObject.content );
					}
					

					currSlideObject.isAppended = true;
					if(currSlideObject.isLoaded) {
						self._resizeImage(currSlideObject);
						triggerLoaded();
					}
					if(!currSlideObject.sizeReady) {
						currSlideObject.sizeReady = true;
						setTimeout(function() {
							// triggers after content is added, usually is true when page is refreshed from cache
							self.ev.trigger('rsMaybeSizeReady', currSlideObject);
						}, 100);
					}
					
				}
			};
			var triggerLoaded = function () {
				if(!currSlideObject.loadedTriggered && self.ev) {
					currSlideObject.isLoaded = currSlideObject.loadedTriggered = true;
					currSlideObject.holder.trigger('rsAfterContentSet');
					self.ev.trigger('rsAfterContentSet', currSlideObject);
				}
			};
			var setPreloader = function () {
				if(self.st.usePreloader)
					currSlideObject.holder.html(self._preloader.clone());
			};
			var removePreloader = function (now) {
				if(self.st.usePreloader) {
					var preloader = currSlideObject.holder.find('.rsPreloader');
					if(preloader.length) {
						preloader.remove();
					}
				}
			};

			if(currSlideObject.isLoaded) {
				appendContent();
				return;
			} else {
				if(beforeTransition) {
					waitForTransition();
				} else {
					parseDataAndLoad();
				}
			}

		},
		_addBlockToContainer: function(slideObject, content, dontFade) {
			var self = this;
			var holder = slideObject.holder;
			var bId = slideObject.id - self._newSlideId;
			var visibleNearby = false;

			self._slidesContainer.append(holder);
			slideObject.appendOnLoaded = false;
		},
	
		_onDragStart:function(e, isThumbs) {
			var self = this,
				point,
				wasAnimating,
				isTouch = (e.type === 'touchstart');


			self._isTouchGesture = isTouch;	

			self.ev.trigger('rsDragStart');
			if($(e.target).closest('.rsNoDrag', self._currHolder).length) {
				self.dragSuccess = false;
				return true;
			}


			if(!isThumbs) {
				if(self._isAnimating) {
					self._wasAnimating = true;

					self._stopAnimation();
				}
			}
			self.dragSuccess = false;
			if(self._isDragging) {
				if(isTouch) {
					self._multipleTouches = true;
				}
				return;
			} else {
				if(isTouch) {
					self._multipleTouches = false;
				}
			}

			self._setGrabbingCursor();
			
			if(isTouch) {
				//parsing touch event
				var touches = e.originalEvent.touches;
				if(touches && touches.length > 0) {
					point = touches[0];
					if(touches.length > 1) {
						self._multipleTouches = true;
					}
				}					
				else {	
					return;						
				}
			} else {
				e.preventDefault();				
				point = e;
				if(self.pointerEnabled) point = point.originalEvent;		
			}

			self._isDragging = true;
			self._doc.on(self._moveEvent, function(e) { self._onDragMove(e, isThumbs); })
						.on(self._upEvent, function(e) { self._onDragRelease(e, isThumbs); });
			
			self._currMoveAxis = '';
			self._hasMoved = false;
			self._pageX = point.pageX;
			self._pageY = point.pageY;
			self._startPagePos = self._accelerationPos = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal) ? point.pageX : point.pageY;
			
			self._horDir = 0;
			self._verDir = 0;

			self._currRenderPosition = !isThumbs ? self._sPosition : self._thumbsPosition;

			self._startTime = new Date().getTime();
			if(isTouch) {
				self._sliderOverflow.on(self._cancelEvent, function(e) { self._onDragRelease(e, isThumbs); });	
			}
		},
		_renderMovement:function(point, isThumbs) {
			var self = this;
			if(self._checkedAxis) {

				var timeStamp = self._renderMoveTime,
					deltaX = point.pageX - self._pageX,
					deltaY = point.pageY - self._pageY,
					newX = self._currRenderPosition + deltaX,
					newY = self._currRenderPosition + deltaY,
					isHorizontal = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal),
					newPos = isHorizontal ? newX : newY,
					mAxis = self._currMoveAxis;

				self._hasMoved = true;
				self._pageX = point.pageX;
				self._pageY = point.pageY;

				if(mAxis === 'x' && deltaX !== 0) {
					self._horDir = deltaX > 0 ? 1 : -1;
				} else if(mAxis === 'y' && deltaY !== 0) {
					self._verDir = deltaY > 0 ? 1 : -1;
				}

				var pointPos = isHorizontal ? self._pageX : self._pageY,
					deltaPos = isHorizontal ? deltaX : deltaY;
				if(!isThumbs) {
					if(!self._loop) {
						if(self.currSlideId <= 0) {
							if(pointPos - self._startPagePos > 0) {
								newPos = self._currRenderPosition + deltaPos * self._lastItemFriction;
							}
						}
						if(self.currSlideId >= self.numSlides - 1) {
							if(pointPos - self._startPagePos < 0) {
								newPos = self._currRenderPosition + deltaPos * self._lastItemFriction ;
							}
						}
					}
				} else {
					if(newPos > self._thumbsMinPosition) {
						newPos = self._currRenderPosition + deltaPos * self._lastItemFriction;
					} else if(newPos < self._thumbsMaxPosition) {
						newPos = self._currRenderPosition + deltaPos * self._lastItemFriction ;
					}
				}

				self._currRenderPosition = newPos;
				
				if (timeStamp - self._startTime > 200) {
					self._startTime = timeStamp;
					self._accelerationPos = pointPos;						
				}

				if(!isThumbs) {
					if(self._isMove) {
						self._setPosition(self._currRenderPosition);
					}
				} else {
					self._setThumbsPosition(self._currRenderPosition);
				}
			}
			
		},
		_onDragMove:function(e, isThumbs) {
			var self = this,
				point,
				isTouch = (e.type === 'touchmove');

			if(self._isTouchGesture && !isTouch) {
				return;
			}

			if(isTouch) {
				if(self._lockAxis) {
					return;
				}	
				var touches = e.originalEvent.touches;
				if(touches) {
					if(touches.length > 1) {
						return;
					} else {
						point = touches[0];	
					}
				} else {
					return;
				}
			} else {
				point = e;
				if(self.pointerEnabled) point = point.originalEvent;	
			}
			

			if(!self._hasMoved) {
				if(self._useCSS3Transitions) {
					(!isThumbs ? self._slidesContainer : self._thumbsContainer).css((self._vendorPref + self._TD), '0s');
				}
				(function animloop(){
					if(self._isDragging) {
						self._animFrame = requestAnimationFrame(animloop);
						if(self._renderMoveEvent)
							self._renderMovement(self._renderMoveEvent, isThumbs);
					}
					
				})();
			}
				
			if(!self._checkedAxis) {
				
				var dir = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal),
					diff = (Math.abs(point.pageX - self._pageX) - Math.abs(point.pageY - self._pageY) ) - (dir ? -7 : 7);

				if(diff > 7) {
					// hor movement
					if(dir) {
						e.preventDefault();
						self._currMoveAxis = 'x';
					} else if(isTouch) {
						self._completeGesture(e);
						return;
					} 
					self._checkedAxis = true;
				} else if(diff < -7) {
					// ver movement
					if(!dir) {
						e.preventDefault();
						self._currMoveAxis = 'y';
					} else if(isTouch) {
						self._completeGesture(e);
						return;
					} 
					self._checkedAxis = true;
				}
				return;
			}
			
			e.preventDefault();	
			self._renderMoveTime = new Date().getTime();
			self._renderMoveEvent = point;
		},
		_completeGesture: function(e, isThumbs) {
			var self = this;
			self._lockAxis = true;
			self._hasMoved = self._isDragging = false;
			self._onDragRelease(e);
		},
		_onDragRelease:function(e, isThumbs) {
			var self = this,
				totalMoveDist,
				accDist,
				duration,
				v0,
				newPos,
				newDist,
				newDuration,
				blockLink,
				isTouch = (e.type.indexOf('touch') > -1);




			if(self._isTouchGesture && !isTouch) {
				return;
			}

			self._isTouchGesture = false;
			self.ev.trigger('rsDragRelease');

			self._renderMoveEvent = null;
			self._isDragging = false;
			self._lockAxis = false;
			self._checkedAxis = false;
			self._renderMoveTime = 0;
			cancelAnimationFrame(self._animFrame);
			if(self._hasMoved) {
				if(!isThumbs) {
					if(self._isMove) {
						self._setPosition(self._currRenderPosition);
					}
				} else {
					self._setThumbsPosition(self._currRenderPosition);
				}
			}


			self._doc.off(self._moveEvent).off(self._upEvent);

			if(isTouch) {
				self._sliderOverflow.off(self._cancelEvent);	
			}

			
			self._setGrabCursor();
			if (!self._hasMoved && !self._multipleTouches) {
				if(isThumbs && self._thumbsEnabled) {
					var item = $(e.target).closest('.rsNavItem');
					if(item.length) {

						self.goTo(item.index());
					}	
					return;
				}
			}
			var orient = (!isThumbs ? self._slidesHorizontal : self._thumbsHorizontal);
			if(!self._hasMoved || (self._currMoveAxis === 'y' && orient) || (self._currMoveAxis === 'x' && !orient) ) {
				if(!isThumbs && self._wasAnimating) {
					self._wasAnimating = false;
					if(!self.st.navigateByClick) {
						self.dragSuccess = true;
					} else {
						self._mouseNext( (self.pointerEnabled ? e.originalEvent : e) );
						self.dragSuccess = true;
						return;
					}
				} else {
					self._wasAnimating = false;
					self.dragSuccess = false;
					return;
				}
				
			} else {
				self.dragSuccess = true;
			}

			self._wasAnimating = false;
			
			
			self._currMoveAxis = '';

			
			function getCorrectSpeed(newSpeed) {
				if(newSpeed < 100) {
					return 100;
				} else if(newSpeed > 500) {
					return 500;
				} 
				return newSpeed;
			}
			function returnToCurrent(isSlow, v0) {
				if(self._isMove || isThumbs) {

					newPos = (-self._realId - self._idOffset) * self._slideSize;
					newDist = Math.abs(self._sPosition  - newPos);
					self._currAnimSpeed = newDist / v0;
					if(isSlow) {
						self._currAnimSpeed += 250; 
					}
					self._currAnimSpeed = getCorrectSpeed(self._currAnimSpeed);

					self._animateTo(newPos, false);
				}
			}

			var snapDist = self.st.minSlideOffset,
				point = isTouch ? e.originalEvent.changedTouches[0] : (self.pointerEnabled ? e.originalEvent : e),
				pPos = orient ? point.pageX : point.pageY,
				sPos = self._startPagePos,
				axPos = self._accelerationPos,
				axCurrItem = self.currSlideId,
				axNumItems = self.numSlides,
				dir = orient ? self._horDir : self._verDir,
				loop = self._loop,
				changeHash = false,
				distOffset = 0;
			
			totalMoveDist = Math.abs(pPos - sPos);
			accDist = pPos - axPos;


			duration = (new Date().getTime()) - self._startTime;
			v0 = Math.abs(accDist) / duration;	

			if(dir === 0 || axNumItems <= 1) {
				returnToCurrent(true, v0);
				return;
			}

			if(!loop && !isThumbs) {
				if(axCurrItem <= 0) {
					if(dir > 0) {
						returnToCurrent(true, v0);
						return;
					}
				} else if(axCurrItem >= axNumItems - 1) {
					if(dir < 0) {
						returnToCurrent(true, v0);
						return;
					}
				}
			}

			if(!isThumbs) {

				var getSwipedSlides = function(dist) {
					var numSwipedSlides = Math.floor(dist / self._slideSize);
		            var nextSlideOffset = dist - (numSwipedSlides * self._slideSize);
		            if (nextSlideOffset > snapDist) {
		                numSwipedSlides++;
		            }
		            return numSwipedSlides;
				};

				if(sPos + snapDist < pPos) {
					if(dir < 0) {		
						returnToCurrent(false, v0);
						return;					
					}
					var swipedSlides = getSwipedSlides(pPos - sPos);
					self._moveTo(self.currSlideId-swipedSlides, getCorrectSpeed(Math.abs(self._sPosition  - (-self._realId - self._idOffset + swipedSlides) * self._slideSize) / v0), changeHash, true, true);
				} else if(sPos - snapDist > pPos) {
					if(dir > 0) {		
						returnToCurrent(false, v0);
						return;					
					}
					
					var swipedSlides = getSwipedSlides(sPos - pPos);
		            self._moveTo(self.currSlideId+swipedSlides, getCorrectSpeed(Math.abs(self._sPosition  - (-self._realId - self._idOffset - swipedSlides) * self._slideSize) / v0), changeHash, true, true);
				
				} else {
					returnToCurrent(false, v0);
				}
			} else {
				newPos = self._thumbsPosition;
				var transitionSpeed;
				
				if(newPos > self._thumbsMinPosition) {
					newPos = self._thumbsMinPosition;
				} else if(newPos < self._thumbsMaxPosition) {
					newPos = self._thumbsMaxPosition;
				} else {
					var friction = 0.003,
						S = (v0 * v0) / (friction * 2),
						minXDist = -self._thumbsPosition,
						maxXDist = self._thumbsContainerSize - self._thumbsViewportSize + self._thumbsPosition;

					if (accDist > 0 && S > minXDist) {
						minXDist = minXDist + self._thumbsViewportSize / (15 / (S / v0 * friction));
						v0 = v0 * minXDist / S;
						S = minXDist;
					} else if (accDist < 0 && S > maxXDist) {
						maxXDist = maxXDist + self._thumbsViewportSize / (15 / (S / v0 * friction));
						v0 = v0 * maxXDist / S;
						S = maxXDist;
					}




					transitionSpeed =  Math.max(Math.round(v0 / friction), 50);
					newPos = newPos + S * (accDist < 0 ? -1 : 1);


					if(newPos > self._thumbsMinPosition) {
						self._animateThumbsTo(newPos, transitionSpeed, true, self._thumbsMinPosition, 200);
						return;
					} else if(newPos < self._thumbsMaxPosition) {
						self._animateThumbsTo( newPos, transitionSpeed, true, self._thumbsMaxPosition, 200);
						return;
					}
				}

				self._animateThumbsTo(newPos, transitionSpeed, true);

			}
		},



		_setPosition: function(pos) {
			var self = this;
			pos = self._sPosition = pos;
			if(self._useCSS3Transitions) {
				self._slidesContainer.css(self._xProp, self._tPref1 + ( self._slidesHorizontal ? (pos + self._tPref2 + 0) : (0 + self._tPref2 + pos) ) + self._tPref3 );		
			} else {
				self._slidesContainer.css(self._slidesHorizontal ? self._xProp : self._yProp, pos);
			}
		},
		
		
		updateSliderSize: function(force) {
			var self = this,
				newWidth,
				newHeight;

			if(!self.slider) {
				return;
			}

			if(self.st.autoScaleSlider) {
				var asw = self.st.autoScaleSliderWidth,
					ash = self.st.autoScaleSliderHeight;

				if(self.st.autoScaleHeight) {
					newWidth = self.slider.width();
					if(newWidth != self.width) {
						self.slider.css("height", newWidth * (ash / asw) );
						newWidth = self.slider.width();
					}	
					newHeight = self.slider.height();
				} else {
					newHeight = self.slider.height();
					if(newHeight != self.height) {
						self.slider.css("width", newHeight * (asw / ash));
						newHeight = self.slider.height();
					}		
					newWidth = self.slider.width();
				}
			
			} else {
				newWidth = self.slider.width();
				newHeight = self.slider.height();
			}
			


			if(force || newWidth != self.width || newHeight != self.height) {
				self.width = newWidth;
				self.height = newHeight;

				self._wrapWidth = newWidth;
				self._wrapHeight = newHeight;

				self.ev.trigger('rsBeforeSizeSet');
				self.ev.trigger('rsAfterSizePropSet');

				self._sliderOverflow.css({
					width: self._wrapWidth,
					height: self._wrapHeight
				});


				self._slideSize = (self._slidesHorizontal ? self._wrapWidth : self._wrapHeight) + self.st.slidesSpacing;
				

				self._imagePadding = self.st.imageScalePadding;
				var item,
					slideItem,
					i,
					img;
				for(i = 0; i < self.slides.length; i++) {
					item = self.slides[i];
					item.positionSet = false;

					if(item && item.images && item.isLoaded) {
						item.isRendered = false;
						self._resizeImage(item);
					} 
				}
				if(self._cloneHolders) {
					for(i = 0; i < self._cloneHolders.length; i++) {
						item = self._cloneHolders[i];
						item.holder.css(self._reorderProp, (item.id + self._idOffset) * self._slideSize);
					}
				}
				
				self._updateBlocksContent();

				if(self._isMove) {
					if(self._useCSS3Transitions) {
						self._slidesContainer.css(self._vendorPref + 'transition-duration', '0s');
					}
					self._setPosition( (-self._realId - self._idOffset) * self._slideSize);
				}
				self.ev.trigger('rsOnUpdateNav');
			}
			self._sliderOffset = self._sliderOverflow.offset();
			self._sliderOffset = self._sliderOffset[self._reorderProp];


		},
		
		/**
		 * Adds slide
		 * @param  {jQuery object or raw HTML} htmltext 
		 * @param  {int} index    (optional) Index where item should be added (last item is removed of not specified)
		 */
		appendSlide: function(htmltext, index) {
			var self = this,
				parsedSlide = self._parseNode(htmltext);

			if(isNaN(index) || index > self.numSlides) {
				index = self.numSlides;
			}
			self.slides.splice(index, 0, parsedSlide);
			self.slidesJQ.splice(index, 0, $('<div style="'+ (self._isMove ? 'position:absolute;' : self._opacityCSS ) +'" class="rsSlide"></div>') );

			if(index <= self.currSlideId) {
				self.currSlideId++;
			}
			self.ev.trigger('rsOnAppendSlide', [parsedSlide, index]);
			
			self._refreshSlides(index);

			if(index === self.currSlideId) {
				self.ev.trigger('rsAfterSlideChange');
			}
		},

		/**
		 * Removes slide
		 * @param  {int} Index of item that should be removed
		 */
		removeSlide: function(index) {
			var self = this,
				slideToRemove = self.slides[index];

			if(slideToRemove) {
				if(slideToRemove.holder) {
					slideToRemove.holder.remove();
				}
				if(index < self.currSlideId) {
					self.currSlideId--;
				}
				self.slides.splice(index, 1);
				self.slidesJQ.splice(index, 1);

				self.ev.trigger('rsOnRemoveSlide', [index]);
				self._refreshSlides(index);

				if(index === self.currSlideId) {
					self.ev.trigger('rsAfterSlideChange');
				}
			}
		},
		_refreshSlides: function(refreshIndex) {

			// todo: optimize this stuff
			var self = this;

			var oldNumSlides = self.numSlides;
			var numLoops = self._realId <= 0 ? 0 : Math.floor(self._realId / oldNumSlides);

			self.numSlides = self.slides.length;
			if(self.numSlides === 0) {
				self.currSlideId = self._idOffset = self._realId = 0;
				self.currSlide = self._oldHolder = null;
			} else {
				self._realId = numLoops * self.numSlides + self.currSlideId;
			}

			for(var i = 0; i < self.numSlides; i++) {
				self.slides[i].id = i;
			}

			self.currSlide = self.slides[self.currSlideId];
			self._currHolder = self.slidesJQ[self.currSlideId];

			if(self.currSlideId >= self.numSlides) {
				self.goTo(self.numSlides - 1);
			} else if(self.currSlideId < 0) {
				self.goTo(0);
			}

			self._refreshNumPreloadImages();

			if(self._isMove/* && self._loop*/) {
				self._slidesContainer.css((self._vendorPref + self._TD), '0ms');
			}
			if(self._refreshSlidesTimeout) {
				clearTimeout(self._refreshSlidesTimeout);
			}


			self._refreshSlidesTimeout = setTimeout(function() {
				if(self._isMove) {
					self._setPosition( (-self._realId - self._idOffset) * self._slideSize);	
				}
				self._updateBlocksContent();
				if(!self._isMove) {
					self._currHolder.css({
						display: 'block',
						opacity: 1
					});
				}
				
			}, 14);
			self.ev.trigger('rsOnUpdateNav');
		},
		_setGrabCursor:function() {	
			var self = this;
			if(self._hasDrag && self._isMove) {
				if(self._grabCursor) {
					self._sliderOverflow.css('cursor', self._grabCursor);
				} else {
					self._sliderOverflow.removeClass('grabbing-cursor');
					self._sliderOverflow.addClass('grab-cursor');	
				}
			}
		},
		_setGrabbingCursor:function() {		
			var self = this;
			if(self._hasDrag && self._isMove) {
				if(self._grabbingCursor) {
					self._sliderOverflow.css('cursor', self._grabbingCursor);
				} else {
					self._sliderOverflow.removeClass('grab-cursor');
					self._sliderOverflow.addClass('grabbing-cursor');	
				}	
			}
		},
		next: function(notUserAction) {
			var self = this;
			self._moveTo('next',  self.st.transitionSpeed, true, !notUserAction);
		},
		prev: function(notUserAction) {
			var self = this;
			self._moveTo('prev', self.st.transitionSpeed, true, !notUserAction);
		},
		_moveTo:function(type,  speed, inOutEasing, userAction, fromSwipe) {
			var self = this,
				newPos,
				difference,
				i,
				newItemId;
			
			
			self.ev.trigger('rsBeforeMove', [type, userAction]);
			if(type === 'next') {
				newItemId = self.currSlideId+1;
			} else if(type === 'prev') {
				newItemId = self.currSlideId-1;
			} else {
				newItemId = type = parseInt(type, 10);
			}

			if(!self._loop) {
				if(newItemId < 0) {
					self._doBackAndForthAnim('left', !userAction);
					return;
				} else if(newItemId >= self.numSlides ) {
					self._doBackAndForthAnim('right', !userAction);
					return;
				}
			}
			
			if(self._isAnimating) {
				self._stopAnimation(true);
				inOutEasing = false;
			}

			difference = newItemId - self.currSlideId;



			self._prevSlideId = self.currSlideId;
			var prevId = self.currSlideId;
			var id = self.currSlideId + difference;
			var realId = self._realId;
			var temp;
			var delayed;
			if(self._loop) {
				id = self._updateBlocksContent(false, id);
				realId += difference;
			} else {
				realId = id;
			}
			self._newSlideId = id;

			self._oldHolder = self.slidesJQ[self.currSlideId];

			
			self._realId = realId;
			self.currSlideId = self._newSlideId;

			self.currSlide = self.slides[self.currSlideId];
			self._currHolder = self.slidesJQ[self.currSlideId];

			
			var checkDist = self.st.slidesDiff;
			var next = Boolean(difference > 0);
			var absDiff = Math.abs(difference);
			var g1 = Math.floor( prevId / self._numPreloadImages);
			var g2 = Math.floor( ( prevId + (next ? checkDist : -checkDist  ) ) / self._numPreloadImages);
			var biggest = next ? Math.max(g1,g2) : Math.min(g1,g2);
			var biggestId = biggest * self._numPreloadImages +  ( next ? (self._numPreloadImages - 1) : 0 );
			if(biggestId > self.numSlides - 1) {
				biggestId = self.numSlides - 1;
			} else if(biggestId < 0) {
				biggestId = 0;
			}
			var toLast =  next ? (biggestId - prevId) :  (prevId - biggestId);
			if(toLast > self._numPreloadImages) {
				toLast = self._numPreloadImages;
			}
			if(absDiff > toLast + checkDist) {
				self._idOffset +=  ( absDiff - (toLast + checkDist) ) * ( next ? -1 : 1 );
				speed = speed * 1.4;
				for(i = 0; i < self.numSlides; i++) {
					self.slides[i].positionSet = false;
				}
			}
			self._currAnimSpeed = speed;

			self._updateBlocksContent(true);
			if(!fromSwipe) {
				delayed = true;
			}


			newPos = (-realId - self._idOffset) * self._slideSize;

			

			if(delayed) {
				setTimeout(function() {
					self._isWorking = false;
					self._animateTo(newPos, type, false, inOutEasing);
					self.ev.trigger('rsOnUpdateNav');
				}, 0);
			} else {
				self._animateTo(newPos, type, false, inOutEasing);
				self.ev.trigger('rsOnUpdateNav');
			}
			
			
			function isSetToCurrent(testId) {
				if(testId < 0) {
					testId = self.numSlides + testId;
				} else if(testId > self.numSlides - 1) {
					testId = testId - self.numSlides;
				}
				if(testId !== self.currSlideId) {
					return false;
				}
				return true;
			}
			
		},
		_updateArrowsNav: function() {
			var self = this,
				arrDisClass = 'rsArrowDisabled';
			if(self.st.arrowsNav) {
				if(self.numSlides <= 1) {
					self._arrowLeft.css('display', 'none');
					self._arrowRight.css('display', 'none');
					return;
				} else {
					self._arrowLeft.css('display', 'block');
					self._arrowRight.css('display', 'block');
				}
				if(!self._loop && !self.st.loopRewind) {
					if(self.currSlideId === 0) {
						self._arrowLeft.addClass(arrDisClass);
					} else {
						self._arrowLeft.removeClass(arrDisClass);
					}
					if(self.currSlideId === self.numSlides - 1) {
						self._arrowRight.addClass(arrDisClass);
					} else {
						self._arrowRight.removeClass(arrDisClass);
					}
				}
			}
		},
		_animateTo:function(pos, dir,  loadAll, inOutEasing, customComplete) {
			var self = this,
				moveProp,
				oldBlock,
				animBlock;

			var animObj = {};
			if(isNaN(self._currAnimSpeed)) {
				self._currAnimSpeed = 400;
			} 
			


			self._sPosition = self._currRenderPosition = pos;

			self.ev.trigger('rsBeforeAnimStart');

			if(!self._useCSS3Transitions) {
				if(self._isMove) {
					animObj[self._slidesHorizontal ? self._xProp : self._yProp] = pos + 'px';


					self._slidesContainer.animate(animObj, self._currAnimSpeed, /*'easeOutQuart'*/ inOutEasing ? self.st.easeInOut : self.st.easeOut);
				} else {
					oldBlock = self._oldHolder;
					animBlock = self._currHolder;					

					animBlock.stop(true, true).css({
						opacity: 0,
						display: 'block',
						zIndex: self._fadeZIndex
					});
					self._currAnimSpeed = self.st.transitionSpeed;
					animBlock.animate({opacity: 1}, self._currAnimSpeed, self.st.easeInOut);

					
					clearTimeouts();
					if(oldBlock) {
						oldBlock.data('rsTimeout', setTimeout(function() {
							oldBlock.stop(true, true).css({
								opacity: 0,
								display: 'none',
								zIndex: 0
							});
						}, self._currAnimSpeed + 60) );
					}
				}
				
			} else {
				if(self._isMove) {
					
					

						self._currAnimSpeed = parseInt(self._currAnimSpeed, 10);
						var td = self._vendorPref + self._TD;
						var ttf = self._vendorPref + self._TTF;

						animObj[td] = self._currAnimSpeed+'ms';
						animObj[ttf] = inOutEasing ? $.rsCSS3Easing[self.st.easeInOut] : $.rsCSS3Easing[self.st.easeOut];
						
						self._slidesContainer.css(animObj);
					if(inOutEasing || !self.hasTouch) {
						setTimeout(function() {
							self._setPosition(pos);
						}, 5);
					} else {
						self._setPosition(pos);
					} 
					
					

				} else {
					//self._currAnimSpeed = 10
					self._currAnimSpeed = self.st.transitionSpeed;
					oldBlock = self._oldHolder;
					animBlock = self._currHolder;		
					if(animBlock.data('rsTimeout')) {
						animBlock.css('opacity', 0);
					}
					clearTimeouts();
					if(oldBlock) {
						//if(oldBlock)
						oldBlock.data('rsTimeout', setTimeout(function() {
							animObj[self._vendorPref + self._TD] = '0ms';
							animObj.zIndex = 0;
							animObj.display = 'none';
							oldBlock.data('rsTimeout', '');
							oldBlock.css(animObj);
							setTimeout(function() {
								oldBlock.css('opacity', 0);
							}, 16);
						}, self._currAnimSpeed + 60) );
					}

					animObj.display = 'block';
					animObj.zIndex = self._fadeZIndex;
					animObj.opacity = 0;
					animObj[self._vendorPref + self._TD] = '0ms';
					animObj[self._vendorPref + self._TTF] = $.rsCSS3Easing[self.st.easeInOut];
					animBlock.css(animObj);
					animBlock.data('rsTimeout', setTimeout(function() {
						//animBlock.css('opacity', 0);
						animBlock.css(self._vendorPref + self._TD,  self._currAnimSpeed+'ms');

						//oldBlock.css(self._vendorPref + self._TD,  '0ms');
						animBlock.data('rsTimeout', setTimeout(function() {
							animBlock.css('opacity', 1);
							animBlock.data('rsTimeout', '');
						}, 20) );
					}, 20) );
				}
			}
			self._isAnimating = true;
			if(self.loadingTimeout) {
				clearTimeout(self.loadingTimeout);
			}
			if(customComplete) {
				self.loadingTimeout = setTimeout(function() {
					self.loadingTimeout = null;
					customComplete.call();

				}, self._currAnimSpeed + 60);
			} else {
				self.loadingTimeout = setTimeout(function() {
					self.loadingTimeout = null;
					self._animationComplete(dir);
				}, self._currAnimSpeed + 60);
			}

			function clearTimeouts() {
				var t;
				if(oldBlock) {
					t = oldBlock.data('rsTimeout');
					if(t) {
						if(oldBlock !== animBlock) {
							oldBlock.css({
									opacity: 0,
									display: 'none',
									zIndex: 0
								});
						}
						clearTimeout(t);
						oldBlock.data('rsTimeout', '');
					}
				}
				
				t = animBlock.data('rsTimeout');
				if(t) {
					clearTimeout(t);
					animBlock.data('rsTimeout', '');
				}
			}
		},
		_stopAnimation: function(noCSS3) {
			var self = this;
			self._isAnimating = false;
			clearTimeout(self.loadingTimeout);
			if(self._isMove) {

				if(!self._useCSS3Transitions) {
					self._slidesContainer.stop(true);
					self._sPosition = parseInt(self._slidesContainer.css(self._xProp), 10);
				} else if (!noCSS3) {
					var oldPos = self._sPosition;
					var newPos =  self._currRenderPosition = self._getTransformProp();
					self._slidesContainer.css((self._vendorPref + self._TD), '0ms');
					if(oldPos !==newPos) {
						self._setPosition(newPos);
					}
				}
			} else {
				// kung fu
				if(self._fadeZIndex > 20) {
					self._fadeZIndex = 10;
				} else {
					self._fadeZIndex++;
				}
			}
			
			
		},
		// Thanks to @benpbarnett
		_getTransformProp:function(){
			var self = this,
				transform = window.getComputedStyle(self._slidesContainer.get(0), null).getPropertyValue(self._vendorPref + 'transform'),			
				explodedMatrix = transform.replace(/^matrix\(/i, '').split(/, |\)$/g),
				isMatrix3d = (explodedMatrix[0].indexOf('matrix3d') === 0);
			return parseInt(explodedMatrix[(self._slidesHorizontal ? (isMatrix3d ? 12 : 4) : (isMatrix3d ? 13 : 5) )], 10);
		},
		_getCSS3Prop: function(pos, hor) {
			var self = this;
			return self._useCSS3Transitions ? self._tPref1 + ( hor ? (pos + self._tPref2 + 0) : (0 + self._tPref2 + pos) ) + self._tPref3 : pos;
		},
		_animationComplete: function(dir) {
			var self = this;
			if(!self._isMove) {
				self._currHolder.css('z-index', 0);
				self._fadeZIndex = 10;
			}
			self._isAnimating = false;
			
			self.staticSlideId = self.currSlideId;
			self._updateBlocksContent();


			self._slidesMoved = false;
			
			self.ev.trigger('rsAfterSlideChange');
		},
		_doBackAndForthAnim:function(type, userAction) {
			var self = this,
				newPos = (-self._realId - self._idOffset) * self._slideSize;

			if(self.numSlides === 0 || self._isAnimating) {
				return;
			} 
			if(self.st.loopRewind) {
				self.goTo(type === 'left' ? self.numSlides - 1 : 0, userAction);
				return;
			}

			if(self._isMove) {
				self._currAnimSpeed = 200;

				var allAnimComplete = function () {
					self._isAnimating = false;
				};
				var firstAnimComplete = function () {
					self._isAnimating = false;
					self._animateTo(newPos, '', false, true, allAnimComplete);
				};
				self._animateTo(newPos + (type === 'left' ? 30 : -30),'', false, true, firstAnimComplete);
			}
			
		},
		_resizeImage:function(slideObject, useClone) {

			var isRoot = true;
			if(slideObject.isRendered) {
				return;
			}
			var img = slideObject.content;
			var classToFind = 'rsMainSlideImage';
			var isVideo;
			var self = this,
				imgAlignCenter = self.st.imageAlignCenter,
				imgScaleMode = self.st.imageScaleMode,
				tempEl,
				bMargin;

			if(slideObject.videoURL) {
				classToFind = 'rsVideoContainer';
				if(imgScaleMode !== 'fill') {
					isVideo = true;
				} else {
					tempEl = img;
					if(!tempEl.hasClass(classToFind)) {
						tempEl = tempEl.find('.'+classToFind);
					}
					tempEl.css({width:'100%',height: '100%'});
					classToFind = 'rsMainSlideImage';
				}
			}
			if(!img.hasClass(classToFind)) {
				isRoot = false;
				img = img.find('.'+classToFind);
			}
			if(!img) {
				return;
			}

			var baseImageWidth = slideObject.iW,
				baseImageHeight = slideObject.iH;

			slideObject.isRendered = true;
			if(imgScaleMode === 'none' && !imgAlignCenter) {
				return;
			}
			if(imgScaleMode !== 'fill') {
				bMargin = self._imagePadding;
			} else {
				bMargin = 0;
			}
			//var block = img.parent('.block-inside').css('margin', bMargin);
			var containerWidth = self._wrapWidth - bMargin * 2,
				containerHeight = self._wrapHeight - bMargin * 2,
				hRatio,
				vRatio,
				ratio,
				nWidth,
				nHeight,
				cssObj = {};

			if(imgScaleMode === 'fit-if-smaller') {
				if(baseImageWidth > containerWidth || baseImageHeight > containerHeight) {
					imgScaleMode = 'fit';
				}
			}
			if(imgScaleMode === 'fill' || imgScaleMode === 'fit') {		
				hRatio = containerWidth / baseImageWidth;
				vRatio = containerHeight / baseImageHeight;

				if (imgScaleMode  == "fill") {
					ratio = hRatio > vRatio ? hRatio : vRatio;
				} else if (imgScaleMode  == "fit") {
					ratio = hRatio < vRatio ? hRatio : vRatio;
				} else {
					ratio = 1;
				}

				nWidth = Math.ceil(baseImageWidth * ratio, 10);
				nHeight = Math.ceil(baseImageHeight * ratio, 10);
			} else {								
				nWidth = baseImageWidth;
				nHeight = baseImageHeight;		
			}
			if(imgScaleMode !== 'none') {
				cssObj.width = nWidth;
				cssObj.height = nHeight;
				if(isVideo) {
					img.find('.rsImg').css({width: '100%', height:'100%'});
				}
			}
			if (imgAlignCenter) {     
				cssObj.marginLeft = Math.floor((containerWidth - nWidth) / 2) +  bMargin;
				cssObj.marginTop = Math.floor((containerHeight - nHeight) / 2) +  bMargin;
			}
			img.css(cssObj);
		}
	}; /* RoyalSlider core prototype end */
	$.rsProto = RoyalSlider.prototype;

	$.fn.royalSlider = function(options) {
		var args = arguments;
		return this.each(function(){
			var self = $(this);
			if (typeof options === "object" ||  !options) {
				if( !self.data('royalSlider') ) {
					self.data('royalSlider', new RoyalSlider(self, options));
				}
			} else {
				var royalSlider = self.data('royalSlider');
				if (royalSlider && royalSlider[options]) {
					return royalSlider[options].apply(royalSlider, Array.prototype.slice.call(args, 1));
				}
			}
		});
	};

	$.fn.royalSlider.defaults = {    
		slidesSpacing: 8,
		startSlideId: 0,
		loop: false,
		loopRewind: false,
		numImagesToPreload: 4,
		fadeinLoadedSlide: true,
		slidesOrientation: 'horizontal',
		transitionType: 'move', 
		transitionSpeed: 600,
		controlNavigation: 'bullets',
		controlsInside: true, 
		arrowsNav: true,
		arrowsNavAutoHide: true,
		navigateByClick: true,
		randomizeSlides: false,
		sliderDrag: true, 
		sliderTouch: true,
		keyboardNavEnabled: false,
		fadeInAfterLoaded: true,

		allowCSS3: true,
		allowCSS3OnWebkit: true,

		
		addActiveClass: false,
		autoHeight: false,

		easeOut: 'easeOutSine',
		easeInOut: 'easeInOutSine',

		minSlideOffset: 10,

		imageScaleMode:"fit-if-smaller",
		imageAlignCenter:true,
		imageScalePadding: 4,
		usePreloader: true,

		autoScaleSlider: false,

		autoScaleSliderWidth: 800,
		autoScaleSliderHeight: 400,

		autoScaleHeight: true,

		arrowsNavHideOnTouch: false,
		globalCaption: false,

		slidesDiff: 2
	}; /* default options end */

	$.rsCSS3Easing = {
		easeOutSine: 'cubic-bezier(0.390, 0.575, 0.565, 1.000)',
		easeInOutSine: 'cubic-bezier(0.445, 0.050, 0.550, 0.950)'
	};

	$.extend(jQuery.easing, {
		easeInOutSine: function (x, t, b, c, d) {
			return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
		},
		easeOutSine: function (x, t, b, c, d) {
			return c * Math.sin(t/d * (Math.PI/2)) + b;
		},
		easeOutCubic: function (x, t, b, c, d) {
			return c*((t=t/d-1)*t*t + 1) + b;
		}
	});


})(jQuery, window);