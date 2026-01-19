<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $penjualanHariIni = Transaction::whereDate('created_at', $today)
                            ->sum('total_price');

        $penjualanBulanIni = Transaction::whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->sum('total_price');

        $riwayatTransaksi = Transaction::with('user')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        $totalProduk = Product::count();
        $totalUser = User::count(); 

        return view('admin.dashboard', compact(
            'penjualanHariIni', 
            'penjualanBulanIni', 
            'riwayatTransaksi', 
            'totalProduk', 
            'totalUser'
        ));
    }
}