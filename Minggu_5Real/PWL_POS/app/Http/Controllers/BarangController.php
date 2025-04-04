<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object)[
            'title' => 'Daftar Barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';


        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request){
            $barangs = BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama','harga_beli','harga_jual')
                ->with('kategori');
        
            return DataTables::of($barangs)
                ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
                ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                    $btn = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> ';
                    $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                    $btn .= '<form class="d-inline-block" method="POST" action="'.url('/barang/' . $barang->barang_id).'">';
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
                'title' => 'Tambah Barang',
                'list' => ['Home', 'Barang', 'Tambah']
            ];
    
            $page = (object)[
                'title' => 'Tambah barang baru'
            ];
    
            $kategori = KategoriModel::all();//ambil data level untuk ditampilkan di form 
            $activeMenu = 'barang';
    
            return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }
    public function store(Request $request){
        $request->validate([
            'barang_kode'=> 'required|string|max:100',
            'barang_nama'=> 'required|min:5',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id'=> 'required|integer',
        ]);

        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli'  => $request->harga_beli,
            'harga_jual'  => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect('/barang')->with('success', 'Data berhasil disimpan');
    }
    public function show(string $id){
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show',['barang' => $barang, 'breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }
    public function edit(string $id){
        $barang = BarangModel::find($id);
        $kategori = KategoriModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit'],
        ];

        $page = (object)[
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang';

        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }
    public function update(Request $request, string $id){
        $request->validate([
            'barang_kode'=> 'required|string|max:100',
            'barang_nama'=> 'required|min:5',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id'=> 'required|integer',
        ]);

        BarangModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli'  => $request->harga_beli,
            'harga_jual'  => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect('/barang')->with('success', 'Data berhasil disimpan');
    }
    public function destroy(string $id){
        $check = BarangModel::find($id);

        if (!$check) { // cek data ada atau tidak
            return redirect('/barang')->with('error','data tidak ditemukan');
        }

        try{
            BarangModel::destroy($id);// hapus data level
            return redirect('/barang')->with('success','Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena terdapat tabel lain yang masih terkait dengan data ini');
        }
    }
}
