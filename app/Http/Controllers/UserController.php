<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\M_Mahasiswa;
use App\Models\M_Dosen;

class UserController extends Controller
{
    public function add_user()
    {
        return view('operator.add_user', [
            'title' => 'Add User',
        ]);
    }

    public function manajemen_user()
    {
        $Mahasiswa = M_Mahasiswa::all();
        $Dosen = User::all()->where('role', 'dosen');
        return view('operator.manajemen_user', [
            'title' => 'Manajemen User',
        ])->with('mahasiswa', $Mahasiswa)->with('dosen', $Dosen);
    }

    public function add_mahasiswa(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|numeric',
            'nama' => 'required|string',
            'angkatan' => 'required|numeric',
            'jalur_masuk' => 'required',
        ]);

        $data = $request->except(['_token']);

        // Insert to table users
        User::insert([
            'nim_nip' => $request->nim,
            'nama' => $request->nama,
            'password' => bcrypt($request->nim),
            'role' => 'mahasiswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert to table mahasiswa
        M_Mahasiswa::insert($data);

        return redirect()->route('user_manajemen')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function add_dosen(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|numeric',
            'nama' => 'required|string',
        ]);

        $data = $request->except(['_token']);

        // Insert to table users
        User::insert([
            'nim_nip' => $request->nip,
            'nama' => $request->nama,
            'password' => bcrypt($request->nip),
            'role' => 'dosen',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert to table dosen
        M_Dosen::insert($data);
        
        return redirect()->route('user_manajemen')->with('success', 'Dosen berhasil ditambahkan!');
    }
}
