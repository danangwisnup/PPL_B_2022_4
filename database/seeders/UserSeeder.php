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
            'nim/nip' => '1234567890',
            'nama' => 'Operator IF',
            'email' => 'op@if.com',
            'password' => Hash::make('admin'),
            'role' => 'operator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
