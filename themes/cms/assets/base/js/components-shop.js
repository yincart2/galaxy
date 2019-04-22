/**
 Core Shop layout handlers and wrappers
 **/

// BEGIN: Layout Brand
var LayoutQtySpinner = function () {

	return {
		//main function to initiate the module
		init: function () {
			$('.c-spinner .btn:first-of-type').on('click', function () {
				var data_input = $(this).attr('data_input');
				var data_max = ($(this).data('maximum')) ? $(this).data('maximum') : 10;
				if ($('.c-spinner input.' + data_input).val() < data_max) {
					$('.c-spinner input.' + data_input).val(parseInt($('.c-spinner input.' + data_input).val(), 10) + 1);
				}			
			});

			$('.c-spinner .btn:last-of-type').on('click', function () {
				var data_input = $(this).attr('data_input');
				if ($('.c-spinner input.' + data_input).val() != 0) {
					$('.c-spinner input.' + data_input).val(parseInt($('.c-spinner input.' + data_input).val(), 10) - 1);
				}
			});
		}

	};
}();
// END

// BEGIN: Layout Checkbox Visibility Toggle
var LayoutCheckboxVisibilityToggle = function () {

	return {
		//main function to initiate the module
		init: function () {
			$('.c-toggle-hide').each(function () {
				var $checkbox = $(this).find('input.c-check'),
					$speed = $(this).data('animation-speed'),
					$object = $('.' + $(this).data('object-selector'));

				$object.hide();

				if (typeof $speed === 'undefined') {
					$speed = 'slow';
				}

				$($checkbox).on('change', function () {
					if ($($object).is(':hidden')) {
						$($object).show($speed);
					} else {
						$($object).slideUp($speed);
					}
				});
			});
		}
	};

}();
// END

// BEGIN: Layout Shipping Calculator
var LayoutShippingCalculator = function () {

	return {
		//main function to initiate the module
		init: function () {
			var $shipping_calculator = $('.c-shipping-calculator'),
				$radio_name = $($shipping_calculator).data('name'),
				$total_placeholder = $($shipping_calculator).data('total-selector'),
				$subtotal_placeholder = $($shipping_calculator).data('subtotal-selector'),
				$subtotal = parseFloat($('.' + $subtotal_placeholder).text());

			$('input[name=' + $radio_name + ']', $shipping_calculator).on('change', function () {
				var $price = parseFloat($('input[name=' + $radio_name + ']:checked', $shipping_calculator).val()),
					$overall_total = $subtotal + $price;
				$('.' + $total_placeholder).text($overall_total.toFixed(2));
			});
		}
	};

}();
// END

// PRODUCT GALLERY
var LayoutProductGallery = function () {
	return {
		//main function to initiate the module
		init: function () {
			$('.c-product-gallery-content .c-zoom').toggleClass('c-hide'); // INIT FUNCTION - HIDE ALL IMAGES

			// SET GALLERY ORDER
			var i = 1;
			$('.c-product-gallery-content .c-zoom').each(function(){
				$(this).attr('img_order', i);
				i++;
			});

			// INIT ZOOM MASTER PLUGIN
			$('.c-zoom').each(function(){
				$(this).zoom();
			});

			// ASSIGN THUMBNAIL TO IMAGE
			var i = 1;
			$('.c-product-thumb img').each(function(){
				$(this).attr('img_order', i);
				i++;
			});

			// INIT FIRST IMAGE
			$('.c-product-gallery-content .c-zoom[img_order="1"]').toggleClass('c-hide');

			// CHANGE IMAGES ON THUMBNAIL CLICK
			$('.c-product-thumb img').click(function(){
				var img_target = $(this).attr('img_order');

				$('.c-product-gallery-content .c-zoom').addClass('c-hide');
				$('.c-product-gallery-content .c-zoom[img_order="'+img_target+'"]').removeClass('c-hide');
			});
        
        	// SET THUMBNAIL HEIGHT
        	var thumb_width = $('.c-product-thumb').width();
        	$('.c-product-thumb').height(thumb_width);

	    }
	}
}();

// BEGIN: Price Slider
var PriceSlider = function () {

	return {
		//main function to initiate the module
		init: function () {
			$('.c-price-slider').slider();
		}

	};

}();
// END

// BEGIN : OFFER NOTIFICATION BAR
var LayoutTopbarOffer = function () {

	var _initInstances = function () {

		$('.c-shop-topbar-close').click(function(){
			$('.c-shop-topbar-offer').animate({
				opacity: 0,
			  }, 200, function() {
			    $('.c-shop-topbar-offer').css('display', 'none');
			    var offer_height = $(this).outerHeight(true);
			    offer_height = (parseInt($('.c-layout-page').css('margin-top')) - offer_height);
			    $('.c-layout-page').css('margin-top', (offer_height+'px'));
			  });
		});
	};

	return {

		//main function to initiate the module
		init: function () {
			_initInstances();
		}

	};
}();
// END : OFFER NOTIFICATION BAR

// Main theme initialization
$(document).ready(function () {
	// init layout handlers
	LayoutQtySpinner.init();
	LayoutCheckboxVisibilityToggle.init();
	LayoutShippingCalculator.init();
	LayoutProductGallery.init();
	PriceSlider.init();
	LayoutTopbarOffer.init();
});