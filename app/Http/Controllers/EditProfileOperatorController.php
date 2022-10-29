<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tb_dosen;
use App\Models\tb_kab;
use App\Models\tb_prov;
use App\Models\tb_temp_file;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class EditProfileOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operator = User::where('nim_nip', Auth::user()->nim_nip)->first();

        return view('operator.edit_profile', [
            'title' => 'Edit Profile',
        ])->with(compact('operator'));
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
            'nama' => 'required|string',
            'email' =>
            [
                'required', 'email', 'max:255', Rule::unique('users')->ignore($id, 'nim_nip'),
            ],
        ]);

        // Update to DB
        User::where('nim_nip', $id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        Alert::success('Berhasil', 'Data berhasil disimpan');
        return redirect('/operator/edit_profile');
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
