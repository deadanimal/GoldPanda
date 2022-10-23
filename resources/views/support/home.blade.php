@extends('layouts.app')
 
@section('title', 'Profile')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Support
				</h1>
				<p class="header-subtitle">---</p>
			</div>


			<div class="row">


				<div class="col-xl-4">
					

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Request support</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/support">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Message</label>
											<textarea class="form-control" rows="5" name="message"></textarea>
										</div>																			
										<button type="submit" class="btn btn-primary">Open Support Ticket</button>
									</form>
								</div>
							</div>

					
				</div>				

				<div class="col-xl-8 d-flex">
					<div class="col">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">List of support tickets</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width:10%;">ID</th>
											<th style="width:70%;">Last Message</th>										
											<th class="d-none d-md-table-cell" style="width:20%">Status</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($tickets as $ticket)
											<tr>
												<td><a href="/app/support/{{ $ticket->id }}">S-{{ $ticket->id }}</a></td>
												<td>{{ $ticket->id }}</td>
												<td>{{ $ticket->created_at }}</td>
											</tr>
										@endforeach									
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

@endsection