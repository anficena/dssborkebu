<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KedalamanSumur extends Model
{
    protected $table = "kedalaman_sumur";

    protected $fillable = [
        'observasi_id', 'user_id', 'waktu', 'lokasi', 'kedalaman', 'kondisi', 'photo'
    ];

    public function monev_geohidrologi(){
        return $this->belongsTo('App\MonevGeohidrologi', 'observasi_id');
    }
}
