$(document).ready(function() {
    
    var slider = $('.c-layout-revo-slider .tp-banner');

    var cont = $('.c-layout-revo-slider .tp-banner-container');

    var api = slider.show().revolution({
        sliderType:"standard",
        sliderLayout:"fullwidth",
       // responsiveLevels:[4096,1024,778,480],
      //  gridwidth:[1170,800,750,480],
        //gridheight:[680,680,400,400],
        delay: 15000,    
        startwidth:1170,

        autoHeight: 'off',
        //minHeight:[680,680,400,400],       

        touchenabled: "on",

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
            }           
        },

        shadow: 0,    

        spinner: "spinner2",
        disableProgressBar:"on",

        fullscreenOffsetContainer: '.tp-banner-container',

        hideThumbsOnMobile: "on",
        hideNavDelayOnMobile: 1500,
        hideBulletsOnMobile: "on",
        hideArrowsOnMobile: "on",
        hideThumbsUnderResolution: 0,
        
    });
}); //ready