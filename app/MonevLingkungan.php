<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonevLingkungan extends Model
{
    protected $table = "monev_lingkungan";

    protected $fillable = [
        'candi_id', 'user_id', 'judul', 'tujuan', 'sasaran', 'target', 'metode', 'mulai', 'selesai', 'hasil', 'file'
    ];

    public function candi(){
        return $this->belongsTo('App\Candi');
    }

    public function observasi_iklim(){
        return $this->hasMany('App\ObservasiIklim');
    }

    public function data_flora(){
        return $this->hasMany('App\DataFlora');
    }

    public function data_fauna(){
        return $this->hasMany('App\DataFauna');
    }

    public function bak_kontrol(){
        return $this->hasMany('App\BakKontrol');
    }

    public function sumur_penduduk(){
        return $this->hasMany('App\SumurPenduduk');
    }

    public function kualitas_udara(){
        return $this->hasMany('App\KualitasUdara');
    }

    public function kebisingan(){
        return $this->hasMany('App\Kebisingan');
    }
    
}
