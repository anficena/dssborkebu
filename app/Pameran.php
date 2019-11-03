<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pameran extends Model
{
    protected $table = "pameran";

    protected $fillable = [
        'nama', 'tema', 'tanggal', 'tempat', 'latitude', 'longitude', 'pengunjung', 'photo'
    ];
}
