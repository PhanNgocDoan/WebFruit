<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>TD Shop | Giỏ hàng</title>

    <!-- Favicon  -->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div>
        <a href="home"><img src="images/logo2.jpg" alt=""></a>
    </div>
    <div>
        <h1>GIỎ HÀNG</h1>
    </div>
    <div class="mess">
        @if(session()->has('mess-true'))
        <div class="alert alert-success">
            <b>Thành công ! </b><?php echo session()->get('mess-true'); session()->forget('mess-true');?>
            <button style="float:right" onclick="RemoveMess()">X</button>
        </div>
        @endif
    </div>
    <div id="container-cart">
        <div id="menu-cart">
            <ul>
                <li><a href="home">Trang Chủ</a></li>
                <li><a href="shop">Trái Cây</a></li>
                <li><a href="ct">Sản Phẩm</a></li>
                <li><a class="active" href="gh"><i class="fa">&#xf101;</i> Giỏ Hàng</a></li>
                <li><a href="tt">Thanh Toán</a></li>
            </ul>
        </div>
        <div id="content-cart">
            <div class="del-his" style="width:98%;">
                <a href="javascript:delAllproduct()" style="color:red;">Xóa toàn bộ</a>
                <a href="javascript:show_hide(0)" style="float:right;"><i class="fa fa-history"></i>Lịch sử thanh
                    toán</a>
            </div>
            <div id="result">
                <div id="my">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th class="th">Ảnh</th>
                                <th class="th">Tên</th>
                                <th class="th">Giá</th>
                                <th class="th">Số Lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $arr=array();$soluongcon=array();  ?>
                            @foreach($cart as $row)
                            @php
                            array_push($arr,$row->MaTraiCay);
                            array_push($soluongcon,$row->SoLuong);
                            @endphp
                            <tr>
                                <td>
                                    <a href="#"><img src="images/sanpham/{{$row->Anh}}" alt="Product"
                                            class="img-cart"></a>
                                </td>
                                <td>
                                    <h3>{{$row->TenTraiCay}}</h3>
                                </td>
                                <td>
                                    @if($row->GiaBan===null)
                                    <span
                                        class="product-price">{{number_format($row->GiaGoc, 0, ',', '.')}}.000<u>đ</u></span>
                                    @else
                                    <span class="product-price">{{$row->GiaBan}}.000<u>đ</u></span>
                                    @endif
                                </td>
                                <td>
                                    <div class="qty">
                                        <div class="substract-add">
                                            <button
                                                onclick="tang_giam(0,{{$row->MaTraiCay}},{{$row->SoLuong}});">-</button>
                                            @if(isset($sl))
                                            <input min="1" type="number" value="{{$sl[$row->MaTraiCay]}}"
                                                id="qty{{$row->MaTraiCay}}">
                                            @else
                                            <input min="1" type="number" value="{{$row->sl}}"
                                                id="qty{{$row->MaTraiCay}}">
                                            @endif
                                            <button
                                                onclick="tang_giam(1,{{$row->MaTraiCay}},{{$row->SoLuong}});">+</button>
                                            <b> /{{$row->TenDonVi}}</b>
                                            <a href="javascript:delProduct({{$row->MaTraiCay}});"
                                                style="font-size:20px;margin-left:10px;"><i class="fa fa-trash"
                                                    style="color:red;"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <?php $jsonArray = json_encode($arr); $jsonArray2=json_encode($soluongcon);?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="total-checkout">
            <div class="summary-table">
                <div>
                    <h2 style="text-align:center;">Tổng Thanh Toán</h2>
                </div>
                <ul>
                    <li><span>Tạm Tính:</span><span class="cost">
                            {{number_format($total, 0, ',', '.')}}.000<u>đ</u></span></li>
                    <li><span>Tổng:</span><span id="total" class="cost"> {{number_format($total, 0, ',', '.')}}.000
                            <u>đ</u></span></li>
                </ul>
                <br><br>
                <button class="bt" onclick="location.href='tt'">Thanh Toán</button>
            </div>
        </div>
    </div>
    <div id="child">
        <div><button id="cancel" onclick="show_hide(1);">X</button></div>
        <div style="text-align:center;">
            <h3>Lịch sử thanh toán</h3>
        </div>
        <div id="container-invoices-table">
            <div id="invoices-table">
                <table class="invoices">
                    <thead style="background-color:#f8f9fa;">
                        <tr>
                            <th>Tên người nhận</th>
                            <th>Tổng giá</th>
                            <th>Ngày mua</th>
                            <th>Nơi nhận</th>
                            <th>Số điện thoại</th>
                            <th>Tình trạng</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bill as $row)
                        <tr class="tr">
                            <td>{{$row->HoTen}}</td>
                            <td>{{number_format($row->ThanhTien,0, ',', '.')}}.000<u>đ</u></td>
                            <td>{{$row->NgayLapHD}}</td>
                            <td>{{$row->DiaChiGiaoHang}}</td>
                            <td>{{$row->Phone}}</td>
                            <td>{{$row->TinhTrang}}</td>
                            <td>
                                @if($row->DanhGia=='false')
                                <a href="javascript:reviewProduct({{$row->MaHD}})" style="color:blue">Đánh giá</a>
                                <br>
                                @endif
                                <a href="javascript:getdetailInvoices({{$row->MaHD}})" style="color:blue">Chi Tiết</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="detail-invoices">

    </div>
    @include("footer2")
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/cart.js"></script>
    <script>
    var arr = <?php echo($jsonArray); ?>;
    var soluongcon = <?php echo($jsonArray2); ?>;
    for (let i = 0; i < arr.length; i++) {
        $('#qty' + arr[i]).on('change keypress', function() {
            var newqty = $(this).val();
            if (newqty == '' && !$(this).is(':focus')) {
                $(this).val(1);
                newqty = 1;
            } else if (newqty <= 0 && !$(this).is(':focus')) {
                $(this).val(1);
                newqty = 1;
            } else if (soluongcon[i] < newqty && !$(this).is(':focus')) {
                $(this).val(soluongcon[i]);
                newqty = soluongcon[i];
                var mess =
                    '<div class="alert alert-warning">' +
                    '<i class="fa">&#xf071;</i> Số lượng hàng còn lại không đủ.' +
                    '<button style="float:right" onclick="hideMess()">X</button></div>';
                $('.mess').html(mess);
                setTimeout(() => {
                    document.getElementsByClassName('alert')[0].remove();
                }, 3000);
            }
            var data = {
                'SoLuong': newqty,
            };
            $.ajax({
                type: 'get',
                dataType: 'html',
                url: 'update' + arr[i],
                data: data,
                success: function() {
                    $('#total-checkout').load(location.href + ' .summary-table');
                }
            });
        });
    }
    </script>
</body>

</html>