<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = 
    [
        'kode',
        'nama',
        'harga_awal',
        'harga',
        'stok',
        'tgl_exp',
        'foto',
        'deskripsi',
        'kategori_produk_id'
    ];
    public function kategori_produk(){
        return $this->belongsTo(KategoriProduk::class);
    }
    public function transaksi_penjualan()
    {
        return $this->belongsToMany(TransaksiPenjualan::class, 'produk_transaksi', 'produk_id', 'transaksi_penjualan_id')
                    ->withPivot('jumlah'); // Jika Anda ingin mengakses kolom 'jumlah' pada pivot table
    }
    public function laporan()
    {
        return $this->belongsToMany(LaporanPenjualan::class, 'laporan_produk', 'produk_id', 'laporan_id');
    }
}
