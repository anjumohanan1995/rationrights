@extends('layouts.app')
@section('content')
	<!-- main-content -->
	<div class="main-content app-content">
		<!-- container -->
		<div class="main-container container-fluid">
			<!-- breadcrumb -->
			<div class="breadcrumb-header justify-content-between row me-0 ms-0 mb-3" >
				<div class="col-xl-3">
					<h4 class="content-title mb-2">Add User Management  </h4>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">

							<li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-box"> </i> - User Management</li>
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
						<div class="card">
								<div class="card-body">
									<div id="success_message" class="ajax_response" style="display: none;"></div>
									<div class="mb-4 main-content-label">Personal Details</div>
									<form  method="post"  action="{{route('user-management.store')}}" enctype="multipart/form-data">
										@csrf
										<div class="form-group">
											<div class="row">
												<div class="col-md-3">
													<label class="form-label">First Name</label>
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" placeholder="First name" name="name" value="{{old('name')}}"  />
													@error('name')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>










									 	<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Email</label></div>
												<div class="col-md-9"><input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" />
													@error('email')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>


										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Password</label></div>
												<div class="col-md-9"><input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}"/>
													@error('password')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>


										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Role</label></div>
												<div class="col-md-9">
												<select id="role" name="role" class="form-control">
													<option value=""> Select Role</option>
                                                @foreach ($role as $roles)
                                                <option value="{{ $roles->name }}"> {{ $roles->name }}</option>
                                                @endforeach

												</select>

												@error('role')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Home State / Union Territory</label></div>
												<div class="col-md-9">
												<select id="state" name="state" class="form-control"  >
                                                    <option value="">Select State</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{ $state->name }}">{{ $state->name }}</option>
                                                    @endforeach

												</select>

												@error('state')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">District</label></div>
												<div class="col-md-9">
												<select id="district" name="district" class="form-control"  >
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach

												</select>

												@error('district')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>
                                        <div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Taluk</label></div>
												<div class="col-md-9">
												<select id="taluk" name="taluk" class="form-control"  >
                                                    <option value="">Select Taluk</option>

												</select>

												@error('taluk')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>



										<div class="card-footer">
											<button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
										</div>
									</form>

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

			$('#district').on('change', function () {
                var iddistrict = this.value;

                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ route('location') }}",
                    type: "GET",
                    data: {
                        district_id: iddistrict,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#taluk').html('<option value="">Select Taluk </option>');
                        $.each(result.locations, function (key, value) {
                            $("#taluk").append('<option value="' + value
                                .location_id + '">' + value.name + '</option>');
                        });
                        $('#camera_id').html('<option value=""> Camera Id </option>');

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

			url: "{{ route('user-management.store')}}",
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



@endsection
