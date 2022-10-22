<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_EntryProgress extends Model
{
    use HasFactory;

    protected $table = 'tb_entry_progress';

    protected $fillable = [
        'semester_aktif',
        'nim',
        'nip',
    ];
}
