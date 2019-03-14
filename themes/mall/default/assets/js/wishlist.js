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
            var count = parseInt($(".count-wishlist").data("amount")) + 1;
            $(".count-wishlist").attr("data-amount",count);
            alert("Add the item to wishlist success!");
        } else {
            alert(response);
        }
    },"json");
});