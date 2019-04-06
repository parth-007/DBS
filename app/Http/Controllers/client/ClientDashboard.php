<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ClientDashboard extends Controller
{
    function index(){
    	return view('client/dashboard');
    }
    function userProfile(){
        $useremail="201812109@daiict.ac.in";
        $data['user']=DB::table('tbluser')
        ->where('email',$useremail)
        ->first();
        return view('client/profile',$data);
    }
    function updateProfile(Request $req){
        $useremail="201812109@daiict.ac.in";
        if($req->txt_password=='' || $req->txt_password==null){
            $data=DB::table('tbluser')
            ->where('email', $useremail)
            ->update(['username'=>$req->txt_username,"phonenumber"=>$req->txt_phoneno]);
        }
        else{
            $data=DB::table('tbluser')
            ->where('email', $useremail)
            ->update(['username'=>$req->txt_username,"phonenumber"=>$req->txt_phoneno,"password"=>$req->txt_password]);
        }
        echo $data;
    }
}
