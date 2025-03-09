<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include("admin/templates/css")
    @include("admin/templates/js")
</head>

<body>
    <div class="bao-noidung">
        <div class="timkiemsp">
            <input type="text" id="searchInput" placeholder="Nhập từ khóa tìm kiếm">
        </div>
        <div class="container-admin">
            @include("admin/templates/menu")
            <div class="noidung">
                @include("admin/templates/traicay/data_sanpham")
            </div>
        </div>
    </div>
    <script>
        var loadsearchsp = false;

        function routeTosanpham(page) {
            $.ajax({
                url: "/sanpham/ajax?page=" + page,
                success: function(data) {
                    $(".noidung").html(data);
                },
            });
        }

        $(document).ready(function() {
            $("#searchInput").on("input", function() {
                loadsearchsp = true;

                var keyword = $(this).val();
                data2 = {
                    'keyword': keyword
                }
                $.ajax({
                    type: "GET",
                    url: "/searchsanpham",
                    data: data2,
                    success: function(response) {
                        $(".noidung").html(response);
                    },
                });
            });
        });

        function routeTosearchsp(page) {
            var keyword = $("#searchInput").val();
            data2 = {
                'keyword': keyword
            }
            $.ajax({
                type: "GET",
                url: "/searchsanpham?page=" + page,
                data: data2,
                success: function(data) {
                    $(".noidung").html(data);
                },
            });
        }

        $(document).ready(function() {
            $(document).on("click", ".pagination a", function(event) {
                if (loadsearchsp == true) {
                    event.preventDefault();
                    var page = $(this).attr("href").split("page=")[1];
                    routeTosearchsp(page);
                } else {
                    event.preventDefault();
                    var page = $(this).attr("href").split("page=")[1];
                    routeTosanpham(page);
                }
            });
        });
    </script>
</body>

</html>