<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    public $timetamps = false;
    protected $table = 'meja';
    protected $fillable = ['kode', 'kapasitas', 'status'];

    public function reservasi(){
        return $this->hasMany(Reservasi::class);
    }
}
