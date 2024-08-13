@extends('admin.layouts.app')

@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Produk</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('produk.index') }}" class="text-muted">Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ $produk->nama }}</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Kode</th>
                                    <td>{{ $produk->kode }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $produk->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Harga Awal</th>
                                    <td>{{ $produk->harga_awal }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>{{ $produk->harga }}</td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td>{{ $produk->stok }}</td>
                                </tr>
                                <tr>
                                    <th>Diskon</th>
                                    <td>{{ $produk->diskon }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Kedaluarsa</th>
                                    <td>{{ $produk->tgl_exp }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $produk->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori Produk</th>
                                    <td>{{ $produk->kategori_produk_id }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            @if($produk->foto)
                                <img src="{{ asset('admin/img/produk/'.$produk->kategori_produk->nama_kategori.'/'.$produk->foto) }}" alt="Gambar Produk" style="max-width: 100%; height: auto;">
                            @else
                                <img src="{{ asset('admin/img/produk/default.png') }}" alt="Gambar Produk" style="max-width: 100%; height: auto;">
                            @endif
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-primary">Edit Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
