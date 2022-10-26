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
        $urlProv = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi';
        $dataProv = json_decode(file_get_contents($urlProv), true);
        $dataProv = $dataProv['provinsi'];
        foreach ($dataProv as $d) {
            $idProv = $d['id'];
            // Api Kabupaten
            $urlKab = 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' . $idProv;
            $dataKab = json_decode(file_get_contents($urlKab), true);
            $dataKab = $dataKab['kota_kabupaten'];
            // Insert ke database
            foreach ($dataKab as $d) {
                DB::table('tb_kabs')->insert([
                    'kode_kab' => $d['id'],
                    'nama_kab' => $d['nama'],
                    'kode_prov' => $idProv,
                ]);
            }
        }
    }
}
