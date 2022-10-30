<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tb_dosen;
use App\Models\tb_entry_progress;
use App\Models\tb_mahasiswa;
use App\Models\tb_irs;
use App\Models\tb_khs;
use App\Models\tb_pkl;
use App\Models\tb_skripsi;
use App\Models\tb_temp_file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProgressMhsContoller extends Controller
{
    public function dosen()
    {
        $mahasiswa = tb_mahasiswa::where('kode_wali', Auth::user()->nim_nip)->get();
        $dosen = tb_dosen::where('nip', Auth::user()->nim_nip)->first();
        return view('dosen.progress.index', [
            'title' => 'Progress Studi Mahasiswa',
        ])->with(compact('mahasiswa', 'dosen'));
    }

    public function department()
    {
        $mahasiswa = tb_mahasiswa::all();
        return view('department.progress.index', [
            'title' => 'Progress Studi Mahasiswa',
        ])->with(compact('mahasiswa'));
    }

    public function show(Request $request)
    {
        $mahasiswa = tb_mahasiswa::where('nim', $request->nim)->first();
        $dosen = tb_dosen::where('nip', $mahasiswa->kode_wali)->first();
        for ($i = 1; $i <= 14; $i++) {
            $progress = tb_entry_progress::where('nim', $request->nim)->where('semester_aktif', $i)->where('is_verifikasi', '1')->first();
            $pkl = tb_pkl::where('nim', $request->nim)->where('semester_aktif', $i)->first();
            $skripsi = tb_skripsi::where('nim', $request->nim)->where('semester_aktif', $i)->first();
            if ($progress != null) {
                if ($progress->is_irs == 1 && $progress->is_khs == 1) {
                    $semester[$i] = 'btn-info';
                } else {
                    $semester[$i] = 'btn-danger';
                }
                if ($progress->is_pkl == 1 && $pkl->status == 'Lulus') {
                    $semester[$i] = 'btn-warning';
                }
                if ($progress->is_skripsi == 1 && $skripsi->status == 'Lulus') {
                    $semester[$i] = 'btn-success';
                }
            } else {
                $semester[$i] = 'btn-danger';
            }
        }

        if (Auth::user()->role == 'dosen') {
            if ($mahasiswa->kode_wali == Auth::user()->nim_nip) {
                return view('dosen.progress.detail', [
                    'title' => 'Progress Studi Mahasiswa',
                ])->with(compact('mahasiswa', 'dosen', 'semester'));
            } else {
                Alert::error('Error', 'Anda tidak memiliki akses ke halaman ini');
                return redirect()->back();
            }
        } else {
            return view('department.progress.detail', [
                'title' => 'Progress Studi Mahasiswa',
            ])->with(compact('mahasiswa', 'dosen', 'semester'));
        }
    }

    public function show_semester(Request $request)
    {
        $irs = tb_irs::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $khs = tb_khs::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $pkl = tb_pkl::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $skripsi = tb_skripsi::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();

        if (Auth::user()->role == 'dosen') {
            return view('dosen.progress.modal', compact('request', 'irs', 'khs', 'pkl', 'skripsi'));
        } else {
            return view('department.progress.modal', compact('request', 'irs', 'khs', 'pkl', 'skripsi'));
        }
    }
}
