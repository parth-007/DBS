<?php

namespace App\Http\Controllers\client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Respond_Request extends Controller
{
	function __construct()
    {
        $this->middleware('Backend');
    }
    function index(){
    	return view('client/res_to_req');
    }
}