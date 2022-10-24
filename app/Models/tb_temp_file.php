<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_temp_file extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder',
        'path',
    ];
}
