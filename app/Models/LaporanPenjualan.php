<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $fillable = [
        'kode',
        'tgl_laporan',
        'total_pendapatan',
        'total_pendapatan_bersih',
        'total_stok_keluar',
        'total_stok_masuk',
        'transaksi_penjualan_id',
        'produk_id'
    ];

    public function transaksi()
    {
        return $this->belongsToMany(TransaksiPenjualan::class, 'laporan_transaksi', 'laporan_id', 'transaksi_id');
    }

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'laporan_produk', 'laporan_id', 'produk_id');
    }
}
