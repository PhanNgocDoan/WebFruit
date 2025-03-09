<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use Carbon\Carbon;
class CartController extends Controller
{
    // lay du lieu gio hang tu tai khoan
    public function getcart()
    {      
        if(session()->has('user')){
        $cart =$this->getCartByAccountId_query(session()->get('user'));
        return view("cart/cart",compact('cart'),['total'=>$this->gettotal(),'bill'=>$this->get_historyBill()]);
        }
        else 
        {
           $cart=$this->getCartBySession_query();
           $sl=session()->get('sl',[]);
           return view("cart/cart",compact('cart','sl'),['total'=>$this->gettotal(),'bill'=>$this->get_historyBill()]);
        }
    }
  //xoa toan bo san pham khoi gio hang
    public function xoatoanbo()
    {
        if(session()->has('user'))
        {  
               DB::table('giohang')
                ->where('MaTaiKhoan',session()->get('user'))
                ->delete();
        }
        else{
            session()->forget('cart');
            session()->forget('sl');
        }
    }
 //them 1 san pham vao gio hang
    public function addcart($id)
    { 
        $soluong=$this->getRemainAmountProduct($id);
        if(session()->has('user'))
        {
            $soluong2=$this->getAmountInCart($id,session()->get('user'));
            $cart= DB::table('giohang')->where('MaTaiKhoan',session()->get('user'))->where('MaSanPham', $id)->select('*')->get();
            if($cart->count()>0)
            {
                if($soluong>$soluong2)
                    DB::table('giohang')->where('MaTaiKhoan',session()->get('user'))->where('MaSanPham', $id)->increment('SoLuong', 1);
                else {
                        $name= $this->getNameOfProduct($id);
                        return response()->json(['name'=>$name,'flag'=>false]);
                    }
            }
            else
              {
                if($soluong>0)
                {
                     DB::table('giohang')->insert(
                    array(
                            'MaGioHang' => $this->createID(),
                            'MaTaiKhoan'=>session()->get('user'),
                            'MaSanPham'=>$id,
                            'SoLuong'=> 1,
                            'NgayTao'=>Carbon::now(),
                    ));
                }
                else {
                    $name= $this->getNameOfProduct($id);
                    return response()->json(['name'=>$name,'flag'=>false]);
                }
              }
              $count= DB::table('giohang')->where('MaTaiKhoan',session()->get('user'))->select('*')->get()->count();
              $cart =$this->getCartByAccountId_query(session()->get('user'));
              $name= $this->getNameOfProduct($id);
            return response()->json(['count'=>$count,'name'=>$name,'flag'=>true]);
        } 
        else{
            $cart=session()->get('cart',[]);
            $sl=session()->get('sl',[]);
            if(isset($sl[$id])){
                if($soluong>$sl[$id])
                {
                    $sl[$id]+=1;
                    session()->put('sl',$sl);
                }
                else {
                    $name= $this->getNameOfProduct($id);
                    return response()->json(['name'=>$name,'flag'=>false]);
                    }
            }
            else {
                if($soluong>0){
                    $sl[$id]=1;
                    $cart[$id]=$id;
                    session()->put('cart',$cart);
                    session()->put('sl',$sl);
                }
                else {
                     $name= $this->getNameOfProduct($id);
                     return response()->json(['name'=>$name,'flag'=>false]);
                }
            }
            $count= count($cart);
            $cart = $this->getCartBySession_query();
            $sl=session()->get('sl',[]);
            $name= $this->getNameOfProduct($id);
          return response()->json(['count'=>$count,'name'=>$name,'flag'=>true]);
        }
    }

