$(document).ready(function() {
    var slider = $('.c-layout-revo-slider .tp-banner');
    var cont = $('.c-layout-revo-slider .tp-banner-container');

    var api = slider.show().revolution({
        sliderType:"standard",
        sliderLayout:"fullscreen",
        responsiveLevels:[2048,1024,778,480],
        gridwidth: [1170, 1024, 778, 480],
        gridheight: [620, 768, 960, 720],
        delay: 15000,    
        startwidth:1170,
        startheight: 620,
       
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

        spinner: "spinner2",

        shadow: 0,
        fullWidth: "off",
        forceFullWidth: "off",
        disableProgressBar:"on",

        hideThumbsOnMobile: "on",
        hideNavDelayOnMobile: 1500,
        hideBulletsOnMobile: "on",
        hideArrowsOnMobile: "on",
        hideThumbsUnderResolution: 0
    });

    api.bind("revolution.slide.onchange",function (e,data) {

        $('.c-layout-header').removeClass('hide');   

        setTimeout(function(){
            $('.c-singup-form').fadeIn(); 
        }, 1500);
    });
}); //ready