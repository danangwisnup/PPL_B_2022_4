<?php

namespace App\Http\Controllers;

use App\Models\M_Dosen;
use App\Models\M_EntryProgress;
use App\Models\M_IRS;
use App\Models\M_KHS;
use App\Models\M_Mahasiswa;
use App\Models\M_PKL;
use App\Models\M_Skripsi;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiBerkasController extends Controller
{
    public function index()
    {
        $mahasiswa = M_Mahasiswa::where('kode_wali', Auth::user()->nim_nip)->get();
        $progress = M_EntryProgress::where('nip', Auth::user()->nim_nip)->where('is_irs', 1)->where('is_khs', 1)->where('is_pkl', 1)->where('is_skripsi', 1)->where('is_verifikasi', '0')->get();

        return view('dosen.verifikasi.index', [
            'title' => 'Verifikasi Berkas Mahasiswa',
        ])->with(compact('mahasiswa', 'progress'));
    }

    public function show(Request $request)
    {
        $mahasiswa = M_Mahasiswa::where('nim', $request->nim)->first();
        $dosen = M_Dosen::where('nip', $mahasiswa->kode_wali)->first();
        $progress = M_EntryProgress::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $irs = M_IRS::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $khs = M_KHS::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $pkl = M_PKL::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();
        $skripsi = M_Skripsi::where('nim', $request->nim)->where('semester_aktif', $request->semester)->first();

        if ($progress == null) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        } else if ($progress->is_irs == 0 || $progress->is_khs == 0 || $progress->is_pkl == 0 || $progress->is_skripsi == 0) {
            return redirect()->back()->with('error', 'Mahasiswa belum mengisi semua data');
        } else {
            return view('dosen.verifikasi.berkas', [
                'title' => 'Verifikasi Berkas Mahasiswa',
            ])->with(compact('mahasiswa', 'dosen', 'progress', 'irs', 'khs', 'pkl', 'skripsi', 'request'));
        }
    }

    public function update(Request $request)
    {
        if ($request->id == 1) {
            M_EntryProgress::where('nim', $request->nim)->where('semester_aktif', $request->semester)->update([
                'is_verifikasi' => '1',
            ]);
            Alert::success('Berhasil', 'Berkas berhasil diverifikasi');
            return redirect('/dosen/verifikasi_berkas_mahasiswa');
        } else {
            M_EntryProgress::where('nim', $request->nim)->where('semester_aktif', $request->semester)->update([
                'is_verifikasi' => '0',
            ]);
            Alert::success('Berhasil', 'Berkas berhasil dibatalkan');
            return redirect('/dosen/verifikasi_berkas_mahasiswa');
        }
    }
}
