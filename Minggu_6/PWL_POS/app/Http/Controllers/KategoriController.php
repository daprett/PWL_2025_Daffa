<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;

use function Termwind\render;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable){

        return $dataTable->render('kategori.index');


        // $data = [
        //     [
        //         'kategori_kode' => 'CML',
        //         'kategori_nama' => 'Cemilan',
        //         'created_at' => now()
        //     ],
        //     [
        //         'kategori_kode' => 'MNR',
        //         'kategori_nama' => 'Minuman Ringan',
        //         'created_at' => now()
        //     ]
        // ];
        
        // DB::table('m_kategori')->insert($data);
        // return 'Insert data baru berhasil';
        

        // DB::table('m_kategori')->insert($data);
        // return 'Insert data baru berhasil';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
        // return 'update data berhasil. Jumlah data yang di update :'.$row.' baris';

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        // return 'Delete berhasil. Jumlah data yang di hapus '.$row.' Baris';

        // $data = DB::table('m_kategori')->get();
        // return view('kategori', ['data'=>$data]);
    }



    public function create(){
        return view('kategori.create');
    }
//create
    public function store(Request $request){
        KategoriModel::create([        
        'kategori_kode'=> $request->kodeKategori,
        'kategori_nama'=> $request->namaKategori,

        ]);
        return redirect('/kategori');
    }


//tugas 
//menampilkan manage.blade


//update
public function update(Request $request, $id)
{
    KategoriModel::where('kategori_id', $id)->update([
        'kategori_kode' => $request->kodeKategori,
        'kategori_nama' => $request->namaKategori,
        
    ]);
    return redirect('/kategori');
}


public function edit($id)
{
    $data = KategoriModel::find($id);
    return view('kategori.edit', ['kategori' => $data]);
}

public function delete($id)
{
    KategoriModel::where('kategori_id', $id)->delete();
    return redirect('/kategori');
}


}
