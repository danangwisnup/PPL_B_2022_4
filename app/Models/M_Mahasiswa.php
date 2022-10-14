<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'tb_mahasiswa';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'nama',
        'angkatan',
        'status',
    ];
}
