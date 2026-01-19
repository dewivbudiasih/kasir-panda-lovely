<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class KategoriController extends Controller
{
    
    public function index(Request $request)
    {
    
        $query = Category::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_kategori', 'LIKE', '%' . $search . '%');
        }

        $categories = $query->orderBy('id_kategori', 'desc')->paginate(10);

        $categories->appends(['search' => $request->search]);

        return view('admin.kategori.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $category = Category::findOrFail($id);
        
        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}