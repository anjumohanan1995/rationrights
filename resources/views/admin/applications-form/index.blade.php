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
                                                <label for="floatingSelect">District<span
                                                        class="text-danger">*</span></label>
                                                @if ($errors->has('district'))
                                                    <div class="text-danger w-100 error">{{ $errors->first('district') }}
                                                    </div>
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
    {{-- this code scripts ends here. --}}
@endsection
