<div class="padding-ajax">
    <div class="list-product grid-4 padding-20 text-center">
        @foreach($gioquas as $row)
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
                        <span>Giá:</span> {{$row->GiaBan}}.000<u>đ</u>
                    </span>
                </div>
                <div class="cart mt-2">
                    <a class="btn btn-success" href="javascript:addcart({{$row->MaGioQua}})" data-toggle="tooltip"
                        data-placement="left" title="Add to Cart">Thêm giỏ hàng</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="mt-3">{{ $gioquas->links() }}</div>