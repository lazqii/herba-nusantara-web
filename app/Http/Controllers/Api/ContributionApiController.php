<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use Illuminate\Http\Request;

class ContributionApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'label_name' => 'required|string',
            'confidence_score' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('contributions', 'public');
            
            $contribution = Contribution::create([
                'image_path' => $imagePath,
                'label_name' => $request->label_name,
                'confidence_score' => $request->confidence_score,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Contribution submitted successfully.',
                'data' => $contribution
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Image upload failed.'
        ], 400);
    }
}
