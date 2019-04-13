<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use DB;
class mailController extends Controller
{
    public function send(){
        Mail::send(['text'=>'mail'],['name','Vishal'],function($message){
            $message->to('vadaliyaalvis@gmail.com','to alvis')->subject('Test Email');
            $message->from('daiictbooking@gmail.com','from da');
        });
    }
    function addinquiry(Request $req)
    {
    	$req->validate([
    		"txt_ping_email"=>"bail|required|email",
    		"txt_message"=>"bail|required"
    	]);
    	$user =DB::table('tblinquiry')->insert(
            ['email' => $req->txt_ping_email, 
            'message' => $req->txt_message,
            'replay' => ""
            ]
        );
        echo $user;
    }
}