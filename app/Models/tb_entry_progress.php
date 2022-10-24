<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_entry_progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nip',
        'semester_aktif',
        'is_irs',
        'is_khs',
        'is_pkl',
        'is_skripsi',
        'is_verifikasi',
    ];
}
