<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    //
    protected $table = 'tblbooking';
    protected  $fileable  = ['bookingid','useremail'];
}