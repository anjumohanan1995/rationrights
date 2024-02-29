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
                                <form name="userForm" method="post"action="{{route('aadhar.update', $data->id)}}" >
													@csrf
													
                                    <input type="hidden" name="id" value="{{ @$data->id }}">
                                    <input type="hidden" name="old_type" value="{{ @$data->type }}">
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
                                            <div class="col-md-3"><label class="form-label">Home State/Union Territory </label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['home_state'] }}" readonly />

                                            </div>
                                        </div>
                                    </div>


                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3"><label class="form-label">Home District </label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['home_district'] }}" readonly />

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
                                            <div class="col-md-3"><label class="form-label">Ration Card Number </label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    name="lname" value="{{ $data['ration'] }}" readonly />

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

                                     <div class="form-group">
                                        <div class="row">

                                         <div class="col-md-3"><label class="form-label">Ration Card Number </label></div>
                                            <div class="col-md-9">
                                                 <input type="number" class="form-control" name="ration"
                                                                    id="ration" value="{{ old('ration') }}"
                                                                    placeholder="" required>

                                                                    @error('ration')
														<span class="text-danger">{{$message}}</span>
													@enderror

                                            </div>
                                        </div>
                                    </div>



                                    <div class="card-footer">
											<button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
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


@endsection
