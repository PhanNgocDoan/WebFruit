<?php $arr=[]; ?>
@foreach($traicays as $row)
@php
$arr[$row->MaTraiCay]=$row->GiaGoc;
@endphp
@endforeach
<?php if(count($arr)>0) {$first = array_values($arr);$arr=json_encode($arr);}?>
<div class="container mt-3 mb-3">
    <form id="insertbanggiaForm" action="{{ route('insert.data.banggia') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="container-input grid-3 padding-20">
            <div class="item-input">
                <span>Giá gốc :</span>
                <input type='number' id="giagoc" name="giagoc"
                    value=<?php if(count($first)>0) echo $first[0]; else echo 0; ?> disabled>
            </div>
            <div class="item-input">
                <span>Giá bán mới :</span>
                <input type='number' id="giaban" value=0 name="giaban" min=0 required>
            </div>
            <div class="item-input">
                <span>Chiết khấu % :</span>
                <input type='number' id="chietkhau" name="chietkhau" value=0 min=0>
            </div>
            <div class="item-input">
                <span>Trái Cây:</span>
                <select name="matraicay" id="matraicay">
                    @foreach($traicays as $row)
                    <option value="{{$row->MaTraiCay}}">{{$row->TenTraiCay}}</option>
                    @endforeach
                </select>
            </div>
            <div class="item-input">
                <span>Ngày bắt đầu :</span>
                <input type='date' name="ngaybatdau">
            </div>
            <div class="item-input">
                <span>Ngày kết thúc :</span>
                <input type='date' name="ngayketthuc">
            </div>
        </div>
        <button class="btn btn-success mt-4" type="submit">Submit</button>
    </form>
</div>
<script>
//
var arr = <?php echo($arr);?>;
$(document).ready(function() {
    $('#matraicay').on('change select', function() {
        var id = $(this).val();
        $('#giagoc').val(arr[id]);
    });
});
//
$(document).ready(function() {
    $('#giaban').on('change', function() {
        var giagoc = $('#giagoc').val();
        var giaban = $(this).val();
        var chietkhau = Math.floor(((giagoc - giaban) / giagoc) * 100);
        if (chietkhau < 0) chietkhau = 0;
        $('#chietkhau').val(chietkhau);
    });
});
//
$(document).ready(function() {
    $('#chietkhau').on('change', function() {
        var giagoc = $('#giagoc').val();
        var chietkhau = $(this).val();
        var giaban = giagoc - (Math.floor(giagoc * chietkhau / 100));
        if (giaban <= 0) {
            alert("Giá bán không được bằng 0 và nhỏ hơn 0!");
            giaban = giagoc;
        }
        $('#giaban').val(giaban);
    });
});
//
$(document).ready(function() {
    $('#insertbanggiaForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("insert.data.banggia") }}',
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