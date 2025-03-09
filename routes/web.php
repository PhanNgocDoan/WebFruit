<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PusherController;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home',[HomeController::class,"homeview"])->name('home');
Route::get('/contact',[HomeController::class,"contactview"])->name('contact');
Route::get('/',[HomeController::class,"welcomeview"]);
Route::get('/sendFeedback',[HomeController::class,"sendFeedback"]);


Route::get('/login',[UserController::class,"loginview"])->name('login');
Route::get('/loadForm',[UserController::class,"loadForm"]);
Route::get('/logout',[UserController::class,"logout"]);
Route::get('/dn',[UserController::class,"dangnhap"]);
Route::get('/dk',[UserController::class,"dangky"]);
Route::post('/edit{id}',[UserController::class,"editProfile"]);
Route::get('/otp',[UserController::class,"SendOTP"]);
Route::get('/recoverpass',[UserController::class,"Laylaimk"]);
Route::get('/checkOTP',[UserController::class,"KiemTraOTP"]);
Route::get('/setOTPnull',[UserController::class,"setOtpIsNull"]);
Route::get('/reloadOTP',[UserController::class,"resendOTP"]);


Route::get('/shop',[ProductController::class,"Shopview"])->name('shop');
Route::get('/ct',[ProductController::class,"chitiet"]);
Route::get('/cats{id}',[ProductController::class,"Catogories"]);
Route::get('/category{id}',[ProductController::class,"loaiDanhMuc"]);
Route::get('/brands{id}',[ProductController::class,"Brands"]);
Route::get('/ct{id}',[ProductController::class,"details"]);
Route::get('/search',[ProductController::class,"timkiem"]);
Route::get('/range',[ProductController::class,"RangePrice"]);
Route::get('/PriceToPrice',[ProductController::class,"RangeBetween"]);
Route::post('/upload',[ProductController::class,"upload"]);
Route::get('/locsp',[ProductController::class,"locsanpham"]);
Route::get('/locsp2',[ProductController::class,"locsanpham2"]);

Route::get('/gh',[CartController::class,"getcart"]);
Route::get('/gh{id}',[CartController::class,"addcart"]);
Route::get('/delAll',[CartController::class,"xoatoanbo"]);
Route::get('/update{id}',[CartController::class,"capnhatgh"]);
Route::get('/delProduct{id}',[CartController::class,"delProduct"]);
Route::get('/getDetailInvoices',[CartController::class,"get_detailBill"]);
Route::get('/reviewProduct',[CartController::class,"reviewProduct"]);


Route::get('/tt',[CheckoutController::class,"checkoutview"]);
Route::post('/ttoan',[CheckoutController::class,"thanhtoan"]);
Route::post('/vnpay',[CheckoutController::class,"vn_payment"]);
Route::controller(CheckoutController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::post('handle-payment', 'handlePayment')->name('make.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
        Route::get('payment-success', 'paymentSuccess')->name('success.payment');
    });


// Route::get('/chat',[ChatController::class,"chatview"]);
// Route::get('/chat{id}',[ChatController::class,"get_history_chat"]);
// Route::get('/send',[ChatController::class,"sendMessage"]);
// Route::get('/getmsg',[ChatController::class,"getmsg"]);

Route::get('/pusher',[PusherController::class,"index"]);
Route::get('/chat_user{id}',[PusherController::class,"get_history_chat"]);
Route::get('/chat_admin{id}',[PusherController::class,"get_history_chat2"]);
Route::post('/broadcast',[PusherController::class,"broadcast"]);
Route::post('/receive',[PusherController::class,"receive"]);
// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

////////////////////////////////////////////////
/////////////////////////////////////////////////
//////////////////////////////////////////////////

//admin
Route::get('/admin', [AdminController::class, "adminview"]);
Route::post('/login-admin', [AdminController::class, "login"]);
Route::post('/logoutad', [AdminController::class, "logoutd"])->name('logout');
//
Route::get('/gioqua_home', [HomeController::class, "getgioqua_home"])->name('gioqua_home');
Route::get('/getgioqua_home_ct{id}', [HomeController::class, "getgioqua_home_ct"])->name('ct_gioqua_home');
//tin tức
Route::get('/tintuc{id}', [HomeController::class, "ct_tintuc"])->name('ct_tintuc');
Route::get('/tintuc', [HomeController::class, "viewtintuc"])->name('tintuc');
//Giới thiệu
Route::get('/gioithieu', [HomeController::class, "viewgioithieu"])->name('gioithieu');

