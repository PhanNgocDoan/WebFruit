$(document).ready(function () {
    $(".slick-sanpham").slick({
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        vertical: false,
        infinite: false,
        autoplay: false,
        autoplaySpeed: 1000,
        arrows: false,
    });
    $(".list-desc-sliders").slick({
        slidesToShow: 4,
        asNavFor: ".list-img-sliders",
        focusOnSelect: true,
        arrows: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
    });
    $(".list-img-sliders").slick({
        slidesToShow: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
        fade: true,
        dots: false,
        infinite: true,
        asNavFor: ".list-desc-sliders",
    });
    $(".slick-list-poster").slick({
        slidesToShow: 3,
        centerPadding: 100,
        centerMode: true,
        focusOnSelect: true,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        infinite: true,
        responsive: [
            { breakpoint: 1200, settings: { slidesToShow: 3 } },
            { breakpoint: 993, settings: { slidesToShow: 3 } },
            {
                breakpoint: 770,
                settings: { slidesToShow: 2, centerMode: false },
            },
            {
                breakpoint: 580,
                settings: { slidesToShow: 2, centerMode: false },
            },
        ],
    });
});

function routeTogioquaid(id) {
    $.ajax({
        url: "getgioquaid" + id,
        dataType: "html",
        type: "get",
        data: id,
        success: function (response) {
            $(".noidung").html(response);
        },
    });
}
function routeTogioqua() {
    event.preventDefault();
    const CSRF_TOKEN = $('meta[name="csrf_token"]').attr("content");
    $.ajax({
        url: "gioqua",
        type: "GET",
        data: {
            CSRF_TOKEN,
        },
        success: function (data) {
            $(".noidung").html(data);
        },
    });
}

$(document).ready(function () {
    $(".slider-thongke").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1, // Hiển thị 1 item ở màn hình nhỏ
            },
            600: {
                items: 3, // Hiển thị 3 item ở màn hình trung bình
            },
            1000: {
                items: 4, // Hiển thị 5 item ở màn hình lớn
            },
        },
    });
});


$('.loai-tag').click(function (e) {
    e.preventDefault();
    var id = $(this).data('loai-id');
    $.ajax({
        url: '/danhmucsp/' + id,
        method: 'GET',
        success: function (data) {
            $(".noidung-tag-sp").html(data);
        },
    });
});
$(window).bind("load", function () {
    var api = $(".peShiner").peShiner({
        api: true,
        paused: true,
        reverse: true,
        repeat: 1,
        color: "oceanHL",
    });

    api.resume();

});