<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\FacultyVerify;
use App\Mail\club_committee_verify;
use App\Mail\inquiry_mail;
use DB;
use Mail;
use Validator;

use Carbon\Carbon;
date_default_timezone_set('Asia/Kolkata');
class AdminDashBoard extends Controller
{
    function __construct(){
        $this->middleware('CheckisAdmin');
        $this->middleware('Backend'); 
    }
    // INM 09-04-2019
    function bookings_print_todays(){
        $todayDate = date("Y-m-d");
        $data['bookings']=DB::table('tblbooking')
                ->join('tblresource','tblresource.resource_id','=','tblbooking.resourceid')
                ->join('tbluser','tbluser.email','=','tblbooking.useremail')
                ->join('tbluser_type','tbluser_type.usertypeid','=','tbluser.usertypeid')
                ->orWhere('tblbooking.status','Booked')
                ->whereRaw('date(starttime) = ?',$todayDate)
                ->select("phonenumber","tbluser.username","tbluser_type.usertype","tblresource.resourcename","tblbooking.useremail","tblbooking.endtime","tblbooking.starttime","tblbooking.purpose","tblbooking.expected_audience","tblbooking.status")
                ->orderByRaw('resourceid')
                ->get();
        $data['todayDate'] = date("Y-m-d");    
        // $data['time'] = date('Gi.s', $data[]);
            return view('admin/bookings_print_todays',$data);
    }
    // INM 14-04-2019
    function inserttimetableslot(Request $req){
        
        $tm=DB::table("tbltimetable_master")
                    ->where(["programmeid"=>$req->programme,"semester"=>$req->semester])
                    ->first()
                    ->timetablemasterid; 

        $res=DB::table('tbltimetable_child')->insert([
                                    'masterid'=>$tm,
                                    'dayofweek'=>$req->day, 
                                    'timestart'=>$req->time_start,
                                    'timeend'=>$req->time_end,
                                    'resourceid'=>$req->resource,
                                    'courseid'=>$req->courseid,
                                    'faculty_email'=>$req->faculty
                                    ]);
        echo $res;
    }
    // INM 09-04-2019
    function bookings(){
        // ->join('tbluser_type','tbluser_type.usertypeid','=','tbluser.usertypeid')
        $data['bookings']=DB::table('tblbooking')
        ->join('tblresource','tblresource.resource_id','=','tblbooking.resourceid')
        ->join('tbluser','tbluser.email','=','tblbooking.useremail')
        ->join('tbluser_type','tbluser_type.usertypeid','=','tbluser.usertypeid')
        // ->whereRaw('date(starttime) = ?',$todayDate)
        ->select("phonenumber","tbluser.username","tbluser_type.usertype","tblresource.resourcename","tblbooking.useremail","tblbooking.endtime","tblbooking.starttime","tblbooking.purpose","tblbooking.expected_audience","tblbooking.status")
        ->orderByRaw('starttime DESC')
        ->paginate(5);
        return view('admin/bookings',$data);
    }
    function index(){
        $count['resources_count']=DB::table('tblresource')->count();
        $count['users_count']=DB::table('tbluser')->count();
        $count['buildings_count']=DB::table('tblbuilding')->count();
        $count['bookings_count']=DB::table('tblbooking')->count();
        // INM 09-04-2019
        $todayDate = date("Y-m-d");
        $count['bookings_count_today']=DB::table('tblbooking')
                ->orWhere('tblbooking.status','Booked')
                ->whereRaw('date(starttime) = ?',$todayDate)->count();

        // INM 13-04-2019
        $count['users_cc']=DB::table('tbluser')
                ->join('tbluser_type','tbluser_type.usertypeid','=','tbluser.usertypeid')
                ->orWhere('tbluser_type.usertype','committee')
                ->orWhere('tbluser_type.usertype','club')
                ->count();

        // INM 13-04-2019
        $count['faculty_count']=DB::table('tbluser')
                ->join('tbluser_type','tbluser_type.usertypeid','=','tbluser.usertypeid')
                ->where('tbluser_type.usertype','faculty')
                ->count();
    	return view('admin/dashboard',$count);
    }
    function building(){
        $data['buildings']=DB::table('tblbuilding')->get();
        return view('admin/building',$data);
    }
    public function insert(Request $req){
        $req->validate([
            "buildingname"=>"bail|required"
        ]);
        $a = $req->buildingname;
        DB::table('tblbuilding')->insert(['buildingname'=>$a]);
        return redirect('admin/buildings');
    }
    // INM 12-04-2019
    public function updatebuilding(Request $req){
        // $req->validate([
        //     "buildingname"=>"bail|required"
        // ]);
        $a = $req->buildingname_update;
        DB::table("tblbuilding")->where('buildingid',$req->uid)->update(['buildingname'=>$a]);
        return redirect('admin/buildings');
    }

