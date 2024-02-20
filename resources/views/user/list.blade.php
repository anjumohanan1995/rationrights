@extends('layouts.app')

@section('content')	<!-- main-content -->


				<!-- main-content -->
				<div class="main-content app-content">
					<!-- container -->
					<div class="main-container container-fluid">
						<!-- breadcrumb -->
						<div class="breadcrumb-header justify-content-between row me-0 ms-0" >
							<div class="col-xl-3">
								<h4 class="content-title mb-2">USER Management</h4>
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										 
										<li class="breadcrumb-item active" aria-current="page"><i class="side-menu__icon fe fe-user"> </i> - USER Management</li>
									</ol>
								</nav>
							</div>
							<div class="d-flex my-auto col-xl-9 pe-0">
								 <div class="card">
            <div class="main-content-body main-content-body-mail card-body p-0">
                <div class="card-body pt-2 pb-2">
                     
                    <div class="row row-sm">
                        <div class="col-lg mg-t-10 mg-lg-t-0"><input class="form-control" placeholder="LP Number" type="text"></div>
                        
                        <div class="col-lg mg-t-10 mg-lg-t-0">
						<select name="ordstatus" class="form-control" id="edit-ordstatus"><option value="" selected="selected">Choose Vehicle Category</option><option value="APPRV">Approved</option><option value="CANC">Cancel</option><option value="COMP">Submitted</option><option value="CONF">Confirmed</option><option value="DRF">Draft</option><option value="OPEN">Open</option></select>
						</div>
                    
                        <div class="col-lg"><select name="ordlocation" class="form-control" id="edit-ordlocation"><option value="" selected="selected">Choose Model</option><option value="2">Hundai</option></select></div>
						 <div class="col-lg"><select name="ordlocation" class="form-control" id="edit-ordlocation"><option value="" selected="selected">Choose Color</option><option value="2">Red</option></select></div>
                        
                        <div class="col-lg mg-t-10 mg-lg-t-0"> <button class="btn ripple btn-success btn-block">Search</button></div>
                    </div>
                </div>
            </div>
        </div>
							</div>
						</div>
						<!-- /breadcrumb -->
						<!-- main-content-body -->
						<div class="main-content-body">
							 
							<!-- row -->
							 
							<!-- /row -->
							<!-- row -->
							<div class="row row-sm">
								<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 ">
									<div class="card"><div class="card-body  table-new">
										 <div class="row mb-3"> 
											 <div class="col-md-1 col-6 text-center"> <div class="task-box primary mb-0"> <a ><p class="mb-0 tx-12">Add </p><h3 class="mb-0"><i class="fa fa-plus"></i></h3></a> </div> </div> 
											 <div class="col-md-1 col-6 text-center"> <div class="task-box danger  mb-0"> <p class="mb-0 tx-12">Delete  </p><h3 class="mb-0"><i class="fa fa-recycle"></i></h3> </div> </div>
											 <div class="col-md-1 col-6 text-center"> <div class="task-box success  mb-0"> <p class="mb-0 tx-12">Refresh  </p><h3 class="mb-0"><i class="fa fa-spinner"></i></h3> </div> </div>
											 <div class="col-md-1 col-6 text-center"> <div class="task-box secondary  mb-0"> <p class="mb-0 tx-12">Search  </p><h3 class="mb-0"><i class="fa fa-search"></i></h3> </div> </div>
											<div class="col-md-8 col-6 text-center pt-3">
												<div class="float-end">
													<select name="copytype-ESO" class="form-control" id="edit-copytype-ESO"><option value="" selected="selected">Choose one</option>
														<option value="EO-ESO">Thiruvananthapuram</option>
														<option value="EO-SHP">Kollam</option>
														<option value="EO-PI">Kottayam</option>
														<option value="EO-CI">Thrissur</option>
														<option value="EO-PL">Kannur</option>
														<option value="IO-IO">Alappuzha</option>
													</select></div>
											</div>	
												
										</div>
										
											 <table id="example" class="table table-striped table-bordered" style="width:100%">
       <thead>
														<tr>
															
															<th>Email</th>
															<th>Employee ID</th>
															<th>First Name</th>
															<th>Last Name</th>
															<th>Mobile </th>
															 
														</tr>
													</thead>
         <tbody>
														 
													<tr>
															<th>1 </th>
															<th>Admin</th>
															<th>Admin</th>
															<th>Admin</th>
															<th>Admin</th>
															<th>A </th>
															 
														</tr>	 
			  
													<tr>
															<th>2 </th>
															<th>Muyhaiyan</th>
															<th>12345</th>
															<th>Muyhaiyan</th>
															<th>M</th>
															<th>Administrator - ANPR </th>
														</tr>	 
														 
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

@endsection