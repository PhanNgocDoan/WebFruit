<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Events\CheckOnline;
use App\Events\CheckAdminJoinGroupChat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PusherController extends Controller
{
    
    public function getadminId(Request $request)
    {
        return $request->id;
    }

    public function index()
    {
        if(session()->has('user'))
        {          
            $admin=DB::table('taikhoan')->where('IsAdmin',1)->orderBy('TrangThai','desc')->select('*')->get();
            return view('chat/listAdmin',compact('admin'));
         }
          else if(session()->has('admin'))
         {
            $type=0;
            $chater1=session()->get('admin');
            $chater2=0;
            $chat=null;
            $list=DB::table('taikhoan')->where('IsAdmin','=',0)->select('*')->get();
            DB::table('taikhoan')->where('IsAdmin',1)->where('MaTaiKhoan',session()->get('admin'))->update(['TrangThai'=>1]);
            event(new CheckOnline());
            ///////////
          
            $name='Username';
            return view('chat/pusher-chat',compact('chat','list','chater1','chater2','name'),['type'=>$type]);
         }
         else return redirect('login');
    }
    /////////////////
    public function get_history_chat($id)
    {
        $type=0;
        $chater1=session()->get('admin');
        $chater2=$id;
        $chat=DB::table('chatbox')
        ->where('chatbox.MaTK',$id)->where('MaAdmin',session()->get('admin'))->select('*')->get();
        if($chat->count()==0)
        {
            DB::table('chatbox')->insert(array([
                'chatID'=>$this->createID(),
                'MaTK'=>$id,
                'MaAdmin'=>session()->get('admin')
            ]));
        }
         $chat=DB::table('chatbox')
        ->join('history_chat','chatbox.chatID','=','history_chat.MaChat')
        ->where('chatbox.MaTK',$id)->where('MaAdmin',session()->get('admin'))
        ->select('*')->get();
      
        $list=DB::table('taikhoan')->where('IsAdmin','=',0)->select('*')->get();  
        ////////////
    
        $name=DB::table('taikhoan')->where('MaTaiKhoan',$id)->select('TaiKhoan')->get()->first();
        $name=$name->TaiKhoan;
       // event(new CheckAdminJoinGroupChat(session()->get('admin'),$id));
        return view('chat/pusher-chat',compact('chat','list','chater1','chater2','name'),['type'=>$type]);
    }
    //
        public function get_history_chat2($id)
     {
        $type=1;
        $chater1=session()->get('user');
        $chater2=$id;
        $chat=DB::table('chatbox')
        ->where('chatbox.MaTK',session()->get('user'))->where('MaAdmin',$id)->select('*')->get();
        if($chat->count()==0)
        {
            DB::table('chatbox')->insert(array([
                'chatID'=>$this->createID(),
                'MaTK'=>session()->get('user'),
                'MaAdmin'=>$id
            ]));
        }
        $chat=DB::table('chatbox')
        ->join('history_chat','chatbox.chatID','=','history_chat.MaChat')
        ->where('chatbox.MaTK',session()->get('user'))->where('MaAdmin',$id)
        ->select('*')->get();
        $list=null; 
        ////////////
       
        $name=DB::table('taikhoan')->where('MaTaiKhoan',$id)->select('TaiKhoan')->get()->first();
        $name=$name->TaiKhoan;
       // event(new CheckAdminJoinGroupChat(session()->get('admin'),$id));
        return view('chat/pusher-chat',compact('chat','list','chater1','chater2','name'),['type'=>$type]);
    }
    ////////////
    public function broadcast(Request $request)
    {
       // broadcast(new PusherBroadcast($request->get('message')))->toOthers();
        
            if(intval($request->get('type'))==1)
            {
                 $machat=intval($request->get('my'));
                 $id=DB::table('chatbox')->where('MaTK',$request->get('my'))->where('MaAdmin',$request->get('chatwith'))->select('chatID')->first()->chatID;
            }
            else
            {  
                $machat=intval($request->get('chatwith'));
                $id=DB::table('chatbox')->where('MaTK',$request->get('chatwith'))->where('MaAdmin',$request->get('my'))->select('chatID')->first()->chatID;
            }
                    DB::table('history_chat')->insert(
                        array(
                            'MaChat'=> $id,
                            'NoiDung'=>$request->get('message'),
                            'ThoiGian'=> Carbon::now()->subHours(5),
                            'IsUser'=>intval($request->get('type')),
                        ));
            event(new PusherBroadcast($request->get('message'),intval($request->get('chatwith')),intval($request->get('my'))));
            return view('chat/BroadcastMessage', ['message' => $request->get('message'),'time'=>Carbon::now()->subHours(5)]);
    }
    ///////////
    public function receive(Request $request)
    {
        return view('chat/ReceiveMessage', ['message' => $request->get('message'),'time'=>Carbon::now()->subHours(5)]);
    }
    //////////
     // Tao ma chat moi
   public function createID()
   {
        $max=DB::table('chatbox')->max('chatID');
        $chatbox=DB::table('chatbox')->select('*')->get();
            for($i=1;$i<=$max;$i++){
                $flag=false;
                foreach($chatbox as $row)
                {
                    if($i==$row->chatID)
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