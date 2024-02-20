@extends('layouts.app')

@section('content')	
<!-- main-content -->
<div class="main-content app-content">
	<!-- container -->
	<div class="main-container container-fluid">
		<!-- breadcrumb -->
		<div class="breadcrumb-header justify-content-between row me-0 ms-0 mb-3" >
			<div class="col-xl-3">
				<h4 class="content-title mb-2"> Add Permission  </h4>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						 
						<li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-box"> </i> - Add Permission</li>
					</ol>
				</nav>
			</div>
		</div>
		<!-- /breadcrumb -->
		<!-- main-content-body -->
		<div class="main-content-body">
			 
			<!-- row -->
			 
			<!-- /row -->
			<!-- row -->
			<div class="row row-sm">
				<div class="col-lg-8 col-xl-8 col-md-12 col-sm-12 ">
					<div class="card">
						
							<div class="card-body">
								<div id="success_message" class="ajax_response" style="display: none;"></div>
								<div class="mb-4 main-content-label">Add Information</div>
								<form name="createForm" id="createForm" method="post" action="javascript:void(0)">
									@csrf
									<input type="hidden" name="user_id" value="{{ \Auth::user()->id}}">
									<div class="mb-4 main-content-label">Permission Detail</div>
									<div class="form-group">
										<div class="row">
											<div class="col-md-3"><label class="form-label">Permission</label></div>
											<div class="col-md-9"><input type="text" class="form-control" placeholder="Permission" name="name" />
												@error('name')
													<span class="text-danger">{{$message}}</span>
												@enderror
											</div>
										</div>
									</div>
									<div class="card-footer">
										<button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">Save</button>
									
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
					<!-- /main-content -->
	<script  src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script >
if ($("#createForm").length > 0) {
$("#createForm").validate({
	rules: {
		name: {
		required: true,
	
		},

	},
	messages: {
		name: {
		required: "Please enter Permission",
		
		},
	
		
		
		
	
	},
    submitHandler: function(form) {
	$.ajaxSetup({
		headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('#submit').html('Please Wait...');
	$("#submit"). attr("disabled", true);
		$.ajax({
			url: "{{ route('permissions.store')}}",
			type: "POST",
			data: $('#createForm').serialize(),
			success: function( response ) {
				//console.log(response.success);

				$('#submit').html('Submit');
				$("#submit"). attr("disabled", false);
				$('#success_message').fadeIn().html(response.success);
				setTimeout(function() {
					$('#success_message').fadeOut("slow");
				}, 2000 );

				//alert('Data submitted successfully');
				document.getElementById("createForm").reset(); 
			}
		});
}
})
}
</script>

@endsection