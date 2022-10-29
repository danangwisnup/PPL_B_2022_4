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
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi';
        $data = json_decode(file_get_contents($url), true);
        $data = $data['provinsi'];

        // Insert ke database
        foreach ($data as $d) {
            DB::table('tb_provs')->insert([
                'kode_prov' => $d['id'],
                'nama_prov' => $d['nama'],
            ]);
        }

        DB::table('tb_provs')->where('kode_prov', 31)->update([
            'nama_prov' => 'DKI Jakarta',
        ]);

        DB::table('tb_provs')->where('kode_prov', 34)->update([
            'nama_prov' => 'Daerah Istimewa Yogyakarta',
        ]);
    }
}
