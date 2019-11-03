<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaterMater extends Model
{
    protected $table = "water_mater";

    protected $fillable = [
        'observasi_id', 'user_id', 'waktu', 'lokasi', 'wmk', 'wmb', 'keterangan', 'photo'
    ];

    public function monev_geohidrologi(){
        return $this->belongsTo('App\MonevGeohidrologi', 'observasi_id');
    }
}
