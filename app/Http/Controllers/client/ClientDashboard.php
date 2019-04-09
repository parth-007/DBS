<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Carbon\Carbon;

class ClientDashboard extends Controller
{
	public function __construct(){
		$this->middleware('CheckisClient');
    $this->middleware('Backend');
    
	}
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
      $toT = $date1->getTimestamp();
      $ts1 = date('Y-m-d H:i:s',$toT);



      // $data['resources'] = DB::table('tblresource')->where('buildingid',$req->building)->get();
      $timestamp = strtotime($req->mybd);

      $day = date('l', $timestamp);
      $day = strtolower($day);

      

      $mybd = date('Y-m-d',strtotime($req->mybd));
      
      $data['mydata'] = DB::table('tblresource as r')->select('r.resource_id','r.resourcename','r.capacity','f.ac','f.computers','f.mic','f.projector','f.podium','b.bookingid','b.starttime','b.endtime','b.useremail','b.purpose','b.expected_audience','u.username','u.phonenumber','tt.timetable_childid','tt.timestart','tt.timeend','tt.courseid','tt.faculty_email','u1.username as faculty_name')->Join('tblbooking as b','r.resource_id','=','b.resourceid','left outer')->Join('tbluser as u','u.email','=','b.useremail','left')->Join('tbltimetable_child as tt','tt.resourceid','=','r.resource_id','left')->Join('tbluser as u1','u1.email','=','tt.faculty_email','left')->Join('tblfacility as f','f.facilityid','=','r.facilityid','left')->Join('tblbuilding as tb','tb.buildingid','=','r.buildingid','left')->where('r.isAllocate',1)->where('r.buildingid',$req->building)->where(function($q) use($mybd){
        $q->whereNull('b.bookingid')->orWhere('b.starttime','like',$mybd.'%')->orWhere('b.endtime','like',$mybd.'%');})->where(function($q1) use($day){$q1->whereNull('tt.timetable_childid')->orWhere('tt.dayofweek',$day);})->get();

       // $dc = Carbon::parse($ts);
       // $dc1 = Carbon::parse($ts1);
       
       $dc = strtotime($ts);
       $dc1 = strtotime($ts1);

      foreach ($data['mydata'] as $value) {

          if($value->bookingid)
          {

            $stime = strtotime($value->starttime);
            $etime = strtotime($value->endtime);

            // $stime = strtotime($row['DATETIMEAPP']);
            // $etime = Carbon::parse($value->endtime);
            // echo $stime;echo $etime;echo $dc->>=($stime);die;  
            // echo "   ";
            // echo $stime;echo "     ";
            // echo $etime;echo "     "; echo $stime>=$etime;
              if(($dc>=($stime) && $dc<($etime)) || ($dc1>($stime) && $dc1<=($etime)) || ($dc<=($stime) && $dc1>=($etime)))
              {
                print_r($value);
                #they are already booked, so you can't book.. it overlaps with other bookings.
               
                
              }

          }
          // else if($value->timetable_childid){
          //   if(($ts->ge($value->timestart) && $ts->lt($value->timeend)) || ($ts1->gt($value->timestart) && $ts1->le($value->timeend)) || ($ts->le($value->timestart) && $ts1->ge($value->timeend)))
          //   {
          //     #Timetable
          //     print_r($data['mydata']);
          //   }
          // } 
          // else{
          //   print_r($data['mydata']);
          //   #free
          // }
      }

   	}
    function userProfile(){
        $useremail=session('email');
        $data['user']=DB::table('tbluser')
        ->where('email',$useremail)
        ->first();
        return view('client/profile',$data);
    }
    function updateProfile(Request $req){
        $useremail=session('email');
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
        session(['username'=>$req->txt_username]);
        echo $data;
    }
}
