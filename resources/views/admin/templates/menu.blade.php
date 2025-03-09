<div class="menu-dieuhuong">
    <div class="flex align-items-center justify-content-between mb-3">
        <a target="_blank" href="home" class="d-block "><i class="fa-solid fa-house"></i></a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Đăng Xuất</button>
        </form>
    </div>
    <div class="danhmuc-sp-tt">
        <a class="" href="san-pham" title="Bảng điều khiển">Bảng điều khiển</a>
        <ul class="ul-sp-c1">
            <li>
                <a class="" href="/getdashboard" onclick="">Dashboard</a>
            </li>
            <li class="">
                <a href="/sanpham">Quản lý Sản phẩm</a>
                <i class=" icon-add fas fa-caret-down"></i>
                <ul class="ul-sp-c2">
                    <li>
                        <a href="/sanpham">Trái cây</a>
                    </li>
                    <li>
                        <a href="/loaisp">Loại Trái cây</a>
                    </li>
                    <li>
                        <a href="/loaigioqua">Loại giỏ quà</a>
                    </li>
                    <li>
                        <a href="/nhacungcap">Nhà cung cấp</a>
                    </li>
                    <li>
                        <a href="/donvisp">Đơn vị</a>
                    </li>
                    <li>
                        <a href="/gioqua">Giỏ quà</a>
                    </li>
                    <li>
                        <a href="/banggia">Bảng giá</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a>Quản lý Bài viết</a>
                <i class=" icon-add fas fa-caret-down"></i>
                <ul class="ul-sp-c2">
                    <li>
                        <a href="baiviet-tintuc">Tin tức</a>
                    </li>
                    <li>
                        <a href="baiviet-tieuchi">Tiêu chí</a>
                    </li>
                    <li>
                        <a href="baiviets-gioithieu">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="baiviets-lienhe">Liên hệ</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="" href="/hoadon">Đơn hàng</a>
            </li>
            <li>
                <a class="" href="/nhaphang">Nhập hàng</a>
            </li>
            <li>
                <a class="">Hình ảnh và video</a>
                <i class=" icon-add fas fa-caret-down"></i>
                <ul class="ul-sp-c2">
                    <li>
                        <a href="/albums-logo">Logo</a>
                    </li>
                    <li>
                        <a href="/albums-banner">Banner</a>
                    </li>
                    <li>
                        <a href="/albums-falcon">falcon</a>
                    </li>
                    <li>
                        <a href="album-slider">Slider</a>
                    </li>
                    <li>
                        <a href="album-socal">Socal</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="" href="/account">Tài Khoản</a>
            </li>
        </ul>
    </div>
</div>