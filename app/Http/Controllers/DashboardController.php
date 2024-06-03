<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $kategori = KategoriProduk::count();

        return view('admin.dashboard', compact('kategori'));
    }
}
