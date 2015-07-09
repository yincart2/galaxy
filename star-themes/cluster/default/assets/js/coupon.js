$(function(){
    $('#addCoupon').click(function() {
        var data = $('#discount_code').serialize();
        $.post($(this).data('url'), data, function(response) {
                alert(response.message);
        },'json');
    });

    //the view of order checkout
    $('#couponDropDrown').change(function() {
        $.post($(this).data('url'), {couponId: $(this).val()}, function(response) {
            if(response.status=='fail'){
                alert('data is wrong');
            }else{
                $('#coupon-result').empty();
                var $totalPrice = $('#total-price');
                var $shippingFee = $('#shipping-fee');
                if(Number(response.type)){
                    a = Number($totalPrice.data('price')) * Number(response.number);
                    text = "总价优惠： 打"+Number(response.number)+"折;";
                }else{
                    a = Number($totalPrice.data('price')) -Number( response.number);
                    text = "总价优惠： -"+Number(response.number)+"元;";
                }

                switch(Number(response.shipping)){
                    case 1:
                        b = Number($shippingFee.data('price')) - Number(response.shippingFee);
                        text = text + "邮费：-"+Number(response.shippingFee);
                        $shippingFee.html(b);
                        break;
                    case 2:
                        b = 0;
                        text = text + "包邮";
                        $shippingFee.html(b);
                        break;
                }
                $totalPrice.html(a);
                $('#coupon-result').append(text);
            }
        },'json');
    });


});