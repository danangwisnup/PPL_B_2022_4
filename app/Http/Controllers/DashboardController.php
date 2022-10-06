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
        ])
            ->with('aktif', $mahasiswa->where('status', 'Aktif')->count())
            ->with('cuti', $mahasiswa->where('status', 'Cuti')->count())
            ->with('mangkir', $mahasiswa->where('status', 'Mangkir')->count())
            ->with('do', $mahasiswa->where('status', 'DO')->count())
            ->with('ud', $mahasiswa->where('status', 'Undur Diri')->count())
            ->with('md', $mahasiswa->where('status', 'Meninggal Dunia')->count())
            ->with('lulus', $mahasiswa->where('status', 'Lulus')->count())
            ->with('dosen_aktif', $dosen->where('status', 'Aktif')->count())
            ->with('dosen_cuti', $dosen->where('status', 'Cuti')->count());
    }
}
