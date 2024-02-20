@extends('layouts.app')
@section('content')

<!-- main-content -->
				<div class="main-content app-content">
					<!-- container -->
					<div class="main-container container-fluid">
						<!-- breadcrumb -->
						<div class="breadcrumb-header justify-content-between row me-0 ms-0" >
							<div class="col-xl-9">
								<h4 class="content-title mb-2">User Import 
</h4>
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										 
										<li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-box"> </i> -User
</li>
									</ol>
								</nav>
							</div><div class="col-xl-3">
								
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
							<div class="row row-sm mt-4">
								<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 ">
									
									<div class="card"> 

										<a href="{{url('/')}}/admin/uploads/sample_user.xlsx" target="_blank"  >
											<button type="button" class="btn btn-primary float-left" >Sample File download</button></a>
                                                     

										
										<div class="card-body">
												 <div id="success_message" class="ajax_response" style="display: none;"></div>
												 
			                                   <form action="{{ route('user.importStore') }}" method="POST" enctype="multipart/form-data">
													@csrf
													 
													<!--<div class="form-group">
														<div class="row">
															<div class="col-md-3"><label class="form-label">Category</label></div>
															<div class="col-md-9">
																<select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
																	<option>Us English</option>
																	<option>Arabic</option>
																	<option>Korean</option>
																</select>
																 
															</div>
														</div>
													</div>-->
													
													<div class="mb-4 main-content-label">User Details</div>
													<div class="form-group">
														<div class="row">
																<input type="hidden" class="form-control" placeholder="Name" name="user_id" value="{{ \Auth::user()->id}}" />
															<div class="col-md-4 mb-4">
																<label class="form-label">File</label>
																<input type="file" class="form-control" placeholder="Name" name="file" />
																@error('file')
																   <span class="text-danger">{{$message}}</span>
																@enderror
															</div>
															
															 
														</div>
													</div>
													 
												 <button type="submit" id="submit" class="btn btn-warning waves-effect waves-light float-end">Save</button>
													 
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