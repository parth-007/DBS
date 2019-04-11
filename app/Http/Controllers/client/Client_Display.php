<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Client_Display extends Controller
{
	function __construct()
    {
        $this->middleware('Backend');
        $this->middleware('CheckisClient');
    }
    function index(){
    	// $users = DB::table('tblbooking')
    	// 		->join('tbluser','email','=','useremail')
    	// 		->select('email','phonenumber','resourceid','purpose','expected_audience','bookingid')
    	// 		->where('email',session('email'))
    	// 		->get();

        $data['final_data'] = DB::table('tblbooking as b')->Join('tbluser as u','u.email','=','b.useremail')->Join('tblresource as r','r.resource_id','=','b.resourceid')->select('r.resourcename','b.starttime','b.endtime','b.purpose','b.expected_audience','b.status')->where(['b.useremail'=>session('email')])->get();
    	 return view('client/display', $data);
    	// return view('client/display');
    }
}