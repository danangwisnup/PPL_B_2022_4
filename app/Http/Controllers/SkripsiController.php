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

class SkripsiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('skripsi', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countSemsester = tb_entry_progress::where('nim', Auth::user()->nim_nip)->count();
        $progress = tb_entry_progress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $countSemsester)->first();
        $mahasiswa = tb_mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $skripsi = tb_skripsi::where('nim', Auth::user()->nim_nip)->get();
        return view('mahasiswa.skripsi.entry', [
            'title' => 'Entry Skripsi',
        ])->with(compact('mahasiswa', 'skripsi', 'progress'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $progress = tb_entry_progress::where('nim', Auth::user()->nim_nip)->first();
        $mahasiswa = tb_mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $skripsi = tb_skripsi::where('nim', Auth::user()->nim_nip)->get();
        return view('mahasiswa.skripsi.index', [
            'title' => 'Skripsi',
        ])->with(compact('mahasiswa', 'skripsi', 'progress'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'semester_aktif' => 'required|unique:tb_skripsis,semester_aktif,NULL,id,nim,' . Auth::user()->nim_nip,
            'confirm' => 'sometimes|accepted',
            'tanggal_sidang' => 'required_if:status_skripsi,Lulus',
            'nilai_skripsi' => 'required_if:status_skripsi,Lulus|in:,A,B,C,D,E',
            'status_skripsi' => 'required_if:confirm,on|in:,Lulus,Sedang Ambil,Belum Ambil',
            'file' => 'required_if:confirm,on',
        ], [
            'semester_aktif.required' => 'Semester Aktif tidak boleh kosong',
            'semester_aktif.unique' => 'Semester Aktif sudah ada',
            'tanggal_sidang.required_if' => 'Tanggal Sidang tidak boleh kosong',
            'nilai_skripsi.required_if' => 'Nilai Skripsi tidak boleh kosong',
            'nilai_skripsi.in' => 'Nilai Skripsi harus diisi dengan A, B, C, D, E',
            'status_skripsi.required_if' => 'Status Skripsi tidak boleh kosong',
            'status_skripsi.in' => 'Status Skripsi harus diisi dengan Lulus, Sedang Ambil, Belum Ambil',
            'file.required_if' => 'File tidak boleh kosong',
        ]);

        if ($request->status_skripsi != 'Lulus' && $request->nilai_skripsi != null) {
            Alert::error('Gagal', 'Nilai Skripsi hanya bisa diisi jika status Skripsi adalah Lulus');
            return redirect()->back();
        }

        $temp = tb_temp_file::where('path', $request->file)->first();

        // Insert to DB
        if ($request->confirm == 'on') {
            $db = tb_skripsi::create([
                'nim' => Auth::user()->nim_nip,
                'semester_aktif' => $request->semester_aktif,
                'tanggal_sidang' => $request->tanggal_sidang,
                'status' => $request->status_skripsi,
                'upload_skripsi' => $temp->path,
            ]);
            if ($request->status_skripsi == 'Lulus') {
                tb_skripsi::where('nim', Auth::user()->nim_nip)
                    ->where('semester_aktif', $request->semester_aktif)
                    ->update([
                        'nilai' => $request->nilai_skripsi,
                    ]);
            }
        } else {
            $db = tb_skripsi::create([
                'nim' => Auth::user()->nim_nip,
                'semester_aktif' => $request->semester_aktif,
                'status' => 'Belum Ambil',
            ]);
        }

        tb_entry_progress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $request->semester_aktif)
            ->update([
                'is_skripsi' => 1,
            ]);

        if ($temp) {
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/skripsi/'  . $db->nim . '_' . $db->semester_aktif . '_' . $uniq . '.pdf'));
            $db->where('nim', Auth::user()->nim_nip)->where('semester_aktif', $request->semester_aktif)->update([
                'upload_skripsi' => 'files/skripsi/' . $db->nim . '_' . $db->semester_aktif . '_' . $uniq . '.pdf'
            ]);
            $temp->delete();
        }

        if ($db->save()) {
            Alert::success('Berhasil', 'Data berhasil disimpan');
            return redirect('/mahasiswa/entry');
        } else {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->route('skripsi.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($semester_aktif, $nim)
    {
        $data = tb_skripsi::where('nim', $nim)->where('semester_aktif', $semester_aktif)->first();
        return view('mahasiswa.skripsi.modal', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $semester_aktif)
    {
        // Validate
        $request->validate([
            'confirm' => 'sometimes|accepted',
            'status_skripsi' => 'required|in:Lulus,Sedang Ambil,Belum Ambil',
            'nilai_skripsi' => 'required_if:status_skripsi,Lulus|in:,A,B,C,D,E',
            'tanggal_sidang' => 'required_if:status_skripsi,Lulus',
            'fileEdit' => 'required_if:confirm,on',
        ], [
            'status_skripsi.required' => 'Status Skripsi tidak boleh kosong',
            'status_skripsi.in' => 'Status Skripsi harus diisi dengan Lulus, Sedang Ambil, Belum Ambil',
            'nilai_skripsi.required_if' => 'Nilai Skripsi tidak boleh kosong',
            'nilai_skripsi.in' => 'Nilai Skripsi harus diisi dengan A, B, C, D, E',
            'tanggal_sidang.required_if' => 'Tanggal Sidang tidak boleh kosong',
            'fileEdit.required_if' => 'File tidak boleh kosong',
        ]);

        $db = tb_skripsi::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->first();

        $temp = tb_temp_file::where('path', $request->fileEdit)->first();

        if ($temp && $request->confirm == 'on') {
            if (tb_skripsi::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->where('upload_skripsi', '!=', null)->first()) {
                unlink(public_path($db->upload_skripsi));
            }
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/skripsi/' . $db->nim . '_' . $db->semester_aktif . '_' . $uniq . '.pdf'));
            tb_skripsi::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->update([
                'tanggal_sidang' => $request->tanggal_sidang,
                'status' => $request->status_skripsi,
                'nilai' => $request->nilai_skripsi,
                'upload_skripsi' => 'files/skripsi/' . $db->nim . '_' . $db->semester_aktif . '_' . $uniq . '.pdf'
            ]);
            $temp->delete();
        } else {
            tb_skripsi::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->update([
                'tanggal_sidang' => $request->tanggal_sidang,
                'status' => $request->status_skripsi,
                'nilai' => $request->nilai_skripsi,
            ]);
        }

        if ($db->update()) {
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/mahasiswa/data/skripsi');
        } else {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect('/mahasiswa/data/skripsi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
