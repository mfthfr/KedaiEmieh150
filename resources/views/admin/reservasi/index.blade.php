@extends('admin.layouts.app')
@section('konten')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Reservasi Meja</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Reservasi Meja</a></li>
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
            <a href="{{route('reservasi.create')}}" class="btn btn-md btn-primary">
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
                          <th>Nama</th>
                          <th>Tanggal</th>
                          <th>Jam</th>
                          <th>Status</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @php $no=1 @endphp
                      @foreach ($reservasi as $r)
                      <tr>
                          <td>{{$no++}}</td>
                          <td>{{$r->kode}}</td>
                          <td>{{$r->nama}}</td>
                          <td>{{$r->tgl_reservasi}}</td>
                          <td>{{$r->jam_reservasi}}</td>
                          <td>
                            @if ($r->status == 'Belum Disetujui')
                                <form action="{{route('reservasi.update', $r->id)}}" method="POST">
                                  @csrf
                                  @method('PATCH')
                                  <input type="hidden" name="status" value="Disetujui">
                                  <button type="submit" class="btn btn-sm btn-danger">Belum Disetujui</button>
                                </form>
                            @elseif ($r->status == 'Disetujui')
                                <form action="{{route('reservasi.update', $r->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="Telah Selesai">
                                <button type="submit" class="btn btn-sm btn-warning">Disetujui</button>
                                </form>
                            @else
                                <span class="badge badge-success">Telah Selesai</span>
                            @endif
                          </td>
                          <td>
                              <a href="" class="btn btn-sm btn-warning">
                                  <i class="fas fa-edit"></i>
                              </a>
                              <a href="{{route('reservasi.show', $r->id)}}" class="btn btn-sm btn-success">
                                  <i class="fas fa-eye"></i>
                              </a>
                              <!-- Tombol Hapus -->
                              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{$r->id}}">
                                <i class="fas fa-trash"></i>
                              </button>
                              <!-- Modal Hapus -->
                              <div class="modal fade" id="deleteModal{{$r->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h3 class="modal-title" id="deleteModalLabel">Hapus Kategori Produk</h3>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Apakah anda yakin ingin menghapus reservasi dengan kode <br><b>{{$r->kode}}</b>?
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