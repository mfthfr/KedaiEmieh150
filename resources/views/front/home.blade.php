@extends('front.layouts.app')
@section('konten')
<section class="banner-area text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"></div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- Welcome Area Starts -->
<section class="welcome-area section-padding2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <div class="welcome-img">
                    <img src="{{ asset('front/assets/images/miefoto1.png') }}" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-md-6 align-self-center">
                <div class="welcome-text mt-5 mt-md-0">
                    <h3><span class="style-change">welcome</span> <br>to Kedai Emieh 150</h3>
                    <p class="pt-3">Kedai Emieh merupakan sebuah kedai berlokasi di Jl. Terusan Bridgen Katamso no 150 yang berfokus pada penjualan aneka mie goreng, mie kuah, ramen dan samyang.</p>
                    <p>Kami berharap Kedai Emieh 150 menjadi destinasi utama bagi pecinta mie yang mencari pengalaman kuliner yang unik dan memuaskan dengan konsep prasmanan.</p>
                    <a href="#" class="template-btn mt-3">Reservasi Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Welcome Area End -->

<!-- Best Seller Food Area Starts -->
<section class="food-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="section-top">
                    <h3><span class="style-change">Kedai Emieh 150</span> <br>Best Seller Food</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($bestSeller as $produk)
            <div class="col-md-4 col-sm-6">
                <div class="single-food">
                    <div class="food-img">
                        <img src="{{ asset('admin/img/produk/'.$produk->kategori_produk->nama_kategori.'/'.$produk->foto) }}" class="img-fluid" alt="{{ $produk->nama }}">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5>{{ $produk->nama }}</h5>
                            <span class="style-change" style="margin-left:20px;">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                        </div>
                        <p class="pt-3">{{ $produk->deskripsi }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Best Seller Food Area Ends -->

<!-- Discount Product Area Starts -->
<section class="food-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="section-top">
                    <h3><span class="style-change">Kedai Emieh 150</span> <br>Discount Product</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($discounted as $produk)
            <div class="col-md-4 col-sm-6">
                <div class="single-food">
                    <div class="food-img">
                        <img src="{{ asset('admin/img/produk/'.$produk->kategori_produk->nama_kategori.'/'.$produk->foto) }}" class="img-fluid" alt="{{ $produk->nama }}">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5>{{ $produk->nama }}</h5>
                            <div>
                                <span class="style-change text-muted" style="text-decoration: line-through;">Rp{{ number_format($produk->harga, 0, ',', '.') }}</span>
                                <span class="style-change text-warning">Rp{{ number_format($produk->harga - ($produk->harga * ($produk->diskon / 100)), 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <p class="pt-3">{{ $produk->deskripsi }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Discount Product Area Ends -->
@endsection
