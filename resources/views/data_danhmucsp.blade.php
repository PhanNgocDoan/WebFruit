<div class="padding-ajax">
    <div class="list-product grid-4 padding-20 text-center">
        @foreach($traicays as $row)
        <div class="item-sanpham">
            <div class="container-sanphan">
                <div class="img-sanpham scale-img">
                    <img src="/images/sanpham/{{$row->Anh}}" alt="">
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
        @foreach($gioquas as $row)
        <div class="item-sanpham">
            <div class="container-sanphan">
                <div class="img-sanpham scale-img">
                    <img src="/images/gioqua/{{$row->Anh}}" alt="">
                </div>
                <a class="name-sanpham text-decoration-none" href="ct{{$row->MaGioQua}}">
                    <h3>{{$row->TenGioQua}}</h3>
                </a>
                <div class="price-sanpham">
                    <p><span class="product-price">{{$row->GiaBan}}.000<u>đ</u></span></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>