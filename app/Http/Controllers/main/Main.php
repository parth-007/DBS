<?php

namespace App\Http\Controllers\main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Mail;
use DateTime;
use Carbon\Carbon;
use App\Mail\QueryMail;

class Main extends Controller
{
    function index(){
        return view('mainpage/home');
    }
    function check_cc(Request $req)
    {
      
      $num = DB::table('tbluser')->where('email',$req->em1)->where('is_verified',1)->where('is_active',1)->count();

      if($num==0)
      {
        echo "1";
      }
      else
      {
        echo "0";
      }
    }
    function check_faculty(Request $req){
      
      
      $num = DB::table('tbluser')->where('email',$req->em1)->where('is_verified',1)->where('is_active',1)->count();

      if($num==0)
      {
        echo "1";
      }
      else
      {
        echo "0";
      }
    }
    function login(){
        return view('mainpage/login');
    }
    function inspect(){
        $data['building'] = DB::table('tblbuilding')->get();
        
        return view('mainpage/inspect',$data);
    }
    function my_mail(Request $req){
    		echo $req->email;
    		echo $req->message;
    		$mymail = "daiictbooking@gmail.com";
    		// DB::table('temp')->insert(['email'=>$req->email,'msg'=>$req->message]);

    		Mail::to($mymail)->send(new QueryMail($req->email,$req->message));

    }
    function all_booked_slots(Request $req)
    {


        date_default_timezone_set('Asia/Kolkata');
        
      $date=new DateTime($req->mybd.' '.$req->timefrom);
      $fromT = $date->getTimestamp();
      $ts = date('Y-m-d H:i:s',$fromT);
      
      $date1 = new DateTime($req->mybd.' '.$req->timeto);
      $toT = $date1->getTimestamp();
      $ts1 = date('Y-m-d H:i:s',$toT);

        $mybd = $req->mybd;
        $building = $req->building;
    
          $mybd = date('Y-m-d',strtotime($req->mybd));
          
          // booking query
          $data['bk_data'] = DB::table('tblresource as r')->select('r.resource_id','r.resourcename','r.capacity','b.bookingid','b.starttime','b.endtime','b.useremail',
          'b.purpose','b.expected_audience','u.username','u.phonenumber','b.status')
          ->Join(DB::raw('(select * from tblbooking where status NOT IN ("Cancelled") )b'),'r.resource_id','=','b.resourceid','inner')
          ->Join('tbluser as u','u.email','=','b.useremail','left')->          
          Join('tblbuilding as tb','tb.buildingid','=','r.buildingid','left')
          ->where('r.isAllocate',1)->where('r.buildingid','like',$req->building.'%'
          )->where(function($q) use($mybd){
             $q->whereNull('b.bookingid')->orWhere('b.starttime','like',$mybd.'%')->orWhere('b.endtime','like',$mybd.'%');})->get();

          if($data['bk_data']->isEmpty())
          {
            echo '<h2 style="text-align: center; margin: 0; padding: 50px; opacity: .5;"><i class="fas fa-search"
                        style="font-size: 36px;"></i><br>No Match Found</h2>';
          }
          else{
          
              $dc = strtotime($ts);
       $dc1 = strtotime($ts1);
          foreach ($data['bk_data'] as $value) {
               $stime = strtotime($value->starttime);
            $etime = strtotime($value->endtime);

             
                   if(($dc>=($stime) && $dc<($etime)) 
                    || ($dc1>($stime) && $dc1<=($etime))
                     || ($dc<=($stime) && $dc1>=($etime)))
                      {
                $pstime =date('H:i',strtotime($value->starttime));
                $petime =date('H:i',strtotime($value->endtime));

                if($value->status=='Booked')
                {
                    echo "<div class='card'>
                    <h3 class='tx-al-cntr'>{$value->resourcename}</h3>
                    <table class='v-al-top-all' cellspacing='10px'>
                        <tr>
                            <th>Time: </th>
                            <td>{$pstime} to {$petime}</td>
                        </tr>
                        <tr>
                            <th>Booked by: </th>
                            <td>{$value->username}</td>
                        </tr>
                        <tr>
                            <th>Contact: </th>
                            <td>{$value->useremail}</td>
                        </tr>
                        <tr>
                            <th>Description: </th>
                            <td>{$value->purpose}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>{$value->status}</td>
                        </tr>
                    </table>
                </div>";

                }
                else
                {
                    echo "<div class='card'>
                    <h3 class='tx-al-cntr'>{$value->resourcename}</h3>
                    <table class='v-al-top-all' cellspacing='10px'>
                        <tr>
                            <th>Time: </th>
                            <td>{$pstime} to {$petime}</td>
                        </tr>
                        <tr>
                            <th>Booked by: </th>
                            <td>{$value->username}</td>
                        </tr>
                        <tr>
                            <th>Contact: </th>
                            <td>{$value->useremail}</td>
                        </tr>
                        <tr>
                            <th>Description: </th>
                            <td>{$value->purpose}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>{$value->status}</td>
                        </tr>
                    </table>
                </div>";
                }
            }
            }
        }
    }
}

    