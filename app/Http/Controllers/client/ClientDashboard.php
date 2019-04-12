<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Carbon\Carbon;
use Validator;

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
      $data['bk_data'] = DB::table('tblresource as r')->select('r.resource_id','r.resourcename','r.capacity','f.ac',
      'f.computers','f.mic','f.projector','f.podium','b.bookingid','b.starttime','b.endtime','b.useremail',
      'b.purpose','b.expected_audience','u.username','u.phonenumber','b.status')
      ->Join(DB::raw('(select * from tblbooking where status NOT IN ("Cancelled") )b'),'r.resource_id','=','b.resourceid','left outer')
      ->Join('tbluser as u','u.email','=','b.useremail','left')->
      Join('tblfacility as f','f.facilityid','=','r.facilityid','left')->
      Join('tblbuilding as tb','tb.buildingid','=','r.buildingid','left')
      ->where('r.isAllocate',1)->where('r.buildingid','like',$req->building.'%'
      )->where(function($q) use($mybd){
         $q->whereNull('b.bookingid')->orWhere('b.starttime','like',$mybd.'%')->orWhere('b.endtime','like',$mybd.'%');})->get();


       $data['tt_data'] = DB::table('tblresource as r')->select('r.resource_id','r.resourcename','r.capacity','f.ac',
       'f.computers','f.mic','f.projector','f.podium','tt.timetable_childid','tt.timestart','tt.timeend',
       'tt.courseid','tt.faculty_email','u1.username as faculty_name')->Join('tbltimetable_child as tt',
       'tt.resourceid','=','r.resource_id','left')->Join('tbluser as u1','u1.email','=','tt.faculty_email',
       
       'left')->Join('tblfacility as f','f.facilityid','=','r.facilityid','left')->Join('tblbuilding as tb',
       'tb.buildingid','=','r.buildingid','left')->where('r.isAllocate',1)->where('r.buildingid','like',$req->building.'%')->
       where(function($q1) use($day){$q1->Where('tt.dayofweek',$day);})->get();

     
      

       
       $dc = strtotime(date('H:i:s', strtotime($ts)));
            $dc1 = strtotime(date('H:i:s',strtotime($ts1)));
            $data['copy_data'] = array();
       foreach ($data['tt_data'] as $value) {
        
                $stime = strtotime($value->timestart);
            $etime = strtotime($value->timeend);
            
              
              if(($dc>=($stime) && $dc<($etime)) || ($dc1>($stime) && $dc1<=($etime)) || ($dc<=($stime) && $dc1>=($etime)))
              {
                
                $mmsg='';
                $pmsg='';
                $prmsg='';
                $amsg='';
                $cmsg='';
                $c = "checked";
                if($value->mic)
                  $mmsg = $c;
                if($value->podium)
                  $pmsg = $c;
                if($value->computers)
                $cmsg = $c;
                if($value->ac)
                $amsg = $c;
                if($value->projector)
                $prmsg = $c;

                // print_r($value);echo "\nGRAY\n\n";
                 array_push($data['copy_data'] , $value);
                 echo "<div class='col-lg-4 col-md-6'>
                 <a href='#'>
                     <div class='card' style='box-shadow: 0 0 8px rgba(0,0,0,.3);background:rgb(125,125,125);min-height:360px;'>
                         <div class='card-body'>
                             <h4 class='card-title' style='color:white'>{$value->resourcename}</h4>
                             <hr color='white' style='opacity:0.4;border:0;background:white;height:1px;'>
                             <table class='card-tbl1' style='font-size:14px;color:white' cellpadding='5'>
                                 <tr ><th>Time: </th><td>{$value->timestart} To {$value->timeend}</td></tr>
                                 <tr><th>Capacity: </th><td>{$value->capacity}</td></tr>
                                 <tr><th>Faculty:</th><td>{$value->faculty_name}</td></tr>
                                 <tr><th>Contact:</th><td>{$value->faculty_email}</td></tr>
                                 <tr><th>Course:</th><td>{$value->courseid}</td></tr>
                                 
                                 <tr><th>Facilities:</th><td>
                                 
                                     <input type='checkbox' $amsg disabled><label style='margin-right:5%;'> AC</label>
                                     <input type='checkbox' $cmsg disabled><label style='margin-right:5%;'> Computers</label> <br>
                                     <input type='checkbox' $pmsg disabled><label style='margin-right:5%;'> Podium</label>
                                     <input type='checkbox' $mmsg  disabled><label style='margin-right:5%;'> Mic</label> <br>
                                     <input type='checkbox' $prmsg disabled><label style='margin-right:5%;'> Projector</label>
                             
                                 </td></tr>
                             </table>                                          
                         </div>
                     </div>
                 </a>                        
             </div>";
                #they are already booked, so you can't book.. it overlaps with other bookings.
              }

          }

          
      
       $dc = strtotime($ts);
       $dc1 = strtotime($ts1);
      
      foreach ($data['bk_data'] as $value) {
              $stime = strtotime($value->starttime);
            $etime = strtotime($value->endtime);
//       $dc = strtotime(date('H:i:s', strtotime($ts)));
        
            if($value->bookingid){
           if(($dc>=($stime) && $dc<($etime)) 
            || ($dc1>($stime) && $dc1<=($etime))
             || ($dc<=($stime) && $dc1>=($etime)))
              {
                $pstime =date('H:i',strtotime($value->starttime));
                $petime =date('H:i',strtotime($value->endtime));
                $mmsg='';
                $pmsg='';
                $prmsg='';
                $amsg='';
                $cmsg='';
                $c = "checked";
                if($value->mic)
                  $mmsg = $c;
                if($value->podium)
                  $pmsg = $c;
                if($value->computers)
                $cmsg = $c;
                if($value->ac)
                $amsg = $c;
                if($value->projector)
                $prmsg = $c;
                    
                

                 // print_r($value->resourcename." is not available");
                // print_r($value);echo "\nRED\n\n";
                //this is red.

              if($value->status=='Booked')
              {
                echo "<div class='col-lg-4 col-md-6'>
                <span onclick=main_task({$value->resource_id},'{$value->status}','{$req->mybd}','{$req->from}','{$req->to}') data-toggle='modal' data-target='#myModal'>
                    <div class='card' style='box-shadow: 0 0 8px rgba(0,0,0,.3);background:rgb(200,44,44);'>
                        <div class='card-body'>
                            <h4 class='card-title' style='color:white'>{$value->resourcename}<span style='float:right;'>Booked</span></h4>
                            <hr color='white' style='opacity:0.4;border:0;background:white;height:1px;'>
                            <table class='card-tbl1' style='font-size:14px;color:white' cellpadding='5'>
                                <tr ><th>Time: </th><td>{$pstime} To {$petime}</td></tr>
                                <tr><th>Capacity: </th><td>{$value->capacity}</td></tr>
                                <tr><th>Booked By:</th><td>{$value->username}</td></tr>
                                <tr><th>Contact:</th><td>{$value->phonenumber}<br>{$value->useremail}</td></tr>
                                <tr><th>Purpose:</th><td>{$value->purpose}</td></tr>
                                <tr><th>Audience:</th><td>{$value->expected_audience}</td></tr>
                                <tr><th>Facilities:</th><td>
                                
                                    <input type='checkbox' $amsg disabled><label style='margin-right:5%;'> AC</label>
                                    <input type='checkbox' $cmsg disabled><label style='margin-right:5%;'> Computers</label> <br>
                                    <input type='checkbox' $pmsg disabled><label style='margin-right:5%;'> Podium</label>
                                    <input type='checkbox' $mmsg  disabled><label style='margin-right:5%;'> Mic</label> <br>
                                    <input type='checkbox' $prmsg disabled><label style='margin-right:5%;'> Projector</label>
                            
                                </td></tr>
                            </table>                                          
                        </div>
                    </div>
                </span>                   
            </div>";
              }
              else{
                echo "<div class='col-lg-4 col-md-6'>
                <span onclick=main_task({$value->resource_id},'{$value->status}','{$req->mybd}','{$req->from}','{$req->to}') data-toggle='modal' data-target='#myModal'>
                    <div class='card' style='box-shadow: 0 0 8px rgba(0,0,0,.3);background:rgb(220,178,38);'>
                        <div class='card-body'>
                            <h4 class='card-title' style='color:white'>{$value->resourcename}<span style='float:right;'>Requested</span></h4>
                            <hr color='white' style='opacity:0.4;border:0;background:white;height:1px;'>
                            <table class='card-tbl1' style='font-size:14px;color:white' cellpadding='5'>
                                <tr ><th>Time: </th><td>{$pstime} To {$petime}</td></tr>
                                <tr><th>Capacity: </th><td>{$value->capacity}</td></tr>
                                <tr><th>Booked By:</th><td>{$value->username}</td></tr>
                                <tr><th>Contact:</th><td>{$value->phonenumber}<br>{$value->useremail}</td></tr>
                                <tr><th>Purpose:</th><td>{$value->purpose}</td></tr>
                                <tr><th>Audience:</th><td>{$value->expected_audience}</td></tr>
                                <tr><th>Facilities:</th><td>
                                
                                    <input type='checkbox' $amsg disabled><label style='margin-right:5%;'> AC</label>
                                    <input type='checkbox' $cmsg disabled><label style='margin-right:5%;'> Computers</label> <br>
                                    <input type='checkbox' $pmsg disabled><label style='margin-right:5%;'> Podium</label>
                                    <input type='checkbox' $mmsg  disabled><label style='margin-right:5%;'> Mic</label> <br>
                                    <input type='checkbox' $prmsg disabled><label style='margin-right:5%;'> Projector</label>
                            
                                </td></tr>
                            </table>                                          
                        </div>
                    </div>
                </span>                   
            </div>";
              }

                
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
              // print_r($value);echo "\nGREEN\n\n";
              $mmsg='';
                $pmsg='';
                $prmsg='';
                $amsg='';
                $cmsg='';
                $c = "checked";
                if($value->mic)
                  $mmsg = $c;
                if($value->podium)
                  $pmsg = $c;
                if($value->computers)
                $cmsg = $c;
                if($value->ac)
                $amsg = $c;
                if($value->projector)
                $prmsg = $c;
                    
                

                 // print_r($value->resourcename." is not available");
                // print_r($value);echo "\nRED\n\n";

                //this is Green
                echo "<div class='col-lg-4 col-md-6'>
                <span onclick=main_task({$value->resource_id},'{$value->status}','{$req->mybd}','{$req->from}','{$req->to}') data-toggle='modal' data-target='#myModal'>
                    <div class='card' style='box-shadow: 0 0 8px rgba(0,0,0,.3);background:rgb(0,153,0);min-height:390px;'>
                        <div class='card-body'>
                            <h4 class='card-title' style='color:white'>{$value->resourcename}<span style='float:right;'>Available</span></h4>
                            <hr color='white' style='opacity:0.4;border:0;background:white;height:1px;'>
                            <table class='card-tbl1' style='font-size:14px;color:white' cellpadding='5'>
                                
                                <tr><th>Capacity: </th><td>{$value->capacity}</td></tr>
                                
                                
                                
                                <tr><th>Facilities:</th><td>
                                
                                    <input type='checkbox' $amsg disabled><label style='margin-right:2%;'> AC</label><br>
                                    <input type='checkbox' $cmsg disabled><label style='margin-right:2%;'> Computers</label> <br>
                                    <input type='checkbox' $pmsg disabled><label style='margin-right:2%;'> Podium</label><br>
                                    <input type='checkbox' $mmsg  disabled><label style='margin-right:2%;'> Mic</label> <br>
                                    <input type='checkbox' $prmsg disabled><label style='margin-right:2%;'> Projector</label>
                            
                                </td></tr>
                            </table>                     
                            <br>
                            <h4 class='card-title' style='color:white'>Book Now!</h4>                     
                        </div>
                    </div>
                </span>                      
            </div>";
            }
            
          }
        }
          
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
      $req->validate([
            "txt_username"=>"bail|required",
            "txt_phoneno"=>"bail|required|size:10|regex:'^[6-9][0-9]+$'",
        ]);
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
    function slots_manage(Request $req)
    {
          if(!$req->session()->has('email'))
          {
              return redirect('login');
          }
         $useremail = session('email');
        $resourceid = $req->mainid;
        $starttime = $req->stt;
        $endtime = $req->ett;
        $purpose = $req->purpose;
        $audi = $req->audi;
        echo $useremail;
        echo $resourceid;
        echo $starttime;
        echo $endtime;
        echo $purpose;
        echo $audi;
        echo $req->sta1;
        if($req->sta1 == 'Book')
        {
          DB::table('tblbooking')->insert(['starttime'=>$starttime,'endtime'=>$endtime,'useremail'=>$useremail,'resourceid'=>$resourceid
          ,'purpose'=>$purpose,'expected_audience'=>$audi,'status'=>'Booked']);
        }
        else{
          DB::table('tblbooking')->insert(['starttime'=>$starttime,'endtime'=>$endtime,'useremail'=>$useremail,'resourceid'=>$resourceid
          ,'purpose'=>$purpose,'expected_audience'=>$audi,'status'=>'Requested']);
        }
        return redirect('client_display');
    }
}
