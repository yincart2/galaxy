$(function(){
    var form = $('#compare_form');
    $('.compare').click(function(){
        var countCompare = $('#countCompare');
        if($(this).attr('data-selected')==0){
            console.log($(this).data('selected'));
            $(this).attr("data-selected", 1);
            var template = '<input type="text" name="itemId[]" value='+$(this).data('item_id')+' id='+$(this).data('compare_id')+'>' +
                '<input type="text" name="categoryId[]" value='+$(this).data('category_id')+' id='+$(this).data('compare_id')+'>';
            form.append(template);
            countCompare.text(parseInt(countCompare.text())+1);
            $(this).css('background','#292F38').css('color', '#FFF');
        }else{
            console.log($(this).data('selected'));
            $(this).attr('data-selected',0);
            countCompare.text(parseInt(countCompare.text())-1);
            form.children('#'+$(this).data('compare_id')).remove();
            $(this).css('background','##e2e6e7').css('color', '#292F38');
        }

    });

    $('#compare').click(function(){
        form.submit();
    })
});