<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nim_nip' => '123',
                'nama' => 'Operator IF',
                'email' => 'op@if.com',
                'password' => Hash::make('123'),
                'role' => 'operator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim_nip' => '24060120120120',
                'nama' => 'Mahasiswa 20',
                'email' => 'mahasiswa20@if.com',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim_nip' => 'H.1.299112052022042000',
                'nama' => 'Dosen If',
                'email' => 'dosen@if.com',
                'password' => Hash::make('123'),
                'role' => 'dosen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim_nip' => '24060',
                'nama' => 'Department If',
                'email' => 'department@if.com',
                'password' => Hash::make('123'),
                'role' => 'department',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('tb_mahasiswa')->insert(
            [
                'nim' => '24060120120120',
                'nama' => 'Mahasiswa 20',
                'email' => 'mahasiswa20@if.com',
                'jalur_masuk' => 'SNMPTN',
                'angkatan' => '2020',
                'status' => 'Aktif',
            ]
        );

        DB::table('tb_dosen')->insert(
            [
                'nip' => 'H.1.299112052022042000',
                'nama' => 'Dosen if',
                'email' => 'dosen@if.com',
                'status' => 'Aktif',
            ]
        );
    }
}
