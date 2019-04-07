<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Ajax extends Controller
{
	function dup_mail_check(Request $req)
	{
		$num = DB::table('tbluser')->where('email',$req->mail)->count();
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
		$num = DB::table('tbluser')->where('email',$req->mail)->where('password',$req->password)->count();
    	if($num==0)
    	{
    		echo "1";
    		
    	}
    	else
    	{
    		session(['email'=>$req->mail]);
    		echo 0;
    	}
	}
	function admin_log_info_check(Request $req)
	{
		$num = DB::table('tbladmin')->where('email',$req->mail)->where('password',$req->password)->count();
    	if($num==0)
    	{
    		echo "1";
    		
    	}
    	else
    	{
    		session(['admin_email'=>$req->mail]);
    		echo 0;
    	}
	}
}