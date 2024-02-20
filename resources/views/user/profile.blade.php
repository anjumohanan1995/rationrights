{{-- @if (Auth::User()->role == 'Admin')
    @extends('layouts.app')
@else
    @extends('layouts.student_app')
@endif --}}
@extends('layouts.app')


@section('content')
    <!-- main-content -->
    <div class="main-content app-content">
        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between row me-0 ms-0 mb-3">
                <div class="col-xl-3">
                    <h4 class="content-title mb-2">Edit User Management </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-box"> </i> -
                                User Management</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- /breadcrumb -->
            <!-- main-content-body -->
            <div class="main-content-body">
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

                <!-- row -->

                <!-- /row -->
                <!-- row -->
                <div class="row row-sm">
                    <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12 ">
                        <div class="card">
                            <div class="card-body">
                                <div id="success_message" class="ajax_response" style="display: none;"></div>
                                <div class="mb-4 main-content-label">Personal Details</div>
                                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" id="user_id" value="{{ @$data->id }}">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Full Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="First name"
                                                    name="name" value="{{ $data['name'] }}" readonly />
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Email</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Last Name"
                                                    name="lname" value="{{ $data['email'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Edit Password</label></div>
                                            <div class="col-md-9">
                                                {{-- <input type="text" class="form-control" placeholder="Last Name" name="lname" value="{{$data['email']}}" readonly/> --}}
                                                <a class="btn btn-primary" href="{{ route('profile.password.edit') }}">Edit
                                                    password</a>
                                            </div>
                                        </div>
                                    </div>



                                    {{-- <div class="form-group">
											<div class="row">
												<div class="col-md-3">
													<label class="form-label">District</label>
												</div>
												<div class="col-md-9">
													<select class="form-control district" name="district" id="dist" disabled>
														<option value="">Select District</option>
														<option value="ALAPPUZHA" @if ($data['district'] == 'ALAPPUZHA') selected  @endif>ALAPPUZHA</option>
							                            <option value="ERNAKULAM" @if ($data['district'] == 'ERNAKULAM') selected  @endif >ERNAKULAM</option>
							                            <option value="IDUKKI" @if ($data['district'] == 'IDUKKI') selected  @endif >IDUKKI</option>
							                            <option value="KANNUR" @if ($data['district'] == 'KANNUR') selected  @endif >KANNUR</option>
							                            <option value="KASARGOD" @if ($data['district'] == 'KASARGOD') selected  @endif >KASARGOD</option>
							                            <option value="KOLLAM" @if ($data['district'] == 'KOLLAM') selected  @endif >KOLLAM</option>
							                            <option value="KOTTAYAM" @if ($data['district'] == 'KOTTAYAM') selected  @endif >KOTTAYAM</option>
							                            <option value="KOZHIKODE" @if ($data['district'] == 'KOZHIKODE') selected  @endif >KOZHIKODE</option>
							                            <option value="MALAPPURAM" @if ($data['district'] == 'MALAPPURAM') selected  @endif >MALAPPURAM</option>
							                            <option value="PALAKKAD" @if ($data['district'] == 'PALAKKAD') selected  @endif >PALAKKAD</option>
							                            <option value="PATHANAMTHITTA" @if ($data['district'] == 'PATHANAMTHITTA') selected  @endif >PATHANAMTHITTA</option>
							                            <option value="THIRUVANANTHAPURAM" @if ($data['district'] == 'THIRUVANANTHAPURAM') selected  @endif >THIRUVANANTHAPURAM</option>
							                            <option value="THRISSUR" @if ($data['district'] == 'THRISSUR') selected  @endif >THRISSUR</option>
							                            <option value="WAYANAD" @if ($data['district'] == 'WAYANAD') selected  @endif >WAYANAD</option>

											    	</select>
												</div>
											</div>
										</div>

										<div class="mb-4 main-content-label">Location</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3">
													<label class="form-label">Location</label>
												</div>
												<div class="col-md-9">
													<select class="form-control" name="location" id="location" disabled>
                                                    <option value="">Location</option>
											    </select>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3">
													<label class="form-label">Camera ID</label>
												</div>
												<div class="col-md-9">
													<select class="form-control" name="camera_id[]" id="camera_id" disabled>
                                                    <option value="">Camera Id</option>
											    </select>
												</div>
											</div>
										</div>



										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Pin Code</label></div>
												<div class="col-md-9"><input type="number" class="form-control" placeholder="Pincode" name="pin_code" value="{{$data['pin_code']}}" readonly /></div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Phone No</label></div>
												<div class="col-md-9"><input type="number" class="form-control" placeholder="Phone No" name="phone_no" value="{{$data['phone_no']}}" readonly /></div>
											</div>
										</div><div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Mobile</label></div>
												<div class="col-md-9"><input type="number" class="form-control" placeholder="Mobile" name="mobile" value="{{$data['mobile']}}" readonly /></div>
											</div>
										</div>

									   <!-- 	<div class="mb-4 main-content-label">Location</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3">
													<label class="form-label">Location</label>
												</div>
												<div class="col-md-9">
													<input type="text" class="form-control" placeholder="Location" name="location"  value="{{$data['location']}}"/>
												</div>
											</div>
										</div> -->
										<!-- <div class="mb-4 main-content-label">Password</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Password</label></div>
												<div class="col-md-9"><input type="text" class="form-control" placeholder="Password" name="password" />
													@error('password')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div> -->
										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Email</label></div>
												<div class="col-md-9"><input type="email" class="form-control" placeholder="Email" name="email" value="{{$data['email']}}" readonly />
													@error('email')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Employee ID</label></div>
												<div class="col-md-9"><input type="text" class="form-control" placeholder="Employee id" name="emp_id" value="{{$data['emp_id']}}" readonly/> @error('emp_id')
														<span class="text-danger">{{$message}}</span>
													@enderror


												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Role</label></div>
												<div class="col-md-9">
												<select id="role" name="role" class="form-control" disabled>
													<!-- <option value="{{$data['role']}}" selected> {{$data['role']}}</option>-->
														@foreach ($role as $roles)
															<option value="{{$roles->name}}" @if ($data['role'] == $roles->name) selected @endif >{{$roles->name}}</option>
														@endforeach
												</select>
													@error('role')
														<span class="text-danger">{{$message}}</span>
													@enderror
												</div>
											</div>
										</div> --}}
                                    {{-- <div class="form-group">
											<div class="row">
												<div class="col-md-3"><label class="form-label">Profile Pic</label></div>
												<div class="col-md-9">
													<input type="file" name="image" class="form-control">
												</div>
											</div>
										</div> --}}


                                    @if ($data['image'] != '')
                                        <img src="{{ url('/') }}/admin/uploads/images/{{ $data['image'] }}"
                                            height="200px;" accept="image/png, image/jpeg,image/jpg" width="200px;">
                                    @endif
                                    <div class="col-md-9">
                                        <input type="hidden" name="imgs" value="{{ $data['image'] }}" />
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit"
                                            class="btn btn-primary waves-effect waves-light">Save</button>
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

    <script>
        $(function() {
            var user_id = $("#user_id").val();
            $.ajax({
                url: "{{ url('userData') }}",
                type: "GET",
                data: {
                    user_id: user_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    //console.log(result.location);
                    $('#location').html('<option value="">' + result.location + '</option>');
                    if (result.camera_id != null) {
                        $('#camera_id').html('<option value="">' + result.camera_id + ' </option>');
                    }


                }
            });
        });

        $(document).ready(function() {

            $('.district').on('change', function() {
                var iddistrict = this.value;

                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{ url('reports/fetch-location') }}",
                    type: "POST",
                    data: {
                        district_id: iddistrict,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#location').html('<option value=""> Location </option>');
                        $.each(result.states, function(key, value) {
                            $("#location").append('<option value="' + value
                                .location_name + '">' + value.location_name +
                                '</option>');
                        });
                        $('#camera_id').html('<option value=""> Camera Id </option>');


                    }

                });

            });
            $('#location').on('change', function() {
                //alert("kk");

                var location = this.value;
                var district = $("#dist").val();
                $("#camera_id").html('');
                $.ajax({
                    url: "{{ url('reports/fetch-camera') }}",
                    type: "POST",
                    data: {
                        location: location,
                        district: district,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#camera_id').html('<option value=""> Camera Id </option>');
                        $.each(res.camera, function(key, value) {
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
                    var id = {{ Js::from($data['id']) }};
                    $('#submit').html('Please Wait...');
                    $("#submit").attr("disabled", true);
                    $.ajax({
                        url: '{{ url('user-management/edit') }}' + '/' + id,

                        type: "POST",
                        data: $('#userForm').serialize(),
                        success: function(response) {
                            //console.log(response.success);

                            $('#submit').html('Submit');
                            $("#submit").attr("disabled", false);
                            $('#success_message').fadeIn().html(response.success);
                            setTimeout(function() {
                                $('#success_message').fadeOut("slow");
                            }, 2000);
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
