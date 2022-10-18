<?php

namespace App\Http\Middleware;

use App\Models\M_Mahasiswa;
use Closure;
use Illuminate\Http\Request;

class EditProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // role dosen
        if ($request->user()->role == 'mahasiswa') {
            if (M_Mahasiswa::where('nim', $request->user()->nim_nip)->first()->alamat == null) {
                return redirect('/mahasiswa/edit_profile');
            } else if (M_Mahasiswa::where('nim', $request->user()->nim_nip)->first()->kode_kab == null) {
                return redirect('/mahasiswa/edit_profile');
            } else if (M_Mahasiswa::where('nim', $request->user()->nim_nip)->first()->kode_prov == null) {
                return redirect('/mahasiswa/edit_profile');
            } else if (M_Mahasiswa::where('nim', $request->user()->nim_nip)->first()->email == null) {
                return redirect('/mahasiswa/edit_profile');
            } else if (M_Mahasiswa::where('nim', $request->user()->nim_nip)->first()->handphone == null) {
                return redirect('/mahasiswa/edit_profile');
            } else if (M_Mahasiswa::where('nim', $request->user()->nim_nip)->first()->kode_wali == null) {
                return redirect('/mahasiswa/edit_profile');
            } else if (M_Mahasiswa::where('nim', $request->user()->nim_nip)->first()->foto == null) {
                return redirect('/mahasiswa/edit_profile');
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
