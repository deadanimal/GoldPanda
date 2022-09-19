@extends('layouts.app')
 
@section('title', 'Advance Gold')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Advance
				</h1>
				<p class="header-subtitle">---</p>
			</div>

			<div class="row">


				<div class="col-xl-4">
					

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Advance Gold</h5>
									<h6 class="card-subtitle text-muted">Lease your gold for cash</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/advance">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" name="gold_amount" value=0.1 step="0.1" min=0.1>											
										</div>
										<div class="mb-3">
											<label class="form-label">Ringgit Malaysia, RM</label>
											<input type="number" class="form-control" name="fiat_amount" readonly>
										</div>
										<button type="submit" class="btn btn-primary">Advance Gold</button>
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
									<h5 class="card-title">List of advances</h5>
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

										@foreach ($advances as $advance)
											<tr>
												<td><a href="/app/advance/{{ $advance->id }}">A-{{ $advance->id }}</a></td>
												<td>{{ $advance->created_at }}</td>
												<td>{{ number_format($advance->gold_amount / 1000000, 6, '.', ',') }} gram</td>
												<td>{{ $advance->fiat_currency }} {{ number_format($advance->fiat_leased / 100, 2, '.', ',') }}</td>
												<td class="d-none d-md-table-cell">Created</td>
											</tr>
										@endforeach									
									</tbody>
								</table>
							</div>				
					
				</div>
			</div>				
			
		</div>


	</main>

@endsection	

@section('script')

@endsection