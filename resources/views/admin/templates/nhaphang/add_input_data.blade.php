<div class="nhapHang nhapHang2 mt-4 container-input grid-3 padding-20">
    <div class="item-input">
        <label for="MaTraiCay">Mã Trái Cây:</label>
        <select name="nhaphangs[{{$mainput}}][MaTraiCay]" id="matraicay">
            @foreach($traicays as $row)
            <option value="{{$row->MaTraiCay}}">{{$row->TenTraiCay}}</option>
            @endforeach
        </select>
    </div>
    <div class="item-input">
        <label for="SoLuong">Số Lượng:</label>
        <input type="number" name="nhaphangs[{{$mainput}}][SoLuong]" required>
    </div>
    <div class="item-input">
        <label for="GiaNhap">Giá Nhập:</label>
        <input type="number" name="nhaphangs[{{$mainput}}][GiaNhap]" required>
    </div>
</div>