    public function delete($id){
        DB::table('tblbuilding')->where('buildingid',$id)->delete();
        return redirect('admin/buildings');
    }

    public function fetch_account($aid){
        $account=DB::table("tblbuilding")->where('buildingid',$aid)->first();
        echo json_encode($account);
    }
    public function status_change(Request $req){
        $email = $req->email;
        $status = $req->status;    
        $up=DB::table("tbluser")->where('email',$email)->update(['is_active'=>$status]);
        echo $up;
    }
    //INM 06-04-2019
    public function showHint(Request $req)
    {
        $str = $req->str;
        $res=DB::table("tbluser")
        ->join('tbluser_type','tbluser_type.usertypeid','=','tbluser.usertypeid')
            ->where('email','like','%'.$str.'%')
            ->orWhere('username', 'like', '%'.$str.'%')
            ->orWhere('phonenumber', 'like', '%'.$str.'%')
            ->orWhere('tbluser_type.usertype', 'like', '%'.$str.'%')
            ->select('email','username','phonenumber','tbluser_type.usertype','tbluser.is_active','tbluser.is_verified')
            ->orderBy('tbluser_type.usertypeid','asc')
            ->get();
            $data="";
            $counter=1;
            foreach($res as $user)
            { 
                $data.='<tr><td>'.$counter++.'</td>
                <td>'.$user->email.'</td>
                <td>'.$user->username.'</td>
                <td>'.$user->usertype.'</td>
                <td>'.$user->phonenumber.'</td>';
                if ($user->is_verified==1){
                    $data.='<td>Yes</td>';
                }
                else{
                    $data.='<td>No</td>';
                }
                if ($user->is_active==1) {
                    $data.='<td><a href="#" class="badge userstatus badge-info">Active</td>';
                }
                else {
                    $data.='<td><a href="#" class="badge userstatus badge-danger">In-active</td>';
                }
                $data.='</tr>';
            }
            echo strval($data);
    }
    function addtimetable_slot()
    {
        $data['prog_data'] = DB::table('tblprogramme')->get();
        $myid = DB::table('tbluser_type')->where('usertype','faculty')->first()->usertypeid;
        $data['fac_data'] = DB::table('tbluser')->where('usertypeid',$myid)->get();
        $data['res_data'] = DB::table('tblresource')->get();
        return view('admin/timetable',$data);
    }
    function resource(){
        $data['resource'] = DB::table("tblresource")
                            ->orderBy('tblresource.resource_id','asc')
                            ->paginate(20);
        $data['buildings']=DB::table('tblbuilding')->get();
        return view('admin/resource',$data);
    }
    function insertResource(Request $req){
        // echo $req->isAllocate;
        // die;
        $req->validate([
            "resourcename"=>"bail|required",
            "capacity"=>"bail|required|numeric"
        ]);
        if($req->ac == "on"){
            $ac = 1;
        }
        else{
            $ac = 0;
        }
        if($req->computer == "on"){
            $computer = 1;
        }
        else{
            $computer = 0;
        }
        if($req->podium == "on"){
            $podium = 1;
        }
        else{
            $podium =0;
        }
        if($req->mic == "on"){
            $mic = 1;
        }
        else{
            $mic = 0;
        }
        if($req->projector == "on"){
            $projector = 1;
        }
        else{
            $projector = 0;
        }
        $buildingid = $req->buildingname;
        $resourcename = $req->resourcename;
        $capacity = $req->capacity;
        $isallocate = $req->isAllocate;
        // echo $ac;
        // echo $computer;
        // echo $podium;
        // echo $mic;
        // echo $projector;
        // echo $buildingid;
        // echo $resourcename;
        // echo $capacity;
        // echo $isallocate;

        $temp = DB::table('tblfacility')->where('ac',$ac)->where('computers',$computer)->where('podium',$podium)->where('mic',$mic)->where('projector',$projector)->get('facilityid');
        $facilityid = $temp[0]->facilityid;
        
        DB::table('tblresource')->insert(["resourcename"=>$resourcename,"capacity"=>$capacity,"buildingid"=>$buildingid,"facilityid"=>$facilityid,"isAllocate"=>$isallocate]);
        return redirect('admin/resources');
    }
    function deleteResource($id){
        echo $id;
        DB::table('tblresource')->where('resource_id',$id)->delete();
        return redirect('admin/resources');
    }
    function updateResource(Request $req){
        $req->validate([
            "updt_resourcename"=>"bail|required",
            "updt_capacity"=>"bail|required|numeric"
        ]);
        if($req->updt_ac == "on"){
            $ac = 1;
        }
        else{
            $ac = 0;
        }
        if($req->updt_computer == "on"){
            $computer = 1;
        }
        else{
            $computer = 0;
        }
        if($req->updt_podium == "on"){
            $podium = 1;
        }
        else{
            $podium =0;
        }
        if($req->updt_mic == "on"){
            $mic = 1;
        }
        else{
            $mic = 0;
        }
        if($req->updt_projector == "on"){
            $projector = 1;
        }
        else{
            $projector = 0;
        }
        $buildingid = $req->updt_buildingname;
        $resourcename = $req->updt_resourcename;
        $capacity = $req->updt_capacity;
        $updt_id = $req->updt_id;
        $facilityid = $req->facility_id;
        $isAllocate = $req->updt_isAllocate;
        // echo $ac;
        // echo $computer;
        // echo $podium;
        // echo $mic;
        // echo $projector;
        //  die();
        // echo $buildingid;
        // echo $resourcename;
        // echo $capacity;
        // echo $updt_id;
        // DB::table('tblfacility')->where('facilityid',$facilityid)->update(['ac'=>$ac,'computer'=>$computer,'podium'=>$podium,"mic"=>$mic,"projector"=>$projector]);
        $temp = DB::table('tblfacility')->where('ac',$ac)->where('computers',$computer)->where('podium',$podium)->where('mic',$mic)->where('projector',$projector)->get('facilityid');
        $facilityid = $temp[0]->facilityid;
        // echo $facilityid;
        
        DB::table('tblresource')->where('resource_id',$updt_id)->update(["resourcename"=>$resourcename,"capacity"=>$capacity,"buildingid"=>$buildingid,"facilityid"=>$facilityid,"isAllocate"=>$isAllocate]);
        return redirect('admin/resources');

    }
    function fetchForUpdate($update_id){
        // echo $update_id;
        
        $tblresource = DB::table('tblresource')->where('resource_id',$update_id)->get();
        // print_r(json_encode($tblresource));
        $facilityId = $tblresource[0]->facilityid;
        $tblfacility = DB::table('tblfacility')->where('facilityid',$facilityId)->get();
        $buildingId = $tblresource[0]->buildingid;
        $tblbuilding = DB::table('tblbuilding')->where('buildingid',$buildingId)->get();
        // print_r(json_encode($tblfacility));



        // $ac = $tblfacility[0]->ac;
        // $computers = $tblfacility[0]->computers;
        // $podium = $tblfacility[0]->podium;
        // $mic = $tblfacility[0]->mic;
        // $projector = $tblfacility[0]->projector;
        
        $arr['tblresource'] = $tblresource;
        $arr['tblfacility'] = $tblfacility;
        $arr['tblbuilding'] = $tblbuilding;
        echo json_encode($arr);
        // echo json_encode($tblresource);
        // echo json_encode($tblfacility);
    }
    function user(){
        $data['users']=DB::table('tbluser')
            ->join('tbluser_type','tbluser.usertypeid','=','tbluser_type.usertypeid')
            ->select('tbluser.email','username','tbluser.phonenumber','tbluser_type.usertype','tbluser.is_active','tbluser.is_verified')
            ->orderBy('tbluser_type.usertypeid','asc')
            ->paginate(10);
        return view('admin/users',$data);
    }
    //INM 07-04-2019
    function showBySearchPattern(Request $req){
        $selpattern = $req->selpattern;
        $str = $req->str;
        if($selpattern==1)
            $str=$str.'%';
        elseif($selpattern==2)
            $str='%'.$str;
        elseif($selpattern==3)
            $str=$str;
        $res=DB::table("tbluser")
        ->join('tbluser_type','tbluser_type.usertypeid','=','tbluser.usertypeid')
            ->where('email','like',$str)
            ->orWhere('username','like',$str)
            ->select('email','username','phonenumber','tbluser_type.usertype','tbluser.is_active','tbluser.is_verified')
            ->orderBy('tbluser_type.usertypeid','asc')
            ->get();
            $data="";
            $counter=1;
            $active="Active";
            $inactive="In-active";
            foreach($res as $user)
            { 
                $data.='<tr><td>'.$counter++.'</td>
                <td>'.$user->email.'</td>
                <td>'.$user->username.'</td>
                <td>'.$user->usertype.'</td>
                <td>'.$user->phonenumber.'</td>';
                if ($user->is_verified==1){
                    $data.='<td>Yes</td>';
                }
                else{
                    $data.='<td>No</td>';
                }
                if ($user->is_active==1)
                    $data.='<td>'.$active.'</td>';
                else
                    $data.='<td>'.$inactive.'</td>';
                $data.='</tr>';
            }
        echo strval($data);
    }
    //INM 07-04-2019
    function multiplestudentstatusupdate(Request $req){
        $str = $req->str;
        $status=$req->status;
        $selpattern = $req->selpattern;
        $str = $req->str;
        if($selpattern==1)
            $str=$str.'%';
        elseif($selpattern==2)
            $str='%'.$str;
        elseif($selpattern==3)
            $str=$str;
        $status = $req->status;
        DB::table("tbluser")
            ->where('email','like',$str)->update(['is_active'=>$status]);

        //after update displaying data
        $res=DB::table("tbluser")
        ->join('tbluser_type','tbluser_type.usertypeid','=','tbluser.usertypeid')
            ->where('email','like',$str)
            ->orWhere('username','like',$str)
            ->select('email','username','phonenumber','tbluser_type.usertype','tbluser.is_active','tbluser.is_verified')
            ->orderBy('tbluser_type.usertypeid','asc')
            ->get();
            $data="";
            $counter=1;
            $active="Active";
            $inactive="In-active";
            foreach($res as $user)
            { 
                $data.='<tr><td>'.$counter++.'</td>
                <td>'.$user->email.'</td>
                <td>'.$user->username.'</td>
                <td>'.$user->usertype.'</td>
                <td>'.$user->phonenumber.'</td>';
                if ($user->is_verified==1){
                    $data.='<td>Yes</td>';
                }
                else{
                    $data.='<td>No</td>';
                }
                if ($user->is_active==1)
                    $data.='<td>'.$active.'</td>';
                else
                    $data.='<td>'.$inactive.'</td>';
                $data.='</tr>';
            }
        echo strval($data);   
    }
    //INM 07-04-2019
    function disableusers(){
        $data['users']=DB::table('tbluser')
                ->join('tbluser_type','tbluser.usertypeid','=','tbluser_type.usertypeid')
                ->select('tbluser.email','username','tbluser.phonenumber','tbluser_type.usertype','tbluser.is_active','tbluser.is_verified')
                ->orderBy('tbluser_type.usertypeid','asc')
                ->paginate(5);
        return view('admin/disableusers',$data);
    }

