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
        $kodeProduk = $this->generateKodeProduk($request->kategori_produk_id);
        $fileName = null;

        if(!empty($request->foto)){
            $fileName = 'foto-'.$kodeProduk.'.'.$request->foto->extension();
            switch($request->kategori_produk_id){
                case '1':
                    $request->foto->move(public_path('admin/img/produk/aneka mie'), $fileName);
                    break;
                case '2':
                    $request->foto->move(public_path('admin/img/produk/minuman'), $fileName);
                    break;
                case '3':
                    $request->foto->move(public_path('admin/img/produk/cemilan'), $fileName);
                    break;
                case '4':
                    $request->foto->move(public_path('admin/img/produk/aneka nasi'), $fileName);
                    break;
                case '6':
                    $request->foto->move(public_path('admin/img/produk/aneka toping'), $fileName);
                    break;
            }
        }
        
        DB::table('produk')->insert([
            'kode' => $kodeProduk,
            'nama' => $request -> nama,
            'harga_awal' => $request -> harga_awal,
            'harga' => $request -> harga,
            'stok' => $request -> stok,
            'diskon' => $request -> diskon,
            'tgl_exp' => $request -> tgl_exp,
            'foto' => $fileName,
            'deskripsi' => $request -> deskripsi,
            'best_seller' => $request -> best_seller ? 1 : 0,
            'kategori_produk_id' => $request -> kategori_produk_id,
        ]);
        return redirect()->route('produk.index')->with('success', 'Produk Berhasil Ditambahkan');
    }

    private function generateKodeProduk($kategoriID)
    {
        switch($kategoriID){
            case '1':
                $prefix = 'AM';
                break;
            case '2':
                $prefix = 'MN';
                break;
            case '3':
                $prefix = 'CM';
                break;
            case '4':
                $prefix = 'AN';
                break;
            case '6':
                $prefix = 'AT';
                break;
            default:
                $prefix = 'XX';
                break;
        }
        
        $lastProduk = DB::table('produk')->where('kode', 'like', $prefix . '%')->orderBy('kode', 'desc')->first();
        if ($lastProduk) {
            $lastNumber = (int) substr($lastProduk->kode, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::with('kategori_produk')->where('id', $id)->first();
        return view('admin.produk.detail', compact('produk'));
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

    
    public function update(Request $request, string $id)
    {
        // mengambil produk lama
        $oldProduct = DB::table('produk')->where('id', $id)->first();

        // cek apakah kategori produk berubah
        $isCategoryChanged = $oldProduct->kategori_produk_id != $request->kategori_produk_id;

        // jika kategori produk beruban, hasilkan kode baru
        if($isCategoryChanged){
            $kodeProduk = $this->generateKodeProduk($request->kategori_produk_id);
        }else{
            $kodeProduk = $request->kode;
        }

        // pindahkan foto jika diunggah
        $fileName = $oldProduct->foto;
        if(!empty($request->foto)){
            // hapus gambar lama
            if($oldProduct->foto && file_exists(public_path('admin/img/produk/'.$oldProduct->foto))){
                unlink(public_path('admin/img/produk/'.$oldProduct->foto));
            }

            $fileName = 'foto-'.$kodeProduk.'.'.$request->foto->extension();
            switch($request->kategori_produk_id){
                case '1':
                    $request->foto->move(public_path('admin/img/produk/aneka mie'), $fileName);
                    break;
                case '2':
                    $request->foto->move(public_path('admin/img/produk/minuman'), $fileName);
                    break;
                case '3':
                    $request->foto->move(public_path('admin/img/produk/cemilan'), $fileName);
                    break;
                case '4':
                    $request->foto->move(public_path('admin/img/produk/aneka nasi'), $fileName);
                    break;
                case '6':
                    $request->foto->move(public_path('admin/img/produk/aneka toping'), $fileName);
                    break;
            }
        }

        DB::table('produk')->where('id', $id)->update([
            'kode' => $kodeProduk,
            'nama' => $request -> nama,
            'harga_awal' => $request -> harga_awal,
            'harga' => $request -> harga,
            'stok' => $request -> stok,
            'diskon' => $request -> diskon,
            'tgl_exp' => $request -> tgl_exp,
            'foto' => $fileName,
            'deskripsi' => $request -> deskripsi,
            'best_seller' => $request -> best_seller ? 1 : 0,
            'kategori_produk_id' => $request -> kategori_produk_id,
        ]);
        return redirect('admin/produk')->with('success', 'Update Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }

    public function showKategori($id)
    {
        $kategori = KategoriProduk::findOrFail($id);
        $produk = Produk::where('kategori_produk_id', $id)->get();
        return view('admin.produk.index', compact('kategori', 'produk'));
    }
}
