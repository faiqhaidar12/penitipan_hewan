<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siswa')->insert([
            'nama' => 'ana',
            'nim' => '12123',
            'alamat' => 'kulonprogo',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('siswa')->insert([
            'nama' => 'haidar',
            'nim' => '12321',
            'alamat' => 'kulonprogo',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('siswa')->insert([
            'nama' => 'susi',
            'nim' => '22122',
            'alamat' => 'yogyakarta',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
