<div class="container mt-3 mb-3">
    <form id="insertdonvispForm" action="{{ route('insert.data.donvisp') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="container-input grid-3 padding-20">
            <div class="item-input">
                <span>Tên Đơn vị :</span>
                <input type='text' name="tendonvi" required>
            </div>
        </div>
        <button class="btn btn-success mt-4" type="submit">Submit</button>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#insertdonvispForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("insert.data.donvisp") }}',
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