<div class="container mt-3 mb-3">
    @foreach($traicays as $row)

    <form id="updatebvForm" action="{{ route('update.data.sanpham') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-input mt-3">
            <div class="item-input">
                <label class="form-label" for="inputImage">Image:</label>
                <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)">
                <img id="selectedImage" alt="Selected Image" src="/images/sanpham/{{$row->Anh}}" style="width: 150px; height: 150px; object-fit: cover;" alt="">
            </div>
        </div>

        <div class="container-input grid-3 padding-20">
            <div class="item-input">
                <span>Chiều rộng hình ảnh:</span>
                <input type='text' name="with" min="1">
            </div>
            <div class="item-input">
                <span>Chiều dài hình ảnh:</span>
                <input type='text' name="hight" min="1">
            </div>
        </div>
        <div class="mb-3">
            <span>Kích thước đề cử 600px-600px</span>
        </div>
        <div class="container-input grid-3 padding-20 mt-5">
            <div class=" item-input">
                <span>Mô tả:</span>
                <input type='text' name="MoTa" value="{{$row->MoTa}}">
            </div>
            <div class="item-input">
                <span>Tên Trái Cây :</span>
                <input type='text' name="tentraicay" value="{{$row->TenTraiCay}}" required>
            </div>
            <div class="item-input">
                <span>Giá gốc:</span>
                <input type='number' name="giagoc" value="{{$row->GiaGoc}}" min="1" required>
            </div>
            <div class="item-input">
                <span>Số lượng:</span>
                <input type='number' name="soluong" value="{{$row->SoLuong}}" min="1" required>
            </div>
            <div class="item-input">
                <span>Đơn vi:</span>
                <select name="donvi">
                    @foreach($donvis as $row3)
                    <option value="{{$row3->MaDonVi}}" @if($row3->MaDonVi == $row->UnitID) selected
                        @endif>{{$row3->TenDonVi}}</option>
                    @endforeach
                </select>
            </div>
            <div class="item-input">
                <span>Nhà cung cấp:</span>
                <select name="nhacungcap" id="nhacungcap">
                    @foreach($nhacungcaps as $row4)
                    <option value="{{$row4->MaNcc}}" @if($row4->MaNcc == $row->MaNcc) selected
                        @endif>{{$row4->TenNcc}}</option>
                    @endforeach
                </select>
            </div>
            <div class="item-input">
                <span>Loại Trái Cây:</span>
                <select name="loai" id="loaitraicay">
                    @foreach($loaitraicays as $row2)
                    <option value="{{$row2->MaLoai}}" @if($row2->MaLoai == $row->MaLoai) selected
                        @endif>{{$row2->TenLoai}}</option>
                    @endforeach
                </select>
            </div>
            <div class="item-input">
                <span>Tình Trạng:</span>
                <select name="tinhtrang">
                    <option value="0" @if($row->TinhTrang == 0) selected @endif>Hết hàng</option>
                    <option value="1" @if($row->TinhTrang == 1) selected @endif>Còn hàng</option>
                </select>
            </div>

            <div class=" item-input">
                <input type="hidden" name="MaTraiCay" value="{{$row->MaTraiCay}}">
            </div>
        </div>
        <div class="item-input item-input-mota">
            <span>Nội dung :</span>
            <textarea name="" id="editor" class="" cols="30" rows="10"></textarea>
        </div>
        <div class="container-input mt-3">
            <div class=" item-input">
                <span>Album hình ảnh :</span>
                <input type="file" name="images[]" onchange="displaySelectedImage2(event)" id="imageInput2" multiple>
            </div>
        </div>
        <div class="container-input data-gallery grid-5 padding-10 mt-3">
            @foreach($albums as $row3)
            <div>
                <img src="/images/gallery/{{ $row3->Anh}}" style="width: 200px; height: 200px; object-fit: cover;" alt="">
                <a class="xoa-du-lieu-btn" onclick="routeTodeletegallery('{{ $row3->MaGallery }}', '{{ $row3->Loai }}','{{$row->MaTraiCay}}')"><i class="fa-solid fa-trash"></i></a>
            </div>
            @endforeach
        </div>
        <button class="btn btn-success mt-4 mb-4" type="submit">Submit</button>
    </form>
    @endforeach
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
        $('#updatebvForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var noidung = theEditor.getData();
            formData.append('noidung', noidung);
            $.ajax({
                method: 'POST',
                url: '{{ route("update.data.sanpham") }}',
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