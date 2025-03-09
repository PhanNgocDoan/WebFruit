<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Events\CheckOnline;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
   
    public function adminview(request $request): View
    {
        if (session()->has('admin')) {
            $traicays = DB::table('traicay')->paginate(5);
            $namhientai = Carbon::now()->year;
            $mangdoanhthu = [];
            for ($month = 1; $month <= 12; $month++) {
                $mangdoanhthu[$month] = DB::table('thongke')->whereYear('Date', $namhientai)->whereMonth('Date', $month)->sum('TongDoanhThu');
            }
            $type="bar";
            return view("home_admin", compact('traicays', 'mangdoanhthu','type'));
        }
       
        return view('/admin/templates/login-admin');
    }
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $tk = DB::table('taikhoan')->where('IsAdmin', '=', 1)->select("*")->get();
        $flag = 0;
        foreach ($tk as $row) {
            if ($row->TaiKhoan == $username && $row->MatKhau == md5($password)) {
                session()->get('admin');
                session()->put('admin',$row->MaTaiKhoan);
                session()->forget('user');
                $traicays = DB::table('traicay')->paginate(5);
                $namhientai = Carbon::now()->year;
                $mangdoanhthu = [];
                for ($month = 1; $month <= 12; $month++) {
                    $mangdoanhthu[$month] = DB::table('thongke')->whereYear('Date', $namhientai)->whereMonth('Date', $month)->sum('TongDoanhThu');
                }
                $type='bar';
                return view("home_admin", compact('traicays', 'mangdoanhthu','type'));
            }
        }
        return view('/admin/templates/login-admin', ['flag' => $flag]);
    }
    public function logoutd(Request $request)
    {
        $flag = 0;
        DB::table('taikhoan')->where('IsAdmin',1)->where('MaTaiKhoan',session()->get('admin'))->update(['TrangThai'=>0]);
        event(new CheckOnline());
        session()->forget('admin');
        return view('/admin/templates/login-admin', ['flag' => $flag]);
    }
    public function gethometest(request $request)
    {
        return view("home_test");
    }
    public function gethometest2(request $request)
    {
        return view("home_test2");
    }

    public function getdonhang(request $request)
    {
        return view("/admin/templates/donhang");
    }
    public function getctdonhang(request $request)
    {
        return view("/admin/templates/ct_donhang");
    }
    //trái cây
    public function sanphamview()
    {
        $thongbao = '';
        $traicays = DB::table('traicay')->join('loaitraicay', 'loaitraicay.MaLoai', '=', 'traicay.MaLoai')->select('*')->paginate(5);
        return view('/admin/templates/traicay/sanpham', compact('traicays', 'thongbao'));
    }
    public function getsanpham(request $request)
    {
        $thongbao = '';
        if ($request->ajax()) {
            $traicays = DB::table('traicay')->join('loaitraicay', 'loaitraicay.MaLoai', '=', 'traicay.MaLoai')->select('*')->paginate(5);
            return view('/admin/templates/traicay/data_sanpham', compact('traicays', 'thongbao'))->render();
        }
    }
    public function getctsanpham(request $request)
    {
        $loaitraicays = DB::table('loaitraicay')->select('*')->get();
        $nhacungcaps = DB::table('nhacungcap')->select('*')->get();
        $donvis = DB::table('donvi')->select('*')->get();
        return view("/admin/templates/traicay/ct_sanpham", compact('loaitraicays', 'donvis', 'nhacungcaps'));
    }
    public function getctsanphamid(request $request, $id)
    {
        $loaitraicays = DB::table('loaitraicay')->select('*')->get();
        $donvis = DB::table('donvi')->select('*')->get();
        $nhacungcaps = DB::table('nhacungcap')->select('*')->get();
        $traicays = DB::table('traicay')->where('MaTraiCay', $id)->select('*')->get();
        $albums = DB::table('gallery')->where('MaTCay', $id)->where('Loai', 'san-pham')->select('*')->get();
        return view("admin/templates/traicay/ct_sanpham2", compact('traicays', 'loaitraicays', 'albums', 'donvis', 'nhacungcaps'));
    }
    public function insertsp(request $request)
    {

        $thongbao = '';
        $with = $request->input('with');
        $hight = $request->input('hight');
        if ($with == null) {
            $with = 600;
        }
        if ($hight == null) {
            $hight = 600;
        }
        try {
            $max =  (DB::table('traicay')->max('MaTraiCay'));
            $traicaysi = DB::table('traicay')->select('*')->get();
            if ($max == 0) {
                $code = 1;
            } else {
                for ($i = 1; $i <= $max; $i++) {

                    $lang = false;
                    foreach ($traicaysi as $value) {

                        if ($i == $value->MaTraiCay) {
                            $lang = true;
                            break;
                        }
                    }
                    if ($i == $max) {
                        $i = $max + 1;
                        $lang = false;
                    }
                    if ($lang == false) {
                        $code = $i;
                        break;
                    }
                }
            }

            $request->validate([

                'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

            ]);
            $name = $request->file('image')->getClientOriginalName();
            $imageName = $name;
            $request->image->move(public_path('images/sanpham'), $imageName);
            $imagePath = 'images/sanpham/' . $imageName;
            $resizedImage = Image::make(public_path($imagePath))
                ->resize($with, $hight)
                ->save();
            $traicayi = DB::table('traicay')->insert(
                array(
                    'MaTraiCay' => $code,
                    'TenTraiCay' => $request->input('tentraicay'),
                    'MoTa' => $request->input('MoTa'),
                    'UnitID' => $request->input('donvi'),
                    'GiaGoc' => $request->input('giagoc'),
                    'SoLuong' =>  $request->input('soluong'),
                    'MaLoai' => $request->input('loai'),
                    'MaNcc' => $request->input('nhacungcap'),
                    'Anh' => $imageName,
                    'TinhTrang' => $request->input('tinhtrang'),
                    'NoiDung' => $request->noidung,
                )
            );
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $image) {

                    $max =  (DB::table('gallery')->max('MaGallery'));
                    $galleryi = DB::table('gallery')->select('*')->get();
                    if ($max == 0) {
                        $code1 = 1;
                    } else {
                        for ($i = 1; $i <= $max; $i++) {

                            $lang = false;
                            foreach ($galleryi as $value) {

                                if ($i == $value->MaGallery) {
                                    $lang = true;
                                    break;
                                }
                            }
                            if ($i == $max) {
                                $i = $max + 1;
                                $lang = false;
                            }
                            if ($lang == false) {
                                $code1 = $i;
                                break;
                            }
                        }
                    }

                    $imageName = $image->getClientOriginalName();
                    $imagePath = $image->move(public_path('images/gallery'), $imageName);
                    $imagePath2 = 'images/gallery/' . $imageName;
                    $resizedImage = Image::make(public_path($imagePath2))
                        ->resize($with, $hight)
                        ->save();
                    DB::table('gallery')->insert([
                        'MaTCay' => $code,
                        'Anh' =>  $imageName,
                        'Loai' => 'san-pham',
                        'MaGallery' => $code1,
                    ]);
                }
            }
            $thongbao = 'Thêm trái cây thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Thêm trái cây thất bại !';
            $flag = 1;
        }

        $traicays = DB::table('traicay')->join('loaitraicay', 'loaitraicay.MaLoai', '=', 'traicay.MaLoai')->select('*')->paginate(5);
        return view("/admin/templates/traicay/data_sanpham", compact('traicays', 'flag', 'thongbao'));
    }
    public function capnhatsp(request $request)
    {
        $thongbao = '';
        $with = $request->input('with');
        $hight = $request->input('hight');
        if ($with == null) {
            $with = 600;
        }
        if ($hight == null) {
            $hight = 600;
        }
        try {

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                ]);
                $name = $request->file('image')->getClientOriginalName();
                $imageName = $name;
                $request->image->move(public_path('images/sanpham'), $imageName);
                $imagePath = 'images/sanpham/' . $imageName;
                $resizedImage = Image::make(public_path($imagePath))
                    ->resize($with, $hight)
                    ->save();
                $traicayi = DB::table('traicay')->where('MaTraiCay', $request->input('MaTraiCay'))->update(
                    [
                        'TenTraiCay' => $request->input('tentraicay'),
                        'MoTa' => $request->input('MoTa'),
                        'GiaGoc' => $request->input('giagoc'),
                        'SoLuong' =>  $request->input('soluong'),
                        'MaLoai' => $request->input('loai'),
                        'UnitID' => $request->input('donvi'),
                        'Anh' => $imageName,
                        'MaNcc' => $request->input('nhacungcap'),
                        'TinhTrang' => $request->input('tinhtrang'),
                        'NoiDung' => $request->noidung,
                    ]
                );
            } else {
                $traicayi = DB::table('traicay')->where('MaTraiCay', $request->input('MaTraiCay'))->update(
                    [
                        'TenTraiCay' => $request->input('tentraicay'),
                        'MoTa' => $request->input('MoTa'),
                        'GiaGoc' => $request->input('giagoc'),
                        'SoLuong' =>  $request->input('soluong'),
                        'UnitID' => $request->input('donvi'),
                        'MaLoai' => $request->input('loai'),
                        'MaNcc' => $request->input('nhacungcap'),
                        'TinhTrang' => $request->input('tinhtrang'),
                        'NoiDung' => $request->noidung,
                    ]
                );
                if ($request->input('with') != null &&  $request->input('hight') != null) {
                    $traicay2 = DB::table('traicay')->where('MaTraiCay', $request->input('MaTraiCay'))->select('*')->get();
                    foreach ($traicay2 as $image) {
                        $imageName = $image->Anh;
                        $imagePath = 'images/sanpham/' . $imageName;
                        $resizedImage = Image::make(public_path($imagePath))
                            ->resize($with, $hight)
                            ->save();
                    }
                }
            }
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    $max =  (DB::table('gallery')->max('MaGallery'));
                    $galleryi = DB::table('gallery')->select('*')->get();
                    if ($max == 0) {
                        $code1 = 1;
                    } else {
                        for ($i = 1; $i <= $max; $i++) {

                            $lang = false;
                            foreach ($galleryi as $value) {

                                if ($i == $value->MaGallery) {
                                    $lang = true;
                                    break;
                                }
                            }
                            if ($i == $max) {
                                $i = $max + 1;
                                $lang = false;
                            }
                            if ($lang == false) {
                                $code1 = $i;
                                break;
                            }
                        }
                    }
                    $imageName = $image->getClientOriginalName();
                    $imagePath = $image->move(public_path('images/gallery'), $imageName);
                    $imagePath2 = 'images/gallery/' . $imageName;
                    $resizedImage = Image::make(public_path($imagePath2))
                        ->resize($with, $hight)
                        ->save();
                    DB::table('gallery')->insert([
                        'MaTCay' => $request->input('MaTraiCay'),
                        'Anh' =>  $imageName,
                        'Loai' => 'san-pham',
                        'MaGallery' => $code1,
                    ]);
                }
            }
            $thongbao = 'Cập nhật trái cây thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật trái cây thất bại !';
            $flag = 1;
        }

        $traicays = DB::table('traicay')->join('loaitraicay', 'loaitraicay.MaLoai', '=', 'traicay.MaLoai')->select('*')->paginate(5);
        return view("/admin/templates/traicay/data_sanpham", compact('traicays', 'flag', 'thongbao'));
    }
    public function deletesp(request $request, $id)
    {
        $thongbao = '';
        try {
            if ($request->ajax()) {
                DB::table('gallery')->where('MaTCay', $id)->delete();
                DB::table('traicay')->where('MaTraiCay', $id)->delete();
                $thongbao = 'Xóa trái cây thành công !';
                $flag = 0;
            }
        } catch (\Exception $e) {
            $thongbao = 'Xóa trái cây thất bại  !';
            $flag = 1;
        }
        $traicays = DB::table('traicay')->join('loaitraicay', 'loaitraicay.MaLoai', '=', 'traicay.MaLoai')->select('*')->paginate(5);
        return view("/admin/templates/traicay/data_sanpham", compact('traicays', 'flag', 'thongbao'))->render();
    }


   /* Hóa đơn */
   public function hoadonview()
   {
       $hoadons = DB::table('hoadon')
       ->join('taikhoan', 'taikhoan.MaTaiKhoan', '=', 'hoadon.MaTaiKhoan')
       ->select('*')->paginate(5);
       return view('/admin/templates/hoadon/hoadon', compact('hoadons'));
   }

   public function gethoadon(request $request)
   {
       if ($request->ajax()) {
           $hoadons = DB::table('hoadon')
           ->join('taikhoan', 'taikhoan.MaTaiKhoan', '=', 'hoadon.MaTaiKhoan')

           ->select('*')->paginate(5);
           return view('/admin/templates/hoadon/data_hoadon', compact('hoadons'))->render();
       }
   }
   public function getcthoadonid(request $request, $id)
   {
       $hoadons = DB::table('hoadon')->where('hoadon.MaHD', $id)->select('*')->get();
       $sphoadons = DB::table('hoadon')
       ->where('hoadon.MaHD', $id)
       ->join('ct_hoadon', 'hoadon.MaHD', '=', 'ct_hoadon.MaHD')
       ->join('traicay','traicay.MaTraiCay','=','ct_hoadon.MaTraiCay')
       ->leftJoin('banggia', function($join) {
           $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
           ->where('NgayBatDau', '<=', Carbon::now())
           ->where('NgayKetThuc', '>=', Carbon::now());
       })
       ->join('donvi','donvi.MaDonVi','traicay.UnitID')
       ->select('*','ct_hoadon.SoLuong as sl')->get();
       return view('/admin/templates/hoadon/ct_hoadon', compact('hoadons', 'sphoadons'));
   }
   public function capnhatttdon(Request $request)
   {
       $id = $request->input('mahd');
       //
       $hoanthanh=DB::table('hoadon')
       ->where('MaHD', $id)->select('TinhTrang')->get()->first();
       //
       if($request->input('tinh_trang')=='Hoàn thành'&& $request->input('tinh_trang') != $hoanthanh->TinhTrang)
       {
            $danhgia='false';
            $traicaylist = DB::table('ct_hoadon')
            ->where('MaHD', $id)
            ->select('MaTraiCay','SoLuong')->get();
               // Cập nhật lại số lượng
               foreach($traicaylist as $row)
               {
                    DB::table('traicay')
                   ->where('MaTraiCay', $row->MaTraiCay)
                   ->where('SoLuong', '>=',$row->SoLuong)
                   ->decrement('SoLuong',$row->SoLuong);
               // Cập nhật lại tình trạng hết hàng
                   DB::table('traicay')
                   ->where('MaTraiCay', $row->MaTraiCay)
                   ->where('SoLuong',0)
                   ->update(['TinhTrang'=>0]);
               }
       }  
       else 
           $danhgia='true';
       
       $tinhTrang = $request->input('tinh_trang');
       DB::table('hoadon')
           ->where('MaHD', $id)
           ->update([
               'TinhTrang' => $tinhTrang,
               'DanhGia'=>$danhgia,
       ]);
    }

   //biểu đồ
   public function getdashboard(request $request)
   {
       $namhientai = Carbon::now()->year;
       $mangdoanhthu = [];
       for ($month = 1; $month <= 12; $month++) {
           $mangdoanhthu[$month] = DB::table('thongke')->whereYear('Date', $namhientai)->whereMonth('Date', $month)->sum('TongDoanhThu');
       }
       $type= 'bar';
       return view("/admin/templates/dashboard", compact('mangdoanhthu','type'));
   }
  
   public function selectchart(request $request)
   {
       $mangdoanhthu = [];
       for ($month = 1; $month <= 12; $month++) {
           $mangdoanhthu[$month] = DB::table('thongke')->whereYear('Date', $request->year)->whereMonth('Date', $month)->sum('TongDoanhThu');
       }
       $type= $request->type;
       return view("/admin/templates/dashboard_data", compact('mangdoanhthu','type'));
   }


    // tìm kiếm theo sản phẩmsearchsanphamview
    public function  searchsanpham(request $request)
    {
        if ($request->ajax()) {
            $traicays = DB::table('traicay')->join('loaitraicay', 'loaitraicay.MaLoai', '=', 'traicay.MaLoai')->where('TenTraiCay', 'like', '%' . ($request->keyword) . '%')->paginate(5);
            $thongbao = "Kết quả tìm kiếm !";
            $flag = 0;
            return view("/admin/templates/traicay/data_sanpham", compact('traicays', 'thongbao', 'flag'))->render();
        }
    }


    //thêm input

    public function addinput(request $request)
    {
        $nhacungcaps = DB::table('nhacungcap')->select('*')->get();
        $traicays = DB::table('traicay')->select('*')->get();
        $mainput = $request->mainput;
        return view("admin/templates/nhaphang/add_input_data", compact('mainput', 'nhacungcaps', 'traicays'));
    }
    public function deleteinput(request $request)
    {
        $nhacungcaps = DB::table('nhacungcap')->select('*')->get();
        $traicays = DB::table('traicay')->select('*')->get();
        $mainput = $request->mainput;
        return view("admin/templates/nhaphang/add_input_data", compact('mainput', 'nhacungcaps', 'traicays'));
    }


    //Nhập hàng

    public function nhaphangview()
    {
        $thongbao = '';
        $lonhaps = DB::table('lo_nhap')->paginate(5);
        return view('/admin/templates/nhaphang/nhaphang', compact('lonhaps',  'thongbao'));
    }

    public function getnhaphang(request $request)
    {
        $thongbao = '';

        if ($request->ajax()) {
            $lonhaps = DB::table('lo_nhap')->paginate(5);
            return view('/admin/templates/nhaphang/data_nhaphang', compact('lonhaps', 'thongbao'))->render();
        }
    }
    public function addnhaphang()
    {
        $nhacungcaps = DB::table('nhacungcap')->select('*');
        $nhacungcaps = $nhacungcaps->get();
        $traicays = DB::table('traicay')->select('*');
        $traicays = $traicays->get();
        return view('/admin/templates/nhaphang/add_nhaphang', compact('nhacungcaps', 'traicays'));
    }
    public function getctnhaphangid($id)
    {
        $thongbao = '';
        $nhacungcaps = DB::table('nhacungcap')->select('*')->get();
        $traicays = DB::table('traicay')->select('*')->get();
        $nhaphangs = DB::table('nhaphang')->where('MaLoNhap', $id)->select('*')->get();
        $nhaphang2s = DB::table('nhaphang')->where('MaLoNhap', $id)->select('*')->first();;
        $lonhaps = DB::table('lo_nhap')->where('MaLo', $id)->select('*')->get();
        return view('/admin/templates/nhaphang/update_nhaphang', compact('nhacungcaps', 'nhaphangs', 'thongbao', 'nhaphang2s', 'lonhaps', 'traicays'));
    }

    public function insertnhaphang(request $request)
    {
        $thongbao = '';
        $nhaphangs = $request->input('nhaphangs');
        $nhacungcap = $request->input('nhacungcap');
        $giaban = $request->input('giaban');
        try {
            $max2 =  (DB::table('lo_nhap')->max('MaLo'));
            $lonhap3 = DB::table('lo_nhap')->select('*')->get();
            if ($max2 == 0) {
                $code2 = 1;
            } else {
                for ($i = 1; $i <= $max2; $i++) {

                    $lang = false;
                    foreach ($lonhap3 as $value) {

                        if ($i == $value->MaLo) {
                            $lang = true;
                            break;
                        }
                    }
                    if ($i == $max2) {
                        $i = $max2 + 1;
                        $lang = false;
                    }
                    if ($lang == false) {
                        $code2 = $i;
                        break;
                    }
                }
            }
            $datal = [
                'MaLo' =>  $code2,
                'TenLo' =>  $request->input('tenlo'),
            ];
            DB::table('lo_nhap')->insert($datal);
            if ($request->input('nhaphangs')) {
                foreach ($nhaphangs as $nhaphang) {
                    $max =  (DB::table('nhaphang')->max('MaNhapHang'));
                    $nhaphangs3 = DB::table('nhaphang')->select('*')->get();
                    if ($max == 0) {
                        $code = 1;
                    } else {
                        for ($i = 1; $i <= $max; $i++) {

                            $lang = false;
                            foreach ($nhaphangs3 as $value) {

                                if ($i == $value->MaNhapHang) {
                                    $lang = true;
                                    break;
                                }
                            }
                            if ($i == $max) {
                                $i = $max + 1;
                                $lang = false;
                            }
                            if ($lang == false) {
                                $code = $i;
                                break;
                            }
                        }
                    }
                    $existingItem = DB::table('nhaphang')
                        ->where('MaTraiCay', $nhaphang['MaTraiCay'])
                        ->where('MaLoNhap', $code2)
                        ->first();

                    if ($existingItem) {
                        DB::table('nhaphang')
                            ->where('MaTraiCay', $nhaphang['MaTraiCay'])
                            ->where('MaLoNhap', $code2)
                            ->update([
                                'SoLuong' => DB::raw('SoLuong + ' . $nhaphang['SoLuong']),
                                'GiaNhap' => $nhaphang['GiaNhap'],
                                'MaNhaCungCap' => $nhacungcap,
                            ]);
                    } else {
                        $data = [
                            'MaLoNhap' => $code2,
                            'MaTraiCay' => $nhaphang['MaTraiCay'],
                            'SoLuong' => $nhaphang['SoLuong'],
                            'GiaNhap' => $nhaphang['GiaNhap'],
                            'MaNhaCungCap' => $nhacungcap,
                            'MaNhapHang' => $code,
                        ];

                        DB::table('nhaphang')->insert($data);
                    }
                }
            }
            $thongbao = 'Thêm Lô nhập thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Thêm Lô nhập thất bại !';
            $flag = 1;
        }
        $lonhaps = DB::table('lo_nhap')->paginate(5);
        return view('/admin/templates/nhaphang/data_nhaphang', compact('lonhaps', 'flag', 'thongbao'))->render();
    }
    public function capnhatnhaphang(Request $request)
    {
        $nhaphangs = $request->input('nhaphangs');
        $nhacungcap = $request->input('nhacungcap');
        try {
            $code2 = $request->input('malo');
            DB::table('lo_nhap')
                ->where('MaLo', $request->input('malo'))
                ->update([
                    'TenLo' => $request->input('tenlo'),
                ]);
            if ($request->has('nhaphangs')) {
                foreach ($nhaphangs as $nhaphang) {
                    $max =  (DB::table('nhaphang')->max('MaNhapHang'));
                    $nhaphangs3 = DB::table('nhaphang')->select('*')->get();
                    if ($max == 0) {
                        $code = 1;
                    } else {
                        for ($i = 1; $i <= $max; $i++) {
                            $lang = false;
                            foreach ($nhaphangs3 as $value) {

                                if ($i == $value->MaNhapHang) {
                                    $lang = true;
                                    break;
                                }
                            }
                            if ($i == $max) {
                                $i = $max + 1;
                                $lang = false;
                            }
                            if ($lang == false) {
                                $code = $i;
                                break;
                            }
                        }
                    }
                    $existingItem = DB::table('nhaphang')
                        ->where('MaTraiCay', $nhaphang['MaTraiCay'])
                        ->where('MaLoNhap', $code2)
                        ->first();

                    if ($existingItem) {
                        DB::table('nhaphang')
                            ->where('MaTraiCay', $nhaphang['MaTraiCay'])
                            ->where('MaLoNhap', $code2)
                            ->update([
                                'SoLuong' => DB::raw('SoLuong + ' . $nhaphang['SoLuong']),
                                'GiaNhap' => $nhaphang['GiaNhap'],
                                'MaNhaCungCap' => $nhacungcap,
                            ]);
                    } else {
                        $data = [
                            'MaLoNhap' => $code2,
                            'MaTraiCay' => $nhaphang['MaTraiCay'],
                            'SoLuong' => $nhaphang['SoLuong'],
                            'GiaNhap' => $nhaphang['GiaNhap'],
                            'MaNhaCungCap' => $nhacungcap,
                            'MaNhapHang' => $code,
                        ];

                        DB::table('nhaphang')->insert($data);
                    }
                }
            }
            $thongbao = 'Cập nhật nhập hàng thành công!';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật nhập hàng thất bại!';
            $flag = 1;
        }

        $lonhaps = DB::table('lo_nhap')->paginate(5);


        return view('/admin/templates/nhaphang/data_nhaphang', compact('lonhaps', 'flag', 'thongbao'))->render();
    }
    public function deletenhaphang(request $request, $id)
    {
        $thongbao = '';
        try {
            DB::table('nhaphang')->where('MaLoNhap', $id)->delete();
            DB::table('lo_nhap')->where('MaLo', $id)->delete();
            $thongbao = 'Xóa Lô nhập thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa Lô nhập thất bại !';
            $flag = 1;
        }
        $lonhaps = DB::table('lo_nhap')->paginate(5);
        return view('/admin/templates/nhaphang/data_nhaphang', compact('lonhaps', 'flag', 'thongbao'))->render();
    }
    public function deletespnhaphang(request $request, $id, $id2)
    {
        try {
            DB::table('nhaphang')->where('MaLoNhap', $id)->where('MaTraiCay', $id2)->delete();
            $thongbao = 'Xóa trái cây trong Lô nhập thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa trái cây trong Lô nhập thất bại !';
            $flag = 1;
        }
        $nhacungcaps = DB::table('nhacungcap')->select('*')->get();
        $traicays = DB::table('traicay')->select('*')->get();
        $nhaphangs = DB::table('nhaphang')->where('MaLoNhap', $id)->select('*')->get();
        $nhaphang2s = DB::table('nhaphang')->where('MaLoNhap', $id)->select('*')->first();;
        $lonhaps = DB::table('lo_nhap')->where('MaLo', $id)->select('*')->get();
        return view('/admin/templates/nhaphang/update_nhaphang', compact('nhacungcaps', 'flag', 'nhaphangs', 'thongbao', 'nhaphang2s', 'lonhaps', 'traicays'));
    }


    /* Hình Ảnh video */

    public function view_oneimg($loai)
    {
        $thongbao = '';
        $albums = DB::table('album')->where('Loai', $loai)->select('*')->get();
        $loais = $loai;
        return view('/admin/templates/hinhanh/oneimg', compact('albums', 'loais', 'thongbao'));
    }
    public function capnhatoneimg(request $request)
    {
        $loai = $request->input('loai');
        $with = $request->input('with');
        $hight = $request->input('hight');
        try {
            $exists = DB::table('album')->where('Loai', $loai)->count();
            if ($exists == 0) {
                if ($request->hasFile('image')) {
                    $max = (DB::table('album')->max('MaAlbum'));
                    $code = 0;
                    $albumsi = DB::table('album')->select('*')->get();
                    if ($max == 0) {
                        $code = 1;
                    } else {
                        for ($i = 1; $i <= $max; $i++) {

                            $lang = false;
                            foreach ($albumsi as $value) {

                                if ($i == $value->MaAlbum) {
                                    $lang = true;
                                    break;
                                }
                            }
                            if ($i == $max) {
                                $i = $max + 1;
                                $lang = false;
                            }
                            if ($lang == false) {
                                $code = $i;
                                break;
                            }
                        }
                    }

                    $request->validate([

                        'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                    ]);
                    $name = $request->file('image')->getClientOriginalName();
                    $imageName = $name;
                    $request->image->move(public_path('images/album'), $imageName);
                    $imagePath = 'images/album/' . $imageName;
                    $resizedImage = Image::make(public_path($imagePath))
                        ->resize($with, $hight)
                        ->save();
                    $albumi = DB::table('album')->insert(
                        array(
                            'MaAlbum' => $code,
                            'HinhAnh' => $imageName,
                            'Loai' => $request->input('loai'),
                        )
                    );
                }
                $thongbao = 'Thêm mới ' . $loai . ' thành công !';
                $flag = 0;
            } else {
                if ($request->hasFile('image')) {
                    if ($with != null && $hight != null) {
                        $request->validate([

                            'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                        ]);
                        $name = $request->file('image')->getClientOriginalName();
                        $imageName = $name;
                        $request->image->move(public_path('images/album'), $imageName);
                        $imagePath = 'images/album/' . $imageName;
                        $resizedImage = Image::make(public_path($imagePath))
                            ->resize($with, $hight)
                            ->save();
                        $albumi = DB::table('album')->where('MaAlbum', $request->input('MaAlbum'))->update(
                            [
                                'HinhAnh' => $imageName,
                                'Loai' => $request->input('loai'),
                            ]
                        );
                    }
                    $thongbao = 'Cập nhật ' . $loai . ' thành công !';
                    $flag = 0;
                } else {
                    $albumi = DB::table('album')->where('MaAlbum', $request->input('MaAlbum'))->update(
                        [
                            'Loai' => $request->input('loai'),
                        ]
                    );
                    if ($with != null && $hight != null) {
                        $album2 = DB::table('album')->where('MaAlbum', $request->input('MaAlbum'))->first();
                        $imageName = $album2->HinhAnh;
                        $imagePath = 'images/album/' . $imageName;
                        $resizedImage = Image::make(public_path($imagePath))
                            ->resize($with, $hight)
                            ->save();
                    }
                }
                $thongbao = 'cập nhật ' . $loai . ' thành công !';
                $flag = 0;
            }
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật' . $loai . ' thất bại !';
            $flag = 1;
        }


        $albums = DB::table('album')->where('Loai', $loai)->select('*')->get();
        $loais = $loai;
        return view('/admin/templates/hinhanh/data_oneimg', compact('albums', 'loais', 'flag', 'thongbao'));
    }
    public function albumview($loai)
    {
        $thongbao = '';
        $loais = $loai;
        $albums = DB::table('album')->where('Loai', $loai)->paginate(5);
        return view('/admin/templates/hinhanh/album', compact('albums', 'loais', 'thongbao'));
    }
    public function getalbum(request $request)
    {
        $thongbao = '';
        if ($request->ajax()) {
            $loais = $request->loai;
            $albums = DB::table('album')->where('Loai', $request->loai)->paginate(5);
            return view('/admin/templates/hinhanh/data_album', compact('albums', 'loais', 'thongbao'))->render();
        }
    }

    public function getctalbum(request $request)
    {
        $loais = $request->loai;
        return view("/admin/templates/hinhanh/ct_album", compact('loais'));
    }
    public function getctalbumid(request $request, $id)
    {
        $loais = $request->loai;
        $albums = DB::table('album')->where('MaAlbum', $id)->where('Loai', $loais)->select('*')->get();
        return view("admin/templates/hinhanh/ct_album2", compact('albums', 'loais'));
    }
    public function insertalbum(request $request)
    {
        $loais = $request->input('loai');
        $with = $request->input('with');
        $hight = $request->input('hight');
        $thongbao = '';
        try {
            if ($request->hasFile('image')) {
                $max =  (DB::table('album')->max('MaAlbum'));
                $code = 0;
                $albumsi = DB::table('album')->select('*')->get();
                if ($max == 0) {
                    $code = 1;
                } else {
                    for ($i = 1; $i <= $max; $i++) {

                        $lang = false;
                        foreach ($albumsi as $value) {

                            if ($i == $value->MaAlbum) {
                                $lang = true;
                                break;
                            }
                        }
                        if ($i == $max) {
                            $i = $max + 1;
                            $lang = false;
                        }
                        if ($lang == false) {
                            $code = $i;
                            break;
                        }
                    }
                }

                $request->validate([

                    'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                ]);
                $name = $request->file('image')->getClientOriginalName();
                $imageName = $name;

                $request->image->move(public_path('images/album'), $imageName);
                $imagePath = 'images/album/' . $imageName;
                $resizedImage = Image::make(public_path($imagePath))
                    ->resize($with, $hight)
                    ->save();
                $albumi = DB::table('album')->insert(
                    array(
                        'MaAlbum' => $code,
                        'HinhAnh' => $imageName,
                        'LinkVideo' => $request->input('linkvideo'),
                        'TieuDe' => $request->input('tieude'),
                        'Link' => $request->input('link'),
                        'Loai' => $loais,
                    )
                );
            }
            $thongbao = 'Thêm ' . $loais . ' thành công !';
            $flag=0;
        } catch (\Exception $e) {
            $thongbao = 'Thêm ' . $loais . ' thất bại !';
            $flag=1;
        }


        $albums = DB::table('album')->where('Loai', $loais)->paginate(5);
        return view("/admin/templates/hinhanh/data_album", compact('albums', 'loais', 'flag','thongbao'));
    }

    public function deletealbum(request $request, $id)
    {

        $loais = $request->loai;
        $thongbao = '';
        try {
            DB::table('album')->where('MaAlbum', $id)->delete();
            $thongbao = 'Xóa ' . $loais . ' thành công !';
            $flag=0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa ' . $loais . ' thất bại !';
            $flag=1;
        }
        $albums = DB::table('album')->where('Loai', $loais)->paginate(5);
        return view("/admin/templates/hinhanh/data_album", compact('albums', 'loais','flag', 'thongbao'));
    }
    public function updatealbum(Request $request)
    {
        $loais = $request->input('loai');
        $with = $request->input('with');
        $hight = $request->input('hight');
        $thongbao = '';
        try {
            if ($request->hasFile('image')) {
                $request->validate([

                    'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                ]);
                $name = $request->file('image')->getClientOriginalName();
                $imageName = $name;
                $request->image->move(public_path('images/album'), $imageName);
                $imagePath = 'images/album/' . $imageName;
                $resizedImage = Image::make(public_path($imagePath))
                    ->resize($with, $hight)
                    ->save();
                $albumi = DB::table('album')->where('MaAlbum', $request->input('MaAlbum'))->update(
                    [
                        'HinhAnh' => $imageName,
                        'LinkVideo' => $request->input('linkvideo'),
                        'TieuDe' => $request->input('tieude'),
                        'Link' => $request->input('link'),
                        'Loai' => $loais,
                    ]
                );
            } else {
                $albumi = DB::table('album')->where('MaAlbum', $request->input('MaAlbum'))->update(
                    [
                        'LinkVideo' => $request->input('linkvideo'),
                        'TieuDe' => $request->input('tieude'),
                        'Link' => $request->input('link'),
                        'Loai' => $loais,
                    ]
                );
                if($with!=null && $hight!= null)
                {
                $album2 = DB::table('album')->where('MaAlbum', $request->input('MaAlbum'))->select('*')->get();
                foreach ($album2 as $image) {
                    $imageName = $image->HinhAnh;
                    $imagePath = 'images/album/' . $imageName;
                    $resizedImage = Image::make(public_path($imagePath))
                        ->resize($with, $hight)
                        ->save();
                }
            }
            }
            $thongbao = 'Cập nhật ' . $loais . ' thành công !';
            $flag=0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật ' . $loais . ' thất bại !';
            $flag=1;
        }

        $albums = DB::table('album')->where('Loai', $loais)->paginate(5);
        return view("/admin/templates/hinhanh/data_album", compact('albums','flag', 'loais', 'thongbao'));
    }
    /* Tài khoản */
    public function accountview()
    {
        $thongbao = '';
        $accounts = DB::table('taikhoan')->paginate(5);
        return view('/admin/templates/taikhoan/account', compact('accounts', 'thongbao'));
    }

    public function getaccount(request $request)
    {
        $thongbao = '';
        if ($request->ajax()) {
            $accounts = DB::table('taikhoan')->paginate(5);
            return view('/admin/templates/taikhoan/data_account', compact('accounts', 'thongbao'))->render();
        }
    }
    public function getctaccount(request $request)
    {
        return view("/admin/templates/taikhoan/ct_account");
    }
    public function getctaccountid(request $request, $id)
    {
        $accounts = DB::table('taikhoan')->where('MaTaiKhoan', $id)->select('*')->get();
        return view("admin/templates/taikhoan/ct_account2", compact('accounts'));
    }
    public function insertaccount(request $request)
    {

        $thongbao = '';
        try {
            $isadmin = $request->input('isadmin');
            if ($isadmin == '') {
                $isadmin = 0;
            }
            if ($request->hasFile('image')) {
                $max =  (DB::table('taikhoan')->max('MaTaiKhoan'));
                $accountsi = DB::table('taikhoan')->select('*')->get();

                if ($max == 0) {
                    $code = 1;
                } else {
                    for ($i = 1; $i <= $max; $i++) {

                        $lang = false;
                        foreach ($accountsi as $value) {

                            if ($i == $value->MaTaiKhoan) {
                                $lang = true;
                                break;
                            }
                        }
                        if ($i == $max) {
                            $i = $max + 1;
                            $lang = false;
                        }
                        if ($lang == false) {
                            $code = $i;
                            break;
                        }
                    }
                }

                $request->validate([
                    'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                ]);
                $name = $request->file('image')->getClientOriginalName();
                $imageName = $name;
                $request->image->move(public_path('images/avatar'), $imageName);
                $accounti = DB::table('taikhoan')->insert(
                    array(
                        'MaTaiKhoan' => $code,
                        'Avatar' => $imageName,
                        'TaiKhoan' => $request->input('taikhoan'),
                        'MatKhau' => $request->input('matkhau'),
                        'Email' => $request->input('email'),
                        'Phone' => $request->input('phone'),
                        'DiaChi' => $request->input('diachi'),
                        'HoTen' => $request->input('hoten'),
                        'TrangThai' => 1,
                        'IsAdmin' => $isadmin,
                    )
                );
            }
            $thongbao = 'Thêm tài khoản thành công !';

            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Thêm tài khoản thất bại !';
            $flag = 1;
        }
        $accounts = DB::table('taikhoan')->paginate(5);
        return view("/admin/templates/taikhoan/data_account", compact('accounts', 'flag', 'thongbao'));
    }

    public function deleteaccount(request $request, $id)
    {
        $thongbao = '';
        try {
            DB::table('taikhoan')->where('MaTaiKhoan', $id)->delete();
            $thongbao = 'Xóa tài khoản thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa tài khoản thất bại !';
            $flag = 1;
        }
        $accounts = DB::table('taikhoan')->paginate(5);
        return view("/admin/templates/taikhoan/data_account", compact('accounts', 'flag', 'thongbao'));
    }
    public function updateaccount(Request $request)
    {
        $thongbao = '';
        try {
            if ($request->hasFile('image')) {
                $request->validate([

                    'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                ]);
                $name = $request->file('image')->getClientOriginalName();
                $imageName = $name;

                $request->image->move(public_path('images/avatar'), $imageName);
                $accounti = DB::table('taikhoan')->where('MaTaiKhoan', $request->input('mataikhoan'))->update(
                    [
                        'Avatar' => $imageName,
                        'TaiKhoan' => $request->input('taikhoan'),
                        'MatKhau' => $request->input('matkhau'),
                        'Email' => $request->input('email'),
                        'Phone' => $request->input('phone'),
                        'TrangThai' => $request->input('trangthai'),
                        'DiaChi' => $request->input('diachi'),
                        'HoTen' => $request->input('hoten'),
                        'IsAdmin' => $request->input('isadmin'),
                    ]
                );
            } else {
                $accounti = DB::table('taikhoan')->where('MaTaiKhoan', $request->input('mataikhoan'))->update(
                    [
                        'TaiKhoan' => $request->input('taikhoan'),
                        'MatKhau' => $request->input('matkhau'),
                        'Email' => $request->input('email'),
                        'Phone' => $request->input('phone'),
                        'DiaChi' => $request->input('diachi'),
                        'TrangThai' => $request->input('trangthai'),
                        'HoTen' => $request->input('hoten'),
                        'IsAdmin' => $request->input('isadmin'),
                    ]
                );
            }
            $thongbao = 'Cập nhật tài khoản thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật tài khoản thất bại !';
            $flag = 1;
        }
        $accounts = DB::table('taikhoan')->paginate(5);
        return view("/admin/templates/taikhoan/data_account", compact('accounts', 'flag', 'thongbao'));
    }

    public function deletegallery(request $request, $id, $loai, $idsp)
    {
        $deleted = DB::table('gallery')->where('MaGallery', $id)->where('Loai', $loai)->delete();
        if ($loai == 'san-pham') {
            $albums1 = DB::table('gallery')->where('MaTCay', $idsp)->where('Loai', $loai)->select('*')->get();
        } else {
            $albums1 = DB::table('gallery')->where('MaGQ', $idsp)->where('Loai', $loai)->select('*')->get();
        }
        $masp = $idsp;
        return view("admin/templates/data_gallery", compact('albums1', 'masp'));
    }


    /* Loại trái cây */
    public function loaispview()
    {
        $thongbao = '';
        $loaisps = DB::table('loaitraicay')->paginate(5);
        return view('/admin/templates/traicay/loaisp', compact('loaisps', 'thongbao'));
    }

    public function getloaisp(request $request)
    {
        $thongbao = '';
        if ($request->ajax()) {
            $loaisps = DB::table('loaitraicay')->paginate(5);
            return view('/admin/templates/traicay/data_loaisp', compact('loaisps', 'thongbao'))->render();
        }
    }
    public function getctloaisp(request $request)
    {
        return view("/admin/templates/traicay/ct_loaisp");
    }
    public function getctloaispid(request $request, $id)
    {
        $loaisps = DB::table('loaitraicay')->where('MaLoai', $id)->select('*')->get();
        return view("admin/templates/traicay/ct_loaisp2", compact('loaisps'));
    }
    public function insertloaisp(request $request)
    {
        $thongbao = '';
        try {
            $max =  (DB::table('loaitraicay')->max('MaLoai'));
            $loaispsi = DB::table('loaitraicay')->select('*')->get();

            if ($max == 0) {
                $code = 1;
            } else {
                for ($i = 1; $i <= $max; $i++) {

                    $lang = false;
                    foreach ($loaispsi as $value) {

                        if ($i == $value->MaLoai) {
                            $lang = true;
                            break;
                        }
                    }
                    if ($i == $max) {
                        $i = $max + 1;
                        $lang = false;
                    }
                    if ($lang == false) {
                        $code = $i;
                        break;
                    }
                }
            }
            $loaispi = DB::table('loaitraicay')->insert(
                array(
                    'MaLoai' => $code,
                    'TenLoai' => $request->input('tenloai'),
                    'MoTa' => $request->input('mota'),
                )
            );
            $thongbao = 'Thêm loại trái cây thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Thêm loại trái cây thất bại !';
            $flag = 1;
        }

        $loaisps = DB::table('loaitraicay')->paginate(5);
        return view("/admin/templates/traicay/data_loaisp", compact('loaisps', 'flag', 'thongbao'));
    }

    public function deleteloaisp(request $request, $id)
    {
        $thongbao = '';
        try {
            DB::table('loaitraicay')->where('MaLoai', $id)->delete();
            $thongbao = 'Xóa loại trái cây thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa loại trái cây thất bại !';
            $flag = 1;
        }

        $loaisps = DB::table('loaitraicay')->paginate(5);
        return view("/admin/templates/traicay/data_loaisp", compact('loaisps', 'flag', 'thongbao'));
    }
    public function updateloaisp(Request $request)
    {
        $thongbao = '';
        try {
            $loaispi = DB::table('loaitraicay')->where('MaLoai', $request->input('maloai'))->update(
                [
                    'TenLoai' => $request->input('tenloai'),
                    'MoTa' => $request->input('mota'),
                ]
            );
            $thongbao = 'Cập nhật loại trái cây thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật loại trái cây thất bại !';
            $flag = 1;
        }

        $loaisps = DB::table('loaitraicay')->paginate(5);
        return view("/admin/templates/traicay/data_loaisp", compact('loaisps', 'flag', 'thongbao'));
    }

    /* Loại giở quà */
    public function loaigioquaview()
    {
        $thongbao = '';
        $loaigioquas = DB::table('loaigioqua')->paginate(5);
        return view('/admin/templates/gioqua/loaigioqua', compact('loaigioquas', 'thongbao'));
    }

    public function getloaigioqua(request $request)
    {
        $thongbao = '';
        if ($request->ajax()) {
            $loaigioquas = DB::table('loaigioqua')->paginate(5);
            return view('/admin/templates/gioqua/data_loaigioqua', compact('loaigioquas', 'thongbao'))->render();
        }
    }
    public function getctloaigioqua(request $request)
    {
        return view("/admin/templates/gioqua/ct_loaigioqua");
    }
    public function getctloaigioquaid(request $request, $id)
    {
        $loaigioquas = DB::table('loaigioqua')->where('MaLoai', $id)->select('*')->get();
        return view("admin/templates/gioqua/ct_loaigioqua2", compact('loaigioquas'));
    }
    public function insertloaigioqua(request $request)
    {
        $thongbao = '';
        try {
            $max =  (DB::table('loaigioqua')->max('MaLoai'));
            $loaigioquasi = DB::table('loaigioqua')->select('*')->get();

            if ($max == 0) {
                $code = 1;
            } else {
                for ($i = 1; $i <= $max; $i++) {

                    $lang = false;
                    foreach ($loaigioquasi as $value) {

                        if ($i == $value->MaLoai) {
                            $lang = true;
                            break;
                        }
                    }
                    if ($i == $max) {
                        $i = $max + 1;
                        $lang = false;
                    }
                    if ($lang == false) {
                        $code = $i;
                        break;
                    }
                }
            }
            $loaigioquai = DB::table('loaigioqua')->insert(
                array(
                    'MaLoai' => $code,
                    'TenLoai' => $request->input('tenloai'),
                    'MoTa' => $request->input('mota'),
                )
            );
            $thongbao = 'Thêm loại giỏ quà thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Thêm loại giỏ quà thất bại !';
            $flag = 1;
        }

        $loaigioquas = DB::table('loaigioqua')->paginate(5);
        return view("/admin/templates/gioqua/data_loaigioqua", compact('loaigioquas', 'flag', 'thongbao'));
    }

    public function deleteloaigioqua(request $request, $id)
    {
        $thongbao = '';
        try {
            DB::table('loaigioqua')->where('MaLoai', $id)->delete();
            $thongbao = 'Xóa loại giỏ quà thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa loại giỏ quà thất bại !';
            $flag = 1;
        }

        $loaigioquas = DB::table('loaigioqua')->paginate(5);
        return view("/admin/templates/gioqua/data_loaigioqua", compact('loaigioquas', 'flag', 'thongbao'));
    }
    public function updateloaigioqua(Request $request)
    {
        $thongbao = '';
        try {
            $loaigioquai = DB::table('loaigioqua')->where('MaLoai', $request->input('maloai'))->update(
                [
                    'TenLoai' => $request->input('tenloai'),
                    'MoTa' => $request->input('mota'),
                ]
            );
            $thongbao = 'Cập nhật loại giỏ quà thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật loại giỏ quà thất bại !';
            $flag = 1;
        }

        $loaigioquas = DB::table('loaigioqua')->paginate(5);
        return view("/admin/templates/gioqua/data_loaigioqua", compact('loaigioquas', 'flag', 'thongbao'));
    }

    /* Nhà cung cấp */
    public function nhacungcapview()
    {
        $thongbao = '';
        $nhacungcaps = DB::table('nhacungcap')->paginate(5);
        return view('/admin/templates/nhacungcap/nhacungcap', compact('nhacungcaps', 'thongbao'));
    }
    public function getnhacungcap(request $request)
    {
        $thongbao = '';
        if ($request->ajax()) {
            $nhacungcaps = DB::table('nhacungcap')->paginate(5);
            return view('/admin/templates/nhacungcap/data_nhacungcap', compact('nhacungcaps', 'thongbao'))->render();
        }
    }
    public function getctnhacungcap(request $request)
    {
        return view("/admin/templates/nhacungcap/ct_nhacungcap");
    }
    public function getctnhacungcapid(request $request, $id)
    {
        $nhacungcaps = DB::table('nhacungcap')->where('MaNcc', $id)->select('*')->get();
        return view("admin/templates/nhacungcap/ct_nhacungcap2", compact('nhacungcaps'));
    }
    public function insertnhacungcap(request $request)
    {
        $thongbao = '';
        try {
            $max =  (DB::table('nhacungcap')->max('MaNcc'));
            $nhacungcapsi = DB::table('nhacungcap')->select('*')->get();

            if ($max == 0) {
                $code = 1;
            } else {
                for ($i = 1; $i <= $max; $i++) {

                    $lang = false;
                    foreach ($nhacungcapsi as $value) {

                        if ($i == $value->MaNcc) {
                            $lang = true;
                            break;
                        }
                    }
                    if ($i == $max) {
                        $i = $max + 1;
                        $lang = false;
                    }
                    if ($lang == false) {
                        $code = $i;
                        break;
                    }
                }
            }
            $nhacungcapi = DB::table('nhacungcap')->insert(
                array(
                    'MaNcc' => $code,
                    'TenNcc' => $request->input('tenncc'),
                    'DiaChi' => $request->input('diachi'),
                    'Phone' => $request->input('phone'),
                    'SoFax' => $request->input('sofax'),
                    'DcMail' => $request->input('dcmail'),
                )
            );
            $thongbao = 'Thêm nhà cung cấp thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Thêm nhà cung cấp thất bại !';
            $flag = 1;
        }
        $nhacungcaps = DB::table('nhacungcap')->paginate(5);
        return view("/admin/templates/nhacungcap/data_nhacungcap", compact('nhacungcaps', 'flag', 'thongbao'));
    }

    public function deletenhacungcap(request $request, $id)
    {
        $thongbao = '';
        try {
            DB::table('nhacungcap')->where('MaNcc', $id)->delete();
            $thongbao = 'Xóa nhà cung cấp thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa nhà cung cấp thất bại !';
            $flag = 1;
        }

        $nhacungcaps = DB::table('nhacungcap')->paginate(5);
        return view("/admin/templates/nhacungcap/data_nhacungcap", compact('nhacungcaps', 'flag', 'thongbao'));
    }
    public function updatenhacungcap(Request $request)
    {
        try {
            $nhacungcapi = DB::table('nhacungcap')->where('MaNcc', $request->input('mancc'))->update(
                [
                    'TenNcc' => $request->input('tenncc'),
                    'DiaChi' => $request->input('diachi'),
                    'Phone' => $request->input('phone'),
                    'SoFax' => $request->input('sofax'),
                    'DcMail' => $request->input('dcmail'),
                ]
            );
            $thongbao = 'Cập nhật nhà cung cấp thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật nhà cung cấp thất bại !';
            $flag = 1;
        }
        $nhacungcaps = DB::table('nhacungcap')->paginate(5);
        return view("/admin/templates/nhacungcap/data_nhacungcap", compact('nhacungcaps', 'thongbao', 'flag'));
    }


    /* Đơn vị trái cây */
    public function donvispview()
    {
        $thongbao = '';
        $donvisps = DB::table('donvi')->paginate(5);
        return view('/admin/templates/donvi/donvisp', compact('donvisps', 'thongbao'));
    }

    public function getdonvisp(request $request)
    {
        $thongbao = '';
        if ($request->ajax()) {
            $donvisps = DB::table('donvi')->paginate(5);
            return view('/admin/templates/donvi/data_donvisp', compact('donvisps', 'thongbao'))->render();
        }
    }
    public function getctdonvisp(request $request)
    {
        return view("/admin/templates/donvi/ct_donvisp");
    }
    public function getctdonvispid(request $request, $id)
    {
        $donvisps = DB::table('donvi')->where('MaDonVi', $id)->select('*')->get();
        return view("admin/templates/donvi/ct_donvisp2", compact('donvisps'));
    }
    public function insertdonvisp(request $request)
    {
        $thongbao = '';
        try {
            $max =  (DB::table('donvi')->max('MaDonVi'));
            $donvispsi = DB::table('donvi')->select('*')->get();

            if ($max == 0) {
                $code = 1;
            } else {
                for ($i = 1; $i <= $max; $i++) {

                    $lang = false;
                    foreach ($donvispsi as $value) {

                        if ($i == $value->MaDonVi) {
                            $lang = true;
                            break;
                        }
                    }
                    if ($i == $max) {
                        $i = $max + 1;
                        $lang = false;
                    }
                    if ($lang == false) {
                        $code = $i;
                        break;
                    }
                }
            }
            $donvispi = DB::table('donvi')->insert(
                array(
                    'MaDonVi' => $code,
                    'TenDonVi' => $request->input('tendonvi'),
                )
            );
            $thongbao = 'Thêm đơn vị thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Thêm đơn vị thất bại !';
            $flag = 1;
        }

        $donvisps = DB::table('donvi')->paginate(5);
        return view("/admin/templates/donvi/data_donvisp", compact('donvisps', 'flag', 'thongbao'));
    }

    public function deletedonvisp(request $request, $id)
    {
        $thongbao = '';
        try {
            DB::table('donvi')->where('MaDonVi', $id)->delete();
            $thongbao = 'Xóa đơn vị thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa đơn vị thất bại !';
            $flag = 1;
        }
        $donvisps = DB::table('donvi')->paginate(5);
        return view("/admin/templates/donvi/data_donvisp", compact('donvisps', 'flag', 'thongbao'));
    }
    public function updatedonvisp(Request $request)
    {
        $thongbao = '';
        try {
            $donvispi = DB::table('donvi')->where('MaDonVi', $request->input('madonvi'))->update(
                [
                    'TenDonVi' => $request->input('tendonvi'),
                ]
            );
            $thongbao = 'Cập nhật đơn vị thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật đơn vị thất bại !';
            $flag = 1;
        }

        $donvisps = DB::table('donvi')->paginate(5);
        return view("/admin/templates/donvi/data_donvisp", compact('donvisps', 'flag', 'thongbao'));
    }


    /* bài viết */
    public function baivietview($loai)
    {
        $thongbao = '';
        $loais = $loai;
        $baiviets = DB::table('baiviet')->where('Loai', $loai)->paginate(5);
        return view('/admin/templates/baiviet/baiviet', compact('baiviets', 'loais', 'thongbao'));
    }

    public function getbaiviet(request $request)
    {
        $thongbao = '';
        if ($request->ajax()) {
            $loais = $request->loai;
            $baiviets = DB::table('baiviet')->where('Loai', $request->loai)->paginate(5);
            return view('/admin/templates/baiviet/data_baiviet', compact('baiviets', 'loais', 'thongbao'))->render();
        }
    }

    public function getctbaiviet(request $request)
    {
        $loais = $request->loai;
        return view("/admin/templates/baiviet/ct_baiviet", compact('loais'));
    }
    public function getctbaivietid(request $request, $id)
    {
        $loais = $request->loai;
        $baiviets = DB::table('baiviet')->where('MaBaiViet', $id)->where('Loai', $loais)->select('*')->get();
        return view("admin/templates/baiviet/ct_baiviet2", compact('baiviets', 'loais'));
    }
    public function insertbaiviet(request $request)
    {
        $thongbao = '';
        $loais = $request->input('loai');
        $with = $request->input('with');
        $hight = $request->input('hight');
        if ($with == null) {
            $with = 600;
        }
        if ($hight == null) {
            $hight = 600;
        }
        try {
            if ($request->hasFile('image')) {
                $max =  (DB::table('baiviet')->max('MaBaiViet'));
                $code = 0;
                $baivietsi = DB::table('baiviet')->select('*')->get();
                if ($max == 0) {
                    $code = 1;
                } else {
                    for ($i = 1; $i <= $max; $i++) {

                        $lang = false;
                        foreach ($baivietsi as $value) {

                            if ($i == $value->MaBaiViet) {
                                $lang = true;
                                break;
                            }
                        }
                        if ($i == $max) {
                            $i = $max + 1;
                            $lang = false;
                        }
                        if ($lang == false) {
                            $code = $i;
                            break;
                        }
                    }
                }

                $request->validate([

                    'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                ]);
                $name = $request->file('image')->getClientOriginalName();
                $imageName = $name;

                $request->image->move(public_path('images/baiviet'), $imageName);
                $imagePath = 'images/baiviet/' . $imageName;
                $resizedImage = Image::make(public_path($imagePath))
                    ->resize($with, $hight)
                    ->save();
                $baivieti = DB::table('baiviet')->insert(
                    array(
                        'MaBaiViet' => $code,
                        'TieuDe' => $request->input('TieuDe'),
                        'MoTa' => $request->input('MoTa'),
                        'Anh' => $imageName,
                        'NoiDung' => $request->noidung,
                        'Loai' => $loais,
                        'NgayDang' => Carbon::now(),
                        'TinhTrang' => $request->input('tinhtrang'),
                    )
                );
            }
            $thongbao = 'Thêm' . $loais . 'thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Thêm' . $loais . 'thất bại !';
            $flag = 1;
        }

        $baiviets = DB::table('baiviet')->where('Loai', $loais)->paginate(5);
        return view("/admin/templates/baiviet/data_baiviet", compact('baiviets', 'flag', 'loais', 'thongbao'));
    }

    public function deletebaiviet(request $request, $id)
    {
        $thongbao = '';
        $loais = $request->loai;
        try {
            DB::table('baiviet')->where('MaBaiViet', $id)->delete();
            $thongbao = 'Xóa ' . $loais . ' thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa ' . $loais . ' thất bại !';
            $flag = 1;
        }
        $baiviets = DB::table('baiviet')->where('Loai', $loais)->paginate(5);
        return view("/admin/templates/baiviet/data_baiviet", compact('baiviets', 'flag', 'loais', 'thongbao'));
    }
    public function updatebaiviet(Request $request)
    {

        $loais = $request->input('loai');
        $with = $request->input('with');
        $hight = $request->input('hight');
        $thongbao = '';
        if ($with == null) {
            $with = 600;
        }
        if ($hight == null) {
            $hight = 600;
        }
        try {
            if ($request->hasFile('image')) {
                $request->validate([

                    'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                ]);
                $name = $request->file('image')->getClientOriginalName();
                $imageName = $name;
                $request->image->move(public_path('images/baiviet'), $imageName);
                $imagePath = 'images/baiviet/' . $imageName;
                $resizedImage = Image::make(public_path($imagePath))
                    ->resize($with, $hight)
                    ->save();
                $baivieti = DB::table('baiviet')->where('MaBaiViet', $request->input('MaBaiViet'))->update(
                    [
                        'TieuDe' => $request->input('TieuDe'),
                        'MoTa' => $request->input('MoTa'),
                        'Anh' => $imageName,
                        'NoiDung' => $request->noidung,
                        'Loai' => $loais,
                        'NgayDang' => Carbon::now(),
                        'TinhTrang' => $request->input('tinhtrang'),
                    ]
                );
            } else {
                $baivieti = DB::table('baiviet')->where('MaBaiViet', $request->input('MaBaiViet'))->update(
                    [
                        'TieuDe' => $request->input('TieuDe'),
                        'MoTa' => $request->input('MoTa'),
                        'NoiDung' => $request->noidung,
                        'Loai' => $loais,
                        'NgayDang' => Carbon::now(),
                        'TinhTrang' => $request->input('tinhtrang'),
                    ]
                );
                $baiviet2 = DB::table('baiviet')->where('MaBaiViet', $request->input('MaBaiViet'))->first();
                $imageName =  $baiviet2->Anh;
                $imagePath = 'images/baiviet/' . $imageName;
                $resizedImage = Image::make(public_path($imagePath))
                    ->resize($with, $hight)
                    ->save();
            }
            $thongbao = 'Cập nhật ' . $loais . ' thành công !';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật ' . $loais . ' thất bại !';
            $flag = 1;
        }
        $baiviets = DB::table('baiviet')->where('Loai', $loais)->paginate(5);
        return view("/admin/templates/baiviet/data_baiviet", compact('baiviets', 'flag', 'loais', 'thongbao'));
    }


    public function view_onebaiviet($loai)
    {
        $thongbao = '';
        $baiviets = DB::table('baiviet')->where('Loai', $loai)->select('*')->get();
        $loais = $loai;
        return view('/admin/templates/baiviet/onebaiviet', compact('baiviets', 'loais', 'thongbao'));
    }
    public function capnhatonebaiviet(request $request)
    {
        $loai = $request->input('loai');
        try {
            $exists = DB::table('baiviet')->where('Loai', $loai)->count();
            if ($exists == 0) {
                if ($request->hasFile('image')) {
                    $max = (DB::table('baiviet')->max('MaBaiViet'));
                    $code = 0;
                    $baivietsi = DB::table('baiviet')->select('*')->get();
                    if ($max == 0) {
                        $code = 1;
                    } else {
                        for ($i = 1; $i <= $max; $i++) {

                            $lang = false;
                            foreach ($baivietsi as $value) {

                                if ($i == $value->MaBaiViet) {
                                    $lang = true;
                                    break;
                                }
                            }
                            if ($i == $max) {
                                $i = $max + 1;
                                $lang = false;
                            }
                            if ($lang == false) {
                                $code = $i;
                                break;
                            }
                        }
                    }
                    $baivieti = DB::table('baiviet')->insert(
                        array(
                            'MaBaiViet' => $code,
                            'TieuDe' => $request->input('TieuDe'),
                            'MoTa' => $request->input('MoTa'),
                            'NoiDung' => $request->noidung,
                            'Loai' => $request->input('loai'),
                            'NgayDang' => Carbon::now(),
                            'TinhTrang' => $request->input('tinhtrang'),
                        )
                    );
                }
                $thongbao = 'Thêm ' . $loai . ' thành công !';
                $flag = 0;
            } else {
                $baivieti = DB::table('baiviet')->where('MaBaiViet', $request->input('MaBaiViet'))->update(
                    [
                        'TieuDe' => $request->input('TieuDe'),
                        'MoTa' => $request->input('MoTa'),
                        'NoiDung' => $request->noidung,
                        'Loai' => $request->input('loai'),
                        'NgayDang' => Carbon::now(),
                        'TinhTrang' => $request->input('tinhtrang'),
                    ]
                );
                $thongbao = 'Cập nhật ' . $loai . ' thành công !';
                $flag = 0;
            }
        } catch (\Exception $e) {
            $thongbao = 'Thay đổi ' . $loai . ' thất bại !';
            $flag = 1;
        }
        $baiviets = DB::table('baiviet')->where('Loai', $loai)->select('*')->get();
        $loais = $loai;
        return view('/admin/templates/baiviet/data_onebaiviet', compact('baiviets', 'flag', 'loais', 'thongbao'));
    }



    /* Giỏ quà */
    public function add_input_gioqua(request $request, $id)
    {
        $traicays = DB::table('traicay')->where('MaTraiCay', $id)->get();
        return view('/admin/templates/gioqua/data_add_input_GQ', compact('traicays'));
    }
    public function gioquaview()
    {
        $gioquas = DB::table('gioqua')->paginate(5);
        $thongbao = '';
        return view('/admin/templates/gioqua/gioqua', compact('gioquas', 'thongbao'));
    }

    public function getgioqua(request $request)
    {
        if ($request->ajax()) {
            $thongbao = '';
            $gioquas = DB::table('gioqua')->paginate(5);
            return view('/admin/templates/gioqua/data_gioqua', compact('gioquas', 'thongbao'))->render();
        }
    }
    public function getctgioqua(request $request)
    {
        $traicays = DB::table('traicay')->select('*')->get();
        $loaigioquas = DB::table('loaigioqua')->select('*')->get();
        return view("/admin/templates/gioqua/ct_gioqua", compact('traicays', 'loaigioquas'));
    }
    public function getctgioquaid(request $request, $id)
    {
        $gioqua = DB::table('gioqua')->where('MaGioQua', $id)->first();
        $traicays = DB::table('traicay')->select('*')->get();
        $traicaygqs = DB::table('gioqua_traicay')->where('gioqua_id', $id)
            ->join('traicay', 'traicay.MaTraiCay', '=', 'gioqua_traicay.traiCay_id')->get();
        $albums = DB::table('gallery')->where('MaGQ', $id)->where('Loai', 'gio-qua')->select('*')->get();
        $gioquas = DB::table('gioqua')->where('MaGioQua', $id)->select('*')->get();
        $loaigioquas = DB::table('loaigioqua')->select('*')->get();
        return view("admin/templates/gioqua/ct_gioqua2", compact('gioquas', 'traicays', 'traicaygqs', 'albums', 'loaigioquas'));
    }
    public function xoa_input_gioqua(request $request, $id, $id2)
    {
        DB::table('gioqua_traicay')->where('gioqua_id', $id)->where('traicay_id', $id2)->delete();
        $gioqua = DB::table('gioqua')->where('MaGioQua', $id)->first();
        $traicays = DB::table('traicay')->select('*')->get();
        $traicaygqs = DB::table('gioqua_traicay')->where('gioqua_id', $id)
            ->join('traicay', 'traicay.MaTraiCay', '=', 'gioqua_traicay.traiCay_id')->get();
        $albums = DB::table('gallery')->where('MaGQ', $id)->where('Loai', 'gio-qua')->select('*')->get();
        $gioquas = DB::table('gioqua')->where('MaGioQua', $id)->select('*')->get();
        $loaigioquas = DB::table('loaigioqua')->select('*')->get();
        return view("admin/templates/gioqua/ct_gioqua2", compact('gioquas', 'traicays', 'traicaygqs', 'albums', 'loaigioquas'));
    }
    public function insertgioqua(request $request)
    {
        $with = $request->input('with');
        $hight = $request->input('hight');
        try {
            if ($request->hasFile('image')) {
                $max =  (DB::table('gioqua')->max('MaGioQua'));
                $code = 0;
                $gioquasi = DB::table('gioqua')->select('*')->get();
                if ($max == 0) {
                    $code = 1;
                } else {
                    for ($i = 1; $i <= $max; $i++) {

                        $lang = false;
                        foreach ($gioquasi as $value) {

                            if ($i == $value->MaGioQua) {
                                $lang = true;
                                break;
                            }
                        }
                        if ($i == $max) {
                            $i = $max + 1;
                            $lang = false;
                        }
                        if ($lang == false) {
                            $code = $i;
                            break;
                        }
                    }
                }

                $request->validate([

                    'image' => 'required|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

                ]);
                $name = $request->file('image')->getClientOriginalName();
                $imageName = $name;
                $request->image->move(public_path('images/gioqua'), $imageName);
                $imagePath = 'images/gioqua/' . $imageName;
                $resizedImage = Image::make(public_path($imagePath))
                    ->resize($with, $hight)
                    ->save();
                $gioquai = DB::table('gioqua')->insert(
                    array(
                        'MaGioQua' => $code,
                        'TenGioQua' => $request->input('TenGioQua'),
                        'MoTaGQ' => $request->input('MotaGQ'),
                        'NgayTao' => now(),
                        'GiaBan' => $request->input('GiaBan'),
                        'SoLuong' => $request->input('soluong'),
                        'TinhTrang' => $request->input('tinhtrang'),
                        'MaLoaiGQ' => $request->input('loaigioqua'),
                        'Anh' => $imageName,
                    )
                );
                if ($request->has('traiCay')) {
                    $traiCayData = [];
                    foreach ($request->input('traiCay') as $traiCayId => $traiCayInfo) {
                        $quantity = $traiCayInfo['quantity'];

                        if ($quantity > 0) {
                            $traiCayData[] = [
                                'gioqua_id' => $code,
                                'traiCay_id' => $traiCayId,
                                'quantity' => $quantity,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }
                    if (!empty($traiCayData)) {
                        DB::table('gioqua_traiCay')->insert($traiCayData);
                    }
                }
                if ($request->hasFile('images')) {
                    $images = $request->file('images');

                    foreach ($images as $image) {

                        $max =  (DB::table('gallery')->max('MaGallery'));
                        $galleryi = DB::table('gallery')->select('*')->get();
                        if ($max == 0) {
                            $code1 = 1;
                        } else {
                            for ($i = 1; $i <= $max; $i++) {

                                $lang = false;
                                foreach ($galleryi as $value) {

                                    if ($i == $value->MaGallery) {
                                        $lang = true;
                                        break;
                                    }
                                }
                                if ($i == $max) {
                                    $i = $max + 1;
                                    $lang = false;
                                }
                                if ($lang == false) {
                                    $code1 = $i;
                                    break;
                                }
                            }
                        }

                        $imageName = $image->getClientOriginalName();
                        $imagePath = $image->move(public_path('images/gallery'), $imageName);
                        $imagePath2 = 'images/gallery/' . $imageName;
                        $resizedImage = Image::make(public_path($imagePath2))
                            ->resize($with, $hight)
                            ->save();
                        DB::table('gallery')->insert([
                            'MaGQ' => $code,
                            'Anh' =>  $imageName,
                            'Loai' => 'gio-qua',
                            'MaGallery' => $code1,
                        ]);
                    }
                }
                $thongbao = 'Thêm giỏ quà thành công';
                $flag = 0;
            }
        } catch (\Exception $e) {
            $thongbao = 'Thêm giỏ quà thất bại';
            $flag = 1;
        }
        $gioquas = DB::table('gioqua')->paginate(5);
        return view("/admin/templates/gioqua/data_gioqua", compact('gioquas', 'flag', 'thongbao'));
    }

    public function deletegioqua(request $request, $id)
    {
        $thongbao = '';
        try {
            DB::table('gioqua')->where('MaGioQua', $id)->delete();
            DB::table('gioqua_traicay')->where('gioqua_id', $id)->delete();
            $thongbao = 'Xóa giỏ quà thành công';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Xóa giỏ quà thất bại';
            $flag = 1;
        }
        $gioquas = DB::table('gioqua')->paginate(5);
        return view("/admin/templates/gioqua/data_gioqua", compact('gioquas', 'flag', 'thongbao'));
    }
    public function updateGioQua(Request $request)
    {
        $with = $request->input('with');
        $hight = $request->input('hight');
        try {
            $gioquaId = $request->input('MaGioQua');

            if ($request->hasFile('image')) {
                $imageName = $request->file('image')->getClientOriginalName();
                $request->image->move(public_path('images/gioqua'), $imageName);
                $imagePath = 'images/gioqua/' . $imageName;
                $resizedImage = Image::make(public_path($imagePath))
                    ->resize($with, $hight)
                    ->save();
                DB::table('gioqua')
                    ->where('MaGioQua', $gioquaId)
                    ->update([
                        'TenGioQua' => $request->input('TenGioQua'),
                        'MoTaGQ' => $request->input('MoTaGQ'),
                        'GiaBan' => $request->input('GiaBan'),
                        'TinhTrang' => $request->input('tinhtrang'),
                        'MaLoaiGQ' => $request->input('loaigioqua'),
                        'SoLuong' => $request->input('soluong'),
                        'Anh' =>   $imageName,
                    ]);
            } else {
                if ($with != null && $hight != null) {
                    $gioqua2 = DB::table('gioqua')->where('MaGioQua', $request->input('MaGioQua'))->select('*')->get();
                    foreach ($gioqua2 as $image) {
                        $imageName = $image->Anh;
                        $imagePath = 'images/gioqua/' . $imageName;
                        $resizedImage = Image::make(public_path($imagePath))
                            ->resize($with, $hight)
                            ->save();
                    }
                }
                DB::table('gioqua')
                    ->where('MaGioQua', $gioquaId)
                    ->update([
                        'TenGioQua' => $request->input('TenGioQua'),
                        'MoTaGQ' => $request->input('MoTaGQ'),
                        'GiaBan' => $request->input('GiaBan'),
                        'MaLoaiGQ' => $request->input('loaigioqua'),
                        'TinhTrang' => $request->input('tinhtrang'),
                        'SoLuong' => $request->input('soluong'),
                    ]);
            }
            DB::table('gioqua_traiCay')->where('gioqua_id', $gioquaId)->delete();

            if ($request->has('traiCay')) {
                $traiCayData = [];
                foreach ($request->input('traiCay') as $traiCayId => $traiCayInfo) {
                    $quantity = $traiCayInfo['quantity'];

                    if ($quantity > 0) {
                        $traiCayData[] = [
                            'gioqua_id' => $gioquaId,
                            'traiCay_id' => $traiCayId,
                            'quantity' => $quantity,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
                if (!empty($traiCayData)) {
                    DB::table('gioqua_traiCay')->insert($traiCayData);
                }
            }
            if ($request->hasFile('images')) {
                $images = $request->file('images');

                foreach ($images as $image) {

                    $max =  (DB::table('gallery')->max('MaGallery'));
                    $galleryi = DB::table('gallery')->select('*')->get();
                    if ($max == 0) {
                        $code1 = 1;
                    } else {
                        for ($i = 1; $i <= $max; $i++) {

                            $lang = false;
                            foreach ($galleryi as $value) {

                                if ($i == $value->MaGallery) {
                                    $lang = true;
                                    break;
                                }
                            }
                            if ($i == $max) {
                                $i = $max + 1;
                                $lang = false;
                            }
                            if ($lang == false) {
                                $code1 = $i;
                                break;
                            }
                        }
                    }

                    $imageName = $image->getClientOriginalName();
                    if ($with != null && $hight != null) {
                        $imagePath = $image->move(public_path('images/gallery'), $imageName);
                        $imagePath2 = 'images/gallery/' . $imageName;
                        $resizedImage = Image::make(public_path($imagePath2))
                            ->resize($with, $hight)
                            ->save();
                    }
                    DB::table('gallery')->insert([
                        'MaGQ' => $request->input('MaGioQua'),
                        'Anh' =>  $imageName,
                        'Loai' => 'gio-qua',
                        'MaGallery' => $code1,
                    ]);
                }
            }
            $thongbao = 'Cập nhật giỏ quà thành công';
            $flag = 0;
        } catch (\Exception $e) {
            $thongbao = 'Cập nhật giỏ quà thất bại';
            $flag = 1;
        }

        $gioquas = DB::table('gioqua')->paginate(5);
        return view("/admin/templates/gioqua/data_gioqua", compact('gioquas', 'flag', 'thongbao'));
    }

 /* Bảng giá */
 public function banggiaview()
 {
     $thongbao = '';
     $flag='';
     $banggias = DB::table('banggia')->join('traicay', 'banggia.MaSanPham', '=', 'traicay.MaTraiCay')->paginate(5);

     return view('/admin/templates/banggia/banggia', compact('banggias', 'thongbao','flag'));
 }

 public function getbanggia(request $request)
 {
     $thongbao = '';
     $flag='';
     if ($request->ajax()) {
         $banggias = DB::table('banggia')->join('traicay', 'banggia.MaSanPham', '=', 'traicay.MaTraiCay')->paginate(5);
         return view('/admin/templates/banggia/data_banggia', compact('banggias', 'thongbao','flag'))->render();
     }
 }
 public function getctbanggia(request $request)
 {
     $traicays = DB::table('traicay')->select('*')->get();
     return view("/admin/templates/banggia/ct_banggia", compact('traicays'));
 }
 public function getctbanggiaid(request $request, $id)
 {
     $traicays = DB::table('traicay')->select('*')->get();
     $banggias = DB::table('banggia')->where('IDGia', $id)->select('*')->get();
     foreach($traicays as $row) if($row->MaTraiCay==$id) $giagoc=$row->GiaGoc;
     return view("admin/templates/banggia/ct_banggia2", compact('banggias', 'traicays','giagoc'));
 }
 public function insertbanggia(request $request)
 {
     $thongbao = '';
     $flag='';
     try {
         if($request->input('ngaybatdau')>$request->input('ngayketthuc'))
         {
               $thongbao = 'Ngày bắt đầu phải lớn hơn ngày kết thúc.';
               $flag='false';
         }
         else {
         $productCode = $request->input('matraicay');
         $existingPrice = DB::table('banggia')
         ->where('MaSanPham', $productCode)
         ->whereColumn('NgayBatDau', '<=', 'NgayKetThuc')
         ->whereRaw('? BETWEEN NgayBatDau AND NgayKetThuc', [$request->input('ngaybatdau')])->select('*')->get();
         if($existingPrice->count()>0)
         {
              $thongbao = 'Sản phẩm đang được áp dụng giá.';
              $flag='false';
         }
         else {
             $max =  (DB::table('banggia')->max('IDGia'));
             $banggiasi = DB::table('banggia')->select('*')->get();
              for($i=1;$i<=$max;$i++){
                   $flag=false;
                 foreach($banggiasi as $row)
                  {
                 if($i==$row->IDGia)
                 {
                     $flag=true;
                     break;
                 }
               }
              if($flag==false){
                 $code= $i;break;
                  }
             }
             $code= $max+1;
             $insertResult = DB::table('banggia')->insert([
                 'IDGia' => $code,
                 'MaSanPham' => $productCode,
                 'ChietKhau' => $request->input('chietkhau'),
                 'GiaBan' => $request->input('giaban'),
                 'NgayBatDau' => $request->input('ngaybatdau'),
                 'NgayKetThuc' => $request->input('ngayketthuc'),
             ]);

             if ($insertResult) {
                 $flag='true';
                 $thongbao = 'Thêm bảng giá thành công';
             } else {
                 $flag='false';
                 $thongbao = 'Thêm bảng giá thất bại';
             }
         }
     }     
     } catch (\Exception $e) {
         $flag='false';
         $thongbao = 'Đã xảy ra lỗi !';
     }

     $banggias = DB::table('banggia')->join('traicay', 'banggia.MaSanPham', '=', 'traicay.MaTraiCay')->paginate(5);
     return view("/admin/templates/banggia/data_banggia", compact('banggias', 'thongbao','flag'));
 }

 public function deletebanggia(request $request, $id)
 {
     $thongbao = '';
     $flag='';
     try {
         DB::table('banggia')->where('IDGia', $id)->delete();
         $thongbao = 'Xóa bảng giá thành công !';
         $flag='true';
     } catch (\Exception $e) {
         $flag='false';
         $thongbao = 'Xóa bảng giá thất bại !';
     }
     $banggias = DB::table('banggia')->join('traicay', 'banggia.MaSanPham', '=', 'traicay.MaTraiCay')->paginate(5);
     return view("/admin/templates/banggia/data_banggia", compact('banggias', 'thongbao','flag'));
 }
 public function updatebanggia(Request $request)
 {
     $thongbao = '';
     $flag='';
     try {
         if($request->input('ngaybatdau')>$request->input('ngayketthuc'))
         {
             $flag='false';
             $thongbao = 'Ngày bắt đầu phải lớn hơn ngày kết thúc.';
         }
         else {
         $existingPrice = DB::table('banggia')
         ->where('MaSanPham',$request->input('matraicay'))
         ->where('IDGia','!=',$request->input('IDGia'))
         ->whereColumn('NgayBatDau', '<=', 'NgayKetThuc')
         ->whereRaw('? BETWEEN NgayBatDau AND NgayKetThuc', [$request->input('ngaybatdau')])->select('*')->get();
         if($existingPrice->count()>0)
         {
              $thongbao = 'Sản phẩm đang được áp dụng giá.';
              $flag='false';
         }
         else{
         $banggiai = DB::table('banggia')->where('IDGia', $request->input('IDGia'))->update(
             [
                 'MaSanPham' => $request->input('matraicay'),
                 'ChietKhau' => $request->input('chietkhau'),
                 'GiaBan' => $request->input('giaban'),
                 'NgayBatDau' => $request->input('ngaybatdau'),
                 'NgayKetThuc' => $request->input('ngayketthuc'),
             ]
         );
         $flag='true';
         $thongbao = 'Cập nhật bảng giá thành công';
     }
  }
     } catch (\Exception $e) {
         $flag='false';
         $thongbao = 'Cập nhật bảng giá thất bại';
     }

     $banggias = DB::table('banggia')->join('traicay', 'banggia.MaSanPham', '=', 'traicay.MaTraiCay')->paginate(5);
     return view("/admin/templates/banggia/data_banggia", compact('banggias', 'thongbao','flag'));
 }
}