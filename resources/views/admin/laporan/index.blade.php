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
                                        <form action="{{ route('laporan.destroy', $l->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
