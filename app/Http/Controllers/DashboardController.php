<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Mahasiswa;
use App\Models\M_Dosen;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = M_Mahasiswa::all();
        $dosen = M_Dosen::all();
        return view('dashboard.index', [
            'title' => 'Dashboard',
        ])->with('mahasiswa', $mahasiswa)->with('dosen', $dosen);
    }

    // Fiture Operator: Add User
    public function add_user()
    {
        return view('operator.add_user.index', [
            'title' => 'Add User',
        ]);
    }

    // Fiture Operator: Manajemen User
    public function manajemen_user()
    {
        $Mahasiswa = M_Mahasiswa::all();
        $Dosen = M_Dosen::all();
        return view('operator.manajemen_user.index', [
            'title' => 'Manajemen User',
        ])->with('mahasiswa', $Mahasiswa)->with('dosen', $Dosen);
    }

    // Fiture Mahasiswa: IRS
    // Fiture Mahasiswa: KHS
    // Fiture Mahasiswa: PKL
    // Fiture Mahasiswa: Skripsi

    // Fiture Dosen: Progress Studi Mahasiswa
    // Fiture Dosen: Verifikasi Berkas Mahasiswa
    // Fiture Dosen: Data Mahasiswa
    // Fiture Dosen: Data Mahasiswa PKL
    // Fiture Dosen: Data Mahsiswa Skripsi

    // Fiture Department: Progress Studi Mahasiswa
    // Fiture Department: Data Mahasiswa
    // Fiture Department: Data Dosen
}
