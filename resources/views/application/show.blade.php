@extends('layouts.app')

@section('content')
    <!-- main-content -->

    <style>
        table tbody tr th {
            width: 50%;
        }

        .marks {
            display: flex;
            justify-content: space-around;
            border: solid 1px black;

        }

        .heading {
            background: lightgray !important;
        }
    </style>



    <!-- main-content -->
    <div class="main-content app-content">
        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between row me-0 ms-0">
                <div class="col-xl-3">
                    <h4 class="content-title mb-2">Student edit</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-user"> </i>
                                - Student edit</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex my-auto col-xl-9 pe-0">
                    {{-- <div class="card"> --}}
                    {{-- <div class="main-content-body main-content-body-mail card-body p-0" id="search_part"> --}}
                    {{-- <div class="card-body pt-2 pb-2"> --}}

                    {{-- <div class="row row-sm">
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input class="form-control" placeholder="Email" type="text" name="email"
                                            id="email">
                                    </div>

                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input class="form-control" placeholder="Name" type="text" name="name"
                                            id="name">
                                    </div>

                                    <div class="col-lg mg-t-10 mg-lg-t-0"> <button class="btn ripple btn-success btn-block"
                                            type="submit" id="submit">Search</button></div>
                                </div> --}}

                    {{-- <form action="{{ url('student-management') }}" method="POST">
                                    @csrf
                                    <div class="row row-sm">
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <input class="form-control" placeholder="Email" type="text" name="email" id="email">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">
                                            <input class="form-control" placeholder="Name" type="text" name="name" id="name">
                                        </div>
                                        <div class="col-lg mg-t-10 mg-lg-t-0">

                                            <input class="btn ripple btn-success btn-block" type="submit" name="submit" value="Submit">
                                            <input type="submit">
                                        </div>
                                    </div>
                                </form> --}}



                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
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
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 ">
                        <div class="card">
                            <div class="card-body  table-new">
                                <div class="row mb-3">



                                </div>

                                <div>


                                    <div class="container">
                                        <ul class="nav nav-tabs justify-content-center mb-5">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#tab-1">About</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Communication</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Guardians
                                                    Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tab-4">Examination </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Document Details </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tab-6">Reciept </a>
                                            </li>
                                        </ul>


                                        <div class="tab-content">
                                            <div id="tab-1" class="tab-pane fade show active">
                                                <h3>Student Information</h3>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {{-- <h2>Student Information</h2> --}}
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <!--<tr>-->
                                                                    <!--    <th>User ID</th>-->
                                                                    <!--    <td>{{ $student['user_id'] }}</td>-->
                                                                    <!--</tr>-->
                                                                    <tr>
                                                                        <th>Application Number</th>
                                                                        <td>{{ $student['application_number'] }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Full Name</th>
                                                                        <td>{{ $student['full_name'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Email</th>
                                                                        <td>{{ $student['email'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Date of Birth</th>
   <td>{{ \Carbon\Carbon::parse($student['date_of_birth'])->format('d-m-Y') }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Age</th>
                                                                        <td>{{ $student['age'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Gender</th>
                                                                        <td>{{ $student['gender'] }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Country</th>
                                                                        <td>{{ $student['country'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>State</th>
                                                                        <td>{{ $student['state'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Religion</th>
                                                                        <td>{{ $student['religion'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Community</th>
                                                                        <td>{{ $student['community'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Caste</th>
                                                                        <td>{{ $student['caste'] }}</td>
                                                                    </tr>
                                                                    @if($student['caste'] == 'obc')
                                                                    <tr>
                                                                        <th>OBC category</th>
                                                                        <td>{{ $student['other_scbc'] }}</td>
                                                                    </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <th>Any Disability</th>
                                                                        <td>{{ $student['disability'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Below Poverty Line</th>
                                                                        <td>{{ $student['bpl'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Annual Income</th>
                                                                        <td>{{ $student['annual_income'] }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div id="tab-2" class="tab-pane fade">
                                                <h3>Communication Address</h3>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {{-- <h2>Student Information</h2> --}}
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>House Name</th>
                                                                        <td>{{ $student['permanent_house_name'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Street</th>
                                                                        <td>{{ $student['permanent_street'] }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Post Office</th>
                                                                        <td>{{ $student['permanent_post_office'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>District</th>
                                                                        <td>{{ $student['permanent_district'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Pincode</th>
                                                                        <td>{{ $student['permanent_pincode'] }}</td>
                                                                    </tr>

                                                                    @if (!$student['same'])
                                                                        <tr>
                                                                            <th>Communication House Name</th>
                                                                            <td>{{ $student['communication_house_name'] }}
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <th>Connunication Street</th>
                                                                            <td>{{ $student['communicaiton_street'] }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Communication Post Office</th>
                                                                            <td>{{ $student['communication_post_office'] }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Communication District</th>
                                                                            <td>{{ $student['communication_district'] }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Communication Pincode</th>
                                                                            <td>{{ $student['communication_pincode'] }}
                                                                            </td>
                                                                        </tr>
                                                                    @endif

                                                                    <tr>
                                                                        <th>Tele-Phone</th>
                                                                        <td>{{ $student['telephone'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Mobile</th>
                                                                        <td>{{ $student['mobile'] }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-3" class="tab-pane fade">
                                                <h3>Gaurdian Information</h3>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {{-- <h2>Student Information</h2> --}}
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Parent Name</th>
                                                                        <td>{{ $student['parent_name'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parent Occupation</th>
                                                                        <td>{{ $student['parent_occupation'] }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Parent Address</th>
                                                                        <td>{{ $student['parent_address'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parent Pincode</th>
                                                                        <td>{{ $student['parent_pincode'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parent Telephone</th>
                                                                        <td>{{ $student['parent_telephone'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parent Mobile</th>
                                                                        <td>{{ $student['parent_mobile'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Parent Email</th>
                                                                        <td>{{ $student['parent_email'] }}</td>
                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-4" class="tab-pane fade">
                                                <h3>Qualifying Examination Details</h3>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {{-- <h2>Student Information</h2> --}}
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Degree</th>
                                                                        <td>{{ $student['degree'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Branch</th>
                                                                        <td>{{ $student['branch_subject'] }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>University</th>
                                                                        <td>{{ $student['university'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Passed year</th>
                                                                        <td>{{ $student['passed_month_year'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Subjects & Marks</th>

                                                                        <td class="marks heading">
                                                                            <div>Subject</div>
                                                                            <div>Marks Secured</div>
                                                                            <div>Max mark</div>
                                                                        </td>

                                                                        @foreach ($student['subjects_details'] as $subject)
                                                                            <td class="marks">
                                                                                <div>{{ $subject['subject_name'] }}</div>
                                                                                <div>{{ $subject['marks_secured'] }}</div>
                                                                                <div>{{ $subject['max_marks'] }}</div>
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Total Marks Secured</th>
                                                                        <td>{{ $student['total_marks_secured'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Total Max Mark</th>
                                                                        <td>{{ $student['total_max_marks'] }}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Persentage Of Marks</th>
                                                                        <td>{{ $student['percentage_of_mark'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Scores</th>
                                                                        <td class="marks heading">
                                                                            <div>Register Number</div>
                                                                            <div>Composite Score</div>
                                                                            <div>Date Of Test</div>
                                                                        </td>

                                                                        @foreach ($student['exam_details'] as $exam)
                                                                            <td class="marks">
                                                                                <div>{{ $exam['register_number'] }}</div>
                                                                                <div>{{ $exam['composite_score'] }}</div>
                                                                                <div>
                                                                                    {{ \Carbon\Carbon::parse($exam['date_of_test'])->format('d-m-Y') }}
                                                                                </div>
                                                                            </td>
                                                                        @endforeach
                                                                    </tr>
                                                                    <!--<tr>-->
                                                                    <!--    <th>Course Preference</th>-->
                                                                    <!--    <td>-->
                                                                    <!--        <div class="borde m-1 marks"> 1 :-->
                                                                    <!--            {{ $student['course_preference_1'] }}</div>-->
                                                                    <!--        <div class="borde m-1 marks"> 2 :-->
                                                                    <!--            {{ $student['course_preference_2'] }}</div>-->
                                                                    <!--        <div class="borde m-1 marks"> 3 :-->
                                                                    <!--            {{ $student['course_preference_3'] }}</div>-->
                                                                    <!--    </td>-->

                                                                    <!--</tr>-->
                                                                    <tr>
                                                                        <th>Waiting For Degree Result</th>
                                                                        <td>{{ $student['waiting_for_degree_result'] }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Degree From Out side Kerala ?</th>
                                                                        <td>{{ $student['degree_from_outside_kerala'] }}
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-5" class="tab-pane fade">
                                                <h3>Documents Details</h3>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {{-- <h2>Student Information</h2> --}}
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Signature</th>
                                                                        <td>
                                                                            <img src="{{ asset('img/signature-photo/' . @$student['signature']) }}"
                                                                                alt="" style="width:200px">
                                                                            @if(@$student['signature'])
                                                                             <a href="{{ asset('img/signature-photo/' . @$student['signature']) }}" target="_blank" style="float: right">View</a
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Sslc Certificate</th>
                                                                        <td>
                                                                            <embed
                                                                                src="{{ asset('documents/sslc-certificates/' . @$student['sslc_certificates']) }}"
                                                                                type=""  >
                                                                                @if(@$student['sslc_certificates'])
                                                                                <a href="{{ asset('documents/sslc-certificates/' . @$student['sslc_certificates']) }}" target="_blank" style="float: right">View</a
                                                                               @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Plus 2 Certificate</th>
                                                                        <td>
                                                                            <embed
                                                                                src="{{ asset('documents/plus2-certificates/' . @$student['plus2_certificates']) }}"
                                                                                type="" >
                                                                                @if(@$student['plus2_certificates'])
                                                                                <a href="{{ asset('documents/plus2-certificates/' . @$student['plus2_certificates']) }}" target="_blank" style="float: right">View</a
                                                                               @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Income Certificate</th>
                                                                        <td>
                                                                            <embed
                                                                                src="{{ asset('documents/income-certificate/' . @$student['income_certificate']) }}"
                                                                                type="" >
                                                                                @if(@$student['income_certificate'])
                                                                                <a href="{{ asset('documents/income-certificate/' . @$student['income_certificate']) }}" target="_blank" style="float: right">View</a
                                                                               @endif
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>Community Certificate</th>
                                                                        <td>
                                                                            <embed
                                                                                src="{{ asset('documents/community-certificate/' . @$student['community_certificate']) }}"
                                                                                type="">
                                                                                @if(@$student['community_certificate'])
                                                                                <a href="{{ asset('documents/community-certificate/' . @$student['community_certificate']) }}" target="_blank" style="float: right">View</a
                                                                               @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Score Card</th>
                                                                        <td>
                                                                            <embed
                                                                                src="{{ asset('documents/score-card/' . @$student['score_card']) }}"
                                                                                type="">
                                                                                @if(@$student['score_card'])
                                                                                <a href="{{ asset('documents/score-card/' . @$student['score_card']) }}" target="_blank" style="float: right">View</a
                                                                               @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Disability Certificate</th>
                                                                        <td>
                                                                            <embed
                                                                                src="{{ asset('documents/disability-certificate/' . @$student['disability_certificate']) }}"
                                                                                type="">
                                                                                @if(@$student['disability_certificate'])
                                                                                <a href="{{ asset('documents/disability-certificate/' . @$student['disability_certificate']) }}" target="_blank" style="float: right">View</a
                                                                               @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Age Proof Document</th>
                                                                        <td>
                                                                            <embed
                                                                                src="{{ asset('documents/age-proof/' . @$student['age_proof']) }}"
                                                                                type="">
                                                                                @if(@$student['age_proof'])
                                                                                <a href="{{ asset('documents/age-proof/' . @$student['age_proof']) }}" target="_blank" style="float: right">View</a
                                                                               @endif
                                                                        </td>
                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-6" class="tab-pane fade">
                                                <h3>Reciept Details</h3>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            {{-- <h2>Student Information</h2> --}}
                                                            <table class="table table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Transaction Id</th>
                                                                        <td>{{ @$receipt->transaction_id }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Receipt</th>
                                                                        <td>
                                                                            @if(@$receipt->file!=null)
                                                                            <a href="{{ asset('documents/receipt/'.@$receipt->file) }}" target="_blank"><i class="fa fa-file-pdf" style="font-size: 20px;color:red"></i>View</a>
                                                                       @endif
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
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
                <!-- row -->

                <!-- /row -->
                <!-- row -->
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

    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
