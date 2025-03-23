<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $breadscrumb = (object)[
            'title' => 'Selamat Datang',
            'list'  => ['Home', 'Welcome'],
        ];

        $activeMenu = 'dashboard';

        return view('welcome', ['breadcrumb' => $breadscrumb, 'activeMenu' => $activeMenu]);
    }
}
