@extends('layouts.app')

@section('content')
    <style>
        .chartjs-render-monitor {
            height: 350px !important;
        }

        .table-span {
            font-size: 11px;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(40%, 1fr));
            grid-gap: 20px;
        }

        table {
            border: 1px solid rgb(99, 94, 94);
        }

        td,
        th {
            border: 1px solid rgb(99, 94, 94);
        }
    </style>
    <div class="main-content app-content">
        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div>
                    <h4 class="content-title mb-2">Hi, Welcome {{ @\Auth::user()->name }} !</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!-- /breadcrumb -->
            <!-- main-content-body -->


            <div class="main-content-body">
                <div class="row row-sm card-grid">


                    {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 "> --}}
                    <div>
                        <div class="card overflow-hidden project-card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <svg class="me-4 ht-60 wd-60 my-auto danger" viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M843.282963 870.115556c-8.438519-140.515556-104.296296-257.422222-233.908148-297.14963C687.881481 536.272593 742.4 456.533333 742.4 364.088889c0-127.241481-103.158519-230.4-230.4-230.4S281.6 236.847407 281.6 364.088889c0 92.444444 54.518519 172.183704 133.12 208.877037-129.611852 39.727407-225.46963 156.634074-233.908148 297.14963-0.663704 10.903704 7.964444 20.195556 18.962963 20.195556l0 0c9.955556 0 18.299259-7.774815 18.962963-17.73037C227.745185 718.506667 355.65037 596.385185 512 596.385185s284.254815 122.121481 293.357037 276.195556c0.568889 9.955556 8.912593 17.73037 18.962963 17.73037C835.318519 890.311111 843.946667 881.019259 843.282963 870.115556zM319.525926 364.088889c0-106.287407 86.186667-192.474074 192.474074-192.474074s192.474074 86.186667 192.474074 192.474074c0 106.287407-86.186667 192.474074-192.474074 192.474074S319.525926 470.376296 319.525926 364.088889z" />
                                        </svg>
                                    </div>
                                    <div class="project-content">
                                        <h6>Application Details</h6>
                                        <button class="btn btn-primary waves-effect waves-light">Edit Details</button>
                                        <ul>
                                            <li>
                                                <strong>Application Status</strong>
                                                <span id="recordsTodayCount">{{ @$data->MbaApplication->status }}</span>
                                            </li>
                                            <li>
                                                <strong>Applied On</strong>
                                                <span id="recordsTodayCount">{{ @$data->MbaApplication->status }}</span>
                                            </li>
                                            <li>
                                                <strong>Degree</strong>
                                                <span id="recordsTodayCount">{{ @$data->MbaApplication->degree }}</span>
                                            </li>
                                            <li>
                                                <strong>Branch Subject</strong>
                                                <span id="userallCount">{{ @$data->MbaApplication->branch_subject }}</span>
                                            </li>
                                            <li>
                                                <strong>University</strong>
                                                <span id="userallCount">{{ @$data->MbaApplication->university }}</span>
                                            </li>
                                            <li>
                                                <strong>Passed Month & Year</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->passed_month_year }}</span>
                                            </li>
                                            <li class="" style="height:auto;">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <strong>Qualifying Exam Subjects</strong>
                                                    </div>
                                                    <div>
                                                        <span class="table-span">
                                                            <table class="table-style">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Subjects</th>
                                                                        <th>Marks Secured</th>
                                                                        <th>Max Marks</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach (@$data->MbaApplication->subjects_details as $items)
                                                                        <tr>
                                                                            <td>
                                                                                <span
                                                                                    id="userallCount">{{ @$items['subject_name'] }}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span
                                                                                    id="userallCount">{{ @$items['marks_secured'] }}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span
                                                                                    id="userallCount">{{ @$items['max_marks'] }}</span>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </span>

                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <strong>Total Marks Secured</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->total_marks_secured }}</span>
                                            </li>

                                            <li>
                                                <strong>Total Max Marks</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->total_max_marks }}</span>
                                            </li>
                                            <li>
                                                <strong>Percentage Of Mark</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->percentage_of_mark }}</span>
                                            </li>
                                            <li class="" style="height:auto;">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <strong>CAT/CMAT/KMAT</strong>
                                                    </div>
                                                    <div>
                                                        <span class="table-span">
                                                            <table class="table-style">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Register Number</th>
                                                                        <th>Composite Score</th>
                                                                        <th>Date Of Test</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach (@$data->MbaApplication->subjects_details as $items)
                                                                        <tr>
                                                                            <td>
                                                                                <span
                                                                                    id="userallCount">{{ @$items['subject_name'] }}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span
                                                                                    id="userallCount">{{ @$items['marks_secured'] }}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span
                                                                                    id="userallCount">{{ @$items['max_marks'] }}</span>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </span>

                                                    </div>
                                                </div>
                                            </li>
                                            {{-- <li>
                                                <strong>Register Number</strong>
                                                <span id="userallCount">{{ @$data->MbaApplication->register_number }}</span>
                                            </li> --}}
                                            {{-- <li>
                                                <strong>Composite Score</strong>
                                                <span id="userallCount">{{ @$data->MbaApplication->composite_score }}</span>
                                            </li> --}}
                                            {{-- <li>
                                                <strong>Date Of Test</strong>
                                                <span id="userallCount">{{ @$data->MbaApplication->date_of_test }}</span>
                                            </li> --}}
                                            <li>
                                                <strong>Course Preference1</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->course_preference_1 }}</span>
                                            </li>
                                            <li>
                                                <strong>Course Preference2</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->course_preference_2 }}</span>
                                            </li>
                                            <li>
                                                <strong>Course Preference3</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->course_preference_3 }}</span>
                                            </li>
                                            <li>
                                                <strong>SSLC Certificates</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->sslc_certificates }}</span>
                                            </li>
                                            <li>
                                                <strong>Plus2 Certificates</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->plus2_certificates }}</span>
                                            </li>
                                            <li>
                                                <strong>Degree From Outside Kerala</strong>
                                                <span
                                                    id="userallCount">{{ @$data->MbaApplication->degree_from_outside_kerala }}</span>
                                            </li>
                                            <li>
                                                <strong>Email</strong>
                                                <span id="userallCount">{{ @$data->MbaApplication->email }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12"> --}}
                    <div>
                        <div class="card overflow-hidden project-card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="my-auto">

                                        <svg class="me-4 ht-60 wd-60 my-auto success" viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M402.602667 713.706667a22.4 22.4 0 0 1-6.08-0.874667c-108.437333-32.256-184.170667-133.866667-184.170667-247.125333a21.333333 21.333333 0 1 1 42.666667 0c0 94.528 63.189333 179.306667 153.664 206.208a21.333333 21.333333 0 1 1-6.08 41.792zM915.114667 942.293333a21.290667 21.290667 0 0 1-15.381334-6.549333l-179.669333-186.922667a21.333333 21.333333 0 0 1 30.741333-29.589333l179.669334 186.922667a21.333333 21.333333 0 0 1-15.36 36.138666z" />
                                            <path d="M519.936 724.373333m-32 0a32 32 0 1 0 64 0 32 32 0 1 0-64 0Z" />
                                            <path
                                                d="M471.552 849.706667c-211.733333 0-384-172.266667-384-384s172.266667-384 384-384 384 172.266667 384 384a381.013333 381.013333 0 0 1-115.861333 274.901333 21.312 21.312 0 1 1-29.781334-30.549333 338.645333 338.645333 0 0 0 102.976-244.352c0-188.202667-153.130667-341.333333-341.333333-341.333334s-341.333333 153.130667-341.333333 341.333334 153.130667 341.333333 341.333333 341.333333c37.632 0 74.496-6.058667 109.653333-18.005333a21.354667 21.354667 0 0 1 13.717334 40.426666c-39.573333 13.44-81.066667 20.245333-123.370667 20.245334z" />
                                        </svg>
                                    </div>
                                    <div class="project-content">
                                        <h6>Personal Details </h6>
                                        <ul>
                                            <li>
                                                <strong>Date of Birth</strong>
                                                <span
                                                    id="recordsTodayCount">{{ @$data->MbaApplication->date_of_birth }}</span>
                                            </li>
                                            <li>
                                                <strong>Age</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->age }} </span>
                                            </li>
                                            <li>
                                                <strong>Country</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->country }} </span>
                                            </li>
                                            <li>
                                                <strong>State</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->state }} </span>
                                            </li>
                                            <li>
                                                <strong>Religion</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->religion }} </span>
                                            </li>
                                            <li>
                                                <strong>Community</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->community }} </span>
                                            </li>

                                            <li>
                                                <strong>Caste</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->caste }} </span>
                                            </li>
                                            <li>
                                                <strong>Scbc</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->other_scbc }} </span>
                                            </li>
                                            <li>
                                                <strong>Ration card(BPL)</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->bpl }} </span>
                                            </li>
                                            <li>
                                                <strong>Gender</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->gender }} </span>
                                            </li>
                                            <li>
                                                <strong>Annual Income</strong>
                                                <span id="recordsAllCount">{{ @$data->MbaApplication->annual_income }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12"> --}}
                    <div>
                        <div class="card overflow-hidden project-card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="my-auto">

                                        <svg class="me-4 ht-60 wd-60 my-auto warning" viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M79 295h137v641H79zM329 563h137v373H329zM579 367h137v569H579zM829 128h137v808H829z" />
                                        </svg>
                                    </div>
                                    <div class="project-content">
                                        <h6>Contact Details </h6>
                                        <ul>
                                            <li>
                                                <strong>Permanent Address</strong>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->permanent_house_name }}</span>
                                                <br>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->permanent_street }}</span>
                                                <br>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->permanent_post_office }}</span>
                                                <br>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->permanent_district }}</span>
                                                <br>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->permanent_pincode }}</span>
                                                <br>

                                            </li>
                                            <li>
                                                <strong>Communication Address </strong>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->communication_house_name }}</span>
                                                <br>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->communication_street }}</span>
                                                <br>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->communication_post_office }}</span>
                                                <br>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->communication_district }}</span>
                                                <br>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->communication_pincode }}</span>


                                            </li>
                                            <li>
                                                <strong>Telephone </strong>
                                                <span id="currentYearCount">{{ @$data->MbaApplication->telephone }}</span>
                                            </li>
                                            <li>
                                                <strong>Mobile </strong>
                                                <span id="currentYearCount">{{ @$data->MbaApplication->mobile }}</span>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12"> --}}
                    <div>
                        <div class="card overflow-hidden project-card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="my-auto">
                                        <svg enable-background="new 0 0 469.682 469.682" version="1.1"
                                            class="me-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68"
                                            xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z">
                                            </path>
                                            <path
                                                d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z">
                                            </path>
                                            <path
                                                d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z">
                                            </path>
                                            <path
                                                d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z">
                                            </path>
                                            <path
                                                d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="project-content">
                                        <h6>Family Details</h6>
                                        <ul>
                                            <li>
                                                <strong>Parent Name</strong>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->parent_name }}</span>

                                            </li>
                                            <li>
                                                <strong>Parent Occupation</strong>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->parent_occupation }}</span>

                                            </li>
                                            <li>
                                                <strong>Parent Address</strong>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->parent_address }}</span>

                                            </li>
                                            <li>
                                                <strong>Parent Pincode</strong>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->parent_pincode }}</span>

                                            </li>
                                            <li>
                                                <strong>Parent Telephone</strong>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->parent_telephone }}</span>

                                            </li>
                                            <li>
                                                <strong>Parent Mobile</strong>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->parent_mobile }}</span>

                                            </li>
                                            <li>
                                                <strong>Parent Email</strong>
                                                <span
                                                    id="currentYearCount">{{ @$data->MbaApplication->parent_email }}</span>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->


                <!-- /row -->

                <!-- row -->

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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
