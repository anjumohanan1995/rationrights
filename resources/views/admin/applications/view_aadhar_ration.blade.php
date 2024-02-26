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
                    <h4 class="content-title mb-2">View Application </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-box"> </i> -
                                View Application</li>
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
                               

                                    <input type="hidden" id="user_id" value="{{ @$data->id }}">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Application Number</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="First name"
                                                    name="name" value="{{ $data['application_no'] }}" readonly />
                                              
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="First name"
                                                    name="name" value="{{ $data['name'] }}" readonly />
                                              
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Address (Home Address)</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['address'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Age</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['age'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Gender</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['gender'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Mobile Number (Whatsapp Number)</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['mobile'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Since when staying in Kerala</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['years'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Aadhaar Number</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['aadhaar'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Ration Card Number </label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['ration'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Home State/Union Territory </label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['home_state'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Eligible for IMPDS or not(Yes/No)</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['eligibility'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>


                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">District</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['district'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>


                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Location</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['location'] }}" readonly />

                                            </div>
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
