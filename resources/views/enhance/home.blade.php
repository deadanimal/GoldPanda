@extends('layouts.app')
 
@section('title', 'Enhance Gold')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Enhance
				</h1>
				<p class="header-subtitle">---</p>
			</div>

			<div class="row">


				<div class="col-xl-4">
					

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Enhance Gold</h5>
									<h6 class="card-subtitle text-muted">Book extra gold</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/buy">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Ringgit Malaysia, RM</label>
											<input type="number" class="form-control" name="fiat_amount" value=200 min=200 step="100" max="50000">
										</div>
										<div class="mb-3">
											<label class="form-label">Multiplier</label>
											<input type="number" class="form-control" name="multiplier" value=1 min=1 step="1" max="19">
										</div>										
										<div class="mb-3">
											<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" name="gold_amount" value=2.3 readonly>											
										</div>										
										<button type="submit" class="btn btn-primary">Enhance Gold</button>
									</form>
								</div>
							</div>

					
				</div>				

				<div class="col-xl-9 d-flex">
					<div class="w-100">

					</div>
				</div>

			</div>	

			<div class="row">
				<div class="col">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">List of enhances</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width:10%;">ID</th>
											<th style="width:25%;">Date</th>
											<th style="width:25%">Gold</th>
											<th style="width:25%">Amount</th>											
											<th class="d-none d-md-table-cell" style="width:15%">Status</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($enhances as $enhance)
											<tr>
												<td>{{ $enhance }}</td>
												<!-- <td><a href="/app/bought/{{ $bought->id }}">B-{{ $bought->id }}</a></td>
												<td>{{ $bought->created_at }}</td>
												<td>{{ number_format($bought->gold_amount / 1000000, 6, '.', ',') }} gram</td>
												<td>{{ $bought->fiat_currency }} {{ number_format($bought->fiat_inflow / 100, 2, '.', ',') }}</td>
												<td class="d-none d-md-table-cell">Created</td> -->
		
											</tr>
										@endforeach									
									</tbody>
								</table>
							</div>				
					
				</div>
			</div>			
			
		</div>

		<!-- 1	id	bigint unsigned	NULL	NULL	NO	NULL	auto_increment		
