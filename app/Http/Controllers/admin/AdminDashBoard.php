<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashBoard extends Controller
{
    function index(){
    	return view('admin/dashboard');
    }
}
