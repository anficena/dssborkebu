<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayananKpk extends Model
{
    protected $table = "layanan_kpk";

    protected $fillable = [
        'user_id', 'sub_layanan', 'tanggal', 'tamu', 
        'instansi', 'alamat', 'keperluan', 'lokasi','jenis_layanan', 'jumlah'
    ];
}
