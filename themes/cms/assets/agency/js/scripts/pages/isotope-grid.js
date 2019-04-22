// ISOTOPE GRID

var IsotopeGrid = function() {

	var _init = function() {
		// BEGIN: ISOTOPE GALLERY 1 INIT
		// init isotope gallery
		var $grid1 = $('.c-content-isotope-grid.c-opt-1').imagesLoaded( function() {
			// init Isotope after all images have loaded
			$grid1.isotope({
				// options...
				itemSelector: '.c-content-isotope-item',
                layoutMode: 'packery',
                fitWidth: true,
                percentPosition: true,
			});
		});
		// END: ISOTOPE GALLERY 1

		// BEGIN: ISOTOPE GALLERY 2 INIT
		// init isotope gallery
		var $grid2 = $('.c-content-isotope-grid.c-opt-2').imagesLoaded( function() {
			// init Isotope after all images have loaded
			$grid2.isotope({
				// options...
				itemSelector: '.c-content-isotope-item',
                layoutMode: 'packery',
                fitWidth: true,
                percentPosition: true,
			});
		});
		// END: ISOTOPE GALLERY 2

		// BEGIN: ISOTOPE GALLERY 3 INIT
		// init isotope gallery
		var $grid3 = $('.c-content-isotope-grid.c-opt-3').imagesLoaded( function() {
			// init Isotope after all images have loaded
			$grid3.isotope({
				// options...
				itemSelector: '.c-content-isotope-item',
                layoutMode: 'packery',
                fitWidth: true,
                percentPosition: true,
			});
		});
		// END: ISOTOPE GALLERY 3
	}

    return {
        //main function to initiate the module
        init: function() {

            _init();

        }

    };
}();

$(document).ready(function() {
    IsotopeGrid.init();
});