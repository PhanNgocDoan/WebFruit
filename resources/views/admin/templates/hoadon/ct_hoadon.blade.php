<div class="ct_donhang">

    @foreach($hoadons as $row)
    <div class="title-admin2">
        <h3 class="m-0">Thông tin khách hàng</h3>
    </div>
    <div class="thongtin-kh">
        <div class="ma-don-hang">
            <h3>Mã đơn hàng</h3>
            <span>{{$row->MaHD}}</span>
        </div>
        <div class="dia-chi">
            <h3>{{$row->DiaChiGiaoHang}}</h3>
        </div>
        <div class="phone">
            <h3>Số điện thoại</h3>
            <span>{{$row->Phone}}</span>
        </div>
        <div class="tt-vanchuyen">
            <h3>Thông tin vận chuyển</h3>
            <span>- thanh toán tại nhà</span>
        </div>
        <div class="tinh-trang-don">
            <h3>Tình trạng đơn hàng</h3>
            <form id="tinhtrangdon" action="{{ route('capnhatdon') }}" method="post">
                @csrf
                <div>
                    <select name="tinh_trang" id="lang-select">
                        <option value="Hoàn thành" @if($row->TinhTrang == 'Hoàn thành') selected @endif>Hoàn thành
                        </option>
                        <option value="Đang xử lý" @if($row->TinhTrang == 'Đang xử lý') selected @endif>Đang xử lý
                        </option>
                        <option value="Đơn hàng hủy" @if($row->TinhTrang == 'Đơn hàng hủy') selected @endif>Đơn hàng hủy
                        </option>
                    </select>
                    <input type="hidden" name="mahd" value="{{$row->MaHD}}">
                    <button class="btn btn-primary" type="submit">Cập nhật đơn hàng</button>
                </div>
            </form>
        </div>
    </div>

    <div class="title-admin2">
        <h3 class="m-0">Sản phẩm đơn hàng</h3>
    </div>
    <div class="bang">
        <table>
            <tr>
                <th>#</th>
                <th>Ảnh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Đơn giá</th>
                <th>Đơn vị</th>
                <th>Số lượng</th>
            </tr>

            @foreach($sphoadons as $row2)
            <tr>
                <td>{{$row2->MaTraiCay}}</td>
                <td><img src="images/sanpham/{{$row2->Anh}}" style="width: 50px; height: 50px; object-fit: cover;"
                        alt="">
                </td>
                <td>{{$row2->TenTraiCay}}</td>
                @if($row2->GiaBan===null)
                <td>{{$row2->GiaGoc}}.000<u>đ</u></td>
                @else
                <td>{{$row2->GiaBan}}.000<u>đ</u></td>
                @endif
                <td>{{$row2->TenDonVi}}</td>
                <td>{{$row2->sl}}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="title-admin2">
        <h3 class="m-0">Giá trị đơn</h3>
    </div>
    <div class="gia-tri-don">
        <span>Tổng đơn hàng: {{$row->ThanhTien}}.000<u>đ</u></span>
    </div>
    @endforeach
</div>
<script>
$(document).ready(function() {
    $('#tinhtrangdon').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("capnhatdon") }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                window.location.href = "hoadon";
            },
        });
    });
});
</script>