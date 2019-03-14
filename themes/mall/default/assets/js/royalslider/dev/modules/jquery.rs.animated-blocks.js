(function($) {

	"use strict";

	/**
	 *
	 * RoyalSlider animated blocks module
	 * @version 1.0.7:
	 *
	 * 1.0.2:
	 * - Fixed mistake from prev fix :/
	 * 
	 * 1.0.3:
	 * - Fixed animated block appearing in Firefox
	 *
	 * 1.0.4
	 * - Fixed bug that could cause incorrect block when randomizeSlides is enabled
	 *
	 * 1.0.5
	 * - moveEffect:none' bug
	 *
	 * 1.0.6
	 * - Fixed issue that could cause incorrect position of blocks in IE
	 *
	 * 1.0.7
	 * - Move offset fix
	 */ 
	$.extend($.rsProto, {
		_initAnimatedBlocks: function() {
			var self = this,
				i;

			self._blockDefaults = {
				fadeEffect: true,
				moveEffect: 'top', 
				moveOffset:20,               
				speed:400,               
				easing:'easeOutSine',      
				delay:200                 
			};
			self.st.block = $.extend({}, self._blockDefaults, self.st.block);

			self._blockAnimProps = [];
			self._animatedBlockTimeouts = [];

			self.ev.on('rsAfterInit', function() {
				runBlocks();
			});

			self.ev.on('rsBeforeParseNode', function(e, content, obj) {
				content = $(content);

				obj.animBlocks = content.find('.rsABlock').css('display', 'none');
				if(!obj.animBlocks.length) {
					if(content.hasClass('rsABlock')) {
						obj.animBlocks = content.css('display', 'none');
					} else {
						obj.animBlocks = false;
					}
				}
			});
			self.ev.on('rsAfterContentSet', function(e, slideObject) {
				var currId = self.slides[self.currSlideId].id; 
				if(slideObject.id === currId) {
					setTimeout(function() {
						runBlocks();
					}, self.st.fadeinLoadedSlide ? 300 : 0);
				}
			});
		
			self.ev.on('rsAfterSlideChange', function() {
				runBlocks();
			});
			function runBlocks() {
				var slide = self.currSlide;
				if(!self.currSlide || !self.currSlide.isLoaded) {
					return;
				}

				// clear previous animations
				if(self._slideWithBlocks !== slide) {
					if(self._animatedBlockTimeouts.length > 0) {
						for(i = 0; i < self._animatedBlockTimeouts.length; i++) { 
							clearTimeout(self._animatedBlockTimeouts[i]);
						}
						self._animatedBlockTimeouts = [];
					}
					
					if(self._blockAnimProps.length > 0) {						
						var cItemTemp;
						for(i = 0; i < self._blockAnimProps.length; i++) {  
							cItemTemp = self._blockAnimProps[i];							
							if(cItemTemp) {								
								if(!self._useCSS3Transitions) {
									cItemTemp.block.stop(true).css(cItemTemp.css);
								} else {
									cItemTemp.block.css(self._vendorPref + self._TD, '0s');
									cItemTemp.block.css(cItemTemp.css);
								}
								self._slideWithBlocks = null;
								slide.animBlocksDisplayed = false;
							}
						}
						self._blockAnimProps = [];
					}
					if(slide.animBlocks) {
						slide.animBlocksDisplayed = true;
						self._slideWithBlocks = slide;
						self._animateBlocks(slide.animBlocks);
					}
				}
			}
		},
		_updateAnimBlockProps: function(obj, props) {
			setTimeout(function() {
				obj.css(props);
			}, 6);
		},
		_animateBlocks: function(animBlocks) {
			var self = this,
				item,
				animObj,
				newPropObj,
				transitionData;

			var currItem,
				fadeEnabled,
				moveEnabled,				
				effectName,	
				effectsObject,
				moveEffectProperty,
				currEffects,
				newEffectObj,	
				moveOffset,
				delay,
				speed,
				easing,
				moveProp,
				i,
				moveEffect,
				isOppositeProp;

			self._animatedBlockTimeouts = [];

			animBlocks.each(function(index) {

				item = $(this);
				

				animObj = {};
				newPropObj = {};
				transitionData = null;

					var moveOffset = item.attr('data-move-offset');
					if(!moveOffset) {
						moveOffset = self.st.block.moveOffset;
					} else {
						moveOffset = parseInt(moveOffset, 10);
					}

					if(moveOffset > 0) {
						moveEffect = item.data('move-effect');
						if(moveEffect) {
							moveEffect = moveEffect.toLowerCase();
							if(moveEffect === 'none') {
								moveEffect = false;
							} else if(moveEffect !== 'left' && moveEffect !== 'top' && moveEffect !== 'bottom' && moveEffect !== 'right') {
								moveEffect = self.st.block.moveEffect;
								if(moveEffect === 'none') {
									moveEffect = false;
								}
							}
						} else {
							moveEffect = self.st.block.moveEffect;
						}
						if(moveEffect && moveEffect !== 'none') {
							var moveHorizontal;
							if(moveEffect === 'right' || moveEffect === 'left') {
								moveHorizontal = true;
							} else {
								moveHorizontal = false;
							}
							var currPos,
								startPos;
							
							isOppositeProp = false;
							
							if(self._useCSS3Transitions) {
								currPos = 0;
								moveProp = self._xProp;
							} else {
								if(moveHorizontal) {
									if( !isNaN( parseInt(item.css('right'), 10) ) ) {
										moveProp = 'right';
										isOppositeProp = true;
									} else {
										moveProp = 'left';
									}
								} else {

									if( !isNaN( parseInt(item.css('bottom'), 10) ) ) {
										moveProp = 'bottom';
										isOppositeProp = true;
									} else {
										moveProp = 'top';
									}
								}
								moveProp = 'margin-'+moveProp;
								if(isOppositeProp) {
									moveOffset = -moveOffset;
								}

								if(!self._useCSS3Transitions) {
									currPos = item.data('rs-start-move-prop');

									if( currPos === undefined ) {
										currPos = parseInt(item.css(moveProp), 10); 

										if(isNaN(currPos)) currPos = 0;

										item.data('rs-start-move-prop', currPos);
									}
								} else {
									currPos = parseInt(item.css(moveProp), 10); 
								}
								
								
							}

							if(moveEffect === 'top' || moveEffect === 'left') {
								startPos = currPos - moveOffset;
							} else {
								startPos = currPos + moveOffset;
							}
							
							newPropObj[moveProp] = self._getCSS3Prop(startPos, moveHorizontal);
							animObj[moveProp] = self._getCSS3Prop(currPos, moveHorizontal);
							
						}
					}
					

					var fadeEffect = item.attr('data-fade-effect');
					if(!fadeEffect) {
						fadeEffect = self.st.block.fadeEffect;
					} else if(fadeEffect.toLowerCase() === 'none' || fadeEffect.toLowerCase() === 'false') {
						fadeEffect = false;
					}
					if(fadeEffect) {
						newPropObj.opacity = 0;
						animObj.opacity = 1;
					}

					if(fadeEffect || moveEffect) {
						transitionData = {};
						transitionData.hasFade = Boolean(fadeEffect);
						if(Boolean(moveEffect)) {
							transitionData.moveProp = moveProp;
							transitionData.hasMove = true;
						}

						transitionData.speed = item.data('speed');
						if(isNaN(transitionData.speed)) {
							transitionData.speed = self.st.block.speed;
						}
						transitionData.easing = item.data('easing');
						if(!transitionData.easing) {
							transitionData.easing = self.st.block.easing;
						}
						transitionData.css3Easing = $.rsCSS3Easing[transitionData.easing];

						transitionData.delay =  item.data('delay');
						if(isNaN(transitionData.delay)) {
							transitionData.delay = self.st.block.delay * index;
						}

					}

					var blockPropsObj = {};
					if(self._useCSS3Transitions) {
						blockPropsObj[(self._vendorPref + self._TD)] =  '0ms';
					}
					blockPropsObj.moveProp = animObj.moveProp;
					blockPropsObj.opacity = animObj.opacity;
					blockPropsObj.display = 'none';


					self._blockAnimProps.push({block:item, css:blockPropsObj});

					self._updateAnimBlockProps(item, newPropObj);


					// animate caption
					self._animatedBlockTimeouts.push(setTimeout((function (cItem, animateData, transitionData, index) {	
						return function() {	
							cItem.css('display', 'block');
							if(transitionData) {
								var animObj = {};
								if(!self._useCSS3Transitions) {
									setTimeout(function() {
										cItem.animate(animateData, transitionData.speed, transitionData.easing);
									}, 16);
								} else {
									var prop = '';
									if(transitionData.hasMove) {
										prop += transitionData.moveProp;
									} 
									if(transitionData.hasFade) {
										if(transitionData.hasMove) {
											prop += ', ';
										}
										prop += 'opacity';
									}
									animObj[(self._vendorPref + self._TP)] = prop;
									animObj[(self._vendorPref + self._TD)] =  transitionData.speed + 'ms';
									animObj[(self._vendorPref + self._TTF)] = transitionData.css3Easing;
									cItem.css(animObj);
									setTimeout(function() {
										cItem.css(animateData);
									}, 24);
								}
							}
					
							delete self._animatedBlockTimeouts[index];
						};
					})(item, animObj, transitionData, index), transitionData.delay <= 6 ? 12 : transitionData.delay));				
				//}	



			});
		}
	});
	$.rsModules.animatedBlocks = $.rsProto._initAnimatedBlocks;
})(jQuery);
