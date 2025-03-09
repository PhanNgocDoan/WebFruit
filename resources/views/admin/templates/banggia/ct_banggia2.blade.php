<?php $arr=[]; ?>
@foreach($traicays as $row)
@php
$arr[$row->MaTraiCay]=$row->GiaGoc;
@endphp
@endforeach
<?php if(count($arr)>0) {$first = array_values($arr);$arr=json_encode($arr);}?>
<div class="container mt-3 mb-3">
    @foreach($banggias as $row)
    <div class="container">
        <form id="updatebanggiaForm" action="{{ route('update.data.banggia') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="container-input grid-3 padding-20">
                <div class="item-input">
                    <span>Giá gốc :</span>
                    <input type='number' id="giagoc" name="giagoc" value='{{$giagoc}}' disabled>
                </div>
                <div class="item-input">
                    <span>Giá bán :</span>
                    <input type='number' id="giaban" name="giaban" value="{{$row->GiaBan}}" min=0 required>
                </div>
                <div class="item-input">
                    <span>Chiết khấu :</span>
                    <input type='number' id="chietkhau" name="chietkhau" value="{{$row->ChietKhau}}" min=0>
                </div>
                <div class="item-input">
                    <span>Trái Cây:</span>
                    <select name="matraicay" id="matraicay">
                        @foreach($traicays as $row2)
                        <option value="{{$row2->MaTraiCay}}" @if($row2->MaTraiCay == $row->MaSanPham) selected
                            @endif>{{$row2->TenTraiCay}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="item-input">
                    <span>Ngày bắt đầu :</span>
                    <input type='date' value="{{$row->NgayBatDau}}" name=" ngaybatdau">
                </div>
                <div class="item-input">
                    <span>Ngày kết thúc :</span>
                    <input type='date' value="{{$row->NgayKetThuc}}" name="ngayketthuc">
                </div>

                <input type="hidden" name="IDGia" value="{{$row->IDGia}}">
            </div>
            <button class="btn btn-success mt-4" type="submit">Submit</button>
        </form>
    </div>
    @endforeach
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
    $('#updatebanggiaForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '{{ route("update.data.banggia") }}',
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