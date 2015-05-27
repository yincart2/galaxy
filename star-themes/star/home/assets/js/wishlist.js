$(".wishlist").on("click", function() {
    var url = $(this).data("url");
    var _csrf = $(this).data("csrf");
    var item_id = $(this).data("item_id");
    var data = {
        item_id: item_id,
        _frontendCSRF: _csrf
    };
    $.post(url,data,function(response) {
        if(response == "Success") {
            $(".count-favorite").html(parseInt($(".count-favorite").html()) + 1);
            alert("Add the item to favorite list success!");
        } else {
            alert(response);
        }
    },"json");
});