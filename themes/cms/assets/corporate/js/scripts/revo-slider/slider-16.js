$(document).ready(function() {
    var slider = $('.c-layout-revo-slider .tp-banner');

    var cont = $('.c-layout-revo-slider .tp-banner-container');

    var api = slider.show().revolution({
        sliderType:"standard",
        sliderLayout:"fullwidth",
        dottedOverlay:"none",
        delay:15000,
        navigation: {
            keyboardNavigation:"off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation:"off",
            onHoverStop:"off",
            touch:{
                touchenabled:"on",
                swipe_threshold: 75,
                swipe_min_touches: 1,
                swipe_direction: "horizontal",
                drag_block_vertical: false
            }
            ,
            arrows: {
                style:"dione",
                enable:false,
                hide_onmobile:true,
                hide_under:600,
                hide_onleave:true,
                hide_delay:200,
                hide_delay_mobile:1200,
                tmp: '<div class="tp-arr-imgwrapper"><div class="tp-arr-imgholder"></div></div>',
                left: {
                    h_align:"left",
                    v_align:"center",
                    h_offset:0,
                    v_offset:0
                },
                right: {
                    h_align:"right",
                    v_align:"center",
                    h_offset:0,
                    v_offset:0
                }
            }
            ,
            bullets: {
                enable:false,
            }
        },
        viewPort: {
            enable:true,
            outof:"pause",
            visible_area:"80%"
        },
        responsiveLevels:[1240,1024,778,480],
        gridwidth:[1240,1024,778,480],
        gridheight:[600,600,500,300],
        lazyType:"none",
        parallax: {
            type:"mouse",
            origo:"slidercenter",
            speed:2000,
            levels:[0,2,3,4,5,6,7,12,16,10,50],
        },
        shadow:0,
        spinner:"spinner2",
        stopLoop:"off",
        stopAfterLoops:-1,
        stopAtSlide:-1,
        shuffle:"off",
        autoHeight:"off",
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