@extends('layouts.app')

@section('content')
<style>
.chartjs-render-monitor{
	height: 350px !important;
}

</style>
			<div class="main-content app-content">
					<!-- container -->
					<div class="main-container container-fluid">
						<!-- breadcrumb -->
						<div class="breadcrumb-header justify-content-between">
							<div>
								<h4 class="content-title mb-2">Hi, Welcome RateUp !</h4>
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="javascript:void(0);">Dashboard</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Project</li>
									</ol>
								</nav>
							</div>
							<div class="d-flex my-auto">
								<div class="d-flex right-page">
									<div class="d-flex justify-content-center me-5">
										<div class="">
											<span class="d-block">
												<span class="label">Total Data</span>
											</span>
											<span class="value" id="allHots"></span>
										</div>
										<div class="ms-3 mt-2">
											<span class="sparkline_bar">
												<canvas width="52" height="30" style="display: inline-block; width: 52px; height: 30px; vertical-align: top;"> </canvas>
											</span>
										</div>
									</div>
									<div class="d-flex justify-content-center">
										<div class="">
											<span class="d-block">
												<span class="label">Approved Application</span>
											</span>
											<span class="value" id="allUser">  </span>
										</div>
										<div class="ms-3 mt-2">
											<span class="sparkline_bar31">
												<canvas width="52" height="30" style="display: inline-block; width: 52px; height: 30px; vertical-align: top;"> </canvas>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /breadcrumb -->
						<!-- main-content-body -->
						<div class="main-content-body">
							<div class="row row-sm">
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="card overflow-hidden project-card">
										<div class="card-body">
											<div class="d-flex">
												<div class="my-auto">
													<svg enable-background="new 0 0 469.682 469.682" version="1.1" class="me-4 ht-60 wd-60 my-auto primary" viewBox="0 0 469.68 469.68" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
														<path d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z"></path>
														<path d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"></path>
														<path d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z"></path>
														<path
															d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z"
														></path>
														<path
															d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z"
														></path>
													</svg>
												</div>
												<div class="project-content">
													<h6>Approved Application</h6>
													<ul>

														<li>
															<strong>Total</strong>
															<span >{{@$data['approvedApplications']}}</span>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="card overflow-hidden project-card">
										<div class="card-body">
											<div class="d-flex">
												<div class="my-auto">



													<svg class="me-4 ht-60 wd-60 my-auto danger"  viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M843.282963 870.115556c-8.438519-140.515556-104.296296-257.422222-233.908148-297.14963C687.881481 536.272593 742.4 456.533333 742.4 364.088889c0-127.241481-103.158519-230.4-230.4-230.4S281.6 236.847407 281.6 364.088889c0 92.444444 54.518519 172.183704 133.12 208.877037-129.611852 39.727407-225.46963 156.634074-233.908148 297.14963-0.663704 10.903704 7.964444 20.195556 18.962963 20.195556l0 0c9.955556 0 18.299259-7.774815 18.962963-17.73037C227.745185 718.506667 355.65037 596.385185 512 596.385185s284.254815 122.121481 293.357037 276.195556c0.568889 9.955556 8.912593 17.73037 18.962963 17.73037C835.318519 890.311111 843.946667 881.019259 843.282963 870.115556zM319.525926 364.088889c0-106.287407 86.186667-192.474074 192.474074-192.474074s192.474074 86.186667 192.474074 192.474074c0 106.287407-86.186667 192.474074-192.474074 192.474074S319.525926 470.376296 319.525926 364.088889z"  /></svg>
												</div>
												<div class="project-content">
													<h6>Rejected Application</h6>
													<ul>

														<li>
															<strong>Total</strong>
															<span  id="userallCount">{{@$data['rejectedApplications']}}</span>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="card overflow-hidden project-card">
										<div class="card-body">
											<div class="d-flex">
												<div class="my-auto">
													<!-- <svg enable-background="new 0 0 477.849 477.849" class="me-4 ht-60 wd-60 my-auto success" version="1.1" viewBox="0 0 477.85 477.85" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
														<path
															d="m374.1 385.52c71.682-74.715 69.224-193.39-5.492-265.08-34.974-33.554-81.584-52.26-130.05-52.193-103.54-0.144-187.59 83.676-187.74 187.22-0.067 48.467 18.639 95.077 52.193 130.05l-48.777 65.024c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l47.275-63.044c65.4 47.651 154.08 47.651 219.48 0l47.275 63.044c5.655 7.541 16.353 9.069 23.893 3.413 7.541-5.655 9.069-16.353 3.413-23.893l-48.775-65.024zm-135.54 24.064c-84.792-0.094-153.51-68.808-153.6-153.6 0-84.831 68.769-153.6 153.6-153.6s153.6 68.769 153.6 153.6-68.769 153.6-153.6 153.6z"
														></path>
														<path
															d="m145.29 24.984c-33.742-32.902-87.767-32.221-120.67 1.521-32.314 33.139-32.318 85.997-8e-3 119.14 6.665 6.663 17.468 6.663 24.132 0l96.546-96.529c6.663-6.665 6.663-17.468 0-24.133zm-106.55 82.398c-12.186-25.516-1.38-56.08 24.136-68.267 13.955-6.665 30.175-6.665 44.131 0l-68.267 68.267z"
														></path>
														<path
															d="m452.49 24.984c-33.323-33.313-87.339-33.313-120.66 0-6.663 6.665-6.663 17.468 0 24.132l96.529 96.529c6.665 6.663 17.468 6.663 24.132 0 33.313-33.322 33.313-87.338 0-120.66zm-14.08 82.449-68.301-68.301c19.632-9.021 42.79-5.041 58.283 10.018 15.356 15.341 19.371 38.696 10.018 58.283z"
														></path>
														<path
															d="m238.56 136.52c-9.426 0-17.067 7.641-17.067 17.067v96.717l-47.787 63.71c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l51.2-68.267c2.216-2.954 3.413-6.547 3.413-10.24v-102.4c1e-3 -9.426-7.64-17.067-17.065-17.067z"
														></path>
													</svg> -->

													<svg   class="me-4 ht-60 wd-60 my-auto success"  viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
														<path d="M402.602667 713.706667a22.4 22.4 0 0 1-6.08-0.874667c-108.437333-32.256-184.170667-133.866667-184.170667-247.125333a21.333333 21.333333 0 1 1 42.666667 0c0 94.528 63.189333 179.306667 153.664 206.208a21.333333 21.333333 0 1 1-6.08 41.792zM915.114667 942.293333a21.290667 21.290667 0 0 1-15.381334-6.549333l-179.669333-186.922667a21.333333 21.333333 0 0 1 30.741333-29.589333l179.669334 186.922667a21.333333 21.333333 0 0 1-15.36 36.138666z"  /><path d="M519.936 724.373333m-32 0a32 32 0 1 0 64 0 32 32 0 1 0-64 0Z"  /><path d="M471.552 849.706667c-211.733333 0-384-172.266667-384-384s172.266667-384 384-384 384 172.266667 384 384a381.013333 381.013333 0 0 1-115.861333 274.901333 21.312 21.312 0 1 1-29.781334-30.549333 338.645333 338.645333 0 0 0 102.976-244.352c0-188.202667-153.130667-341.333333-341.333333-341.333334s-341.333333 153.130667-341.333333 341.333334 153.130667 341.333333 341.333333 341.333333c37.632 0 74.496-6.058667 109.653333-18.005333a21.354667 21.354667 0 0 1 13.717334 40.426666c-39.573333 13.44-81.066667 20.245333-123.370667 20.245334z"  />
													</svg>
												</div>
												<div class="project-content">
													<h6>Pending Application</h6>
													<ul>

														<li>
															<strong>Total</strong>
															<span id="recordsAllCount"> {{@$data['pendingApplications']}}</span>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
									<div class="card overflow-hidden project-card">
										<div class="card-body">
											<div class="d-flex">
												<div class="my-auto">
													<!-- <svg enable-background="new 0 0 512 512" class="me-4 ht-60 wd-60 my-auto warning" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
														<path
															d="m259.2 317.72h-6.398c-8.174 0-14.824-6.65-14.824-14.824 1e-3 -8.172 6.65-14.822 14.824-14.822h6.398c8.174 0 14.825 6.65 14.825 14.824h29.776c0-20.548-13.972-37.885-32.911-43.035v-33.74h-29.777v33.739c-18.94 5.15-32.911 22.487-32.911 43.036 0 24.593 20.007 44.601 44.601 44.601h6.398c8.174 0 14.825 6.65 14.825 14.824s-6.65 14.824-14.825 14.824h-6.398c-8.174 0-14.824-6.65-14.824-14.824h-29.777c0 20.548 13.972 37.885 32.911 43.036v33.739h29.777v-33.74c18.94-5.15 32.911-22.487 32.911-43.035 0-24.594-20.008-44.603-44.601-44.603z"
														></path>
														<path
															d="m502.7 432.52c-7.232-60.067-26.092-111.6-57.66-157.56-27.316-39.764-65.182-76.476-115.59-112.06v-46.29l37.89-98.425-21.667-0.017c-6.068-4e-3 -8.259-1.601-13.059-5.101-6.255-4.559-14.821-10.802-30.576-10.814h-0.046c-15.726 0-24.292 6.222-30.546 10.767-4.799 3.487-6.994 5.081-13.041 5.081h-0.027c-6.07-5e-3 -8.261-1.602-13.063-5.101-6.255-4.559-14.821-10.801-30.577-10.814h-0.047c-15.725 0-24.293 6.222-30.548 10.766-4.8 3.487-6.995 5.081-13.044 5.081h-0.027l-21.484-0.017 36.932 98.721v46.117c-51.158 36.047-89.636 72.709-117.47 111.92-33.021 46.517-52.561 98.116-59.74 157.74l-9.304 77.285h512l-9.304-77.284zm-301.06-395.47c4.8-3.487 6.995-5.081 13.045-5.081h0.026c6.07 4e-3 8.261 1.602 13.062 5.101 6.255 4.559 14.821 10.802 30.578 10.814h0.047c15.725 0 24.292-6.222 30.546-10.767 4.799-3.487 6.993-5.081 13.041-5.081h0.026c6.068 5e-3 8.259 1.602 13.059 5.101 2.869 2.09 6.223 4.536 10.535 6.572l-21.349 55.455h-92.526l-20.762-55.5c4.376-2.041 7.773-4.508 10.672-6.614zm98.029 91.89v26.799h-83.375v-26.799h83.375zm-266.09 351.08 5.292-43.947c6.571-54.574 24.383-101.7 54.458-144.07 26.645-37.537 62.54-71.458 112.73-106.5h103.78c101.84 71.198 150.75 146.35 163.29 250.56l5.291 43.948h-444.85z"
														></path>
													</svg> -->

													<svg class="me-4 ht-60 wd-60 my-auto warning"  viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M79 295h137v641H79zM329 563h137v373H329zM579 367h137v569H579zM829 128h137v808H829z"  /></svg>
												</div>
												<div class="project-content">
													<h6>Total Applications </h6>
													<ul>

														<li>
															<strong>Total</strong>
															<span id="previousYearCount">{{@$data['allApplications']}}</span>
														</li>

													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- row -->
							<div class="row row-sm">
								<div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
									<div class="card overflow-hidden">
										<div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
											<div class="d-flex justify-content-between">
												<h4 class="card-title mg-b-10"> Data </h4>
												<i class="mdi mdi-dots-horizontal text-gray"> </i>
											</div>
											<!-- <p class="tx-12 text-muted mb-2">The Project Budget is a tool used by project managers to estimate the total cost of a project. <a href="">Learn more</a></p> -->
										</div>
										<div class="card-body pd-y-7">
											<div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
												<div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
													<div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
												</div>

											</div>
											<!-- <div class="area chart-legend mb-0">
												<div><i class="mdi mdi-album text-primary me-2"> </i> Total List</div>

											</div> -->
											<canvas id="project-budget" class=" chartjs-render-monitor" width="722" height="350" style="display: block; width: 722px; height: 350px;"> </canvas>
										</div>
									</div>
								</div>
								 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4">
									<div class="card overflow-hidden">
										<div class="card-header pb-0">
											<div class="d-flex justify-content-between">
												<h4 class="card-title mg-b-10 mt-2"></h4>
												<i class="mdi mdi-dots-horizontal text-gray"> </i>
											</div>

										</div>
										<div class="card-body">
											<div class="">
												<div class="row justify-content-md-left">
													<div class="col-sm-12">
														<div class="">
															<a   href="{{url('violation-management')}}"><canvas id="chartDonut" class="ht-220 drop-shadow wd-220" width="170" height="135" style="display: block;" >
																<ul class="0-legend">
																	<li><span style="background-color:#3858f9"> </span>Paid</li>
																	<li><span style="background-color:#f09819"> </span>Pending</li>
																	<li><span style="background-color:#3cba92"> </span>Rejected</li>
																</ul>
															</canvas>
														</a>
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
