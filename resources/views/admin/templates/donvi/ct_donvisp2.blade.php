 <div class="container mt-3 mb-3">
     @foreach($donvisps as $row)
     <div class="container">
         <form id="updatedonvispForm" action="{{ route('update.data.donvisp') }}" method="POST"
             enctype="multipart/form-data">
             @csrf
             <div class="container-input grid-3 padding-20">
                 <div class="item-input">
                     <span>Tên Đơn vị :</span>
                     <input type='text' name="tendonvi" value="{{$row->TenDonVi}}" required>
                 </div>

                 <input type="hidden" name="madonvi" value="{{$row->MaDonVi}}">
             </div>
             <button class="btn btn-success mt-4" type="submit">Submit</button>
         </form>
     </div>
     @endforeach
 </div>
 <script>
$(document).ready(function() {
    $('#updatedonvispForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("update.data.donvisp") }}',
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