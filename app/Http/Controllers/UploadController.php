<?php

namespace App\Http\Controllers;

use App\Models\M_TempFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->move('files/temp/' . $folder, $name);

            M_TempFile::create([
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

            M_TempFile::create([
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

            M_TempFile::create([
                'folder' => $folder,
                'path' => $name,
            ]);

            //$resultLocation = 'http://' . $_SERVER['HTTP_HOST'] . '/files/temp/' . $folder . '/' . $name;
            return $name;
        }
    }
}
