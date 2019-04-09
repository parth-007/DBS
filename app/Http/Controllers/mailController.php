<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
class mailController extends Controller
{
    public function send(){
        Mail::send(['text'=>'mail'],['name','Vishal'],function($message){
            $message->to('vadaliyaalvis@gmail.com','to alvis')->subject('Test Email');
            $message->from('daiictbooking@gmail.com','from da');
        });
    }
}