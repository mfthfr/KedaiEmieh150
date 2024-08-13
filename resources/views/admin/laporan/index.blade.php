@extends('admin.layouts.app')

@section('konten')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Laporan Penjualan</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Laporan Penjualan</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <br>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('laporan.create') }}" class="btn btn-md btn-primary">
                        Tambah
                    </a>
                    <!-- <form method="GET" action="{{ route('laporan.index') }}" class="form-inline float-right">
                        <div class="form-group mb-2">
                            <label for="tgl_laporan" class="sr-only">Tanggal</label>
                            <input type="date" class="form-control" id="tgl_laporan" name="tgl_laporan" placeholder="Tanggal">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="bulan" class="sr-only">Bulan</label>
                            <input type="month" class="form-control" id="bulan" name="bulan" placeholder="Bulan">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Filter</button>
                    </form> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered no-wrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Tanggal Laporan</th>
                                    <th>Total Pendapatan</th>
                                    <th>Total Pendapatan Bersih</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1 @endphp
                                @foreach ($laporan as $l)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $l->kode }}</td>
                                    <td>{{ $l->tgl_laporan }}</td>
                                    <td>{{ $l->total_pendapatan }}</td>
                                    <td>{{ $l->total_pendapatan_bersih }}</td>
                                    <td>
                                        <a href="{{ route('laporan.downloadPDF', $l->id) }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{$l->id}}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="deleteModal{{$l->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h3 class="modal-title" id="deleteModalLabel">Hapus Laporan</h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                Apakah anda yakin ingin menghapus laporan <br><b>{{$l->kode}}</b>?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Kembali</button>
                                                <form action="{{ route('laporan.destroy', $l->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <!-- Batas Modal Hapus -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
