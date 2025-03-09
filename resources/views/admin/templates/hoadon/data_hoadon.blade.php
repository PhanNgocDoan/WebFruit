 <div class="body-trangtinh">
     <div class="thong-ke">
         <a href="#" class="">Đang bán<span> (5)</span></a>
         <a href="#" class="">Tồn kho<span> (7)</span></a>
         <a href="#" class="">Hết hạn<span> (2)</span></a>
     </div>
     <div class="bo-loc">
         <select name="lang" id="lang-select">
             <option value="chọn">Chọn</option>
             <option value="Đang bán">Đang bán</option>
             <option value="Tồn kho">Tồn kho</option>
             <option value="Hết hạn">Hết hạn</option>
         </select>
         <button class="btn btn-primary" type="submit">Áp dụng</button>
     </div>
     <div class="bang">
         <table>
             <tr>
                 <th>
                     <input type="checkbox" name="" value="" />
                 </th>
                 <th>#</th>
                 <th>Khách hàng </th>
                 <th>Tổng tiền</th>
                 <th>Trạng thái</th>
                 <th>Thời gian</th>
                 <th>Chi tiết</th>
                 <th>Tác vụ</th>
             </tr>
             @foreach($hoadons as $row)
             <tr>
                 <td>
                     <input type="checkbox" name="" value="" />
                 </td>
                 <td>{{$row->MaHD}}</td>
                 <td>{{$row->TaiKhoan}}</td>
                 <td>{{$row->ThanhTien}}</td>
                 <td>{{$row->TinhTrang}}</td>
                 <td>{{$row->NgayLapHD}}</td>
                 <td>
                     <a class="" href="javascript:routeTocthoadonid({{$row->MaHD}});">
                         Chi tiết
                     </a>
                 </td>
                 <td><button class="btn btn-danger" type="submit"><i class="fas fa-ban"></i></button></td>
             </tr>
             @endforeach
         </table>
     </div>

 </div>
 {!! $hoadons->links() !!}