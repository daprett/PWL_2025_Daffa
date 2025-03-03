<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userName($Id,$name){
        return 'Id :  '.$Id .' name : '.$name;
    }
}
