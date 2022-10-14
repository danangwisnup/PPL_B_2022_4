<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_IRS extends Model
{
    use HasFactory;

    protected $table = 'tb_irs';
    public $timestamps = false;
    
    protected $fillable = [
        'nim',
        'semester_aktif',
        'sks',
        'status',
        'upload_irs',
    ];
}
