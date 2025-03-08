<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Matcher\HasKey;

class UserController extends Controller
{
    
    public function index(){
      
        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => '2'
        ]);

        $user->username = 'manager12';
        $user->save();

        $user->wasChanged();
        $user->wasChanged('username');
        $user->wasChanged('username','level_id');
        $user->wasChanged('nama');
        dd($user->wasChanged('nama','username'));

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

                // $user = UserModel::firstOrCreate([// otomatis menambah data yang tidak ada 
        //     'username' => 'manager22',
        //     'nama' => 'Manager Dua Dua',
        //     'password' => Hash::make('12345'),
        //     'level_id' => '2'
        // ],);

        // $user = UserModel::firstOrNew([//harus melakukan save untuk menambah data yang tidak ada 
        //     'username' => 'manager33',
        //     'nama' => 'Manager Tiga Tiga',
        //     'password' => Hash::make('12345'),
        //     'level_id' => '2'
        // ],);
        // $user->save();

                // $user = UserModel::firstOrCreate([
        //     'username' => 'manager55',
        //     'nama' => 'Manager55',
        //     'password' => Hash::make('12345'),
        //     'level_id' => '2'
        // ],);

        // $user->username = 'manager56';
        // $user->isDirty();
        // $user->isDirty('username');
        // $user->isDirty('nama');
        // $user->isDirty(['nama','username']);

        // $user->isClean();
        // $user->isClean('username');
        // $user->isClean('nama');
        // $user->isClean(['nama','username']);

        // $user->save();

        // $user->isDirty();
        // $user->isClean();

        // dd($user->isDirty());

        // $user = UserModel::all();
        // return view('user', ['data'=>$user]);
    }
}
