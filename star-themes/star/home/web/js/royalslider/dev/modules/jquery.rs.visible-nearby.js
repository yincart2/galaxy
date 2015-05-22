(function($) {

	"use strict";

	/**
	 *
	 * RoyalSlider module that makes nearby slides visible
	 * @version 1.0.2:
	 *
	 * 1.0.1
	 * - Added navigateByCenterClick, breakpoint options
	 *
	 * 1.0.2
	 * - Added hiddenOverflow option
	 *
	 */ 
	$.rsProto._initVisibleNearby = function() {
		var self = this;
		if(self.st.visibleNearby && self.st.visibleNearby.enabled) {
			self._vnDefaults = {
				enabled: true,
				centerArea: 0.6, // Area of center image. By default 60% will get center image, 20% for each image on side

				center: true,

				breakpoint: 0, // this option will be trigger change of centerArea parameter
				breakpointCenterArea: 0.8,

				hiddenOverflow: true,
				navigateByCenterClick: false
			};
			self.st.visibleNearby = $.extend({}, self._vnDefaults, self.st.visibleNearby);

			self.ev.one('rsAfterPropsSetup', function() {
				self._sliderVisibleNearbyWrap = self._sliderOverflow.css('overflow', 'visible').wrap('<div class="rsVisibleNearbyWrap"></div>').parent();
				if(!self.st.visibleNearby.hiddenOverflow) {
					self._sliderVisibleNearbyWrap.css('overflow', 'visible');
				}
				self._controlsContainer = self.st.controlsInside ? self._sliderVisibleNearbyWrap : self.slider;
			});

			self.ev.on('rsAfterSizePropSet', function() {
				var centerRatio,
					o = self.st.visibleNearby;

				if(o.breakpoint && self.width < o.breakpoint) {
					centerRatio = o.breakpointCenterArea;
				} else {
					centerRatio = o.centerArea;
				}
				if(self._slidesHorizontal) {
					self._wrapWidth = self._wrapWidth * centerRatio;
					self._sliderVisibleNearbyWrap.css({
						height: self._wrapHeight,
						width: self._wrapWidth / centerRatio
					});
					self._minPosOffset = self._wrapWidth * (1 - centerRatio) / 2 / centerRatio;
				} else {
					self._wrapHeight = self._wrapHeight * centerRatio;
					self._sliderVisibleNearbyWrap.css({
						height: self._wrapHeight / centerRatio,
						width: self._wrapWidth
					});
					self._minPosOffset = self._wrapHeight * (1 - centerRatio) / 2 / centerRatio;
				}
				if(!o.navigateByCenterClick) {
					self._nextSlidePos = self._slidesHorizontal ? self._wrapWidth : self._wrapHeight;
				}
				if(o.center) {
					self._sliderOverflow.css('margin-' + (self._slidesHorizontal ? 'left' : 'top' ), self._minPosOffset);
				}
			});

		}
	};
	$.rsModules.visibleNearby = $.rsProto._initVisibleNearby;
})(jQuery);
