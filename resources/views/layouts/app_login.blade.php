<!DOCTYPE html>
<html>
	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="Description" content="RateUP" />
		<meta name="Author" content="" />
		<!-- Title -->
		<title>Rateup</title>
		<!--- Favicon --->
		<link rel="icon" href="img//gov.jpeg" type="image/x-icon" />
		<!-- Bootstrap css -->
		<link href="{{ asset('css/bootstrap.css')}}" rel="stylesheet" id="style" />
		<!--- Style css --->
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
		<link href="{{ asset('css/plugins.css') }}" rel="stylesheet" />
		<!--- Icons css --->
		<link href="{{ asset('css/icons.css') }}" rel="stylesheet" />
		<!--- Animations css --->
		<link href="{{ asset('css/animate.css') }}" rel="stylesheet" />
		<!-- Switcher css -->
		<link href="{{ asset('css/switcher.css') }}" rel="stylesheet" />
		<link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


		<meta http-equiv="imagetoolbar" content="no" />




	</head>
 <body style="background-image: url({{ asset('home/img/bkground_auto_x2.jpg') }}) ;   background-size: cover;">
    <!-- Loader -->
    <div id="global-loader" style="display: none;"><img src="img/loaders/loader-4.svg" class="loader-img" alt="Loader" /></div>
    <!-- /Loader -->
    <!-- Start Switcher -->

    <!-- End Switcher -->
    <!-- page -->
   <div class="page">
     	<!-- main-signin-wrapper -->

     	 @yield('content')

   </div>
    <!-- page closed -->
    <!--- Back-to-top --->
    @stack('script')
    <script >
      document.addEventListener("contextmenu", (event) => {
         event.preventDefault();
      });
   </script>

</body>
</html>
