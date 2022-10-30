<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_dosen extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'alamat',
        'kode_kab',
        'kode_prov',
        'handphone',
        'status',
        'foto',
    ];

    public $timestamps = false;
}