    function searchOnResources(Request $req){
        $str = $req->str;
        $resource=DB::table("tblresource")
        ->join('tblbuilding','tblbuilding.buildingid','=','tblresource.buildingid')
            ->where('buildingname','like','%'.$str.'%')
            ->orWhere('resourcename', 'like', '%'.$str.'%')
            ->orWhere('capacity', 'like', '%'.$str.'%')
            ->select('resource_id','resourcename','capacity','isAllocate')
            ->get();
            $data="";
            $counter=1;
            foreach($resource as $res)
            { 
                if($res->isAllocate == 1)
                    $isAllocate_msg = "Yes";
                elseif($res->isAllocate == 0)
                    $isAllocate_msg = "No";

                $data.='<tr><td>'.$res->resource_id.'</td>
                <td>'.$res->resourcename.'</td>
                <td>'.$res->capacity.'</td>
                <td>'.$isAllocate_msg.'</td>
                <td>'.'<a href="" onclick="updateHandler('.$res->resource_id.')" data-toggle="modal" data-target="#updateModal" class="badge badge-info">Update</a></td>
                <td>'.'<a href=\'url("admin/resourses/delete/{'.$res->resource_id.'}")}}\' class="badge badge-info">Delete</a></td>';
                $data.='</tr>';
            }
            echo strval($data);
    }            
    
