<?php

namespace App\Http\Controllers\client;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Mail_Controller extends Controller 
{
   function basic_email() {
      $data = array('name'=>"Virat Gandhi");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('vaidyavishal39@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('daiictbooking@gmail.com','Virat Gandhi');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
}