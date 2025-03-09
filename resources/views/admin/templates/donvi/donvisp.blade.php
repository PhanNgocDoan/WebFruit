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
        <div class="container-admin">
            @include("admin/templates/menu")
            <div class="noidung">
                @include("admin/templates/donvi/data_donvisp")
            </div>

        </div>
    </div>
    <script>
        function routeTodonvisp(page) {
            $.ajax({
                url: "/donvisp/ajax?page=" + page,
                success: function(data) {
                    $(".noidung").html(data);
                },
            });
        }
        $(document).ready(function() {
            $(document).on("click", ".pagination a", function(event) {
                event.preventDefault();
                var page = $(this).attr("href").split("page=")[1];
                routeTodonvisp(page);
            });
        });
    </script>
</body>

</html>