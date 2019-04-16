<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Validator;
use Mail;
use App\Mail\user_cancel;
use App\Mail\book_cancel;

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
        // echo $req->booking_id;
        $resultset = DB::table('tblbooking')->where('bookingid',$req->booking_id)->first();
        $username = DB::table('tbluser')->where('email',session('email'))->first()->username;
        Mail::to(session('email'))->send(new user_cancel($username,$resultset->purpose,$resultset->starttime,$resultset->endtime));
        DB::table('tblbooking')
        ->where('bookingid',$req->booking_id)
        ->where('useremail',session('email'))
        ->update(['status'=>'Cancelled']);
        
        $bid = $req->booking_id;
        $uname = session('email');
        $data1=  DB::select('select `b`.`bookingid` as `requester` from `tblbooking` as `b` inner join (select * from tblbooking where useremail="'.$uname.'" and bookingid = '.$bid.' )b1 on `b1`.`resourceid` = `b`.`resourceid` inner join `tbluser` as `u` on `u`.`email` = `b`.`useremail` inner join `tblresource` as `r` on `r`.`resource_id` = `b`.`resourceid` where `b`.`status` in ("Requested") and ( (`b`.`starttime` >= `b1`.`starttime` and `b`.`starttime` <= `b1`.`endtime`) or (`b`.`endtime` >= `b1`.`starttime` and `b`.`endtime` <= `b1`.`endtime`) or (`b`.`starttime` <= `b1`.`starttime` and `b`.`endtime` >= `b1`.`endtime`))');
        foreach($data1 as $u){
            $requester = $u->requester;
            echo "<br>Requester ".$requester." ";
            $data = DB::table('tblbooking as b')->where('bookingid',$requester)->first();
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
                // ->get();
                if($bid==0)
                {
                    $resultset1 = DB::table('tblbooking')->where('bookingid',$requester)->first();
                    $username1 = DB::table('tbluser')->where('email',session('email'))->first()->username;
                    Mail::to(session('email'))->send(new book_cancel($username1,$resultset1->purpose,$resultset1->starttime,$resultset1->endtime));
                   DB::table('tblbooking as b')->where('bookingid',$requester)->update(['status'=>'Booked']);
                   return redirect('client_display');
                }
        }
       
         return redirect('client_display');
    }
}