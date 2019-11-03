<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonevBatu extends Model
{
    protected $table = "monev_batu";

    protected $fillable = [
        'candi_id', 'tanggal', 'jenis_observasi', 'jumlah'
    ];

    public function candi(){
        return $this->belongsTo('App\Candi');
    }
}