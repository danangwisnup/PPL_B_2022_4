<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tb_dosen;
use App\Models\tb_mahasiswa;
use App\Models\tb_irs;
use App\Models\tb_kab;
use App\Models\tb_khs;
use App\Models\tb_pkl;
use App\Models\tb_skripsi;
use App\Models\tb_temp_file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WilayahController extends Controller
{
    public function index($provinsi)
    {
        // if User is Mahasiswa
        if (Auth::user()->role == 'mahasiswa') {
            $kabupatenkota = tb_kab::where('kode_prov', $provinsi)->get();
            $mahasiswa = tb_mahasiswa::where('nim', Auth::user()->nim_nip)->first();

            echo "<option value=''>Pilih Kabupaten/Kota</option>";
            foreach ($kabupatenkota as $kab) {
                echo "<option value='" . $kab->kode_kab . "' " . ($mahasiswa->kode_kab == $kab->kode_kab ? 'selected="true"' : '') . ">" . $kab->nama_kab . "</option>";
            }
        } else if (Auth::user()->role == 'dosen') {
            $kabupatenkota = tb_kab::where('kode_prov', $provinsi)->get();
            $dosen = tb_dosen::where('nip', Auth::user()->nim_nip)->first();

            echo "<option value=''>Pilih Kabupaten/Kota</option>";
            foreach ($kabupatenkota as $kab) {
                echo "<option value='" . $kab->kode_kab . "' " . ($dosen->kode_kab == $kab->kode_kab ? 'selected="true"' : '') . ">" . $kab->nama_kab . "</option>";
            }
        } else {
            $kabupatenkota = tb_kab::where('kode_prov', $provinsi)->get();

            echo "<option value=''>Pilih Kabupaten/Kota</option>";
            foreach ($kabupatenkota as $kab) {
                echo "<option value='" . $kab->kode_kab . "'>" . $kab->nama_kab . "</option>";
            }
        }
    }
}
