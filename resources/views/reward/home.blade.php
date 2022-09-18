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

				<div class="col-xl-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Add new user</h5>
									<h6 class="card-subtitle text-muted">Promote Gold to new users</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/reward/register">
    									@csrf
										<input name="promoter_id" type="hidden" value="{{ auth()->user()->id }}">

										<div class="mb-3">
											<label class="form-label">Name</label>
											<input type="text" class="form-control" name="name">											
										</div>

										<div class="mb-3">
											<label class="form-label">Email</label>
											<input type="email" class="form-control" name="email">											
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input type="password" class="form-control" name="password">											
										</div>
										<div class="mb-3">
											<label class="form-label">Confirm Password</label>
											<input type="password" class="form-control" name="password_confirmation">											
										</div>										
										<button type="submit" class="btn btn-primary">Add New User</button>
									</form>
								</div>
							</div>								
				</div>			

				<div class="col-xl-8">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">- - -</h5>
									<h6 class="card-subtitle text-muted">- - - </h6>
								</div>
								<div class="card-body">
									{{ $profile }}
								</div>
							</div>								
				</div>					

			</div>	

			<div class="row">
				<div class="col">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">List of rewards</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width:10%;">ID</th>
											<th style="width:25%;">Date</th>
											<th style="width:25%">Gold</th>
											<th style="width:25%">Price</th>											
											<th class="d-none d-md-table-cell" style="width:15%">Status</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($rewards as $reward)
											<tr>
												<td>{{ $reward }}</td>
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
			
			<div class="row">
				<div class="col">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">List of profiles</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width:10%;">ID</th>
											<th style="width:25%;">Date</th>
											<th style="width:25%">Gold</th>
											<th style="width:25%">Price</th>											
											<th class="d-none d-md-table-cell" style="width:15%">Status</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($profiles as $single_profile)
											<tr>
												<td>{{ $single_profile }}</td>
		
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