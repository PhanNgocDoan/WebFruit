<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
class CheckoutController extends Controller
{
    // view form thanh toan
  public function checkoutview()
  {
     return view("checkout/checkout",['total'=>(new CartController)->gettotal()]);
  }
  // lay ma cac san pham trong gio hang
  public function getProducts_arr()
  {  
    if(session()->has('user'))
    {   
        $products = DB::table('traicay')
        ->join('giohang', 'traicay.MaTraiCay', '=', 'giohang.MaSanPham')
        ->where('MaTaiKhoan',session()->get('user'))
        ->select('traicay.MaTraiCay','giohang.SoLuong as Sl')
        ->get();
        return $products;
       }
  }
  // lay tong so luong cac san pham trong gio hang
  public function get_SingleTotal_price($id)
  {   $amount=0;
    if(session()->has('user'))
    {   
        $product = DB::table('traicay')
        ->join('giohang', 'traicay.MaTraiCay', '=', 'giohang.MaSanPham')
        ->where('MaTaiKhoan',session()->get('user'))
        ->where('giohang.MaSanPham','=',$id)
        ->leftJoin('banggia', function($join) {
          $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
          ->where('NgayBatDau', '<=', Carbon::now())
          ->where('NgayKetThuc', '>=', Carbon::now());
      })
        ->select('traicay.GiaGoc','giohang.SoLuong','banggia.GiaBan')->get();
        foreach($product as $row)
        {
          if(isset($row->GiaBan))
          $amount+=($row->SoLuong*$row->GiaBan);
        else 
          $amount+=($row->SoLuong*$row->GiaGoc);
        }
       } return $amount;
  }
  // Gửi mail sau khi thanh toán
   public function SendMail()
   {
    if(session()->has('user'))
    {
      $user=DB::table('ct_hoadon')
      ->join('hoadon','hoadon.MaHD','=','ct_hoadon.MaHD')
      ->where('hoadon.MaTaiKhoan','=',session()->get('user'))
      ->select('ct_hoadon.HoTen','ct_hoadon.Email')
      ->get();
      foreach($user as $row)
      {
         $name=$row->HoTen;
        $mail=$row->Email;
      }
     
       Mail::send('checkout/mailform',compact('name','mail'),function($email){
      $user2=DB::table('ct_hoadon')
      ->join('hoadon','hoadon.MaHD','=','ct_hoadon.MaHD')
      ->where('hoadon.MaTaiKhoan','=',session()->get('user'))
      ->select('ct_hoadon.HoTen','ct_hoadon.Email')
      ->get();
      foreach($user2 as $row2)
       $mail2=$row2->Email;
       $email->to($mail2);
    });
    }
   }
    // Lấy giá của 1 sản phẩm
    public function getProductPrice($id)
    {
      $price= DB::table('traicay')
    ->leftJoin('banggia', function($join) {
        $join->on('traicay.MaTraiCay', '=', 'banggia.MaSanPham')
        ->where('NgayBatDau', '<=', Carbon::now())
        ->where('NgayKetThuc', '>=', Carbon::now());
    })
    ->where('MaTraiCay',$id)
    ->select('traicay.GiaGoc','banggia.GiaBan')->get();
    foreach($price as $row)
    if(isset($row->GiaBan))
    {
       $price=$row->GiaBan;return $price;
    }
    else 
    {
        $price=$row->GiaGoc;return $price;
    }
    }
    // thanh toán bằng vnpay
    public function vn_payment()
    {
      // if((new CartController)->gettotal()==0)
      // {
      //   session()->get('mess-false');
      //   session()->put('mess-false','Bạn chưa có sản phẩm để thanh toán! >>');
      //  return redirect("/tt");
      // }
      // else{
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/tt";
        $vnp_TmnCode = "9T9XS92U";//Mã website tại VNPAY 
        $vnp_HashSecret = "HNIFELGIOTSGTOILLBXJWSLTJHQZXXTG"; //Chuỗi bí mật
        $vnp_TxnRef ="2"; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh Toan Hoa don';
        $vnp_OrderType = "billpayment";
        $vnp_Amount =  10000*100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
          "vnp_Version" => "2.1.0",
          "vnp_TmnCode" => $vnp_TmnCode,
          "vnp_Amount" => $vnp_Amount,
          "vnp_Command" => "pay",
          "vnp_CreateDate" => date('YmdHis'),
          "vnp_CurrCode" => "VND",
          "vnp_IpAddr" => $vnp_IpAddr,
          "vnp_Locale" => $vnp_Locale,
          "vnp_OrderInfo" => $vnp_OrderInfo,
          "vnp_OrderType" => $vnp_OrderType,
          "vnp_ReturnUrl" => $vnp_Returnurl,
          "vnp_TxnRef" => $vnp_TxnRef,
);
  if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
  }
  if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
  }
  ksort($inputData);
  $query = "";
  $i = 0;
  $hashdata = "";
  foreach ($inputData as $key => $value) {
      if ($i == 1) {
          $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
          $hashdata .= urlencode($key) . "=" . urlencode($value);
          $i = 1;
      }
          $query .= urlencode($key) . "=" . urlencode($value) . '&';
  }
  $vnp_Url = $vnp_Url . "?" . $query;
  if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
  }
  $returnData = array(
    'code' => '00', 
    'message' => 'success',
    'data' => $vnp_Url);
    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
    } else {
        echo json_encode($returnData);
    }
  //}
  }
   // thêm vào bảng hóa đơn và chi tiết hóa đơn
   public function themHoaDon()
   {  
        $arr=session()->get('myArray');
         DB::table('hoadon')->insert(
             array(
                  'MaHD' => $arr['MaHD'],
                  'MaTaiKhoan' =>  $arr['MaTaiKhoan'],
                  'NgayLapHD'  =>  $arr['NgayLapHD'], 
                  'DiaChiGiaoHang'=>  $arr['DiaChiGiaoHang'],
                  'Phone'=> $arr['Phone'],
                  'ThanhTien'=> $arr["ThanhTien"],
                  'TinhTrang'=>  $arr['TinhTrang'],
                  'DanhGia'=> $arr['DanhGia']
             ));
        foreach($this->getProducts_arr() as $row)
        {
        DB::table('ct_hoadon')->insert(
         array(
                'MaHD' => $arr['MaHD'],
                'MaTraiCay'  =>$row->MaTraiCay, 
                'SoLuong' => $row->Sl,
                'DonGia'=> $this->getProductPrice($row->MaTraiCay),
                'TongGia'=> $this->get_SingleTotal_price($row->MaTraiCay),
                'HoTen'=>  $arr['HoTen'],
                'Email'=> $arr['Email'],
                'Note'=> $arr['Note'],
         ));
        }
         (new CartController)->xoatoanbo();
         $this->SendMail();
         session()->forget('myArray');
   }
   // Thanh toán bằng paypal
   public function handlePayment(Request $request)
   {
    if((new CartController)->gettotal()==0)
    {
      session()->get('mess-false');
      session()->put('mess-false','Bạn chưa có sản phẩm để thanh toán! >>');
      session()->get('empty-cart');
      session()->put('empty-cart','true');
      return redirect("/tt");
    }
    else if(session()->has('user')){
      $arr=[
        //hoa don
        'MaHD'=> $this->createID(),
        'MaTaiKhoan'=>session()->get('user'),
        'NgayLapHD'  => Carbon::now(), 
        'DiaChiGiaoHang'=>$_POST['address'],
        'Phone'=>$_POST['phone'],
        'ThanhTien'=>(new CartController)->gettotal(),
        'TinhTrang'=>'Đang Chờ',
        'DanhGia'=>'true',
        //chi tiet hoa don
        'HoTen'=>$_POST['first_name']." ".$_POST['last_name'],
        'Email'=>$_POST['email'],
        'Note'=>$_POST['comment'],
        ];
        session()->get('myArray');
        session()->put('myArray',$arr);
         //
       $provider = new PayPalClient;
       $provider->setApiCredentials(config('paypal'));
       $paypalToken = $provider->getAccessToken();
       $response = $provider->createOrder([
           "intent" => "CAPTURE",
           "application_context" => [
               "return_url" => route('success.payment'),
               "cancel_url" => route('cancel.payment'),
           ],
           "purchase_units" => [
               0 => [
                   "amount" => [
                       "currency_code" => "USD",
                       "value" => ((new CartController)->gettotal()).".00",
                   ],
               ]
           ]
       ]);
       //
       if (isset($response['id']) && $response['id'] != null) {
           foreach ($response['links'] as $links) {
               if ($links['rel'] == 'approve') {
                   return redirect()->away($links['href']);
               }
           }
           return redirect()->route('cancel.payment');
       } else {
          session()->get('mess-false');
          session()->put('mess-false','Đã xảy ra lỗi!');
           return redirect('/tt');
       }
       }
       else {
        return redirect('/login');
       }
   }
   // Hủy thanh toán
   public function paymentCancel()
   {
      session()->get('mess-false');
      session()->put('mess-false','Bạn đã hủy quá trình thanh toán!');
       return redirect('/tt');
   }
   // Thanh toán thành công
   public function paymentSuccess(Request $request)
   {
       $provider = new PayPalClient;
       $provider->setApiCredentials(config('paypal'));
       $provider->getAccessToken();
       $response = $provider->capturePaymentOrder($request['token']);
       if (isset($response['status']) && $response['status'] == 'COMPLETED') {
          $this->themHoaDon();
          session()->get('mess-true');
          session()->put('mess-true','Cảm ơn bạn đã mua hàng.');
           return redirect('/gh');     
       } else {
          session()->get('mess-false');
          session()->put('mess-false','Thanh toán thất bại!');
           return redirect('/tt');
       }
   }
   // Tao ma moi hoa don
   public function createID()
   {
    $max=DB::table('hoadon')->max('MaHD');
    $hd=DB::table('hoadon')->select('*')->get();
            for($i=1;$i<=$max;$i++){
                $flag=false;
                foreach($hd as $row)
                {
                    if($i==$row->MaHD)
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
}