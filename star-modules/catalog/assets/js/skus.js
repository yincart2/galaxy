// JavaScript Document

//author:54xiaosu(87753586) 
//函数说明：合并指定表格（表格id为_w_table_id）指定列（列数为_w_table_colnum）的相同文本的相邻单元格
//参数说明：_w_table_id 为需要进行合并单元格的表格的id。如在HTMl中指定表格 id="data" ，此参数应为 #data
//参数说明：_w_table_colnum 为需要合并单元格的所在列。为数字，从最左边第一列为1开始算起。
function _w_table_rowspan(_w_table_id, _w_table_colnum) {
    _w_table_firsttd = "";
    _w_table_currenttd = "";
    _w_table_SpanNum = 0;
    _w_table_Obj = $(_w_table_id + " tr td:nth-child(" + _w_table_colnum + ")");
    _w_table_Obj.each(function (i) {
        if (i == 0) {
            _w_table_firsttd = $(this);
            _w_table_SpanNum = 1;
        } else {
            _w_table_currenttd = $(this);
            if (_w_table_firsttd.text() == _w_table_currenttd.text()) {
                _w_table_SpanNum++;
                _w_table_currenttd.hide(); //remove();
                _w_table_firsttd.attr("rowSpan", _w_table_SpanNum);
            } else {
                _w_table_firsttd = $(this);
                _w_table_SpanNum = 1;
            }
        }
    });
}
//函数说明：合并指定表格（表格id为_w_table_id）指定行（行数为_w_table_rownum）的相同文本的相邻单元格
//参数说明：_w_table_id 为需要进行合并单元格的表格id。如在HTMl中指定表格 id="data" ，此参数应为 #data
//参数说明：_w_table_rownum 为需要合并单元格的所在行。其参数形式请参考jQuery中nth-child的参数。
//          如果为数字，则从最左边第一行为1开始算起。
//          "even" 表示偶数行
//          "odd" 表示奇数行
//          "3n+1" 表示的行数为1、4、7、10.......
//参数说明：_w_table_maxcolnum 为指定行中单元格对应的最大列数，列数大于这个数值的单元格将不进行比较合并。
//          此参数可以为空，为空则指定行的所有单元格要进行比较合并。
function _w_table_colspan(_w_table_id, _w_table_rownum, _w_table_maxcolnum) {
    if (_w_table_maxcolnum == void 0) {
        _w_table_maxcolnum = 0;
    }
    _w_table_firsttd = "";
    _w_table_currenttd = "";
    _w_table_SpanNum = 0;
    $(_w_table_id + " tr:nth-child(" + _w_table_rownum + ")").each(function (i) {
        _w_table_Obj = $(this).children();
        _w_table_Obj.each(function (i) {
            if (i == 0) {
                _w_table_firsttd = $(this);
                _w_table_SpanNum = 1;
            } else if ((_w_table_maxcolnum > 0) && (i > _w_table_maxcolnum)) {
                return "";
            } else {
                _w_table_currenttd = $(this);
                if (_w_table_firsttd.text() == _w_table_currenttd.text()) {
                    _w_table_SpanNum++;
                    _w_table_currenttd.hide(); //remove();
                    _w_table_firsttd.attr("colSpan", _w_table_SpanNum);
                } else {
                    _w_table_firsttd = $(this);
                    _w_table_SpanNum = 1;
                }
            }
        });
    });
}

//var a;


