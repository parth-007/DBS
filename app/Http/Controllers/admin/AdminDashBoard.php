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
        return view('admin/resource');
    }
    function user(){
        $data['users']=DB::table('tbluser')->join('tbluser_type','tbluser.usertypeid','=','tbluser_type.usertypeid')->select('tbluser.email','tbluser.phonenumber','tbluser_type.usertype','tbluser.is_active')->get();
        return view('admin/users',$data);
    }
}
