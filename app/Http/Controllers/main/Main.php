<?php

namespace App\Http\Controllers\main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Main extends Controller
{
    //
    function index(){
        return view('mainpage/home');
    }
    function login(){
        return view('mainpage/login');
    }
    function inspect(){
        return view('mainpage/inspect');
    }
}
