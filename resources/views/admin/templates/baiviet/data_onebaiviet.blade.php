<div class="container m-0 mt-3 mb-3">
    <div class="mt-2 mb-2">
        @if(($thongbao)!='')
        @if($flag==0)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span><?= $thongbao ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @else
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span><?= $thongbao ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @endif
    </div>
    @if(count($baiviets))
    @foreach($baiviets as $row)
    <div class="container">
        <form id="onebaivietForm" action="{{ route('update.data.onebaiviet') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="container-input grid-3 padding-20">
                <div class="item-input">
                    <span>Tiêu đề :</span>
                    <input type='text' name="TieuDe" value="{{$row->TieuDe}}" required>
                </div>
                <div class=" item-input">
                    <span>Mô tả:</span>
                    <input type='text' name="MoTa" value="{{$row->MoTa}}">
                </div>
                <div class=" item-input">
                    <span>Tình trạng:</span>
                    <select name="tinhtrang">
                        <option value="0" @if($row->TinhTrang == 0) selected @endif>Ẩn</option>
                        <option value="1" @if($row->TinhTrang == 1) selected @endif>Hiện</option>
                    </select>
                </div>
                <input type="hidden" name="MaBaiViet" value="{{$row->MaBaiViet}}">
                <input type="hidden" name="loai" value="{{$row->Loai}}">
            </div>
            <div class="item-input item-input-mota">
                <span>Mô Tả :</span>
                <textarea name="" id="editor" class="" cols="30" rows="10">{{$row->NoiDung}}</textarea>
            </div>
            <button class="btn btn-success mt-4" type="submit">Submit</button>
        </form>
    </div>
    @endforeach
    @else
    <div class="container">
        <form id="onebaivietForm" action="{{ route('update.data.onebaiviet') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class=" item-input">
                <input type="hidden" name="loai" value="{{$loais}}">
            </div>
            <div class="container-input grid-3 padding-20">
                <div class="item-input">
                    <span>Tiêu đề :</span>
                    <input type='text' name="TieuDe" required>
                </div>
                <div class=" item-input">
                    <span>Mô tả:</span>
                    <input type='text' name="MoTa">
                </div>
                <div class=" item-input">
                    <span>Tình trạng:</span>
                    <select name="tinhtrang">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                </div>
            </div>
            <div class="item-input item-input-mota">
                <span>Nội dung :</span>
                <textarea name="" id="editor" class="" cols="30" rows="10"></textarea>
            </div>
            <button class="btn btn-success mt-4" type="submit">Submit</button>
        </form>
    </div>
    @endif
</div>
<script>
ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
        theEditor = editor;
    })
    .catch(error => {
        console.error(error);
    });
$(document).ready(function() {
    $('#onebaivietForm').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var noidung = theEditor.getData();
        formData.append('noidung', noidung);
        $.ajax({
            method: 'POST',
            url: '{{ route("update.data.onebaiviet") }}',
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