<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
class ProductController extends Controller
{
      // Chi Tiet San Pham
      public function chitiet()
      {
            if(session()->has('user')){
                $cart =(new CartController)->getCartByAccountId_query(session()->get('user'));
                $count=$this->count_products();
                $sl=null;
            }
            else{
                $cart =(new CartController)->getCartBySession_query();
                $sl=session()->get('sl',[]);
                $count=$this->count_products();  
            }
                $maloai=DB::table('traicay')->where('MaTraiCay',1)->select('traicay.MaLoai')->get()->first();
                $maloai=$maloai->MaLoai;
                ////
                $cungloai =$this->getProductBySameCategory_query($maloai,1);
                ////
                $product=$this->getProductById1_query();
                ////
                $gallery=DB::table('gallery')->where('MaTCay',1)->select('*')->get();
                //
                $comments=DB::table('review')->join('taikhoan','taikhoan.MaTaiKhoan','=','review.MaTk')->where('MaSp',1)->select('*')->get();
                $total= (new CartController)->gettotal();
                $this->updateViewProduct(1);
          return view("detail/detail",compact('product','gallery','comments','cungloai','count','cart','sl','total'));
      }

     //phan loai theo the loai
     public function Catogories(Request $request,$id)
     { 
        if($request->ajax())
        {
            if($id=='catagory')
                $products =$this->getAllProduct_query();
            else
            $products = $this->getProductByCategoryId_query_ToPaginate($id);
            return view('shop/data',compact('products'))->render();
        }
     }
     //
    //  public function loaiDanhMuc($id)
    //  { 
    //         $products = $this->getProductByCategoryId_query_ToPaginate($id);
    //         $cats = DB::table('loaitraicay')->select('*')->get();
    //         $brand = DB::table('nhacungcap')->select('*')->get();
    //         return view('shop/shop',compact('products','cats','brand'))->render();
    //  }
     // phan loai theo hang
     public function Brands(Request $request,$id)
     { 
        if($request->ajax())
        {
            if($id=='brands')
                $products =$this->getAllProduct_query();
            else
            $products = $this->getProductByBrandId_query_ToPaginate($id);
            return view('shop/data',compact('products'))->render();
        }
     }
     // chi tiet san pham
     public function details($id)
     { 
            $comments=DB::table('review')
            ->join('taikhoan','taikhoan.MaTaiKhoan','=','review.MaTk')
            ->where('MaSp',$id)
            ->select('*')
            ->get();
            ////
            $product=$this->getProductById_query($id);
            ///
            if($product->count()==0) return abort(404);
            $maloai=DB::table('traicay')->where('MaTraiCay',$id)->select('traicay.MaLoai')->get()->first();
            $maloai=$maloai->MaLoai;
            $cungloai =$this->getProductBySameCategory_query($maloai,$id);
            ////
            $gallery=DB::table('gallery')->where('MaTCay',$id)->select('*')->get();
         if(session()->has('user'))
         {
            $cart =(new CartController)->getCartByAccountId_query(session()->get('user'));
            $count=$this->count_products();
            $sl=null;
        }
        else
        {
            $cart = (new CartController)->getCartBySession_query();
            $sl=session()->get('sl',[]);
            $count=$this->count_products();  
        }
            $total= (new CartController)->gettotal();
            $this->updateViewProduct($id);
            return view("detail/detail",compact('product','cungloai','gallery','comments','count','cart','sl','total'));
     }
       // Phan loai san pham
       public function Shopview(Request $request)
       {
            $routeName=$request->path();
            $cats = DB::table('loaitraicay')->select('*')->get();
            $brand = DB::table('nhacungcap')->select('*')->get();
            $total=(new CartController)->gettotal();
          if($routeName=='basket')
            $products = $this->getProductByCategoryId_query_ToPaginate(3);
          else
            $products =$this->getAllProduct_query();

           if(session()->has('user'))
           {
                $cart = (new CartController)->getCartByAccountId_query(session()->get('user'));
                $count=$this->count_products();
            return view('shop/shop', compact('cats', 'brand', 'products','count','cart','total'),['name'=>$routeName]);
            }
            else
            {
                $cart = (new CartController)->getCartBySession_query();
                $sl=session()->get('sl',[]);
                $count=$this->count_products();
            return view('shop/shop', compact('cats', 'brand', 'products','count','cart','sl','total'),['name'=>$routeName]);
            }
       }
       //loc san pham
       public function locsanpham(Request $request)
       {  
            if ($request->ajax()) {
                if($request->loai =='catagory' && $request->hang =='brands')
                {
                    $products = DB::table('traicay')
                    ->leftJoin('banggia', function($join) {
                        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                        ->where('NgayBatDau', '<=', Carbon::now())
                        ->where('NgayKetThuc', '>=', Carbon::now());
                    })
                    ->where('TenTraiCay','like','%'.($request->tukhoa).'%')
                    ->whereBetween(
                        DB::raw("CASE WHEN banggia.ChietKhau 
                       IS NOT NULL THEN banggia.GiaBan
                       ELSE traicay.GiaGoc END"),[1,$request->gia])
                       ->orderBy( DB::raw("CASE WHEN banggia.ChietKhau 
                       IS NOT NULL THEN banggia.GiaBan
                       ELSE traicay.GiaGoc END",'asc'))
                       ->join('donvi','donvi.MaDonVi','traicay.UnitID')
                    ->select('traicay.*','banggia.*','donvi.*')
                    ->paginate(8);
                }
                else if($request->loai !='catagory' && $request->hang =='brands')
                {
                    $products = DB::table('traicay')
                    ->leftJoin('banggia', function($join) {
                        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                        ->where('NgayBatDau', '<=', Carbon::now())
                        ->where('NgayKetThuc', '>=', Carbon::now());
                    })
                    ->where('TenTraiCay','like','%'.($request->tukhoa).'%')
                    ->where('traicay.MaLoai',$request->loai)
                    ->whereBetween(
                        DB::raw("CASE WHEN banggia.ChietKhau 
                       IS NOT NULL THEN banggia.GiaBan
                       ELSE traicay.GiaGoc END"),[1,$request->gia])
                       ->orderBy( DB::raw("CASE WHEN banggia.ChietKhau 
                       IS NOT NULL THEN banggia.GiaBan
                       ELSE traicay.GiaGoc END",'asc'))
                       ->join('donvi','donvi.MaDonVi','traicay.UnitID')
                    ->select('traicay.*','banggia.*','donvi.*')
                    ->paginate(8);
                }
                else if($request->loai == 'catagory' && $request->hang !='brands')
                {
                    $products = DB::table('traicay')
                    ->leftJoin('banggia', function($join) {
                        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                        ->where('NgayBatDau', '<=', Carbon::now())
                        ->where('NgayKetThuc', '>=', Carbon::now());
                    })
                    ->where('TenTraiCay','like','%'.($request->tukhoa).'%')
                    ->where('traicay.MaNcc',$request->hang)
                    ->whereBetween(
                        DB::raw("CASE WHEN banggia.ChietKhau 
                       IS NOT NULL THEN banggia.GiaBan
                       ELSE traicay.GiaGoc END"),[1,$request->gia])
                       ->orderBy( DB::raw("CASE WHEN banggia.ChietKhau 
                       IS NOT NULL THEN banggia.GiaBan
                       ELSE traicay.GiaGoc END",'asc'))
                       ->join('donvi','donvi.MaDonVi','traicay.UnitID')
                    ->select('traicay.*','banggia.*','donvi.*')
                    ->paginate(8);
                }
                else {
                    $products = DB::table('traicay')
                    ->where('TenTraiCay','like','%'.($request->tukhoa).'%')
                    ->where('traicay.MaLoai',$request->loai)
                    ->where('traicay.MaNcc',$request->hang)
                    ->leftJoin('banggia', function($join) {
                        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                        ->where('NgayBatDau', '<=', Carbon::now())
                        ->where('NgayKetThuc', '>=', Carbon::now());
                    })
                    ->whereBetween(
                        DB::raw("CASE WHEN banggia.ChietKhau 
                       IS NOT NULL THEN banggia.GiaBan
                       ELSE traicay.GiaGoc END"),[1,$request->gia])
                       ->orderBy( DB::raw("CASE WHEN banggia.ChietKhau 
                       IS NOT NULL THEN banggia.GiaBan
                       ELSE traicay.GiaGoc END",'asc'))
                       ->join('donvi','donvi.MaDonVi','traicay.UnitID')
                    ->select('traicay.*','banggia.*','donvi.*')
                    ->paginate(8);
                }
            return view('shop/data', compact('products'))->render();
        }
    }
    public function locsanpham2(Request $request)
    {
        if ($request->ajax()) {
            if($request->chedo!='normal')
            {
                if($request->chedo=='bestselling')
                {
                    $products = DB::table('traicay')
                    ->join('ct_hoadon', 'traicay.MaTraiCay', '=', 'ct_hoadon.MaTraiCay')
                    ->leftJoin('banggia', function($join) {
                      $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                      ->where('NgayBatDau', '<=', Carbon::now())
                      ->where('NgayKetThuc', '>=', Carbon::now());
                  })
                    ->join('donvi','donvi.MaDonVi','traicay.UnitID')
                    ->select('traicay.TenTraiCay','traicay.MaTraiCay','traicay.Anh','traicay.GiaGoc','banggia.ChietKhau','banggia.GiaBan','donvi.TenDonVi',
                     DB::raw('SUM(ct_hoadon.SoLuong) as totalQuantity'))
                    ->groupBy('traicay.TenTraiCay','traicay.MaTraiCay','traicay.Anh','traicay.GiaGoc','banggia.ChietKhau','banggia.GiaBan','donvi.TenDonVi')
                    ->orderBy('totalQuantity','desc')
                    ->paginate(8);
                }
                else if($request->chedo=='sale')
                {
                    $products = DB::table('traicay')
                    ->join('banggia', 'traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                    ->where('NgayBatDau', '<=', Carbon::now())
                    ->where('NgayKetThuc', '>=', Carbon::now())
                    ->where('ChietKhau','>',0)
                    ->join('donvi','donvi.MaDonVi','traicay.UnitID')
                    ->select('traicay.*','banggia.*','donvi.*')->paginate(8);
                }
                else{
                    $products = DB::table('traicay')
                    ->leftJoin('banggia', function($join) {
                        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                        ->where('NgayBatDau', '<=', Carbon::now())
                        ->where('NgayKetThuc', '>=', Carbon::now());
                    })
                    ->join('donvi','donvi.MaDonVi','traicay.UnitID')
                    ->orderBy('LuotXem','desc')
                    ->select('traicay.*','banggia.*','donvi.*')->paginate(8);
                }
            }
            return view('shop/data', compact('products'))->render();
        }
    }
       // tim kiem san pham bang tu khoa
       public function timkiem(Request $request)
       {  
            if ($request->ajax()) {
                $products = DB::table('traicay')
                ->leftJoin('banggia', function($join) {
                    $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                    ->where('NgayBatDau', '<=', Carbon::now())
                    ->where('NgayKetThuc', '>=', Carbon::now());
                })
                ->where('TenTraiCay','like','%'.($request->tukhoa).'%')
                ->join('donvi','donvi.MaDonVi','traicay.UnitID')
                ->select('traicay.*','banggia.*','donvi.*')
                ->paginate(8);
                return view('shop/data', compact('products'))->render();
            }
    }
      // tim kiem san pham gia
      public function RangePrice(Request $request)
      {  
           if ($request->ajax()) {
               $products = DB::table('traicay')
               ->leftJoin('banggia', function($join) {
                $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                ->where('NgayBatDau', '<=', Carbon::now())
                ->where('NgayKetThuc', '>=', Carbon::now());
            })
               ->whereBetween(
                DB::raw("CASE WHEN banggia.ChietKhau 
               IS NOT NULL THEN banggia.GiaBan
               ELSE traicay.GiaGoc END"),[1,$request->price])
               ->orderBy( DB::raw("CASE WHEN banggia.ChietKhau 
               IS NOT NULL THEN banggia.GiaBan
               ELSE traicay.GiaGoc END",'asc'))
               ->join('donvi','donvi.MaDonVi','traicay.UnitID')
               ->select('traicay.*','banggia.*','donvi.*')
               ->paginate(8);
               return view('shop/data', compact('products'))->render();
           }
   }
   //
   public function RangeBetween(Request $request)
   {  
        if ($request->ajax()) {
            $products = DB::table('traicay')
            ->leftJoin('banggia', function($join) {
             $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
             ->where('NgayBatDau', '<=', Carbon::now())
             ->where('NgayKetThuc', '>=', Carbon::now());
         })
            ->whereBetween(
             DB::raw("CASE WHEN banggia.ChietKhau 
            IS NOT NULL THEN banggia.GiaBan
            ELSE traicay.GiaGoc END"),[intval($request->min),intval($request->max)])
            ->orderBy( DB::raw("CASE WHEN banggia.ChietKhau 
            IS NOT NULL THEN banggia.GiaBan
            ELSE traicay.GiaGoc END",'asc'))
            ->join('donvi','donvi.MaDonVi','traicay.UnitID')
            ->select('traicay.*','banggia.*','donvi.*')
            ->paginate(8);
            return view('shop/data', compact('products'))->render();
        }
}
// dem san pham trong gio hang
    public function count_products()
    {
    $count=0;
    if(session()->has('user'))
    {
         $products=DB::table('giohang')->where('MaTaiKhoan',session()->get('user'))->select('*')->get();
         $count=$products->count();
    }
    else{
        $cart=session()->get('cart',[]);
        if(count($cart)>0)
            $count=count($cart);
    }
    return $count;
    }
    //
    public function upload(Request $request)
    {
       $mahd = $_POST['mahd'];
       $img='';
        $dataArray = json_decode($request->input('data_arr'), true);
        for($i=0; $i< count($dataArray) ;$i++)
        {
            $id=$dataArray[$i];
            if ($request->hasFile('fileToUpload1-'.$id)) {
                $image = $request->file('fileToUpload1-'.$id);
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('images/danhgia/'), $imageName);
                $img.="<a class='fancybox' data-fancybox='gallery' href data-src='images/danhgia/".$imageName."'>
                        <img src='images/danhgia/".$imageName."' width=100 height=100 style='margin-left:5px'>
                      </a>";
            } 
            if ($request->hasFile('fileToUpload2-'.$id)) {
                $image = $request->file('fileToUpload2-'.$id);
                $imageName =$image->getClientOriginalName();
                $image->move(public_path('images/danhgia/'), $imageName);
                $img.="<a class='fancybox' data-fancybox='gallery' href data-src='images/danhgia/".$imageName."'>
                        <img src='images/danhgia/".$imageName."' width=100 height=100 style='margin-left:5px'>
                       </a>";
            } 
            DB::table('review')->insert(
                array(
                    'MaTk'=>session()->get('user'),
                    'MaSp'=>$id,
                    'Comment'=>$_POST['textarea'.$id],
                    'ReviewIMG'=>$img,
                    'Rating'=>intval($_POST['sao'.$id]),
                    'NgayThang'=>Carbon::now(),
                    'TinhTrang'=>'true',
                ));
                $img='';
        }
            DB::table('hoadon')->where('MaHD','=',$mahd) 
            ->update([
                'DanhGia'=>'true',
            ]);
            session()->get('mess-true');
            session()->put('mess-true','Cảm ơn bạn đã phản hồi sản phẩm.');
            return redirect('/gh');
    }

////////////////////////////////////////////////////////////////
////////////////////////QUERY----HERE///////////////////////////
//
    public function updateViewProduct($id)
    {
    DB::table('traicay')->where('MaTraiCay',$id)->increment('LuotXem',1);
    }
//
    public function getAllProduct_query()
    {
       $products= DB::table('traicay') 
            ->leftJoin('banggia', function($join) {
                $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                ->where('NgayBatDau', '<=', Carbon::now())
                ->where('NgayKetThuc', '>=', Carbon::now());
            })
            ->join('donvi','donvi.MaDonVi','traicay.UnitID')
            ->select('traicay.*','banggia.*','donvi.*')->paginate(8);
            return $products;
    }
    //
    public function getProductById1_query()
    {
       $product=DB::table('traicay')
                ->leftJoin('banggia', function($join) {
                        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                        ->where('NgayBatDau', '<=', Carbon::now())
                        ->where('NgayKetThuc', '>=', Carbon::now());
                    })
                ->where('traicay.MaTraiCay', '=', 1)
                ->join('donvi','donvi.MaDonVi','traicay.UnitID')
                ->select('traicay.*','banggia.*','donvi.*')->get();
                return $product;
    }
    //
    public function getProductById_query($id)
    {
        $product=DB::table('traicay')
        ->leftJoin('banggia', function($join) {
                $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
                ->where('NgayBatDau', '<=', Carbon::now())
                ->where('NgayKetThuc', '>=', Carbon::now());
            })
        ->where('traicay.MaTraiCay', '=', $id)
        ->join('donvi','donvi.MaDonVi','traicay.UnitID')
        ->select('traicay.*','banggia.*','donvi.*')->get();
        return $product;
    }
    //
    public function getProductByCategoryId_query($id)
    {
        $loai = DB::table('traicay')
        ->leftJoin('banggia', function($join) {
            $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
            ->where('NgayBatDau', '<=', Carbon::now())
            ->where('NgayKetThuc', '>=', Carbon::now());
        })
        ->where('traicay.MaLoai', '=', $id)
        ->join('donvi','donvi.MaDonVi','traicay.UnitID')
        ->select('traicay.*','banggia.*','donvi.*')->get();
        return $loai;
    }
    //
    public function getProductBySameCategory_query($maloai,$id)
    {
        $loai = DB::table('traicay')
        ->leftJoin('banggia', function($join) {
            $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
            ->where('NgayBatDau', '<=', Carbon::now())
            ->where('NgayKetThuc', '>=', Carbon::now());
        })
        ->where('traicay.MaLoai', '=', $maloai)
        ->where('traicay.MaTraiCay','!=',$id)
        ->join('donvi','donvi.MaDonVi','traicay.UnitID')
        ->select('traicay.*','banggia.*','donvi.*')->get();
        return $loai;
    }
    //
    public function getProductByCategoryId_query_ToPaginate($id)
    {
        $loai = DB::table('traicay')
        ->leftJoin('banggia', function($join) {
            $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
            ->where('NgayBatDau', '<=', Carbon::now())
            ->where('NgayKetThuc', '>=', Carbon::now());
        })
        ->where('traicay.MaLoai', '=', $id)
        ->join('donvi','donvi.MaDonVi','traicay.UnitID')
        ->select('traicay.*','banggia.*','donvi.*')->paginate(8);
        return $loai;
    }
    //
    public function getProductByBrandId_query($id)
    {
        $ncc = DB::table('traicay')
        ->leftJoin('banggia', function($join) {
            $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
            ->where('NgayBatDau', '<=', Carbon::now())
            ->where('NgayKetThuc', '>=', Carbon::now());
        })
        ->where('traicay.MaNcc', '=', $id)
        ->join('donvi','donvi.MaDonVi','traicay.UnitID')
        ->select('traicay.*','banggia.*','donvi.*')->get();
        return $ncc;
    }
    //
    public function getProductByBrandId_query_ToPaginate($id)
    {
        $ncc = DB::table('traicay')
        ->leftJoin('banggia', function($join) {
            $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
            ->where('NgayBatDau', '<=', Carbon::now())
            ->where('NgayKetThuc', '>=', Carbon::now());
        })
        ->where('traicay.MaNcc', '=', $id)
        ->join('donvi','donvi.MaDonVi','traicay.UnitID')
        ->select('traicay.*','banggia.*','donvi.*')->paginate(8);
        return $ncc;
    }
}