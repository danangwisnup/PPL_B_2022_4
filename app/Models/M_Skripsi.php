<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Skripsi extends Model
{
    use HasFactory;

    protected $table = 'tb_skripsi';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'semester_aktif',
        'nilai',
        'tanggal_sidang',
        'lama_studi',
        'status',
        'upload_skripsi',
    ];
}
