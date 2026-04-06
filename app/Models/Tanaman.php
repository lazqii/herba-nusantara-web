<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    protected $table = 'tanamans';
    protected $fillable = [
        'category_id',
        'nama_tanaman',
        'nama_ilmiah',
        'kategori', // Keeping for now for migration purposes
        'deskripsi',
        'khasiat',
        'olahan',
        'efek_samping',
        'sumber',
        'gambar'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
