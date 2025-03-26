<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
        public function index()
        {
            $breadcrumb = (object)[
                'title' => 'Daftar Level',
                'list' => ['Home', 'Level']
            ];
    
            $page = (object)[
                'title' => 'Daftar Level yang terdaftar dalam sistem'
            ];
    
            $activeMenu = 'level'; // set menu yang sedang aktif
    
            return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'activeMenu' => $activeMenu]);
    }

    public function list(Request $request) {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');
    
        return DataTables::of($levels)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/level/' . $level->level_id).'">';
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
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level';

        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request){
        $request->validate([
            'level_kode'=> 'required|string|unique:m_level',
            'level_nama'=> 'required|min:5',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,// enkripsi pass
        ]);

        return redirect('/level')->with('Success', 'Data bDerhasil disimpan');
    }

    public function show(string $id){
        $user = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail level'
        ];

        $activeMenu = 'user';

        return view('level.show',['user' => $user, 'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $user = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit'],
        ];

        $page = (object)[
            'title' => 'Edit level'
        ];

        $activeMenu = 'level';

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'level_kode'=> 'required|string',
            'level_nama'=> 'required|min:5',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('Success', 'Data berhasil disimpan');
    }

    public function destroy(string $id){
        $check = LevelModel::find($id);

        if (!$check) { // cek data ada atau tidak
            return redirect('/level')->with('error','data tidak ditemukan');
        }

        try{
            LevelModel::destroy($id);// hapus data level
            return redirect('/level')->with('success','Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect('/level')->with('error', 'Data user gagal dihapus karena terdapat tabel lain yang masih terkait dengan data ini');
        }
    }
    // public function index(){
    //     // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?,?,?)', ['CUS', 'Pelanggan', now()]);
    //     // return 'Insert data baru berhasil';

    //     // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
    //     // return 'Update data berhasil. Jumlah data yang diupdate'. $row .' Baris';

    //     // $row = DB::delete('delete from m_level where level_kode = ?',['CUS']);
    //     // return 'Delete data berhasil. Jumlah data yang dihapus '.$row.' Baris';

    //     // $data = DB::select('select * from m_level');
    //     // return view('level', ['data' => $data]);
    // }
}
