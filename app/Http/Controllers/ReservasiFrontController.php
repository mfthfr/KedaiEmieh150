<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservasi;
use App\Models\Meja;

class ReservasiFrontController extends Controller
{
    public function index()
    {
        $meja = Meja::all();
        $aktifReservasi = Reservasi::where('status', 'Disetujui')
                            ->orWhere('status', 'Belum Disetujui')
                            ->get();
        return view('front.reservasi.index', compact('meja', 'aktifReservasi'));
    }

    public function create()
    {
        $meja = Meja::all();
        return view('front.reservasi.create', compact('meja'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'tgl_reservasi' => 'required|date',
            'jam_reservasi' => 'required|date_format:H:i',            
            'bukti' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'meja_id' => 'required|exists:meja,id',
        ]);

        $kode = $request->kode;
        $fileName = '';

        if($request->jenis_pembayaran === 'transfer' && $request->hasFile('bukti')){            
            $fileName = 'bukti-'.$kode.'.'.$request->bukti->extension();
            $request->bukti->move(public_path('admin/img/bukti'), $fileName);
        }

        $kodeReservasi = $this->generateKodeReservasi();
        
        Reservasi::create([
            'kode' => $kodeReservasi,
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'tgl_reservasi' => $request->tgl_reservasi,
            'jam_reservasi' => $request->jam_reservasi,
            'jenis_pembayaran' => 'transfer',
            'status' => 'Belum Disetujui',
            'bukti' => $fileName,
            'meja_id' => $request->meja_id,
        ]);

        return redirect()->route('front.reservasi.index')->with('success', 'Reservasi berhasil dibuat. Menunggu persetujuan.');
    }

    private function generateKodeReservasi()
    {
        $lastReservasi = DB::table('reservasi')->orderBy('kode', 'desc')->first();
        if ($lastReservasi) {
            $lastNumber = (int) substr($lastReservasi->kode, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'RM' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    // ReservasiController.php

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

}