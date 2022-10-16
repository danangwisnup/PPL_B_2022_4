<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_IRS;
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
        //
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
            'status' => 'Belum Diverifikasi',
            'upload_irs' => $request->file,
        ]);

        if ($temp) {
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/irs/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '_' . $db->sks . '.pdf'));
            rmdir(public_path('files/temp/' . $temp->folder));
            $db->where('semester_aktif', $request->semester_aktif)->update([
                'upload_irs' => 'files/irs/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '_' . $db->sks . '.pdf'
            ]);
            $temp->delete();
        }

        if ($db->save()) {
            Alert::success('Berhasil', 'Data berhasil disimpan');
            return redirect()->route('irs');
        } else {
            Alert::error('Gagal', 'Data gagal disimpan');
            return redirect()->route('irs');
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
    public function edit($semester)
    {
        $nim = Auth::user()->nim_nip;
        $data = M_IRS::where('nim', $nim)->where('semester_aktif', $semester)->first();
        return view('mahasiswa.irs.modal', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $semester)
    {
        // Validate
        $request->validate([
            'jumlah_sks' => 'required|numeric',
            'fileEdit' => 'required',
        ]);

        $db = M_IRS::where('semester_aktif', $semester)->where('nim', Auth::user()->nim_nip)->first();

        $temp = M_TempFile::where('path', $request->fileEdit)->first();

        if ($temp) {
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->folder . '/' . $temp->path), public_path('files/irs/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '_' . $request->jumlah_sks . '.pdf'));
            rmdir(public_path('files/temp/' . $temp->folder));
            M_IRS::where('semester_aktif', $semester)->where('nim', Auth::user()->nim_nip)->update([
                'sks' => $request->jumlah_sks,
                'upload_irs' => 'files/irs/' . $uniq . '_' . $db->nim . '_' . $db->semester_aktif . '_' . $request->jumlah_sks . '.pdf'
            ]);
            $temp->delete();
        }

        if ($db->update()) {
            unlink(public_path($db->upload_irs));
            Alert::success('Berhasil', 'Data berhasil diubah');
            return redirect()->route('irs');
        } else {
            Alert::error('Gagal', 'Data gagal diubah');
            return redirect()->route('irs');
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
