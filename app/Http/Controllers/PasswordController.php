<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tb_dosen;
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
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('nim_nip',  Auth::user()->nim_nip)->first();
        $dosen = tb_dosen::where('nip',  Auth::user()->nim_nip)->first();
        $mahasiswa = tb_mahasiswa::where('nim',  Auth::user()->nim_nip)->first();
        $department = User::where('nim_nip',  Auth::user()->nim_nip)->first();
        $operator = User::where('nim_nip',  Auth::user()->nim_nip)->first();
        return view('change_password.index', [
            'title' => 'Change Password',
        ])->with(compact('user', 'dosen', 'mahasiswa', 'department', 'operator'));
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
            // olf password must same with password in database
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Password lama tidak sama');
                    }
                },
            ],
            'new_password' => 'required|string',
            'ver_password' => 'required|string|same:new_password',
        ], [
            'old_password.required' => 'Password lama tidak boleh kosong',
            'new_password.required' => 'Password baru tidak boleh kosong',
            'ver_password.required' => 'Verifikasi password tidak boleh kosong',
            'ver_password.same' => 'Verifikasi password tidak sama dengan password baru',
        ]);


        User::where('nim_nip', $id)->update([
            'password' => bcrypt($request->new_password),
        ]);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect()->route('change_password.index');
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
