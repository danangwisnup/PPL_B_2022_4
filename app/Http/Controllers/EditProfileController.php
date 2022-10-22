<?php

namespace App\Http\Controllers;

use App\Models\M_Dosen;
use App\Models\M_Mahasiswa;
use App\Models\M_TempFile;
use App\Models\User;
use Illuminate\Http\Request;
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
        $mahasiswa = M_Mahasiswa::where('nim', Auth::user()->nim_nip)->first();
        $provinsi = DB::table('tb_provinsi')->get();
        $kabupaten = DB::table('tb_kabupaten')->where('kode_prov', $mahasiswa->kode_prov)->get();
        $dosen_wali = M_Dosen::all();

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
                    return M_Mahasiswa::where('nim', Auth::user()->nim_nip)->first()->foto == null;
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
            'provinsi' => 'required',
            'kabupatenkota' => 'required',
            'dosen_wali' => 'required',
        ]);

        $temp = M_TempFile::where('path', $request->fileProfile)->first();

        // Update to DB
        M_Mahasiswa::where('nim', $id)->update([
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
        if ($request->fileProfile != null && M_Mahasiswa::where('nim', $id)->first()->foto != null) {
            unlink(M_Mahasiswa::where('nim', $id)->first()->foto);
        }
        if ($temp && $request->fileProfile != null) {
            $uniq = time() . uniqid();
            rename(public_path('files/temp/' . $temp->path), public_path('files/profile/' . $uniq . '_' . $id . '.jpg'));
            M_Mahasiswa::where('nim', $id)->update([
                'foto' => 'files/profile/' . $uniq . '_' . $id . '.jpg',
            ]);
            $temp->delete();
        }

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('home');
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
