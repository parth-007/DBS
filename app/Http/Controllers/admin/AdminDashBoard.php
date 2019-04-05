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
        return view('admin/building');
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
        if($req->podium = "on"){
            $podium = 1;
        }
        else{
            $podium =0;
        }
        if($req->mic = "on"){
            $mic = 1;
        }
        else{
            $mic = 0;
        }
        if($req->projector = "on"){
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

        $temp = DB::table('tblfacility')->where('ac',$ac)->where('computers',$computer)->where('podium',$podium)->where('mike',$mic)->where('projector',$projector)->get('facilityid');
        $facilityid = $temp[0]->facilityid;
        
        DB::table('tblresource')->insert(["resourcename"=>$resourcename,"capacity"=>$capacity,"buildingid"=>$buildingid,"facilityid"=>$facilityid,"isAllocate"=>$isallocate]);
        return redirect('admin/resources');
    }
    function deleteResource($id){
        echo $id;
        DB::table('tblresource')->where('resource_id',$id)->delete();
        return redirect('admin/resources');
    }
    function updateResource($id){
        echo $id;
    }
    function user(){
        return view('admin/user');
    }
    
}
