<div class="container mt-3 mb-3">

    <form id="insertalbumForm" action="{{ route('insert.data.album') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-input mt-3">
            <div class="item-input">
                <span>Hình ảnh:</span>
                <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)" required>
                <img id="selectedImage" src="#" alt="Selected Image" style="display: none; width: 150px; height: 150px; object-fit: cover;">
            </div>
        </div>
        <div class="container-input grid-3 padding-20 mb-3">
            <div class="item-input">
                <span>Chiều rộng hình ảnh:</span>
                <input type='text' name="with" required>
            </div>
            <div class="item-input">
                <span>Chiều dài hình ảnh:</span>
                <input type='text' name="hight" required>
            </div>
        </div>
        <div class="container-input grid-3 padding-20">
            <div class="item-input">
                <span>Tiêu đề :</span>
                <input type='text' name="tieude" required>
            </div>
            <div class="item-input">
                <span>Link video:</span>
                <input type='text' name="linkvideo">
            </div>
            <div class="item-input">
                <span>link:</span>
                <input type='text' name="link">
            </div>
            <input type="hidden" name="loai" value="{{$loais}}">
        </div>
        <button class="btn btn-success mt-4" type="submit">Submit</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#insertalbumForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                method: 'POST',
                url: '{{ route("insert.data.album") }}',
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