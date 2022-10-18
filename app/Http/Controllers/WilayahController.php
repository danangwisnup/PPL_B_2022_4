<?php

namespace App\Http\Controllers;

use App\Models\M_Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    public function index($provinsi)
    {
        $kabupatenkota = DB::table('tb_kabupaten')->select('kode_kab', 'nama_kab')->where('kode_prov', $provinsi)->get();
        $mahasiswa = M_Mahasiswa::where('nim', Auth::user()->nim_nip)->first();

        echo "<option value=''>Pilih Kabupaten/Kota</option>";
        foreach ($kabupatenkota as $kab) {
            echo "<option value='" . $kab->kode_kab . "' " . ($mahasiswa->kode_kab == $kab->kode_kab ? 'selected="true"' : '') . ">" . $kab->nama_kab . "</option>";
        }
    }
}
