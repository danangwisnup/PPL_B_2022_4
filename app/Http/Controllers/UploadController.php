<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tb_dosen;
use App\Models\tb_mahasiswa;
use App\Models\tb_irs;
use App\Models\tb_khs;
use App\Models\tb_pkl;
use App\Models\tb_skripsi;
use App\Models\tb_temp_file;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $file->move('files/temp/' . '', $name);

            if (tb_temp_file::where('path', $name)->first() == null) {
                tb_temp_file::create([
                    'folder' => '',
                    'path' => $name,
                ]);
            }

            return $name;
        }

        if ($request->hasFile('fileEdit')) {
            $file = $request->file('fileEdit');
            $name = $file->getClientOriginalName();
            $file->move('files/temp/' . '', $name);

            if (tb_temp_file::where('path', $name)->first() == null) {
                tb_temp_file::create([
                    'folder' => '',
                    'path' => $name,
                ]);
            }

            return $name;
        }

        if ($request->hasFile('fileProfile')) {
            $file = $request->file('fileProfile');
            $name = $file->getClientOriginalName();
            $file->move('files/temp/' . '', $name);

            if (tb_temp_file::where('path', $name)->first() == null) {
                tb_temp_file::create([
                    'folder' => '',
                    'path' => $name,
                ]);
            }

            return $name;
        }
    }
}
