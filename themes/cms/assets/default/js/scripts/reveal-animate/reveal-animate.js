// REVEAL ANIMATE

var revealAnimate = function() {

	var _init = function() {

		wow = new WOW(
		{
			animateClass: 'animated',
			offset:100,
			live: true,
			mobile: false,
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
	revealAnimate.init();
	new WOW().init();
	setTimeout(
		function() {
			$('.wow').css('opacity', '1');
		}, 100
	);	
});


