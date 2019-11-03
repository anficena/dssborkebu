<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soc extends Model
{
    protected $table = 'soc';

    protected $fillable = [
        'decision_id', 'user_id', 'tanggal', 'decision', 'kategori', 'latitude', 'longitude', 'image', 'file', 'keterangan'
    ];
}
