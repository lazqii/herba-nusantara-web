<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppConfig;
use App\Models\AiModelChangelog;
use Illuminate\Support\Facades\Storage;

class AppConfigWebController extends Controller
{
    public function index()
    {
        return view('configs.model');
    }

    public function update(Request $request)
    {
        $request->validate([
            'category' => 'required|string|in:daun,rimpang,batang',
            'model_file' => 'required|file',
            'labels_file' => 'required|file',
        ]);

        try {
            $cat = $request->input('category');

            // Save Model
            $modelFile = $request->file('model_file');
            $modelName = 'model_' . $cat . '_v' . time() . '.tflite';
            $modelPath = $modelFile->storeAs('models', $modelName, 'public');

            // Save Labels
            $labelsFile = $request->file('labels_file');
            $labelsName = 'labels_' . $cat . '_v' . time() . '.txt';
            $labelsPath = $labelsFile->storeAs('models', $labelsName, 'public');

            // Increment Version
            $versionConfig = AppConfig::firstOrCreate(['key' => "ai_model_version_{$cat}"]);
            $currentVersion = (int)($versionConfig->value ?? 0);
            $newVersion = $currentVersion + 1;
            
            $versionConfig->value = $newVersion;
            $versionConfig->save();

            // Store Dynamic Asset URL for Model
            $urlConfig = AppConfig::firstOrCreate(['key' => "ai_model_url_{$cat}"]);
            $urlConfig->value = asset('storage/models/' . $modelName);
            $urlConfig->save();

            // Store Dynamic Asset URL for Labels
            $labelsUrlConfig = AppConfig::firstOrCreate(['key' => "ai_model_labels_url_{$cat}"]);
            $labelsUrlConfig->value = asset('storage/models/' . $labelsName);
            $labelsUrlConfig->save();

            // Store Changelog History
            if ($request->filled('changelog')) {
                AiModelChangelog::create([
                    'version' => $newVersion, // Still using version, maybe we can append category in notes
                    'notes' => "[Kategori: " . ucfirst($cat) . "] " . $request->input('changelog')
                ]);
            }

            return redirect()->back()->with('success', "Berhasil merilis versi OTA baru untuk kategori " . ucfirst($cat) . "! (v{$newVersion}).");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mempublish file: ' . $e->getMessage());
        }
    }
}
