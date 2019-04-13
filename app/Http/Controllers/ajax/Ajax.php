<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
class Ajax extends Controller
{
	function dup_mail_check(Request $req)
	{
		$req->validate([
            "mail"=>"bail|required|email"
        ]);
		$num = DB::table('tbluser')->where('email',$req->mail)->where('is_verified',1)->where('is_active',1)->count();
		if($num!=0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	function reset_mail_check(Request $req)
	{
		$req->validate([
            "mail"=>"bail|required|email"
        ]);
		$num = DB::table('tbluser')->where('email',$req->mail)->where('is_verified',1)->where('is_active',1)->count();
		if($num!=0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	function log_info_check(Request $req)
	{
		$req->validate([
            "mail"=>"bail|required|email",
            "password"=>"bail|required"
        ]);
		// $num = DB::table('tbluser')->where('email',$req->mail)->where('password',$req->password)->count();
		$num = DB::table('tbluser')->where('email',$req->mail)->where('password',$req->password)->where('is_active',1)->where('is_verified',1)->count();
    	if($num==0)
    	{
    		echo "1";
    		
    	}
    	else
    	{
    		$data = DB::table('tbluser')->where('email',$req->mail)->first();

    		session(['email'=>$req->mail]);
    		session(['username'=>$data->username]);
    		echo 0;
    	}
	}
	function admin_log_info_check(Request $req)
	{
		$req->validate([
            "mail"=>"bail|required|email",
            "password"=>"bail|required"
        ]);
		$num = DB::table('tbladmin')->where('email',$req->mail)->where('password',$req->password)->count();
    	if($num==0)
    	{
    		session()->forget('error1');
    		echo "1";
    		
    	}
    	else
    	{

    		session(['admin_email'=>$req->mail]);
    		echo 0;
    	}
	}
}