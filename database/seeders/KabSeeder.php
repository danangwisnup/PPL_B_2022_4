<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Api Provinsi get id
        $urlProv = 'http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';
        $dataProv = json_decode(file_get_contents($urlProv), true);
        foreach ($dataProv as $d) {
            $idProv = $d['id'];
            // Api Kabupaten
            $urlKab = 'http://www.emsifa.com/api-wilayah-indonesia/api/regencies/' . $idProv . '.json';
            $dataKab = json_decode(file_get_contents($urlKab), true);
            // Insert ke database
            foreach ($dataKab as $d) {
                DB::table('tb_kabupaten')->insert([
                    'kode_kab' => $d['id'],
                    'nama_kab' => $d['name'],
                    'kode_prov' => $idProv,
                ]);
            }
        }
    }
}