function buildSkuTable(array) {

    $('#sku').find('tbody').empty();

    if (array.length === 0) {
        return;
    }

    for (var i = 0; i < array.length; i++) {
        if (array[i].length < 1) {
            return;
        }
    }

    var a = array[0];

    for (var i = 1; i < array.length; i++) {
        fff(array[i]);
    }


    function fff(array) {
        var ar = a;
        a = new Array();
        for (var i = 0; i < ar.length; i++) {
            for (var j = 0; j < array.length; j++) {
                var v = a.push(ar[i] + "_" + array[j]);
            }
        }
    }


    var idArray = [];
    var opArray = [];
    for (var k = 0; k < a.length; k++) {
        var arr = a[k].split('_');
        var tmArr = [];
        var mpArr = [];
        for (var i = 0; i < arr.length; i++) {
            var arr2 = arr[i].split(';');
            tmArr.push(arr2[2] + ':' + arr2[0]);
            mpArr.push(arr2)
        }
        idArray.push(tmArr);
        opArray.push(mpArr);
    }

    var body = '';

    for (var k = 0; k < a.length; k++) {
        body += '<tr>';
        arr = opArray[k]
        var count = arr.length;
        for (var i = 0; i < count; i++) {
            body += '<td><input data-index="' + i + '" data-id="' + idArray[k].slice(0, i + 1).join('_') + '" value="' + arr[i][0] + '" type="hidden" name="Item[skus][table][' + k + '][props][' + arr[i][2] + ']">' + arr[i][1] + '</td>';
        }
        var sku_row_id = idArray[k].join('_');
        body += '<td><input type="hidden" class="skusid" data-props="' + sku_row_id + '" value="0" name="Item[skus][table][' + k + '][sku_id]"><input label="price" class="skus-price" value="" type="text" data-id="' + sku_row_id + '" name="Item[skus][table][' + k + '][price]"></td><td><input label="stock" class="skus-qty" data-id="' + sku_row_id + '" value="" type="text" name="Item[skus][table][' + k + '][stock]"></td><td><input label="outer_id" class="skus-outer_id" value="" data-id="' + sku_row_id + '" type="text" name="Item[skus][table][' + k + '][outer_id]"></td><td class="operation"><a href="javascript:void(0);" data-id="' + sku_row_id + '" ><i class="icon-cog"></i></a></td></tr>';
    }

    $('#sku').find('tbody').html(body);

    $('#sku td.operation a').popover({
        html: true,
        placement: 'left',
        container: 'body',
        title: '批量操作',
        content: function () {
            return $("#hint-contentbox").html();
        }
    });

    $('#sku td.operation a').on('shown.bs.popover', function () {
        $current = $(this);
        $("#currentRow").val($current.data('id'));
        updateBatchOption($current.data('id'));
        $('#sku td.operation a').each(function () {
            if ($current.data("id") != $(this).data("id")) {
                $(this).popover('hide');
            }
        });
    });

    for (var i = array.length; i >= 1; i--) {
        _w_table_rowspan("#sku", i);
    }

    renderBatchLayer(opArray[0]);
    fillData();

}

function updateBatchOption(optid) {
    var optArr = optid.split("_");
    for (var i = 0, count = optArr.length; i < count; i++) {
        $("div.popover-content").find('input[data-index="' + i + '"]').data("optid", optArr[i]);
        $("#hint-contentbox").find('input[data-index="' + i + '"]').data("optid", optArr[i]);
    }
}

function renderBatchLayer(optArr) {
    var html = [];
    var count = optArr.length;
    if (count == 0) return false;

    html.push('<div class="batch-type col-lg-6">');
    html.push('<div class="caption">价格：</div>');
    html.push('<ul class="list">');
    for (var i = 0; i < count; i++) {
        html.push('<li>');
        html.push('<input class="batch-radio" data-type="price" data-index="' + i + '" name="batch-price" data-optId="' + optArr[i][0] + '" id="batch-price-' + i + '" type="radio">');
        html.push('<label for="batch-price-' + i + '">同' + $("#thop_" + i).text() + '价格相同</label>');
        html.push('</li>');
    }

    html.push('</ul>');
    html.push('</div>');


    html.push('<div class="batch-type col-lg-6">');
    html.push('<div class="caption">数量：</div>');
    html.push('<ul class="list">');
    for (var i = 0; i < count; i++) {
        html.push('<li>');
        html.push('<input class="batch-radio" data-type="stock" data-index="' + i + '" name="batch-stock" data-optId="' + optArr[i][0] + '" id="batch-stock-' + i + '" type="radio">');
        html.push('<label for="batch-stock-' + i + '">同' + $("#thop_" + i).text() + '数量相同</label>');
        html.push('</li>');
    }
    html.push('</ul>');
    html.push('</div>');

    $("#hint-contentbox div.batch-body").html(html.join(""));
}

function fillData() {
    var item_id = $("#skus_info").data("id");
    var skus_url = $("#skus_info").data("url");
    if (parseInt(item_id) > 0) {
        $.ajax
        ({
            type: "POST",
            data: {item_id: item_id, YII_CSRF_TOKEN: $("[name=YII_CSRF_TOKEN]").val()},
            url: skus_url,
            dataType: "html",
            success: function (res) {
                updateSkus(res);
            }
        });
    }
}

function updateSkus(res) {
    var json = eval(res);
    $.each(json, function (i, data) {
        $("#sku").find("input[type=hidden][data-props='" + data["props"] + "']").val(data["sku_id"]);//更新sku_id
        $("#sku").find("input[class='skus-price'][data-id='" + data["props"] + "']").val(data["price"]);//更新price
        $("#sku").find("input[class='skus-qty'][data-id='" + data["props"] + "']").val(data["stock"]);//更新stock
        $("#sku").find("input[class='skus-outer_id'][data-id='" + data["props"] + "']").val(data["outer_id"]);//更新outer_id
    });
}

