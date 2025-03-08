<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Matcher\HasKey;

class UserController extends Controller
{
    
    public function index(){
      
        // $user = UserModel::firstOrCreate([// otomatis menambah data yang tidak ada 
        //     'username' => 'manager22',
        //     'nama' => 'Manager Dua Dua',
        //     'password' => Hash::make('12345'),
        //     'level_id' => '2'
        // ],);

        $user = UserModel::firstOrNew([//harus melakukan save untuk menambah data yang tidak ada 
            'username' => 'manager33',
            'nama' => 'Manager Tiga Tiga',
            'password' => Hash::make('12345'),
            'level_id' => '2'
        ],);
        $user->save();

        return view('user', ['data' => $user]); // Kirim ke tampilan
     
        

        // $user = UserModel::firstwhere('level_id',1);
                // $data = [
        //     'level_id' => '2',
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];


        // UserModel::create($data);

          // $user = UserModel::findOr(20, ['username','nama'], function(){
        //     abort(404);
        // });

         // $user = UserModel::where('username','manager9')->firstOrFail();

        //  $user = UserModel::where('level_id', 2)->count(); Hitung jumlah user

        // $user = UserModel::all();
        // return view('user', ['data'=>$user]);
    }
}
