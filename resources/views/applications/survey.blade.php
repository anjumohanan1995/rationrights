<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('form-css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('form-css/flaticon.css') }}">
	<title>Ration Card</title>
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('form-css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('form-css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('form-css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('form-css/jquery.powertip.min.css') }}">
    <link rel="stylesheet" href="{{ asset('form-css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('form-css/magnific-popup.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('form-css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('form-css/component.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
	<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
</head>

<body>
    <div class="main-wrapper">
        <div class="section header header-02 header-03 header-04">
            <div class="container">
                <div class="header-wrap">

                    <!--  Header Logo Start  -->
                    <div class="header-logo">
                        <a href="/"> <img src="{{ asset('img/gov.jpeg') }}" class="ms-5 logo-img" ></a>

                    </div>

                    <div class="header-meta">
                        <div class="header-login d-none d-lg-block">
                            <a class="link link-btn" href="{{url('login-pannel')}}">Login</a>
                        </div>
                        <div class="header-toggle d-lg-none">
                            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                    <!-- Header Meta End -->

                </div>
            </div>
        </div>
		<div class="section eduhut-features-section-03 section-padding mt-5 pt-5">
            <div class="container  p-5 register">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 rt-area">
                        <div class="pt-0  w-100 float-end text-center">
<input type="hidden" value="{{$data['district']}}">
<input type="hidden" value="{{$data['location']}}">
                            <br><br>
                                    <h3 >Select one option :</h3><br>
                                    <a href="{{url('applications/ration-aadhaar-form')}}" class="btn btn-success">
                                        I Have Ration Card & Aadhaar Card
                                    </a><br><br>

                                    <a href="{{url('applications/aadhaar-form')}}" class="btn btn-success">
                                        I Have Aadhaar Only (No Ration Card)
                                    </a><br><br>

                                    <a href="{{url('applications/no-documents-form')}}" class="btn btn-success">
                                        I Have No Aadhaar & Ration Card
                                    </a>
                                    <br>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Footer Start -->
    <div class="footer-section footer-section-03 section">
        <div class="container">
            <div class="copyright-text">
                <p>© Copyrights 2023 Rateup Developed by <a href="https://kawikatechnologies.com/" target="_blank">Kawika Technologies</a>. All rights reserved.</p>
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
</body>
<!-- JS
    ============================================ -->
    <script src="{{ asset('form-js/jquery-1.12.4.min.css') }}"></script>
    <script src="{{ asset('form-js/modernizr-3.11.2.min.css') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('form-js/popper.min.css') }}"></script>
    <script src="{{ asset('form-js/bootstrap.min.css') }}"></script>

    <!-- Plugins JS -->
    <script src="{{ asset('form-js/swiper-bundle.min.css') }}"></script>
    <script src="{{ asset('form-js/aos.css') }}"></script>
    <script src="{{ asset('form-js/waypoints.min.css') }}"></script>
    <script src="{{ asset('form-js/jquery.counterup.min.css') }}"></script>
    <script src="{{ asset('form-js/jquery.powertip.min.css') }}"></script>
    <script src="{{ asset('form-js/jquery.nice-select.min.css') }}"></script>
    <script src="{{ asset('form-js/back-to-top.css') }}"></script>
    <script src="{{ asset('form-js/jquery.magnific-popup.min.css') }}"></script>
	<script src="{{ asset('form-js/custom-file-input.js') }}"></script>


    <!--====== Use the minified version files listed below for better performance and remove the files listed above ======-->


    <!-- Main JS -->
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.validate.min.js')}}"></script>


</html>
