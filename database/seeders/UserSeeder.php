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
                'nim_nip' => 'H.1.289103252009131011',
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
            ],
            [
                'nim_nip' => '24060120140160',
                'nama' => 'Danang Wisnu Prayoga ✨',
                'email' => 'danang@if.com',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim_nip' => '24060120120013',
                'nama' => 'Zhuliana Melva Rey ✨',
                'email' => 'zhuliana@if.com',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim_nip' => '24060120120001',
                'nama' => 'Rijal Kurniawan ✨',
                'email' => 'rijal@if.com',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim_nip' => '24060120140151',
                'nama' => 'Annas Bachtiar ✨',
                'email' => 'annas@if.com',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim_nip' => '24060120120016',
                'nama' => 'Agung Ramadhani ✨',
                'email' => 'agung@if.com',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim_nip' => '24060120130121',
                'nama' => 'Farrel Samuel Nicholas ✨',
                'email' => 'farrel@if.com',
                'password' => Hash::make('123'),
                'role' => 'mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('tb_mahasiswas')->insert([
            [
                'nim' => '24060120120120',
                'nama' => 'Mahasiswa 20',
                'email' => 'mahasiswa20@if.com',
                'jalur_masuk' => 'SNMPTN',
                'angkatan' => '2020',
                'status' => 'Aktif',
            ],
            [
                'nim' => '24060120140160',
                'nama' => 'Danang Wisnu Prayoga ✨',
                'email' => 'danang@if.com',
                'jalur_masuk' => 'Ujian Mandiri',
                'angkatan' => '2020',
                'status' => 'Aktif',
            ],
            [
                'nim' => '24060120120013',
                'nama' => 'Zhuliana Melva Rey ✨',
                'email' => 'zhuliana@if.com',
                'jalur_masuk' => 'SNMPTN',
                'angkatan' => '2020',
                'status' => 'Aktif',
            ],
            [
                'nim' => '24060120120001',
                'nama' => 'Rijal Kurniawan ✨',
                'email' => 'rijal@if.com',
                'jalur_masuk' => 'SNMPTN',
                'angkatan' => '2020',
                'status' => 'Aktif',
            ],
            [
                'nim' => '24060120140151',
                'nama' => 'Annas Bachtiar ✨',
                'email' => 'annas@if.com',
                'jalur_masuk' => 'Ujian Mandiri',
                'angkatan' => '2020',
                'status' => 'Aktif',
            ],
            [
                'nim' => '24060120120016',
                'nama' => 'Agung Ramadhani ✨',
                'email' => 'agung@if.com',
                'jalur_masuk' => 'SNMPTN',
                'angkatan' => '2020',
                'status' => 'Aktif',
            ],
            [
                'nim' => '24060120130121',
                'nama' => 'Farrel Samuel Nicholas ✨',
                'email' => 'farrel@if.com',
                'jalur_masuk' => 'SBMPTN',
                'angkatan' => '2020',
                'status' => 'Aktif',
            ]
        ]);

        DB::table('tb_dosens')->insert(
            [
                'nip' => 'H.1.289103252009131011',
                'nama' => 'Dosen if',
                'email' => 'dosen@if.com',
                'status' => 'Aktif',
            ]
        );
    }
}
