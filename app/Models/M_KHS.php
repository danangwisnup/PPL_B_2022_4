<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_KHS extends Model
{
    use HasFactory;

    protected $table = 'tb_khs';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'semester_aktif',    
        'sks',
        'sks_kumulatif',
        'ip', 
        'ip_kumulatif',    
        'status',
        'upload_khs',
    ];
}
