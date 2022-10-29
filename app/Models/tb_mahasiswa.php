<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama',
        'alamat',
        'kode_kab',
        'kode_prov',
        'angkatan',
        'jalur_masuk',
        'email',
        'handphone',
        'kode_wali',
        'status',
        'foto',
    ];

    public $timestamps = false;
}
