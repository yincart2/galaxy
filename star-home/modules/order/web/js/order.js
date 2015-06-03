/**
 * Created by LCH on 2014/11/22.
 */

$(function() {

    $(' .create-order ').click(function() {
        $data = $(this).data('create');
        $formData = $('form').serialize();
        var beforeCreateOrder = $(window).triggerHandler('item.beforeCreateOrder', this);
        if($formData.search('address') === -1) {
            beforeCreateOrder = false;
            alert('请选择收获地址！');
        }
        if($formData.search('payment') === -1) {
            beforeCreateOrder = false;
            alert('请选择支付方式！');
        }
        if (beforeCreateOrder !== false) {
            $.post($(this).data('url'), $formData, function(response) {
                if (response.message) {
                    alert(response.message);
                }
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            }, 'json');
        }
        $(window).triggerHandler('item.afterCreateOrder');
    });
});