<div style="float:right;"><a style="color:red" href="javascript:show_hide(1)">X</a></div>
<h3 class="text-center">Giỏ hàng</h3>
<div style="margin-left:5px" class="tongcong">
    <div class="tongcong2">
        Tổng cộng: <b>{{number_format($total, 0, ',', '.')}}.000
            <u>đ</u></b>
    </div>
</div>
<div id="mycartpopup">
    @foreach($cart as $row)
    <div class="single-cart-popup">
        <div><img src="images/sanpham/{{$row->Anh}}" style="width:60px;margin-top:10px;" alt=""></div>
        <div>
            <div class="text-center"><b>{{$row->TenTraiCay}}</b></div>
            <div class="substract-add">
                <button onclick="tang_giam(0,{{$row->MaTraiCay}},{{$row->SoLuong}});">-</button>
                @if(isset($sl))
                <input min="1" value="{{$sl[$row->MaTraiCay]}}" id="qty{{$row->MaTraiCay}}" style="color:black">
                @else
                <input min="1" value="{{$row->sl}}" id="qty{{$row->MaTraiCay}}" style="color:black">
                @endif
                <button onclick="tang_giam(1,{{$row->MaTraiCay}},{{$row->SoLuong}});">+</button>
            </div>
        </div>
        @if($row->GiaBan===null)
        <div style="margin-top:20px;">
            <span class="product-price">{{$row->GiaGoc}}.000<u>đ</u></span> /{{$row->TenDonVi}}
        </div>
        @else
        <div style="margin-top:20px;">
            <span class="product-price">{{$row->GiaBan}}.000<u>đ</u></span> /{{$row->TenDonVi}}
        </div>
        @endif
        <div style="margin-top:20px;"><a href="javascript:delProductPopup({{$row->MaTraiCay}});" class="fa fa-trash"
                style="color:red;font-size: 18px;"></a></div>
    </div>
    @endforeach
</div>
<button class="gotocart" onclick="window.location.href='gh'">Chuyển đến giỏ hàng</button>