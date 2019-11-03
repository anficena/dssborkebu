<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KemiringanDinding extends Model
{
    protected $table = "kemiringan_dinding";

    protected $fillable = [
        'observasi_id', 'user_id', 'tanggal', 'lokasi', 'titik', 
        'sumbu_xa', 'sumbu_xb', 'sumbu_xh', 
        'sumbu_ya', 'sumbu_yb', 'sumbu_yh',
        'kemiringan_x', 'kemiringan_y',
        'pedoman_x', 'pedoman_y',
        'selisih_x', 'selisih_y',
        'keterangan'
    ];

    public function candi(){
        return $this->belongsTo('App\Candi','observasi_id');
    }
}