//
Route::get('/gethometest2', [AdminController::class, "gethometest2"]);
Route::get('/gethometest', [AdminController::class, "gethometest"]);
Route::get('/getdonhang', [AdminController::class, "getdonhang"]);
Route::get('/getctdonhang', [AdminController::class, "getctdonhang"]);
Route::get('/getctsanpham', [AdminController::class, "getctsanpham"]);
Route::get('/getctsanphamid{id}', [AdminController::class, "getctsanphamid"]);
Route::post('/insertsp', [AdminController::class, "insertsp"])->name('insert.data.sanpham');
Route::post('/capnhatsp', [AdminController::class, "capnhatsp"])->name('update.data.sanpham');
Route::get('/deletesp{id}', [AdminController::class, "deletesp"]);
Route::get('/welcome', [AdminController::class, "welcome"]);
Route::get('/uploadimg', [AdminController::class, "upload_img"]);

Route::controller(AdminController::class)->group(function () {
    Route::get('image-upload', 'index');
    Route::post('image-upload', 'store')->name('image.store');
});


Route::get('/hienpage', [AdminController::class, "hienpage"]);


Route::controller(AdminController::class)->group(function () {
    Route::get('admin', 'adminview');
    Route::get('admin/ajax', 'getsanpham');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('sanpham', 'sanphamview');
    Route::get('sanpham/ajax', 'getsanpham');
});



//Hóa đơn

Route::controller(AdminController::class)->group(function () {
    Route::get('hoadon', 'hoadonview');
    Route::get('hoadon/ajax', 'gethoadon');
});
Route::get('/getcthoadonid{id}', [AdminController::class, "getcthoadonid"]);
Route::post('/capnhatdon', [AdminController::class, "capnhatttdon"])->name('capnhatdon');

//bản đồ 
Route::get('/getdashboard', [AdminController::class, "getdashboard"]);
Route::get('/getdashboard/data', [AdminController::class, 'getdashboardData']);
Route::get('/selectchart', [AdminController::class, "selectchart"]);

//tim kiếm theo sản phẩm


Route::get('/searchsanpham', [AdminController::class, "searchsanpham"]);


Route::get('/addinput', [AdminController::class, "addinput"]);
Route::get('/deleteinput', [AdminController::class, "deleteinput"]);
//Nhập hàng

Route::get('/nhaphang', [AdminController::class, "nhaphangview"]);
Route::get('/getnhaphang', [AdminController::class, "getnhaphang"]);
Route::get('/addnhaphang', [AdminController::class, "addnhaphang"]);
Route::get('/getctnhaphangid{id}', [AdminController::class, "getctnhaphangid"]);
Route::get('/insertnhaphang', [AdminController::class, "insertnhaphang"]);
Route::get('/capnhatnhaphang', [AdminController::class, "capnhatnhaphang"]);

Route::get('/deletenhaphang{id}', [AdminController::class, "deletenhaphang"]);
Route::get('/xoaspnhaphang{id}{id2}', [AdminController::class, "deletespnhaphang"]);


//Tài khoản
Route::controller(AdminController::class)->group(function () {
    Route::get('account', 'accountview');
    Route::get('account/ajax', 'getaccount');
});
Route::get('/getctaccount', [AdminController::class, "getctaccount"]);
Route::get('/getctaccountid{id}', [AdminController::class, "getctaccountid"]);
Route::post('/insertaccount', [AdminController::class, "insertaccount"])->name('insert.data.account');
Route::get('/deleteaccount{id}', [AdminController::class, "deleteaccount"]);
Route::post('/update_account', [AdminController::class, "updateaccount"])->name('update.data.account');


//gallery

Route::get('/deletegallery/{id}/{loai}/{idsp}', [AdminController::class, "deletegallery"]);

//Quản lý ảnh và video

Route::get('/albums-{loai}', [AdminController::class, "view_oneimg"]);
Route::post('/capnhatoneimg', [AdminController::class, "capnhatoneimg"])->name('update.data.oneimg');



//Hinh anh video
Route::controller(AdminController::class)->group(function () {
    Route::get('album-{loai}', 'albumview');
    Route::get('album/ajax', 'getalbum');
});
Route::get('/getctalbum', [AdminController::class, "getctalbum"]);
Route::get('/getctalbumid{id}', [AdminController::class, "getctalbumid"]);
Route::post('/insertalbum', [AdminController::class, "insertalbum"])->name('insert.data.album');
Route::get('/deletealbum{id}{loai}', [AdminController::class, "deletealbum"]);
Route::post('/update_album', [AdminController::class, "updatealbum"])->name('update.data.album');


//Quản lý bài viết


Route::get('/baiviets-{loai}', [AdminController::class, "view_onebaiviet"]);
Route::post('/capnhatonebaiviet', [AdminController::class, "capnhatonebaiviet"])->name('update.data.onebaiviet');


//Bài viết
Route::controller(AdminController::class)->group(function () {
    Route::get('baiviet-{loai}', 'baivietview');
    Route::get('baiviet/ajax', 'getbaiviet');
});
Route::get('/getctbaiviet', [AdminController::class, "getctbaiviet"]);
Route::get('/getctbaivietid{id}', [AdminController::class, "getctbaivietid"]);
Route::post('/insertbaiviet', [AdminController::class, "insertbaiviet"])->name('insert.data.baiviet');
Route::get('/deletebaiviet{id}{loai}', [AdminController::class, "deletebaiviet"]);
Route::post('/update_baiviet', [AdminController::class, "updatebaiviet"])->name('update.data.baiviet');


