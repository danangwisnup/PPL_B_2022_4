<?php

namespace App\Http\Controllers;

use App\Models\M_EntryProgress;
use Illuminate\Http\Request;
use App\Models\M_IRS;
use App\Models\M_Mahasiswa;
use App\Models\M_TempFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;
use RealRashid\SweetAlert\Facades\Alert;

class IRSController extends Controller
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
        $irs = M_IRS::where('nim', Auth::user()->nim_nip)->get();
        return view('mahasiswa.irs.entry', [
            'title' => 'Entry IRS',
        ])->with(compact('mahasiswa', 'irs', 'progress'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $mahasiswa = M_Mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $irs = M_IRS::where('nim', Auth::user()->nim_nip)->get();
        return view('mahasiswa.irs.index', [
            'title' => 'IRS',
        ])->with(compact('mahasiswa', 'irs'));
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
            'semester_aktif' => 'required|unique:tb_irs,semester_aktif,NULL,id,nim,' . Auth::user()->nim_nip,
            'jumlah_sks' => 'required|numeric',
            'file' => 'required',
        ]);

        $temp = M_TempFile::where('path', $request->file)->first();

        // Insert to DB
        $db = M_IRS::create([
            'nim' => Auth::user()->nim_nip,
            'semester_aktif' => $request->semester_aktif,
            'sks' => $request->jumlah_sks,
            'upload_irs' => $request->file,
        ]);

        M_EntryProgress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $request->semester_aktif)
            ->update([
                'is_irs' => 1,
            ]);

        if ($temp) {
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/irs/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '.pdf'));
            rmdir(public_path('files/temp/' . $temp->folder));
            $db->where('semester_aktif', $request->semester_aktif)->update([
                'upload_irs' => 'files/irs/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '.pdf'
            ]);
            $temp->delete();
        }

        if ($db->save()) {
            Alert::success('Berhasil', 'Data berhasil disimpan');
            return redirect()->route('khs.index');
        } else {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->route('irs.index');
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
        $data = M_IRS::where('nim', $nim)->where('semester_aktif', $semester_aktif)->first();
        return view('mahasiswa.irs.modal', compact('data'));
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
            'jumlah_sks' => 'required|numeric',
            'confirm' => 'sometimes|accepted',
            'fileEdit' => 'required_if:confirm,on',
        ]);

        $db = M_IRS::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->first();

        $temp = M_TempFile::where('path', $request->fileEdit)->first();

        if ($temp && $request->confirm == 'on') {
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/irs/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '.pdf'));
            rmdir(public_path('files/temp/' . $temp->folder));
            M_IRS::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->update([
                'sks' => $request->jumlah_sks,
                'upload_irs' => 'files/irs/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '.pdf'
            ]);
            $temp->delete();
            unlink(public_path($db->upload_irs));
        } else {
            M_IRS::where('semester_aktif', $semester_aktif)->where('nim', $request->nim)->update([
                'sks' => $request->jumlah_sks,
            ]);
        }

        if ($db->update()) {
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect('/mahasiswa/data/irs');
        } else {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect('/mahasiswa/data/irs');
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
