@extends('layouts.app')

@section('content')
    <!-- main-content -->
    <style>
        div#success_message {
            background: #8bc34a26;
            padding: 20px;
            margin-bottom: 10px;
        }
    </style>

    <!-- main-content -->
    <div class="main-content app-content">
        <!-- container -->
        <div class="main-container container-fluid">
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between row me-0 ms-0">
                <div class="col-xl-3">
                    <h4 class="content-title mb-2">Applications</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-user"> </i>
                                - Applications</li>
                        </ol>
                    </nav>
                </div>
                {{--  <div class="d-flex my-auto col-xl-9 pe-0">
                    <div class="card">
                        <div class="main-content-body main-content-body-mail card-body p-0" id="search_part">
                            <div class="card-body pt-2 pb-2">

                                <div class="row row-sm">
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input class="form-control" placeholder="Application Number" type="text" name="application_number"
                                            id="application_number">
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input class="form-control" placeholder="Name" type="text" name="name"
                                            id="name">
                                    </div>
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input class="form-control" placeholder="Email" type="text" name="email"
                                            id="email">
                                    </div>

                                    <div class="col-lg mg-t-10 mg-lg-t-0"> <button class="btn ripple btn-success btn-block"
                                            type="submit" id="submit">Search</button></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>  --}}
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

                                    <div id="success_message" class="ajax_response" style="display: none;"></div>

                                    <!-- <div class="col-md-1 col-6 text-center" id="delete">
                       <div class="task-box danger  mb-0">
                       <input type="hidden" id="delete_ctm">
                       <p class="mb-0 tx-12">Delete  </p>
                       <h3 class="mb-0"><i class="fa fa-recycle"></i></h3>
                       </div>
                       </div> -->
                                    {{-- <div class="col-md-1 col-6 text-center" id="refresh">
                                        <div class="task-box success  mb-0">
                                            <p class="mb-0 tx-12">Refresh </p>
                                            <h3 class="mb-0"><i class="fa fa-spinner"></i></h3>
                                        </div>
                                    </div> --}}
                                    <!--  <div class="col-md-1 col-6 text-center">
              <div class="task-box secondary  mb-0">
              <a href="{{ route('user.import') }}">
              <p class="mb-0 tx-12">Import  </p>
              <h3 class="mb-0"><i class="fas fa-download"></i></h3>
              </a>
              </div>
              </div> -->

                                    <!-- <div class="col-md-1 col-6 text-center">
                       <div class="task-box secondary  mb-0">
                       <p class="mb-0 tx-12">Search  </p>
                       <h3 class="mb-0"><i class="fa fa-search"></i></h3>
                       </div>
                       </div> -->
                                    <!-- <div class="col-md-8 col-6 text-center pt-3">
                        <div class="float-end">
                         <select name="copytype-ESO" class="form-control" id="edit-copytype-ESO"><option value="" selected="selected">Choose one</option>
                          <option value="EO-ESO">Thiruvananthapuram</option>
                          <option value="EO-SHP">Kollam</option>
                          <option value="EO-PI">Kottayam</option>
                          <option value="EO-CI">Thrissur</option>
                          <option value="EO-PL">Kannur</option>
                          <option value="IO-IO">Alappuzha</option>
                         </select></div>
                       </div>	 -->

                                </div>
                                <h4 class="content-title mb-2"><strong> Pending Applications</strong></h4>

                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Sl. No.</th>


                                            <th> Name</th>
                                            <th> Score</th>
                                            <th>Application Number</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            {{--  <th>Subpriority </th>  --}}
                                            <th>View </th>
                                            <th>Receipt</th>

                                            <th>Status </th>
                                            <th>Created Date</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>



                </div>
                <!-- /row -->
                <!-- row -->
                <div class="row row-sm">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 ">
                        <div class="card">
                            <div class="card-body  table-new">
                                <div class="row mb-3">


                                    <!-- <div class="col-md-1 col-6 text-center" id="delete">
                       <div class="task-box danger  mb-0">
                       <input type="hidden" id="delete_ctm">
                       <p class="mb-0 tx-12">Delete  </p>
                       <h3 class="mb-0"><i class="fa fa-recycle"></i></h3>
                       </div>
                       </div> -->
                                    {{-- <div class="col-md-1 col-6 text-center" id="refresh">
                                        <div class="task-box success  mb-0">
                                            <p class="mb-0 tx-12">Refresh </p>
                                            <h3 class="mb-0"><i class="fa fa-spinner"></i></h3>
                                        </div>
                                    </div> --}}
                                    <!--  <div class="col-md-1 col-6 text-center">
              <div class="task-box secondary  mb-0">
              <a href="{{ route('user.import') }}">
              <p class="mb-0 tx-12">Import  </p>
              <h3 class="mb-0"><i class="fas fa-download"></i></h3>
              </a>
              </div>
              </div> -->

                                    <!-- <div class="col-md-1 col-6 text-center">
                       <div class="task-box secondary  mb-0">
                       <p class="mb-0 tx-12">Search  </p>
                       <h3 class="mb-0"><i class="fa fa-search"></i></h3>
                       </div>
                       </div> -->
                                    <!-- <div class="col-md-8 col-6 text-center pt-3">
                        <div class="float-end">
                         <select name="copytype-ESO" class="form-control" id="edit-copytype-ESO"><option value="" selected="selected">Choose one</option>
                          <option value="EO-ESO">Thiruvananthapuram</option>
                          <option value="EO-SHP">Kollam</option>
                          <option value="EO-PI">Kottayam</option>
                          <option value="EO-CI">Thrissur</option>
                          <option value="EO-PL">Kannur</option>
                          <option value="IO-IO">Alappuzha</option>
                         </select></div>
                       </div>	 -->

                                </div>

                                <div class="row">
                                <h4 class="content-title mb-2"><strong> Approved Applications</strong></h4>

                                <table id="example1" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Sl. No.</th>


                                            <th> Name</th>
                                            <th> Score</th>
                                            <th>Application Number</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            {{--  <th>Subpriority </th>  --}}
                                            <th>View </th>
                                            <th>Receipt </th>
                                            <th>Status </th>
                                            <th>Created Date</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                                </div>

                            </div>
                        </div>
                    </div>



                </div>
                <!-- /row -->
                <!-- row -->

                <div class="row row-sm">
                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 ">
                        <div class="card">
                            <div class="card-body  table-new">
                                <div class="row mb-3">


                                    <!-- <div class="col-md-1 col-6 text-center" id="delete">
                       <div class="task-box danger  mb-0">
                       <input type="hidden" id="delete_ctm">
                       <p class="mb-0 tx-12">Delete  </p>
                       <h3 class="mb-0"><i class="fa fa-recycle"></i></h3>
                       </div>
                       </div> -->
                                    {{-- <div class="col-md-1 col-6 text-center" id="refresh">
                                        <div class="task-box success  mb-0">
                                            <p class="mb-0 tx-12">Refresh </p>
                                            <h3 class="mb-0"><i class="fa fa-spinner"></i></h3>
                                        </div>
                                    </div> --}}
                                    <!--  <div class="col-md-1 col-6 text-center">
              <div class="task-box secondary  mb-0">
              <a href="{{ route('user.import') }}">
              <p class="mb-0 tx-12">Import  </p>
              <h3 class="mb-0"><i class="fas fa-download"></i></h3>
              </a>
              </div>
              </div> -->

                                    <!-- <div class="col-md-1 col-6 text-center">
                       <div class="task-box secondary  mb-0">
                       <p class="mb-0 tx-12">Search  </p>
                       <h3 class="mb-0"><i class="fa fa-search"></i></h3>
                       </div>
                       </div> -->
                                    <!-- <div class="col-md-8 col-6 text-center pt-3">
                        <div class="float-end">
                         <select name="copytype-ESO" class="form-control" id="edit-copytype-ESO"><option value="" selected="selected">Choose one</option>
                          <option value="EO-ESO">Thiruvananthapuram</option>
                          <option value="EO-SHP">Kollam</option>
                          <option value="EO-PI">Kottayam</option>
                          <option value="EO-CI">Thrissur</option>
                          <option value="EO-PL">Kannur</option>
                          <option value="IO-IO">Alappuzha</option>
                         </select></div>
                       </div>	 -->

                                </div>


                                <h4 class="content-title mb-2"><strong> Rejected Applications</strong></h4>
                                <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>

                                            <th>Sl. No.</th>


                                            <th> Name</th>
                                            <th> Score</th>
                                            <th>Application Number</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            {{--  <th>Subpriority </th>  --}}
                                            <th>View </th>
                                            <th>Receipt</th>
                                            <th>Status </th>
                                            <th>Created Date</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
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
    <div class="modal fade" id="approve-popup">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal border-0">
                <div class="modal-header offcanvas-header">
                    <h6 class="modal-title">Are you sure?</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body p-5">
                    <div class="text-center">
                        <h4>Are you sure to Approve this Application?</h4>
                    </div>
                    <form id="ownForm">

                        @csrf
                    <input type="hidden" id="requestId" name="requestId" value="" />
                    <div class="text-center">
                        <button type="button" onclick="approve()" class="btn btn-primary mt-4 mb-0 me-2">Yes</button>
                        <button class="btn btn-default mt-4 mb-0" data-bs-dismiss="modal" type="button">No</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    <div class="modal fade" id="rejection-popup">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content country-select-modal border-0">
                <div class="modal-header offcanvas-header">
                    <h6 class="modal-title">Are you sure to reject this Application?</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body p-5">
					<form id="ownForm">
                        @csrf
                    <div class="text-center">
                        <h5>Reason for Rejection</h5>
						<textarea class="form-control" name="reason" id="reason" requred></textarea>
						<span id="rejection"></span>
					</div>

                    <input type="hidden" id="appl_requestId" name="appl_requestId" value="" />
                    <div class="text-center">
                        <button type="button" onclick="reject()" class="btn btn-primary mt-4 mb-0 me-2">Yes</button>
                        <button class="btn btn-default mt-4 mb-0" data-bs-dismiss="modal" type="button">No</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}" />




    <script type="text/javascript">
        $(document).on("click", ".deleteItem", function() {

            var id = $(this).attr('data-id');
            $('#requestId').val($(this).attr('data-id'));
            $('#confirmation-popup').modal('show');
        });

        /*$.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
              });*/
        function ownRequest() {

            var reqId = $('#requestId').val();
            console.log(reqId);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                url: '{{ url('user-management/delete') }}' + '/' + reqId,
                method: 'get',
                data: 1,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response.success);

                    $('#confirmation-popup').modal('hide');
                    $('#success_message').fadeIn().html(response.success);
                    setTimeout(function() {
                        $('#success_message').fadeOut("slow");
                    }, 2000);

                    $('#example').DataTable().ajax.reload();



                }
            })
        }



        $(document).ready(function() {

            var table = $('#example').DataTable({
                processing: true,
                serverSide: true,

                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "ajax": {

                    "url": "{{ route('getApplications') }}",
                    // "data": { mobile: $("#mobile").val()}
                    "data": function(d) {
                        return $.extend({}, d, {
                            "mobile": $("#mobile").val(),
                            "email": $("#email").val(),
                            "location": $("#location").val(),
                            "name": $("#name").val(),
                            "application_number": $("#application_number").val(),
                            "delete_ctm": $("#delete_ctm").val(),

                        });
                    }
                },

                columns: [
                    {
                        data: 'sl_no'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'score'
                    },
                    {
                        data: 'application_number'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'mobile'
                    },
                    {{--  {
                        data: 'age'
                    },  --}}

                    {
                        data: 'edit'
                    },
                    {
                        data: 'reciept'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'created_at'
                    }


                ],
                "order": [0, 'desc'],
                'ordering': true
            });



            table.draw();

            $('#submit').click(function() {

                table.draw();
            });
            $('#refresh').click(function() {
                $("#search_part").css("display", "block");
                $("#delete_ctm").val('');
                table.draw();
            });




            $('#delete').click(function() {

                //$("#search_part").css("display", "none")
                $("#delete_ctm").val(1);
                $("#search_part").css("display", "none");
                table.draw();
            });


            $(document).on("click",".approveItem",function() {
                var id =$(this).attr('data-id');
                $('#requestId').val($(this).attr('data-id') );
                $('#approve-popup').modal('show');
               });
               $(document).on("click",".rejectItem",function() {

                var id =$(this).attr('data-id');
                $('#appl_requestId').val($(this).attr('data-id') );
                $('#rejection-popup').modal('show');
               });


            // DataTable



            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,

                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "ajax": {

                    "url": "{{ route('getApprovedApplications') }}",
                    // "data": { mobile: $("#mobile").val()}
                    "data": function(d) {
                        return $.extend({}, d, {
                            "mobile": $("#mobile").val(),
                            "email": $("#email").val(),
                            "location": $("#location").val(),
                            "name": $("#name").val(),
                            "application_number": $("#application_number").val(),
                            "delete_ctm": $("#delete_ctm").val(),

                        });
                    }
                },

                columns: [
                    {
                        data: 'sl_no'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'score'
                    },
                    {
                        data: 'application_number'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'mobile'
                    },
                    {{--  {
                        data: 'age'
                    },  --}}

                    {
                        data: 'edit'
                    },
                    {
                        data: 'receipt'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'created_at'
                    }


                ],
                "order": [0, 'desc'],
                'ordering': true
            });



            table.draw();

            $('#submit').click(function() {

                table.draw();
            });
            $('#refresh').click(function() {
                $("#search_part").css("display", "block");
                $("#delete_ctm").val('');
                table.draw();
            });




            $('#delete').click(function() {

                //$("#search_part").css("display", "none")
                $("#delete_ctm").val(1);
                $("#search_part").css("display", "none");
                table.draw();
            });

            var table = $('#example2').DataTable({
                processing: true,
                serverSide: true,

                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "ajax": {

                    "url": "{{ route('getRejectedApplications') }}",
                    // "data": { mobile: $("#mobile").val()}
                    "data": function(d) {
                        return $.extend({}, d, {
                            "mobile": $("#mobile").val(),
                            "email": $("#email").val(),
                            "location": $("#location").val(),
                            "name": $("#name").val(),
                            "application_number": $("#application_number").val(),
                            "delete_ctm": $("#delete_ctm").val(),

                        });
                    }
                },

                columns: [
                    {
                        data: 'sl_no'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'score'
                    },
                    {
                        data: 'application_number'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'mobile'
                    },
                    {{--  {
                        data: 'age'
                    },  --}}

                    {
                        data: 'edit'
                    },
                    {
                        data: 'receipt'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'created_at'
                    }


                ],
                "order": [0, 'desc'],
                'ordering': true
            });



            table.draw();

            $('#submit').click(function() {

                table.draw();
            });
            $('#refresh').click(function() {
                $("#search_part").css("display", "block");
                $("#delete_ctm").val('');
                table.draw();
            });




            $('#delete').click(function() {

                //$("#search_part").css("display", "none")
                $("#delete_ctm").val(1);
                $("#search_part").css("display", "none");
                table.draw();
            });


        });
        function approve() {

            var reqId = $('#requestId').val();
           // alert($('#requestId').val());
             $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: '{{ url("verify/approve") }}'+'/'+reqId,
               // type: 'PATCH',
                method: 'get',
                data: {status:"1",application_id:reqId},
                contentType: "application/json; charset=utf-8",
                dataType: 'json',
                success: function(response) {
                    console.log(response.success);

                        $('#approve-popup').modal('hide');
                        $('#success_message').fadeIn().html(response.success);
                            setTimeout(function() {
                                $('#success_message').fadeOut("slow");
                            }, 2000 );

                        $('#example').DataTable().ajax.reload();
                        $('#example1').DataTable().ajax.reload();



                }
            })
          }
          function reject() {
             var reason = $('#reason').val();
             if($('#reason').val() == ""){
                 rejection.innerHTML = "<span style='color: red;'>"+"Please enter the reason for rejection</span>";
             }
             else{
                 rejection.innerHTML ="";
                 var reqId = $('#appl_requestId').val();
             console.log(reqId);
             $.ajax({
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                 url: '{{ url("verify/reject") }}'+'/'+reqId,
                 method: 'get',
                 data: {status:"1",reason:reason},
                 contentType: "application/json; charset=utf-8",
                 dataType: 'json',
                 success: function(response) {
                     console.log(response.success);

                         $('#rejection-popup').modal('hide');
                         $('#success_message').fadeIn().html(response.success);
                             setTimeout(function() {
                                 $('#success_message').fadeOut("slow");
                             }, 2000 );

                         $('#example').DataTable().ajax.reload();
                         $('#example2').DataTable().ajax.reload();
                 }
             })

             }
          }
    </script>
@endsection
