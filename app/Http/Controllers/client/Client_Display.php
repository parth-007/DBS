<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;

class Client_Display extends Controller
{
	function __construct()
    {
        $this->middleware('Backend');
        $this->middleware('CheckisClient');
    }
    function index(){
    	$users = DB::table('tblbooking')
    			->join('tbluser','email','=','useremail')
                ->join('tblresource','resource_id','=','resourceid')
                ->join('tblbuilding','tblbuilding.buildingid','=','tblresource.buildingid')
    			->select('username','email','phonenumber','resourceid','purpose','expected_audience','bookingid','resourcename','buildingname','tblbooking.status','starttime',"endtime")
    			->where('email',session('email'))
                ->whereNotIn('tblbooking.status',['Cancelled'])
    			->get();
    	 return view('client/display', ['users' => $users]);
    	// return view('client/display');
    }
    function delete_booking(Request $req)
    {
        DB::table('tblbooking')
        ->where('bookingid',$req->booking_id)
        ->where('useremail',session('email'))
        ->update(['status'=>'Cancelled']);
        return redirect('client_display');
    }
}