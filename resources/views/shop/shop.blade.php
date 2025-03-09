<!DOCTYPE html>
<html lang="en" id="page">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="css/home.css" />
    <link rel="stylesheet" type="text/css" href="css/cart-popup.css" />
</head>

<body>
    @include("home/templates/header")
    @include("home/templates/menu")
    <div class="bao-noidung">
        <div class="filter-product">
            <div class="filter-product-top flex align-items-center">
                <div class="catagory-product mr-4">
                    <form action="#" method="get">
                        <select name="select" id="catagoryProduct">
                            <option value="catagory">Loại Trái Cây</option>
                            @foreach($cats as $row)
                            <option value="{{$row->MaLoai}}">{{$row->TenLoai}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="brands-product mr-4">
                    <form action="#" method="get">
                        <select name="select" id="brandsProduct">
                            <option value="brands">Nhà Cung Cấp</option>
                            @foreach($brand as $row)
                            <option value="{{$row->MaNcc}}">{{$row->TenNcc}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="price-nb">
                    <div class=""><span>Giá:</span><span id="price-count"></span><u>đ</u></div>
                    <input type="range" min="1" max="1000" value="500" class="price-slider" id="priceRange">
                </div>
                <div class="view-product d-flex align-items-center mr-4 ml-4">
                    <form action="#" method="get">
                        <select name="select" id="viewMode">
                            <option value="normal">Chế độ xem</option>
                            <option value="mostviews">Lượt xem nhiều nhất</option>
                            <option value="bestselling">Bán chạy</option>
                            <option value="sale">Giảm giá</option>
                        </select>
                    </form>
                </div>
                <div class="search-wrapper section-padding-100">
                    <div class="search-content">
                        <input type="search" name="search" id="search" placeholder="Nhập từ khóa...">
                        <div class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="session-message">

        </div>
        <div id="item-lists">
            <?php $arr=array();$soluongcon=array();  ?>
            @include('shop/data')
        </div>
    </div>

    <div class="btn-cart-popup btn-frame">
        <a class="text-decoration-none" id="cart-icon" href="javascript:show_hide(0);">
            <div class="animated infinite zoomIn kenit-alo-circle"></div>
            <div class="animated infinite pulse kenit-alo-circle-fill"></div>
            <span class='badge badge-warning' id='lblCartCount'>{{$count}}</span>
            <i class="fa" style="font-size:24px;color:black;background-color:#4eecb5;">&#xf07a;</i>
        </a>
        <div id="cart-popup">
            <div id="cart-popup2">
                <?php $arr=array();$soluongcon=array();  ?>
                @foreach($cart as $row)
                @php
                array_push($arr,$row->MaTraiCay);
                array_push($soluongcon,$row->SoLuong);
                @endphp
                @endforeach
                @include('cart/cart-popup')
                <?php $jsonArray = json_encode($arr); $jsonArray2=json_encode($soluongcon);?>
            </div>
        </div>
    </div>
    @include('footer2')
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/products.js"></script>
    <script src="bootstrap/bootstrap.js"></script>
    @include('inputQuatity')
    <script>
    //An hien cart-popup
    function show_hide(n) {
        if (n == 0) {
            document.getElementById('cart-popup').style.display = "block";
            document.getElementById('cart-icon').style.display = "none";

        } else {
            document.getElementById('cart-popup').style.display = "none";
            document.getElementById('cart-icon').style.display = "block";
        }
    }
    // Thanh kéo giá sản phẩm
    var price = document.getElementById("priceRange");
    var output = document.getElementById("price-count");
    output.innerHTML = price.value;
    price.oninput = function() {
        output.innerHTML = this.value;
    }
    </script>

</body>

</html>