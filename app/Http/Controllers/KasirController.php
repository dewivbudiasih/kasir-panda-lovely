<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Product;  
use App\Models\Category; 

class KasirController extends Controller
{
   
    public function dashboard()
    {
        $hariIni = date('Y-m-d');

        $transaksiHariIni = Transaction::whereDate('created_at', $hariIni)->count();

        $omsetHariIni = Transaction::whereDate('created_at', $hariIni)->sum('total_price');

        $recentTransactions = Transaction::with('user')
            ->whereDate('created_at', $hariIni) 
            ->latest()
            ->take(5)
            ->get();

        return view('kasir.dashboard', compact('transaksiHariIni', 'omsetHariIni', 'recentTransactions'));
    }

    public function index(Request $request)
    {
   
        $query = Product::with('category');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            $query->where('name', 'like', "%{$search}%");
        }

        $produks = $query->latest()->paginate(10);
        $categories = Category::all(); 

        return view('kasir.produk.index', compact('produks', 'categories'));
    }

    public function update(Request $request, $id)
    {
        
        return redirect()->route('kasir.produk.index')
            ->with('error', 'Akses ditolak. Kasir hanya boleh melihat stok.');
    }
}