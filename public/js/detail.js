var star = 1;
function getStar(n) {
    star = n;
    for (var i = 1; i <= 5; i++) {
        var icon = document.getElementById('star' + i);
        if (i <= n) {
            icon.style.color = "#ffc300";
        } else {
            icon.style.color = "black";
        }
    }
}
//////////////////////////////////////////


// Get the value of the "myCookie" cookie


// Log the value to the console
// console.log('Value of myCookie:', myCookieValue);
$("#comment-input").focus(function () {
    if (myCookieValue == null) {
        location.href = "login";
    }
});
/////////////////////////////////////
function checkKeyword(text) {
    var arr = ['lol', 'dm', 'fuck', 'cc', 'lon', 'cac', 'clm', 'cm', 'chet', 'mm', 'cho chet', 'me may',
        'dmm', 'bitch'
    ];
    for (var i = 0; i < arr.length; i++) {
        if (text.indexOf(arr[i]) !== -1) {
            return false;
        }
    }
    return true;
}
///////////////////////////////
function addcart(id) {
    $.ajax({
        type: "get",
        dataType: "html",
        url: "gh" + id,
        data: id,
        success: function (response) {
            var data = $.parseJSON(response);
            if (data.flag == false)
                var div =
                    '<div class="alert alert-warning">' +
                    '<button type="button" class="close" data-dismiss="alert">x</button>' +
                    'Sản phẩm <b>' + data.name + '</b> đã hết hàng.' +
                    '</div>';
            else {
                var div =
                    '<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">x</button>' +
                    'Đã thêm thành công sản phẩm <b>' + data.name + '</b> vào ghỏ hàng.' +
                    '</div>';
                $('#cart-popup').load(location.href + " #cart-popup2");
                document.getElementById('lblCartCount').innerHTML = data.count;
            }
            $('.session-message').html(div);
            document.getElementsByTagName("body").scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    });
}
/////////////////////////////////////
function show_hide(n) {
    if (n == 0) {
        document.getElementById('cart-popup').style.display = "block";
        document.getElementById('cart-icon').style.display = "none";
    } else {
        document.getElementById('cart-popup').style.display = "none";
        document.getElementById('cart-icon').style.display = "block";
    }
}
//Tang giam so luong
function tang_giam(n, id, sl) {
    var qty = document.getElementById('qty' + id).value;
    qty = parseInt(qty);
    if (n == 0) {
        qty -= 1;
    } else {
        qty += 1;
    }
    if (qty > sl) {
        var mess =
            '<div class="alert alert-warning">' +
            '<i class="fa">&#xf071;</i> Số lượng hàng còn lại không đủ.' +
            '<button  type="button" class="close" data-dismiss="alert">x</button></div>';
        $('.session-message').html(mess);
        document.getElementsByTagName("body").scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
    else if (qty > 0 && qty <= sl) {
        document.getElementById('qty' + id).value = qty;
        var newqty = qty;
        var data = {
            'SoLuong': newqty,
            'MaSanPham': id,
        }
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: 'update' + id,
            data: data,
            success: function () {
                $('.tongcong').load(location.href + " .tongcong2");
            }
        });
    }
}
// Xóa sản phẩm bằng ajax
function delProductPopup(id) {
    $.ajax({
        type: "get",
        dataType: "html",
        url: "delProduct" + id,
        data: id,
        success: function () {
            var count = document.getElementById('lblCartCount').textContent;
            count = parseInt(count);
            document.getElementById('lblCartCount').innerHTML = count - 1;
            $('#cart-popup').load(location.href + " #cart-popup2");
        }
    });
}