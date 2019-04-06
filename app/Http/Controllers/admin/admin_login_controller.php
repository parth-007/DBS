<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class admin_login_controller extends Controller
{
    function index(){
    	return view('admin/admin_login');
    }
}
