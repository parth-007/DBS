<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientDashboard extends Controller
{
    function index(){
    	return view('client/dashboard');
    }
}
