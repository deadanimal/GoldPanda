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


				<div class="col-xl-5">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">- - -</h5>
									<h6 class="card-subtitle text-muted">- - - </h6>
								</div>
								<div class="card-body">
									level: {{ $profile->level }}
									promoter_id: {{ $profile->promoter_id }}
									code: {{ $profile->code }}
									balance: {{ $profile->balance }}
									total_out: {{ $profile->total_out }}
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
											<th style="width:25%">Buyer</th>
											<th style="width:25%">Level</th>											
											<th class="d-none d-md-table-cell" style="width:25%">Amount</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($rewards as $reward)
											<tr>
												<td>R-{{ $reward->id }}</td>
												<td>{{ $reward->created_at }}</td>
												<td>{{ $reward->user_id }}</td>
												<td>{{ $reward->level }}</td>
												<td>{{ $reward->level }}</td>
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
											<th style="width:50%;">User</th>
											<th style="width:25%">Code</th>										
											<th class="d-none d-md-table-cell" style="width:15%">Date</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($profiles as $single_profile)
											<tr>
												<td>U-{{ $single_profile->id }}</td>
												<td>{{ $single_profile->user_id }}</td>
												<td>{{ $single_profile->code }}</td>
												<td>{{ $single_profile->created_at }}</td>
		
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