<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['nama_kategori', 'slug', 'deskripsi'];

    public function tanamans()
    {
        return $this->hasMany(Tanaman::class);
    }
}
