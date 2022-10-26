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
            $name = time() . $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->move('files/temp/' . $folder, $name);

            tb_temp_file::create([
                'folder' => $folder,
                'path' => $name,
            ]);

            return $name;
        }

        if ($request->hasFile('fileEdit')) {
            $file = $request->file('fileEdit');
            $name = time() . $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->move('files/temp/' . $folder, $name);

            tb_temp_file::create([
                'folder' => $folder,
                'path' => $name,
            ]);

            return $name;
        }

        if ($request->hasFile('fileProfile')) {
            $file = $request->file('fileProfile');
            $name = $file->getClientOriginalName();
            $folder = '';
            $file->move('files/temp/' . $folder, $name);

            tb_temp_file::create([
                'folder' => $folder,
                'path' => $name,
            ]);

            //$resultLocation = 'http://' . $_SERVER['HTTP_HOST'] . '/files/temp/' . $folder . '/' . $name;
            return $name;
        }
    }
}
