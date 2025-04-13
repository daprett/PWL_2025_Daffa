<?php

namespace App\Http\Controllers;

use App\Models\UserLogModel;

class UserLogController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Histori',
            'list' => ['Home', 'Histori']
        ];

        $page = (object)[
            'title' => 'Histori Riwayat Pengguna'
        ];

        $activeMenu = 'userlog'; // set menu yang sedang aktif
        $logs = UserLogModel::with('user')->oldest('performed_at')->paginate(20);
        return view('userlogs.index', ['logs'=>$logs, 'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
}
