@extends('admin.layouts.app')

@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Reservasi Meja</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Edit Reservasi Meja</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('reservasi.update', $reservasi->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="text1" class="col-4 col-form-label">Kode</label> 
                            <div class="col-8">
                                <input id="text1" name="kode" type="text" class="form-control" value="{{ $reservasi->kode }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text2" class="col-4 col-form-label">Nama</label> 
                            <div class="col-8">
                                <input id="text2" name="nama" type="text" class="form-control" value="{{ $reservasi->nama }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text4" class="col-4 col-form-label">Nomor Telepon</label> 
                            <div class="col-8">
                                <input id="text4" name="no_telepon" type="text" class="form-control" value="{{ $reservasi->no_telepon }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text4" class="col-4 col-form-label">Email</label> 
                            <div class="col-8">
                                <input id="text4" name="email" type="text" class="form-control" value="{{ $reservasi->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_reservasi" class="col-4 col-form-label">Tanggal Reservasi</label> 
                            <div class="col-8">
                                <input id="tgl_reservasi" name="tgl_reservasi" type="date" class="form-control" value="{{ $reservasi->tgl_reservasi }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_reservasi" class="col-4 col-form-label">Jam Reservasi</label> 
                            <div class="col-8">
                                <input id="jam_reservasi" name="jam_reservasi" type="time" class="form-control" value="{{ $reservasi->jam_reservasi }}">
                                <p style="font-size: small; color: red;"><i>*Warung buka pukul 16.00 WIB</i></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_pembayaran" class="col-4 col-form-label">Jenis Pembayaran</label>
                            <div class="col-8 d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_pembayaran" id="transfer" value="transfer" {{ $reservasi->jenis_pembayaran == 'transfer' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="transfer">
                                        Transfer
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_pembayaran" id="cash" value="cash" {{ $reservasi->jenis_pembayaran == 'cash' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cash">
                                        Cash
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">Status</label> 
                            <div class="col-8">
                                <select id="select" name="status" class="custom-select">
                                    <option value="Belum Disetujui" {{ $reservasi->status == 'Belum Disetujui' ? 'selected' : '' }}>Belum Disetujui</option>
                                    <option value="Disetujui" {{ $reservasi->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="Telah Selesai" {{ $reservasi->status == 'Telah Selesai' ? 'selected' : '' }}>Telah Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meja_list" class="col-4 col-form-label">Meja</label> 
                            <div class="col-8">
                                <table class="table table-bordered" id="mejaList">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Kapasitas</th>
                                            <th>Status</th>
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($meja as $m)
                                            <tr data-meja-id="{{ $m->id }}">
                                                <td>{{ $m->kode }}</td>
                                                <td>{{ $m->kapasitas }} Orang</td>
                                                <td class="meja-status">Tersedia</td>
                                                <td>
                                                    <input type="radio" name="meja_id" value="{{ $m->id }}" {{ $reservasi->meja_id == $m->id ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file" class="col-4 col-form-label">Bukti Pembayaran</label> 
                            <div class="col-8">
                                <input id="file" name="bukti" type="file" class="form-control">
                                <img src="{{ asset('admin/img/bukti/'.$reservasi->bukti) }}" alt="Bukti Pembayaran" class="img-fluid mt-2">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tglReservasi = document.getElementById('tgl_reservasi');
        const jamReservasi = document.getElementById('jam_reservasi');

        function checkAvailability() {
            const tanggal = tglReservasi.value;
            const waktu = jamReservasi.value;

            if (tanggal && waktu) {
                fetch("{{ route('admin.reservasi.checkAvailability') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        tgl_reservasi: tanggal,
                        jam_reservasi: waktu
                    })
                })
                .then(response => response.json())
                .then(data => {
                    const mejaList = document.getElementById('mejaList').querySelectorAll('tbody tr');
                    mejaList.forEach(row => {
                        const mejaId = row.getAttribute('data-meja-id');
                        const statusCell = row.querySelector('.meja-status');

                        if (data.reservedMejaIds.includes(parseInt(mejaId))) {
                            statusCell.innerText = 'Dipesan';
                            row.querySelector('input[type="radio"]').disabled = true;
                        } else {
                            statusCell.innerText = 'Tersedia';
                            row.querySelector('input[type="radio"]').disabled = false;
                        }
                    });
                });
            }
        }

        tglReservasi.addEventListener('change', checkAvailability);
        jamReservasi.addEventListener('change', checkAvailability);
    });
</script>

@endsection
