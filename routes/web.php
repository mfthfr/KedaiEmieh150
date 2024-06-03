<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriProdukController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function(){
//     return view('admin.dashboard');
// });

Route::group(['middleware' => ['auth']], function(){

Route::prefix('admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/kategori_produk', [KategoriProdukController::class, 'index']);
    Route::post('/kategori_produk/store', [KategoriProdukController::class, 'store']);
    Route::put('/kategori_produk/update', [KategoriProdukController::class, 'update']);
});
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
