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
    <div class="wrap-home ">
        <div class="wrap-content">
            <?php if (count($gioithieus)) { ?>
                <?php foreach ($gioithieus as $row) { ?>
                    <div class="title-trangtrong">
                        <h3>Giới thiệu</h3>
                    </div>
                    <div class="noidung-tintuc">
                        <span>{!! $row->NoiDung !!}</span>
                    </div>

                <?php } ?>
            <?php } ?>
        </div>
    </div>
    @include("home/templates/footer")
    @include("home/templates/js")
</body>

</html>