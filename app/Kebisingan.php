<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kebisingan extends Model
{
    protected $table = "kebisingan";

    protected $fillable = [
        'observasi_id', 'user_id', 'waktu', 'lokasi', 'hasil', 'satuan'
    ];

    public function monev_lingkungan(){
        return $this->belongsTo('App\Monevlingkungan', 'observasi_id');
    }
}
