<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayananAduan extends Model
{
    protected $table = "layanan_aduan";

    protected $fillable = [
        'user_id', 'tanggal', 'tamu', 
        'telephone', 'alamat', 'keperluan', 'tindakan'
    ];
}
