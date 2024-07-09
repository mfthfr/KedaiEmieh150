@extends('admin.layouts.app')

@section('konten')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Buat Laporan Penjualan</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('laporan.index') }}" class="text-muted">Laporan</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Buat Laporan</li>
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
                    <form action="{{ route('laporan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kode">Kode Laporan</label>
                            <input type="text" name="kode" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_laporan">Tanggal Laporan</label>
                            <input type="date" name="tgl_laporan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <select name="periode" class="form-control" required>
                                <option value="harian">Harian</option>
                                <option value="bulanan">Bulanan</option>
                            </select>
                        </div>
                        <div id="transaksi-harian" class="form-group" style="display: none;">
                            <label for="transaksi">Transaksi Harian</label>
                            <select name="transaksi[]" class="form-control" multiple>
                                @foreach($transaksiHarian as $transaksi)
                                    <option value="{{ $transaksi->tanggal }}">{{ $transaksi->tanggal }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="transaksi-bulanan" class="form-group" style="display: none;">
                            <label for="transaksi">Transaksi Bulanan</label>
                            <select name="transaksi[]" class="form-control" multiple>
                                @foreach($transaksiBulanan as $transaksi)
                                    <option value="{{ $transaksi->bulan }}">{{ date('F', mktime(0, 0, 0, $transaksi->bulan, 10)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Buat Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('select[name="periode"]').addEventListener('change', function() {
        var selected = this.value;
        if (selected == 'harian') {
            document.getElementById('transaksi-harian').style.display = 'block';
            document.getElementById('transaksi-bulanan').style.display = 'none';
        } else {
            document.getElementById('transaksi-harian').style.display = 'none';
            document.getElementById('transaksi-bulanan').style.display = 'block';
        }
    });
</script>
@endsection
