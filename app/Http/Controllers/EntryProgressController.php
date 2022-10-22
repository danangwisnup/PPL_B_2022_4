<?php

namespace App\Http\Controllers;

use App\Models\M_EntryProgress;
use App\Models\M_Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EntryProgressController extends Controller
{
    public function index()
    {
        $countSemsester = M_EntryProgress::where('nim', Auth::user()->nim_nip)->count();
        $progress = M_EntryProgress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $countSemsester)->first();
        $mahasiswa = M_Mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        return view('mahasiswa.entry.index', [
            'title' => 'Entry Progress',
        ])->with(compact('mahasiswa', 'progress'));
    }

    public function entry_progress(Request $request)
    {
        $request->validate([
            'semester_aktif' => 'required|unique:tb_entry_progress,semester_aktif,NULL,id,nim,' . Auth::user()->nim_nip,
        ]);

        $semester_aktif = $request->semester_aktif;
        $nim = Auth::user()->nim_nip;
        $kode_wali = M_Mahasiswa::where('nim', $nim)->first()->kode_wali;

        // user memilih semseter 2, tetapi belum memilih semster 1 maka akan muncul error
        if ($semester_aktif > 1) {
            $semester_aktif_sebelumnya = $semester_aktif - 1;
            if (!M_EntryProgress::where('semester_aktif', $semester_aktif_sebelumnya)->where('nim', $nim)->where('is_skripsi', 1)->exists()) {
                return redirect()->back()->withErrors(['semester_aktif' => 'Entry progress semester sebelumnya belum diselesaikan']);
            } else {
                $entry_progress = M_EntryProgress::create([
                    'semester_aktif' => $semester_aktif,
                    'nim' => $nim,
                    'nip' => $kode_wali,
                ]);

                Alert::success('Berhasil', 'Data berhasil disimpan');
                return redirect()->route('irs.index');
            }
        } else {
            $entry_progress = M_EntryProgress::create([
                'semester_aktif' => $semester_aktif,
                'nim' => $nim,
                'nip' => $kode_wali,
            ]);

            Alert::success('Berhasil', 'Data berhasil disimpan');
            return redirect()->route('irs.index');
        }
    }
}
