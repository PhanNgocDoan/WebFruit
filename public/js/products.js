var search_key = false;
var search_price = false;
var search_catagory = false;
var search_brand = false;
var search_mode = false;
//var search_PriceToPrice = false;
//
var search = $('#search').val();
var price = $('#priceRange').val();
var cat = $('#catagoryProduct').find(":selected").val();
var brand = $('#brandsProduct').find(":selected").val();
var mode = $('#viewMode').find(":selected").val();

//Tìm kiếm sản phẩm bằng từ khóa
$(document).ready(function () {
    $('#search').on('change keypress', function () {
        search_key = true;
        search_price = false;
        search_catagory = false;
        search_brand = false;
        //search_mode = false;
        //search_PriceToPrice = false;
        //
        search = $(this).val();
        price = $('#priceRange').val();
        cat = $('#catagoryProduct').find(":selected").val();
        brand = $('#brandsProduct').find(":selected").val();
        //mode = $('#viewMode').find(":selected").val();
        var data2 = {
            'tukhoa': search,
            'gia': price,
            'loai': cat,
            'hang': brand
        }
        $.ajax({
            type: 'get',
            url: "/locsp",
            data: data2,
            success: function (response) {
                $('#item-lists').html(response);
            }
        });
    });
});
//Chuyển trang tìm kiếm từ khóa
function searchBykey(page) {
    search = $('#search').val();
    price = $('#priceRange').val();
    cat = $('#catagoryProduct').find(":selected").val();
    brand = $('#brandsProduct').find(":selected").val();
    var data2 = {
        'tukhoa': search,
        'gia': price,
        'loai': cat,
        'hang': brand
    }
    $.ajax({
        type: 'get',
        url: "/locsp?page=" + page,
        data: data2,
        success: function (data) {
            $("#item-lists").html(data);
        }
    });
}
// Tìm kiếm bằng giá bằng thanh kéo
$(document).ready(function () {
    $('#priceRange').on('change keypress', function () {
        search_key = false;
        search_price = true;
        search_catagory = false;
        search_brand = false;
        //search_mode = false;
        //search_PriceToPrice = false;
        //
        search = $('#search').val();
        price = $(this).val();
        cat = $('#catagoryProduct').find(":selected").val();
        brand = $('#brandsProduct').find(":selected").val();
        var data2 = {
            'tukhoa': search,
            'gia': price,
            'loai': cat,
            'hang': brand
        }
        $.ajax({
            type: 'get',
            url: "/locsp",
            data: data2,
            success: function (response) {
                $('#priceRange').prop('disabled', true);
                $('#item-lists').html(response);
                $('#priceRange').prop('disabled', false);
            }
        });
    });
});
// Chuyển trang tìm kiếm giá bằng thanh kéo
function searchByprice(page) {
    search = $('#search').val();
    price = $('#priceRange').val();
    cat = $('#catagoryProduct').find(":selected").val();
    brand = $('#brandsProduct').find(":selected").val();
    var data2 = {
        'tukhoa': search,
        'gia': price,
        'loai': cat,
        'hang': brand
    }
    $.ajax({
        type: 'get',
        url: "/locsp?page=" + page,
        data: data2,
        success: function (response) {
            $('#item-lists').html(response);
        }
    });
}
// Tìm kiếm bằng khoảng giá
// $(document).ready(function () {
//     $('input[type=radio][name=choice]').change(function () {
//         search_key = false;
//         search_price = false;
//         search_catagory = false;
//         search_brand = false;
//         search_PriceToPrice = true;
//         let radio = $('input[type=radio][name=choice]:checked');
//         const min = radio.data('min');
//         const max = radio.data('max');
//         $.ajax({
//             type: "get",
//             url: "PriceToPrice",
//             data: {
//                 'min': min,
//                 'max': max
//             },
//             success: function (res) {
//                 $('#item-lists').html(res);
//             }
//         });
//     });
// });
// //Chuyển trang tìm kiếm bằng khoảng giá
// function searchByPriceToPrice(page) {
//     let radio = $('input[type=radio][name=choice]:checked');
//     const min = radio.data('min');
//     const max = radio.data('max');
//     $.ajax({
//         type: "get",
//         url: "PriceToPrice?page=" + page,
//         data: {
//             'min': min,
//             'max': max
//         },
//         success: function (res) {
//             $('#item-lists').html(res);
//         }
//     });
// }
//load trái cây theo loại
$(document).ready(function () {
    $('#catagoryProduct').on('change select', function () {
        search_key = false;
        search_price = false;
        search_catagory = true;
        search_brand = false;
        //search_mode = false;
        // search_PriceToPrice = false;
        //
        search = $('#search').val();
        price = $('#priceRange').val();
        cat = $(this).find(":selected").val();
        brand = $('#brandsProduct').find(":selected").val();
        var data2 = {
            'tukhoa': search,
            'gia': price,
            'loai': cat,
            'hang': brand
        }
        $.ajax({
            type: 'get',
            url: '/locsp',
            data: data2,
            success: function (response) {
                $('#item-lists').html(response);
            }
        });
    });
});
// Chuyển trang tìm kiếm theo loại
function searchByCatagory(page) {
    search = $('#search').val();
    price = $('#priceRange').val();
    cat = $('#catagoryProduct').find(":selected").val();
    brand = $('#brandsProduct').find(":selected").val();
    var data2 = {
        'tukhoa': search,
        'gia': price,
        'loai': cat,
        'hang': brand
    }
    $.ajax({
        type: 'get',
        url: '/locsp?page=' + page,
        data: data2,
        success: function (response) {
            $('#item-lists').html(response);
        }
    });
}
//load trái cây theo hãng
$(document).ready(function () {
    $('#brandsProduct').on('change select', function () {
        search_key = false;
        search_price = false;
        search_catagory = false;
        search_brand = true;
        //search_mode = false;
        //search_PriceToPrice = false;
        //
        search = $('#search').val();
        price = $('#priceRange').val();
        cat = $('#catagoryProduct').find(":selected").val();
        brand = $(this).find(":selected").val();
        var data2 = {
            'tukhoa': search,
            'gia': price,
            'loai': cat,
            'hang': brand
        }
        $.ajax({
            type: 'get',
            url: '/locsp',
            data: data2,
            success: function (response) {
                $('#item-lists').html(response);
            }
        });
    });
});
//Chuyển trang tìm kiếm theo hãng
function searchByBrand(page) {
    search = $('#search').val();
    price = $('#priceRange').val();
    cat = $('#catagoryProduct').find(":selected").val();
    brand = $('#brandsProduct').find(":selected").val();
    var data2 = {
        'tukhoa': search,
        'gia': price,
        'loai': cat,
        'hang': brand
    }
    $.ajax({
        type: 'get',
        url: '/locsp?page=' + page,
        data: data2,
        success: function (response) {
            $('#item-lists').html(response);
        }
    });
}
// loc theo che do xem
$(document).ready(function () {
    $('#viewMode').on('change select', function () {
        search_key = false;
        search_price = false;
        search_catagory = true;
        search_brand = false;
        // search_PriceToPrice = false;
        search_mode = true;
        //
        // search = $('#search').val();
        // price = $('#priceRange').val();
        // cat = $('#catagoryProduct').find(":selected").val();
        // brand = $('#brandsProduct').find(":selected").val();
        mode = $(this).find(":selected").val();
        var data2 = {
            // 'tukhoa': search,
            // 'gia': price,
            // 'loai': cat,
            // 'hang': brand,
            'chedo': mode
        }
        $.ajax({
            type: 'get',
            url: '/locsp2',
            data: data2,
            success: function (response) {
                $('#item-lists').html(response);
            }
        });
    });
});
//chuyen trang theo che do xem
function searchBymode(page) {
    // search = $('#search').val();
    // price = $('#priceRange').val();
    // cat = $('#catagoryProduct').find(":selected").val();
    // brand = $('#brandsProduct').find(":selected").val();
    mode = $('#viewMode').find(":selected").val();
    var data2 = {
        // 'tukhoa': search,
        // 'gia': price,
        // 'loai': cat,
        // 'hang': brand,
        'chedo': mode
    }
    $.ajax({
        type: 'get',
        url: '/locsp2?page=' + page,
        data: data2,
        success: function (response) {
            $('#item-lists').html(response);
        }
    });
}
//Chuyển trang
$(document).ready(function () {
    $(document).on("click", ".pagination a", function (event) {
        if (search_key == true) {
            event.preventDefault();
            var page = $(this).attr("href").split("page=")[1];
            searchBykey(page);
        }
        else if (search_price == true) {
            event.preventDefault();
            var page = $(this).attr("href").split("page=")[1];
            searchByprice(page);
        }
        else if (search_catagory == true) {
            event.preventDefault();
            var page = $(this).attr("href").split("page=")[1];
            searchByCatagory(page);
        }
        else if (search_brand == true) {
            event.preventDefault();
            var page = $(this).attr("href").split("page=")[1];
            searchByBrand(page);
        }
        // else if (search_PriceToPrice == true) {
        //     event.preventDefault();
        //     var page = $(this).attr("href").split("page=")[1];
        //     searchByPriceToPrice(page);
        // }
        else if (search_mode == true) {
            event.preventDefault();
            var page = $(this).attr("href").split("page=")[1];
            searchBymode(page);
        }
    });
});
//Them 1 san pham vao gio hang-cart popup
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