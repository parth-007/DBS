<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Login_controller extends Controller
{
	function signup(Request $req){
		$stud_id = DB::table('tbluser_type')->where('usertype','student')->first();
        DB::table('tbluser')->insert(
        	['email' => $req->mail2, 
        	'username' => $req->name2,
        	'usertypeid' => $stud_id->usertypeid, 
        	'phonenumber' => $req->mobile2,
        	'password' => $req->password2,
        	'is_verified' => 0]
        );
        return redirect('login');
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
    	session()->flush();
    	return redirect('login');
    }
}