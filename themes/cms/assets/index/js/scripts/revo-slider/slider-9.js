$(document).ready(function() {
    var slider = $('.c-layout-revo-slider .tp-banner');

    var cont = $('.c-layout-revo-slider .tp-banner-container');

    var api = slider.show().revolution({
        sliderType:"standard",
        sliderLayout:"fullscreen",
        responsiveLevels:[2048,1024,778,320],
        gridwidth: [1240, 1024, 778, 320],
        gridheight: [868, 768, 960, 720],
        delay: 15000,    
        startwidth:1170,
        startheight: App.getViewPort().height,

        navigationType: "hide",
        navigationArrows: "solo",

        touchenabled: "on",

        navigation: {
            keyboardNavigation:"off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation:"off",
            onHoverStop:"on",
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
                h_align:"right",
                v_align:"bottom",
                space:5,
                h_offset:60,
                v_offset:60,

            },
        },

        spinner: "spinner2",

        fullScreenOffsetContainer: '.c-layout-header',

        shadow: 0,

        hideTimerBar:"on",

        hideThumbsOnMobile: "on",
        hideNavDelayOnMobile: 1500,
        hideBulletsOnMobile: "on",
        hideArrowsOnMobile: "on",
        hideThumbsUnderResolution: 0
    });
}); //ready