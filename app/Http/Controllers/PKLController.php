<?php

namespace App\Http\Controllers;

use App\Models\M_EntryProgress;
use Illuminate\Http\Request;
use App\Models\M_PKL;
use App\Models\M_Mahasiswa;
use App\Models\M_TempFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;
use RealRashid\SweetAlert\Facades\Alert;

class PKLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countSemsester = M_EntryProgress::where('nim', Auth::user()->nim_nip)->count();
        $progress = M_EntryProgress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $countSemsester)->first();
        $mahasiswa = M_Mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $pkl = M_PKL::where('nim', Auth::user()->nim_nip)->get();
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
        $progress = M_EntryProgress::where('nim', Auth::user()->nim_nip)->first();
        $mahasiswa = M_Mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $pkl = M_PKL::where('nim', Auth::user()->nim_nip)->get();
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
            'semester_aktif' => 'required|unique:tb_pkl,semester_aktif,NULL,id,nim,' . Auth::user()->nim_nip,
            'confirm' => 'sometimes|accepted',
            'nilai_pkl' => 'required_if:status_pkl,Lulus',
            'status_pkl' => 'required_if:confirm,on',
            'file' => 'required_if:confirm,on',
        ]);

        $temp = M_TempFile::where('path', $request->file)->first();

        // Insert to DB
        if ($request->confirm == 'on') {
            $db = M_PKL::create([
                'nim' => Auth::user()->nim_nip,
                'semester_aktif' => $request->semester_aktif,
                'status' => $request->status_pkl,
                'upload_pkl' => $temp->path,
            ]);
            if ($request->status_pkl == 'Lulus') {
                M_PKL::where('nim', Auth::user()->nim_nip)
                    ->where('semester_aktif', $request->semester_aktif)
                    ->update([
                        'nilai' => $request->nilai_pkl,
                    ]);
            }
        } else {
            $db = M_PKL::create([
                'nim' => Auth::user()->nim_nip,
                'semester_aktif' => $request->semester_aktif,
                'status' => 'Belum Ambil',
            ]);
        }

        M_EntryProgress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $request->semester_aktif)
            ->update([
                'is_pkl' => 1,
            ]);

        if ($temp) {
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/pkl/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '.pdf'));
            rmdir(public_path('files/temp/' . $temp->folder));
            $db->where('semester_aktif', $request->semester_aktif)->update([
                'upload_pkl' => 'files/pkl/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '.pdf'
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
        $data = M_PKL::where('nim', $nim)->where('semester_aktif', $semester_aktif)->first();
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
            'status_pkl' => 'required',
            'fileEdit' => 'required_if:confirm,on',
        ]);

        $db = M_PKL::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->first();

        $temp = M_TempFile::where('path', $request->fileEdit)->first();

        if ($temp && $request->confirm == 'on') {
            if (M_PKL::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->where('upload_pkl', '!=', NULL)->first()) {
                unlink(public_path($db->upload_pkl));
            }
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/pkl/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '.pdf'));
            rmdir(public_path('files/temp/' . $temp->folder));
            M_PKL::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->update([
                'status' => $request->status_pkl,
                'nilai' => $request->nilai_pkl,
                'upload_pkl' => 'files/pkl/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '.pdf'
            ]);
            $temp->delete();
        } else {
            M_PKL::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->update([
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
