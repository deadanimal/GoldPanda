@extends('layouts.app')
 
@section('title', 'Blockchain Gold')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Blockchain
				</h1>
				<p class="header-subtitle">---</p>
			</div>

			<div class="row">


				<div class="col-xl-4">
					

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Mint Gold</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/blockchain/mint">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" name="amount" value=0.1 step="0.1" min=0.1>											
										</div>
										<button type="submit" class="btn btn-primary">Mint Gold</button>
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
									<h5 class="card-title">List of mints</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width:15%;">ID</th>
											<th style="width:35%;">Date</th>
											<th style="width:35%">Gold</th>										
											<th class="d-none d-md-table-cell" style="width:15%">Status</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($mints as $mint)
											<tr>
												<td><a href="/app/blockchain/mint/{{ $mint->id }}">BCM-{{ $mint->id }}</a></td>
												<td>{{ $mint->created_at }}</td>
												<td>{{ number_format($mint->amount / 1000000, 6, '.', ',') }} gram</td>
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