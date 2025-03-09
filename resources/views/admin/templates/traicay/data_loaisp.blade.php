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
                 <th>
                     <input type="checkbox" name="" value="" />
                 </th>
                 <th>#</th>
                 <th>Tên loại</th>
                 <th>Mô tả</th>
             </tr>
             @foreach($loaisps as $row)
             <tr>
                 <td>
                     <input type="checkbox" name="" value="" />
                 </td>
                 <td>{{$row->MaLoai}}</td>
                 <td>{{$row->TenLoai}}</td>
                 <td>{{$row->MoTa}}</td>
                 <td>
                     <a class="btn btn-danger" href="javascript:routeTodeleteloaisp({{$row->MaLoai}});">
                         <i class="fas fa-ban"></i>
                     </a>
                     <a class="btn btn-success" href="javascript:routeToctloaispid({{$row->MaLoai}});">
                         <i class="fas fa-edit"></i>
                     </a>
                 </td>
             </tr>
             @endforeach
         </table>
     </div>
     <div class="tac-vu-khac mt-2">
         <button class=" btn btn-info" onclick="routeToctloaisp()" type="submit">Thêm mới</button>
     </div>

 </div>
 {!! $loaisps->links() !!}