var flag = 1;
function renderTable() {
    $('.sku-map').show();
    //建立sku表格内容
    array = new Array();
    array_props = new Array();
    $('div').filter('[id*="Item_skus_checkbox_"]').each(function () {
        var $that = $(this);
        var newArray = new Array();
        var newArray = new Array();
        $(this).find('.change').filter(':checked').each(function () {
            newArray.push($(this).val() + ";" + $(this).parent().text() + ";" + $(this).data('id'));
        });
        array.push(newArray);
    });
    buildSkuTable(array);


    var tmp = null;

    var $chb = $('input.change:checked'), nameArr = [];
    $chb.each(function () {
        var i;
        for (i in nameArr) {
            if (this.name === nameArr[i]) {
                return;
            }
        }
        nameArr.push(this.name);
    });

    //    $(".alert").remove();  //会注销掉所有的错误提示


    if((nameArr.length < window.chbGroupCount)&&flag){
        //显示提示信息
        $("#sku_error").show();
        flag = 0;
    }
    if((nameArr.length == window.chbGroupCount) && !flag){
        $("#sku_error").hide();
        flag = 1;
    }
    if (nameArr.length == 0) {
        //显示提示信息
        $("#sku_error").show();
    }
    //if (nameArr.length != 0) {
    //    $("#sku_error").hide();
    //}
}

$(document).ready(function () {

    $(document).on('click', '.change', function () {
        renderTable();
    });

    var getItemProps = function () {
        $.get($('#item-category_id').data('url'),
            {
                "category_id": $("#item-category_id").select().val(),
                "item_id": $("#item-category_id").data('item_id'),
                "tree_id": $("#item-category_id").data('tree_id')
            }, function (response) {
                $('#item_prop_values').remove();
                $('.field-item-category_id').after(response);
                setChbGroupCount();
                renderTable();
            });
    };
    getItemProps();
    $('#item-category_id').on('change', function () {
        getItemProps();
    });
    function setChbGroupCount() {
        var $chb = $('input.change'),
            nameArr = [];
        $chb.each(function () {
            var i;
            for (i in nameArr) {
                if (this.name === nameArr[i]) {
                    return;
                }
            }
            nameArr.push(this.name);
        });
        window.chbGroupCount = nameArr.length;
    }

    function apply_same_param(optid, index, type) {
        var rid = $("#currentRow").val();

        if (index == 0) {
            var cur_price = $("#sku").find("input[class='skus-price'][data-id='" + rid + "']").val();
            var cur_qty = $("#sku").find("input[class='skus-qty'][data-id='" + rid + "']").val();
            if (type == 0) {
                var oid = $("#sku").find("input[type=hidden][data-index='" + index + "']").data("id");
                $("#sku").find("input[class='skus-price'][data-id*='" + optid + "']").each(function () {
                    $(this).val(cur_price);
                });
            } else if (type == 1) {
                var oid = $("#sku").find("input[type=hidden][data-index='" + index + "']").data("id");
                $("#sku").find("input[class='skus-qty'][data-id*='" + optid + "']").each(function () {
                    $(this).val(cur_qty);
                });
            }
        } else {
            var opAr = rid.split("_");
            var mat = "";
            for (var i = 0, count = opAr.length; i < count; i++) {
                mat += (i == 0) ? opAr[i] : "_" + opAr[i];
                $("#sku").find("input[type=hidden][class='skusid'][data-props*='" + mat + "']").each(function () {
                    var tr = $(this).parent("td").parent("tr");
                    var opMatch = $(this).data("props").replace(mat, "");
                    cur_price = tr.find("input[class='skus-price']").val();
                    cur_qty = tr.find("input[class='skus-qty']").val();
                    if (type == 0) {

                        $("#sku").find("input[class='skus-price'][data-id*='" + opMatch + "']").each(function () {
                            $(this).val(cur_price);
                        });
                    } else if (type == 1) {

                        $("#sku").find("input[class='skus-qty'][data-id*='" + opMatch + "']").each(function () {
                            $(this).val(cur_qty);
                        });
                    }
                });
            }
        }
    }

    $(document).on("click", "#btnPopSub", function (e) {
        $(".popover-content").find("input[type=radio][data-type=price]:checked").each(function () {
            var optid = $(this).data('optid');
            var index = $(this).data('index');
            apply_same_param(optid, index, 0);
        });

        $(".popover-content").find("input[type=radio][data-type=stock]:checked").each(function () {
            var optid = $(this).data('optid');
            var index = $(this).data('index');
            apply_same_param(optid, index, 1);
        });

        $("#hint-contentbox").html($(".popover-content").html());
        $('#sku td.operation a').popover('hide');
    });


    $(document).on("click", "#btnPopCancel", function (e) {
        $(".popover-content").find("input[type=radio]:checked").each(function () {
            $(this).removeAttr("checked");
        });
        $("#hint-contentbox").html($(".popover-content").html());
        $('#sku td.operation a').popover('hide');
    });
});





































