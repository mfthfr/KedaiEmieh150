<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPenjualan;
use App\Models\TransaksiPenjualan;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = LaporanPenjualan::with('transaksi');
        
        if ($request->has('tgl_laporan')) {
            $query->whereDate('tgl_laporan', $request->tgl_laporan);
        }
        
        if ($request->has('bulan')) {
            $query->whereMonth('tgl_laporan', $request->bulan)
                  ->whereYear('tgl_laporan', Carbon::now()->year);
        }
        
        $laporan = $query->get();
        
        return view('admin.laporan.index', compact('laporan'));
    }

    public function create()
    {
        $transaksiHarian = TransaksiPenjualan::selectRaw('DATE(tgl_transaksi) as tanggal')
            ->where('status', 'Lunas')
            ->distinct()
            ->get();

        $transaksiBulanan = TransaksiPenjualan::selectRaw('MONTH(tgl_transaksi) as bulan')
            ->where('status', 'Lunas')
            ->distinct()
            ->get();

        return view('admin.laporan.create', compact('transaksiHarian', 'transaksiBulanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:laporan_penjualan',
            'tgl_laporan' => 'required|date',
            'periode' => 'required|in:harian,bulanan',
            'transaksi' => 'required|array',
        ]);

        $totalPendapatan = 0;
        $totalHargaAwal = 0;
        $transaksiDetails = [];

        if ($request->periode == 'harian') {
            foreach ($request->transaksi as $transaksiDate) {
                $transaksi = TransaksiPenjualan::with('produk')
                    ->where('status', 'Lunas')
                    ->whereDate('tgl_transaksi', $transaksiDate)
                    ->get();

                foreach ($transaksi as $t) {
                    $totalPendapatan += $t->total_harga;
                    $transaksiDetails[] = $t;  // Simpan detail transaksi
                    foreach ($t->produk as $produk) {
                        $totalHargaAwal += $produk->harga_awal;
                    }
                }
            }
        } elseif ($request->periode == 'bulanan') {
            foreach ($request->transaksi as $transaksiMonth) {
                $transaksi = TransaksiPenjualan::with('produk')
                    ->where('status', 'Lunas')
                    ->whereMonth('tgl_transaksi', $transaksiMonth)
                    ->whereYear('tgl_transaksi', date('Y')) // menggunakan tahun sekarang
                    ->get();

                foreach ($transaksi as $t) {
                    $totalPendapatan += $t->total_harga;
                    $transaksiDetails[] = $t;  // Simpan detail transaksi
                    foreach ($t->produk as $produk) {
                        $totalHargaAwal += $produk->harga_awal;
                    }
                }
            }
        }

        $totalPendapatanBersih = $totalPendapatan - $totalHargaAwal;

        $laporan = LaporanPenjualan::create([
            'kode' => $request->kode,
            'tgl_laporan' => $request->tgl_laporan,
            'total_pendapatan' => $totalPendapatan,
            'total_pendapatan_bersih' => $totalPendapatanBersih,
            'periode' => $request->periode
        ]);

        // Simpan transaksi ke laporan
        $laporan->transaksi()->saveMany($transaksiDetails);

        return redirect()->route('laporan.index')->with('success', 'Laporan Penjualan Berhasil dibuat');
    }

    public function downloadPDF($id)
    {
        $laporan = LaporanPenjualan::with('transaksi')->findOrFail($id);
        $pdf = PDF::loadView('admin.laporan.pdf', compact('laporan'));
        return $pdf->download('laporan_penjualan_'.$laporan->kode.'.pdf');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
