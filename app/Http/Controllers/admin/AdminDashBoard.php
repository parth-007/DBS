<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AdminDashBoard extends Controller
{
    function index(){
    	return view('admin/dashboard');
    }
    function building(){
        return view('admin/building');
    }
    function resource(){
        
        $data['resource'] = DB::table("tblresource")->get();
        return view('admin/resource',$data);
    }
    function user(){
        return view('admin/user');
    }
}
