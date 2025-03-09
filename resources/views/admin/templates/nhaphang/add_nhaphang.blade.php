<div class="container mt-3 mb-3">
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
                <input type="text" name="tenlo" required>
            </div>
            <div class="item-input-firt mt-2 ">
                <label for="MaNhaCungCap">Mã Nhà Cung Cấp:</label>
                <select name="nhacungcap">
                    @foreach($nhacungcaps as $row)
                    <option value="{{$row->MaNcc}}">{{$row->TenNcc}}</option>
                    @endforeach
                </select>
            </div>

            <div class="noidung-add">

            </div>
            <button class="btn btn-success mt-4" type="submit">Submit</button>
        </form>

    </div>
</div>
<script>
    $(document).ready(function() {
        $("#nhapHangForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "insertnhaphang",
                type: "get",
                data: $(this).serialize(),
                success: function(response) {
                    $(".noidung").html(response);
                },
            });
        });
    });
</script>