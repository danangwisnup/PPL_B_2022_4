<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\tb_dosen;
use Illuminate\Http\Request;

class EditProfileDosen
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
        if ($request->user()->role == 'dosen') {
            if (tb_dosen::where('nip', $request->user()->nim_nip)->first()->alamat == null) {
                return redirect('/dosen/edit_profile_dosen');
            } else if (tb_dosen::where('nip', $request->user()->nim_nip)->first()->kode_kab == null) {
                return redirect('/dosen/edit_profile_dosen');
            } else if (tb_dosen::where('nip', $request->user()->nim_nip)->first()->kode_prov == null) {
                return redirect('/dosen/edit_profile_dosen');
            } else if (tb_dosen::where('nip', $request->user()->nim_nip)->first()->email == null) {
                return redirect('/dosen/edit_profile_dosen');
            } else if (tb_dosen::where('nip', $request->user()->nim_nip)->first()->handphone == null) {
                return redirect('/dosen/edit_profile_dosen');
            } else if (tb_dosen::where('nip', $request->user()->nim_nip)->first()->foto == null) {
                return redirect('/dosen/edit_profile_dosen');
            } else {
                return $next($request);
            }
        } else {
            return $next($request);
        }
    }
}
