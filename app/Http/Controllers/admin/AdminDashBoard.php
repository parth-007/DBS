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
        // echo $req->isAllocate;
        // die;
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
        $data['users']=DB::table('tbluser')->join('tbluser_type','tbluser.usertypeid','=','tbluser_type.usertypeid')->select('tbluser.email','tbluser.phonenumber','tbluser_type.usertype','tbluser.is_active')->get();
        return view('admin/users',$data);
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
    
}
