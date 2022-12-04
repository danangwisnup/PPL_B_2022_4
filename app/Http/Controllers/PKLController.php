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

class PKLController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('pkl', ['only' => ['index']]);
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
        $pkl = tb_pkl::where('nim', Auth::user()->nim_nip)->get();
        return view('mahasiswa.pkl.entry', [
            'title' => 'Entry PKL',
        ])->with(compact('mahasiswa', 'pkl', 'progress'));
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
        $pkl = tb_pkl::where('nim', Auth::user()->nim_nip)->get();
        return view('mahasiswa.pkl.index', [
            'title' => 'PKL',
        ])->with(compact('mahasiswa', 'pkl', 'progress'));
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
            'semester_aktif' => 'required|unique:tb_pkls,semester_aktif,NULL,id,nim,' . Auth::user()->nim_nip,
            'confirm' => 'sometimes|accepted',
            'status_pkl' => 'required_if:confirm,on|in:,Lulus,Sedang Ambil,Belum Ambil',
            'nilai_pkl' => 'required_if:status_pkl,Lulus|in:,A,B,C,D,E',
            'file' => 'required_if:confirm,on',
        ], [
            'semester_aktif.required' => 'Semester Aktif tidak boleh kosong',
            'semester_aktif.unique' => 'Semester Aktif sudah ada',
            'status_pkl.required_if' => 'Status PKL tidak boleh kosong',
            'status_pkl.in' => 'Status PKL tidak valid',
            'nilai_pkl.required_if' => 'Nilai PKL tidak boleh kosong',
            'nilai_pkl.in' => 'Nilai PKL tidak valid',
            'file.required_if' => 'File tidak boleh kosong',
        ]);

        if ($request->status_pkl != 'Lulus' && $request->nilai_pkl != null) {
            Alert::error('Gagal', 'Nilai PKL hanya bisa diisi jika status PKL adalah Lulus');
            return redirect()->back();
        }

        $temp = tb_temp_file::where('path', $request->file)->first();

        // Insert to DB
        if ($request->confirm == 'on') {
            $db = tb_pkl::create([
                'nim' => Auth::user()->nim_nip,
                'semester_aktif' => $request->semester_aktif,
                'status' => $request->status_pkl,
                'upload_pkl' => $temp->path,
            ]);
            if ($request->status_pkl == 'Lulus') {
                tb_pkl::where('nim', Auth::user()->nim_nip)
                    ->where('semester_aktif', $request->semester_aktif)
                    ->update([
                        'nilai' => $request->nilai_pkl,
                    ]);
            }
        } else {
            $db = tb_pkl::create([
                'nim' => Auth::user()->nim_nip,
                'semester_aktif' => $request->semester_aktif,
                'status' => 'Belum Ambil',
            ]);
        }

        tb_entry_progress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $request->semester_aktif)
            ->update([
                'is_pkl' => 1,
            ]);

        if ($temp) {
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/pkl/' . $db->nim . '_' . $db->semester_aktif . '_' . $uniq . '.pdf'));
            $db->where('nim', Auth::user()->nim_nip)->where('semester_aktif', $request->semester_aktif)->update([
                'upload_pkl' => 'files/pkl/' . $db->nim . '_' . $db->semester_aktif . '_' . $uniq . '.pdf'
            ]);
            $temp->delete();
        }

        if ($db->save()) {
            Alert::success('Berhasil', 'Data berhasil disimpan');
            return redirect()->route('skripsi.index');
        } else {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->route('pkl.index');
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
        $data = tb_pkl::where('nim', $nim)->where('semester_aktif', $semester_aktif)->first();
        return view('mahasiswa.pkl.modal', compact('data'));
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
            'status_pkl' => 'required|in:Lulus,Sedang Ambil,Belum Ambil',
            'nilai_pkl' => 'required_if:status_pkl,Lulus|in:,A,B,C,D,E',
            'fileEdit' => 'required_if:confirm,on',
        ], [
            'status_pkl.required' => 'Status PKL tidak boleh kosong',
            'status_pkl.in' => 'Status PKL tidak valid',
            'nilai_pkl.required_if' => 'Nilai PKL tidak boleh kosong',
            'nilai_pkl.in' => 'Nilai PKL tidak valid',
            'fileEdit.required_if' => 'File tidak boleh kosong',
        ]);

        if ($request->status_pkl != 'Lulus' && $request->nilai_pkl != null) {
            Alert::error('Gagal', 'Nilai PKL hanya bisa diisi jika status PKL adalah Lulus');
            return redirect()->back();
        }

        $db = tb_pkl::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->first();

        $temp = tb_temp_file::where('path', $request->fileEdit)->first();

        if ($temp && $request->confirm == 'on') {
            if (tb_pkl::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->where('upload_pkl', '!=', NULL)->first()) {
                unlink(public_path($db->upload_pkl));
            }
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/pkl/' . $db->nim . '_' . $db->semester_aktif . '_' . $uniq . '.pdf'));
            tb_pkl::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->update([
                'status' => $request->status_pkl,
                'nilai' => $request->nilai_pkl,
                'upload_pkl' => 'files/pkl/' . $db->nim . '_' . $db->semester_aktif  . '_' . $uniq . '.pdf'
            ]);
            $temp->delete();
        } else {
            tb_pkl::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->update([
                'status' => $request->status_pkl,
                'nilai' => $request->nilai_pkl,
            ]);
        }

        if ($db->update()) {
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/mahasiswa/data/pkl');
        } else {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect('/mahasiswa/data/pkl');
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
