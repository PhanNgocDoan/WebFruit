<div class="container mt-3 mb-3">
    <form id="insertgioquaForm" action="{{ route('insert.data.gioqua') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-input mt-3">
            <div class="item-input">
                <label class="form-label" for="inputImage">Image:</label>
                <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)">
                <img id="selectedImage" alt="Selected Image" src="/images/gioqua/{{$row->Anh}}" style="width: 150px; height: 150px; object-fit: cover;" alt="">
            </div>
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
            <div class="item-input">
                <span>Tên Giỏ Quà:</span>
                <input type='text' name="TenGioQua">
            </div>
            <div class="item-input">
                <span>Giá Bán:</span>
                <input type='number' name="GiaBan" required>
            </div>
            <div class="item-input">
                <span>Số Lượng:</span>
                <input type='number' name="soluong" required>
            </div>
            <div class="item-input">
                <span>Tình Trạng:</span>
                <select name="tinhtrang">
                    <option value="0">Hết hàng</option>
                    <option value="1">Còn hàng</option>
                </select>
            </div>
            <div class="item-input">
                <span>Mô Tả Giỏ Quà:</span>
                <textarea name="MotaGQ"></textarea>
            </div>
            <div class="item-input">
                <span>Loại giỏ quà:</span>
                <select name="loaigioqua" id="loaigioqua">
                    @foreach($loaigioquas as $row)
                    <option value="{{$row->MaLoai}}">{{$row->TenLoai}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="container-input grid-3 mt-3">
            <div class=" item-input">
                <span>Album ảnh:</span>
                <input type="file" name="images[]" onchange="displaySelectedImage2(event)" id="imageInput2" multiple>
            </div>
        </div>
        <div class="item-input grid-4 mt-3">
            <div class="item-input">
                <span>Chọn loại trái cây:</span>
                <select name="loaiTraiCay" id="loaiTraiCay">
                    @foreach($traicays as $row)
                    <option value="{{$row->MaTraiCay}}">{{$row->TenTraiCay}}</option>
                    @endforeach
                </select>
            </div>
            <div class="item-input">
                <div class="hien_from btn btn-primary">Chọn</div>
            </div>
        </div>
        <div id="data_input_GQ" class="grid-4 mt-3">
        </div>
        <button class="btn btn-success mt-4" type="submit">Submit</button>
    </form>
</div>

<style>
    .item-input {
        margin-bottom: 10px;
    }

    input[type="checkbox"] {
        display: inline-block;
        margin-right: 5px;
    }

    label {
        display: inline-block;
    }
</style>
<script>
    $(document).ready(function() {
        $('.hien_from').on('click', function() {
            var id = $('#loaiTraiCay').val();
            $.ajax({
                type: 'GET',
                url: '/add_input_gioqua/' + id,
                success: function(response) {
                    var formId = 'form_' + id;
                    if ($('#' + formId).length === 0) {
                        var formHtml = '<div class="input_gioqua" id="' + formId + '">' + response + '</div>';
                        $("#data_input_GQ").append(formHtml);
                    } else {
                        alert('Form đã tồn tại.');
                    }
                },
            });
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.delete-form', function() {
            var formId = $(this).data('formid');
            $('#form_' + formId).remove();
        });
    });
    $(document).ready(function() {
        $('#insertgioquaForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("insert.data.gioqua") }}',
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