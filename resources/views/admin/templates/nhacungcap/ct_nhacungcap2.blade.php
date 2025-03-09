 <div class="container mt-3 mb-3">
     @foreach($nhacungcaps as $row)
     <div class="container">
         <form id="updatenhacungcapForm" action="{{ route('update.data.nhacungcap') }}" method="POST"
             enctype="multipart/form-data">
             @csrf
             <div class="container-input grid-3 padding-20">
                 <div class="item-input">
                     <span>Tên nhà cung cấp :</span>
                     <input type='text' name="tenncc" value="{{$row->TenNcc}}" required>
                 </div>
                 <div class="item-input">
                     <span>Địa chỉ :</span>
                     <input type='text' name="diachi" value="{{$row->DiaChi}}" required>
                 </div>
                 <div class="item-input">
                     <span>Phone :</span>
                     <input type='text' name="phone" value="{{$row->Phone}}">
                 </div>
                 <div class="item-input">
                     <span>Số Fax :</span>
                     <input type='text' name="sofax" value="{{$row->SoFax}}" required>
                 </div>
                 <div class="item-input">
                     <span>Địa chỉ mail :</span>
                     <input type='text' name="dcmail" value="{{$row->DcMail}}">
                 </div>
                 <input type="hidden" name="mancc" value="{{$row->MaNcc}}">
             </div>
             <button class="btn btn-success mt-4" type="submit">Submit</button>
         </form>
     </div>
     @endforeach
 </div>
 <script>
$(document).ready(function() {
    $('#updatenhacungcapForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("update.data.nhacungcap") }}',
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