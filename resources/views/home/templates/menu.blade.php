<div class="menu">
    <div class="wrap-content">
        <ul class="menu-main">
            <li><a class="<?php if (request()->route()->getName() == "home") {
                                echo "active";
                            } ?>" href="home">Trang
                    chủ</a></li>
            <li><a class="<?php if (request()->route()->getName() == "gioithieu") {
                                echo "active";
                            } ?>" href="gioithieu">Giới thiệu</a></li>
            <li><a class="<?php if (request()->route()->getName() == "gioqua_home") {
                                echo "active";
                            } ?>" href="/gioqua_home">Giỏ quà</a>
                <ul>
                    <?php foreach ($loaigqs as $row) { ?>
                    <li>
                        <a href=""><?= $row->TenLoai ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a class="<?php if (request()->route()->getName() == "shop") {
                                echo "active";
                            } ?>" href="shop">
                    Trái cây
                </a>
                <ul>
                    <?php foreach ($loaitcs as $row) { ?>
                    <li>
                        <a href=""><?= $row->TenLoai ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </li>
            <li><a class="<?php if (request()->route()->getName() == "tintuc") {
                                echo "active";
                            } ?>" href="tintuc">Tin
                    tức</a></li>
            <li><a class="<?php if (request()->route()->getName() == "contact") {
                                echo "active";
                            } ?>" href="contact">Liên
                    hệ</a></li>
            <li><a class="<?php if (request()->route()->getName() == "login") {
                                echo "active";
                            } ?>" href="login">Đăng
                    nhập</a></li>
        </ul>
    </div>
</div>