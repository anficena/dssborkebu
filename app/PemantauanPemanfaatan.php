<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemantauanPemanfaatan extends Model
{
    protected $table = "pemantauan_pemanfaatan";

    protected $fillable = [
        'observasi_id', 'user_id', 'keterangan', 'file'
    ];
}
