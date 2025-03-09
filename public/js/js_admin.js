$(document).ready(function () {
    $(".ul-sp-c1 .icon-add").click(function () {
        $(this).parent("li").children(".ul-sp-c2").slideToggle();
        $(this).toggleClass("fa-chevron-down fa-chevron-right");
        $(".no-active").addClass("cd");
    });
});
function routeToHome_test() {
    event.preventDefault();
    const CSRF_TOKEN = $('meta[name="csrf_token"]').attr("content");
    $.ajax({
        url: "/gethometest",
        type: "GET",
        data: {
            CSRF_TOKEN,
        },
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}
function routeToHome_test2() {
    event.preventDefault();
    const CSRF_TOKEN = $('meta[name="csrf_token"]').attr("content");
    $.ajax({
        url: "/gethometest2",
        type: "GET",
        data: {
            CSRF_TOKEN,
        },
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}
function routeTodashboard() {
    event.preventDefault();
    const CSRF_TOKEN = $('meta[name="csrf_token"]').attr("content");
    $.ajax({
        url: "/getdashboard",
        type: "GET",
        data: {
            CSRF_TOKEN,
        },
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}
function routeTodonhang() {
    event.preventDefault();
    const CSRF_TOKEN = $('meta[name="csrf_token"]').attr("content");
    $.ajax({
        url: "/getdonhang",
        type: "GET",
        data: {
            CSRF_TOKEN,
        },
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}
function routeToctdonhang() {
    event.preventDefault();
    const CSRF_TOKEN = $('meta[name="csrf_token"]').attr("content");
    $.ajax({
        url: "/getctdonhang",
        type: "GET",
        data: {
            CSRF_TOKEN,
        },
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctsanphamid(id) {
    $.ajax({
        url: "getctsanphamid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}
function routeToctsanpham() {
    event.preventDefault();
    const CSRF_TOKEN = $('meta[name="csrf_token"]').attr("content");
    $.ajax({
        url: "getctsanpham",
        type: "GET",
        data: {
            CSRF_TOKEN,
        },
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}
// function routeToinsertsanpham() {
//     var tentraicay = document.getElementById("tentraicay").value;
//     var mota = document.getElementById("motatraicay").value;
//     var hinha = document.getElementById("inputImage").value;

//     var data3 = {
//         'tentraicay': tentraicay,
//         'mota': mota,
//         'hinha':hinha,
//     };
//     $.ajax({
//         type: "get",
//         dataType: "html",
//         url: "insertsp",
//         data: data3,
//         success: function (response) {
//              $(".noidung").html(response);

//         },
//     });
// }

function routeTodeletesanpham(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deletesp" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}

// Bài viết

function routeToctbaiviet() {
    $.ajax({
        url: "getctbaiviet",
        type: "GET",
        data: {},
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctbaivietid(id) {
    $.ajax({
        url: "getctbaivietid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeletebaiviet(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deletebaiviet" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}

//Đơn hàng

function routeTocthoadonid(id) {
    $.ajax({
        url: "getcthoadonid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

//Biểu đồ
$(document).ready(function () {
    $("#yeartk").on("change select", function () {
        var year = $(this).find(":selected").val();
        var type = $("#dangbieudo").find(":selected").val();
        var data3 = {
            year: year,
            type: type
        };
        $.ajax({
            type: "get",
            url: "/selectchart",
            data: data3,
            success: function (response) {
                $(".noidung-chart").html(response);
            },
        });
    });
});
// đổi dạng biểu đồ
$(document).ready(function () {
    $("#dangbieudo").on("change select", function () {
        var type = $(this).find(":selected").val();
        var year = $("#yeartk").find(":selected").val();
        var data3 = {
            year: year,
            type: type
        };
        $.ajax({
            type: "get",
            url: "/selectchart",
            data: data3,
            success: function (response) {
                $(".noidung-chart").html(response);
            },
        });
    });
});
// tìm kiếm tự động

//Thêm dòng input

var isRequesting = false;

function addinput() {
    if (!isRequesting) {
        isRequesting = true;
        var elements = document.getElementsByClassName('nhapHang');
        var mainput = elements.length;
        mainput++;
        $.ajax({
            url: "addinput",
            type: "GET",
            data: { mainput: mainput },
            success: function (response) {
                $(".noidung-add").append(response);
                isRequesting = false;
            },
            complete: function () {
                isRequesting = false;
            }
        });
    }
}
var isDeleting = false;

function deleteinput() {
    if (!isDeleting) {
        isDeleting = true;
        var elements = document.getElementsByClassName('nhapHang2');
        var mainput = elements.length;
        mainput--;
        $.ajax({
            url: "deleteinput",
            type: "GET",
            data: { mainput: mainput },
            success: function (response) {
                $(".nhapHang2:last-child").remove();
            },
            complete: function () {
                isDeleting = false; // Thiết lập lại cờ sau khi hoàn thành request AJAX
            }
        });

    }
}

//Nhập hàng


function routeToaddnhaphang() {
    $.ajax({
        url: "addnhaphang",
        type: "GET",
        data: {},
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeToctnhaphangid(id) {
    $.ajax({
        url: "getctnhaphangid" + id,
        dataType: "html",
        type: "get",

        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeletenhaphang(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deletenhaphang" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}
function routeTodeletespnhaphang(id, id2) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    alert(id + '/' + id2);
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "xoaspnhaphang" + id + "/" + id2,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}
//Hình ảnh video

function routeToctalbum(loai) {
    $.ajax({
        url: "getctalbum",
        type: "GET",
        data: { loai: loai },
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctalbumid(id, loai) {
    $.ajax({
        url: "getctalbumid" + id,
        dataType: "html",
        type: "get",
        data: { loai: loai },
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeletealbum(id, loai) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deletealbum" + id + loai,
                        data: { loai: loai },
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}

//Tài khoản

function routeToctaccount() {
    $.ajax({
        url: "getctaccount",
        type: "GET",
        data: {},
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctaccountid(id) {
    $.ajax({
        url: "getctaccountid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeleteaccount(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deleteaccount" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}

//galliry
function routeTodeletegallery(id, loai, idsp) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "/deletegallery/" + id + "/" + loai + "/" + idsp,
                        success: function (response) {
                            $(".data-gallery").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}

//loại trai cây
function routeToctloaisp() {
    $.ajax({
        url: "getctloaisp",
        type: "GET",
        data: {},
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctloaispid(id) {
    $.ajax({
        url: "getctloaispid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeleteloaisp(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deleteloaisp" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}

//loại trái cây
function routeToctloaigioqua() {
    $.ajax({
        url: "getctloaigioqua",
        type: "GET",
        data: {},
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctloaigioquaid(id) {
    $.ajax({
        url: "getctloaigioquaid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeleteloaigioqua(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deleteloaigioqua" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}
//Nhà cung cấp
function routeToctnhacungcap() {
    $.ajax({
        url: "getctnhacungcap",
        type: "GET",
        data: {},
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctnhacungcapid(id) {
    $.ajax({
        url: "getctnhacungcapid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeletenhacungcap(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deletenhacungcap" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}
//Đơn vị sản phẩm
function routeToctdonvisp() {
    $.ajax({
        url: "getctdonvisp",
        type: "GET",
        data: {},
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctdonvispid(id) {
    $.ajax({
        url: "getctdonvispid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeletedonvisp(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deletedonvisp" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}

//Bài viết

function routeToctbaiviet(loai) {
    $.ajax({
        url: "getctbaiviet",
        type: "GET",
        data: { loai: loai },
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctbaivietid(id, loai) {
    $.ajax({
        url: "getctbaivietid" + id,
        dataType: "html",
        type: "get",
        data: { loai: loai },
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeletebaiviet(id, loai) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deletebaiviet" + id + loai,
                        data: { loai: loai },
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}
//Giỏ quà

function routeToctgioqua() {
    $.ajax({
        url: "getctgioqua",
        type: "GET",
        data: {},
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctgioquaid(id) {
    $.ajax({
        url: "getctgioquaid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeletegioqua(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deletegioqua" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}
//Bảng giá
function routeToctbanggia() {
    $.ajax({
        url: "getctbanggia",
        type: "GET",
        data: {},
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

function routeToctbanggiaid(id) {
    $.ajax({
        url: "getctbanggiaid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}

function routeTodeletebanggia(id) {
    $.confirm({
        title: "Xác nhận!",
        content: "Bạn có chắc chắn muốn Xóa không?",
        buttons: {
            confirm: {
                text: "Đồng ý",
                btnClass: "btn-blue",
                action: function () {
                    $.ajax({
                        type: "get",
                        dataType: "html",
                        url: "deletebanggia" + id,
                        data: id,
                        success: function (response) {
                            $(".noidung").html(response);
                        },
                    });
                },
            },
            cancel: {
                text: "Hủy bỏ",
                btnClass: "btn-red",
            },
        },
    });
}
function displaySelectedImage(event) {
    let input = event.target;
    let imgElement = document.getElementById('selectedImage');

    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function (e) {
            imgElement.style.display = 'block';
            imgElement.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function displaySelectedImage2(event) {
    const container = document.querySelector('.data-gallery');
    const files = event.target.files;

    if (files && files.length > 0) {
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            const imgElement = document.createElement('img');

            reader.onload = function (e) {
                imgElement.src = e.target.result;
                imgElement.style.width = '200px';
                imgElement.style.height = '200px';
                imgElement.style.objectFit = 'cover';
                container.appendChild(imgElement);
            };

            reader.readAsDataURL(files[i]);
        }
    }
}   