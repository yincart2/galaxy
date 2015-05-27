$(function(){
    var form = $('#compare_form');
    $('.compare').click(function(){
        var template = '<input type="text" name="itemId[]" value='+$(this).data('item_id')+'>' +
            '<input type="text" name="categoryId[]" value='+$(this).data('category_id')+'>';
        form.append(template);
        var countCompare = $('#countCompare')
        countCompare.text(parseInt(countCompare.text())+1);
        $(this).attr("disabled", true).css('background','#292F38').css('color', '#FFF');
    });

    $('#countCompare').click(function(){
        form.submit();
    })
});