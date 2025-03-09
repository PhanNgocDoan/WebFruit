 <div class="body-trangtinh">

     @if($thongbao!=null && $flag=='true' )
     <div class="alert alert-success alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Thành công!</strong> <?= $thongbao; ?>.
     </div>
     @elseif($thongbao!=null && $flag=='false')
     <div class="alert alert-danger alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong>Thất bại!</strong> <?= $thongbao; ?>.
     </div>
     @endif
     <div class="bang">
         <table>
             <tr>
                 <th>
                     <input type="checkbox" name="" value="" />
                 </th>
                 <th>#</th>
                 <th>Tên trái cây</th>
                 <th>Giá bán</th>
                 <th>Tác vụ</th>
             </tr>
             @foreach($banggias as $row)
             <tr>
                 <td>
                     <input type="checkbox" name="" value="" />
                 </td>
                 <td>{{$row->IDGia}}</td>
                 <td>{{$row->TenTraiCay}}</td>
                 <td>{{$row->GiaBan}}</td>
                 <td>
                     <a class="btn btn-danger" href="javascript:routeTodeletebanggia({{$row->IDGia}});">
                         <i class="fas fa-ban"></i>
                     </a>
                     <a class="btn btn-success" href="javascript:routeToctbanggiaid({{$row->IDGia}});">
                         <i class="fas fa-edit"></i>
                     </a>
                 </td>
             </tr>
             @endforeach
         </table>
     </div>
     <div class="tac-vu-khac mt-2">
         <button class=" btn btn-info" onclick="routeToctbanggia()" type="submit">Thêm mới</button>
     </div>

 </div>
 {!! $banggias->links() !!}