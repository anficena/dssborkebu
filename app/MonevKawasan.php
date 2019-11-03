<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonevKawasan extends Model
{
    protected $table = "monev_kawasan";

    protected $fillable = [
        'candi_id', 'user_id', 'judul', 'tanggal', 'instansi', 'file', 'keterangan'
    ];

    public function candi(){
        return $this->belongsTo('App\Candi');
    }
}
