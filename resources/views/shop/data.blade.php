<div class="padding-ajax">
    <div class="list-product grid-4 padding-20">
        @foreach($products as $row)
        <div class="item-product">
            <div class="product-img">
                <img src="images/sanpham/{{$row->Anh}}" alt="">
                <img class="hover-img" src="images/sanpham/{{$row->Anh}}" alt="">
            </div>
            <div class="product-desc">
                <div class="product-meta-data">
                    <a class="product-name text-decoration-none" href="ct{{$row->MaTraiCay}}">
                        <h3><b>{{$row->TenTraiCay}}</b></h3>
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
                        <a class="btn btn-success" href="javascript:addcart({{$row->MaTraiCay}})" data-toggle="tooltip"
                            data-placement="left" title="Add to Cart">Thêm giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="chiaPage">{{ $products->links() }}</div>