<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tb_dosen;
use App\Models\tb_mahasiswa;
use App\Models\tb_irs;
use App\Models\tb_khs;
use App\Models\tb_pkl;
use App\Models\tb_skripsi;
use App\Models\tb_temp_file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $pkl = tb_pkl::where('nim', Auth::user()->nim_nip)->orderBy('semester_aktif', 'desc')->first();
        $skripsi = tb_skripsi::where('nim', Auth::user()->nim_nip)->orderBy('semester_aktif', 'desc')->first();
        $khs = tb_khs::where('nim', Auth::user()->nim_nip)->orderBy('semester_aktif', 'desc')->first();
        $mahasiswa = tb_mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $dosen = tb_dosen::where('nip', Auth::user()->nim_nip)->first();
        $mahasiswaAll = tb_mahasiswa::all();
        $dosenAll = tb_dosen::all();
        return view('dashboard.index', [
            'title' => 'Dashboard',
        ])->with(compact('mahasiswa', 'mahasiswaAll', 'dosenAll', 'pkl', 'skripsi', 'khs', 'dosen'));
    }
}
