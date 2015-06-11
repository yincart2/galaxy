$(function(){
    $('#addCoupon').click(function() {
        var data = $('#discount_code').serialize();
        $.post($(this).data('url'), data, function(response) {
                alert(response.message);
        },'json');
    });

});