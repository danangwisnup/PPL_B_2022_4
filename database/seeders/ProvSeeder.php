<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Api Provinsi
        $url = 'http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
        $data = json_decode(file_get_contents($url), true);

        // Insert ke database
        foreach ($data as $d) {
            DB::table('tb_provinsi')->insert([
                'kode_prov' => $d['id'],
                'nama_prov' => $d['name'],
            ]);
        }
    }
}
