@extends('admin.layouts.app')
@section('konten')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Transaksi Penjualan</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Transaksi Penjualan</a></li>
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
            <a href="{{route('transaksi.create')}}" class="btn btn-md btn-primary">
                Tambah
            </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered no-wrap">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Kode</th>
                          <th>Tanggal Transaksi</th>
                          <th>Total Harga</th>
                          <th>Status</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @php $no=1 @endphp
                      @foreach ($transaksi as $t)
                      <tr>
                          <td>{{$no++}}</td>
                          <td>{{$t->kode}}</td>
                          <td>{{$t->tgl_transaksi}}</td>
                          <td>{{$t->total_harga}}</td>
                          <td>
                            @if ($t->status == 'Belum Dibayar')
                                <form action="{{route('transaksi.update', $t->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="Lunas">
                                <button type="submit" class="btn btn-sm btn-warning">Belum Dibayar</button>
                                </form>
                            @else
                                <span class="badge badge-success">Lunas</span>
                            @endif
                          </td>
                          <td>
                              <a href="" class="btn btn-sm btn-warning">
                                  <i class="fas fa-edit"></i>
                              </a>
                              <a href="{{route('transaksi.show', $t->id)}}" class="btn btn-sm btn-success">
                                  <i class="fas fa-eye"></i>
                              </a>
                              <!-- Tombol Hapus -->
                              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{$t->id}}">
                                <i class="fas fa-trash"></i>
                              </button>
                              <!-- Modal Hapus -->
                              <div class="modal fade" id="deleteModal{{$t->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h3 class="modal-title" id="deleteModalLabel">Hapus Kategori Produk</h3>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Apakah anda yakin ingin menghapus reservasi dengan kode <br><b>{{$t->kode}}</b>?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Kembali</button>
                                      <form action="" method="POST" style="display:inline;">
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