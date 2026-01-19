<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
     
        $categories = Category::all();

        $query = Product::with('category');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')   
                  ->orWhere('code', 'LIKE', '%' . $search . '%');
            });
        }

        $products = $query->latest()->paginate(10);

        $products->appends(['search' => $request->search]);

        return view('admin.produk.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products,code',
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        Product::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'code' => 'required|unique:products,code,'.$id,
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $product->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }
}