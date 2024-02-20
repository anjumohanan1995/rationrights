@extends('layouts.app')
@section('content')
	<!-- main-content -->
	<div class="main-content app-content">
		<!-- container -->
		<div class="main-container container-fluid">
			<!-- breadcrumb -->
			<div class="breadcrumb-header justify-content-between row me-0 ms-0 mb-3" >
				<div class="col-xl-3">
					<h4 class="content-title mb-2">Edit User Management  </h4>
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
									<form name="userForm" method="post"action="{{route('user-management.update', $data->id)}}" >
													@csrf
													 @method('PUT')
													 <input type="hidden" id="user_id" value="{{@$data->id}}">
										<div class="form-group">
											<div class="row">
												<div class="col-md-3">
													<label class="form-label"> Name</label>
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" placeholder="First name" name="name" value="{{$data['name']}}"  />
													@error('name')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>



										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Email</label></div>
												<div class="col-md-9">
													<input type="email" class="form-control" placeholder="Email" name="email" value="{{$data['email']}}" />
													@error('email')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Role</label></div>
												<div class="col-md-9">
												<select id="role" name="role" class="form-control" >
													<!-- <option value="{{$data['role']}}" selected> -->{{$data['role']}}</option>
                                                    <option value="">Select Role</option>
														@foreach($role as $roles)
															<option value="{{$roles->name}}" @if($data['role'] == $roles->name) selected @endif >{{$roles->name}}</option>
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
                                                    <option value="{{ $state->name }}" @if($data['state'] == $state->name) selected @endif>{{ $state->name }}</option>
                                                    @endforeach

												</select>

												@error('state')
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
	<script  src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script >
	$(function() {

		$('#generatekey').on('click', function () {
			var user_id =$("#user_id").val();
	        $.ajax({
                url: "{{url('updateKey')}}",
                type: "GET",
                data: {
                    user_id: user_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                	console.log(result);
                	$('#access').val(result);

                	//


                }
            });
		});
		var user_id =$("#user_id").val();
	        $.ajax({
                url: "{{url('userData')}}",
                type: "GET",
                data: {
                    user_id: user_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                	//console.log(result.location);
                	$('#location').html('<option value="">'+ result.location +'</option>');
                	if(result.camera_id != null){
                		$('#camera_id').html('<option value="">'+ result.camera_id +' </option>');
                	}


                }
            });
        });

	$(document).ready(function(){

		$('.district').on('change', function () {
            var iddistrict = this.value;

            $("#state-dropdown").html('');
            $.ajax({
                url: "{{url('reports/fetch-location')}}",
                type: "POST",
                data: {
                    district_id: iddistrict,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#location').html('<option value=""> Location </option>');
                    $.each(result.states, function (key, value) {
                        $("#location").append('<option value="' + value
                            .location_name + '">' + value.location_name + '</option>');
                    });
                    $('#camera_id').html('<option value=""> Camera Id </option>');


                }

            });

        });
		$('#location').on('change', function () {
			//alert("kk");

            var location = this.value;
             var district = $("#dist").val();
            $("#camera_id").html('');
            $.ajax({
                url: "{{url('reports/fetch-camera')}}",
                type: "POST",
                data: {
                    location: location,
                    district : district,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#camera_id').html('<option value=""> Camera Id </option>');
                    $.each(res.camera, function (key, value) {
                        $("#camera_id").append('<option value="' + value
                            .camera_id + '">' + value.camera_id + '</option>');
                    });


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

	},
	messages: {
		name: {
		required: "Please enter Name",

		},
		email: {
		required: "Please enter Email"

		}



	},
    submitHandler: function(form) {
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	var id =  {{ Js::from($data['id']) }};
	$('#submit').html('Please Wait...');
	$("#submit"). attr("disabled", true);
		$.ajax({
			url: '{{ url("user-management/edit") }}'+'/'+id,

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
				location.reload(true);
				//alert('Data submitted successfully');
				//document.getElementById("userForm").reset();
			}
		});
}
})
}
</script>



@endsection
