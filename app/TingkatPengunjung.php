<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TingkatPengunjung extends Model
{
    protected $table = "tingkat_pengunjung";

    protected $fillable = [
        'observasi_id', 'user_id', 'tanggal', 'pelajar', 'umum', 'dinas', 'mancanegara', 'total', 'keterangan'
    ];

    public function monev_pemanfaatan(){
        return $this->belongsTo('App\MonevPemanfaatan', 'observasi_id');
    }
}
