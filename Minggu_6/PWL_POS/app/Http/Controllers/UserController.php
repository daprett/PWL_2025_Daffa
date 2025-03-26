<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Mockery\Matcher\HasKey;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{

    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object)[
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user'; // set menu yang sedang aktif
        $level = LevelModel::all();// ambil data level untuk filter data 

        return view('user.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'level' => $level, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables public function list(Request $request)
  // Ambil data user dalam bentuk JSON untuk DataTables
public function list(Request $request) {
    $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
        ->with('level');

    // Filter data user berdasarkan level_id
    if ($request->level_id) {
        $users->where('level_id', $request->level_id);
    }

    return DataTables::of($users)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addColumn('aksi', function ($user) { // menambahkan kolom aksi
            $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/user/' . $user->user_id).'">';
            $btn .= csrf_field() . method_field("DELETE");
            $btn .= '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\')">Hapus</button>';
            $btn .= '</form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah HTML
        ->make(true);
}

    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah user baru'
        ];

        $level = LevelModel::all();//ambil data level untuk ditampilkan di form 
        $activeMenu = 'user';

        return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer',
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => bcrypt($request->password),// enkripsi pass
            'level_id' => $request->level_id,
        ]);

        return redirect('/user')->with('Success', 'Data berhasil disimpan');
    }

    public function show(string $id){
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail user'
        ];

        $activeMenu = 'user';

        return view('user.show',['user' => $user, 'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit'],
        ];

        $page = (object)[
            'title' => 'Edit user'
        ];

        $activeMenu = 'user';

        return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,'.$id.',user_id',
            'nama'     => 'required|string|max:100',
            'password' => 'required|min:5',
            'level_id' => 'required|integer'
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id,
        ]);

        return redirect('/user')->with('success',' Data berhasil diubah');
    }

    public function destroy(string $id){
        $check = UserModel::find($id);

        if (!$check) { // cek data ada atau tidak
            return redirect('/user')->with('error','data tidak ditemukan');
        }

        try{
            UserModel::destroy($id);// hapus data level
            return redirect('/user')->with('success','Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect('/user')->with('error', 'Data user gagal dihapus karena terdapat tabel lain yang masih terkait dengan data ini');
        }
    }
    // public function index(){

    //     $user = UserModel::with('level')->get();
    //     return view('user',['data'=> $user]);

    //     // $user = UserModel::with('level')->get();
    //     // dd($user);

    //     // $user = UserModel::all();
    //     // return view('user', ['data' => $user]); 
    //     // // Kirim ke tampilan



    //     // $user = UserModel::firstwhere('level_id',1);
    //             // $data = [
    //     //     'level_id' => '2',
    //     //     'username' => 'manager_tiga',
    //     //     'nama' => 'Manager 3',
    //     //     'password' => Hash::make('12345')
    //     // ];


    //     // UserModel::create($data);

    //       // $user = UserModel::findOr(20, ['username','nama'], function(){
    //     //     abort(404);
    //     // });

    //      // $user = UserModel::where('username','manager9')->firstOrFail();

    //     //  $user = UserModel::where('level_id', 2)->count(); Hitung jumlah user

    //             // $user = UserModel::firstOrCreate([// otomatis menambah data yang tidak ada 
    //     //     'username' => 'manager22',
    //     //     'nama' => 'Manager Dua Dua',
    //     //     'password' => Hash::make('12345'),
    //     //     'level_id' => '2'
    //     // ],);

    //     // $user = UserModel::firstOrNew([//harus melakukan save untuk menambah data yang tidak ada 
    //     //     'username' => 'manager33',
    //     //     'nama' => 'Manager Tiga Tiga',
    //     //     'password' => Hash::make('12345'),
    //     //     'level_id' => '2'
    //     // ],);
    //     // $user->save();

    //             // $user = UserModel::firstOrCreate([
    //     //     'username' => 'manager55',
    //     //     'nama' => 'Manager55',
    //     //     'password' => Hash::make('12345'),
    //     //     'level_id' => '2'
    //     // ],);

    //     // $user->username = 'manager56';
    //     // $user->isDirty();
    //     // $user->isDirty('username');
    //     // $user->isDirty('nama');
    //     // $user->isDirty(['nama','username']);

    //     // $user->isClean();
    //     // $user->isClean('username');
    //     // $user->isClean('nama');
    //     // $user->isClean(['nama','username']);

    //     // $user->save();

    //     // $user->isDirty();
    //     // $user->isClean();

    //     // dd($user->isDirty());

    //             // $user = UserModel::create([
    //     //     'username' => 'manager11',
    //     //     'nama' => 'Manager11',
    //     //     'password' => Hash::make('12345'),
    //     //     'level_id' => '2'
    //     // ]);

    //     // $user->username = 'manager12';
    //     // $user->save();

    //     // $user->wasChanged();
    //     // $user->wasChanged('username');
    //     // $user->wasChanged('username','level_id');
    //     // $user->wasChanged('nama');
    //     // dd($user->wasChanged('nama','username'));


    //     // return view('user', ['data'=>$user]);
    // }

    // public function tambah(){
    //     return view('user_tambah');
    // }

    // public function tambah_simpan(Request $request){
    //     UserModel::create([
    //         'username' => $request->username,
    //         'nama' => $request->nama,
    //         'password' => Hash::make('$request->password'),
    //         'level_id' => $request->level_id
    //     ]);

    //     return redirect('/user');
    // }

    // public function ubah($id){
    //     $user = UserModel::find($id);
    //     return view('user_ubah', ['data' => $user]);
    // }

    // public function ubah_simpan($id, Request $request){
    //     $user = UserModel::find($id);

    //     $user->username = $request->username;
    //     $user->nama = $request->nama;
    //     $user->password = Hash::make('$request->password');
    //     $user->level_id = $request->level_id;

    //     $user->save();

    //     return redirect('/user');
    // }

    // public function hapus($id){
    //     $user = UserModel::find($id);
    //     $user->delete();

    //     return redirect('/user');
    // }

}
