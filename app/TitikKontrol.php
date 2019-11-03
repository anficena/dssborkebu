<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TitikKontrol extends Model
{
    protected $table = "titik_kontrol";

    protected $fillable = [
        'observasi_id', 'user_id', 'tanggal', 'nama_koordinat', 'titik', 'sumbu_x', 'sumbu_y', 'sumbu_z'
    ];

    public function candi(){
        return $this->belongsTo('App\Candi','observasi_id');
    }
}
