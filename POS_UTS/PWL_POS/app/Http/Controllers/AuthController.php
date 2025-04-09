<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login, redirect ke halaman home
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/'),
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal',
            ]);
        }

        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    public function register(){
        $level = LevelModel::select('level_id','level_nama')->get();

        return View('auth.register')
        ->with('level', $level);
    }

    public function store_user(Request $request){
        $request->validate([
            'level_id' => 'required|integer|exists:m_level,level_id',
            'username' => 'required|string|min:3|max:20|unique:m_user,username',
            'nama'     => 'required|string|max:100',
            'gender'   => 'required|in:L,P',
            'nohp'     => 'required|string|max:15',
            'email'    => 'nullable|email|max:100',
            'password' => 'required|min:6',
        ]);

        UserModel::create([
            'level_id' => $request->level_id,
            'username' => $request->username,
            'nama'     => $request->nama,
            'gender'   => $request->gender,
            'nohp'     => $request->nohp,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        
        return redirect('/')->with('success ',' Registrasi berhasil');
    }
}
