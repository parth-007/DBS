<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Carbon\Carbon;
class ClientDashboard extends Controller
{
    function index(){

      
    	return view('client/dashboard');
    }

    function book(){
        $data['building'] = DB::table('tblbuilding')->get();
        return view('client/booking',$data);
    }

   	function show_slots(Request $req)
   	{
      date_default_timezone_set('Asia/Kolkata');
   		// echo $req->mybd;
   		// echo $req->from;
   		// echo $req->to;
   		// echo $req->building;
      $date=new DateTime($req->mybd.' '.$req->from);
      $fromT = $date->getTimestamp();
      $ts = date('Y-m-d H:i:s',$fromT);
      
      $date1 = new DateTime($req->mybd.' '.$req->to);
      $toT = $date->getTimestamp();
      $ts1 = date('Y-m-d H:i:s',$fromT);

   

      // $data['resources'] = DB::table('tblresource')->where('buildingid',$req->building)->get();

      $data['mydata'] = DB::table('tblresource as r')->select('r.resource_id','r.resourcename','b.bookingid','b.starttime','b.endtime','b.useremail','u.username','tt.timetable_childid','tt.timestart','tt.timeend','tt.faculty_email','u1.username as faculty')->Join('tblbooking as b','r.resource_id','=','b.resourceid','left outer')->Join('tbluser as u','u.email','=','b.useremail','left')->Join('tbltimetable_child as tt','tt.resourceid','=','r.resource_id','left')->Join('tbluser as u1','u1.email','=','tt.faculty_email','left')->get();

      
 

   	}
}
