<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Meja;

class MejaController extends Controller
{
    
    public function index()
    {
        $meja = DB::table('meja')->get();
        $kodeMeja = $this->generateKodeMeja();
        return view('admin.meja.index', compact('meja', 'kodeMeja'));
    }

    public function generateKodeMeja(){
        $lastMeja = DB::table('meja')->orderBy('kode', 'desc')->first();
        if($lastMeja){
            $lastNumber = (int) substr($lastMeja->kode, 1);
            $newNumber = $lastNumber + 1;
        }else{
            $newNumber = 1;
        }

        $newKode = 'M' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newKode;
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $kodeMeja = $this->generateKodeMeja();

        DB::table('meja')->insert([
            'kode'=>$kodeMeja,
            'kapasitas'=>$request->kapasitas,
            'status'=>$request->status
        ]);
        return redirect('admin/meja');
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
        // validasi
        $request->validate([
            'kapasitas' => 'required|string|max:45',
        ]);
        
        // update meja
        DB::table('meja')
            ->where('id', $id)
            ->update([
                'kapasitas' => $request->kapasitas
            ]);            
        return redirect('admin/meja');
    }

    public function destroy(string $id)
    {
        $meja = Meja::find($id);
        $meja->delete();
        return redirect('admin/meja');
    }
}
