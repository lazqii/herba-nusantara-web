<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    protected $table = 'tanamans';
    protected $fillable = [
        'nama_tanaman',
        'deskripsi',
        'gambar',
        'kategori',
        'nama_ilmiah',
        'khasiat',
        'olahan',
        'efek_samping',
        'sumber'
    ];
}
