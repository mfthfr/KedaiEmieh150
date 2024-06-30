@extends('admin.layouts.app')

@section('konten')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Detail Reservasi</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Kode Reservasi:</strong>
                </div>
                <div class="col-md-8">
                    {{ $reservasi->kode }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Nama:</strong>
                </div>
                <div class="col-md-8">
                    {{ $reservasi->nama }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>No Telepon:</strong>
                </div>
                <div class="col-md-8">
                    {{ $reservasi->no_telepon }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Email:</strong>
                </div>
                <div class="col-md-8">
                    {{ $reservasi->email }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Tanggal Reservasi:</strong>
                </div>
                <div class="col-md-8">
                    {{ $reservasi->tgl_reservasi }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Jam Reservasi:</strong>
                </div>
                <div class="col-md-8">
                    {{ $reservasi->jam_reservasi }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Jenis Pembayaran:</strong>
                </div>
                <div class="col-md-8">
                    {{ $reservasi->jenis_pembayaran }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Status:</strong>
                </div>
                <div class="col-md-8">
                    @if ($reservasi->status == 'Belum Disetujui')
                        <form action="{{route('reservasi.update', $reservasi->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="Disetujui">
                            <button type="submit" class="btn btn-sm btn-danger">Belum Disetujui</button>
                        </form>
                    @elseif ($reservasi->status == 'Disetujui')
                        <form action="{{route('reservasi.update', $reservasi->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="Telah Selesai">
                        <button type="submit" class="btn btn-sm btn-warning">Disetujui</button>
                        </form>
                    @else
                        <span class="badge badge-success">Telah Selesai</span>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Meja:</strong>
                </div>
                <div class="col-md-8">
                    Kode : {{ $reservasi->meja->kode }} <br>
                    Kapasitas : {{ $reservasi->meja->kapasitas }} orang
                </div>
            </div>
            @if($reservasi->bukti)
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Bukti:</strong>
                </div>
                <div class="col-md-8">
                    <img src="{{ asset('admin/img/bukti/'.$reservasi->bukti) }}" alt="Bukti" class="img-fluid">
                </div>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
