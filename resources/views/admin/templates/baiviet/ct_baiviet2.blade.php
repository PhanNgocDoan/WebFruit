<div class="container mt-3 mb-3">
    @foreach($baiviets as $row)

    <div class="container mb-3 mt-3">
        <form id="upadtebaivietForm" action="{{ route('update.data.baiviet') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="container-input mt-3">
                <div class="item-input mt-3">
                    <label class="form-label" for="inputImage">Image:</label>
                    <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)">
                    <img id="selectedImage" alt="Selected Image" src="/images/baiviet/{{$row->Anh}}"
                        style="width: 150px; height: 150px; object-fit: cover;" alt="">
                </div>
            </div>
            <div class="container-input grid-3 padding-20 mb-3">
                <div class="item-input">
                    <span>Chiều rộng hình ảnh:</span>
                    <input type='text' name="with">
                </div>
                <div class="item-input">
                    <span>Chiều dài hình ảnh:</span>
                    <input type='text' name="hight">
                </div>
            </div>
            <div class="container-input grid-3 padding-20">
                <div class="item-input">
                    <span>Tiêu đề :</span>
                    <input type='text' name="TieuDe" value="{{$row->TieuDe}}" required>
                </div>
                <div class=" item-input">
                    <span>Mô tả:</span>
                    <input type='text' name="MoTa" value="{{$row->MoTa}}">
                </div>
                <div class=" item-input">
                    <span>Tình trạng:</span>
                    <select name="tinhtrang">
                        <option value="0" @if($row->TinhTrang == 0) selected @endif>Ẩn</option>
                        <option value="1" @if($row->TinhTrang == 1) selected @endif>Hiện</option>
                    </select>
                </div>
                <input type="hidden" name="MaBaiViet" value="{{$row->MaBaiViet}}">
                <input type="hidden" name="loai" value="{{$row->Loai}}">

            </div>

            <div class="item-input item-input-mota">
                <span>Mô Tả :</span>
                <textarea name="" id="editor" class="" cols="30" rows="10">{{$row->NoiDung}}</textarea>
            </div>

            <button class="btn btn-success mt-4" type="submit">Submit</button>
        </form>
    </div>
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
    $('#upadtebaivietForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var noidung = theEditor.getData();
        formData.append('noidung', noidung);
        $.ajax({
            type: 'POST',
            url: '{{ route("update.data.baiviet") }}',
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