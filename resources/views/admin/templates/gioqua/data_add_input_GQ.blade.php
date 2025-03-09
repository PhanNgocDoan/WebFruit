@foreach($traicays as $row)
<input type="hidden" id="traiCay{{$row->MaTraiCay}}" name="traiCay[{{$row->MaTraiCay}}][id]" value="{{$row->MaTraiCay}}">
<label for="traiCay{{$row->MaTraiCay}}">{{$row->TenTraiCay}}</label>
<div class="flex align-items-center">
    <input class="d-block" type="number" name="traiCay[{{$row->MaTraiCay}}][quantity]" placeholder="Số lượng">
    <div class="delete-form ml-2" data-formid="{{$row->MaTraiCay}}"><i class="fa-solid fa-trash"></i></div>
</div>
@endforeach