@extends('front.layouts.app')
@section('konten')

<style>
.btn-category {
    background-color: #d3d3d3; /* light grey */
    color: #000;
    border: none;
    padding: 10px 20px;
    margin: 5px;
    cursor: pointer;
    border-radius: 20px;
    transition: background-color 0.3s ease;
}
.btn-category:hover{
    background-color: #ffd700;
    cursor: pointer;
}
.btn-category.active {
    background-color: #ffd700; /* yellow */
    color: #000;
}
.food-img img {
    max-width: 100%;
    height: auto;
}

</style>

<!-- Banner Area Starts -->
<section class="banner-area banner-area3 menu-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><i>Menu Kami</i></h1>
                <p class="pt-2"><i>Rasakan keajaiban dari produk-produk pilihan kami yang tidak akan terlupakan.</i></p>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- Food Area starts -->
<section class="food-area section-padding">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <a href="{{ url('/menu') }}" class="btn btn-category {{ request('kategori') ? '' : 'active' }}">Semua Produk</a>
                @foreach($kategori_produk as $kategori)
                    <a href="{{ url('/menu?kategori=' . $kategori->id) }}" class="btn btn-category {{ request('kategori') == $kategori->id ? 'active' : '' }}">{{ $kategori->nama_kategori }}</a>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="section-top">
                    @if(request('kategori'))
                        @php
                            $kategori = $kategori_produk->firstWhere('id', request('kategori'));
                        @endphp
                        <h3><span class="style-change"></span> <br>{{ $kategori->nama_kategori }}</h3>
                    @else
                        <h3><span class="style-change"></span> <br>Semua Produk</h3>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($produk as $p)
            <div class="col-md-4 col-sm-6">
                <div class="single-food mt-5">
                    <div class="food-img">
                        <img src="{{ asset('admin/img/produk/'.$p->kategori_produk->nama_kategori.'/'.$p->foto) }}" class="img-fluid" alt="">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5>{{ $p->nama }}</h5>
                            <span class="style-change">Rp{{ number_format($p->harga, 0, ',', '.') }}</span>
                        </div>
                        <p class="pt-3">{{ $p->deskripsi }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Food Area End -->
@endsection
