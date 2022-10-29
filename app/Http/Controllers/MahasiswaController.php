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
        $mahasiswa = tb_mahasiswa::latest()->paginate(5);
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
        // 24060120120120
        // 01234567890123
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
        tb_mahasiswa::insert([
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
        $mahasiswa = tb_mahasiswa::where('nim', $id)->first();
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
        tb_mahasiswa::where('nim', $id)->update($data);

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
        tb_mahasiswa::where('nim', $id)->delete();
        User::where('nim_nip', $id)->delete();

        // Alert success
        Alert::success('Success!', 'Data mahasiswa berhasil dihapus');
        return redirect()->route('user_manajemen');
    }

    public function data_mahasiswa()
    {
        $mahasiswaAll = tb_mahasiswa::all();
        return view('department.data_mhs.index', [
            'title' => 'Data Mahasiswa',
        ])->with(compact('mahasiswaAll'));
    }

    public function data_mahasiswa_detail(Request $request)
    {
        $mahasiswa = tb_mahasiswa::where('nim', $request->nim)->first();
        if ($mahasiswa->kode_kab != null or $mahasiswa->kode_prov != null) {
            $kabupaten = tb_kab::where('kode_kab', $mahasiswa->kode_kab)->first();
            $provinsi = tb_prov::where('kode_prov', $mahasiswa->kode_prov)->first();
            return view('department.data_mhs.detail', [
                'title' => 'Data Mahasiswa Detail',
            ])->with(compact('mahasiswa', 'kabupaten', 'provinsi'));
        } else {
            Alert::error('Error!', 'Data Mahasiswa tidak lengkap');
            return redirect()->back();
        }
    }

    public function data_pkl()
    {
        // sort by nim
        $mahasiswaAll = tb_mahasiswa::orderBy('angkatan', 'asc')->get();
        $mahasiswaPKL = tb_mahasiswa::join('tb_pkls', function ($join) {
            $join->on('tb_mahasiswas.nim', '=', 'tb_pkls.nim')
                ->where('tb_pkls.semester_aktif', '=', DB::raw('(select max(semester_aktif) from tb_pkls where nim = tb_mahasiswas.nim)'));
        })->join('tb_entry_progresses', function ($join) {
            $join->on('tb_pkls.nim', '=', 'tb_entry_progresses.nim')
                ->where('tb_entry_progresses.is_pkl', '=', 1)
                ->where('tb_entry_progresses.is_verifikasi', '=', '1')
                ->where('tb_entry_progresses.semester_aktif', '=', DB::raw('(select max(semester_aktif) from tb_pkls where nim = tb_entry_progresses.nim)'));
        })->select('tb_mahasiswas.nim', 'tb_mahasiswas.nama', 'tb_mahasiswas.angkatan', 'tb_pkls.semester_aktif', 'tb_pkls.nilai', 'tb_pkls.status')
            ->get();

        return view('department.data_pkl.index', [
            'title' => 'Data Mahasiswa PKL',
        ])->with(compact('mahasiswaAll', 'mahasiswaPKL'));
    }

    public function data_skripsi()
    {
        $mahasiswaAll = tb_mahasiswa::orderBy('angkatan', 'asc')->get();
        $mahasiswaSkripsi = tb_mahasiswa::join('tb_skripsis', function ($join) {
            $join->on('tb_mahasiswas.nim', '=', 'tb_skripsis.nim')
                ->where('tb_skripsis.semester_aktif', '=', DB::raw('(select max(semester_aktif) from tb_skripsis where nim = tb_mahasiswas.nim)'));
        })->join('tb_entry_progresses', function ($join) {
            $join->on('tb_skripsis.nim', '=', 'tb_entry_progresses.nim')
                ->where('tb_entry_progresses.is_skripsi', '=', 1)
                ->where('tb_entry_progresses.is_verifikasi', '=', '1')
                ->where('tb_entry_progresses.semester_aktif', '=', DB::raw('(select max(semester_aktif) from tb_skripsis where nim = tb_entry_progresses.nim)'));
        })->select('tb_mahasiswas.nim', 'tb_mahasiswas.nama', 'tb_mahasiswas.angkatan', 'tb_skripsis.semester_aktif', 'tb_skripsis.nilai', 'tb_skripsis.status')
            ->get();

        return view('department.data_skripsi.index', [
            'title' => 'Data Mahasiswa Skripsi',
        ])->with(compact('mahasiswaAll', 'mahasiswaSkripsi'));
    }
}
