<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanaman;
use Illuminate\Support\Facades\Storage;

class TanamanApiController extends Controller
{
    public function index()
    {
        $tanamans = Tanaman::with('category')->get()->map(function ($tanaman) {
            $tanaman->gambar_url = $tanaman->gambar ? url(Storage::url($tanaman->gambar)) : null;
            $tanaman->kategori_name = $tanaman->category ? $tanaman->category->nama_kategori : ($tanaman->kategori ?? '-');
            return $tanaman;
        });

        return response()->json([
            'success' => true,
            'message' => 'Daftar Data Tanaman',
            'data'    => $tanamans
        ], 200);
    }

    public function show($id)
    {
        $tanaman = Tanaman::with('category')->find($id);

        if ($tanaman) {
            $tanaman->gambar_url = $tanaman->gambar ? url(Storage::url($tanaman->gambar)) : null;
            $tanaman->kategori_name = $tanaman->category ? $tanaman->category->nama_kategori : ($tanaman->kategori ?? '-');
            
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Tanaman',
                'data'    => $tanaman
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data Tanaman Tidak Ditemukan',
        ], 404);
    }
}
