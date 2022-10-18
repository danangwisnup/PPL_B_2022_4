<?php

namespace App\Http\Middleware;

use App\Models\M_EntryProgress;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IRS
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
        $countSemsester = M_EntryProgress::where('nim', Auth::user()->nim_nip)->count();
        if (M_EntryProgress::where('nim', Auth::user()->nim_nip)
            ->where('semester_aktif', $countSemsester)
            ->where('is_irs', 1)->exists()
        ) {
            return redirect('mahasiswa/entry/khs');
        } else if (M_EntryProgress::where('nim', Auth::user()->nim_nip)->count() == 0) {
            return redirect('mahasiswa/entry');
        } else {
            return $next($request);
        }
    }
}
