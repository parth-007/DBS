<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Respond_Request extends Controller
{
	function __construct()
    {
        $this->middleware('Backend');
        $this->middleware('CheckisClient');
    }
    function index(){

    	// DB::enableQueryLog();
    	$uname = session('email');

    	$data['request_data'] = DB::table('tblbooking as b')
                                ->select('b.starttime','b.endtime')
                                ->Join(DB::raw('(select * from tblbooking where useremail="'.$uname.'" and status IN ("Booked") )b1'),
                                    function($join)
                                    {
                                    $join->on('b1.resourceid','=','b.resourceid');
                                    })
        ->whereIn('b.status',['Requested'])
        ->where(function($q0) {
        $q0->where(function($q1)  {
          $q1->where('b.starttime','>=','b1.starttime')
          ->orWhere('b.starttime','<','b1.endtime');
        })
        ->orWhere(function($q2) {
        $q2->where('b.endtime','>','b1.starttime')
        ->orWhere('b.endtime','<=','b1.endtime');
        })
        ->orWhere(function($q3) {
        $q3->where('b.starttime','<=','b1.starttime')
        ->orWhere('b.endtime','>=','b1.endtime');
        });
        })
        ->get();

//     
    	echo '<pre>';
    	print_r($data);
    	// print_r(dd(DB::getQueryLog()));
    	// echo '<pre>';
    	// print_r($data['request_data'])
    	die;
    	// return view('client/res_to_req');
    }
}