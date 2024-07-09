<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penjualan';
    protected $fillable =
    [
        'kode',
        'tgl_transaksi',
        'jenis_pembayaran',
        'status',
        'total_harga'
    ];

    public $timestamps = false;

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'produk_transaksi', 'transaksi_penjualan_id', 'produk_id')
                    ->withPivot('jumlah'); // Jika Anda ingin mengakses kolom 'jumlah' pada pivot table
    }

    public function laporan()
    {
        return $this->belongsToMany(LaporanPenjualan::class, 'laporan_transaksi', 'transaksi_id', 'laporan_id');
    }
}
