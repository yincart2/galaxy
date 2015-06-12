$(function(){
    $('#addCoupon').click(function() {
        var data = $('#discount_code').serialize();
        $.post($(this).data('url'), data, function(response) {
                alert(response.message);
        },'json');
    });

    $('#couponDropDrown').change(function() {
        $.post($(this).data('url'), {couponId: $(this).val()}, function(response) {
            if(response.status=='fail'){
                alert('data is wrong');
            }else{
                console.log(response);
            }
        },'json');
    });


});