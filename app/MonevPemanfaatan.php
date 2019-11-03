<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonevPemanfaatan extends Model
{
    protected $table = "monev_pemanfaatan";

    protected $fillable = [
        'candi_id', 'user_id', 'judul', 'tujuan', 'sasaran', 'target', 'metode', 'mulai', 'selesai', 'hasil', 'file'
    ];

    public function candi(){
        return $this->belongsTo('App\Candi');
    }

    public function tingkat_pengunjung(){
        return $this->hasMany('App\TingkatPengunjung');
    }
}
