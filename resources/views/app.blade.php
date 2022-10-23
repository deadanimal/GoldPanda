@extends('layouts.app')
 
@section('title', 'Best Gold Platform')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					RM {{ number_format($myr_price->price * $gold_price->price  / 100 / 100, 2, '.', ',')  }}
				</h1>
				<p class="header-subtitle">Price of gold as of {{$gold_price->created_at}}</p>
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
											{{ number_format(($user->balance + $user->booked + $user->advanced) / 1000000, 2, '.', ',') }}
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

            <div class="row">


                <div class="col-xl-3">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Trade Gold</h5>
                            <h6 class="card-subtitle text-muted">Buy or sell spot gold</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/trade">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Gold Trade</label>
									<select class="form-control mb-3" name="nature">
										<option value=1 selected>Buy Gold</option>
										<option value=0>Sell Gold</option>
									</select>									
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ringgit Malaysia, RM</label>
                                    <input type="number" class="form-control" name="fiat">
                                </div>								
                                <button type="submit" class="btn btn-primary">Trade Gold</button>
                            </form>
                        </div>
                    </div>


                </div>

                <div class="col-xl-9">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of gold trades</h5>
                            {{-- <h6 class="card-subtitle text-muted">- - -</h6> --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-sm trade-datatable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Gold</th>
                                        <th>Amount</th>
                                        <th>Status</th>
										<th></th>
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

	</main>

@endsection	

@section('script')


<script type="text/javascript">
	$(function() {

		var table = $('.trade-datatable').DataTable({
			processing: true,
			serverSide: true,
			responsive: true,
			ajax: "/trade",
			columns: [
				{
					data: {
						_: "created_at.display",
						sort: "created_at.timestamp",
						filter: 'created_at.display'
					},
					name: 'created_at.display'
				},
				{
					data: 'gold_',
					name: 'gold_'
				},
				{
					data: 'fiat_',
					name: 'fiat_'
				},
				{
					data: 'status_',
					name: 'status_'
				},
				{
					data: 'link',
					name: 'link'
				},				

			]
		});


	});
</script>	



@endsection