  //cap nhat gio hang
  public function capnhatgh(Request $request,$id)
    {   
       $soluong=$this->getRemainAmountProduct($id);
        if($request->SoLuong<=$soluong)
        {
            if(session()->has('user'))
            {
                DB::table('giohang')
                ->where('MaTaiKhoan',session()->get('user'))
                ->where('MaSanPham',$id)
                ->update(['SoLuong'=>$request->SoLuong]);
            }          
            else
            {
                $sl = session()->get('sl', []);
                $sl[$id]=$request->SoLuong;
                session()->put('sl',$sl);
            }
        }   
} 
// //lay tong tien trong gio hang
public  function gettotal()
{    
  $sum=0;
 if(session()->has('user'))
 {   
    $cart = $this->getCartByAccountId_query(session()->get('user'));
    foreach($cart as $row)
    {
        if($row->GiaBan==null)
            $sum2=($row->sl*$row->GiaGoc);
        else
            $sum2=($row->sl*$row->GiaBan);
         $sum+=$sum2;
    }
   }
   else{
    $cart=session()->get('cart',[]);
    $sl=session()->get('sl',[]);
    $cart = $this->getCartBySession_query();
    foreach($cart as $row)
    {
        if($row->GiaBan==null)
            $sum2=($sl[$row->MaTraiCay]*$row->GiaGoc);
        else
            $sum2=($sl[$row->MaTraiCay]*$row->GiaBan);
        $sum+=$sum2;
    }
   }
    return $sum;
}
// // Xoa 1 san pham trong gio hang
public function delProduct($id)
{
    if(session()->has('user')){
    DB::table("giohang")->where("MaSanPham",$id)->where('MaTaiKhoan',session()->get('user'))->delete();
}
    else{
        $cart = session()->get('cart', []);
        $sl = session()->get('sl', []);
        unset($cart[$id]);
        unset($sl[$id]);
        session()->put('cart', $cart);
        session()->put('sl', $sl);
    }
}
// Lay lich su hoa don cua tai khoan
public function get_historyBill()
{
 if(session()->has('user'))
 {
   $his=DB::table('hoadon')
   ->join('ct_hoadon', 'hoadon.MaHD', '=', 'ct_hoadon.MaHD')
   ->where('MaTaiKhoan',session()->get('user'))
   ->select('hoadon.*','ct_hoadon.HoTen')
   ->distinct()->get();
 } 
 else{
     $his=DB::table('hoadon')->join('ct_hoadon', 'hoadon.MaHD', '=', 'ct_hoadon.MaHD')->where('MaTaiKhoan',0)
     ->select('hoadon.*')->get();
 }
   return $his;
}
//Lay chi tiet hoa don cua tai khoan
public function get_detailBill(Request $request)
{
    $detail=DB::table('hoadon')
    ->where('hoadon.MaHD','=',$request->id)
    ->where('MaTaiKhoan',session()->get('user'))
    ->join('ct_hoadon', 'hoadon.MaHD', '=', 'ct_hoadon.MaHD')
    ->join('traicay','traicay.MaTraiCay','=','ct_hoadon.MaTraiCay')
    ->leftJoin('banggia', function($join) {
        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
        ->where('NgayBatDau', '<=', Carbon::now())
        ->where('NgayKetThuc', '>=', Carbon::now());
    })
    ->join('donvi','donvi.MaDonVi','traicay.UnitID')
   ->select('hoadon.*','ct_hoadon.*','traicay.TenTraiCay','traicay.MaTraiCay','traicay.GiaGoc','banggia.GiaBan','donvi.*')
   ->get();
   $info=DB::table('hoadon')
   ->join('ct_hoadon', 'hoadon.MaHD', '=', 'ct_hoadon.MaHD')
   ->where('hoadon.MaHD','=',$request->id)->select('hoadon.*','ct_hoadon.HoTen')
   ->take(1)->get();
   return view('cart/detail-invoices',compact('detail','info'));
}
//Danh gia san pham
public function reviewProduct(Request $request)
{
    $list_products=DB::table('ct_hoadon')
    ->where('MaHD','=',$request->id)
    ->join('traicay','traicay.MaTraiCay','=','ct_hoadon.MaTraiCay')->select('*')->get();
    return view('cart/review_products',compact('list_products'));
}
///////////////////////////////////////////////////////////////////
//////////////////////QUERY---HERE/////////////////////////////////
//
public function getRemainAmountProduct($id)
{
    $soluong=DB::table('traicay')->where('MaTraiCay',$id)->select('SoLuong')->get()->first();
    if($soluong)
        return $soluong->SoLuong;
    return 0;
}
// 
public function getNameOfProduct($id)
{
    $name=DB::table('traicay')->where('MaTraiCay',$id)->select('TenTraiCay')->get()->first();
    if($name)
        return $name->TenTraiCay;
    return '';
}
//
public function getAmountInCart($id,$tk)
{
    $soluong=DB::table('giohang')->where('MaTaiKhoan',$tk)->where('MaSanPham',$id)->select('SoLuong')->get()->first();
    if($soluong)
        return $soluong->SoLuong;
    return 0;
}
//
public function getCartByAccountId_query($id)
{
    $cart = DB::table('traicay')
    ->join('giohang', 'traicay.MaTraiCay', '=', 'giohang.MaSanPham')
    ->leftJoin('banggia', function($join) {
        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
        ->where('NgayBatDau', '<=', Carbon::now())
        ->where('NgayKetThuc', '>=', Carbon::now());
    })
    ->where('MaTaiKhoan',$id)
    ->join('donvi','donvi.MaDonVi','traicay.UnitID')
    ->orderBy('NgayTao','asc')
    ->select('traicay.*','giohang.SoLuong as sl','banggia.*','donvi.*')->get();
    return $cart;
}
//
public function getCartBySession_query()
{
    $cart = DB::table('traicay')
    ->leftJoin('banggia', function($join) {
        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
        ->where('NgayBatDau', '<=', Carbon::now())
        ->where('NgayKetThuc', '>=', Carbon::now());
    })
    ->whereIn('MaTraiCay',session()->get('cart',[]))
    ->join('donvi','donvi.MaDonVi','traicay.UnitID')
    ->select('traicay.*','banggia.*','donvi.*')->get();
    return $cart;
}
// Tao ma moi gio hang
public function createID()
{
        $max=(DB::table('giohang')->max('MaGioHang'));
        $gh=DB::table('giohang')->select('*')->get();
         for($i=1;$i<=$max;$i++){
             $flag=false;
             foreach($gh as $row)
             {
                 if($i==$row->MaGioHang)
                 {
                     $flag=true;
                     break;
                 }
             }
             if($flag==false){
               return $i;
             }
         }
         return $max+1;
}
// public function upload2(Request $request)
// {
//     if ($request->hasFile('upload')) {
//         $originName = $request->file('upload')->getClientOriginalName();
//         $fileName = pathinfo($originName, PATHINFO_FILENAME);
//         $extension = $request->file('upload')->getClientOriginalExtension();
//         $fileName = $fileName . '_' . time() . '.' . $extension;
//         $request->file('upload')->move(public_path('img/danhgia'), $fileName);
//         $url = asset('img/danhgia/' . $fileName);
//         return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
//     }
// }

}