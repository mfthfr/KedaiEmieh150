<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Kedai Emieh 150</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('front')}}/assets/images/logo/" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('front')}}/assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="{{asset('front')}}/assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="{{asset('front')}}/assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="{{asset('front')}}/assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="{{asset('front')}}/assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="{{asset('front')}}/assets/css/style.css">
</head>
<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
	<header class="header-area" style="border-radius: 100px; background-color: white; padding: 5px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area" style="padding-left: 3px;">
                        <a href="index.html"><img src="{{asset('front')}}/assets/images/logo/kedaiemiehlogotrans.png" alt="logo" ></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>  
                    <div class="main-menu" style="padding: 8px;" >
                        <ul>
                            <li class="active" ><a href="{{url('/')}}">home</a></li>
                            <li><a href="{{url('/reservasi')}}">Reservasi Meja</a></li>
                            <li><a href="">Menu</a></li>
                            <li><a href="">contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('konten')

    <footer class="footer-area">
        <div class="footer-widget section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-widget single-widget1">
                            <a href="index.html"><img src="{{asset('front')}}/assets/images/logo/kedaiemiehputih.png" alt=""></a>
                            <p class="mt-3">Kedai Emieh merupakan sebuah kedai berlokasi di Jl. Terusan Bridgen Katamso no 150 yang berfokus pada penjualan aneka mie goreng, mie kuah, ramen dan samyang</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-widget single-widget2 my-5 my-md-0">
                            <h5 class="mb-4">contact us</h5>
                            <div class="d-flex">
                                <div class="into-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="info-text">
                                    <p>Jl. Terusan Bridgen Katamso no 150</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="into-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="info-text">
                                    <p>087735559884</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="into-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="info-text">
                                    <p>kedaiemieh@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-widget single-widget3">
                            <h5 class="mb-4">opening hours</h5>
                            <p>Senin - Jum'at .............. 15 pm - 22 pm</p>
                            <p>Minggu ............. 15 pm - 22 pm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="social-icons">
                            <ul>
                                <li class="no-margin">Follow Us</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->


    <!-- Javascript -->
    <script src="{{asset('front')}}/assets/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="{{asset('front')}}/assets/js/vendor/bootstrap-4.1.3.min.js"></script>
    <script src="{{asset('front')}}/assets/js/vendor/wow.min.js"></script>
    <script src="{{asset('front')}}/assets/js/vendor/owl-carousel.min.js"></script>
    <script src="{{asset('front')}}/assets/js/vendor/jquery.datetimepicker.full.min.js"></script>
    <script src="{{asset('front')}}/assets/js/vendor/jquery.nice-select.min.js"></script>
    <script src="{{asset('front')}}/assets/js/main.js"></script>
</body>
</html>