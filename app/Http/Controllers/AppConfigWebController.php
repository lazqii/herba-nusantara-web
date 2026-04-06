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
        $version = AppConfig::where('key', 'ai_model_version')->first()->value ?? 1;
        $url = AppConfig::where('key', 'ai_model_url')->first()->value ?? null;
        $labelsUrl = AppConfig::where('key', 'ai_model_labels_url')->first()->value ?? null;
        
        return view('configs.model', [
            'version' => $version,
            'url' => $url,
            'labels_url' => $labelsUrl
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'model_file' => 'required|file',
            'labels_file' => 'required|file',
        ]);

        try {
            // Save Model
            $modelFile = $request->file('model_file');
            $modelName = 'model_v' . time() . '.tflite';
            $modelPath = $modelFile->storeAs('models', $modelName, 'public');

            // Save Labels
            $labelsFile = $request->file('labels_file');
            $labelsName = 'labels_v' . time() . '.txt';
            $labelsPath = $labelsFile->storeAs('models', $labelsName, 'public');

            // Increment Version
            $versionConfig = AppConfig::firstOrCreate(['key' => 'ai_model_version']);
            $currentVersion = (int)($versionConfig->value ?? 0);
            $newVersion = $currentVersion + 1;
            
            $versionConfig->value = $newVersion;
            $versionConfig->save();

            // Store Dynamic Asset URL for Model
            $urlConfig = AppConfig::firstOrCreate(['key' => 'ai_model_url']);
            $urlConfig->value = asset('storage/models/' . $modelName);
            $urlConfig->save();

            // Store Dynamic Asset URL for Labels
            $labelsUrlConfig = AppConfig::firstOrCreate(['key' => 'ai_model_labels_url']);
            $labelsUrlConfig->value = asset('storage/models/' . $labelsName);
            $labelsUrlConfig->save();

            // Store Changelog History
            if ($request->filled('changelog')) {
                AiModelChangelog::create([
                    'version' => $newVersion,
                    'notes' => $request->input('changelog')
                ]);
            }

            return redirect()->back()->with('success', "Berhasil merilis versi OTA baru! (v{$newVersion}). Aplikasi Mobile ter-install akan menyinkron AI secara otomatis di background saat dibuka!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mempublish file: ' . $e->getMessage());
        }
    }
}
