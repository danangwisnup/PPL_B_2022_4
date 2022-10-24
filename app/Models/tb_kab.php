<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_kab extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kab',
        'nama_kab',
        'kode_prov',
    ];

    public $timestamps = false;
}
