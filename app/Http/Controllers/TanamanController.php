<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanaman;
use Illuminate\Support\Facades\Storage;

class TanamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Tanaman::query();
        if ($request->has('search')) {
            $query->where('nama_tanaman', 'like', '%' . $request->search . '%');
        }
        $tanamans = $query->orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            return view('tanaman.partials.table', compact('tanamans'))->render();
        }

        return view('tanaman.index', compact('tanamans'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('tanaman.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_tanaman' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_ilmiah' => 'nullable|string|max:255',
            'khasiat' => 'nullable|string',
            'olahan' => 'nullable|string',
            'efek_samping' => 'nullable|string',
            'sumber' => 'nullable|string|max:255',
        ]);

        $input = $request->only([
            'nama_tanaman', 'deskripsi', 'kategori', 
            'nama_ilmiah', 'khasiat', 'olahan', 
            'efek_samping', 'sumber'
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('tanaman', 'public');
            $input['gambar'] = $path;
        }

        Tanaman::create($input);

        return redirect()->route('tanaman.index')->with('success', 'Data tanaman berhasil ditambahkan!');
    }

    public function edit(Tanaman $tanaman)
    {
        $categories = \App\Models\Category::all();
        return view('tanaman.edit', compact('tanaman', 'categories'));
    }

    public function update(Request $request, Tanaman $tanaman)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_tanaman' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_ilmiah' => 'nullable|string|max:255',
            'khasiat' => 'nullable|string',
            'olahan' => 'nullable|string',
            'efek_samping' => 'nullable|string',
            'sumber' => 'nullable|string|max:255',
        ]);

        $input = $request->only([
            'category_id', 'nama_tanaman', 'deskripsi', 
            'nama_ilmiah', 'khasiat', 'olahan', 
            'efek_samping', 'sumber'
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($tanaman->gambar && Storage::disk('public')->exists($tanaman->gambar)) {
                Storage::disk('public')->delete($tanaman->gambar);
            }
            $path = $request->file('gambar')->store('tanaman', 'public');
            $input['gambar'] = $path;
        }

        $tanaman->update($input);

        return redirect()->route('tanaman.index')->with('success', 'Data tanaman berhasil diperbarui!');
    }

    public function destroy(Tanaman $tanaman)
    {
        if ($tanaman->gambar && Storage::disk('public')->exists($tanaman->gambar)) {
            Storage::disk('public')->delete($tanaman->gambar);
        }
        
        $tanaman->delete();

        return redirect()->route('tanaman.index')->with('success', 'Data tanaman berhasil dihapus!');
    }
}
