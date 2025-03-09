<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="magiczoomplus/magiczoomplus.css">
    <link rel="stylesheet" href="css/style_home.css">
    <link rel="stylesheet" href="css/cart-popup.css">
    <link rel="stylesheet" type="text/css" href="css/animate.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="css/home.css" />
    <title>TD Shop | Chi tiết</title>
</head>

<body>
    @include("home/templates/header")
    @include("home/templates/menu")
    <br>
    <div class="session-message">

    </div>
    <br>
    <div class="wap-content">
        <div class="container-ct-product">
            <div class="img-ct-product">
                <div class="product-deail">
                    @foreach($product as $row)
                    <div class="img-active">
                        <a href="images/sanpham/{{$row->Anh}}" id="Zoom-1" class="MagicZoom"
                            data-options="zoomMode: true; hint: true; rightClick: true; selectorTrigger: hover; expandCaption: fasle; history: fasle;">
                            <img src="images/sanpham/{{$row->Anh}}" alt="">
                        </a>
                        @php $idsp=$row->MaTraiCay; @endphp
                    </div>
                    @endforeach
                </div>
                <div class="product-galary mt-3">
                    @foreach($gallery as $row)
                    <div style="width:100px;height: 100px;">
                        <a class="thumb-pro-detail" data-zoom-id="Zoom-1" href="images/gallery/{{$row->Anh}}">
                            <img src="images/gallery/{{$row->Anh}}"></a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="product_desc">
                @foreach($product as $row)
                <h3 class="name-product-ct">
                    {{$row->TenTraiCay}}
                </h3><br>
                @if($row->ChietKhau === null)
                <span class="price-product-ct"><b>Giá: </b><span>{{$row->GiaGoc}}.000<u>đ</u>
                    </span> /{{$row->TenDonVi}}</span><br><br>
                @elseif($row->ChietKhau>0)
                <div style="display:flex;">
                    <div><span class="price-product-ct"><b>Giá gốc: </b><span><s>{{$row->GiaGoc}}.000<u>đ</u></s>
                            </span> /{{$row->TenDonVi}}</span></div>
                    <div class="rotateDiscount">Giảm {{$row->ChietKhau}}%</div>
                    <br><br>
                </div>
                <span class="price-product-ct"><b>Giá sau khi giảm:</b>
                    <span>{{$row->GiaBan}}.000<u>đ</u>
                    </span> /{{$row->TenDonVi}}</span><br><br>
                @else
                <span class="price-product-ct"><b>Giá: </b><span>{{$row->GiaBan}}.000<u>đ</u>
                    </span> /{{$row->TenDonVi}}</span><br><br>
                @endif
                <span><b>Tình Trạng:</b>@if($row->TinhTrang==1)<span> Còn
                        hàng</span>@else<span style="color:red;"> Hết hàng</span>@endif</span>
                <div class="cart-btn d-flex mb-3 mt-3 align-items-center">
                    <span><b>Số lượng:</b></span>
                    <div class="quantity ml-2">
                        <span class="qty-minus"
                            onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                class="fa fa-caret-down" aria-hidden="true"></i></span>
                        <input class="qty-text" id="qty" step="1" min="1" max="{{$row->SoLuong}}" name="quantity"
                            value="1" disabled style="background-color:white;border: 1px solid black;color:black">
                        <span class="qty-plus"
                            onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                class="fa fa-caret-up" aria-hidden="true"></i></span>
                    </div>
                </div>
                <div><b>Lượt xem:</b> {{$row->LuotXem}}</div>
                <hr>
                <button name="addtocart" onclick="addcart({{$row->MaTraiCay}})" class="btn btn-success">
                    <i class="fas fa-shopping-bag mr-1"></i>
                    <span>Thêm vào giỏ hàng</span></button>
                <a class="btn btn-dark" href="gio-hang">
                    <i class="fas fa-shopping-bag mr-1"></i>
                    <span>Mua ngay</span>
                </a>
                <div class="mota-product-ct mt-3">
                    <b>Mô Tả:</b> {{$row->MoTa}}
                </div>
                @endforeach
            </div>
        </div>
        <div class="product-cung-loai">
            <div class="title-product-cungloai">
                <span>Sản phẩm cùng loại</span>
            </div>
            <div class="list-product grid-4 padding-20">
                @foreach($cungloai as $row)
                <div class="item-product">
                    <div class="product-img">
                        <img src="images/sanpham/{{$row->Anh}}" alt="">
                        <img class="hover-img" src="images/sanpham/{{$row->Anh}}" alt="">
                    </div>
                    <div class="product-desc">
                        <div class="product-meta-data">
                            <a class="product-name text-decoration-none" href="ct{{$row->MaTraiCay}}">
                                <h3>{{$row->TenTraiCay}}</h3>
                            </a>
                            @if($row->GiaBan===null)
                            <p><span class="product-price">{{$row->GiaGoc}}.000<u>đ</u></span> /{{$row->TenDonVi}}</p>
                            @elseif($row->ChietKhau>0)
                            <p><span class="product-price">{{$row->GiaBan}}.000<u>đ</u></span> /{{$row->TenDonVi}}
                                <s style="color:grey;font-size:11px">{{$row->GiaGoc}}.000<u>đ</u></s>
                            </p>
                            @else
                            <p><span class="product-price">{{$row->GiaBan}}.000<u>đ</u></span> /{{$row->TenDonVi}}</p>
                            @endif
                        </div>
                        <div class="ratings-cart">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            <div class="cart">
                                <a class="btn btn-success" href="javascript:addcart({{$row->MaTraiCay}})"
                                    data-toggle="tooltip" data-placement="left" title="Add to Cart">Thêm giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <br><br>
    <div class="review">
        <div class="bao-qtysort">
            <div class="qty-sort">
                <div><b style="font-size:15px;">{{$comments->count()}} Bình luận</b></div>
                <div><i class="fa fa-bars" style="font-size:12px"></i> Sắp xếp theo</div>
            </div>
        </div>
        <br>
        <div class="user-input">
            <div><img class="img-review" src="images/avatar/avatar.png" alt=""></div>
            <div class="input-review"><input type="text" id="comment-input" placeholder="Viết nội dung...">
                <div class="ratings">
                    Đánh Giá:
                    <a onclick="getStar(1)"><i class="fa fa-star" id="star1" aria-hidden="true"></i></a>
                    <a onclick="getStar(2)"><i class="fa fa-star" id="star2" aria-hidden="true"></i></a>
                    <a onclick="getStar(3)"><i class="fa fa-star" id="star3" aria-hidden="true"></i></a>
                    <a onclick="getStar(4)"><i class="fa fa-star" id="star4" aria-hidden="true"></i></a>
                    <a onclick="getStar(5)"><i class="fa fa-star" id="star5" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <br>
        <div class="container-comments">
            <div class="comments">
                @foreach($comments as $row)
                @if($row->TinhTrang=='true')
                <div style="display:flex;height:auto">
                    <div><img class="img-review" src="images/avatar/{{$row->Avatar}}" alt=""></div>
                    <div style="margin-left:10px">
                        <div><b>{{$row->TaiKhoan}}</b>
                            <span style="color:#606060">
                                @php
                                $date= new DateTime($row->NgayThang);
                                $now= new DateTime(now());
                                @endphp
                                <?php $interval = $date->diff($now); 
                            if($interval->format('%y')!=0)
                            echo($interval->format('%y năm trước'));
                            else if($interval->format('%m')!=0)
                            echo($interval->format('%m tháng trước'));
                            else if($interval->format('%d')!=0)
                            echo($interval->format('%d ngày trước'));
                            else if($interval->format('%h')!=0)
                            echo($interval->format('%h giờ trước'));
                            else if($interval->format('%i')!=0)
                            echo($interval->format('%i phút trước'));
                            else{
                                if($interval->format('%s')==0)echo('vài giây trước');
                                else echo($interval->format('%s giây trước'));}?>
                            </span>
                        </div>
                        <div class="ratings">
                            @for($i = 1; $i <= 5; $i++) @if($i<=$row->Rating)
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffc300"></i>
                                @else
                                <i class="fa fa-star" aria-hidden="true"></i>
                                @endif
                                @endfor
                        </div>
                        <div style="width:500px;word-wrap:break-word;">
                            <div> {{$row->Comment}}</div>
                            @if($row->ReviewIMG!='')
                            <div>{!!$row->ReviewIMG!!}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <br>
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
    @include("footer2")
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="bootstrap/bootstrap.js"></script>
    @include('inputQuatity')
    <script>
    //////////////////////////////////////////////
    document.getElementById("comment-input").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            var text = $('#comment-input').val();
            var masp = <?php echo $idsp;?>;
            var element = document.getElementById('comment-input');
            if (text == '') {
                element.style = "border-bottom:1px solid red";
            } else {
                if (checkKeyword(text) == false) {
                    element.style = "border-bottom:1px solid red";
                    alert('Nội dung không hợp lệ');
                } else {
                    element.style = "border-bottom:1px solid #989292";
                    var data = {
                        'text': text,
                        'idsp': masp,
                        'star': star,
                    }
                    $.ajax({
                        type: 'get',
                        url: "/review",
                        data: data,
                        success: function(response) {
                            element.value = '';
                            $('.container-comments').load(document.URL + ' .comments');
                            $('.bao-qtysort').load(document.URL + ' .qty-sort');
                        }
                    });
                }
            }
        }
    });
    </script>
    <script src="js/detail.js"></script>
    <script src="magiczoomplus/magiczoomplus.js"></script>
</body>

</html>