/**
 * Created by LCH on 2014/11/22.
 */

$(function() {
    $(' .update-cart ').click(function() {
        $data = $(this).parents('form').serialize();
        var beforeUpdate = $(window).triggerHandler('item.beforeUpdate', this);
        if (beforeUpdate !== false) {
            $.post($(this).data('url'), $data, function(response) {
                if (response.message) {
                    alert(response.message);
                }
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            }, 'json');
        }
        $(window).triggerHandler('item.afterUpdate');
    });

    $(' .remove-item , .clear-all ').click(function() {
        $data = $(this).data('item');
        var _csrf = $('#_frontendCSRF').val();
        var beforeRemove = $(window).triggerHandler('item.beforeRemove', this);
        if (beforeRemove !== false) {
            $.post($(this).data('url'), {'sku_id':$data,_frontendCSRF: _csrf}, function(response) {
                if (response.message) {
                    alert(response.message);
                }
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            }, 'json');
        }
        $(window).triggerHandler('item.afterRemove');
    });

    $('.quantity').change(function(){
        var val = $('.quantity').val();
        if(!val || isNaN(val)){
            $('.quantity').val(1);
        }
    })
});
