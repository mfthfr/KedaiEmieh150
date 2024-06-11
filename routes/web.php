<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('front.home');
});
Route::get('/reservasi', function(){
    return view('front.reservasi.index');
});

// Route::get('/dashboard', function(){
//     return view('admin.dashboard');
// });

Route::group(['middleware' => ['auth']], function(){

Route::prefix('admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/kategori_produk', [KategoriProdukController::class, 'index']);
    Route::post('/kategori_produk/store', [KategoriProdukController::class, 'store']);
    Route::put('/kategori_produk/update/{id}', [KategoriProdukController::class, 'update']);
    Route::delete('/kategori_produk/{id}', [KategoriProdukController::class, 'destroy'])->name('kategori_produk.destroy');

    Route::resource('produk', ProdukController::class);
    Route::get('/produk/kategori/{id}', [ProdukController::class, 'showKategori'])->name('produk.kategori');
});
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
