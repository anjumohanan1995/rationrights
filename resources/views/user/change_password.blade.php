@extends('layouts.app')
@section('content')	
	<!-- main-content -->
	<div class="main-content app-content">
		<!-- container -->
		<div class="main-container container-fluid">
			<!-- breadcrumb -->
			<div class="breadcrumb-header justify-content-between row me-0 ms-0 mb-3" >
				<div class="col-xl-3">
					<h4 class="content-title mb-2">Change Password  </h4>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							 
							<li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-box"> </i> - Change Password</li>
						</ol>
					</nav>
				</div>
				 
			</div>
			<!-- /breadcrumb -->
			<!-- main-content-body -->
			<div class="main-content-body">
				 @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
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
									

									<form action="{{ route('update-password') }}" method="POST">
				                        @csrf
				                        <div class="card-body">
				                           
				                            <input type="hidden" name="user_id" value="{{$user}}">

				                            <div class="mb-3">
				                                <label for="oldPasswordInput" class="form-label">Old Password</label>
				                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
				                                    placeholder="Old Password">
				                                @error('old_password')
				                                    <span class="text-danger">{{ $message }}</span>
				                                @enderror
				                            </div>
				                            <div class="mb-3">
				                                <label for="newPasswordInput" class="form-label">New Password</label>
				                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
				                                    placeholder="New Password">
				                                @error('new_password')
				                                    <span class="text-danger">{{ $message }}</span>
				                                @enderror
				                            </div>
				                            <div class="mb-3">
				                                <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
				                                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
				                                    placeholder="Confirm New Password">
				                            </div>

				                        </div>

				                        <div class="card-footer">
				                            <button class="btn btn-success">Submit</button>
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