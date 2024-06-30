@extends('front.layouts.app')

@section('konten')
<style>
    .form-container {
        max-width: 700px; /* Atur lebar maksimum form */
        margin: 0 auto; /* Pusatkan form */
    }
    .form-container .form-group {
        margin-bottom: 15px; /* Kurangi jarak antar elemen form */
    }
    .form-container input, 
    .form-container select, 
    .form-container textarea {
        padding: 5px; /* Kurangi padding dalam elemen form */
    }
    .form-container .form-check {
        margin-right: 10px; /* Atur jarak antar elemen radio */
    }
</style>

<section class="banner-area banner-area2 menu-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 align="center"><i>Reservasi Meja</i></h1>
                <p class="pt-2 text-center"><i>Cukup dia aja yang gak pasti, acaramu harus pasti dengan reservasi meja terlebih dahulu</i></p>
                <div class="card form-container">
                <div class="card-body">
                <form method="post" action="{{route('front.reservasi.store')}}" enctype="multipart/form-data" id="reservationForm">
                    @csrf
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
                        <label for="rekeningButton" class="col-4 col-form-label">Nomor Rekening</label>
                        <div class="col-8">
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#rekeningModal">
                                Lihat Detail Rekening
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bukti" class="col-4 col-form-label">Bukti</label> 
                        <div class="col-8">
                            <input id="bukti" name="bukti" type="file" class=" @error('bukti') is-invalid @enderror">
                            @error('bukti')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" onclick="resetForm()">Reset</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="rekeningModal" tabindex="-1" role="dialog" aria-labelledby="rekeningModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rekeningModalLabel">Detail Nomor Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bank: BRI</p>
                <p>Atas Nama: Admin Kedai</p>
                <p>Nomor Rekening: <span id="nomorRekening">33365657876</span></p>
                <button class="btn btn-primary" onclick="copyToClipboard()">Salin Nomor Rekening</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard() {
        const nomorRekening = document.getElementById('nomorRekening').textContent;
        
        navigator.clipboard.writeText(nomorRekening).then(function() {
            alert('Nomor rekening telah disalin!');
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const tglReservasi = document.getElementById('tgl_reservasi');
        const jamReservasi = document.getElementById('jam_reservasi');
        
        function checkAvailability() {
            const tanggal = tglReservasi.value;
            const waktu = jamReservasi.value;

            if (tanggal && waktu) {
                console.log('Sending request to check availability...'); // Debugging line
                fetch('{{ route("front.reservasi.checkAvailability") }}', {
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

    function resetForm() {
        document.getElementById('reservationForm').reset();
    }
</script>

@endsection
