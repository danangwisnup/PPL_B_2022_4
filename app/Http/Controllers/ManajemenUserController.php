<?php

namespace App\Http\Controllers;

use App\Models\M_Dosen;
use App\Models\M_Mahasiswa;
use Illuminate\Http\Request;

class ManajemenUserController extends Controller
{
        public function index()
    {
        $mahasiswa = M_Mahasiswa::all();
        $dosen = M_Dosen::all();
        return view('operator.manajemen_user.index', [
            'title' => 'Manajemen User',
        ])->with(compact('mahasiswa', 'dosen'));
    }
}
