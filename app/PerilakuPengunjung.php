<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerilakuPengunjung extends Model
{
    protected $table = "perilaku_pengunjung";

    protected $fillable = [
        'observasi_id', 'user_id', 'keterangan', 'file'
    ];
}
