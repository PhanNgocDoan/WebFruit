<button id="cancel-detail" onclick="show_hide_detail();">X</button>
<a href="" class="printer"><i style="font-size:17px" class="fa">&#xf02f;</i></a>
<div class="header-invoices">
    <div class="logo-detail">
        <a href="home"><img src="images/logo2.jpg" height=100 alt=""></a>
    </div>
    <div class="info-detail">
        <div>Địa chỉ: Huỳnh Thúc Kháng - Quận 1 - Hồ Chí Minh.</div>
        <div>Mobile: 0962418040 - 0962418040</div>
        <div>Email: tdshop@gmail.com</div>
    </div>
</div>
<div style="text-align:center">
    <h3>CHI TIẾT HÓA ĐƠN</h3>
</div>

<div style="margin-left:10px">
    @foreach($info as $row)
    <div style="font-size:14px"><b>Tên khách hàng:</b> {{$row->HoTen}}</div>
    <div style="display:flex">
        <div style="width:60%;font-size:14px"><b>Địa chỉ:</b> {{$row->DiaChiGiaoHang}}</div>
        <div style="width:40%;font-size:14px"><b>Điện Thoại:</b> {{$row->Phone}}</div>
    </div>
    @endforeach
    <table class="invoices-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên hàng</th>
                <th>Mã hàng</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng giá</th>
            </tr>
        </thead>
        <tbody>
            <?php $stt=1; ?>
            @foreach($detail as $row)
            <tr>
                <td>{{$stt}}</td>
                <td>{{$row->TenTraiCay}}</td>
                <td>{{$row->MaTraiCay}}</td>
                <td>{{$row->SoLuong}}</td>
                <td>{{number_format($row->DonGia, 0, ',', '.')}}.000<u>đ</u> /<i>{{$row->TenDonVi}}</i></td>
                <td>{{number_format($row->DonGia*$row->SoLuong,0, ',', '.')}}.000<u>đ</u></td>

            </tr>
            <?php $stt+=1; ?>
            @endforeach
            @foreach($detail as $row)
            <tr>
                <td colspan="6" class="info-cost"><b>Tổng cộng:
                    </b>{{number_format($row->ThanhTien,0, ',', '.')}}.000<u>đ</u></td>
            </tr>
            <tr>
                <td colspan="6" class="info-cost"><b>Phí giao hàng: </b>0.000<u>đ</u></td>
            </tr>
            <tr>
                <td colspan="6" class="info-cost"><b>Thành tiền:
                    </b>{{number_format($row->ThanhTien,0, ',', '.')}}.000<u>đ</u></td>
            </tr>
            @break
            @endforeach
        </tbody>
    </table>
    @foreach($info as $row)
    @php
    $date= new DateTime($row->NgayLapHD);
    @endphp
    <div class="date-invoices"><b>Ngày </b><?php echo $date->format('d');?><b> Tháng
        </b><?php echo $date->format('m');?> <b> Năm </b><?php echo $date->format('Y');?></div>
    @endforeach
</div>