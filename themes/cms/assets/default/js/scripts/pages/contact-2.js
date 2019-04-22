// CONTACT MAP

var PageContact2 = function() {

	var _init = function() {

		var mapbg = GMaps.createPanorama({
			el: '#gmapbg',
			lat: 40.7786855,
			lng: -73.9625954,
			scrollwheel: false
		});
	}

    return {
        //main function to initiate the module
        init: function() {

            _init();

        }

    };
}();

$(document).ready(function() {
    PageContact2.init();
    $( window ).resize(function() {
		PageContact2.init();
	});
});