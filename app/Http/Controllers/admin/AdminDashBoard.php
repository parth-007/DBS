<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AdminDashBoard extends Controller
{
    function index(){
    	return view('admin/dashboard');
    }
}
