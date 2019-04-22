$(document).ready(function() {
    var api;
    var slider = $('.c-layout-revo-slider .tp-banner');
    var cont = $('.c-layout-revo-slider .tp-banner-container');    
    var onepageMode = $('.c-mega-menu-onepage-dots').size() > 0 ? true : false;

    if (onepageMode) {
        api = slider.show().revolution({
            sliderType:"standard",
            sliderLayout:"fullscreen",
            responsiveLevels:[2048,1024,778,480],
            gridwidth: [1170, 1024, 778, 480],
            gridheight: [868, 768, 960, 720],
            delay: 15000,    
            startwidth:1170,
            startheight: 1000,

            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                onHoverStop:"off",
                bullets: {
                    style:"round",
                    enable:true,
                    hide_onmobile:false,
                    hide_onleave:true,
                    hide_delay:200,
                    hide_delay_mobile:1200,
                    hide_under:0,
                    hide_over:9999,
                    direction:"horizontal",
                    h_align:"center",
                    v_align:"bottom",
                    space:5,
                    v_offset:60,

                },
                touch: {
                    touchenabled: 'off',
                }   
            },

            spinner: "spinner2",

            shadow: 0,
            fullWidth: "off",
            forceFullWidth: "off",

            hideThumbsOnMobile: "on",
            hideNavDelayOnMobile: 1500,
            hideBulletsOnMobile: "on",
            hideArrowsOnMobile: "on",
            hideThumbsUnderResolution: 0
        });
    } else {
        api = slider.show().revolution({
            sliderType:"standard",
            sliderLayout:"fullscreen",
            responsiveLevels:[2048,1024,778,480],
            gridwidth: [1170, 1024, 778, 480],
            gridheight: [868, 768, 960, 720],
            delay: 15000,    
            startwidth:1170,
            startheight: App.getViewPort().height,

            navigation: {
                keyboardNavigation:"off",
                keyboard_direction: "horizontal",
                mouseScrollNavigation:"off",
                onHoverStop:"on",
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
                },
                touch: {
                    touchenabled: 'on',
                    swipe_threshold: 75,
                    swipe_min_touches: 1,
                    swipe_direction: 'horizontal',
                    drag_block_vertical: true
                }      
            },

            spinner: "spinner2",

            shadow: 0,
            fullWidth: "off",
            forceFullWidth: "off",

            hideThumbsOnMobile: "on",
            hideNavDelayOnMobile: 1500,
            hideBulletsOnMobile: "on",
            hideArrowsOnMobile: "on",
            hideThumbsUnderResolution: 0
        });
    }
}); //ready