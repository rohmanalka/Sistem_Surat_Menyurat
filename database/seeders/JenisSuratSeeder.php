<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Surat Cuti'],
            ['nama' => 'Surat Izin'],
            ['nama' => 'Surat Tugas'],
        ];

        DB::table('jenis_surat')->insert($data);
    }
}
