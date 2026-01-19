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

    Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login-proses', [LoginController::class, 'authenticate'])->name('login.proses');
});

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

    Route::middleware(['auth', 'cekrole:ADMIN'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::prefix('admin/produk')->name('produk.')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('index');
        Route::post('/store', [ProdukController::class, 'store'])->name('store');
        Route::put('/update/{id}', [ProdukController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ProdukController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/kategori')->name('kategori.')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::post('/store', [KategoriController::class, 'store'])->name('store');
        Route::put('/update/{id}', [KategoriController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [KategoriController::class, 'destroy'])->name('destroy');
    });

    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/admin/laporan/pdf', [LaporanController::class, 'cetakPdf'])->name('laporan.cetakPdf');

    Route::resource('admin/staf', StafController::class)
        ->parameters(['staf' => 'id'])
        ->names('staf');

    Route::get('/admin/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::post('/admin/pengaturan/update', [PengaturanController::class, 'update'])->name('pengaturan.update');
});

    Route::middleware(['auth', 'cekrole:KASIR'])->group(function () {

    Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])->name('kasir.dashboard');
    Route::get('/kasir/stok-barang', [KasirController::class, 'index'])->name('kasir.produk.index');

    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('index');
        Route::post('/add-cart', [TransaksiController::class, 'addToCart'])->name('addCart');
        Route::post('/remove-cart', [TransaksiController::class, 'removeCart'])->name('removeCart');
        Route::post('/clear-cart', [TransaksiController::class, 'clearCart'])->name('clearCart');
        Route::post('/store', [TransaksiController::class, 'store'])->name('store');
        Route::get('/riwayat', [TransaksiController::class, 'riwayat'])->name('riwayat');
    });
});

    Route::middleware(['auth'])->group(function () {
    Route::get('/transaksi/struk/{id}', [TransaksiController::class, 'struk'])->name('transaksi.struk');
});