2	amount	int	NULL	NULL	NO	NULL			
3	leverage	int	NULL	NULL	NO	NULL			
4	capital	int	NULL	NULL	NO	NULL			
5	loan	int	NULL	NULL	NO	NULL			
6	currency	char(3)	utf8mb4	utf8mb4_unicode_ci	NO	NULL			
7	status	char(3)	utf8mb4	utf8mb4_unicode_ci	NO	NULL			
8	interest	int	NULL	NULL	NO	0			
9	interest_calculated_at	timestamp	NULL	NULL	NO	CURRENT_TIMESTAMP	DEFAULT_GENERATED		
10	user_id	bigint unsigned	NULL	NULL	NO	NULL		users(id)	
11	created_at	timestamp	NULL	NULL	YES	NULL			
12	updated_at	timestamp	NULL	NULL	YES	NULL					 -->

		<!-- <div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Welcome back, Linda!
				</h1>
				<p class="header-subtitle">You have 24 new messages and 5 new notifications.</p>
			</div>

			<div class="row">
				<div class="col-xl-6 col-xxl-7">
					<div class="card flex-fill w-100">
						<div class="card-header">
							<div class="card-actions float-end">
								<a href="#" class="me-1">
									<i class="align-middle" data-feather="refresh-cw"></i>
								</a>
								<div class="d-inline-block dropdown show">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
										<i class="align-middle" data-feather="more-vertical"></i>
									</a>

									<div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="#">Action</a>
										<a class="dropdown-item" href="#">Another action</a>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
							<h5 class="card-title mb-0">Recent Movement</h5>
						</div>
						<div class="card-body py-3">
							<div class="chart chart-sm">
								<canvas id="chartjs-dashboard-line"></canvas>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-6 col-xxl-5 d-flex">
					<div class="w-100">
						<div class="row">
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Sales Today</h5>
											</div>

											<div class="col-auto">
												<div class="avatar">
													<div class="avatar-title rounded-circle bg-primary-dark">
														<i class="align-middle" data-feather="truck"></i>
													</div>
												</div>
											</div>
										</div>
										<h1 class="display-5 mt-1 mb-3">2.562</h1>
										<div class="mb-0">
											<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span>
											Less sales than usual
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Visitors Today</h5>
											</div>

											<div class="col-auto">
												<div class="avatar">
													<div class="avatar-title rounded-circle bg-primary-dark">
														<i class="align-middle" data-feather="users"></i>
													</div>
												</div>
											</div>
										</div>
										<h1 class="display-5 mt-1 mb-3">17.212</h1>
										<div class="mb-0">
											<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.50% </span>
											More visitors than usual
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Total Earnings</h5>
											</div>

											<div class="col-auto">
												<div class="avatar">
													<div class="avatar-title rounded-circle bg-primary-dark">
														<i class="align-middle" data-feather="dollar-sign"></i>
													</div>
												</div>
											</div>
										</div>
										<h1 class="display-5 mt-1 mb-3">$24.300</h1>
										<div class="mb-0">
											<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
											More earnings than usual
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Pending Orders</h5>
											</div>

											<div class="col-auto">
												<div class="avatar">
													<div class="avatar-title rounded-circle bg-primary-dark">
														<i class="align-middle" data-feather="shopping-cart"></i>
													</div>
												</div>
											</div>
										</div>
										<h1 class="display-5 mt-1 mb-3">43</h1>
										<div class="mb-0">
											<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
											Less orders than usual
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
					<div class="card flex-fill">
						<div class="card-header">
							<div class="card-actions float-end">
								<a href="#" class="me-1">
									<i class="align-middle" data-feather="refresh-cw"></i>
								</a>
								<div class="d-inline-block dropdown show">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
										<i class="align-middle" data-feather="more-vertical"></i>
									</a>

									<div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="#">Action</a>
										<a class="dropdown-item" href="#">Another action</a>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
							<h5 class="card-title mb-0">Calendar</h5>
						</div>
						<div class="card-body d-flex">
							<div class="align-self-center w-100">
								<div class="chart">
									<div id="datetimepicker-dashboard"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
					<div class="card flex-fill w-100">
						<div class="card-header">
							<div class="card-actions float-end">
								<a href="#" class="me-1">
									<i class="align-middle" data-feather="refresh-cw"></i>
								</a>
								<div class="d-inline-block dropdown show">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
										<i class="align-middle" data-feather="more-vertical"></i>
									</a>

									<div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="#">Action</a>
										<a class="dropdown-item" href="#">Another action</a>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
							<h5 class="card-title mb-0">Current Visitors</h5>
						</div>
						<div class="card-body px-4">
							<div id="world_map" style="height:350px;"></div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
					<div class="card flex-fill w-100">
						<div class="card-header">
							<div class="card-actions float-end">
								<a href="#" class="me-1">
									<i class="align-middle" data-feather="refresh-cw"></i>
								</a>
								<div class="d-inline-block dropdown show">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
										<i class="align-middle" data-feather="more-vertical"></i>
									</a>

									<div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="#">Action</a>
										<a class="dropdown-item" href="#">Another action</a>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
							<h5 class="card-title mb-0">Browser Usage</h5>
						</div>
						<div class="card-body d-flex">
							<div class="align-self-center w-100">
								<div class="py-3">
									<div class="chart chart-xs">
										<canvas id="chartjs-dashboard-pie"></canvas>
									</div>
								</div>

								<table class="table mb-0">
									<tbody>
										<tr>
											<td><i class="fas fa-circle text-primary fa-fw"></i> Chrome</td>
											<td class="text-end">4401</td>
										</tr>
										<tr>
											<td><i class="fas fa-circle text-warning fa-fw"></i> Firefox</td>
											<td class="text-end">4003</td>
										</tr>
										<tr>
											<td><i class="fas fa-circle text-danger fa-fw"></i> IE</td>
											<td class="text-end">1589</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-lg-8 col-xxl-9 d-flex">
					<div class="card flex-fill">
						<div class="card-header">
							<div class="card-actions float-end">
								<a href="#" class="me-1">
									<i class="align-middle" data-feather="refresh-cw"></i>
								</a>
								<div class="d-inline-block dropdown show">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
										<i class="align-middle" data-feather="more-vertical"></i>
									</a>

									<div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="#">Action</a>
										<a class="dropdown-item" href="#">Another action</a>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
							<h5 class="card-title mb-0">Latest Projects</h5>
						</div>
						<table id="datatables-dashboard-projects" class="table table-striped my-0">
							<thead>
								<tr>
									<th>Name</th>
									<th class="d-none d-xl-table-cell">Start Date</th>
									<th class="d-none d-xl-table-cell">End Date</th>
									<th>Status</th>
									<th class="d-none d-md-table-cell">Assignee</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Project Apollo</td>
									<td class="d-none d-xl-table-cell">01/01/2021</td>
									<td class="d-none d-xl-table-cell">31/06/2021</td>
									<td><span class="badge bg-success">Done</span></td>
									<td class="d-none d-md-table-cell">Carl Jenkins</td>
								</tr>
								<tr>
									<td>Project Fireball</td>
									<td class="d-none d-xl-table-cell">01/01/2021</td>
									<td class="d-none d-xl-table-cell">31/06/2021</td>
									<td><span class="badge bg-danger">Cancelled</span></td>
									<td class="d-none d-md-table-cell">Bertha Martin</td>
								</tr>
								<tr>
									<td>Project Hades</td>
									<td class="d-none d-xl-table-cell">01/01/2021</td>
									<td class="d-none d-xl-table-cell">31/06/2021</td>
									<td><span class="badge bg-success">Done</span></td>
									<td class="d-none d-md-table-cell">Stacie Hall</td>
								</tr>
								<tr>
									<td>Project Nitro</td>
									<td class="d-none d-xl-table-cell">01/01/2021</td>
									<td class="d-none d-xl-table-cell">31/06/2021</td>
									<td><span class="badge bg-warning">In progress</span></td>
									<td class="d-none d-md-table-cell">Carl Jenkins</td>
								</tr>
								<tr>
									<td>Project Phoenix</td>
									<td class="d-none d-xl-table-cell">01/01/2021</td>
									<td class="d-none d-xl-table-cell">31/06/2021</td>
									<td><span class="badge bg-success">Done</span></td>
									<td class="d-none d-md-table-cell">Bertha Martin</td>
								</tr>
								<tr>
									<td>Project X</td>
									<td class="d-none d-xl-table-cell">01/01/2021</td>
									<td class="d-none d-xl-table-cell">31/06/2021</td>
									<td><span class="badge bg-success">Done</span></td>
									<td class="d-none d-md-table-cell">Stacie Hall</td>
								</tr>
								<tr>
									<td>Project Romeo</td>
									<td class="d-none d-xl-table-cell">01/01/2021</td>
									<td class="d-none d-xl-table-cell">31/06/2021</td>
									<td><span class="badge bg-success">Done</span></td>
									<td class="d-none d-md-table-cell">Ashley Briggs</td>
								</tr>
								<tr>
									<td>Project Wombat</td>
									<td class="d-none d-xl-table-cell">01/01/2021</td>
									<td class="d-none d-xl-table-cell">31/06/2021</td>
									<td><span class="badge bg-warning">In progress</span></td>
									<td class="d-none d-md-table-cell">Bertha Martin</td>
								</tr>
								<tr>
									<td>Project Zircon</td>
									<td class="d-none d-xl-table-cell">01/01/2021</td>
									<td class="d-none d-xl-table-cell">31/06/2021</td>
									<td><span class="badge bg-danger">Cancelled</span></td>
									<td class="d-none d-md-table-cell">Stacie Hall</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-12 col-lg-4 col-xxl-3 d-flex">
					<div class="card flex-fill w-100">
						<div class="card-header">
							<div class="card-actions float-end">
								<a href="#" class="me-1">
									<i class="align-middle" data-feather="refresh-cw"></i>
								</a>
								<div class="d-inline-block dropdown show">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
										<i class="align-middle" data-feather="more-vertical"></i>
									</a>

									<div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="#">Action</a>
										<a class="dropdown-item" href="#">Another action</a>
										<a class="dropdown-item" href="#">Something else here</a>
									</div>
								</div>
							</div>
							<h5 class="card-title mb-0">Monthly Sales</h5>
						</div>
						<div class="card-body d-flex w-100">
							<div class="align-self-center chart chart-lg">
								<canvas id="chartjs-dashboard-bar"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div> -->

	</main>

@endsection	

@section('script')

@endsection