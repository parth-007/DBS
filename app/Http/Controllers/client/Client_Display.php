<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Client_Display extends Controller
{
    function index(){
    	$users = DB::table('tblbooking')
    			->join('tbluser','email','=','useremail')
    			->select('email','phonenumber','resourceid','purpose','expected_audience','bookingid')
    			->get();
    	 return view('client/display', ['users' => $users]);
    	// return view('client/display');
    }
}