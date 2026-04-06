<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppConfigApiController extends Controller
{
    public function aiModel()
    {
        $version = \App\Models\AppConfig::where('key', 'ai_model_version')->first();
        $url = \App\Models\AppConfig::where('key', 'ai_model_url')->first();
        $labelsUrl = \App\Models\AppConfig::where('key', 'ai_model_labels_url')->first();

        return response()->json([
            'success' => true,
            'version' => (int)($version->value ?? 1),
            'url' => $url->value ?? null,
            'labels_url' => $labelsUrl->value ?? null,
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
