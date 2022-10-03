<?php

namespace App\Http\Controllers;

use App\Models\M_Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

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
        $User = M_Mahasiswa::all();
        return view('operator.manajemen_user', [
            'title' => 'Manajemen User',
        ])->with('mahasiswa', $User);
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

        // Insert to table mahasiswa
        M_Mahasiswa::insert($data);

        // Insert to table users
        User::insert([
            'nim/nip' => $request->nim,
            'nama' => $request->nama,
            'password' => bcrypt($request->nim),
            'role' => 'mahasiswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('user_manajemen')->with('success', 'Mahasiswa berhasil ditambahkan!');
    }
}
