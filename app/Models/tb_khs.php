<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_khs extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'semester_aktif',
        'sks',
        'sks_kumulatif',
        'ip',
        'ip_kumulatif',
        'upload_khs',
    ];

    public $timestamps = false;
}
