<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TanamanBaruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanamans = [
            // Kategori Daun
            ['nama_tanaman' => 'Daun Sirih', 'kategori' => 'Daun'],
            ['nama_tanaman' => 'Daun Kelor', 'kategori' => 'Daun'],
            ['nama_tanaman' => 'Daun Jinten', 'kategori' => 'Daun'],
            ['nama_tanaman' => 'Daun Binahong', 'kategori' => 'Daun'],
            ['nama_tanaman' => 'Daun Sambiloto', 'kategori' => 'Daun'],

            // Kategori Rimpang
            ['nama_tanaman' => 'Jahe', 'kategori' => 'Rimpang'],
            ['nama_tanaman' => 'Kunyit', 'kategori' => 'Rimpang'],
            ['nama_tanaman' => 'Lengkuas', 'kategori' => 'Rimpang'],
            ['nama_tanaman' => 'Temulawak', 'kategori' => 'Rimpang'],
            ['nama_tanaman' => 'Kencur', 'kategori' => 'Rimpang'],

            // Kategori Batang
            ['nama_tanaman' => 'Kayu Manis', 'kategori' => 'Batang'],
            ['nama_tanaman' => 'Brotowali', 'kategori' => 'Batang'],
            ['nama_tanaman' => 'Pulosari', 'kategori' => 'Batang'],
        ];

        foreach ($tanamans as $tanaman) {
            \App\Models\Tanaman::create([
                'nama_tanaman' => $tanaman['nama_tanaman'],
                'kategori' => $tanaman['kategori'],
                'deskripsi' => 'Deskripsi untuk ' . $tanaman['nama_tanaman'],
            ]);
        }
    }
}
