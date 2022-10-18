<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_Mahasiswa;
use App\Models\M_Dosen;
use App\Models\M_IRS;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = M_Mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $mahasiswaAll = M_Mahasiswa::all();
        $dosenAll = M_Dosen::all();
        return view('dashboard.index', [
            'title' => 'Dashboard',
        ])->with(compact('mahasiswa', 'mahasiswaAll', 'dosenAll'));
    }
}
