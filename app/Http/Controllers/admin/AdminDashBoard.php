<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AdminDashBoard extends Controller
{
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
    
    function resource(){
        
        $data['resource'] = DB::table("tblresource")->paginate(20);
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
        $data['users']=DB::table('tbluser')
            ->join('tbluser_type','tbluser.usertypeid','=','tbluser_type.usertypeid')
            ->select('tbluser.email','username','tbluser.phonenumber','tbluser_type.usertype','tbluser.is_active','tbluser.is_verified')
            ->orderBy('tbluser_type.usertypeid','asc')
            ->paginate(5);
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
}
