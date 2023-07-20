<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelanggan')->insert([
            'nama_pelanggan' => 'desi',
            'alamat' => 'bantul',
            'telepon' => 2222,
            'email' => 'desi@gmail.com',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('pelanggan')->insert([
            'nama_pelanggan' => 'asep',
            'alamat' => 'jogja',
            'telepon' => 22113,
            'email' => 'asep@gmail.com',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('pelanggan')->insert([
            'nama_pelanggan' => 'karai',
            'alamat' => 'jogja',
            'telepon' => 23331,
            'email' => 'karai@gmail.com',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
