<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori =[
            ['kategori_kode' => 'SPORT', 'kategori_nama' => 'Peralatan Olahraga'],
            ['kategori_kode' => 'ELEC', 'kategori_nama' => 'Elektronik'],
            ['kategori_kode' => 'TOOL', 'kategori_nama' => 'Perkakas'],
            ['kategori_kode' => 'CLOTH', 'kategori_nama' => 'Pakaian'],
            ['kategori_kode' => 'FURN', 'kategori_nama' => 'Furniture'],
        ];

        DB::table('m_kategori')->insert($kategori);
        
    }
}
