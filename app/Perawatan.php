<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    protected $table = "perawatan";

    protected $fillable = [
        'candi_id', 'user_id', 'aktivitas', 'tanggal', 'kategori', 'deskripsi', 'lokasi', 'gambar'
    ];

    public function candi(){
        return $this->belongsTo('App\Candi');
    }
}
