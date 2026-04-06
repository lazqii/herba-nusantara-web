<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AppConfig::create([
            'key' => 'ai_model_version',
            'value' => '1',
            'version' => 1
        ]);

        \App\Models\AppConfig::create([
            'key' => 'ai_model_url',
            'value' => 'http://192.168.1.4:8000/storage/models/model_v1.tflite',
            'version' => 1
        ]);
    }
}
