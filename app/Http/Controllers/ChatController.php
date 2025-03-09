<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Events\PusherBroadcast;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChatController extends Controller
{
    //view chat cua admin
    public function chatview()
    {
        $cookie='0';
        $list=DB::table('chatbox')->join('taikhoan','chatbox.MaTK','=','taikhoan.MaTaiKhoan')->select('*')->get();
        $chat=DB::table('chatbox')->join('history_chat','chatbox.chatID','=','history_chat.MaChat')->where('chatbox.MaTK',0)->select('*')->get();
        $chatid=0;
        $user="Username";
        return view("chat",compact('chat','list','cookie','chatid','user'));
    }
    //
    public function get_history_chat($id)
    {
        if(empty($_COOKIE['id']))
        {
           $cookie='0';
        }
        else{
            $cookie='1';
        }
        $chat=DB::table('chatbox')->join('history_chat','chatbox.chatID','=','history_chat.MaChat')->where('chatbox.MaTK',$id)->select('*')->get();
        $list=DB::table('chatbox')->join('taikhoan','chatbox.MaTK','=','taikhoan.MaTaiKhoan')->select('*')->get();  
        $username=DB::table('chatbox')->join('taikhoan','taikhoan.MaTaiKhoan','=','chatbox.MaTK')->where('chatbox.MaTK',$id)->select('*')->get();
        $chatid=$id;
        $user='Username';
        foreach($username as $row)
        {
            $user=$row->TaiKhoan;
        }
        return view('chat',compact('chat','list','cookie','chatid','user'));
    }
    //
    public function sendMessage(Request $request)
    {
        $history=DB::table('history_chat')->insert(
            array(
                'MaChat'=>$request->chatid,
                'NoiDung'=> $request->message,
                'ThoiGian'=> Carbon::now(),
                'IsUser'=>$request->is_user,
            ));
    }
    public function getmsg(Request $request)
    {
        if(isset($_COOKIE['id']))
        {
            $chat=DB::table('chatbox')->join('history_chat','chatbox.chatID','=','history_chat.MaChat')->where('chatbox.MaTK',$_COOKIE['id'])->get();
           // $count=DB::table('chatbox')->join('history_chat','chatbox.chatID','=','history_chat.MaChat')->where('chatbox.MaTK',$_COOKIE['id'])->select('*')->get()->count();
        }
        else{
            $chat=DB::table('chatbox')->join('history_chat','chatbox.chatID','=','history_chat.MaChat')->where('chatbox.MaTK',$request->chatid)->get();
        }
        $nd='';
        $tg='';
        $isuser=0;
        foreach($chat as $row){
            $nd=$row->NoiDung;
            $tg=$row->ThoiGian;
            $isuser=$row->IsUser;
        }
        return response()->json(['nd'=>$nd,'tg'=>$tg,'is'=>$isuser]);
    }
}