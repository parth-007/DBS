<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\ClientSignup;
use App\Mail\forget_password;
use Mail;
use DB;

class Login_controller extends Controller
{
     function __construct()
    {
        $this->middleware('Backend');
        $this->middleware('CheckisClient');
    }
	function signup(Request $req){
        $req->validate([
            "mail2"=>"bail|required|mail",
            "name2"=>"bail|required",
            "usertypeid"=>"bail|required",
            "mobile2"=>"bail|required|numeric|min:10|max:10|regex:'^[6-9][0-9]+$'",
            "password2"=>"bail|required|min:8"
        ]);
		$stud_id = DB::table('tbluser_type')->where('usertype','student')->first();
        $user =DB::table('tbluser')->insert(
        	['email' => $req->mail2, 
        	'username' => $req->name2,
        	'usertypeid' => $stud_id->usertypeid, 
        	'phonenumber' => $req->mobile2,
        	'password' => $req->password2,
        	'is_verified' => 0]
        );
        $length = 60;
        $activation_code=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

         $link=$req->root().'/client/Login_controller/activate_account/'.$req->mail2.'/'.$activation_code;
         DB::table('tblverify_linkes')->insert(['userid'=>$req->mail2,'link'=>$activation_code]);
         Mail::to($req->mail2)->send(new ClientSignup($link));
        // $message->from('xyz@gmail.com','Virat Gandhi');
        return redirect('login');
    }
    function forget_password(Request $req){
        $req->validate([
            "popup_email"=>"bail|required|mail"
        ]);
        $length = 60;
        $activation_code=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

         $link=$req->root().'/client/Login_controller/reset_password/'.$req->popup_email.'/'.$activation_code;
         DB::table('tblverify_linkes')->insert(['userid'=>$req->popup_email,'link'=>$activation_code]);
         Mail::to($req->popup_email)->send(new forget_password($link));
        return redirect('login');
    }
    function reset_pass($user,$link)
    {
        $data = DB::table('tblverify_linkes')->where(['userid'=>$user,'link'=>$link])->first();

        if($data)
        {
            DB::table('tbluser')->where('email',$user)->update(['is_verified'=>1]);
            // DB::table('tblverify_linkes')->where(['userid'=>$user,'link'=>$link])->delete();
            return view('client\reset',["user"=>$user]);
        }
        else{
            return redirect('login')->with('error','Invalid Link');
        }    
    }
    function reset(Request $req)
    {
        $req->validate([
            "mail"=>"bail|required|mail",
            "password"=>"bail|required|min:8"
        ]);
        DB::table('tbluser')
            ->where('email', $req->mail)
            ->update(['password' => $req->password]);
        
        return redirect('login');    
    }
    function activate_account($user,$link)
    {
        $data = DB::table('tblverify_linkes')->where(['userid'=>$user,'link'=>$link])->first();

        if($data)
        {
            DB::table('tbluser')->where('email',$user)->update(['is_verified'=>1]);
            DB::table('tblverify_linkes')->where(['userid'=>$user,'link'=>$link])->delete();
            return redirect('login');
        }
        else{
            return redirect('login')->with('error','Invalid Activation Link');
        }
    }
    function log_in(Request $req){
        $req->validate([
            "mail"=>"bail|required|mail",
            "password"=>"bail|required"
        ]);
    	$num = DB::table('tbluser')->where('email',$req->mail)->where('password',$req->password)->where('is_verified',1)->where('is_active',1)->count();
    	if($num==0)
    	{
    		return redirect('login');
    	}
    	session(['email'=>$req->mail]);
    	return redirect('dashboard');
    }
    function log_out()
    {
    	session()->forget('email');
    	return redirect('login');
    }
}