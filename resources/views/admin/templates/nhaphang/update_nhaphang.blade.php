<div class="container mt-3 mb-3">
    @foreach($lonhaps as $row)
    <div class="body-nhaphang">
        <button class="btn btn-primary" onclick=addinput()>Thêm</button>
        <button class="btn btn-danger" onclick=deleteinput()>Xóa</button>
        <div class="title-nhaphang">
            <span>Nhập Hàng</span>
        </div>
        <form id="nhapHangForm" method="get">
            @csrf
            <div class="item-input-firt">
                <label for="Tenlo">Tên lô:</label>
                <input type="text" name="tenlo" value="{{$row->TenLo}}" required>
                <input type="hidden" name="malo" value="{{$row->MaLo}}" required>
            </div>
            <div class="item-input-firt mt-2 ">
                <label for="MaNhaCungCap">Mã Nhà Cung Cấp:</label>
                <select name="nhacungcap" id="nhacungcapSelect">
                    @if($nhaphang2s)
                    @foreach($nhacungcaps as $row2)
                    <option value="{{$row2->MaNcc}}" @if($row2->MaNcc == $nhaphang2s->MaNhaCungCap) selected
                        @endif>{{$row2->TenNcc}}
                    </option>
                    @endforeach
                    @else
                    @foreach($nhacungcaps as $row2)
                    <option value="{{$row2->MaNcc}}">{{$row2->TenNcc}}
                    </option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="noidung-add">
                <div class="mt-4 mb-2">
                    @if(($thongbao)!='')
                    @if($flag==0)
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span><?= $thongbao ?></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @else
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span><?= $thongbao ?></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @endif
                </div>
                @foreach($nhaphangs as $key=>$row3)
                <div class="nhapHang mt-4 container-input grid-3 padding-20">
                    <div class="item-input">
                        <label for="MaTraiCay">Mã Trái Cây:</label>
                        <select name="nhaphangs[{{$key+1}}][MaTraiCay]" id="matraicay">
                            @foreach($traicays as $row2)
                            <option value="{{$row2->MaTraiCay}}" @if($row2->MaTraiCay == $row3->MaTraiCay) selected
                                @endif>{{$row2->TenTraiCay}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="item-input">
                        <label for="SoLuong">Số Lượng:</label>
                        <input type="number" name="nhaphangs[{{$key+1}}][SoLuong]" value="{{$row3->SoLuong}}" required>
                    </div>
                    <div class="item-input">
                        <label for="GiaNhap">Giá Nhập:</label>
                        <input type="number" name="nhaphangs[{{$key+1}}][GiaNhap]" value="{{$row3->GiaNhap}}" required>
                    </div>
                </div>
                <a class="xoa-du-lieu-btn" onclick="routeTodeletespnhaphang('{{$row->MaLo}}', '{{ $row3->MaTraiCay }}')"><i class="fa-solid fa-trash"></i></a>
                @endforeach
            </div>
            <button class="btn btn-success mt-4" type="submit">Submit</button>
        </form>
    </div>
    @endforeach
</div>
<script>
    $(document).ready(function() {
        $('#nhacungcapSelect').on('change', function() {
            var selectedValue = $(this).val();
            $('#nhacungcapSelect option').removeAttr('selected');
            $('#nhacungcapSelect option[value="' + selectedValue + '"]').attr('selected', 'selected');
        });
    });
    $(document).ready(function() {
        $("#nhapHangForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "capnhatnhaphang",
                type: "get",
                data: $(this).serialize(),
                success: function(response) {
                    $(".noidung").html(response);
                },
            });
        });
    });
</script>