@extends('admin.layouts.app')
@section('konten')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1">Kategori Produk</h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="" class="text-muted">Kategori Produk</a></li>
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
        <h3 class="modal-title" id="exampleModalLabel">Tambah Kategori Produk</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('admin/kategori_produk/store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="nama_kategori" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Kategori Produk">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
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
                                  <th>Kategori Produk</th>
                                  <th>Aksi</th>
                              </tr>
                          </thead>
                          <tbody>
                              @php $no=1 @endphp
                              @foreach ($kategori as $k)
                              <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$k->nama_kategori}}</td>
                                  <td>
                                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal{{$k->id}}">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                      <!-- Modal Update -->
                                      <div class="modal fade" id="updateModal{{$k->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel{{$k->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="modal-title" id="updateModalLabel{{$k->id}}">Update Kategori Produk</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{url('admin/kategori_produk/update/'.$k->id)}}" method="post" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="text" name="nama_kategori" class="form-control" value="{{$k->nama_kategori}}" placeholder="Kategori Produk">
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Tombol Hapus -->
                                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{$k->id}}">
                                        <i class="fas fa-trash"></i>
                                      </button>
  
                                      <!-- Modal Hapus -->
                                      <div class="modal fade" id="deleteModal{{$k->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="modal-title" id="deleteModalLabel">Hapus Kategori Produk</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              Apakah anda yakin ingin menghapus kategori produk <br><b>{{$k->nama_kategori}}</b>?
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                              <form action="{{ route('kategori_produk.destroy', $k->id) }}" method="POST" style="display:inline;">
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