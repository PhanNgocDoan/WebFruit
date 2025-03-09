<div class="container mt-3 mb-3">
    @foreach($gioquas as $row)
    <div class="container">
        <form id="updategioquaForm" action="{{ route('update.data.gioqua') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-input mt-3">
                <div class="item-input">
                    <label class="form-label" for="inputImage">Image:</label>
                    <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)">
                    <img id="selectedImage" alt="Selected Image" src="/images/gioqua/{{$row->Anh}}" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                </div>
            </div>
            <div class="container-input grid-3 padding-20 ">
                <div class="item-input">
                    <span>Chiều rộng hình ảnh:</span>
                    <input type='number' name="with" min="0">
                </div>
                <div class="item-input">
                    <span>Chiều dài hình ảnh:</span>
                    <input type='number' name="hight" min="0">
                </div>
            </div>
            <div class="mb-3">
                <span>Kích thước đề cử 600px-600px</span>
            </div>
            <div class="container-input grid-3 padding-20">
                <div class="item-input">
                    <span>Tên Giỏ Quà:</span>
                    <input type='text' name="TenGioQua" value="{{ $row->TenGioQua }}">
                </div>
                <div class="item-input">
                    <span>Tình Trạng:</span>
                    <select name="tinhtrang">
                        <option value="0" @if($row->TinhTrang == 0) selected @endif>Hết hàng</option>
                        <option value="1" @if($row->TinhTrang == 1) selected @endif>Còn hàng</option>
                    </select>
                </div>

                <div class="item-input">
                    <span>Giá Bán:</span>
                    <input type='number' name="GiaBan" value="{{ $row->GiaBan }}" required>
                </div>

                <div class="item-input">
                    <span>Số Lượng:</span>
                    <input type='number' name="soluong" value="{{ $row->SoLuong }}" required>
                </div>
                <div class="item-input">
                    <span>Mô Tả Giỏ Quà:</span>
                    <textarea name="MoTaGQ">{{ $row->MoTaGQ }}</textarea>
                </div>
                <div class="item-input">
                    <span>Loại giỏ quà:</span>
                    <select name="loaigioqua" id="loaigioqua">
                        @foreach($loaigioquas as $row2)
                        <option value="{{$row2->MaLoai}}" @if($row2->MaLoai == $row->MaLoaiGQ) selected
                            @endif>{{$row2->TenLoai}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" id="magioqua" name="MaGioQua" value="{{$row->MaGioQua}}">
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
                    <a class="xoa-du-lieu-btn" onclick="routeTodeletegallery('{{ $row3->MaGallery }}', '{{ $row3->Loai }}','{{$row->MaGioQua}}')"><i class="fa-solid fa-trash"></i></a>
                </div>
                @endforeach
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
                @foreach($traicaygqs as $row)
                <div class="input_gioqua mb-3" id="form_{{$row->MaTraiCay}}">
                    <input type="hidden" id="traiCay{{$row->MaTraiCay}}" name="traiCay[{{$row->MaTraiCay}}][id]" value="{{$row->MaTraiCay}}">
                    <label for="traiCay{{$row->MaTraiCay}}">{{$row->TenTraiCay}}</label>
                    <div class="flex align-items-center">
                        <input class="d-block" type="number" name="traiCay[{{$row->MaTraiCay}}][quantity]" value="{{$row->quantity}}" placeholder="Số lượng">
                        <div class="delete-form2 ml-2" data-formid="{{$row->MaTraiCay}}"><i class="fa-solid fa-trash"></i></div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="btn btn-success mt-4" type="submit">Submit</button>
        </form>
    </div>
    @endforeach
</div>
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
        $(document).on('click', '.delete-form2', function() {
            var id2 = $(this).data('formid');
            var id = $('#magioqua').val();
            $.confirm({
                title: "Xác nhận!",
                content: "Bạn có chắc chắn muốn Xóa không?",
                buttons: {
                    confirm: {
                        text: "Đồng ý",
                        btnClass: "btn-blue",
                        action: function() {
                            $.ajax({
                                type: "get",
                                dataType: "html",
                                url: "/xoa_input_gioqua/" + id + "/" + id2,
                                success: function(response) {
                                    $(".noidung").html(response);
                                },
                            });
                        },
                    },
                    cancel: {
                        text: "Hủy bỏ",
                        btnClass: "btn-red",
                    },
                },
            });
        });
    });


    $(document).ready(function() {
        $('#updategioquaForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("update.data.gioqua") }}',
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