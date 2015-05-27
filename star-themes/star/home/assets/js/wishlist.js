$(".wishlist").on("click", function() {
    var url = $(this).data("url");
    var _csrf = $(this).data("csrf");
    var item_id = $(this).data("item_id");
    var category_id = $(this).data("category_id");
    var type = $(this).data("type");
    var data = {
        item_id: item_id,
        category_id: category_id,
        type: type,
        _frontendCSRF: _csrf
    };
    $.post(url,data,function(response) {
        if(type == 1 && response == "Success") {
            $(".count-favorite").html(parseInt($(".count-favorite").html()) + 1);
            alert("Add the item to favorite list success!");
        } else if(type == 2 && response == "Success") {
            $(".count-compare").html(parseInt($(".count-compare").html()) + 1);
            alert("Add the item to compare list success!");
        } else {
            alert(response);
        }
    },"json");
});