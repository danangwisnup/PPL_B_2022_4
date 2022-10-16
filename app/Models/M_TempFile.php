<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_TempFile extends Model
{
    use HasFactory;

    protected $table = 'tb_temp_file';

    protected $fillable = [
        'folder',
        'path',
    ];
}
