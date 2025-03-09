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
                 <th>Tên Nhà cung cấp</th>
                 <th>Địa chỉ</th>
                 <th>Phone</th>
                 <th>SoFax</th>
                 <th>Địa chỉ mail</th>
             </tr>
             @foreach($nhacungcaps as $row)
             <tr>
                 <td>
                     <input type="checkbox" name="" value="" />
                 </td>
                 <td>{{$row->MaNcc}}</td>
                 <td>{{$row->TenNcc}}</td>
                 <td>{{$row->DiaChi}}</td>
                 <td>{{$row->Phone}}</td>
                 <td>{{$row->SoFax}}</td>
                 <td>{{$row->DcMail}}</td>
                 <td>
                     <a class="btn btn-danger" href="javascript:routeTodeletenhacungcap({{$row->MaNcc}});">
                         <i class="fas fa-ban"></i>
                     </a>
                     <a class="btn btn-success" href="javascript:routeToctnhacungcapid({{$row->MaNcc}});">
                         <i class="fas fa-edit"></i>
                     </a>
                 </td>
             </tr>
             @endforeach
         </table>
     </div>
     <div class="tac-vu-khac mt-2">
         <button class=" btn btn-info" onclick="routeToctnhacungcap()" type="submit">Thêm mới</button>
     </div>

 </div>
 {!! $nhacungcaps->links() !!}