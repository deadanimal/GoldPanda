@extends('layouts.app')
 
@section('title', 'Profile')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Reward Management
				</h1>
				<p class="header-subtitle">---</p>
			</div>

			<div class="row">

				<div class="col-xl-3">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Enhance Gold</h5>
									<h6 class="card-subtitle text-muted">Book extra gold</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/buy">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" name="gold_amount" value=0.01 step="0.01" min=0.01>											
										</div>
										<div class="mb-3">
											<label class="form-label">Ringgit Malaysia, RM</label>
											<input type="number" class="form-control" name="fiat_amount" readonly>
										</div>
										<button type="submit" class="btn btn-primary">Enhance Gold</button>
									</form>
								</div>
							</div>								
				</div>			

			</div>				

			
		</div>



	</main>

@endsection	

@section('script')

@endsection