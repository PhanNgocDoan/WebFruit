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
    <div class=" wrap-main">
        @foreach($gioquas as $row)
        <div class="title-trangtrong">
            <h3>{{$row->TenGioQua}}</h3>
        </div>
        @endforeach
        <div class="container-ct-product">
            <div class="img-ct-product">
                <div class="product-deail">
                    @foreach($gioquas as $row)
                    <div class="img-active">
                        <a href="images/gioqua/{{$row->Anh}}" id="Zoom-1" class="MagicZoom"
                            data-options="zoomMode: true; hint: true; rightClick: true; selectorTrigger: hover; expandCaption: fasle; history: fasle;">
                            <img src="images/gioqua/{{$row->Anh}}" alt="">
                        </a>
                        @php $idsp=$row->MaGioQua; @endphp
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
                @foreach( $gioquas as $row)
                <h3 class="name-product-ct">
                    {{$row->TenGioQua}}
                </h3><br>
                <span class="price-product-ct"><b>Giá: </b><span>${{$row->GiaBan}}.000 VND
                    </span>/KG</span><br><br>

                <span><b>Tình Trạng:</b>@if($row->TinhTrang=='true')<span> Còn
                        hàng</span>@else<span style="color:red;"> Hết hàng</span>@endif</span>
                <form class="cart clearfix" method="get" action="gh{{$row->MaGioQua}}">
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
                    <button type="submit" name="addtocart" class="btn btn-success"><i
                            class="fas fa-shopping-bag mr-1"></i>
                        <span>Thêm vào giỏ hàng</span></button>
                    <a class="btn btn-dark" href="gio-hang">
                        <i class="fas fa-shopping-bag mr-1"></i>
                        <span>Mua ngay</span>
                    </a>
                </form>
                <div class="mota-product-ct mt-3">
                    <b>Mô Tả:</b> {{$row->MoTaGQ}}
                </div>
                @endforeach
            </div>
        </div>
        <div class="product-cung-loai">
            <div class="title-product-cungloai">
                <span>Sản phẩm cùng loại</span>
            </div>
            <div class="list-product grid-4 padding-20 text-center">
                @foreach($gioquacls as $row)
                <div class="item-sanpham">
                    <div class="container-sanphan">
                        <div class="img-sanpham scale-img">
                            <img src="images/gioqua/{{$row->Anh}}" alt="">
                        </div>
                        <a class="name-sanpham text-decoration-none" href="getgioqua_home_ct{{$row->MaGioQua}}">
                            <h3>{{$row->TenGioQua}}</h3>
                        </a>

                        <div class="price-sanpham">
                            <span>
                                <span>Giá:</span> {{$row->GiaBan}}VND/Gio
                            </span>
                        </div>
                        <div class="cart mt-2">
                            <a class="btn btn-success" href="javascript:addcart({{$row->MaGioQua}})"
                                data-toggle="tooltip" data-placement="left" title="Add to Cart">Thêm giỏ hàng</a>
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
            <div><img class="img-review" src="https://ptetutorials.com/images/user-profile.png" alt=""></div>
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
                <div style="display:flex;height:auto">
                    <div><img class="img-review" src="https://ptetutorials.com/images/user-profile.png" alt=""></div>
                    <div style="margin-left:10px">
                        <div><b>{{$row->TaiKhoan}}</b> {{$row->NgayThang}}</div>
                        <div class="ratings">
                            @for($i = 1; $i <= 5; $i++) @if($i<=$row->Rating)
                                <i class="fa fa-star" aria-hidden="true" style="color:#ffc300"></i>
                                @else
                                <i class="fa fa-star" aria-hidden="true"></i>
                                @endif
                                @endfor
                        </div>
                        <div style="width:500px;word-wrap:break-word;">
                            {{$row->Comment}}
                        </div>
                    </div>
                </div>
                <br>
                @endforeach
            </div>
        </div>
    </div>
    @include("home/templates/footer")
    @include("home/templates/js")
    <script>
    var star = 0;

    function getStar(n) {
        star = n;
        for (var i = 1; i <= 5; i++) {
            var icon = document.getElementById('star' + i);
            if (i <= n) {
                icon.style.color = "#ffc300";
            } else {
                icon.style.color = "black";
            }
        }
    }

    function getCookie(name) {
        const cookieString = document.cookie;
        const cookies = cookieString.split('; ');

        for (const cookie of cookies) {
            const [cookieName, cookieValue] = cookie.split('=');
            if (cookieName === name) {
                return cookieValue;
            }
        }

        return null;
    }

    // Get the value of the "myCookie" cookie
    const myCookieValue = getCookie('id');

    // Log the value to the console
    console.log('Value of myCookie:', myCookieValue);
    $("#comment-input").focus(function() {
        if (myCookieValue == null) {
            location.href = "login";
        }
    });
    document.getElementById("comment-input").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            var text = $('#comment-input').val();
            var masp = <?php echo $idsp;?>;
            var element = document.getElementById('comment-input');
            if (text == '') {
                element.style = "border-bottom:1px solid red";
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
    });
    </script>

</body>

</html>