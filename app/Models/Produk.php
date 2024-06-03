<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = ['kode', 'nama', 'harga', 'stok', 'tgl_exp', 'foto', 'deskripsi', 'kategori_produk_id'];
    public function kategori_produk()
    {
        return $this->belongsTo(KategoriProduk::class);
    }
}
