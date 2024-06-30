@extends('admin.layouts.app')

@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Produk</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Produk</a></li>
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
                    @foreach ($produk as $p)
                    <form method="post" action="{{ route('produk.update', $p->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="text1" class="col-4 col-form-label">Kode</label> 
                            <div class="col-8">
                                <input id="text1" name="kode" type="text" class="form-control" value="{{$p->kode}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text2" class="col-4 col-form-label">Nama</label> 
                            <div class="col-8">
                                <input id="text2" name="nama" type="text" class="form-control" value="{{$p->nama}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text4" class="col-4 col-form-label">Harga Awal</label> 
                            <div class="col-8">
                                <input id="text4" name="harga_awal" type="text" class="form-control" value="{{$p->harga_awal}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text4" class="col-4 col-form-label">Harga</label> 
                            <div class="col-8">
                                <input id="text4" name="harga" type="text" class="form-control" value="{{$p->harga}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text4" class="col-4 col-form-label">Stok</label> 
                            <div class="col-8">
                                <input id="text4" name="stok" type="text" class="form-control" value="{{$p->stok}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text4" class="col-4 col-form-label">Tanggal Kedaluarsa</label> 
                            <div class="col-8">
                                <input id="text4" name="tgl_exp" type="date" class="form-control" value="{{$p->tgl_exp}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="foto" class="col-4 col-form-label">Foto</label> 
                            <div class="col-8">
                                <input id="foto" name="foto" type="file" class="form-control" value="{{$p->foto}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="textarea" class="col-4 col-form-label">Deskripsi</label> 
                            <div class="col-8">
                                <textarea id="textarea" name="deskripsi" cols="40" rows="5" class="form-control" value="{{$p->deskripsi}}"></textarea>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">Kategori Produk</label> 
                            <div class="col-8">
                                <select id="select" name="kategori_produk_id" class="custom-select">
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
