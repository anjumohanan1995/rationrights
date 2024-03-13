@extends('layouts.app')

@section('content')	<!-- main-content -->


				<!-- main-content -->
				<div class="main-content app-content">
					<!-- container -->
					<div class="main-container container-fluid">
						<!-- breadcrumb -->
						<div class="breadcrumb-header justify-content-between row me-0 ms-0" >
							<div class="col-xl-3">
								<h4 class="content-title mb-2">Applications</h4>
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">

										<li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-user"> </i> - Applications - Aadhaar Only</li>
									</ol>
								</nav>
							</div>

						</div>
						<div class="d-flex my-auto col-xl-9 pe-0" >
							<div class="card">
						        <div class="main-content-body main-content-body-mail card-body p-0" id="search_part">
						            <div class="card-body pt-2 pb-2">
						                <div class="row row-sm">

                                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label>Application No</label>
                                        		<input class="form-control" type="text" name="application_no" id="application_no" placeholder="Application No">
											</div>
											<div class="col-lg mg-t-10 mg-lg-t-0">
                                                <label>District</label>
                                                <select class="form-select" id="district" name="district" required>
                                                    <option value="">District</option>
                                                    @foreach($districts as $district)
                                                    <option value="{{$district->name}}" data-id="{{$district->id}}">{{$district->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('district'))
                                                    <div class="text-danger w-100 error">{{ $errors->first('district') }}</div>

                                                @endif
                                                </div>

                                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                                    <label>Location</label>
                                                    <select class="form-control" name="location1" id="location" >
                                                        <option disabled selected value="">Location</option>
                                                    </select>
                                                    @if ($errors->has('location'))
                                                        <div class="text-danger w-100 error">{{ $errors->first('location') }}</div>
                                                    @endif
                                                    </div>
                                                    <input type="hidden" name="location" id="new_loc">

                                                    <div class="col-lg mg-t-10 mg-lg-t-0">

												<label>Start Date</label>
                                        		<input class="form-control" type="date" name="from_date" id="from_date">
											</div>
											<div class="col-lg mg-t-10 mg-lg-t-0">

												<label>End Date</label>
                                        		<input class="form-control" type="date" name="end_date" id="end_date">
											</div>

											<div class="col-lg mg-t-10 mg-lg-t-0">
											<br>

											<label>&nbsp;&nbsp;</label>
												<button class="btn ripple btn-success btn-block,compact('districts')ock" type="submit" id="submit">Search</button>
                                            </div>
                                        </div>
						        </div>
							</div>
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
									<div class="card"><div class="card-body  table-new">
										 <div class="row mb-3">



											<!--  <div class="col-md-1 col-6 text-center">
  											 	<div class="task-box secondary  mb-0">
  												 <a href="{{route('user.import')}}">
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
                                        <form action="{{ route('export.excel') }}" method="POST" name="importform"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="start_date" id="start_date">
                                            <input type="hidden" name="ending_date" id="ending_date">
                                            <input type="hidden" name="application_number" id="application_number">
                                            <input type="hidden" name="dist" id="dist">
                                            <input type="hidden" name="locations" id="locations">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-info" >Export Excel File</button>
                                            </div>
                                       </form>
											 <table id="example" class="table table-striped table-bordered" style="width:100%;border-collapse: collapse !important;">
       <thead>
														<tr>

															<th>Sl NO.</th>
															<th>Application No.</th>
															<th>Name</th>

															<th>Gender </th>
															<th>Mobile No. </th>
                                                            <th>Since when staying in Kerala</th>
                                                            <th>Aadhaar </th>
                                                            <th>Eligibility (For IMPDS) </th>
                                                            <th>Home State</th>
                                                            <th>Home District </th>
															 <th> District </th>
															 <th> Location </th>
															  <th> Created Date </th>
                                                               <th> View </th>



															{{-- <th>Action </th> --}}

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
                    <h6 class="modal-title">Are you sure?</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body p-5">
                    <div class="text-center">
                        <h4>Are you sure to delete this User?</h4>
                    </div>
                    <form id="ownForm">
                        @csrf
                    <input type="hidden" id="requestId" name="requestId" value="" />
                    <div class="text-center">
                        <button type="button" onclick="ownRequest()" class="btn btn-primary mt-4 mb-0 me-2">Yes</button>
                        <button class="btn btn-default mt-4 mb-0" data-bs-dismiss="modal" type="button">No</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<meta name="csrf-token" content="{{ csrf_token() }}" />



<script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.validate.min.js')}}"></script>

<script  type="text/javascript">

$(document).on("click",".deleteItem",function() {

     var id =$(this).attr('data-id');
     $('#requestId').val($(this).attr('data-id') );
     $('#confirmation-popup').modal('show');District
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
            	headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: '{{ url("user-management/delete") }}'+'/'+reqId,
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
							}, 2000 );

                        $('#example').DataTable().ajax.reload();



                }
            })
        }



     $(document).ready(function(){

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

			       	"url": "{{route('getAdhaarApplications')}}",
			       	// "data": { mobile: $("#mobile").val()}
			       	"data": function ( d ) {
			        	return $.extend( {}, d, {
                            "application_no": $("#application_no").val(),
				            "district": $("#district").val(),
                            "location": $("#location").val(),
				            "from_date": $("#from_date").val(),
				            "to_date": $("#end_date").val(),
				            "delete_ctm": $("#delete_ctm").val(),


			          	});
       				}
       			},

             columns: [
                { data: 'id' },
                { data: 'application_no' },
                { data: 'name' },

                { data: 'gender' },
                { data: 'mobile' },
                { data: 'years' },
                { data: 'aadhaar' },
                { data: 'eligibility' },
                { data: 'home_state' },
				{ data: 'home_district' },

                @if(Auth::user()->role=='State UT User' )
                    { data: 'district', visible: false },
                    { data: 'location', visible: false },
                    { data: 'date',visible: false },
                @else
                    { data: 'district', visible: true },
                    { data: 'location', visible: true },
                    { data: 'date', visible: true  },
                @endif
               
                    { data: 'view' },


                // { data: 'action' }


			],
            "order": [0, 'desc'],
            'ordering': true
         });



      	 table.draw();

      	$('#submit').click(function(){

        	table.draw();
    	});
    	$('#refresh').click(function(){
    		$("#search_part").css("display", "block");
      		$("#delete_ctm").val('');
        	table.draw();
    	});




    	$('#delete').click(function(){

    		//$("#search_part").css("display", "none")
    		$("#delete_ctm").val(1);
    		$("#search_part").css("display", "none");
        	table.draw();
    	});





         // DataTable


      });

    $(document).ready(function() {
    $('#district').change(function() {
        var districtId = $("#district option:selected").data("id");
        //var districtId = $(this).attr('data-id1');
        //alert(districtId);

        if (districtId) {
            $.ajax({
                url: "{{ route('location') }}", // Replace with your route URL to fetch taluks
                type: "GET",
                data: { district_id: districtId },
                success: function(response) {
                    if (response) {
                        $('#new_dist').val(response.name);
                        $('#location').empty();
                        $('#location').append('<option value="">Select Locations</option>');

                        $.each(response.locations, function(key, value) {
                            $('#location').append('<option value="' + value.location_id + '">' + value.name + '</option>');
                        });
                        $('#new_loc').val('');
                    } else {
                       $('#new_dist').val('');
                        $('#new_loc').val('');
                        $('#location').empty();
                        $('#location').append('<option value="">No locations available</option>');
                    }
                }
            });
        } else {
            $('#new_dist').val('');
            $('#new_loc').val('');
            $('#location').empty();
            $('#location').append('<option value="">Select Locations</option>');
        }
    });
    $('#location').change(function() {
        $('#new_loc').val($(this).find('option:selected').text());


    });
});
$(document).ready(function() {

                $('#from_date').on('change', function() {
                    $("#start_date").val(this.value);
                });
                $('#end_date').on('change', function() {
                    $("#ending_date").val(this.value);
                });
                $('#application_no').on('change', function() {
                    $("#application_number").val(this.value);
                });
                $('#district').on('change', function() {
                    $("#dist").val(this.value);
                });
                $('#location').on('change', function() {
                    var locat = $( "#location option:selected" ).text();
                    $("#locations").val(locat);
                });
            });
</script>


@endsection
