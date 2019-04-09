<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\forget_password;
use Mail;
use DB;

class admin_login_controller extends Controller
{
	function __construct()
    {
        $this->middleware('Backend');
    }
    function index(){
    	return view('admin/admin_login');
    }
     function logout()
    {
    	session()->forget('admin_email');
    	return redirect('admin/login');
    }
    function forget_password(Request $req)
    {
        $data = DB::table('tbladmin')->first();
        $length = 60;
        $activation_code=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        $link=$req->root().'/admin/admin_login_controller/reset_password/'.$data->email.'/'.$activation_code;
        DB::table('tbladmin')->where('email',$data->email)->update(['link'=>$activation_code]);
        Mail::to($data->email)->send(new forget_password($link));
    }
    function reset_pass($user,$link)
    {
        $data = DB::table('tbladmin')->where(['email'=>$user,'link'=>$link])->first();

        if($data)
        {
            DB::table('tbladmin')->where('email',$user)->update(['link'=>'']);
            return view('admin\reset',["user"=>$user]);
        }
        else{
            return redirect('admin\login')->with('error','Invalid Link');
        }    
    }
    function reset(Request $req)
    {
            DB::table('tbladmin')
                ->where('email', $req->mail)
                ->update(['password' => $req->password]);
            
            return redirect('admin\login');    
    }
}
