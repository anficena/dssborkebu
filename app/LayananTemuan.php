<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayananTemuan extends Model
{
    protected $table = "layanan_temuan";

    protected $fillable = [
        'user_id', 'tanggal', 'jenis_temuan', 
        'penemu', 'alamat', 'bentuk', 'kompensasi'
    ];
}
