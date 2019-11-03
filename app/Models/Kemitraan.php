<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kemitraan extends Model
{
    protected $table = 'kemitraan';
    protected $fillable = [
        'mitra', 'koordinator', 'perihal', 'kategori', 'mulai', 'selesai', 'keterangan', 'file'
    ];
    
}
