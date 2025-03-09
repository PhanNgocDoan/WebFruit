<div class="container mt-3 mb-3">
    <div class="mt-2 mb-2">
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
    @if(count($albums))
    @foreach($albums as $row)
    <div class="container">
        <form id="oneimgForm" action="{{ route('update.data.oneimg') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-input mt-3">
                <div class="item-input mt-3">
                    <label class="form-label" for="inputImage">Image:</label>
                    <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)">
                    <img id="selectedImage" alt="Selected Image" src="/images/album/{{$row->HinhAnh}}"
                        style="width: 150px; height: 150px; object-fit: cover;" alt="">
                </div>
            </div>
            <div class="container-input grid-3 padding-20 mt-3">
                <div class=" item-input">
                    <span>Chiều rộng hình ảnh:</span>
                    <input type="text" name="with">
                </div>
                <div class=" item-input">
                    <span>Chiều dài hình ảnh:</span>
                    <input type="text" name="hight">
                </div>
            </div>
            <div class=" item-input">
                <input type="hidden" name="MaAlbum" value="{{$row->MaAlbum}}">
            </div>
            <div class=" item-input">
                <input type="hidden" name="loai" value="{{$loais}}">
            </div>
            <button class="btn btn-success mt-4" type="submit">Submit</button>
        </form>
    </div>
    @endforeach
    @else
    <div class="container">
        <form id="oneimgForm" action="{{ route('update.data.oneimg') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-input mt-3">
                <div class="item-input">
                    <span>Hình ảnh:</span>
                    <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)" required>
                    <img id="selectedImage" src="#" alt="Selected Image"
                        style="display: none; width: 150px; height: 150px; object-fit: cover;">
                </div>
            </div>
            <div class=" item-input">
                <input type="hidden" name="loai" value="{{$loais}}">
            </div>
            <div class="container-input grid-3 padding-20 mt-3">
                <div class=" item-input">
                    <span>Chiều rộng hình ảnh:</span>
                    <input type="text" name="with" required>
                </div>
                <div class=" item-input">
                    <span>Chiều dài hình ảnh:</span>
                    <input type="text" name="hight" required>
                </div>
            </div>
            <button class="btn btn-success mt-4" type="submit">Submit</button>
        </form>
    </div>
    @endif
</div>
<script>
$(document).ready(function() {
    $('#oneimgForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            method: 'POST',
            url: '{{ route("update.data.oneimg") }}',
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