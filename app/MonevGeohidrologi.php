<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonevGeohidrologi extends Model
{
    protected $table = "monev_geohidrologi";

    protected $fillable = [
        'candi_id', 'user_id', 'judul', 'tujuan', 'sasaran', 'target', 'metode', 'mulai', 'selesai', 'hasil', 'file'
    ];

    public function candi(){
        return $this->belongsTo('App\Candi');
    }

    public function kedalaman_sumur(){
        return $this->hasMany('App\KedalamanSumur');
    }

    public function sumur_resapan(){
        return $this->hasMany('App\SumurResapan');
    }

    public function water_mater(){
        return $this->hasMany('App\WaterMater');
    }

    public function filter_layer(){
        return $this->hasMany('App\FilterLayer');
    }
}
