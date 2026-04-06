<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories',
            'deskripsi' => 'nullable|string',
        ]);

        \App\Models\Category::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => \Illuminate\Support\Str::slug($request->nama_kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $category = \App\Models\Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $category = \App\Models\Category::findOrFail($id);
        
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:categories,nama_kategori,' . $id,
            'deskripsi' => 'nullable|string',
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori,
            'slug' => \Illuminate\Support\Str::slug($request->nama_kategori),
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $category = \App\Models\Category::findOrFail($id);
        
        // Check if category has plants
        if ($category->tanamans()->count() > 0) {
            return redirect()->route('category.index')->with('error', 'Kategori tidak bisa dihapus karena masih memiliki data tanaman');
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus');
    }
}
