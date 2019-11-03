<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Kajian extends Model
{
    use \Conner\Tagging\Taggable;
    protected $table = 'kajian';
    protected $fillable = [
        'judul', 'penulis', 'kategori', 'keyword', 'tanggal', 'abstrak', 'file'
    ];
}