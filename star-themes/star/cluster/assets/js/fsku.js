/**
 * Created by cangzhou.wu on 15-2-12.
 */
$(function () {
    var skus = $('.deal_size').data('sku-value');
    var emptySkus = [];
    var emptySkusArray=new Array();
    for (var i in skus) {
        var sku = $.parseJSON(skus[i]);
        if (sku['stock'] == "0") {
            emptySkus.push(i);
        }
    }
    if(emptySkus.length>0){
        for(var a in emptySkus){
            var data=emptySkus[a].split(';');
            emptySkusArray[a]=new Array();
            for( var b in data){
                emptySkusArray[a][b]=data[b];
            }
        }
    }
    /**立即购买**/
    function findSkuId(selectPropValue){
        var select=$('.deal_size');
        var skuKey=select.data('sku-key');
        for(var a in skuKey){
            if(skuKey[a]==selectPropValue){
                var num=a;
            }
        }
        var skuKeyId=select.data('sku-id').split(',');
        var selectAdd=$('.deal_add');
        selectAdd.find('a').attr({
            'data-url':selectAdd.data('url')+"?position=Sku"+skuKeyId[num]
        });
    }
//        $('.deal_add').click(function(){
//            var selectProps = $('.prop-select,.img-prop-select');
//            if (selectProps.length < $('.deal_size p').length) {
//                $('.deal_size').addClass('prop-div-select');
//            } else {
//                $.post($('.deal_add_car').data('url'), $('#deal').serialize(), function(response) {
//                    if(response.status=='success'){
//                        location.href=$('.deal_add a').data('url');
//                    }else{
//                        showPopup('system error');
//                    }
//                },'json');
//            }
//        })
    function findSameValue(a,b){
        var num1= a.length;
        var num2= b.length;
        var flag=0;
        if(num2-num1==0){
            for(var c in a){
                if(a[c]==b[c]&&flag==c){
                    flag++;
                }
            }if(flag==num1-1){
                return true;
            }
        }
        if(num2-num1==1){
            for(var c in a){
                if(a[c]==b[c]){
                    flag++;
                }
            }
        }
        if(flag==num1){
            return true;
        }else return false;
    }
    $('.deal_size a').click(function () {
        var selectClass = $(this).find('img').length ? 'img-prop-select' : 'prop-select';
        if($(this).attr('class') !='disable'){
            if ($(this).attr('class') && $(this).attr('class').indexOf(selectClass) !== -1) {
                $(this).removeClass(selectClass);
            } else {
                $(this).parent().find('a').removeClass(selectClass);
                $(this).addClass(selectClass);
            }
            var selectPropValue = [];
            $('.prop-select,.img-prop-select').each(function () {
                selectPropValue.push($(this).data('value'));
            });
            /***将库存为0的选项加上disable属性****/
            if(emptySkus.length>0){
                var disableRemoveFlag=true;
                for(var b in emptySkusArray){
                    if(findSameValue(selectPropValue,emptySkusArray[b])){
                        var selectDisable=$("#prop"+emptySkusArray[b][emptySkusArray[b].length-1].replace(/:/,'-'));
                        selectDisable.addClass('disable');
                        selectDisable .removeClass( 'prop-select');
                        disableRemoveFlag=false;
                    }
                    if(disableRemoveFlag){
                        while($('.disable').length){
                            $('.disable').removeClass('disable');
                        }
                    }
                }
            }
            selectPropValue = selectPropValue.join(';');
            $('#props').val(selectPropValue);
            if (skus[selectPropValue]) {
                findSkuId(selectPropValue);
                var sku = $.parseJSON(skus[selectPropValue]);

                var price = $('.deal_price').find('strong');
                price.text( sku['price']);
                $('#stock').text(sku['stock']);
            }
            if($('.deal_size').data('sku-value').length==0){
                var selectAdd=$('.deal_add');
                selectAdd.find('a').attr({
                    'data-url':selectAdd.data('url')+"?position=Item"+$('.deal_size').data('sku-id')
                })
            }
        }


    });

    $('.deal_add_car').click(function() {
        var selectProps = $('.prop-select,.img-prop-select');
        if (selectProps.length < $('.deal_size p').length) {
            $('.deal_size').addClass('prop-div-select');
        } else {
            $('.deal_size').removeClass('prop-div-select');
            $.post($(this).data('url'), $('#deal').serialize(), function(response) {
                if(response.status=='success'){
                    var num=$('#shopping_car').text();
                    num=parseInt(num)+1;
                    $('#shopping_car').text(num);
                    alert(response.message);
                }else
                    alert(response.message);
            },'json');
        }
    });
    $('.deal_collect').click(function() {
        $.post($(this).data('url'), $('#item_id').serialize(), function(response) {
            if(response.status=='exist'){
                showPopup('已收藏过该商品');
            }else
                showPopup(response.status) ;
        },'json');
    });
    $('.deal_add').click(function() {
        var selectProps = $('.prop-select,.img-prop-select');
        if (selectProps.length < $('.deal_size tr').length) {
            $('.deal_size').addClass('prop-div-select');
        } else {
            $('.deal_size').removeClass('prop-div-select');
            $(this).parents('form').submit();
        }
    });
});
