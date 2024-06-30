<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservasi;
use App\Models\Meja;

class ReservasiFrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('front.reservasi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $meja = Meja::all();
        $aktifReservasi = Reservasi::where('status', 'Disetujui')
                            ->orWhere('status', 'Belum Disetujui')
                            ->get();
        $kodeReservasi = $this->generateKodeReservasi();
        return view('front.reservasi.create', compact('meja', 'kodeReservasi', 'aktifReservasi'));
    }

    public function generateKodeReservasi(){
        $lastReservasi = DB::table('reservasi')->orderBy('kode', 'desc')->first();
        if($lastReservasi){
            $lastNumber = (int) substr($lastReservasi->kode, 2);
            $newNumber = $lastNumber + 1;
        }else{
            $newNumber = 1;
        }

        $newKode = 'RM' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
        return $newKode;
    }

    public function store(Request $request)
    {
        $nama = $request->nama;
        $fileName = '';

        if($request->jenis_pembayaran === 'transfer' && !empty($request->bukti)){            
            $fileName = 'bukti-'.$nama.'.'.$request->bukti->extension();
            $request->bukti->move(public_path('admin/img/bukti'), $fileName);
        }

        $kodeReservasi = $this->generateKodeReservasi();
        
        DB::table('reservasi')->insert([
            'kode'=>$kodeReservasi,
            'nama'=>$request->nama,
            'no_telepon'=>$request->no_telepon,
            'email'=>$request->email,
            'tgl_reservasi'=>$request->tgl_reservasi,
            'jam_reservasi'=>$request->jam_reservasi,
            'jenis_pembayaran'=>$request->jenis_pembayaran,
            'status'=>$request->status,
            'bukti'=>$fileName,
            'meja_id'=>$request->meja_id
        ]);
        return redirect()->route('reservasi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
