<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\KategoriDataTable;

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
}
