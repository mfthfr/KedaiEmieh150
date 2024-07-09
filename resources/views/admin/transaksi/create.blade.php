@extends('admin.layouts.app')

@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Input Data Pembayaran</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Input Data Pembayaran</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="kode" class="col-4 col-form-label">Kode Transaksi:</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="kode" name="kode" value="{{ $kodeTransaksi }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_transaksi" class="col-4 col-form-label">Tanggal Transaksi:</label>
                        <div class="col-8">
                            <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_pembayaran" class="col-4 col-form-label">Metode Pembayaran:</label>
                        <div class="col-8">
                            <select class="form-control" id="jenis_pembayaran" name="jenis_pembayaran" required>
                                <option value="tunai">Tunai</option>
                                <option value="kartu_kredit">Kartu Kredit</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-4 col-form-label">Status Pembayaran:</label>
                        <div class="col-8">
                            <select class="form-control" id="status" name="status" required>
                                <option value="Belum Dibayar">Belum Dibayar</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="produk" class="col-4 col-form-label">Produk:</label>
                        <div class="col-8">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produk as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ $p->harga }}</td>
                                            <td>
                                                <button type="button" class="btn btn-success add-product" data-id="{{ $p->id }}" data-nama="{{ $p->nama }}" data-harga="{{ $p->harga }}">+</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="produk_terpilih" class="col-4 col-form-label">Produk Terpilih:</label>
                        <div class="col-8">
                            <table class="table table-bordered" id="produk_terpilih">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Produk yang dipilih akan ditambahkan di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="total_harga" class="col-4 col-form-label">Total Harga:</label>
                        <div class="col-8">
                            <input type="number" class="form-control" id="total_harga" name="total_harga" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
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
        let produkTerpilih = [];

        document.querySelectorAll('.add-product').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const harga = parseFloat(this.getAttribute('data-harga'));

                let produk = produkTerpilih.find(p => p.id == id);
                if (produk) {
                    produk.jumlah++;
                } else {
                    produkTerpilih.push({ id: id, nama: nama, harga: harga, jumlah: 1 });
                }
                updateProdukTerpilih();
            });
        });

        function updateProdukTerpilih() {
            const tbody = document.querySelector('#produk_terpilih tbody');
            tbody.innerHTML = '';

            let totalHarga = 0;

            produkTerpilih.forEach(produk => {
                totalHarga += produk.harga * produk.jumlah;
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${produk.nama}</td>
                    <td>${produk.jumlah}</td>
                    <td>${produk.harga * produk.jumlah}</td>
                    <td><button type="button" class="btn btn-danger remove-product" data-id="${produk.id}">-</button></td>
                    <input type="hidden" name="produk[${produk.id}][id]" value="${produk.id}">
                    <input type="hidden" name="produk[${produk.id}][jumlah]" value="${produk.jumlah}">
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('total_harga').value = totalHarga;

            document.querySelectorAll('.remove-product').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    produkTerpilih = produkTerpilih.filter(p => p.id != id);
                    updateProdukTerpilih();
                });
            });
        }
    });
</script>

@endsection
