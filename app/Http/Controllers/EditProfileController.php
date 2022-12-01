<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tb_dosen;
use App\Models\tb_entry_progress;
use App\Models\tb_mahasiswa;
use App\Models\tb_irs;
use App\Models\tb_kab;
use App\Models\tb_khs;
use App\Models\tb_pkl;
use App\Models\tb_prov;
use App\Models\tb_skripsi;
use App\Models\tb_temp_file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class EditProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = tb_mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $provinsi = tb_prov::all();
        $kabupaten = tb_kab::where('kode_prov', $mahasiswa->kode_prov)->get();
        $dosen_wali = tb_dosen::all();

        return view('mahasiswa.edit_profile', [
            'title' => 'Edit Profile',
        ])->with(compact('mahasiswa', 'provinsi', 'kabupaten', 'dosen_wali'));
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
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate
        $request->validate([
            'fileProfile' =>
            [
                // required if fileProfile null
                Rule::requiredIf(function () {
                    return tb_mahasiswa::where('nim', Auth::user()->nim_nip)->first()->foto == null;
                }),
            ],
            'nama' => 'required|string',
            'nim' => 'required',
            'angkatan' => 'required',
            'status' => 'required',
            'jalur_masuk' => 'required',
            'handphone' => 'required|numeric',
            'email' =>
            [
                'required', 'email', 'max:255', Rule::unique('users')->ignore($id, 'nim_nip'),
            ],
            'alamat' => 'required',
            'provinsi' => 'required|exists:tb_provs,kode_prov',
            'kabupatenkota' => 'required|exists:tb_kabs,kode_kab',
            'dosen_wali' => 'required|exists:tb_dosens,nip',
        ], [
            'fileProfile.required' => 'File Profile harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'nim.required' => 'NIM harus diisi.',
            'angkatan.required' => 'Angkatan harus diisi.',
            'status.required' => 'Status harus diisi.',
            'jalur_masuk.required' => 'Jalur Masuk harus diisi.',
            'handphone.required' => 'Handphone harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'alamat.required' => 'Alamat harus diisi.',
            'provinsi.required' => 'Provinsi harus diisi.',
            'provinsi.exists' => 'Provinsi tidak terdaftar.',
            'kabupatenkota.required' => 'Kabupaten/Kota harus diisi.',
            'kabupatenkota.exists' => 'Kabupaten/Kota tidak terdaftar.',
            'dosen_wali.required' => 'Dosen Wali harus diisi.',
            'dosen_wali.exists' => 'Dosen Wali tidak terdaftar.',
        ]);

        $temp = tb_temp_file::where('path', $request->fileProfile)->first();

        // Update to DB
        tb_mahasiswa::where('nim', $id)->update([
            'nama' => $request->nama,
            'handphone' => $request->handphone,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'kode_prov' => $request->provinsi,
            'kode_kab' => $request->kabupatenkota,
            'kode_wali' => $request->dosen_wali,
        ]);
        User::where('nim_nip', $id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        // if found nim on tb_entry_progresses
        if (tb_entry_progress::where('nim', $id)->first()) {
            // Update tb_entry_progresses
            tb_entry_progress::where('nim', $id)->update([
                'nip' => $request->dosen_wali,
            ]);
        }

        if ($temp && $request->fileProfile != null) {
            if (tb_mahasiswa::where('nim', $id)->first()->foto != null) {
                unlink(tb_mahasiswa::where('nim', $id)->first()->foto);
            }
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->path), public_path('files/profile/' . $id . '_' . $uniq . '.jpg'));
            tb_mahasiswa::where('nim', $id)->update([
                'foto' => 'files/profile/' . $id . '_' . $uniq . '.jpg',
            ]);
            $temp->delete();
        }

        Alert::success('Berhasil', 'Data berhasil disimpan');
        if ($request->fileProfile != null) {
            return redirect()->route('home');
        } else {
            return redirect()->route('edit_profile_mahasiswa.index');
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
