<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;

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
        $request_data= DB::select('select `b`.`bookingid`, `u`.`username`, `b`.`starttime`, `b`.`endtime`, `u`.`phonenumber`, `b`.`purpose`, `b`.`expected_audience`, `r`.`resourcename`, `b`.`useremail`, `b1`.`useremail` as `b1_email`, `b1`.`purpose` as `b1_purpose`, `b1`.`bookingid` as `b1_bookingid`, `b1`.`starttime` as `b1_starttime`, `b1`.`endtime` as `b1_endtime`, `b1`.`expected_audience` as `b1_expected_audience` from `tblbooking` as `b` inner join (select * from tblbooking where useremail="'.$uname.'" and status IN ("Booked") )b1 on `b1`.`resourceid` = `b`.`resourceid` inner join `tbluser` as `u` on `u`.`email` = `b`.`useremail` inner join `tblresource` as `r` on `r`.`resource_id` = `b`.`resourceid` where `b`.`status` in ("Requested") and ( (`b`.`starttime` >= `b1`.`starttime` and `b`.`starttime` <= `b1`.`endtime`) or (`b`.`endtime` >= `b1`.`starttime` and `b`.`endtime` <= `b1`.`endtime`) or (`b`.`starttime` <= `b1`.`starttime` and `b`.`endtime` >= `b1`.`endtime`))');
    	// $data['request_data'] = DB::table('tblbooking as b')
     //                            ->Join(DB::raw('(select * from tblbooking where useremail="'.$uname.'" and status IN ("Booked") )b1'),
     //                                function($join)
     //                                {
     //                                $join->on('b1.resourceid','=','b.resourceid');
     //                                })
     //                            ->Join('tbluser as u','u.email','=','b.useremail')
     //                            ->Join('tblresource as r','r.resource_id','=','b.resourceid')
     //    ->whereIn('b.status',['Requested'])
     //    ->where(function($q0)  {
     //            $q0->where(function($q1){
     //                $q1->where('b.starttime','>=','b1.starttime')->where('b.starttime','<=','b1.endtime');
     //                })
     //                ->orWhere(function($q2){
     //                $q2->where('b.endtime','>=','b1.starttime')->where('b.endtime','<=','b1.endtime');
     //                })
     //                ->orWhere(function($q3){
     //                $q3 ->where('b.starttime','<=','b1.starttime')
     //                    ->Where('b.endtime','>=','b1.endtime');
     //                });
     //            })
     //    ->select('b.bookingid','u.username','b.starttime','b.endtime','u.phonenumber','b.purpose','b.expected_audience','r.resourcename','b.useremail','b1.useremail as b1_email','b1.purpose as b1_purpose','b1.bookingid as b1_bookingid','b1.starttime as b1_starttime','b1.endtime as b1_endtime','b1.expected_audience as b1_expected_audience')
     //            ->toSql();
        // ->get();
        
        // dd($request_data);
        // dd(DB::getQueryLog());
        // echo "<pre>";
        // print_r($data);
    	return view('client/res_to_req', ['request_data' => $request_data]);
    }
    function respond($rbookingid,$ubookingid)
    {
        $data = DB::table('tblbooking as b')->where('bookingid',$rbookingid)->first();
        DB::table('tblbooking')->where('bookingid',$ubookingid)->update(['status'=>'Cancelled']);
        
        $bid  = DB::table('tblbooking as b')
                ->where('resourceid',$data->resourceid)
                ->where('status',"Booked")
                
                ->where(function($q0) use($data) {
                $q0->where(function($q1) use($data)  {
                    $q1->where('b.starttime','>=',$data->starttime)
                    ->Where('b.starttime','<=',$data->endtime);
                    })
                    ->orWhere(function($q2) use($data){
                    $q2->where('b.endtime','>=',$data->starttime)
                    ->Where('b.endtime','<=',$data->endtime);
                    })
                    ->orWhere(function($q3) use($data) {
                    $q3->where('b.starttime','<',$data->starttime)
                    ->Where('b.endtime','>',$data->endtime);
                    });
                })
                ->select('b.bookingid')
                ->count();
                if($bid==0)
                {
                    //request accept mail @$rbookingid
                    DB::table('tblbooking as b')->where('bookingid',$rbookingid)->update(['status'=>'Booked']);
                }
                return redirect('request');
    }
    function Cancel($bookingid)
    {
        //request denied mail
        DB::table('tblbooking')->where('bookingid',$bookingid)->update(['status'=>'Denied']);
        return redirect('request');
    }
}