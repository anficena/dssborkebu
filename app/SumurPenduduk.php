<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SumurPenduduk extends Model
{
    protected $table = "sumur_penduduk";

    protected $fillable = [
        'observasi_id', 'user_id', 'waktu', 'parameter', 'satuan', 'lokasi', 'hasil', 'standar'
    ];

    public function monev_lingkungan(){
        return $this->belongsTo('App\MonevLingkungan', 'observasi_id');
    }
}
