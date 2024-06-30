<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $fillable = 
    [
        'kode',
        'nama',
        'no_telepon',
        'email',
        'tgl_reservasi',
        'jam_reservasi',
        'jenis_pembayaran',
        'status',
        'bukti',
        'meja_id'
    ];

    public $timestamps = false;
    
    public function meja(){
        return $this->belongsTo(Meja::class);
    }

}
