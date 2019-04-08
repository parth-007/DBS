<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\ClientSignup;
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
    	$num = DB::table('tbluser')->where('email',$req->mail)->where('password',$req->password)->count();
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