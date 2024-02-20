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
	<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
</head>

<body>
    <div class="main-wrapper">
        <div class="section header header-02 header-03 header-04">
            <div class="container">
                <div class="header-wrap">

                    <!--  Header Logo Start  -->
                    <div class="header-logo">
                        <a href="/"> <img src="{{ asset('img/gov1.jpeg') }}" class="ms-5" ></a>

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



                            <form class=" text-start" action="{{ url('/applications/ration-application-form') }}" method="post"
                                enctype="multipart/form-data">
                                <div class="tab-content bg-white p-5" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                        aria-labelledby="home-tab" tabindex="0">

                                        <h4 class="mb-3">GENERAL INFO </h4>

                                        @if (session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @csrf
                                        <input type="hidden" name="test" id="test" value="">

                                        <div class="form-floating mb-3 w-48 float-left">
                                                <input type="text" class="form-control" name="name"
                                                        id="floatingInput"
                                                        value="{{ old('name') }}" placeholder="">
                                                <label for="floatingInput">Name <span class="text-danger">*</span> </label>

                                                @if ($errors->has('name'))
                                                    <div class="text-danger w-100" class="error">{{ $errors->first('name') }}</div>
                                                @endif
                                        </div>

                                        <div class="clear w-100"></div>

                                        <div class="form-floating mb-3 w-48 float-left">
                                                <textarea type="text" name="address"
                                                    id="address" class="form-control"
                                                    value="{{ old('date_of_birth') }}" placeholder="" ></textarea>
                                                <label for="address">Address <span class="text-danger">*</span></label>
                                                @if ($errors->has('address'))
                                                    <div class="text-danger w-100 error">{{ $errors->first('address') }}</div>
                                                @endif
                                        </div>
                                        <div class="form-floating mb-3 w-48 float-left">
                                            <input type="text" class="form-control"
                                                    name="age" id="age"
                                                    placeholder="" >
                                            <label for="age">Age <span class="text-danger">*</span></label>
                                            @if ($errors->has('age'))
                                                <div class="text-danger w-100 error">{{ $errors->first('age') }}</div>
                                            @endif

                                        </div>
                                        <div class="form-floating mb-3 w-48 float-left">

                                            <div class="form-floating mb-0">
                                                <select class="form-select " id="gender" name="gender"
                                                        aria-label="Floating label select example">
                                                    {{-- <option disabled selected value="">Gender</option> --}}
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                    <option>Other</option>

                                                </select>
                                                <label for="floatingSelect">Gender<span
                                                    class="text-danger">*</span></label>
                                                @if ($errors->has('gender'))
                                                    <div class="text-danger w-100" class="error">{{ $errors->first('gender') }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="form-floating mb-3 w-48 float-left">
                                            <input type="text" class="form-control"
                                                    name="mobile" id="mobile"
                                                    placeholder="" >
                                            <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                                            @if ($errors->has('mobile'))
                                                <div class="text-danger w-100 error">{{ $errors->first('mobile') }}</div>
                                            @endif

                                        </div>
                                        <div class="form-floating mb-3 w-48 float-left">

                                            <div class="form-floating mb-0">
                                                <select class="form-select " id="years" name="years"
                                                        aria-label="Floating label select example">
                                                    {{-- <option disabled selected value="">Since when staying in Kerala</option> --}}


                                                </select>
                                                <label for="floatingSelect">Since when staying in Kerala<span
                                                    class="text-danger">*</span></label>
                                                @if ($errors->has('years'))
                                                    <div class="text-danger w-100" class="error">{{ $errors->first('years') }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>


                                        <div class="form-floating mb-3 w-48 float-left">
                                            <input type="text" class="form-control"
                                                    name="aadhaar" id="aadhaar"
                                                    placeholder="" >
                                            <label for="aadhaar">Aadhaar Number <span class="text-danger">*</span></label>
                                            @if ($errors->has('aadhaar'))
                                                <div class="text-danger w-100 error">{{ $errors->first('aadhaar') }}</div>
                                            @endif

                                        </div>
                                        <div class="clearfix"></div>
                                        <div >
                                            <label >Eligible for IMPDS or not(Yes/No)  <span class="text-danger">*</span></label>

                                            <label>
                                              <input type="radio" name="eligibility" value="Yes">
                                              Yes
                                            </label>
                                            <label>
                                              <input type="radio" name="eligibility" value="No">
                                              No
                                            </label>
                                          </div>
                                        <div class="form-floating mb-3 w-48 float-left">

                                            <div class="form-floating mb-0">
                                                <select class="form-select " id="district" name="district"
                                                        aria-label="Floating label select example">
                                                    <option disabled selected value="">District</option>
                                                    <option>Thiruvananthapuram</option>
                                                    <option>Kollam</option>
                                                    <option>Pathanamthitta</option>
                                                    <option>Alappuzha</option>
                                                </select>
                                                <label for="floatingSelect">District<span
                                                    class="text-danger">*</span></label>
                                                @if ($errors->has('district'))
                                                    <div class="text-danger w-100" class="error">{{ $errors->first('district') }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="form-floating mb-3 w-48 float-left">
                                            <select type="text" class="form-control" name="location" id="location"
                                                value="{{ old('location') }}" placeholder="">
                                                <option disabled selected value="">Location</option>
                                                <option>Thiruvananthapuram</option>
                                                <option>Kollam</option>
                                                <option>Pathanamthitta</option>
                                                <option>Alappuzha</option>
                                            </select>
                                            <label for="location">Location<span class="text-danger">*</span> </label>
                                            @if ($errors->has('location'))
                                                `
                                                <div class="text-danger w-100" class="error">
                                                    {{ $errors->first('location') }}</div>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <div class="col-md-10">&nbsp;</div>
                                            <div class="col-md-2">
                                                <input type="submit" class="btn btn-success" id="submit" value="Submit">
                                            </div>
                                        </div>
                                    </div>

                        </div>
                    </div>




                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="footer-section footer-section-03 section">
        <div class="container">
            <div class="copyright-text">
                <p>© Copyrights 2023 RateUP Developed by <a href="https://kawikatechnologies.com/" target="_blank">Kawika Technologies</a>. All rights reserved.</p>
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

    <script type="text/javascript">
        window.onload = function () {

            var ddlYears = document.getElementById("years");
            var currentYear = (new Date()).getFullYear();
            for (var i = 1950; i <= currentYear; i++) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                ddlYears.appendChild(option);
            }
        };
    </script>


</html>
