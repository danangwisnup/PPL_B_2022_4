<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\M_Mahasiswa;
use App\Models\M_PKL;
use App\Models\M_Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        return view('department.data_mhs.index', [
            'title' => 'Data Mahasiswa',
        ])->with(compact('mahasiswaAll'));
    }

    public function data_mahasiswa_detail(Request $request)
    {
        $mahasiswa = M_Mahasiswa::where('nim', $request->nim)->first();
        if ($mahasiswa->kode_kab != null or $mahasiswa->kode_prov != null) {
            $kabupaten = DB::table('tb_kabupaten')->where('kode_kab', $mahasiswa->kode_kab)->first();
            $provinsi = DB::table('tb_provinsi')->where('kode_prov', $mahasiswa->kode_prov)->first();
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
        $mahasiswaAll = M_Mahasiswa::orderBy('angkatan', 'asc')->get();
        $mahasiswaPKL = DB::table('tb_mahasiswa')
            ->join('tb_pkl', function ($join) {
                $join->on('tb_mahasiswa.nim', '=', 'tb_pkl.nim')
                    ->where('tb_pkl.semester_aktif', '=', DB::raw('(select max(semester_aktif) from tb_pkl where nim = tb_mahasiswa.nim)'));
            })->join('tb_entry_progress', function ($join) {
                $join->on('tb_pkl.nim', '=', 'tb_entry_progress.nim')
                    ->where('tb_entry_progress.is_pkl', '=', 1)
                    ->where('tb_entry_progress.is_verifikasi', '=', '1')
                    ->where('tb_entry_progress.semester_aktif', '=', DB::raw('(select max(semester_aktif) from tb_pkl where nim = tb_entry_progress.nim)'));
            })
            ->select('tb_mahasiswa.nim', 'tb_mahasiswa.nama', 'tb_mahasiswa.angkatan', 'tb_pkl.semester_aktif', 'tb_pkl.nilai', 'tb_pkl.status')
            ->get();

        return view('department.data_pkl.index', [
            'title' => 'Data Mahasiswa PKL',
        ])->with(compact('mahasiswaAll', 'mahasiswaPKL'));
    }

    public function data_skripsi()
    {
        $mahasiswaAll = M_Mahasiswa::orderBy('angkatan', 'asc')->get();
        $mahasiswaSkripsi = DB::table('tb_mahasiswa')
            ->join('tb_skripsi', function ($join) {
                $join->on('tb_mahasiswa.nim', '=', 'tb_skripsi.nim')
                    ->where('tb_skripsi.semester_aktif', '=', DB::raw('(select max(semester_aktif) from tb_skripsi where nim = tb_mahasiswa.nim)'));
            })->join('tb_entry_progress', function ($join) {
                $join->on('tb_skripsi.nim', '=', 'tb_entry_progress.nim')
                    ->where('tb_entry_progress.is_skripsi', '=', 1)
                    ->where('tb_entry_progress.is_verifikasi', '=', '1')
                    ->where('tb_entry_progress.semester_aktif', '=', DB::raw('(select max(semester_aktif) from tb_skripsi where nim = tb_entry_progress.nim)'));
            })
            ->select('tb_mahasiswa.nim', 'tb_mahasiswa.nama', 'tb_mahasiswa.angkatan', 'tb_skripsi.semester_aktif', 'tb_skripsi.nilai', 'tb_skripsi.status')
            ->get();

        return view('department.data_skripsi.index', [
            'title' => 'Data Mahasiswa Skripsi',
        ])->with(compact('mahasiswaAll', 'mahasiswaSkripsi'));
    }
}
