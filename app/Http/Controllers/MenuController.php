<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\KategoriProduk;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $kategori_produk = KategoriProduk::all();

        if ($request->has('kategori') && $request->kategori != '') {
            $produk = Produk::with('kategori_produk')->where('kategori_produk_id', $request->kategori)->get();
        } else {
            $produk = Produk::with('kategori_produk')->get();
        }

        return view('front.menu.index', compact('produk', 'kategori_produk'));
    }
}
