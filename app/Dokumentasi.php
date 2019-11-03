<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = "dokumentasi";

    protected $fillable = [
        'judul', 'kategori', 'thumbnail', 'file', 'link', 'keterangan', 'uploader'
    ];

    public function mow(){
        return $this->hasMany('App\Mow');
    }
}
