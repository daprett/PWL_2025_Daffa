<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index(){
        $breadscrumb = (object)[
            'title' => 'Profil Pengguna',
            'list'  => ['Home', 'Profile'],
        ];

        $activeMenu = 'dashboard';

        // Ambil user yang sedang login
        $user = Auth::user();

        return view('welcome', [ 'breadcrumb' => $breadscrumb, 'activeMenu' => $activeMenu,'user' => $user ]);
    }
}
