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

class ManageUsersController extends Controller
{
    public function index()
    {
        $mahasiswa = tb_mahasiswa::all();
        $dosen = tb_dosen::all();
        return view('operator.manage_users.index', [
            'title' => 'Manage Users',
        ])->with(compact('mahasiswa', 'dosen'));
    }
}
