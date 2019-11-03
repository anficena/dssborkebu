<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KualitasUdara extends Model
{
    protected $table = "kualitas_udara";

    protected $fillable = [
        'observasi_id', 'user_id', 'waktu', 'lokasi', 'parameter', 'hasil', 'satuan'
    ];

    public function monev_lingkungan(){
        return $this->belongsTo('App\Monevlingkungan', 'observasi_id');
    }
}
