<!DOCTYPE html>
<html lang="en">

<head>
    @include("home/templates/head")
    @include("home/templates/css")
    <?php

    use Intervention\Image\Facades\Image; ?>
</head>

<body>
    @include("home/templates/header")
    @include("home/templates/menu")
    @include("home/templates/breadcrumb")
    <div class="wrap-home ">
        <div class="wrap-content">
            <div class="title-trangtrong">
                <h3>Tin Tức</h3>
            </div>
            <div class="content-main grid-2 padding-20">
                <?php if (!empty($tintucs)) { ?>
                    <?php foreach ($tintucs as $row) { ?>
                        <div class="news">
                            <div class="container-tintuctt">
                                <a class="scale-img img-tintuctt" href="tintuc{{$row->MaBaiViet}}" title="<?= $row->TieuDe ?>">
                                    <img src="{{ Image::make(public_path('images/baiviet/' . $row->Anh))->resize(160, 120)->encode('data-url') }}" alt="">
                                </a>
                                <div class="noidung-tintuctt">
                                    <a class="name-tintuctt" href="tintuc<?= $row->MaBaiViet ?>" title="<?= $row->TieuDe ?>">
                                        <span><?= $row->TieuDe ?></span>
                                    </a>
                                    <span></span>
                                    <p class="tintuctt-time">Ngày đăng: <?= date("d/m/Y", strtotime($row->NgayDang)) ?></p>
                                    <div class="tintuctt-desc text-split"><?= $row->MoTa ?></div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
    @include("home/templates/footer")
    @include("home/templates/js")
</body>

</html>