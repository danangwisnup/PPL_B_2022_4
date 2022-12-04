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

class EntryProgressController extends Controller
{
    public function index()
    {
        $countSemsester = tb_entry_progress::where('nim', Auth::user()->nim_nip)->count();
        $progress = tb_entry_progress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $countSemsester)->first();
        $mahasiswa = tb_mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        return view('mahasiswa.entry.index', [
            'title' => 'Entry Progress',
        ])->with(compact('mahasiswa', 'progress'));
    }

    public function entry_progress(Request $request)
    {
        $request->validate([
            'semester_aktif' => 'required|unique:tb_entry_progresses,semester_aktif,NULL,id,nim,' . Auth::user()->nim_nip,
        ], [
            'semester_aktif.required' => 'Semester Aktif tidak boleh kosong',
            'semester_aktif.unique' => 'Semester' . $request->semester_aktif . 'sudah dientry',
        ]);

        $semester_aktif = $request->semester_aktif;
        $nim = Auth::user()->nim_nip;
        $kode_wali = tb_mahasiswa::where('nim', $nim)->first()->kode_wali;

        // user memilih semseter 2, tetapi belum memilih semster 1 maka akan muncul error
        if ($semester_aktif < 1) {
            // error
            Alert::error('Error', 'Silahkan pilih semester 1 terlebih dahulu');
            return redirect()->back();
        } else if ($semester_aktif > 1) {
            $semester_aktif_sebelumnya = $semester_aktif - 1;
            if (!tb_entry_progress::where('semester_aktif', $semester_aktif_sebelumnya)->where('nim', $nim)->where('is_skripsi', 1)->exists()) {
                return redirect()->back()->withErrors(['semester_aktif' => 'Entry progress semester sebelumnya belum diselesaikan']);
            } else {
                $entry_progress = tb_entry_progress::create([
                    'semester_aktif' => $semester_aktif,
                    'nim' => $nim,
                    'nip' => $kode_wali,
                ]);

                Alert::success('Berhasil', 'Data berhasil disimpan');
                return redirect()->route('irs.index');
            }
        } else {
            $entry_progress = tb_entry_progress::create([
                'semester_aktif' => $semester_aktif,
                'nim' => $nim,
                'nip' => $kode_wali,
            ]);

            Alert::success('Berhasil', 'Data berhasil disimpan');
            return redirect()->route('irs.index');
        }
    }
}
