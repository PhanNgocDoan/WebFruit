<div class="container md-3 mt-3">
    <form id="insertbvForm" action="{{ route('insert.data.sanpham') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <span>Hình ảnh:</span>
            <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)" required>
            <img id="selectedImage" src="#" alt="Selected Image" style="display: none; width: 150px; height: 150px; object-fit: cover;">
        </div>
        <div class="container-input grid-3 padding-20">
            <div class="item-input">
                <span>Chiều rộng hình ảnh:</span>
                <input type='number' name="with" min="0" required>
            </div>
            <div class="item-input">
                <span>Chiều dài hình ảnh:</span>
                <input type='number' name="hight" min="0" required>
            </div>

        </div>
        <div class="mb-3">
            <span>Kích thước đề cử 600px-600px</span>
        </div>
        <div class="container-input grid-3 padding-20">
            <div class=" item-input">
                <span>Mô tả:</span>
                <input type='text' name="MoTa">
            </div>
            <div class="item-input">
                <span>Tên Trái Cây :</span>
                <input type='text' name="tentraicay" required>
            </div>
            <div class="item-input">
                <span>Giá Gốc:</span>
                <input type='number' name="giagoc" min="0" required>
            </div>
            <div class="item-input">
                <span>Số lượng:</span>
                <input type='number' name="soluong" min="0" required>
            </div>
            <div class="item-input">
                <span>Đơn vi:</span>
                <select name="donvi" id="donvitraicay">
                    @foreach($donvis as $row)
                    <option value="{{$row->MaDonVi}}">{{$row->TenDonVi}}</option>
                    @endforeach
                </select>
            </div>
            <div class="item-input">
                <span>Nhà cung cấp:</span>
                <select name="nhacungcap" id="nhacungcap">
                    @foreach($nhacungcaps as $row)
                    <option value="{{$row->MaNcc}}">{{$row->TenNcc}}</option>
                    @endforeach
                </select>
            </div>
            <div class="item-input">
                <span>Loại Trái Cây:</span>
                <select name="loai" id="loaitraicay">
                    @foreach($loaitraicays as $row)
                    <option value="{{$row->MaLoai}}">{{$row->TenLoai}}</option>
                    @endforeach
                </select>
            </div>
            <div class="item-input">
                <span>Tình Trạng:</span>
                <select name="tinhtrang">
                    <option value="0">Hết hàng</option>
                    <option value="1">Còn hàng</option>
                </select>
            </div>

        </div>
        <div class="container-input grid-3 mt-3">
            <div class=" item-input">
                <span>Album ảnh:</span>
                <input type="file" name="images[]" onchange="displaySelectedImage2(event)" id="imageInput2" multiple>
            </div>
        </div>
        <div class="mt-3 container-input data-gallery grid-5 padding-10"></div>
        <div class="item-input item-input-mota">
            <span>Nội dung :</span>
            <textarea name="" id="editor" class="" cols="30" rows="10"></textarea>
        </div>
        <button class="btn btn-success mt-4" type="submit">Submit</button>
    </form>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            theEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });
    $(document).ready(function() {
        $('#insertbvForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var noidung = theEditor.getData();
            formData.append('noidung', noidung);
            $.ajax({
                method: 'POST',
                url: '{{ route("insert.data.sanpham") }}',
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