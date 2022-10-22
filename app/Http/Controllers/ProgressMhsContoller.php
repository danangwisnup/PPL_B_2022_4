<?php

namespace App\Http\Controllers;

use App\Models\M_Dosen;
use App\Models\M_EntryProgress;
use App\Models\M_IRS;
use App\Models\M_KHS;
use App\Models\M_Mahasiswa;
use App\Models\M_PKL;
use App\Models\M_Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressMhsContoller extends Controller
{
    public function dosen()
    {
        $mahasiswa = M_Mahasiswa::where('kode_wali', Auth::user()->nim_nip)->get();
        return view('dosen.progress.index', [
            'title' => 'Progress Studi Mahasiswa',
        ])->with(compact('mahasiswa'));
    }

    public function department()
    {
        $mahasiswa = M_Mahasiswa::all();
        return view('department.progress.index', [
            'title' => 'Progress Studi Mahasiswa',
        ])->with(compact('mahasiswa'));
    }

    public function show(Request $request)
    {
        $mahasiswa = M_Mahasiswa::where('nim', $request->nim)->first();
        $dosen = M_Dosen::where('nip', $mahasiswa->kode_wali)->first();
        for ($i = 1; $i <= 14; $i++) {
            $progress = M_EntryProgress::where('nim', $request->nim)->where('semester_aktif', $i)->where('is_verifikasi', '1')->first();
            $pkl = M_PKL::where('nim', $request->nim)->where('semester_aktif', $i)->first();
            $skripsi = M_Skripsi::where('nim', $request->nim)->where('semester_aktif', $i)->first();
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

        return view('dosen.progress.detail', [
            'title' => 'Progress Studi Mahasiswa',
        ])->with(compact('mahasiswa', 'dosen', 'semester'));
    }

    public function show_semester(Request $request)
    {
        $irs = M_IRS::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $khs = M_KHS::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $pkl = M_PKL::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $skripsi = M_Skripsi::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        return view('dosen.progress.modal', compact('request', 'irs', 'khs', 'pkl', 'skripsi'));
    }
}
