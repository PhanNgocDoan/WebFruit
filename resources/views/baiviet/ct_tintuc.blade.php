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
            <?php if (count($tintucs)) { ?>
                <?php foreach ($tintucs as $row) { ?>
                    <div class="title-trangtrong">
                        <h3>{{$row->TieuDe}}</h3>
                    </div>
                    <div class="noidung-tintuc">
                        <span>{!! $row->NoiDung !!}</span>
                    </div>

                <?php } ?>
            <?php } ?>
            <div class="tintuc-cungloai">
                <div class="title-tintuccl">
                    <h3>Tin tức khác: </h3>
                </div>
                <?php if (count($tintuccls)) { ?>
                    <ul class="list-tintuccl">
                        <?php foreach ($tintuccls as $row) { ?>
                            <li>
                                <a class="name-tintuccl" href="tintuc<?= $row->MaBaiViet ?>" title="<?= $row->TieuDe ?>">
                                    <span><?= $row->TieuDe ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </div>
    @include("home/templates/footer")
    @include("home/templates/js")
</body>

</html>