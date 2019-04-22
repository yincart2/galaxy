$(document).ready(function() {
	var slider = $('.c-layout-revo-slider .tp-banner');

	var cont = $('.c-layout-revo-slider .tp-banner-container');

	var api = slider.show().revolution({
		sliderType:"standard",
		sliderLayout:"fullscreen",
		dottedOverlay:"none",
		delay:15000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			onHoverStop:"off",
			arrows: {
				style:"circle",
				enable:true,
				hide_onmobile:false,
				hide_onleave:false,
				tmp:'',
				left: {
					h_align:"left",
					v_align:"center",
					h_offset:30,
					v_offset:0
				},
				right: {
					h_align:"right",
					v_align:"center",
					h_offset:30,
					v_offset:0
				}
			}			
		},
		responsiveLevels:[2048,1024,778,480],
		gridwidth: [1240, 1024, 778, 480],
		gridheight: [868, 768, 960, 720],
		lazyType:"none",
		shadow:0,
		spinner:"spinner2",
		stopLoop:"on",
		stopAfterLoops:0,
		stopAtSlide:1,
		shuffle:"off",
		autoHeight:"off",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}); //ready