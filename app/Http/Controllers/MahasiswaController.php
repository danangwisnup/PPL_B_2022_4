<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\M_Mahasiswa;
use App\Models\M_PKL;
use App\Models\M_Skripsi;
use Illuminate\Http\Request;
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
        $request->validate([
            'nim' => 'required|string|unique:users,nim_nip|min:14|max:14',
            'nama' => 'required|string',
            'status' => 'required',
        ]);

        // Angkatan Mahasiswa
        $angkatan = 20 . substr($request->nim, 6, 2);

        // 12 = SNMPTN
        // 13 = SBMPTN
        // 14 = Ujian Mandiri
        if (substr($request->nim, 8, 2) == '12') {
            $jalur_masuk = 'SNMPTN';
        } elseif (substr($request->nim, 8, 2) == '13') {
            $jalur_masuk = 'SBMPTN';
        } elseif (substr($request->nim, 8, 2) == '14') {
            $jalur_masuk = 'Ujian Mandiri';
        } else {
            $jalur_masuk = 'SBUB';
        }

        // Insert to table mahasiswa & users
        M_Mahasiswa::insert([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $angkatan,
            'status' => $request->status,
            'jalur_masuk' => $jalur_masuk,
        ]);

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
            'status' => 'required',
        ]);

        // Update to table mahasiswa & users
        if ($request->email == '') {
            $data = $request->except(['_token', '_method', 'password', 'email']);
        } else {
            $request->validate([
                'email' => 'unique:users,email,' . $id . ',nim_nip',
            ]);
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

    public function data_mahasiswa()
    {
        $mahasiswaAll = M_Mahasiswa::all();
        return view('dosen.data_mhs.index', [
            'title' => 'Data Mahasiswa',
        ])->with(compact('mahasiswaAll'));
    }

    public function data_pkl()
    {
        $mahasiswaAll = M_Mahasiswa::all();
        $mahasiswaPKL = M_PKL::all();
        return view('dosen.data_pkl.index', [
            'title' => 'Data Mahasiswa PKL',
        ])->with(compact('mahasiswaAll', 'mahasiswaPKL'));
    }

    public function data_skripi()
    {
        $mahasiswaAll = M_Mahasiswa::all();
        $mahasiswaSkripsi = M_Skripsi::all();
        return view('dosen.data_skripsi.index', [
            'title' => 'Data Mahasiswa Skripsi',
        ])->with(compact('mahasiswaAll', 'mahasiswaSkripsi'));
    }
}
