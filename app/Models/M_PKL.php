<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_PKL extends Model
{
    use HasFactory;

    protected $table = 'tb_pkl';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'semester_aktif',
        'nilai',
        'status',
        'upload_pkl',
    ];
}
