<?php

use App\Http\Controllers\KategoriProdukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function(){
    return view('admin.dashboard');
});

Route::prefix('admin')->group(function(){
    Route::get('/kategori_produk', [KategoriProdukController::class, 'index']);
    Route::post('/kategori_produk/store', [KategoriProdukController::class, 'store']);
});
