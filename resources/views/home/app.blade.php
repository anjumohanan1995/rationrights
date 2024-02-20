<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rateup</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    {{-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/gov2.jpeg') }}">

    <!-- CSS
 ============================================ -->

    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/flaticon.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/jquery.powertip.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/magnific-popup.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">


    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->
    <!-- <link rel="stylesheet" href="css/vendor/plugins.min.css">
    <link rel="stylesheet" href="css/style.min.css"> -->

</head>

<body>

    <div class="main-wrapper">
        <!-- Preloader start -->
        <div class="theme-loader theme-loader-02">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
        <!-- Preloader end -->

        <!-- Header Start  -->
        <div class="section header header-02 header-03 header-04">
            <div class="container">

                <div class="header-wrap">

                    <!--  Header Logo Start  -->
                    <div class="header-logo">
                        <a href="/"> <img src="{{ asset('img/gov.jpeg') }}"   class="ms-5 logo-img" ></a>

                    </div>
                    <!--  Header Logo End  -->

                    <!--  Header Menu Start  -->
                    <div class="header-menu d-none d-lg-block">

                    </div>
                    <!--  Header Menu End  -->

                    <!-- Header Meta Start -->
                    <div class="header-meta">



                        <div class="header-login d-lg-block">
                            <a class="link link-btn" href="{{url('login-pannel')}}">Login</a>

                        </div>



                    </div>
                    <!-- Header Meta End -->

                </div>

            </div>
        </div>
        <!-- Header End -->

        @yield('content')



    </div>
    <!-- Hero End -->

    <!-- Category Start -->
    <div class="section eduhut-category-section eduhut-category-section-04 section-padding">

    <!-- Brand Logo End -->

    <!-- Footer Start -->
    <div class="footer-section footer-section-03 section">
        <div class="container">

            <div class="copyright-text">
                    <p>© Copyrights 2023 RateUp Developed by <a href="https://kawikatechnologies.com/" target="_blank">Kawika Technologies</a>. All rights reserved.</p>
            </div>

        </div>
    </div>
    <!-- Footer End -->

    <!-- back to top start -->
    <div class="progress-wrap progress-wrap-02">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

</div>

<!-- JS
============================================ -->
<script src="{{ asset('home/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('home/js/modernizr-3.11.2.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="{{ asset('home/js/popper.min.js') }}"></script>
<script src="{{ asset('home/js/bootstrap.min.js') }}"></script>

<!-- Plugins JS -->
<script src="{{ asset('home/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('home/js/aos.js') }}"></script>
<script src="{{ asset('home/js/waypoints.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.powertip.min.js') }}"></script>
<script src="{{ asset('home/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('home/js/back-to-top.js') }}"></script>
<script src="{{ asset('home/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->


<!-- Main JS -->
<script src="{{ asset('home/js/main.js') }}"></script>
<style>
.type1{
background:white;
}
</style>
</body>

</html>








