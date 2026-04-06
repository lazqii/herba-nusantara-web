<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IdentifikasiLogApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prediction_label' => 'required|string',
            'confidence_score' => 'required|numeric',
        ]);

        $imagePath = $request->file('image')->store('identifikasi_logs', 'public');

        $log = \App\Models\IdentifikasiLog::create([
            'image_path' => $imagePath,
            'prediction_label' => $request->prediction_label,
            'confidence_score' => $request->confidence_score,
            'user_correction' => $request->user_correction,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Identification logged successfully',
            'data' => $log
        ], 201);
    }
}
