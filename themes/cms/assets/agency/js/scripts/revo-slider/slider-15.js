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
            mouseScrollNavigation:"off",
            onHoverStop:"off",
            touch:{
                touchenabled:"off",
                drag_block_vertical: false
            }
            ,
            arrows: {
                enable:false,
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
        gridheight:[800,800,500,400],
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