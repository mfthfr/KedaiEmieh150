<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = DB::table('kategori_produk')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //tambah kategori produk
        DB::table('kategori_produk')->insert([
            'nama_kategori' => $request -> nama_kategori,
        ]);
        return redirect('admin/kategori_produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriProduk $kategoriProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriProduk $kategoriProduk)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriProduk $kategoriProduk)
    {
        // validasi
        $request->validate([
            'nama_kategori' => 'required|string|max:45',
        ]);
        
        // update kategori produk
        DB::table('kategori_produk')
            ->where('id', $kategoriProduk->id)
            ->update(['nama_kategori' => $request -> nama_kategori]);
        return redirect('admin/kategori_produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriProduk $kategoriProduk)
    {
        //
    }
}