    function userProfile(){
        $useremail="admin_booking@daiict.ac.in";
        $data['user']=DB::table('tbladmin')
        ->where('email',$useremail)
        ->first();
        return view('admin/profile',$data);
    }

    function updateProfile(Request $req){
        $req->validate([
            "txt_username"=>"bail|required",
            "txt_phoneno"=>"bail|required|size:10|regex:'^[6-9][0-9]+$'"
        ]);
        $useremail="admin_booking@daiict.ac.in";
        if($req->txt_password=='' || $req->txt_password==null){
            $data=DB::table('tbladmin')
            ->where('email', $useremail)
            ->update(['username'=>$req->txt_username,"phone"=>$req->txt_phoneno]);
        }
        else{
            $data=DB::table('tbladmin')
            ->where('email', $useremail)
            ->update(['username'=>$req->txt_username,"phone"=>$req->txt_phoneno,"password"=>md5($req->txt_password)]);
        }
        echo $data;
    }
    
    function faculty(){
        $typeid = DB::table('tbluser_type')->where('tbluser_type.usertype','faculty')->first()->usertypeid;
        
        $data['f_data'] = DB::table('tbluser')->where('tbluser.usertypeid',$typeid)->paginate(7);

        // session()->forget('error1');
        return view('admin/faculty_view',$data);
    }
    // INM 12-04-2019
    function Clubs_Committees(){
        // ->join('tblresource','tblresource.resource_id','=','tblbooking.resourceid')
        $data['sel_c_c'] = DB::table('tbluser_type')
            ->orWhere('tbluser_type.usertype','committee')
            ->orWhere('tbluser_type.usertype','club')
            ->select('tbluser_type.usertypeid','tbluser_type.usertype')
            ->get();

        $data['c_c'] = DB::table('tbluser')
            ->join('tbluser_type','tbluser_type.usertypeid','=','tbluser.usertypeid')
            ->orWhere('tbluser_type.usertype','committee')
            ->orWhere('tbluser_type.usertype','club')
            ->select('tbluser.email','username','tbluser.phonenumber','tbluser_type.usertype','tbluser.is_active','tbluser.is_verified')
            // ->orderBy('tbluser_type.usertypeid','asc')
            ->paginate(5);
        
        return view('admin/Clubs_Committees',$data);
    }
    // INM 12-04-2019 
    function insert_club_committee(Request $req)
    {
        $email = $req->email;
        $name = $req->name;
        $phone = $req->phone;
        $usertypeid = $req->selclubs_committees;
        $length = 8;

        $passcode=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        DB::table('tbluser')
            ->insert(['email'=>$email,'username'=>$name,'phonenumber'=>$phone,'usertypeid'=>$usertypeid,'password'=>md5($passcode),'is_verified'=>0,'is_active'=>0]);

        $length = 30;
        $activation_code=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        
        $link=$req->root().'/admin/AdminDashBoard/verify_club_committee/'.$email.'/'.$activation_code.'/'.$passcode;
        DB::table('tblverify_linkes')
            ->insert(['userid'=>$email,'link'=>$activation_code]);
        
        Mail::to($email)->send(new club_committee_verify($link,$passcode));

        return redirect('admin/Clubs_Committees')->with('error1','Club/Committee will be verified once they click on the link');
    }
    function add_faculty(Request $req)
    {
        $req->validate([
            "email"=>"bail|required|email",
            "name"=>"bail|required",
            "phone"=>"bail|required|size:10|regex:'^[6-9][0-9]+$'",
        ]);
        $email = $req->email;
        $name = $req->name;
        $phone = $req->phone;
        $length = 8;

        $passcode=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        $typeid = DB::table('tbluser_type')->where('tbluser_type.usertype','faculty')->first()->usertypeid;
        DB::table('tbluser')->insert(['email'=>$email,'username'=>$name,'phonenumber'=>$phone,'usertypeid'=>$typeid,'password'=>md5($passcode),'is_verified'=>0,'is_active'=>0]);

        $length = 30;
        $activation_code=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

        $link=$req->root().'/admin/AdminDashBoard/verify_faculty/'.$email.'/'.$activation_code.'/'.$passcode;
        DB::table('tblverify_linkes')->insert(['userid'=>$email,'link'=>$activation_code]);

         Mail::to($email)->send(new FacultyVerify($link,$passcode));
        
        return redirect('admin/faculty')->with('error1','Club/Committee will be verified once they click on the link');

    }
    // INM 13-04-2019
    function verify_club_committee($email,$code,$pass){
        $data = DB::table('tblverify_linkes')->where(['userid'=>$email,'link'=>$code])->first();
        if($data)
        {
            DB::table('tbluser')->where('email',$email)->update(['is_verified'=>1,'is_active'=>1]);
            DB::table('tblverify_linkes')->where(['userid'=>$email,'link'=>$code])->delete();
            session(['error1'=>'Please Login.']);
            return redirect('login');
        }
        else{
            return redirect('login')->with('error','Invalid Activation Link');
        }
    }
    function verify_faculty($email,$code,$pass){
        $data = DB::table('tblverify_linkes')->where(['userid'=>$email,'link'=>$code])->first();
        if($data)
        {
            DB::table('tbluser')->where('email',$email)->update(['is_verified'=>1,'is_active'=>1]);
            DB::table('tblverify_linkes')->where(['userid'=>$email,'link'=>$code])->delete();
            session(['error1'=>'Please Login.']);
            return redirect('login');
        }
        else{
            return redirect('login')->with('error','Invalid Activation Link');
        }
    }
    function showInquiry()
    {
        $data['inquiry']=DB::table('tblinquiry')->where(["replay"=>""])->paginate(10);
        $data["c"]=0;
        return view('admin/inquiry',$data);
    }
    function replayToInquirydata(Request $req)
    {
        $req->validate([
            "id"=>"bail|required",
            "txt_message"=>"bail|required"
        ]);
        $data=DB::table('tblinquiry')->where('id',$req->id)->update(['replay'=>$req->txt_message]);


        $data5= DB::table('tblinquiry')->where('id',$req->id)->first();
        Mail::to($data5->email)->send(new inquiry_mail($data5->message,$req->txt_message));

        echo $data;
    }
    function getinquiryreplaydata(Request $req)
    {
        $req->validate([
            "id"=>"bail|required"
        ]);
        $data=DB::table('tblinquiry')->where('id',$req->id)->first();
        echo $data->replay;
    }
}
