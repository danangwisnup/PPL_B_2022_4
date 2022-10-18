<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Mahasiswa;
use App\Models\M_Dosen;
use App\Models\M_IRS;
use App\Models\M_KHS;
use App\Models\M_PKL;
use App\Models\M_Skripsi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pkl = M_PKL::where('nim', Auth::user()->nim_nip)->orderBy('semester_aktif', 'desc')->first();
        $skripsi = M_Skripsi::where('nim', Auth::user()->nim_nip)->orderBy('semester_aktif', 'desc')->first();
        $khs = M_KHS::where('nim', Auth::user()->nim_nip)->orderBy('semester_aktif', 'desc')->first();
        $mahasiswa = M_Mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $mahasiswaAll = M_Mahasiswa::all();
        $dosenAll = M_Dosen::all();
        return view('dashboard.index', [
            'title' => 'Dashboard',
        ])->with(compact('mahasiswa', 'mahasiswaAll', 'dosenAll', 'pkl', 'skripsi', 'khs'));
    }
}
