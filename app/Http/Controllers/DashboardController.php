<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Reservasi;
use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $produk = Produk::count();
        $total_harga = TransaksiPenjualan::sum('total_harga');
        $reservasi = Reservasi::count();

        return view('admin.dashboard', compact('produk', 'total_harga'));
    }
}
