<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\FacultyVerify;
use DB;
use Mail;

class AdminDashBoard extends Controller
{

    function __construct(){
        $this->middleware('CheckisAdmin');
        $this->middleware('Backend');
        
    }
    function index(){

    	return view('admin/dashboard');
    }
    function building(){
        $data['buildings']=DB::table('tblbuilding')->get();
        return view('admin/building',$data);
    }
    public function insert(Request $req){
        if($req->aid){
            $a = $req->buildingname;
            DB::table("tblbuilding")->where('buildingid',$req->aid)->update(['buildingname'=>$a]);
        }
        else{
            $a = $req->buildingname;
            DB::table('tblbuilding')->insert(['buildingname'=>$a]);
        }
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
        if($status==1)
            $status=0;
        else    
            $status=1;    
        $up=DB::table("tbluser")->where('email',$email)->update(['is_active'=>$status]);
        echo $up;
    }
    function resource(){
        
        $data['resource'] = DB::table("tblresource")->paginate(10);
        $data['buildings']=DB::table('tblbuilding')->get();
        return view('admin/resource',$data);
    }
    function insertResource(Request $req){
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
        $isallocate = 0;
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

       
        $temp = DB::table('tblfacility')->where('ac',$ac)->where('computers',$computer)->where('podium',$podium)->where('mic',$mic)->where('projector',$projector)->get('facilityid');
        $facilityid = $temp[0]->facilityid;
        // echo $facilityid;
        
        DB::table('tblresource')->where('resource_id',$updt_id)->update(["resourcename"=>$resourcename,"capacity"=>$capacity,"buildingid"=>$buildingid,"facilityid"=>$facilityid]);
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
        $data['users']=DB::table('tbluser')->join('tbluser_type','tbluser.usertypeid','=','tbluser_type.usertypeid')->select('tbluser.email','tbluser.phonenumber','tbluser_type.usertype','tbluser.is_active')->get();
        return view('admin/users',$data);
    }
    function faculty(){
        $typeid = DB::table('tbluser_type')->where('tbluser_type.usertype','faculty')->first()->usertypeid;
        
        $data['f_data'] = DB::table('tbluser')->where('tbluser.usertypeid',$typeid)->where('is_verified',1)->get();

        
        return view('admin/faculty_view',$data);
    }
    function add_faculty(Request $req)
    {
        $email = $req->email;
        $name = $req->name;
        $phone = $req->phone;
        $length = 8;

        $passcode=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);



        $typeid = DB::table('tbluser_type')->where('tbluser_type.usertype','faculty')->first()->usertypeid;
        DB::table('tbluser')->insert(['email'=>$email,'username'=>$name,'phonenumber'=>$phone,'usertypeid'=>$typeid,'password'=>$passcode,'is_verified'=>0,'is_active'=>0]);

        $length = 30;
        $activation_code=substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);

         $link=$req->root().'/admin/AdminDashBoard/verify_faculty/'.$email.'/'.$activation_code.'/'.$passcode;
        DB::table('tblverify_linkes')->insert(['userid'=>$email,'link'=>$activation_code]);

         Mail::to($email)->send(new FacultyVerify($link,$passcode));
        
        return redirect('admin/faculty');

    }
    function verify_faculty($email,$code,$pass){
        $data = DB::table('tblverify_linkes')->where(['userid'=>$email,'link'=>$code])->first();
        if($data)
        {
            DB::table('tbluser')->where('email',$email)->update(['is_verified'=>1,'is_active'=>1]);
            DB::table('tblverify_linkes')->where(['userid'=>$email,'link'=>$code])->delete();
            return redirect('login');
        }
        else{
            return redirect('login')->with('error','Invalid Activation Link');
        }
    }
}
