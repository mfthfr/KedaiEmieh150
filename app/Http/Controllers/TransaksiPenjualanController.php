<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPenjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = TransaksiPenjualan::with('produk')->get();
        return view('admin.transaksi.index', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kodeTransaksi = $this->generateKodeTransaksi();
        $produk = Produk::all();
        $aktifTransaksi = TransaksiPenjualan::where('status', 'Pending')
                            ->orWhere('status', 'Belum Dibayar')
                            ->get();
        return view('admin.transaksi.create', compact('kodeTransaksi', 'produk', 'aktifTransaksi'));
    }

    public function generateKodeTransaksi()
    {
        $lastTransaksi = DB::table('transaksi_penjualan')->orderBy('kode', 'desc')->first();
        if ($lastTransaksi) {
            $lastNumber = (int) substr($lastTransaksi->kode, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $newKode = 'TP' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        return $newKode;
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Store a newly created resource in storage.
 */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_transaksi' => 'required|date',
            'jenis_pembayaran' => 'required|string',
            'status' => 'required|string',
            'produk' => 'required|array|min:1',
            'produk.*.id' => 'required|integer|exists:produk,id',
            'produk.*.jumlah' => 'required|integer|min:1',
            'diskon' => 'nullable|numeric|min:0',
            'pajak' => 'nullable|numeric|min:0',
        ]);        

        $kodeTransaksi = $this->generateKodeTransaksi();

        $totalHarga = 0;
        foreach ($request->produk as $item) {
            $produk = Produk::find($item['id']);
            $totalHarga += $produk->harga * $item['jumlah'];
        }

        if ($request->diskon) {
            $totalHarga -= $totalHarga * ($request->diskon / 100);
        }

        if ($request->pajak) {
            $totalHarga += $totalHarga * ($request->pajak / 100);
        }

        $transaksi = TransaksiPenjualan::create([
            'kode' => $kodeTransaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'status' => $request->status,
            'total_harga' => $totalHarga,
        ]);

        // Attach produk to transaksi using pivot table
        foreach ($request->produk as $item) {
            $produk = Produk::find($item['id']);
            $transaksi->produk()->attach($produk->id, ['jumlah' => $item['jumlah']]);
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mengambil data transaksi dari database berdasarkan ID
        $transaksi = TransaksiPenjualan::with('produk')->findOrFail($id);

        // Mengembalikan view 'detail' dan meneruskan data transaksi
        return view('admin.transaksi.detail', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = TransaksiPenjualan::findOrFail($id);
        $transaksi->status = $request->status;
        $transaksi->save();

        if($request->status === ''){

        }
        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
