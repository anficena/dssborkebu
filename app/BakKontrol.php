<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BakKontrol extends Model
{
    protected $table = "bak_kontrol";

    protected $fillable = [
        'observasi_id', 'user_id', 'waktu', 'kategori', 'parameter', 'satuan', 'lokasi', 'hasil', 'standar'
    ];

    public function monev_lingkungan(){
        return $this->belongsTo('App\Monevlingkungan', 'observasi_id');
    }
}
