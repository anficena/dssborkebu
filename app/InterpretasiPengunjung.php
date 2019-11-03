<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterpretasiPengunjung extends Model
{
    protected $table = "interpretasi_pengunjung";

    protected $fillable = [
        'observasi_id', 'user_id', 'keterangan', 'file'
    ];
}
