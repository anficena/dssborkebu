<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KepuasanPengunjung extends Model
{
    protected $table = "kepuasan_pengunjung";

    protected $fillable = [
        'observasi_id', 'user_id', 'keterangan', 'file'
    ];
}
