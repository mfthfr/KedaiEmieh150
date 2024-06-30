@extends('admin.layouts.app')
@section('konten')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Meja</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Meja</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <br>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Tambah Meja</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('admin/meja/store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="kode" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$kodeMeja}}" readonly>
            <input type="text" name="kapasitas" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Jumlah Kapasitas">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah
                </button>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table id="zero_config" class="table table-striped table-bordered no-wrap">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Kode</th>
                                  <th>Kapasitas</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              @php $no=1 @endphp
                              @foreach ($meja as $m)
                              <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$m->kode}}</td>
                                  <td>{{$m->kapasitas}}</td>
                                  <td>
                                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal{{$m->id}}">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                      <!-- Modal Update -->
                                      <div class="modal fade" id="updateModal{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{$m->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="modal-title" id="updateModalLabel{{$m->id}}">Update Meja</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{url('admin/meja/update/'.$m->id)}}" method="post" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="text" name="kode" class="form-control" value="{{$kodeMeja}}" readonly>
                                                  <input type="text" name="kapasitas" class="form-control" value="{{$m->kapasitas}}" placeholder="Masukkan Jumlah Kapasitas">
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                              <button type="submit" class="btn btn-primary">Simpan</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Tombol Hapus -->
                                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{$m->id}}">
                                        <i class="fas fa-trash"></i>
                                      </button>
  
                                      <!-- Modal Hapus -->
                                      <div class="modal fade" id="deleteModal{{$m->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="modal-title" id="deleteModalLabel">Hapus Meja</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              Apakah anda yakin ingin menghapus meja dengan kode <br><b>{{$m->kode}}</b>?
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Kembali</button>
                                              <form action="{{route('meja.destroy', $m->id)}}" method="POST" style="display:inline;">
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