<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candi extends Model
{
    protected $table = "candi";

    protected $fillable = [
        'nama', 'alamat', 'keterangan', 'file'
    ];

    public function monev_batu(){
        return $this->hasMany('App\MonevBatu');
    }

    public function titik_kontrol(){
        return $this->hasMany('App\TitikKontrol');
    }

    public function kemiringan_dinding(){
        return $this->hasMany('App\KemiringanDinding');
    }

    public function monev_lingkungan(){
        return $this->hasMany('App\MonevLingkungan');
    }

    public function monev_kawasan(){
        return $this->hasMany('App\MonevKawasan');
    }

    public function monev_pemanfatan(){
        return $this->hasMany('App\MonevPemanfaatan');
    }

    public function monev_stabilitas(){
        return $this->hasMany('App\MonevStabilitas');
    }


    public function perawatan(){
        return $this->hasMany('App\MonevPerawatan');
    }
}
