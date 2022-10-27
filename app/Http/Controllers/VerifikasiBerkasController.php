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

class VerifikasiBerkasController extends Controller
{
    public function index()
    {
        $mahasiswa = tb_mahasiswa::where('kode_wali', Auth::user()->nim_nip)->get();
        $dosen = tb_dosen::where('nip', Auth::user()->nim_nip)->first();
        $progress = tb_entry_progress::where('nip', Auth::user()->nim_nip)->where('is_irs', 1)->where('is_khs', 1)->where('is_pkl', 1)->where('is_skripsi', 1)->where('is_verifikasi', '0')->get();

        return view('dosen.verifikasi.index', [
            'title' => 'Verifikasi Berkas Mahasiswa',
        ])->with(compact('mahasiswa', 'progress', 'dosen'));
    }

    public function show(Request $request)
    {
        if ($request->nim_semester != null) {
            $nim = explode('_', $request->nim_semester)[0];
            $semester = explode('_', $request->nim_semester)[1];
        } else {
            $nim = $request->nim;
            $semester = $request->semester;
        }

        $mahasiswa = tb_mahasiswa::where('nim', $nim)->first();
        $dosen = tb_dosen::where('nip', $mahasiswa->kode_wali)->first();
        $progress = tb_entry_progress::where('nim', $nim)->where('semester_aktif', $semester)->first();
        $irs = tb_irs::where('nim', $nim)->where('semester_aktif', $semester)->first();
        $khs = tb_khs::where('nim', $nim)->where('semester_aktif', $semester)->first();
        $pkl = tb_pkl::where('nim', $nim)->where('semester_aktif', $semester)->first();
        $skripsi = tb_skripsi::where('nim', $nim)->where('semester_aktif', $semester)->first();

        if ($progress == null) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        } else if ($progress->is_irs == 0 || $progress->is_khs == 0 || $progress->is_pkl == 0 || $progress->is_skripsi == 0) {
            return redirect()->back()->with('error', 'Mahasiswa belum mengisi semua data');
        } else {
            return view('dosen.verifikasi.berkas', [
                'title' => 'Verifikasi Berkas Mahasiswa',
            ])->with(compact('mahasiswa', 'dosen', 'progress', 'irs', 'khs', 'pkl', 'skripsi'));
        }
    }

    public function update(Request $request)
    {
        if ($request->id == 1) {
            tb_entry_progress::where('nim', $request->nim)->where('semester_aktif', $request->semester)->update([
                'is_verifikasi' => '1',
            ]);
            Alert::success('Berhasil', 'Berkas berhasil diverifikasi');
            return redirect('/dosen/verifikasi_berkas_mahasiswa');
        } else {
            tb_entry_progress::where('nim', $request->nim)->where('semester_aktif', $request->semester)->update([
                'is_verifikasi' => '0',
            ]);
            Alert::success('Berhasil', 'Berkas berhasil dibatalkan');
            return redirect('/dosen/verifikasi_berkas_mahasiswa');
        }
    }
}
