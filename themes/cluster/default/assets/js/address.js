$(function() {

    $("#new_address").on("click",function() {
        $(this).hide();
        $('#address').show();
    });

    $("#cancel").on("click",function() {
        $("#new_address").show();
        $('#address').hide();
    });

    $("#back").on("click",function() {
        history.back();
    });

    $("#deliveryaddress-zip_code").keyup(function() {
        $("#deliveryaddress-zip_code").val($('#deliveryaddress-zip_code').val().replace(/\D/g,''));
    });

    $("#deliveryaddress-phone").keyup(function() {
        $("#deliveryaddress-phone").val($('#deliveryaddress-phone').val().replace(/\D/g,''));
    });

    $("#cat-id").change(function() {
        if($(this).children("option:selected").val() != '') {
            $(".field-deliveryaddress-province").removeClass("has-error");
            $(".field-deliveryaddress-province").addClass("has-success");
        } else {
            $(".field-deliveryaddress-province").removeClass("has-success");
            $(".field-deliveryaddress-province").addClass("has-error");
        }
    });

    $("#subcat-id").change(function() {
        if($(this).children("option:selected").val() != '') {
            $(".field-deliveryaddress-city").removeClass("has-error");
            $(".field-deliveryaddress-city").addClass("has-success");
        } else {
            $(".field-deliveryaddress-city").removeClass("has-success");
            $(".field-deliveryaddress-city").addClass("has-error");
        }
    });
});