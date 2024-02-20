<!DOCTYPE html>
<html>

<head>
        <meta charset="UTF-8" />
    <meta name="csrf-token" content="cHkbecYy2xlZW82xqMJXORwZcckTj3gSgD4x8HAS" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="Description" content="ILDM" />
    <meta name="Author" content="" />
    <!-- Title -->
    <title>ILDM</title>



    <!--- Favicon --->
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />
    <!-- Bootstrap css -->


    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" id="style" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}

    <!--- Style css --->
    <link href="{{ asset('form-css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet" />
    <!--- Icons css --->
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" />
    <!--- Animations css --->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" />
    <!-- Switcher css -->
    <link href="{{ asset('css/switcher.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    @yield('css')
    <script src="{{ asset('js/jquery.min.js') }}"></script>




    <meta http-equiv="imagetoolbar" content="no" />





</head>

<body class="main-body app sidebar-mini ltr">

    <div class="horizontalMenucontainer">
        <!-- Switcher -->

        <!-- End Switcher -->
        <!-- Loader -->
        <div id="global-loader">
            <img src="/img/loader.gif" class="loader-img" alt="Loader" width="250" />
        </div>
        <!-- /Loader -->
        <!-- page -->

        <div class="page custom-index">

            <!-- main-header -->

            <!-- Header Start  -->
            <div class="section header header-02 header-03 header-04">
                <div class="container">

  <div class="header-wrap">

                <!--  Header Logo Start  -->
                <div class="header-logo">
                    <a href="/"><img src="{{ asset('img/favicon.png') }}" width="80px"></a>
                </div>
                <!--  Header Logo End  -->

                <!--  Header Menu Start  -->

                <!--  Header Menu End  -->

                <!-- Header Meta Start -->
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
            <!-- /main-header -->


	<!-- main-content -->
	<div class="main-content app-content">
		<!-- container -->
		<div class="main-container container-fluid" style="padding: 100px;">
			<!-- breadcrumb -->
			<div class="breadcrumb-header justify-content-between row me-0 ms-0 mb-3" >
				<div class="col-xl-3">
					<h4 class="content-title mb-2">Application details</h4>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">

							<li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-box"> </i> - Application details</li>
						</ol>
					</nav>
				</div>

			</div>
			<!-- /breadcrumb -->
			<!-- main-content-body -->
			<div class="main-content-body">





				<!-- row -->

				<!-- /row -->
				<!-- row -->
				<div class="row row-sm">
					<div class="col-lg-8 col-xl-8 col-md-12 col-sm-12 ">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ $message }}
                        </div>

                    @endif
                    @if ($message = Session::get('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            {{ $message }}
                        </div>

                    @endif
						<div class="card">
							<div class="card-body">

                                <div id="success_message" class="ajax_response" style="display: none;"></div>
                                <div class="mb-4 main-content-label"></div>

                                    <input type="hidden" name="application_id" value="{{$appl_id}}" >
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label class="form-label">Application Number :  </label>
                                            </div>
                                            <div class="col-md-6">
                                              <span>{{ $data['application_number'] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label class="form-label">Applicant Name :  </label>
                                            </div>
                                            <div class="col-md-6">
                                              <span>{{ ucwords($data['full_name']) }}</span>
                                            </div>
                                        </div>
                                    </div>





                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-5"></div>
                                            <div class="col-md-1">
                                        <button class="btn btn-primary btn-sm">
                                        <a class="link link-btn" href="{{url('login-pannel')}}"><i class="fa fa-sign-in"></i>
                                             Login</a>
                                        </button>
                                            </div>
                                            <div class="col-md-2">
                                        <button class="btn btn-primary">
                                        <a href="{{ route('printDetails',$appl_id) }}" class=""><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                                        </button>
                                            </div>
                                            <div class="col-md-5"></div>
                                        </div>
                                    </div>


                            </div>


							</div>

					</div>



				</div>
				<!-- /row -->
				<!-- row -->

				<!-- /row -->
				<!-- row -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /main-content -->



<script >
	$(document).ready(function(){

			$('.district').on('change', function () {
                var iddistrict = this.value;

                $("#state-dropdown").html('');
                $.ajax({
                    url: "http://127.0.0.1:8000/reports/fetch-location",
                    type: "POST",
                    data: {
                        district_id: iddistrict,
                        _token: 'cHkbecYy2xlZW82xqMJXORwZcckTj3gSgD4x8HAS'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#location').html('<option value=""> Location </option>');
                        $.each(result.states, function (key, value) {
                            $("#location").append('<option value="' + value
                                .location_name + '">' + value.location_name + '</option>');
                        });
                        $('#camera_id').html('<option value=""> Camera Id </option>');

                        table.draw();
                    }

                });

            });
			$('#location').on('change', function () {
				//alert("kk");

                var location = this.value;
                var district = $("#dist").val();

                $("#camera_id").html('');
                $.ajax({
                    url: "http://127.0.0.1:8000/reports/fetch-camera",
                    type: "POST",
                    data: {
                        location: location,
                         district : district,
                        _token: 'cHkbecYy2xlZW82xqMJXORwZcckTj3gSgD4x8HAS'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#camera_id').html('<option value=""> Camera Id </option>');
                        $.each(res.camera, function (key, value) {
                            $("#camera_id").append('<option value="' + value
                                .camera_id + '">' + value.camera_id + '</option>');
                        });
                         table.draw();

                    }
                });


            });
    });





if ($("#userForm").length > 0) {
$("#userForm").validate({
	rules: {
		name: {
		required: true,

		},

		email: {
		required: true
		},
		password: {
		required: true
		}


	},
	messages: {
		name: {
		required: "Please enter Name",

		},
		email: {
		required: "Please enter Email"

		},
		password: {
		required: "Please enter Password"

		}



	},
    submitHandler: function(form) {
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#submit').html('Please Wait...');
	$("#submit"). attr("disabled", true);
		$.ajax({

			url: "http://127.0.0.1:8000/user-management",
			type: "POST",
			data: $('#userForm').serialize(),
			success: function( response ) {
				//console.log(response.success);

				$('#submit').html('Submit');
				$("#submit"). attr("disabled", false);
				$('#success_message').fadeIn().html(response.success);
				setTimeout(function() {
					$('#success_message').fadeOut("slow");
				}, 2000 );

				//alert('Data submitted successfully');
				document.getElementById("userForm").reset();
			}
		});
}
})
}
</script>



            <!-- /main-content -->
            <!--Sidebar-right-->


            <!--/Sidebar-right-->
            <!-- Footer opened -->
            <div class="main-footer ht-45">
                <div class="container-fluid pd-t-0-f ht-100p">
                    <span>
                        Copyright © 2023 <a href="javascript:void(0);" class="text-primary">ILDM</a>. Designed with
                        <span class="fa fa-heart text-danger"> </span> by <a href="javascript:void(0);"> Kawika
                            Technologies </a> All rights reserved.
                    </span>
                </div>
            </div>

            <!-- Footer closed -->
        </div>
        <!-- page closed -->
        <!--- Back-to-top --->
        <a href="#top" id="back-to-top" style="display: block;">
            <i class="las la-angle-double-up"> </i>
        </a>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/datepicker.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/ionicons.js') }}"></script>
        <script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('js/chart.flot.sampledata.js') }}"></script>
        <script src="{{ asset('js/eva-icons.min.js') }}"></script>
        <script src="{{ asset('js/moment.js') }}"></script>
        <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('js/p-scroll.js') }}"></script>
        <script src="{{ asset('js/sidemenu.js') }}"></script>
        <script src="{{ asset('js/sticky.js') }}"></script>
        <script src="{{ asset('js/sidebar.js') }}"></script>
        <script src="{{ asset('js/sidebar-custom.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
        <script src="{{ asset('js/themecolor.js') }}"></script>
        <script src="{{ asset('js/swither-styles.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/switcher.js') }}"></script>



        <script>
            $(function() {
                $("#datepicker").datepicker();
                $("#to_datepicker").datepicker();

            });
            $(document).ready(function() {
                $('#example').DataTable();
                $('#example1').DataTable();
                $('#example2').DataTable();
                $('#example3').DataTable();


            });
        </script>

    </div>
    <div class="main-navbar-backdrop"></div>
</body>

</html>
