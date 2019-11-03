<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilterLayer extends Model
{
    protected $table = "filter_layer";

    protected $fillable = [
        'observasi_id', 'user_id', 'waktu', 'lokasi', 'keterangan', 'photo'
    ];

    public function monev_geohidrologi(){
        return $this->belongsTo('App\MonevGeohidrologi', 'observasi_id');
    }
}
