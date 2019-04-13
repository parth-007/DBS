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
        $bid = $req->booking_id;
        echo $bid;
        $uname = session('email');
        $data1= DB::table('tblbooking as b')
                                ->Join(DB::raw('(select * from tblbooking where useremail="'.$uname.'" )b1'),
                                    function($join)
                                    {
                                    $join->on('b1.resourceid','=','b.resourceid');
                                    })
                                ->Join('tbluser as u','u.email','=','b.useremail')
                                ->Join('tblresource as r','r.resource_id','=','b.resourceid')
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
        ->where('b1.bookingid',$bid)
        ->select('b.bookingid as requester')
        ->get();
        echo "<pre>";
        print_r($data1);
        echo "</pre>";
        // print_r($data[0]['requester']);
        foreach($data1 as $u){
            $requester = $u->requester;
            $data = DB::table('tblbooking as b')->where('bookingid',$requester)->first();
                    $bid  = DB::table('tblbooking as b')
                ->where('resourceid',$data->resourceid)
                ->where('status',"Booked")
                // ->where('useremail',session('email'))
                ->where(function($q0) use($data) {
                $q0->where(function($q1) use($data)  {
                    $q1->where('b.starttime','>=',$data->starttime)
                    ->orWhere('b.starttime','<',$data->endtime);
                    })
                    ->orWhere(function($q2) use($data){
                    $q2->where('b.endtime','>',$data->starttime)
                    ->orWhere('b.endtime','<=',$data->endtime);
                    })
                    ->orWhere(function($q3) use($data) {
                    $q3->where('b.starttime','<=',$data->starttime)
                    ->orWhere('b.endtime','>=',$data->endtime);
                    });
                })
                ->select('b.bookingid')
                ->count();
                if($bid==0)
                {
                   DB::table('tblbooking as b')->where('bookingid',$requester)->update(['status'=>'Booked']);
                   return redirect('client_display');
                }
        }
       
        // return redirect('client_display');
    }
}