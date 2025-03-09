@foreach($albums1 as $row3)
<div>
    <img src="/images/gallery/{{ $row3->Anh}}" style="width: 200px; height: 200px; object-fit: cover;" alt="">
    <a class="xoa-du-lieu-btn"
        onclick="routeTodeletegallery('{{ $row3->MaGallery }}', '{{ $row3->Loai }}','{{$masp}}')"><i
            class="fa-solid fa-trash"></i></a>
</div>
@endforeach