<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stok = [];
        for ($i = 1; $i <= 10; $i++) {
            $stok[] = [
                'barang_id' => $i,
                'user_id' => 1, 
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => rand(10, 100)
            ];
        }

        DB::table('t_stok')->insert($stok);
    }
}
