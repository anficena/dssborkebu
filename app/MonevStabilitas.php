<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonevStabilitas extends Model
{
    protected $table = "monev_stabilitas";

    protected $fillable = [
        'candi_id', 'user_id', 'judul', 'tanggal', 'pengertian', 'spesifikasi', 'pedoman', 'photo', 'gambar_kerja', 'referensi'
    ];

    public function candi(){
        return $this->belongsTo('App\Candi');
    }

    public function titik_kontrol(){
        return $this->belongsTo('App\TitikKontrol');
    }

    public function kemirirangan_dinding(){
        return $this->belongsTo('App\KemiringanDinding');
    }
}
