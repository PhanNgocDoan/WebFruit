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
                 <th>Ảnh</th>
                 <th>Tiêu đề</th>
                 <th>Ngày đăng</th>
                 <th>Tác vụ</th>
             </tr>
             @foreach($baiviets as $row)
             <tr>
                 <td>
                     <input type="checkbox" name="" value="" />
                 </td>
                 <td>{{$row->MaBaiViet}}</td>
                 <td><img src="images/baiviet/{{$row->Anh}}" style="width: 50px; height: 50px; object-fit: cover;"
                         alt="">
                 </td>
                 <td>{{$row->TieuDe}}</td>
                 <td>{{$row->NgayDang}}</td>
                 <td>
                     <a class="btn btn-danger"
                         href="javascript:routeTodeletebaiviet({{$row->MaBaiViet}},'{{$row->Loai}}')">
                         <i class="fas fa-ban"></i>
                     </a>
                     <a class="btn btn-success"
                         href="javascript:routeToctbaivietid({{$row->MaBaiViet}},'{{$row->Loai}}');">
                         <i class="fas fa-edit"></i>
                     </a>
                 </td>
             </tr>
             @endforeach
         </table>
     </div>

     <input type="hidden" id="loai" value="{{$loais}}">
     <div class="tac-vu-khac mt-2">
         <button class=" btn btn-info" onclick="routeToctbaiviet('{{$loais}}')" type="submit">Thêm mới</button>
     </div>
 </div>
 {!! $baiviets->links() !!}