<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mow extends Model
{
    protected $table = "mow";

    protected $fillable = [
        'dokumentasi_id', 'koleksi', 'jumlah', 'terkonservasi', 'tindakan'
    ];

    public function dokumentasi(){
        return $this->belongsTo('App\Dokumentasi','dokumentasi_id');
    }
}
