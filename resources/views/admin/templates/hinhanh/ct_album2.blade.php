 <div class="container mt-3 mb-3">
     @foreach($albums as $row)
     <div class="container">
         <form id="updatealbumForm" action="{{ route('update.data.album') }}" method="POST"
             enctype="multipart/form-data">
             @csrf
             <div class="container-input mt-3">
                 <div class="item-input mt-3">
                     <label class="form-label" for="inputImage">Image:</label>
                     <input type="file" name="image" id="imageInput" onchange="displaySelectedImage(event)">
                     <img id="selectedImage" alt="Selected Image" src="/images/album/{{$row->HinhAnh}}"
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
                     <input type='text' name="tieude" value="{{$row->TieuDe}}" required>
                 </div>
                 <div class="item-input">
                     <span>Link video:</span>
                     <input type='text' name="linkvideo" value="{{$row->LinkVideo}}">
                 </div>
                 <div class="item-input">
                     <span>link:</span>
                     <input type='text' name="link" value="{{$row->Link}}">
                 </div>
                 <input type="hidden" name="MaAlbum" value="{{$row->MaAlbum}}">
                 <input type="hidden" name="loai" value="{{$row->Loai}}">
             </div>
             <button class="btn btn-success mt-4" type="submit">Submit</button>
         </form>
     </div>
     @endforeach
 </div>
 <script>
$(document).ready(function() {
    $('#updatealbumForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("update.data.album") }}',
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