$(function() {

    $("#memberaddress-zip_code").keyup(function() {
        $("#memberaddress-zip_code").val($('#memberaddress-zip_code').val().replace(/\D/g,''));
    });

    $("#memberaddress-phone").keyup(function() {
        $("#memberaddress-phone").val($('#memberaddress-phone').val().replace(/\D/g,''));
    });

    $("#cat-id").change(function() {
        if($(this).children("option:selected").val() != '') {
            $(".field-memberaddress-province").removeClass("has-error");
            $(".field-memberaddress-province").addClass("has-success");
        } else {
            $(".field-memberaddress-province").removeClass("has-success");
            $(".field-memberaddress-province").addClass("has-error");
        }
    });

    $("#subcat-id").change(function() {
        if($(this).children("option:selected").val() != '') {
            $(".field-memberaddress-city").removeClass("has-error");
            $(".field-memberaddress-city").addClass("has-success");
        } else {
            $(".field-memberaddress-city").removeClass("has-success");
            $(".field-memberaddress-city").addClass("has-error");
        }
    });
});