(function($) {

	"use strict";

	/**
	 *
	 * RoyalSlider active class module 
	 * @version 1.0.1:
	 *
	 * 1.0.1
	 * - Simplified code
	 * - Fixed bug when slide with activeClass is removed
	 */ 
	$.rsProto._initActiveClass = function() {
		var updClassTimeout,
			self = this,
			aSlideClass = 'rsActiveSlide';
		if(self.st.addActiveClass) {

			self.ev.on('rsOnUpdateNav', function() {

				if(updClassTimeout) clearTimeout(updClassTimeout);
				updClassTimeout = setTimeout(function() {
					if(self._oldHolder) self._oldHolder.removeClass(aSlideClass);
					if(self._currHolder) self._currHolder.addClass(aSlideClass);
					updClassTimeout = null;
				}, 50);
			});

		}
	};
	$.rsModules.activeClass = $.rsProto._initActiveClass;
})(jQuery);
