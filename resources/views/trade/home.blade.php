@extends('layouts.app')
 
@section('title', 'Trade Gold')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Trade
				</h1>
				<p class="header-subtitle">---</p>
			</div>

			<div class="row">
				<div class="col-xl-4">
					

							<div class="card">
								<!-- <div class="card-header">
									<h5 class="card-title">Basic form</h5>
									<h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
								</div> -->
								<div class="card-body">
									<form method="POST" action="/app/trade">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Trade</label>
											<select name="flow" class="form-control mb-3">
												<option value="buy" selected>Buy</option>
												<option>Sell</option>
											</select>
										</div>
										<div class="mb-3">
											<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" name="gold_amount" value=0.01 step="0.01" min=0.01>
										</div>
										<div class="mb-3">
										<label class="form-label">Ringgit Malaysia, RM</label>
											<input type="number" class="form-control" name="fiat_amount" readonly>
										</div>
										<button type="submit" class="btn btn-primary">Submit</button>
									</form>
								</div>
							</div>

					
				</div>

				

				<div class="col-xl-5 d-flex">
					<div class="w-100">
						<div class="row">
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Price per gram</h5>
											</div>

										</div>
										<h1 class="display-5 mt-1 mb-3">RM 242.64</h1>
										<div class="mb-0">
											<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span>
											24H change
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold balance, gram</h5>
											</div>

										</div>
										<h1 class="display-5 mt-1 mb-3">0.123</h1>
										<div class="mb-0">
											<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>+0.001g </span>
											24H change
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold Leased, g</h5>
											</div>


										</div>
										<h1 class="display-5 mt-1 mb-3">123.456</h1>
										<div class="mb-0">
											<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
											More 
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold Leased, g</h5>
											</div>

										</div>
										<h1 class="display-5 mt-1 mb-3">43.123</h1>
										<div class="mb-0">
											<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
											Less 
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