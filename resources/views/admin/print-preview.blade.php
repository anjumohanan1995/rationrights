<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="stylesheet" href="https://codepen.io/gymratpacks/pen/VKzBEp#0">
    <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/Assets-print/css/stylesheet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="row">
        <div class="col-md-12">
            <form action="index.html" method="post">

                <div class="banner">
                    <img class="banner_imgg"src="/Assets-print/img/letterhead.JPG">
                    </div>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-6 app_name">
                                <label>Application No : {{ @$validatedData['application_number'] }}</label><br>

                                <label>Date : {{ date('d-m-Y', strtotime(@$validatedData['created_at'])) }}</label><br>

                            </div>
                            <div class="col-6" style="text-align: right;">
                                <img src="{{ asset('img/students-photo/' . @$validatedData['image']) }}" style="width:25%">
                            </div>


                        </div>

                    </div><br>


                <h4 class="title_data"> APPLICATION FOR TWO YEAR MBA PROGRAMME </h4>

                <div class="form-preview">

                      <table border="1" class="table">
                       <tr> <td>

                               Name </td><td> <strong>{{ @$validatedData['full_name'] }}</strong>

                       </td>
                        <td>

                                Date of birth </td><td><strong> {{ date('d-m-Y', strtotime(@$validatedData['date_of_birth'])) }}</strong>

                       </td>
                       </tr><tr> <td>

                                Age </td><td> <strong>{{ @$validatedData['age'] }}</strong>

                           </td>
                                 <td>

                                Tele Phone </td><td> <strong>{{ @$validatedData['telephone'] }}</strong>

                       </td></tr><tr>
                        <td>

                                Mobile </td><td><strong> {{ @$validatedData['mobile'] }}</strong>

                           </td>
                                 <td>

                                Email </td><td> <strong>{{ @$validatedData['email'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Country </td><td> <strong>{{ @$validatedData['country'] }}</strong>

                           </td>
                                 <td>

                                State </td><td> <strong>{{ @$validatedData['state'] }}</strong>


                       </td></tr><tr>
                        <td>

                                Religion </td><td> <strong>{{ @$validatedData['religion'] }}</strong>

                           </td>
                                 <td>

                                Community </td><td> <strong>{{ @$validatedData['community'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Caste </td><td> <strong>{{ @$validatedData['caste'] }}</strong>

                           </td>
                           @if(@$validatedData['caste']=='obc')
                                 <td>

                                OBC Category </td><td><strong> {{ @$validatedData['other_scbc'] }}</strong>

                           </td>
                           @endif
                        </tr><tr>
                                 <td>

                                Disabliliy </td><td> <strong>{{ ucwords(@$validatedData['disability']) }}</strong>

                           </td>
                                 <td>

                                BPL </td><td><strong> {{ ucwords(@$validatedData['bpl']) }}</strong>

                           </td></tr><tr>
                                 <td>

                                Gender </td><td> <strong>{{ ucwords(@$validatedData['gender']) }}</strong>

                           </td>
                                 <td>

                                Permanent House Name </td><td><strong> {{ @$validatedData['permanent_house_name'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Permanent Street </td><td> <strong>{{ @$validatedData['permanent_street'] }}</strong>

                           </td>
                                 <td>

                                Permanent Post Office </td><td> <strong>{{ @$validatedData['permanent_post_office'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Permanent District </td><td> <strong>{{ @$validatedData['permanent_district'] }}</strong>

                           </td>
                                 <td>

                                Permanent Pincode </td><td> <strong>{{ @$validatedData['permanent_pincode'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Communication House Nam</td>
                                 <td>  <strong> {{ @$validatedData['communication_house_name'] }}</strong>

                           </td>
                                 <td>

                                Communication Street </td><td><strong> {{ @$validatedData['communicaiton_street'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Communication Post Office:
                                </td>    <td> <strong>{{ @$validatedData['communication_post_office'] }}</strong>

                           </td>
                                 <td>

                                Communication District:
                                 </td>    <td>  <strong> {{ @$validatedData['communication_district'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Communication Pincode:
                                  </td>    <td> <strong> {{ @$validatedData['communication_pincode'] }}</strong>

                           </td>
                                 <td>

                                Parent Name </td><td> <strong>{{ @$validatedData['parent_name'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Parent Occupation </td><td><strong> {{ @$validatedData['parent_occupation'] }}</strong>

                           </td>
                                 <td>

                                Parent Address </td><td><strong> {{ @$validatedData['parent_address'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Parent Pincode </td><td> <strong>{{ @$validatedData['parent_pincode'] }}</strong>

                           </td>
                                 <td>

                                Parent Telephone </td><td> <strong>{{ @$validatedData['parent_telephone'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Parent Mobile </td><td> <strong>{{ @$validatedData['parent_mobile'] }}</strong>

                           </td>
                                 <td>

                                Parent Email </td><td><strong> {{ @$validatedData['parent_email'] }}</strong>

                           </td></tr><tr>

                                 <td>

                                Degree </td><td> <strong>{{ @$validatedData['degree'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Branch Subject </td><td><strong> {{ @$validatedData['branch_subject'] }}</strong>

                           </td>
                                 <td>

                                University </td><td><strong> {{ @$validatedData['university'] }}</strong>

                           </td></tr><tr>
                            @if(@$validatedData['course'])
                            <td>

                                Course </td><td> <strong>{{ @$validatedData['course'] }}</strong>

                           </td>
                           @endif
                                 <td>

                                Passed Month & Year </td><td> <strong>{{ @$validatedData['passed_month_year'] }}</strong>

                           </td></tr><tr>
                                 <td>

                                Subjects & Marks:

                                </td><td colspan="3">
                                <table class="table">
                                    <thead>

                                        <tr>
                                            <th>
                                                <div>Subject</div>
                                            </th>
                                            <th>
                                                <div>Marks Secured</div>
                                            </th>
                                            <th>
                                                <div>Max mark</div>
                                            </th>
                                        </tr>

                                    </thead>
                                    <tbody>

                                        {{-- <th>Subjects & Marks</th> --}}
                                        @foreach ($validatedData['subjects_details'] as $subject)
                                            <tr>
                                                <td>
                                                    <div>{{ $subject['subject_name'] }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $subject['marks_secured'] }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ $subject['max_marks'] }}</div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>



                           </td></tr><tr>
                                 <td>

                                Total Marks Secured </td><td> {{ @$validatedData['total_marks_secured'] }}

                           </td>
                                 <td>

                                Total Max Marks </td><td> {{ @$validatedData['total_max_marks'] }}

                           </td></tr><tr>
                                 <td>

                                Percentage Of Mark </td><td> {{ @$validatedData['percentage_of_mark'] }}

                           </td></tr><tr>
                                 <td colspan="4"

                                Parent Occupation:  <br>
                                <table class="table">
                                    <thead>

                                        <tr>
                                            <th>
                                                <div>Exam</div>
                                            </th>
                                            <th>
                                                <div>Register Number</div>
                                            </th>
                                            <th>
                                                <div>Composite Score</div>
                                            </th>
                                            <th>
                                                <div>Date of Test</div>
                                            </th>
                                        </tr>

                                    </thead>
                                    <tbody>

                                        {{-- <th>Subjects & Marks</th> --}}
                                        @foreach (@$validatedData['exam_details'] as $subject)
                                            <tr>
                                                <td>
                                                    <div>{{ @$subject['exam_name'] }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ @$subject['register_number'] }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ @$subject['composite_score'] }}</div>
                                                </td>
                                                <td>
                                                    <div>{{ \Carbon\Carbon::parse(@$subject['date_of_test'])->format('d-m-Y') }}
                                                   </td>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table> </td>
                </tr><tr>

                                 <td>

                                Waiting For Degree?:</td>
                                 <td>
                                    {{ ucwords(@$validatedData['waiting_for_degree_result']) }}

                           </td>
                                 <td>

                                Degree From Outside Kerala:</td>
                                 <td>
                                    {{ ucwords(@$validatedData['degree_from_outside_kerala']) }}

                           </td></tr>
                      </table>



                    </div>


                    <div>

                    </div>

                    <div class="declartion">

                        <h4>DECLARATION</h4>
                    </div>

                    <p>The above information is true to the best of my knowledge and I shall abide by the rules and
                        regulations of
                        the college currently prevailing, which may be amended from time to time.</p>


                    <div class="col-12">
                        <div class="row">

                            <div class="col-4">
                                <h6>Place:</h6>
                                <h6>Date:</h6>
                            </div>
                            <div class="col-4">
                                <h6>Signature of Parent/Guardian</h6>
                            </div>
                            <div class="col-4">
                                <h6>Signature of the Candidate</h6>
                            </div>

                        </div>

                    </div>



                </div>


            </div>












            </form>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    (function() {

      window.print();
     // window.location.replace('/receipt/show_receipt');
    })();
</script>
