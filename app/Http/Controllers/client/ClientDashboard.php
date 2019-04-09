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
      
      // booking query
      $data['bk_data'] = DB::table('tblresource as r')->select('r.resource_id','r.resourcename','r.capacity','f.ac','f.computers','f.mic','f.projector','f.podium','b.bookingid','b.starttime','b.endtime','b.useremail','b.purpose','b.expected_audience','u.username','u.phonenumber')->Join('tblbooking as b','r.resource_id','=','b.resourceid','left outer')->Join('tbluser as u','u.email','=','b.useremail','left')->Join('tblfacility as f','f.facilityid','=','r.facilityid','left')->Join('tblbuilding as tb','tb.buildingid','=','r.buildingid','left')->where('r.isAllocate',1)->where('r.buildingid',$req->building)->where(function($q) use($mybd){
         $q->whereNull('b.bookingid')->orWhere('b.starttime','like',$mybd.'%')->orWhere('b.endtime','like',$mybd.'%');})->get();


       $data['tt_data'] = DB::table('tblresource as r')->select('r.resource_id','r.resourcename','r.capacity','f.ac','f.computers','f.mic','f.projector','f.podium','tt.timetable_childid','tt.timestart','tt.timeend','tt.courseid','tt.faculty_email','u1.username as faculty_name')->Join('tbltimetable_child as tt','tt.resourceid','=','r.resource_id','left')->Join('tbluser as u1','u1.email','=','tt.faculty_email','left')->Join('tblfacility as f','f.facilityid','=','r.facilityid','left')->Join('tblbuilding as tb','tb.buildingid','=','r.buildingid','left')->where('r.isAllocate',1)->where('r.buildingid',$req->building)->where(function($q1) use($day){$q1->Where('tt.dayofweek',$day);})->get();

     
       // $dc = Carbon::parse($ts);
       // $dc1 = Carbon::parse($ts1);
       
       // $dc = strtotime($ts);
       // $dc1 = strtotime($ts1);

       echo '<pre>';
       $dc = strtotime(date('H:i:s', strtotime($ts)));
            $dc1 = strtotime(date('H:i:s',strtotime($ts1)));
            $data['copy_data'] = array();
       foreach ($data['tt_data'] as $value) {
        
                $stime = strtotime($value->timestart);
            $etime = strtotime($value->timeend);
            
              
              if(($dc>=($stime) && $dc<($etime)) || ($dc1>($stime) && $dc1<=($etime)) || ($dc<=($stime) && $dc1>=($etime)))
              {
                
                echo '<pre>';
                print_r($value);echo "\nGRAY\n\n";
                 array_push($data['copy_data'] , $value);

                #they are already booked, so you can't book.. it overlaps with other bookings.
              }

          }

          
      
       $dc = strtotime($ts);
       $dc1 = strtotime($ts1);
      
      foreach ($data['bk_data'] as $value) {
              $stime = strtotime($value->starttime);
            $etime = strtotime($value->endtime);

            if($value->bookingid){
           if(($dc>=($stime) && $dc<($etime)) || ($dc1>($stime) && $dc1<=($etime)) || ($dc<=($stime) && $dc1>=($etime)))
              {
                 // print_r($value->resourcename." is not available");
                print_r($value);echo "\nRED\n\n";
                      
              }
          }
          else{
            $flg=0;
              
             
            foreach ($data['copy_data'] as $value1) {
              if($value->resource_id==$value1->resource_id){
                $flg=1;
                break;
              }
            }
            
            if($flg==0)
            {
              print_r($value);echo "\nGREEN\n\n";
            }
            
          }
        }
          die;
      //     else if($value->timetable_childid){
      //       $stime = strtotime($value->timestart);
      //       $etime = strtotime($value->timeend);
      //       $dc = strtotime(date('H:i:s', strtotime($ts)));
      //       $dc1 = strtotime(date('H:i:s',strtotime($ts1)));
      //       echo $stime . " " . $etime . " " . $dc . " " .$dc1;
      //       print_r($value);
      //        if(($dc>=($stime) && $dc<($etime)) || ($dc1>($stime) && $dc1<=($etime)) || ($dc<=($stime) && $dc1>=($etime)))
      //       {
      //         #Timetable
      //         echo "Fff";
      //       }
      //     } 

      //     // else{
      //     //   print_r($data['mydata']);
      //     //   #free
      //     // }
      // }
      
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
