<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tb_dosen;
use App\Models\tb_mahasiswa;
use App\Models\tb_irs;
use App\Models\tb_khs;
use App\Models\tb_pkl;
use App\Models\tb_skripsi;
use App\Models\tb_temp_file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        // Validate the request...
        $data = $request->validate([
            'nip' => 'required|string|unique:users,nim_nip',
            'nama' => 'required|string',
            'email' => 'required|email||unique:users,email',
            'status' => 'required',
        ]);

        $data = $request->except(['_token']);

        // Insert to table dosen & users
        tb_dosen::insert($data);
        User::insert([
            'nim_nip' => $request->nip,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->nip),
            'role' => 'dosen',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Alert success
        Alert::success('Success!', 'Data Dosen Berhasil Ditambahkan');

        return redirect()->route('user_manajemen');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tb_dosen  $tb_dosen
     * @return \Illuminate\Http\Response
     */
    public function show(tb_dosen $tb_dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find where nip table dosen
        $dosen = tb_dosen::where('nip', $id)->first();
        $user = User::where('nim_nip', $id)->first();
        return view('operator.manajemen_user.modal.edit_dosen', compact('dosen'), compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id . ',nim_nip',
            'status' => 'required',
        ]);

        // Update to table dosen & users
        tb_dosen::where('nip', $id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        if ($request->password == '') {
            $data = $request->only(['nama', 'email']);
        } else {
            $data = $request->only(['nama', 'email', 'password']);
            $data['password'] = bcrypt($request->password);
        }
        User::where('nim_nip', $id)->update($data);

        // Alert success
        Alert::success('Success!', 'Data Dosen Berhasil Diupdate');

        return redirect()->route('user_manajemen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete to table Dosen & users
        tb_dosen::where('nip', '=', $id)->delete();
        User::where('nim_nip', '=', $id)->delete();

        // Alert success
        Alert::success('Success!', 'Data Dosen Berhasil Dihapus');

        return redirect()->route('user_manajemen');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data_dosen()
    {
        $dosenAll = tb_dosen::all();
        return view('department.data_dosen.index', [
            'title' => 'Data Dosen',
        ])->with(compact('dosenAll'));
    }

    public function data_dosen_detail(Request $request)
    {
        $dosen = tb_dosen::where('nip', $request->nip)->first();
        return view('department.data_dosen.detail', [
            'title' => 'Data Dosen Detail',
        ])->with(compact('dosen'));
    }
}
