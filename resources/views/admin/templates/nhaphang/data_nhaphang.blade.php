<div class="body-trangtinh">
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
    <div class="bang">
        <table>
            <tr>
                <th>Mã Lô Nhập</th>
                <th>Tên Lô Nhập</th>
                <th>Tác vụ</th>
            </tr>
            @foreach($lonhaps as $row)
            <tr>
                <td>
                    {{$row->MaLo}}
                </td>
                <td>
                    {{$row->TenLo}}
                </td>
                <td>
                    <a class="btn btn-danger" href="javascript:routeTodeletenhaphang({{$row->MaLo}});">
                        <i class="fas fa-ban"></i>
                    </a>
                    <a class="btn btn-success" href="javascript:routeToctnhaphangid({{$row->MaLo}});">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="tac-vu-khac mt-2">
        <button class=" btn btn-info" onclick="routeToaddnhaphang()" type="submit">Thêm mới</button>
    </div>
</div>
{!! $lonhaps->links() !!}