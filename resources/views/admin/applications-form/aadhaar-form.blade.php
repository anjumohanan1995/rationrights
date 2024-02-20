@extends('layouts.app')

@section('content')
    <!-- main-content -->


    <!-- main-content -->
    <div class="main-content app-content">
        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between row me-0 ms-0">
                <div class="col-xl-3">
                    <h4 class="content-title mb-2">Applications Form</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-user"> </i>
                                - Applications Form - First page</li>
                        </ol>
                    </nav>
                </div>

            </div>

            <!-- /breadcrumb -->
            <!-- main-content-body -->
            <div class="main-content-body">

                <div class="row row-sm">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 ">
                        <div class="card">
                            <div class="card-body  table-new">
                                <div class="row mb-3">



                                    <div class="row">
                                        <form class=" text-start" action="{{ url('/applications/application-form') }}"
                                            method="post" enctype="multipart/form-data">
                                            <div class="tab-content bg-white p-5" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                                    aria-labelledby="home-tab" tabindex="0">

                                                    <h4 class="mb-3">APPLICATION FORM - AADHAAR ONLY </h4>

                                                    @if (session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }}
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
                                                    <input type="hidden" name="type" id="type"
                                                        value="aadhaar-form">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control name"
                                                                    name="name" id="floatingInput"
                                                                    value="{{ old('name') }}" placeholder="" required>
                                                                <label for="floatingInput">Name <span
                                                                        class="text-danger">*</span></label>
                                                                <span id="nameError" class="error-message"></span>
                                                                @if ($errors->has('name'))
                                                                    <div class="text-danger">{{ $errors->first('name') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        {{-- <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="text" class="form-control" name="age" id="age" placeholder="" required>
                                                                <label for="age">Age <span class="text-danger">*</span></label>
                                                                <span id="ageError" class="error-message"></span>
                                                                @if ($errors->has('age'))
                                                                    <div class="text-danger">{{ $errors->first('age') }}</div>
                                                                @endif
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <div class="form-floating mb-0">
                                                                    <select class="form-select" id="gender"
                                                                        name="gender"
                                                                        aria-label="Floating label select example" required>
                                                                        <option value="Male"
                                                                            @if (old('gender') === 'Male') selected @endif>
                                                                            Male</option>
                                                                        <option value="Female"
                                                                            @if (old('gender') === 'Female') selected @endif>
                                                                            Female
                                                                        </option>
                                                                        <option value="Other"
                                                                            @if (old('gender') === 'Other') selected @endif>
                                                                            Other</option>
                                                                    </select>
                                                                    <label for="floatingSelect">Gender<span
                                                                            class="text-danger">*</span></label>
                                                                    @if ($errors->has('gender'))
                                                                        <div class="text-danger">
                                                                            {{ $errors->first('gender') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="number" class="form-control" name="mobile"
                                                                    id="mobile" value="{{ old('mobile') }}"
                                                                    placeholder="" required>
                                                                <label for="mobile">Mobile Number (Whatsapp Number)<span
                                                                        class="text-danger">*</span></label>
                                                                <span id="mobileError" class="error-message"></span>
                                                                @if ($errors->has('mobile'))
                                                                    <div class="text-danger">{{ $errors->first('mobile') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <div class="form-floating mb-0">
                                                                    <select class="form-select" id="years"
                                                                        name="years"
                                                                        aria-label="Floating label select example" required>

                                                                    </select>
                                                                    {{-- <input type="date" class="form-control"
                                                                            name="years" id="years"
                                                                            placeholder="" required> --}}
                                                                    <label for="floatingSelect">Since when staying in
                                                                        Kerala<span class="text-danger">*</span></label>
                                                                    @if ($errors->has('years'))
                                                                        <div class="text-danger">
                                                                            {{ $errors->first('years') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="number" class="form-control" name="aadhaar"
                                                                    id="aadhaar" value="{{ old('aadhaar') }}"
                                                                    placeholder="" required>
                                                                <label for="aadhaar">Aadhaar Number <span
                                                                        class="text-danger">*</span></label>
                                                                <span id="aadhaarError" class="error-message"></span>
                                                                @if ($errors->has('aadhaar'))
                                                                    <div class="text-danger">
                                                                        {{ $errors->first('aadhaar') }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div>
                                                                <label>Eligible for IMPDS or not(Yes/No) <span
                                                                        class="text-danger">*</span></label>

                                                                <label>
                                                                    <input type="radio" name="eligibility"
                                                                        onclick="show2();" value="Yes"
                                                                        @if (old('eligibility') === 'Yes') checked @endif
                                                                        required>
                                                                    Yes
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="eligibility"
                                                                        onclick="show1();" value="No"
                                                                        @if (old('eligibility') === 'No') checked @endif
                                                                        required>
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <div class="form-floating mb-0">
                                                                    {{-- <select class="form-select" id="district" name="district" aria-label="Floating label select example" required>
                                                                        <option disabled selected value="">District</option>
                                                                        <option>Thiruvananthapuram</option>
                                                                        <option>Kollam</option>
                                                                        <option>Pathanamthitta</option>
                                                                        <option>Alappuzha</option>
                                                                    </select> --}}
                                                                    <input class="form-control" type="text"
                                                                        id="state" value="{{ old('state') }}"
                                                                        name="home_state" placeholder="" required>
                                                                    <label for="state">Home State<span
                                                                            class="text-danger">*</span></label>
                                                                    @if ($errors->has('state'))
                                                                        <div class="text-danger w-100 error">
                                                                            {{ $errors->first('state') }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                {{-- <select type="text" class="form-control" name="location" id="location" value="{{ old('location') }}"
                                                                    placeholder="" required>
                                                                    <option disabled selected value="">Location</option>
                                                                    <option>Thiruvananthapuram</option>
                                                                    <option>Kollam</option>
                                                                    <option>Pathanamthitta</option>
                                                                    <option>Alappuzha</option>
                                                                </select> --}}
                                                                <input class="form-control" type="text"
                                                                    name="home_district"
                                                                    value="{{ old('home_district') }}" placeholder=""
                                                                    required>

                                                                <label for="district">Home District<span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                @if ($errors->has('district'))
                                                                    <div class="text-danger w-100 error">
                                                                        {{ $errors->first('district') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-floating mb-3">
                                                                <input type="number" class="form-control" name="ration"
                                                                    id="div1" style="display:none;" value=""
                                                                    placeholder="Ration Card"></label>
                                                                {{-- <label for="district">Ration Card<span class="text-danger">*</span> </label> --}}
                                                                <span id="aadhaarError" class="error-message"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-10">&nbsp;</div>
                                                    <div class="col-md-2">
                                                        <input type="submit" class="btn btn-success" id="submit"
                                                            value="Submit">
                                                    </div>
                                                </div>
                                            </div>





                                        </form>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /main-content -->
    <div class="modal fade" id="confirmation-popup">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal border-0">
                <div class="modal-header offcanvas-header">
                    <h6 class="modal-title">Are you sure?</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body p-5">
                    <div class="text-center">
                        <h4>Are you sure to delete this User?</h4>
                    </div>
                    <form id="ownForm">
                        @csrf
                        <input type="hidden" id="requestId" name="requestId" value="" />
                        <div class="text-center">
                            <button type="button" onclick="ownRequest()"
                                class="btn btn-primary mt-4 mb-0 me-2">Yes</button>
                            <button class="btn btn-default mt-4 mb-0" data-bs-dismiss="modal" type="button">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- this code scripts starts here. --}}
    <script type="text/javascript">
        window.onload = function() {

            var ddlYears = document.getElementById("years");
            var currentYear = (new Date()).getFullYear();

            var oldValue = parseInt({!! json_encode(old('years')) !!});

            for (var i = 1990; i <= currentYear; i++) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;

                if (i.toString() === oldValue.toString()) {
                    option.selected = true;
                }

                ddlYears.appendChild(option);
            }
        };
    </script>

    <script>
        $(document).ready(function() {
            $('.name').on('change', function() {
                var name = $(this).val();
                var nameError = $("#nameError");
                nameError.text("");
                var regex = /^[A-Za-z\s]+$/;
                if (!regex.test(name)) {
                    nameError.text("Invalid Name. Only letters and spaces allowed.");
                    $(":submit").attr("disabled", true);
                } else {
                    nameError.text("");
                    $(":submit").removeAttr("disabled");

                }
            });
            $('#age').on('input', function() {
                var age = $(this).val();

                // Validate that the input is a positive integer
                if (isNaN(age) || age < 1 || !Number.isInteger(parseFloat(age))) {
                    $('#ageError').text('Please enter a valid age.');
                    $(":submit").attr("disabled", true);
                } else {
                    $('#ageError').text(''); // Clear error message
                    $(":submit").removeAttr("disabled");
                }
            });
            $('#mobile').on('input', function() {
                var mobile = $(this).val();
                var regex = /^[0-9]{10}$/; // Matches a 10-digit number
                if (!regex.test(mobile)) {
                    $('#mobileError').text('Please enter a valid 10-digit mobile number.');
                    $(":submit").attr("disabled", true);
                } else {
                    $('#mobileError').text(''); // Clear error message
                    $(":submit").removeAttr("disabled");
                }
            });
            $('#aadhaar').on('input', function() {
                var aadhaar = $(this).val();
                var regex = /^\d{12}$/; // Matches a 12-digit number

                if (!regex.test(aadhaar)) {
                    $('#aadhaarError').text('Please enter a valid 12-digit Aadhaar number.');
                    $(":submit").attr("disabled", true);
                } else {
                    $('#aadhaarError').text('');
                    $(":submit").removeAttr("disabled");
                }
            });
        });

        function show1() {
            document.getElementById('div1').style.display = 'none';
            $('#type').val('aadhaar-form');
            document.getElementById('div1').removeAttribute('required');
        }

        function show2() {
            document.getElementById('div1').style.display = 'block';
            $('#type').val('ration-aadhaar-form');
            document.getElementById('div1').setAttribute('required', 'true');

        }
    </script>
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
    {{-- this code scripts ends here. --}}
@endsection
