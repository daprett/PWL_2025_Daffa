<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Matcher\HasKey;

class UserController extends Controller
{
    
    public function index(){
        $user = UserModel::findOr(20, ['username','nama'], function(){
            abort(404);
        });
       
        return view('user', ['data' => $user]);

        // $user = UserModel::firstwhere('level_id',1);
                // $data = [
        //     'level_id' => '2',
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];


        // UserModel::create($data);

        // $user = UserModel::all();
        // return view('user', ['data'=>$user]);
    }
}
