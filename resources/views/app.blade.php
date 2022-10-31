@extends('layouts.app')
 
@section('title', 'Best Gold Platform')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Easy Gold 
				</h1>
				<p class="text-white">Advanced and Modern Gold Platform</p>
			</div>

			<div class="row">


				<div class="col">
					<div class="w-100">
						<div class="row">
							<div class="col-sm-3">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold Portfolio</h5>
											</div>

											<!-- <div class="col-auto">
												<div class="avatar">
													<div class="avatar-title rounded-circle bg-primary-dark">
														<i class="align-middle" data-feather="truck"></i>
													</div>
												</div>
											</div> -->
										</div>
										<h1 class="display-5 mt-1 mb-3">
											{{ number_format(($user->balance + $user->booked + $user->advanced) / 1000000, 2, '.', ',') }}g
										</h1>
										<div class="mb-0">
											<span class="text-dark">RM {{ number_format((($user->balance + $user->booked + $user->advanced)/ 10000000000) * ($myr_price->price * $gold_price->price), 2, '.', ',') }}</span>											
											
										</div>
									</div>
								</div>
	
							</div>
							<div class="col-sm-3">

								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold Savings</h5>
											</div>

											
										</div>
										<h1 class="display-5 mt-1 mb-3">
											{{ number_format($user->balance / 1000000, 2, '.', ',') }}g										
										</h1>
										<div class="mb-0">
											<span class="text-dark">RM {{ number_format(($user->balance/ 10000000000) * ($myr_price->price * $gold_price->price), 2, '.', ',') }}</span>											
										</div>
									</div>
								</div>
							</div>							
							<div class="col-sm-3">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold Booked</h5>
											</div>

											<!-- <div class="col-auto">
												<div class="avatar">
													<div class="avatar-title rounded-circle bg-primary-dark">
														<i class="align-middle" data-feather="dollar-sign"></i>
													</div>
												</div>
											</div> -->
										</div>
										<h1 class="display-5 mt-1 mb-3">
											{{ number_format($user->booked / 1000000, 2, '.', ',') }}g																						
										</h1>
										<div class="mb-0">
											<span class="text-dark">RM {{ number_format(($user->booked/ 10000000000) * ($myr_price->price * $gold_price->price), 2, '.', ',') }}</span>											
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">

								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold Leased</h5>
											</div>

										</div>
										<h1 class="display-5 mt-1 mb-3">
											{{ number_format($user->advanced / 1000000, 2, '.', ',') }}g																																	
										</h1>
										<div class="mb-0">
											<span class="text-dark">RM {{ number_format(($user->advanced/ 10000000000) * ($myr_price->price * $gold_price->price), 2, '.', ',') }}</span>											
										</div> 
									</div>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>		


        </div>

	</main>

@endsection	

@section('script')





@endsection