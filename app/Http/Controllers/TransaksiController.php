<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Pengaturan; // <--- PASTIKAN BARIS INI ADA
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::query()
            ->where('stock', '>', 0)
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12);

        $cart = session()->get('cart', []);

        $totalBayar = 0;
        foreach ($cart as $item) {
            $totalBayar += $item['price'] * $item['qty'];
        }

        return view('kasir.transaksi.index', compact('products', 'cart', 'totalBayar'));
    }

    public function addToCart(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['qty'] + 1 > $product->stock) {
                return response()->json(['error' => 'Stok tidak mencukupi!'], 400);
            }
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "qty" => 1,
                "stock" => $product->stock
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }

    public function removeCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                $cart[$request->id]['qty']--;

                if ($cart[$request->id]['qty'] <= 0) {
                    unset($cart[$request->id]);
                }

                session()->put('cart', $cart);
            }
        }
        return response()->json(['success' => true]);
    }

    public function clearCart()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        // 1. Cek Keranjang
        $cartData = session()->get('cart', []);
        if (!$cartData || count($cartData) == 0) {
            return back()->with('error', 'Keranjang kosong!');
        }

        // 2. Hitung Total Belanja
        $totalPrice = 0;
        foreach ($cartData as $item) {
            $totalPrice += $item['price'] * $item['qty'];
        }

        // --- PEMBERSIHAN INPUT BAYAR ---
        $rawBayar = $request->input('bayar');
        // Hapus karakter selain angka (cth: "Rp 150.000" -> "150000")
        $cleanBayar = preg_replace('/[^0-9]/', '', $rawBayar);
        $uangBayar = (int) $cleanBayar;
        // -------------------------------

        // 3. Validasi Pembayaran
        if ($uangBayar <= 0) {
            return back()->with('error', 'Masukkan nominal uang pembayaran!');
        }

        if ($uangBayar < $totalPrice) {
            return back()->with('error', 'Uang pembayaran kurang! Total: Rp ' . number_format($totalPrice, 0, ',', '.') . ', Uang Anda: Rp ' . number_format($uangBayar, 0, ',', '.'));
        }

        // 4. Hitung Kembalian
        $kembalian = $uangBayar - $totalPrice;

        DB::beginTransaction();
        try {
            // Simpan Transaksi
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'invoice_code' => 'TRX-' . time() . rand(100, 999),
                'total_price' => $totalPrice,
                'bayar' => $uangBayar,      
                'kembalian' => $kembalian,  
                'created_at' => Carbon::now()
            ]);

            // Simpan Detail & Kurangi Stok
            foreach ($cartData as $item) {
                $produk = Product::lockForUpdate()->find($item['id']);

                if (!$produk) {
                    throw new \Exception("Produk hilang.");
                }
                if ($produk->stock < $item['qty']) {
                    throw new \Exception("Stok habis untuk produk: " . $produk->name);
                }

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['qty'] * $item['price'],
                ]);

                $produk->decrement('stock', $item['qty']);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('transaksi.struk', $transaction->id);
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    // --- BAGIAN INI YANG PENTING UNTUK STRUK ---
    public function struk($id)
    {
        // 1. Ambil data transaksi
        $transaction = Transaction::with(['details.product', 'user'])->findOrFail($id);
        
        // 2. Ambil data PENGATURAN TOKO (Model Pengaturan)
        $pengaturan = Pengaturan::first(); 

        // 3. Kirim variabel $pengaturan ke view
        return view('kasir.transaksi.struk', compact('transaction', 'pengaturan'));
    }

    public function riwayat()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('kasir.transaksi.riwayat', compact('transactions'));
    }
}