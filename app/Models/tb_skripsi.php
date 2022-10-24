<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_skripsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'semester_aktif',
        'nilai',
        'tanggal_sidang',
        'lama_studi',
        'status',
        'upload_skripsi',
    ];

    public $timestamps = false;
}
