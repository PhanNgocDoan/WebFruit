<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>TD Shop | Thanh Toán</title>

    <!-- Favicon  -->

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/checkout.css">
    <!-- <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css" /> -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">

</head>

<body>
    <!-- ##### Main Content Wrapper Start ##### -->
    <div>
        <h1>THANH TOÁN</h1>
    </div>
    @if(session()->has('mess-true'))
    <div class="alert alert-success">
        <b>Thành công! </b><?php echo session()->get('mess-true'); session()->forget('mess-true');?>
        <button style="float:right" onclick="hideMess()">X</button>
    </div>
    @elseif(session()->has('mess-false'))
    <div class="alert alert-danger">
        <b>Thất bại! </b><?php echo session()->get('mess-false'); session()->forget('mess-false');?>
        @if(session()->has('empty-cart'))
        <a href="/shop">Go to shop</a>
        <?php session()->forget('empty-cart');?>
        @endif
        <button class="btn-close" style="float:right" onclick="hideMess()">X</button>
    </div>
    @endif
    <div id="container-checkout">
        <div id="menu-checkout">
            <ul>
                <li><a href="home">Trang Chủ</a></li>
                <li><a href="shop">Trái Cây</a></li>
                <li><a href="ct">Sản Phẩm</a></li>
                <li><a href="gh">Giỏ Hàng</a></li>
                <li><a class="active" href="tt"><i class="fa">&#xf101;</i> Thanh Toán</a></li>
            </ul>
        </div>
        <div id="content-checkout">
            <form action="{{ route('make.payment') }}" method="post">
                @csrf
                <div class="row">
                    <div class="line">
                        <label for="">Họ <a style="color:red;">*</a></label>
                        <input type="text" name="first_name" id="first_name" value="" placeholder="Họ" required>
                    </div>
                    <div class="line">
                        <label for=""><i style="font-size:15px" class="fa">&#xf007;</i> Tên <a
                                style="color:red;">*</a></label>
                        <input type="text" name="last_name" id="last_name" value="" placeholder="Tên" required>
                    </div>
                </div>
                <div class="col">
                    <label for=""><i style="font-size:15px" class="fa">&#xf2bc;</i> Công ty</label>
                    <input type="text" id="company" placeholder="Công ty" value="">
                </div>
                <div class="col">
                    <label for=""><i style="font-size:15px" class="fa">&#xf0e0;</i> Email <a
                            style="color:red;">*</a></label>
                    <input type="email" name="email" id="email" placeholder="Email" value="" required>
                </div>
                <div class="row">
                    <div class="line">
                        <label for=""><i style="font-size:15px" class="fa">&#xf19c;</i> Thành phố <a
                                style="color:red;">*</a></label>
                        <input type="text" id="city" placeholder="Thành Phố" value="" required>
                    </div>
                    <div class="line">
                        <label for="">Quận</label>
                        <select class="w-100" id="Quận">
                            <option value="usa">Bình Tân</option>
                            <option value="uk">Tân Phú</option>
                            <option value="ger">Quận Gò Vấp</option>
                            <option value="fra">Quận 1</option>
                            <option value="ind">Quận 2</option>
                            <option value="aus">Quận 3</option>
                            <option value="bra">Quận 4</option>
                            <option value="cana">Quận 5</option>
                            <option value="cana">Quận 6</option>
                            <option value="cana">Quận 7</option>
                            <option value="cana">Quận 8</option>
                            <option value="cana">Quận 9</option>
                            <option value="cana">Quận 10</option>
                            <option value="cana">Quận 11</option>
                            <option value="cana">Quận 12</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label for=""><i style="font-size:15px" class="fa">&#xf041;</i> Địa chỉ <a
                            style="color:red;">*</a></label>
                    <input type="text" class="form-control mb-3" name="address" id="address" placeholder="Địa chỉ"
                        value="" required>
                </div>
                <div class="row">
                    <div class="line">
                        <label for="">Mã zip</label>
                        <input type="text" id="zipCode" placeholder="Mã Zip" value="">
                    </div>
                    <div class="line">
                        <label for=""><i style="font-size:15px" class="fa">&#xf095;</i> Số điện thoại <a
                                style="color:red;">*</a></label>
                        <input type="tel" name="phone" id="phone_number" min="0" placeholder="Số Điện Thoại" value=""
                            pattern="[0]{1}[0-9]{3}[0-9]{3}[0-9]{3}" required>
                    </div>
                </div>
                <div class=" col">
                    <label for=""><i style="font-size:15px" class="fa">&#xf0e6;</i> Ghi chú</label>
                    <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10"
                        placeholder="Ghi chú"></textarea>
                </div>
        </div>
        <div id="total-checkout">
            <div>
                <h2 style="text-align:center;">Tổng Thanh Toán</h2>
            </div>
            <ul class="summary-table">
                <li><span>Tạm Tính:</span><span class="cost"> {{number_format($total, 0, ',', '.')}}.000<u>đ</u></span>
                </li>
                <li><span>Tổng:</span><span id="total" class="cost">
                        {{number_format($total, 0, ',', '.')}}.000<u>đ</u></span></li>
            </ul>
            <div class="payment-method">
                <!-- Cash on delivery -->
                <div class="payment">
                    <img class="ml-15" style="width:30px;" src="images/cash.jpg" alt="">
                    <input type="checkbox" class="" id="cod" checked>
                    <label class="" for="cod">Tiền mặt</label>
                </div>
                <!-- Vnpay -->
                <div class="payment">
                    <img class="ml-15" style="width:30px;" src="images/vnpay.jpg" alt="">
                    <input type="checkbox" class="" id="vnpay">
                    <label class="" for="vnpay">Vnpay</label>
                </div>
                <!-- Paypal -->
                <div class="payment">
                    <img class="ml-15" style="width:30px;" src="images/paypal.png" alt="">
                    <input type="checkbox" class="" id="paypal">
                    <label class="" for="paypal">Paypal</label>
                </div>
            </div>
            <br>
            <button class="btn-checkout" type="submit" name="redirect">Thanh Toán</button>
        </div>
        </form>
    </div>
    @include("footer2")

</body>
<script>
function hideMess() {
    document.getElementsByClassName('alert')[0].style.display = 'none';
}
</script>

</html>