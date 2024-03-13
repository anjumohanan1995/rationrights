<!doctype html>

<html class="no-js" lang="zxx">

    <head>

    	<!-- metas -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       	<meta name="description" content="Daniels is a responsive creative template">
		<meta name="keywords" content="portfolio, personal, corporate, business, parallax, creative, agency">

		<!-- title -->
		<title>Daniels</title>

		<!-- favicon -->
        <link href="{{ asset('home/img/favicon.ico')}}" rel="icon" type="image/png">

        <!-- bootstrap css -->
		<link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css')}}">

		<!-- google fonts -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800" rel="stylesheet">

		<!-- owl carousel CSS -->
		{{-- <link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css')}}"> --}}
		{{-- <link rel="stylesheet" href="{{ asset('home/css/owl.theme.default.min.css')}}"> --}}

		<!-- magnific-popup CSS -->
		{{-- <link rel="stylesheet" href="{{ asset('home/css/magnific-popup.css')}}"> --}}

		<!-- animate.min CSS -->
		{{-- <link rel="stylesheet" href="{{ asset('home/css/animate.min.css')}}"> --}}

		<!-- Font Icon Core CSS -->
		{{-- <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{ asset('home/css/et-line.css')}}"> --}}

		<!-- Core Style Css -->
        <link rel="stylesheet" href="{{ asset('home/css/style.css')}}">

        <!--[if lt IE 9]-->
		<script src="{{ asset('home/js/html5shiv.min.js')}}"></script>
		<!--[endif]-->

    </head>
    
    <body>

    	<!-- ====== Preloader ======  -->
	    <div class="loading">
			<div class="load-circle">
			</div>
		</div>
		<!-- ======End Preloader ======  -->

		<!-- ====== Navgition ======  -->
		<nav class="navbar navbar-default">
		  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-icon-collapse" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>

		       <!-- logo -->
		      <a class="logo" href="#"><img src="{{ asset('home/img/gov.png')}}" width="250px"  alt=""></a>

		    </div>

		    <!-- Collect the nav links, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="nav-icon-collapse">
		      
			  <!-- links -->
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="{{ url('login-pannel') }}"  class="active">login</a></li>
		         
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container -->
		</nav>
		<!-- ====== End Navgition ======  -->

		<!-- ====== Header ======  -->
		
		<!-- ====== End Header ======  -->

             @yield('content')


       
        <!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
		<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

	  	<!-- bootstrap -->
		<script src="{{ asset('home/js/bootstrap.min.js')}}"></script>

		<!-- scrollIt -->
		<script src="{{ asset('home/js/scrollIt.min.js')}}"></script>

		<!-- magnific-popup -->
		<script src="{{ asset('home/js/jquery.magnific-popup.min.js')}}"></script>

		<!-- owl carousel -->
		<script src="{{ asset('home/js/owl.carousel.min.js')}}"></script>

		<!-- stellar js -->
		<script src="{{ asset('home/js/jquery.stellar.min.js')}}"></script>

		<!-- animated.headline -->
		<script src="{{ asset('home/js/animated.headline.js')}}"></script>

      	<!-- jquery.waypoints.min js -->
	  	{{-- <script src="{{ asset('home/js/jquery.waypoints.min.js')}}"></script> --}}

	  	<!-- jquery.counterup.min js -->
	  	{{-- <script src="{{ asset('home/js/jquery.counterup.min.js')}}"></script> --}}

      	<!-- isotope.pkgd.min js -->
      	{{-- <script src="{{ asset('home/js/isotope.pkgd.min.js')}}"></script>

      	<!-- validator js -->
      	<script src="{{ asset('home/js/validator.js')}}"></script> --}}

      	<!-- custom script -->
        <script src="{{ asset('home/js/custom.js')}}"></script>

    </body>
</html>
