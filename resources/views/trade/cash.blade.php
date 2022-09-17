@extends('layouts.app')
 
@section('title', 'Admin - Cash Management')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Cash Management
				</h1>
				<p class="header-subtitle">---</p>
			</div>

			<div class="row">


				<div class="col-xl-4">
					

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Buy Gold</h5>
									<h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/buy">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Ringgit Malaysia, RM</label>
											<input type="number" class="form-control" name="fiat_amount" value=20.00 step="0.01" min=20.00>
										</div>
										<div class="mb-3">
										<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" name="gold_amount" readonly>
										</div>
										<button type="submit" class="btn btn-success">Buy</button>
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