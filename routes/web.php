<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KasirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- ROUTE UNTUK TAMU (LOGIN) ---
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login-proses', [LoginController::class, 'authenticate'])->name('login.proses');
});

// --- ROUTE LOGOUT ---
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// --- ROUTE KHUSUS ADMIN ---
Route::middleware(['auth', 'cekrole:ADMIN'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // CRUD Produk
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/admin/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::put('/admin/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/admin/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    // CRUD Kategori
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/admin/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/admin/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/admin/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // --- BAGIAN LAPORAN (Updated) ---
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    // Route baru untuk cetak PDF:
    Route::get('/admin/laporan/pdf', [LaporanController::class, 'cetakPdf'])->name('laporan.cetakPdf');

    // Staf (Resource)
    Route::resource('admin/staf', StafController::class)
        ->parameters(['staf' => 'id'])
        ->names('staf');

    Route::get('/admin/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/admin/pengaturan/update', [PengaturanController::class, 'update'])->name('pengaturan.update');
});

// --- ROUTE KHUSUS KASIR ---
Route::middleware(['auth', 'cekrole:KASIR'])->group(function () {

    Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])->name('kasir.dashboard');
    Route::get('/kasir/stok-barang', [KasirController::class, 'index'])->name('kasir.produk.index');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');

    Route::post('/transaksi/add-cart', [TransaksiController::class, 'addToCart'])->name('transaksi.addCart');
    Route::post('/transaksi/remove-cart', [TransaksiController::class, 'removeCart'])->name('transaksi.removeCart');
    Route::post('/transaksi/clear-cart', [TransaksiController::class, 'clearCart'])->name('transaksi.clearCart');

    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/riwayat', [TransaksiController::class, 'riwayat'])->name('transaksi.riwayat');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/transaksi/struk/{id}', [TransaksiController::class, 'struk'])->name('transaksi.struk');
});