<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::with('kategori_produk')->get();
        return view('admin.produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = KategoriProduk::all();
        return view('admin.produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('produk')->insert([
            'kode' => $request -> kode,
            'nama' => $request -> nama,
            'harga_awal' => $request -> harga_awal,
            'harga' => $request -> harga,
            'stok' => $request -> stok,
            'tgl_exp' => $request -> tgl_exp,
            'deskripsi' => $request -> deskripsi,
            'kategori_produk_id' => $request -> kategori_produk_id,
        ]);
        return redirect()->route('produk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // edit produk
        $kategori = DB::table('kategori_produk')->get();
        $produk = DB::table('produk')->where('id', $id)->get();
        return view('admin.produk.edit', compact('kategori', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('produk')->where('id', $id)->update([
            'kode' => $request -> kode,
            'nama' => $request -> nama,
            'harga_awal' => $request -> harga_awal,
            'harga' => $request -> harga,
            'stok' => $request -> stok,
            'tgl_exp' => $request -> tgl_exp,
            'deskripsi' => $request -> deskripsi,
            'kategori_produk_id' => $request -> kategori_produk_id,
        ]);
        return redirect('admin/produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showKategori($id)
    {
        $kategori = KategoriProduk::findOrFail($id);
        $produk = Produk::where('kategori_produk_id', $id)->get();
        return view('admin.produk.index', compact('kategori', 'produk'));
    }
}
