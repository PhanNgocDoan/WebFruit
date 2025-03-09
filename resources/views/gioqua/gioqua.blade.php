<!DOCTYPE html>
<html lang="en">

<head>
    @include("home/templates/head")
    @include("home/templates/css")
</head>

<body>
    @include("home/templates/header")
    @include("home/templates/menu")
    @include("home/templates/breadcrumb")
    <div class="bao-noidung">
        <div class="wrap-home">
            <div class="wrap-content">
                <div class="noidung">
                    @include("gioqua/gioqua_data")
                </div>
            </div>
        </div>
    </div>
    @include("home/templates/footer")
    @include("home/templates/js")
    <script>
    function routeTogioqua(page) {
        $.ajax({
            url: "/gioqua_home?page=" + page,
            success: function(data) {
                $(".noidung").html(data);
            },
        });
    }
    $(document).ready(function() {
        $(document).on("click", ".pagination a", function(event) {
            event.preventDefault();
            var page = $(this).attr("href").split("page=")[1];
            routeTogioqua(page);
        });
    });
    </script>
</body>

</html>