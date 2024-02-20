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
    <script>
        (function(e, t, n) {
            var r = e.querySelectorAll("html")[0];
            r.className = r.className.replace(/(^|\s)no-js(\s|$)/, "$1js$2")
        })(document, window, 0);
    </script>
</head>

<body>
    <div class="main-wrapper">
        <div class="section header header-02 header-03 header-04">
            <div class="container">
                <div class="header-wrap">

                    <!--  Header Logo Start  -->
                    <div class="header-logo">
                        <a href="/"> <img src="{{ asset('img/gov.jpeg') }}" class="ms-5 logo-img"></a>

                    </div>

                    <div class="header-meta">
                        <div class="header-login d-none d-lg-block">
                            <a class="link link-btn" href="{{ url('login-pannel') }}">Login</a>
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

                            <br><br>

                            <form class=" text-start" action="{{ url('survey') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-floating mb-3">
                                    <div class="form-floating mb-0">
                                        <select class="form-select" id="district" name="district1"
                                            aria-label="Floating label select example" required>
                                            <option disabled selected value="">District</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelect">District<span class="text-danger">*</span></label>
                                        @if ($errors->has('district'))
                                            <div class="text-danger w-100 error">{{ $errors->first('district') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="district" id="new_dist">

                                <div class="form-floating mb-3">
                                    <select class="form-control" name="location1" id="location" placeholder=""
                                        required>
                                        <option disabled selected value="">Location</option>

                                    </select>
                                    <label for="location">Location<span class="text-danger">*</span> </label>
                                    @if ($errors->has('location'))
                                        <div class="text-danger w-100 error">{{ $errors->first('location') }}</div>
                                    @endif
                                </div>
                                <input type="hidden" name="location" id="new_loc">
                                <input type="submit" class="btn btn-success" value="Next">

                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Start -->
        <div class="footer-section footer-section-03 section">
            <div class="container">
                <div class="copyright-text">
                    <p>© Copyrights 2023 Rateup Developed by <a href="https://kawikatechnologies.com/"
                            target="_blank">Kawika Technologies</a>. All rights reserved.</p>
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
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#district').change(function() {
            var districtId = $(this).val();

            if (districtId) {
                $.ajax({
                    url: "{{ route('location') }}", // Replace with your route URL to fetch taluks
                    type: "GET",
                    data: {
                        district_id: districtId
                    },
                    success: function(response) {
                        $('#new_dist').val(response.name)
                        $('#location').empty();
                        $('#location').append('<option value="">Select Locations</option>');

                        $.each(response.locations, function(key, value) {
                            $('#location').append('<option value="' + value
                                .location_id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#locations').empty();
                $('#locations').append('<option value="">Select Locations</option>');
            }
        });
        $('#location').change(function() {
            $('#new_loc').val($(this).find('option:selected').text());


        });
    });
</script>

</html>
