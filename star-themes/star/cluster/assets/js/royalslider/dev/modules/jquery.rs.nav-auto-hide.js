(function($) {

	"use strict";
	
	/**
	 *
	 * RoyalSlider auto hide nav module
	 * @version 1.0:
	 * 
	 */ 
	$.extend($.rsProto, {
		_initAutoHideControlNav: function() {
			var self = this;
			if(self.st.navAutoHide && !self.hasTouch) {
				self.ev.one('rsAfterInit', function() {
					if(self._controlNav) {
						self._controlNav.addClass('rsHidden');

						var hoverEl = self.slider;
						hoverEl.one("mousemove.controlnav",function() {
							self._controlNav.removeClass('rsHidden');
						});

						hoverEl.hover(
							function() {
								self._controlNav.removeClass('rsHidden');
							},
							function() {
								self._controlNav.addClass('rsHidden');
							}
						);
					}
					
				});
			}
		}
	});
	$.rsModules.autoHideNav = $.rsProto._initAutoHideControlNav;
})(jQuery);
