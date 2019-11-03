<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservasiIklim extends Model
{
    protected $table = "observasi_iklim";

    protected $fillable = [
        'observasi_id', 'user_id', 'tanggal', 'nama_data', 'hasil', 'satuan'
    ];

    public function monev_lingkungan(){
        return $this->belongsTo('App\MonevLingkungan','observasi_id');
    }
}
