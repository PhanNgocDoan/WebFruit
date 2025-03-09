 <div class="body-trangtinh">
     <div class="mt-2 mb-2">
         <span><?=$thongbao?></span>
     </div>
     <div class="bang">
         <table>
             <tr>
                 <th>
                     <input type="checkbox" name="" value="" />
                 </th>
                 <th>#</th>
                 <th>Tài khoản</th>
                 <th>Họ tên</th>
                 <th>Phone</th>
             </tr>
             @foreach($accounts as $row)
             <tr>
                 <td>
                     <input type="checkbox" name="" value="" />
                 </td>
                 <td>{{$row->MaTaiKhoan}}</td>
                 <td>{{$row->TaiKhoan}}</td>
                 <td>{{$row->HoTen}}</td>
                 <td>{{$row->Phone}}</td>
                 <td>
                     <a class="btn btn-danger" href="javascript:routeTodeleteaccount({{$row->MaTaiKhoan}});">
                         <i class="fas fa-ban"></i>
                     </a>
                     <a class="btn btn-success" href="javascript:routeToctaccountid({{$row->MaTaiKhoan}});">
                         <i class="fas fa-edit"></i>
                     </a>
                 </td>
             </tr>
             @endforeach
         </table>
     </div>
     <div class="tac-vu-khac mt-2">
         <button class=" btn btn-info" onclick="routeToctaccount()" type="submit">Thêm mới</button>
     </div>

 </div>
 {!! $accounts->links() !!}