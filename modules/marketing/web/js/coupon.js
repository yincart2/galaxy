$(function() {
    if($("#couponform-shipping").val() != 1) {
        $(".field-couponform-shippingfee").hide();
    }

    $("#couponform-shipping").on("change", function() {
        if($(this).val() == 1) {
            $(".field-couponform-shippingfee").show();
        } else {
            $(".field-couponform-shippingfee").hide();
        }
    });
});