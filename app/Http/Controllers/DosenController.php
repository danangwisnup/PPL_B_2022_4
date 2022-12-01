<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\tb_dosen;
use App\Models\tb_skripsi;
use App\Models\tb_mahasiswa;
use App\Models\tb_temp_file;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DosenImport;
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
            'email' => 'required|email|unique:users,email',
            'status' => 'required',
        ], [
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP sudah terdaftar',
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'status.required' => 'Status tidak boleh kosong',
        ]);

        $data = $request->except(['_token']);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

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

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Alert success
        Alert::success('Success!', 'Data Dosen Berhasil Ditambahkan');

        return redirect()->route('manage_users');
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
        return view('operator.manage_users.modal.edit_dosen', compact('dosen'), compact('user'));
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
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'status.required' => 'Status tidak boleh kosong',
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

        return redirect()->route('manage_users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // find where nim table dosen
        if ($id == 'all') {
            return view('operator.manage_users.modal.delete_all_dosen');
        } else {
            $dosen = tb_dosen::where('nip', $id)->first();
            return view('operator.manage_users.modal.delete_dosen', compact('dosen'));
        }
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
        if ($id == 'all') {
            User::where('role', 'dosen')->delete();
            tb_dosen::where('nip', '!=', '')->delete();
        } else {
            User::where('nim_nip', $id)->delete();
            tb_dosen::where('nip', $id)->delete();
        }

        // Alert success
        Alert::success('Success!', 'Data Dosen Berhasil Dihapus');

        return redirect()->route('manage_users');
    }

    // bulk
    public function bulk(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ], [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File harus berformat xlsx, xls, atau csv',
        ]);

        Excel::import(new DosenImport, $request->file('file'));

        // Alert success
        Alert::success('Success!', 'Data dosen berhasil ditambahkan');

        return redirect()->route('manage_users');
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
