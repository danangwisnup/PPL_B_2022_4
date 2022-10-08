<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\M_Mahasiswa;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;
use RealRashid\SweetAlert\Facades\Alert;


class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = M_Mahasiswa::latest()->paginate(5);
        return view('operator.manajemen_user', compact('mahasiswa'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
            'nim' => 'required|string|unique:users,nim_nip',
            'nama' => 'required|string',
            'angkatan' => 'required|numeric',
            'jalur_masuk' => 'required',
        ]);

        $data = $request->except(['_token']);

        // Insert to table mahasiswa & users
        M_Mahasiswa::insert($data);
        User::insert([
            'nim_nip' => $request->nim,
            'nama' => $request->nama,
            'password' => bcrypt($request->nim),
            'role' => 'mahasiswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Alert success
        Alert::success('Success!', 'Data mahasiswa berhasil ditambahkan');

        return redirect()->route('user_manajemen');
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find where nim table mahasiswa
        $mahasiswa = M_Mahasiswa::where('nim', $id)->first();
        $user = User::where('nim_nip', $id)->first();
        return view('operator.manajemen_user.modal.edit_mahasiswa', compact('mahasiswa'), compact('user'));
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
        // 
        $request->validate([
            'nama' => 'required|string',
            'angkatan' => 'required|numeric',
            'jalur_masuk' => 'required',
            'status' => 'required',
        ]);

        // Update to table mahasiswa & users
        if ($request->email == '') {
            $data = $request->except(['_token', '_method', 'password', 'email']);
        } else {
            $data = $request->except(['_token', '_method', 'password']);
        }
        M_Mahasiswa::where('nim', $id)->update($data);

        if ($request->password == '') {
            $data = $request->only(['nama', 'email']);
        } else {
            $data = $request->only(['nama', 'email', 'password']);
            $data['password'] = bcrypt($request->password);
        }
        User::where('nim_nip', $id)->update($data);

        // Alert success
        Alert::success('Success!', 'Data dosen berhasil diupdate');

        return redirect()->route('user_manajemen');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete to table mahasiswa & users
        M_Mahasiswa::where('nim', $id)->delete();
        User::where('nim_nip', $id)->delete();

        // Alert success
        Alert::success('Success!', 'Data mahasiswa berhasil dihapus');
        return redirect()->route('user_manajemen');
    }
}
