<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservasi;
use App\Models\Meja;

class ReservasiController extends Controller
{
    
    public function index()
    {
        $reservasi = Reservasi::with('meja')->get();
        return view('admin.reservasi.index', compact('reservasi'));
    }

   
    public function create()
    {
        $meja = Meja::all();
        $aktifReservasi = Reservasi::where('status', 'Disetujui')
                            ->orWhere('status', 'Belum Disetujui')
                            ->get();
        $kodeReservasi = $this->generateKodeReservasi();
        return view('admin.reservasi.create', compact('meja', 'kodeReservasi', 'aktifReservasi'));
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

    public function checkAvailability(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $waktu = $request->input('waktu');
        $meja = Meja::all();

        // Hitung waktu batas awal dan akhir yang status meja sedang digunakan
        $batas_awal = date('H:i:s', strtotime("$waktu -60 minutes"));
        $batas_akhir = date('H:i:s', strtotime("$waktu +60 minutes"));

        $aktifReservasi = Reservasi::whereDate('tgl_reservasi', $tanggal)
                            ->where(function ($query) use ($waktu, $batas_awal, $batas_akhir) {
                                $query->where(function ($query) use ($waktu, $batas_awal, $batas_akhir) {
                                    $query->whereTime('jam_reservasi', '>=', $batas_awal)
                                        ->whereTime('jam_reservasi', '<=', $batas_akhir);
                                })
                                ->orWhere(function ($query) use ($waktu) {
                                    $query->whereTime('jam_reservasi', '<=', $waktu)
                                        ->whereTime('jam_reservasi', '>=', '16:00:00');
                                });
                            })
                            ->whereIn('status', ['Disetujui', 'Belum Disetujui'])
                            ->get();

        $availability = [];

        foreach ($meja as $m) {
            $status = 'Tersedia';

            foreach ($aktifReservasi as $reservasi) {
                if ($reservasi->meja_id == $m->id) {
                    $status = 'Dalam Pesanan';
                    break;
                }
            }

            $availability[] = [
                'meja_id' => $m->id,
                'kode' => $m->kode,
                'kapasitas' => $m->kapasitas,
                'status' => $status
            ];
        }

        return response()->json($availability);
    }
    
    public function show(string $id)
    {
        $reservasi = Reservasi::find($id);
        return view('admin.reservasi.detail', compact('reservasi'));
    }

    
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->status = $request->status;
        $reservasi->save();

        if($request->status === 'Disetujui'){

        }
        return redirect()->route('reservasi.index');
    }

    
    public function destroy(string $id)
    {
        //
    }
}
