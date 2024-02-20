@extends('layouts.app')

@section('content')	<!-- main-content -->
<!-- main-content -->
<div class="main-content app-content">
	<!-- container -->
	<div class="main-container container-fluid">
		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between row me-0 ms-0" >
			<div class="col-xl-3">
				<h4 class="content-title mb-2">Role Management</h4>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">

						<li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-user"> </i> - Role Management</li>
					</ol>
				</nav>
			</div>
			<!-- <div class="my-auto col-xl-9 pe-0">
				<div class="card">
            		<div class="main-content-body main-content-body-mail card-body p-0">
                		<div class="card-body pt-2 pb-2">

                    		<div class="row row-sm">
		                    	<div class="col-lg mg-t-10 mg-lg-t-0">
		                        	<input class="form-control" placeholder="Role" type="text" name="role" id="role">
		                        </div>
		                        <div class="col-lg mg-t-3 mg-lg-t-0"> <button class="btn ripple btn-success btn-block" type="submit" id="submit">Search</button>
		                        </div>
                    		</div>
                		</div>
            		</div>
       			</div>
			</div> -->
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
			<!-- row -->
			<div class="row row-sm">
				<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 ">
					<div class="card">
						<div class="card-body  table-new">
						 	<div class="row mb-3">
								<div class="col-md-1 col-6 text-center">
								  <div class="task-box primary mb-0">
								  	<a href="{{route('roles.create')}}"><p class="mb-0 tx-12">Add </p><h3 class="mb-0"><i class="fa fa-plus"></i></h3></a>
								  </div>
								</div>
								<!--  <div class="col-md-1 col-6 text-center" id="delete">
								 	<div class="task-box danger  mb-0">
								 		 <input type="hidden" id="delete_ctm">
								 	 	<p class="mb-0 tx-12">Delete  </p>
								 	 	<h3 class="mb-0"><i class="fa fa-recycle"></i></h3>
								 	</div>
								 </div> -->
								 <div class="col-md-1 col-6 text-center" id="refresh">
								 	<div class="task-box success  mb-0">
								 	 <p class="mb-0 tx-12">Refresh  </p>
								 	 <h3 class="mb-0"><i class="fa fa-spinner"></i></h3>
								 	</div>
								 </div>
								<!-- <div class="col-md-1 col-6 text-center">
								 	<div class="task-box secondary  mb-0">
								 		<p class="mb-0 tx-12">Search  </p>
								 		<h3 class="mb-0"><i class="fa fa-search"></i></h3>
								 	</div>
								</div> -->
							</div>
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Role</th>
										<th>Action </th>
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
                    <h4>Are you sure to delete this Role?</h4>
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




<script  type="text/javascript">

$(document).on("click",".deleteItem",function() {

     var id =$(this).attr('data-id');
     $('#requestId').val($(this).attr('data-id') );
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
            	headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                url: '{{ url("roles/delete") }}'+'/'+reqId,
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

			       	"url": "{{route('getRoles')}}",
			       	// "data": { mobile: $("#mobile").val()}
			       	"data": function ( d ) {
			        	return $.extend( {}, d, {
				            "name": $("#role").val(),
				            "delete_ctm": $("#delete_ctm").val(),


			          	});
       				}
       			},

             columns: [
                { data: 'name' },
                { data: 'edit' }


			],

         });



      	 table.draw();

      	$('#submit').click(function(){

        	table.draw();
    	});
    	$('#refresh').click(function(){
      		$("#delete_ctm").val('');
        	table.draw();
    	});




    	$('#delete').click(function(){
    		$("#delete_ctm").val(1);
        	table.draw();
    	});





         // DataTable


      });
      </script>


@endsection
