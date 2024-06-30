<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservasiFrontController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('front.home');
});
// Route::get('/reservasi', function(){
//     return view('front.reservasi.index');
// });
Route::get('/menu', function(){
    return view('front.menu.index');
});
Route::get('/kontak', function(){
    return view('front.kontak.index');
});

Route::get('/reservasi', [ReservasiFrontController::class, 'index'])->name('front.reservasi.index');
Route::get('/reservasi/create', [ReservasiFrontController::class, 'create'])->name('front.reservasi.create');
Route::post('/reservasi', [ReservasiFrontController::class, 'store'])->name('front.reservasi.store');
Route::post('/reservasi/check-availability', [ReservasiFrontController::class, 'checkAvailability'])->name('front.reservasi.checkAvailability');

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

    Route::get('/meja', [MejaController::class, 'index']);
    Route::post('/meja/store', [MejaController::class, 'store']);
    Route::put('/meja/update/{id}', [MejaController::class, 'update']);
    Route::delete('/meja/{id}', [MejaController::class, 'destroy'])->name('meja.destroy');

    Route::resource('produk', ProdukController::class);
    Route::get('/produk/kategori/{id}', [ProdukController::class, 'showKategori'])->name('produk.kategori');

    Route::resource('reservasi', ReservasiController::class);
    Route::post('/reservasi/check-availability', [ReservasiController::class, 'checkAvailability'])->name('admin.reservasi.checkAvailability');
});
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
