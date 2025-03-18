<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barang = [
            ['kategori_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'Sepeda Fixie', 'harga_beli' => 1500000, 'harga_jual' => 1800000],
            ['kategori_id' => 1, 'barang_kode' => 'B002', 'barang_nama' => 'Dumbbell 10kg', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['kategori_id' => 2, 'barang_kode' => 'B003', 'barang_nama' => 'Smart TV 40 Inch', 'harga_beli' => 4000000, 'harga_jual' => 4500000],
            ['kategori_id' => 2, 'barang_kode' => 'B004', 'barang_nama' => 'Kipas Angin', 'harga_beli' => 300000, 'harga_jual' => 350000],
            ['kategori_id' => 3, 'barang_kode' => 'B005', 'barang_nama' => 'Bor Listrik', 'harga_beli' => 500000, 'harga_jual' => 600000],
            ['kategori_id' => 3, 'barang_kode' => 'B006', 'barang_nama' => 'Tang Kombinasi', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['kategori_id' => 4, 'barang_kode' => 'B007', 'barang_nama' => 'Jaket Hoodie', 'harga_beli' => 120000, 'harga_jual' => 150000],
            ['kategori_id' => 4, 'barang_kode' => 'B008', 'barang_nama' => 'Celana Jeans', 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['kategori_id' => 5, 'barang_kode' => 'B009', 'barang_nama' => 'Meja Kerja', 'harga_beli' => 800000, 'harga_jual' => 1000000],
            ['kategori_id' => 5, 'barang_kode' => 'B010', 'barang_nama' => 'Rak Buku Kayu', 'harga_beli' => 500000, 'harga_jual' => 650000],
        ];
        DB::table('m_barang')->insert($barang);
    }
}
