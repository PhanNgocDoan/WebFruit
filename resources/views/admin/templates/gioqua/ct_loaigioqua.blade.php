<div class="container mt-3 mb-3">
    <form id="insertloaigioquaForm" action="{{ route('insert.data.loaigioqua') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-input grid-3 padding-20">
            <div class="item-input">
                <span>Tên Loại :</span>
                <input type='text' name="tenloai" required>
            </div>
            <div class="item-input">
                <span>Mô tả :</span>
                <input type='text' name="mota">
            </div>
        </div>
        <button class="btn btn-success mt-4" type="submit">Submit</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#insertloaigioquaForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("insert.data.loaigioqua") }}',
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