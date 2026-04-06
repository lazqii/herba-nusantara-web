<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nama_kategori' => 'Daun', 'slug' => 'daun', 'deskripsi' => 'Tanaman yang dimanfaatkan daunnya sebagai obat.'],
            ['nama_kategori' => 'Rimpang', 'slug' => 'rimpang', 'deskripsi' => 'Tanaman yang dimanfaatkan rimpang/umbinya.'],
            ['nama_kategori' => 'Batang', 'slug' => 'batang', 'deskripsi' => 'Tanaman yang dimanfaatkan kulit atau bagian batangnya.'],
            ['nama_kategori' => 'Bunga', 'slug' => 'bunga', 'deskripsi' => 'Tanaman yang dimanfaatkan bunganya.'],
            ['nama_kategori' => 'Akar', 'slug' => 'akar', 'deskripsi' => 'Tanaman yang dimanfaatkan akarnya.'],
            ['nama_kategori' => 'Buah', 'slug' => 'buah', 'deskripsi' => 'Tanaman yang dimanfaatkan buahnya.'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create($cat);
        }
    }
}
