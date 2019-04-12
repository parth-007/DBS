<?php

namespace App\Http\Controllers\main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use App\Mail\QueryMail;
class Main extends Controller
{
    function index(){
        return view('mainpage/home');
    }
    function login(){
        return view('mainpage/login');
    }
    function inspect(){
        return view('mainpage/inspect');
    }
    function my_mail(Request $req){
    		echo $req->email;
    		echo $req->message;
    		$mymail = "daiictbooking@gmail.com";
    		// DB::table('temp')->insert(['email'=>$req->email,'msg'=>$req->message]);

    		Mail::to($mymail)->send(new QueryMail($req->email,$req->message));

    }
}
