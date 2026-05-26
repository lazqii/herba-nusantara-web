<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppConfigApiController extends Controller
{
    public function aiModel()
    {
        $categories = ['daun', 'rimpang', 'batang'];
        $models = [];
        
        foreach ($categories as $cat) {
            $version = \App\Models\AppConfig::where('key', "ai_model_version_{$cat}")->first();
            $url = \App\Models\AppConfig::where('key', "ai_model_url_{$cat}")->first();
            $labelsUrl = \App\Models\AppConfig::where('key', "ai_model_labels_url_{$cat}")->first();

            $models[$cat] = [
                'version' => (int)($version->value ?? 0),
                'url' => $url->value ?? null,
                'labels_url' => $labelsUrl->value ?? null,
            ];
        }

        return response()->json([
            'success' => true,
            'models' => $models,
        ]);
    }

    public function changelogs()
    {
        $changelogs = \App\Models\AiModelChangelog::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $changelogs
        ]);
    }
}
