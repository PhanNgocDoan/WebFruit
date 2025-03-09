<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
  public function welcomeview()
    {   
     return view('welcome');
    }
    //
  public function contactview()
  {
    $contact=DB::table('baiviet')->where('Loai','lienhe')->where('TinhTrang',1)->select('*')->get();
    return view('contact/lienhe',compact('contact'));
  }
  //
  public function sendFeedback(Request $request)
  {
    $max=DB::table('feedback')->max('FeedbackID');
    if($max==0)
      $id=1;
    else {
      $contact=DB::table('feedback')->select("*")->get();
      for($i=1;$i<=$max;$i++)
      { $flag=false;
        foreach($contact as $row)
        {
          if($i==$row->FeedbackID)
          {
             $flag=true;break;
          }
        }
        if($i==$max&&$flag==true)
          $id=$max+1;
        else if($flag==false){
           $id=$i;
           break;
        }
      }
    }
      DB::table('feedback')->insert(
        array(
            'FeedBackID'=>$id,
            'Name'=>$request->fullname,
            'Email'=>$request->email,
            'Content'=>$request->content,
            'NgayPhanHoi'=>Carbon::now()
        ));
  }
  //
  public function tonghopgiohang()
  {
    $cart = session()->get('cart', []);
    $sl = session()->get('sl', []);
    if (count($cart) > 0 && session()->has('user')) {
      foreach ($cart as $possion) {
        $value = DB::table('giohang')->where('MaTaiKhoan', session()->get('user'))->where('MaSanPham', $possion)->select('*')->get();
        if ($value->count() > 0) {
          DB::table('giohang')->where('MaTaiKhoan', session()->get('user'))->where('MaSanPham', $possion)->increment('SoLuong', 1);
        } else {
          DB::table('giohang')->insert(
            array(
              'MaGioHang' => (DB::table('giohang')->max('MaGioHang')) + 1,
              'MaTaiKhoan' => session()->get('user'),
              'MaSanPham' => $possion,
              'SoLuong' => $sl[$possion],
            )
          );
        }
      }
      session()->forget('cart');
      session()->forget('sl');
    }
  }
  //
  public function homeview()
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => 'Home'],
    ];
    $traicays = DB::table('traicay')
    ->leftJoin('banggia', function($join) {
        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
        ->where('NgayBatDau', '<=', Carbon::now())
        ->where('NgayKetThuc', '>=', Carbon::now());
    })
    ->join('donvi','donvi.MaDonVi','traicay.UnitID')
    ->orderBy('LuotXem','desc')
    ->select('traicay.*','banggia.*','donvi.*')->get();
      $gioquas=DB::table('gioqua')->select('*')->get();
    $banners = DB::table('album')->where('Loai', 'banner')->select('*')->get();
    $sliders = DB::table('album')->where('Loai', 'slider')->select('*')->get();
    $logos = DB::table('album')->where('Loai', 'logo')->select('*')->get();
    $tintucs = DB::table('baiviet')->where('Loai', 'tintuc')->where('TinhTrang', 1)->select('*')->get();
    $loaitcs = DB::table('loaitraicay')->select('*')->get();
    $loaigqs = DB::table('loaigioqua')->select('*')->get();
    $album = DB::table('album')->select('*')->get();
    return view("home", compact('traicays','gioquas', 'loaitcs','loaigqs', 'album', 'sliders', 'logos', 'banners', 'tintucs', 'breadcrumbs'));
  }
  public function getgioqua_home(request $request)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => 'Home'],
      ['link' => route('gioqua_home'), 'name' => 'Giỏ Quà'],
    ];
    $gioquas = DB::table('gioqua')->where('TinhTrang', 1)->select('*')->paginate(12);
    if ($request->ajax()) {
      return view('gioqua/gioqua_data', compact('gioquas','breadcrumbs'))->render();
    }
    return view('gioqua/gioqua', compact('gioquas', 'breadcrumbs'));
  } 
  public function getgioqua_home_ct(request $request,$id)
  {
    $gioquas = DB::table('gioqua')->where('TinhTrang', 1)->where('MaGioQua', $id)->select('*')->get();
    foreach ($gioquas as $row) {
      $breadcrumbs = [
        ['link' => route('home'), 'name' => 'Home'],
        ['link' => route('gioqua_home'), 'name' => 'Giỏ Quà'],
        ['link' => route('ct_gioqua_home', $id), 'name' => $row->TenGioQua],
      ];
    }
    $gallery=DB::table('gallery')->where('MaGQ', $id)->select('*')->get();
    $comments = DB::table('review')->join('taikhoan', 'taikhoan.MaTaiKhoan', '=', 'review.MaTk')->where('MaGQ', $id)->select('*')->get();
    $gioquacls = DB::table('gioqua')->where('TinhTrang', 1)->where('MaGioQua', '!=', $id)->select('*')->get();
    return view('gioqua/gioqua_ct', compact('gioquas', 'gioquacls', 'breadcrumbs', 'comments','gallery'));
  }
  public function ct_tintuc($id)
  {

    $tintucs = DB::table('baiviet')->where('Loai', 'tintuc')->where('TinhTrang', 1)->where('MaBaiViet', $id)->select('*')->get();
    foreach ($tintucs as $row) {
      $breadcrumbs = [
        ['link' => route('home'), 'name' => 'Home'],
        ['link' => route('tintuc'), 'name' => 'Tin tức'],
        ['link' => route('ct_tintuc', $id), 'name' => $row->TieuDe],
      ];
    }
    $tintuccls = DB::table('baiviet')->where('Loai', 'tintuc')->where('TinhTrang', 1)->where('MaBaiViet', '!=', $id)->select('*')->get();
    return view('baiviet/ct_tintuc', compact('tintucs', 'tintuccls', 'breadcrumbs'));
  }
  public function viewtintuc()
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => 'Home'],
      ['link' => route('tintuc'), 'name' => 'Tin tức'],
    ];
    $tintucs = DB::table('baiviet')->where('Loai', 'tintuc')->where('TinhTrang', 1)->select('*')->get();
    return view('baiviet/tintuc', compact('tintucs', 'breadcrumbs'));
  }
  public function danhmuctc($id)
  {
    $traicays = DB::table('traicay') 
    ->where('MaLoai',$id)
    ->leftJoin('banggia', function($join) {
      $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
      ->where('NgayBatDau', '<=', Carbon::now())
      ->where('NgayKetThuc', '>=', Carbon::now());
  })
  ->join('donvi','traicay.UnitID','donvi.MaDonVi')
  ->select('traicay.*','banggia.*','donvi.*')->get();
    $gioquas=DB::table('gioqua') 
    ->where('MaLoaiGQ',0)->select("*")->get();
    return view('data_danhmucsp', compact('traicays','gioquas'));
  }
  //
  public function danhmucgq($id)
  {
    $gioquas = DB::table('gioqua') 
    ->where('MaLoaiGQ',$id)
    ->select('*')->get();
    $traicays=DB::table('traicay') 
    ->where('MaLoai',0)->select("*")->get();
    return view('data_danhmucsp', compact('traicays','gioquas'));
  }
  public function viewgioithieu()
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => 'Home'],
      ['link' => route('gioithieu'), 'name' => 'Giới thiệu'],
    ];
    $gioithieus = DB::table('baiviet')->where('Loai', 'gioithieu')->where('TinhTrang', 1)->select('*')->get();
    return view('baiviet/ct_gioithieu', compact('gioithieus', 'breadcrumbs'));
  }

}