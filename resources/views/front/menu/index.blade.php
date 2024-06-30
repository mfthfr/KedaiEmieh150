@extends('front.layouts.app')
@section('konten')
<!-- Banner Area Starts -->
<section class="banner-area banner-area3 menu-bg text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><i>Our Menu</i></h1>
                <p class="pt-2"><i>Beast kind form divide night above let moveth bearing darkness.</i></p>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- Food Area starts -->
<section class="food-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="section-top">
                    <h3><span class="style-change"></span> <br>Aneka Mie</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="single-food">
                    <div class="food-img">
                        <img src="{{asset('front')}}/assets/images/food1.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5>Mexican Eggrolls</h5>
                            <span class="style-change">$14.50</span>
                        </div>
                        <p class="pt-3">Face together given moveth divided form Of Seasons that fruitful.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-food mt-5 mt-sm-0">
                    <div class="food-img">
                        <img src="{{asset('front')}}/assets/images/food2.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5>chicken burger</h5>
                            <span class="style-change">$9.50</span>
                        </div>
                        <p class="pt-3">Face together given moveth divided form Of Seasons that fruitful.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-food mt-5 mt-md-0">
                    <div class="food-img">
                        <img src="{{asset('front')}}/assets/images/food3.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5>topu lasange</h5>
                            <span class="style-change">$12.50</span>
                        </div>
                        <p class="pt-3">Face together given moveth divided form Of Seasons that fruitful.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-food mt-5">
                    <div class="food-img">
                        <img src="{{asset('front')}}/assets/images/food4.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5>pepper potatoas</h5>
                            <span class="style-change">$14.50</span>
                        </div>
                        <p class="pt-3">Face together given moveth divided form Of Seasons that fruitful.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-food mt-5">
                    <div class="food-img">
                        <img src="{{asset('front')}}/assets/images/food5.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5>bean salad</h5>
                            <span class="style-change">$8.50</span>
                        </div>
                        <p class="pt-3">Face together given moveth divided form Of Seasons that fruitful.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-food mt-5">
                    <div class="food-img">
                        <img src="{{asset('front')}}/assets/images/food6.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="food-content">
                        <div class="d-flex justify-content-between">
                            <h5>beatball hoagie</h5>
                            <span class="style-change">$11.50</span>
                        </div>
                        <p class="pt-3">Face together given moveth divided form Of Seasons that fruitful.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Food Area End -->
@endsection