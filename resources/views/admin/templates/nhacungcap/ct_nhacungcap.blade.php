<div class="container mt-3 mb-3">
    <form id="insertnhacungcapForm" action="{{ route('insert.data.nhacungcap') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="container-input grid-3 padding-20">
            <div class="item-input">
                <span>Tên nhà cung cấp :</span>
                <input type='text' name="tenncc" required>
            </div>
            <div class="item-input">
                <span>Địa chỉ :</span>
                <input type='text' name="diachi" required>
            </div>
            <div class="item-input">
                <span>Phone :</span>
                <input type='phone' name="phone">
            </div>
            <div class="item-input">
                <span>Số Fax :</span>
                <input type='text' name="sofax" required>
            </div>
            <div class="item-input">
                <span>Địa chỉ mail :</span>
                <input type='text' name="dcmail">
            </div>
        </div>
        <button class="btn btn-success mt-4" type="submit">Submit</button>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#insertnhacungcapForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("insert.data.nhacungcap") }}',
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