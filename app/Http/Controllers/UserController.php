<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public function loadForm(Request $request)
    {
        if($request->name=='signup')
            return view('auth/signUp-form');
        else
            return view('auth/recoverPass-form');
    }
     // View dang nhap
     public function loginview()
     {
        if(session()->has('user')){
                $info=DB::table('taikhoan')->where('MaTaiKhoan',session()->get('user'))->select('*');
                $info = $info->get();
                return view("auth/login",['ss'=>session()->get('user')],compact('info'));
        }
        else {
                $info=DB::table('taikhoan')->where('MaTaiKhoan',0)->select('*');
                $info = $info->get();
                return view("auth/login",compact('info'));
        }
     }
     //Dang xuat
     public function logout()
     {
         session()->forget('user'); 
         return redirect("login");
     }
     // Kiem Tra Dang Nhap
     public function dangnhap(Request $request)
     {
        if($request->tendangnhap=='' || $request->matkhau=='')
            return response()->json(['mess'=>'Vui lòng nhập đầy đủ','flag'=>false]);
        else {
            $username= $request->tendangnhap;
            $password=md5($request->matkhau);
            $tk = DB::table('taikhoan')->select('*')->get();
         foreach($tk as $row)
            {
                 if($username==$row->TaiKhoan && $password==$row->MatKhau)
                 {
                     session()->get('user');
                     session()->put('user',$row->MaTaiKhoan,now()->addMinutes(120));
                    session()->forget('admin');
                    return response()->json(['mess'=>'','flag'=>true]);
                 }
            }
        }
        return response()->json(['mess'=>'Sai mật khẩu hoặc tài khoản','flag'=>false]);
     }
     // Chinh sua thong tin ca nhan
     function editProfile(Request $request,$id)
     {
            $tk=DB::table('taikhoan')->where('MaTaiKhoan', $id)->select('Avatar')->get();
            foreach($tk as $row) $img=$row->Avatar;
        if ($request->hasFile('uploadAvatar')) {
            $image = $request->file('uploadAvatar');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/avatar/'), $imageName);
            $img=$imageName;
        } 
            try{
                 $update=  DB::table('taikhoan')
                    ->where('MaTaiKhoan', $id)
                    ->update([
                        'HoTen'=>$_POST['username-edit'],
                        'DiaChi'=>$_POST['address-edit'],
                        'Phone'=>$_POST['phone-edit'],
                        'Email'=>$_POST['email-edit'],
                        'Avatar'=>$img,
                    ]);
                        if($update)
                        {
                            session()->get('mess-true');
                            session()->put('mess-true','Cập nhật tài khoản thành công.');
                        }
                        else {
                            session()->get('mess-false');
                            session()->put('mess-false','Cập nhật tài khoản thất bại.');
                        }
                    }catch(\Exception $e)
                    {
                        session()->get('mess-false');
                        session()->put('mess-false','Đã xảy ra lỗi.');
                    }
            return redirect('login');
        }
     // Dang Ky
     public function dangky(Request $request)
     {
            if($request->tendangnhap=='' ||$request->matkhau=='' ||$request->xacnhanmatkhau=='' )
                return response()->json(['mess'=>"Vui lòng nhập đầy đủ",'flag'=>false]);
            else if(strlen($request->tendangnhap)<6)
                return response()->json(['mess'=>"Tài khoản ít nhất 6 ký tự",'flag'=>false]);
            else if(strlen($request->matkhau)<8)
                return response()->json(['mess'=>"Mật khẩu ít nhất 8 ký tự",'flag'=>false]);
            else if($request->xacnhanmatkhau!=$request->matkhau)
                return response()->json(['mess'=>"Mật khẩu không trùng khớp",'flag'=>false]);
            else {
                $tk = DB::table('taikhoan')->select('*')->get();
            foreach($tk as $row)
            if($request->tendangnhap==$row->TaiKhoan)
                return response()->json(['mess'=>"Tên Đăng Nhập Tồn Tại",'flag'=>false]);
            try{
                $id=$this->createID();
                $dk= DB::table('taikhoan')->insert(
                        array(
                               'MaTaiKhoan' => $id,
                               'TaiKhoan'     =>  $request->tendangnhap, 
                               'MatKhau'   =>  md5($request->matkhau),
                               'Email'=>'',
                               'Phone'=>'',
                               'DiaChi'=>'',
                               'HoTen'=>'',
                               'IsAdmin'=> 0,
                               'Avatar'=>'avatar.png',
                               'TrangThai'=> 0
                        ));
                        //
                // $chat= DB::table('chatbox')->insert(
                //         array(
                //         'chatID' => $id,
                //         'MaTK'=> $id,
                //     ));
                if($dk){
                    session()->get('mess-true');
                    session()->put('mess-true','Đăng ký tài khoản thành công.');
                }
                else {
                    session()->get('mess-false');
                    session()->put('mess-false','Đăng ký tài khoản thất bại.');
                }
        }catch (\Exception $e) {
            session()->get('mess-false');
            session()->put('mess-false','Đã xảy ra lỗi.');
        }
        return response()->json(['mess'=>"",'flag'=>true]);
    }
        
}
     //
     public function Laylaimk(Request $request)
     {
        if($request->newPassword=='' ||$request->confirmPass=='' )
            return response()->json(['mess'=>"Vui lòng nhập đầy đủ",'flag'=>false]);
        else if(strlen($request->newPassword)<8)
            return response()->json(['mess'=>"Mật khẩu ít nhất 8 ký tự",'flag'=>false]);
        else if($request->newPassword!=$request->confirmPass)
            return response()->json(['mess'=>"Mật khẩu không trùng khớp",'flag'=>false]);
        else {
            try{
                $user= DB::table('taikhoan')->where('Email',$request->gmail)->update(['MatKhau'=>md5($request->newPassword)]);
            if($user){
                session()->get('mess-true');
                session()->put('mess-true','Thay đổi mật khẩu thành công.');
            }
            else {
                session()->get('mess-false');
                session()->put('mess-false','Thay đổi mật khẩu thất bại.');
            }
            }catch(\Exception $e){
                session()->get('mess-false');
                session()->put('mess-false','Đã xảy ra lỗi.');
            }
            return response()->json(['mess'=>"",'flag'=>true]);
        }
     }
    //
    public function SendOTP(Request $request)
    {  
        $random_otp=$this->generateOTP();
        $mail=$request->email;
        Mail::send('auth/otpform',compact('random_otp'),function($email) use ($mail){
        $email->to($mail);
        });
        return view('auth/OTP-form',compact('mail'));
    }
     //
     public function generateOTP(){
        $random=rand(10000,100000);
        $random=strval($random);
        session()->put('otp',$random);
        return $random;
     }
     //
     public function resendOTP(Request $request)
     {
        $otp=session()->get('otp');
        $random=$this->generateOTP();
        while (true) {
            if ($otp == $random) 
                $random=$this->generateOTP();
            else break;
        }
        $random_otp=$random;
        $mail=$request->email;
        Mail::send('auth/otpform',compact('random_otp'),function($email) use ($mail){
        $email->to($mail);
      });
     }
     //
     public function KiemTraOTP(Request $request)
     {
        $otp=session()->get('otp');
        if($otp==$request->code)
        {
            $view=view('auth/newPass-form')->render();
            return response()->json(['flag'=>'true','view'=>$view]);
        }
        else{ return response()->json(['flag'=>'false']);}
     }
     //
     public function setOtpIsNull()
     {
        session()->put('otp','TUANPRO');
     }
     // Tao ma moi tai khoan
   public function createID()
   {
        $max=DB::table('taikhoan')->max('MaTaiKhoan');
        $tk=DB::table('taikhoan')->select('*')->get();
            for($i=1;$i<=$max;$i++){
                $flag=false;
                foreach($tk as $row)
                {
                    if($i==$row->MaTaiKhoan)
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