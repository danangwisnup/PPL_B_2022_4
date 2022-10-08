<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    public $timestamps = false;
    protected $primaryKey = 'nip';
    
    protected $fillable = [
        'nip',
        'nama',
    ];
    
}
