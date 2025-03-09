<!DOCTYPE html>
<html lang="en">

<head>
    @include("home/templates/head")
    @include("home/templates/css")
</head>

<body>
    @include("home/templates/header")
    @include("home/templates/menu")
    <?php if (count($sliders)) { ?>
    <div class="sliders-nb ">
        <div class="sliders">
            <div class="  list-img-sliders">
                @foreach($sliders as $row)
                <div class="img-sliders">
                    <img src="images/album/{{$row->HinhAnh}}" alt="">
                    <div class="noidung-sliders">
                        <span>Website Trái cây</span>
                        <span>{{$row->TieuDe}}</span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="list-desc-sliders">
                <?php foreach ($sliders as $key => $row) {
                        if ($key < 10) {
                            $key++;
                            $key = "0" . $key;
                    ?>
                <div class="desc-sliders">
                    <div class="name-sliders">
                        <span><?= $key ?></span>
                        <span><?= $row->TieuDe ?></span>
                    </div>
                </div>
                <?php }
                    } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="san-phan-nb padding-45-50">
        <div class="wrap-content">
            <div class="title-mau1">
                <h3>Sản phẩm được xem nhiều</h3>
            </div>
            <div class="slick-sanpham text-center">
                @foreach($traicays as $row)
                <div class="item-sanpham">
                    <div class="container-sanphan">
                        <div class="img-sanpham scale-img">
                            <img src="images/sanpham/{{$row->Anh}}" alt="">
                        </div>
                        <a class="name-sanpham text-decoration-none" href="ct{{$row->MaTraiCay}}">
                            <h3>{{$row->TenTraiCay}}</h3>
                        </a>
                        <div class="price-sanpham">
                            @if($row->GiaBan===null)
                            <p><span class="product-price">{{$row->GiaGoc}}.000<u>đ</u></span> /{{$row->TenDonVi}}</p>
                            @else
                            <p><span class="product-price">{{$row->GiaBan}}.000<u>đ</u></span> /{{$row->TenDonVi}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="banner-qc-nb text-center">
        @foreach($banners as $row)
        <img src="images/album/{{$row->HinhAnh}}" alt="">
        @endforeach
    </div>
    <div class="statistical-nb">
        <div class="wrap-content ">
            <div class="container-statistical text-center">
                <div class="owl-carousel slider-thongke">
                    <div class="item-statistical text-split ">
                        <img src="images/tk.png" alt="">
                        <div class="statistical-name">
                            <span>+</span>
                            <a class='numscroller text-decoration-none' data-min='1' data-max='1000' data-delay='100'
                                data-increment='10' title="">1000</a>
                        </div>
                        <div class="desc-statistical">
                            <span>Nhân viên</span>
                        </div>
                    </div>
                    <div class="item-statistical text-split ">
                        <img src="images/tk2.png" alt="">
                        <div class="statistical-name">
                            <span>+</span>
                            <a class='numscroller text-decoration-none' data-min='1' data-max='1000' data-delay='50'
                                data-increment='10' title="">1000</a>
                        </div>
                        <div class="desc-statistical">
                            <span>Nhân viên</span>
                        </div>
                    </div>
                    <div class="item-statistical text-split ">
                        <img src="images/tk4.png" alt="">
                        <div class="statistical-name">
                            <span>+</span>
                            <a class='numscroller text-decoration-none' data-min='1' data-max='1000' data-delay='50'
                                data-increment='10' title="">1000</a>
                        </div>
                        <div class="desc-statistical">
                            <span>Nhân viên</span>
                        </div>
                    </div>
                    <div class="item-statistical text-split ">
                        <img src="images/tk3.png" alt="">
                        <div class="statistical-name">
                            <span>+</span>
                            <a class='numscroller text-decoration-none' data-min='1' data-max='1000' data-delay='50'
                                data-increment='10' title="">1000</a>
                        </div>
                        <div class="desc-statistical">
                            <span>Nhân viên</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tag-dm-sanpham">
        <div class="wrap-content">
            <div class="title-mau1">
                <h3>Danh mục sản phẩm</h3>
            </div>
            <div class="tag-menusp ">
                @foreach($loaitcs as $row)
                <button type="button" class="btn btn-success loai-tag" data-loai-id="tc{{$row->MaLoai}}">
                    {{ $row->TenLoai }}
                </button>
                @endforeach
                @foreach($loaigqs as $row)
                <button type="button" class="btn btn-success loai-tag" data-loai-id="gq{{$row->MaLoai}}">
                    {{ $row->TenLoai }}
                </button>
                @endforeach
            </div>
            <div class="noidung-tag-sp">
                @include("data_danhmucsp")
            </div>
        </div>
    </div>

    <?php if (count($tintucs)) { ?>
    <div class="posternd">
        <div class="wrap-content">
            <div class="title-mau1">
                <h3>Bài viết nóng hổi</h3>
            </div>
            <div class="list-poster ">
                <div class="slick-list-poster">
                    <?php foreach ($tintucs as $row) { ?>
                    <div class="item-poster">
                        <div class="bao-poster">
                            <div class="poster-img-date">
                                <div class="poster-img">
                                    <a class="scale-img" href="tintuc{{$row->MaBaiViet}}" title="<?= $row->TieuDe ?>">
                                        <img src="/images/baiviet/<?= $row->Anh ?>" alt="">
                                    </a>
                                </div>
                                <div class="poster-date">
                                    <span class=" text-split"> <?= date("d", strtotime($row->NgayDang)) ?></span>
                                    <span><?= date("M", strtotime($row->NgayDang)) ?></span>
                                </div>
                            </div>
                            <div class="poster-dsc">
                                <span class="text-split">
                                    <?= $row->MoTa ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    @include("home/templates/footer")
    @include("home/templates/js")
</body>

</html>