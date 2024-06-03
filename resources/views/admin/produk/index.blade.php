@extends('admin.layouts.app')
@section('konten')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Stok Produk</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Produk</a></li>
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
            <a href="{{route('produk.create')}}" class="btn btn-md btn-primary">
                Tambah
            </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered no-wrap">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Harga</th>
                          <th>Stok</th>
                          <th>Tanggal Kedaluarsa</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @php $no=1 @endphp
                      @foreach ($produk as $p)
                      <tr>
                          <td>{{$no++}}</td>
                          <td>{{$p->nama}}</td>
                          <td>{{$p->harga}}</td>
                          <td>{{$p->stok}}</td>
                          <td>{{$p->tgl_exp}}</td>
                          <td>
                              <a href="{{route('produk.edit', $p->id)}}" class="btn btn-sm btn-warning">
                                  <i class="fas fa-edit"></i>
                              </a>
                              <!-- Tombol Hapus -->
                              <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{$p->id}}">
                                <i class="fas fa-trash"></i>
                              </button>
                              <!-- Modal Hapus -->
                              <div class="modal fade" id="deleteModal{{$p->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h3 class="modal-title" id="deleteModalLabel">Hapus Kategori Produk</h3>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      Apakah anda yakin ingin menghapus kategori produk <br><b>{{$p->nama_kategori}}</b>?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                      <form action="{{ route('kategori_produk.destroy', $p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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