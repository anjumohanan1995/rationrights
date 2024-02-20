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
                                        <div class="col-lg-12 col-md-12 col-sm-12 rt-area">
                                            <div class="pt-0  w-100 float-end text-center">
                                                <input type="hidden" value="{{ $data['district'] }}">
                                                <input type="hidden" value="{{ $data['location'] }}">
                                                <br><br>
                                                <h3><- Select one option -></h3><br>
                                                <a href="{{ url('applications/ration-aadhaar-form') }}" class="btn btn-success">
                                                    I Have Ration Card & Aadhaar Card
                                                </a><br><br>

                                                <a href="{{ url('applications/aadhaar-form') }}" class="btn btn-success">
                                                    I Have Aadhaar Only (No Ration Card)
                                                </a><br><br>

                                                <a href="{{ url('applications/no-documents-form') }}" class="btn btn-success">
                                                    I Have No Aadhaar & Ration Card
                                                </a>
                                                <br>
                                            </div>
                                        </div>
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
    <script>

    </script>
    {{-- this code scripts ends here. --}}
@endsection
