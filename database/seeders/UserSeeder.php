<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Pejabat 1',
                'email' => 'pejabat1@pejabat.com',
                'password' => Hash::make('pejabat1'),
                'role' => 'pejabat',
            ],
            [
                'name' => 'Pegawai 1',
                'email' => 'pegawai1@pegawai.com',
                'password' => Hash::make('pegawai1'),
                'role' => 'pegawai',
            ]
        ];

        DB::table('users')->insert($data);
    }
}
