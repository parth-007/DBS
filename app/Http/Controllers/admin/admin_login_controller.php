<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class admin_login_controller extends Controller
{
	function __construct()
    {
        $this->middleware('Backend');
    }
    function index(){
    	return view('admin/admin_login');
    }
     function logout()
    {
    	session()->forget('admin_email');
        session()->forget('error1');
    	return redirect('admin/login');
    }
}
