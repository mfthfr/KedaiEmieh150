@extends('admin.layouts.app')

@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Reservasi Meja</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Tambah Reservasi Meja</a></li>
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
                <form method="post" action="{{route('reservasi.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="text1" class="col-4 col-form-label">Kode</label> 
                        <div class="col-8">
                            <input id="text1" name="kode" type="text" class="form-control @error('kode') is-invalid @enderror" value="{{$kodeReservasi}}" readonly>
                            @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text2" class="col-4 col-form-label">Nama</label> 
                        <div class="col-8">
                            <input id="text2" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text4" class="col-4 col-form-label">Nomor Telepon</label> 
                        <div class="col-8">
                            <input id="text4" name="no_telepon" type="text" class="form-control @error('no_telepon') is-invalid @enderror">
                            @error('no_telepon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="text4" class="col-4 col-form-label">Email</label> 
                        <div class="col-8">
                            <input id="text4" name="email" type="text" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_reservasi" class="col-4 col-form-label">Tanggal Reservasi</label> 
                        <div class="col-8">
                            <input id="tgl_reservasi" name="tgl_reservasi" type="date" class="form-control @error('tgl_reservasi') is-invalid @enderror">
                            @error('tgl_reservasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jam_reservasi" class="col-4 col-form-label">Jam Reservasi</label> 
                        <div class="col-8">
                            <input id="jam_reservasi" name="jam_reservasi" type="time" class="form-control @error('jam_reservasi') is-invalid @enderror">
                            <p style="font-size: small; color: red;"><i>*Warung buka pukul 16.00 WIB</i></p>
                            @error('jam_reservasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_pembayaran" class="col-4 col-form-label">Jenis Pembayaran</label>
                        <div class="col-8 d-flex align-items-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('jenis_pembayaran') is-invalid @enderror" type="radio" name="jenis_pembayaran" id="transfer" value="transfer" {{ old('jenis_pembayaran') == 'transfer' ? 'checked' : '' }}>
                                <label class="form-check-label" for="transfer">
                                    Transfer
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('jenis_pembayaran') is-invalid @enderror" type="radio" name="jenis_pembayaran" id="cash" value="cash" {{ old('jenis_pembayaran') == 'cash' ? 'checked' : '' }}>
                                <label class="form-check-label" for="cash">
                                    Cash
                                </label>
                            </div>
                            @error('jenis_pembayaran')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select" class="col-4 col-form-label">Status</label> 
                        <div class="col-8">
                            <select id="select" name="status" class="custom-select @error('status') is-invalid @enderror">
                                    <option value="Disetujui">Disetujui</option>
                                    <option value="Belum Disetujui">Belum Disetujui</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                                <input type="radio" name="meja_id" value="{{ $m->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @error('meja_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
    document.addEventListener('DOMContentLoaded', function() {
        const tglReservasi = document.getElementById('tgl_reservasi');
        const jamReservasi = document.getElementById('jam_reservasi');
        
        function checkAvailability() {
            const tanggal = tglReservasi.value;
            const waktu = jamReservasi.value;

            if (tanggal && waktu) {
                console.log('Sending request to check availability...'); // Debugging line
                fetch('{{ route("admin.reservasi.checkAvailability") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ tanggal: tanggal, waktu: waktu })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Received response:', data); // Debugging line
                    const mejaList = document.getElementById('mejaList').querySelector('tbody');
                    mejaList.querySelectorAll('tr').forEach(tr => {
                        const mejaId = tr.getAttribute('data-meja-id');
                        const statusTd = tr.querySelector('.meja-status');
                        const radioInput = tr.querySelector('input[type="radio"]');
                        
                        const availability = data.find(m => m.meja_id == mejaId);
                        if (availability.status === 'Dalam Pesanan') {
                            statusTd.textContent = 'Dalam Pesanan';
                            radioInput.disabled = true;
                        } else {
                            statusTd.textContent = 'Tersedia';
                            radioInput.disabled = false;
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
            }
        }

        tglReservasi.addEventListener('change', checkAvailability);
        jamReservasi.addEventListener('change', checkAvailability);
    });
</script>

@endsection