//loại trái cây
Route::controller(AdminController::class)->group(function () {
    Route::get('loaisp', 'loaispview');
    Route::get('loaisp/ajax', 'getloaisp');
});
Route::get('/getctloaisp', [AdminController::class, "getctloaisp"]);
Route::get('/getctloaispid{id}', [AdminController::class, "getctloaispid"]);
Route::post('/insertloaisp', [AdminController::class, "insertloaisp"])->name('insert.data.loaisp');
Route::get('/deleteloaisp{id}', [AdminController::class, "deleteloaisp"]);
Route::post('/update_loaisp', [AdminController::class, "updateloaisp"])->name('update.data.loaisp');

//loại giỏ quà

Route::controller(AdminController::class)->group(function () {
    Route::get('loaigioqua', 'loaigioquaview');
    Route::get('loaigioqua/ajax', 'getloaigioqua');
});
Route::get('/getctloaigioqua', [AdminController::class, "getctloaigioqua"]);
Route::get('/getctloaigioquaid{id}', [AdminController::class, "getctloaigioquaid"]);
Route::post('/insertloaigioqua', [AdminController::class, "insertloaigioqua"])->name('insert.data.loaigioqua');
Route::get('/deleteloaigioqua{id}', [AdminController::class, "deleteloaigioqua"]);
Route::post('/update_loaigioqua', [AdminController::class, "updateloaigioqua"])->name('update.data.loaigioqua');

//Nhà cung cấp
Route::controller(AdminController::class)->group(function () {
    Route::get('nhacungcap', 'nhacungcapview');
    Route::get('nhacungcap/ajax', 'getnhacungcap');
});
Route::get('/getctnhacungcap', [AdminController::class, "getctnhacungcap"]);
Route::get('/getctnhacungcapid{id}', [AdminController::class, "getctnhacungcapid"]);
Route::post('/insertnhacungcap', [AdminController::class, "insertnhacungcap"])->name('insert.data.nhacungcap');
Route::get('/deletenhacungcap{id}', [AdminController::class, "deletenhacungcap"]);
Route::post('/update_nhacungcap', [AdminController::class, "updatenhacungcap"])->name('update.data.nhacungcap');


//Đơn vị sản phẩm
Route::controller(AdminController::class)->group(function () {
    Route::get('donvisp', 'donvispview');
    Route::get('donvisp/ajax', 'getdonvisp');
});
Route::get('/getctdonvisp', [AdminController::class, "getctdonvisp"]);
Route::get('/getctdonvispid{id}', [AdminController::class, "getctdonvispid"]);
Route::post('/insertdonvisp', [AdminController::class, "insertdonvisp"])->name('insert.data.donvisp');
Route::get('/deletedonvisp{id}', [AdminController::class, "deletedonvisp"]);
Route::post('/update_donvisp', [AdminController::class, "updatedonvisp"])->name('update.data.donvisp');

//tag danh mục sản phẩm 
Route::get('/danhmucsp/tc{id}', [HomeController::class, "danhmuctc"]);
Route::get('/danhmucsp/gq{id}', [HomeController::class, "danhmucgq"]);


//Giỏ quà
Route::controller(AdminController::class)->group(function () {
    Route::get('gioqua', 'gioquaview');
    Route::get('gioqua/ajax', 'getgioqua');
});
Route::get('/getctgioqua', [AdminController::class, "getctgioqua"]);
Route::get('/getctgioquaid{id}', [AdminController::class, "getctgioquaid"]);
Route::post('/insertgioqua', [AdminController::class, "insertgioqua"])->name('insert.data.gioqua');
Route::get('/deletegioqua{id}', [AdminController::class, "deletegioqua"]);
Route::post('/update_gioqua', [AdminController::class, "updateGioQua"])->name('update.data.gioqua');
Route::get('/add_input_gioqua/{id}',  [AdminController::class, "add_input_gioqua"]);
Route::get('/xoa_input_gioqua/{id}/{id2}',  [AdminController::class, "xoa_input_gioqua"]);

//Bảng giá
Route::controller(AdminController::class)->group(function () {
    Route::get('banggia', 'banggiaview');
    Route::get('banggia/ajax', 'getbanggia');
});
Route::get('/getctbanggia', [AdminController::class, "getctbanggia"]);
Route::get('/getctbanggiaid{id}', [AdminController::class, "getctbanggiaid"]);
Route::post('/insertbanggia', [AdminController::class, "insertbanggia"])->name('insert.data.banggia');
Route::get('/deletebanggia{id}', [AdminController::class, "deletebanggia"]);
Route::post('/update_banggia', [AdminController::class, "updatebanggia"])->name('update.data.banggia');