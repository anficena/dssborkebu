<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataFlora extends Model
{
    protected $table = "data_flora";

    protected $fillable = [
        'observasi_id', 'user_id', 'tanggal', 'lokasi', 'nama', 'jenis', 'jumlah', 'satuan', 'keterangan'
    ];

    public function monev_lingkungan(){
        return $this->belongsTo('App\MonevLingkungan', 'observasi_id');
    }
}
