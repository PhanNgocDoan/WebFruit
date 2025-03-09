<div class="container mt-3 mb-3">
    <form id="insertaccountForm" action="{{ route('insert.data.account') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-input mt-3">
            <div class="item-input">
                <span>Hình ảnh:</span>
                <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)" required>
                <img id="selectedImage" src="#" alt="Selected Image" style="display: none; width: 150px; height: 150px; object-fit: cover;">
            </div>
        </div>
        <div class="container-input grid-3 padding-20">
            <div class="item-input">
                <span>Tài Khoản :</span>
                <input type='text' name="taikhoan" required>
            </div>
            <div class="item-input">
                <span>Mật khẩu :</span>
                <input type='password' name="matkhau" required>
            </div>
            <div class="item-input">
                <span>Email:</span>
                <input type='text' name="email">
            </div>
            <div class="item-input">
                <span>Phone:</span>
                <input type='number' name="phone">
            </div>
            <div class="item-input">
                <span>Địa chỉ:</span>
                <input type='text' name="diachi">
            </div>
            <div class="item-input">
                <span>Họ tên:</span>
                <input type='text' name="hoten">
            </div>
            <div class="item-input">
                <span>Loại loại tài khoản:</span>
                <select name="isadmin">
                    <option value="0">Tài khoản người dùng</option>
                    <option value="1">Tài khoản admin</option>
                </select>
            </div>

        </div>
        <button class="btn btn-success mt-4" type="submit">Submit</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#insertaccountForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("insert.data.account") }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $(".noidung").html(response);
                },
            });
        });
    });
</script>