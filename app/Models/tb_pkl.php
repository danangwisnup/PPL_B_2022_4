<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_pkl extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'semester_aktif',
        'nilai',
        'status',
        'upload_pkl',
    ];

    public $timestamps = false;
}
