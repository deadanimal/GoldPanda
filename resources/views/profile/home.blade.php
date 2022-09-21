@extends('layouts.app')
 
@section('title', 'Profile')
 
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


			<div class="col-xl-12">
				

						<div class="card">
							<div class="card-header">
								<h5 class="card-title">- - -</h5>
								<h6 class="card-subtitle text-muted">- - -</h6>
							</div>
							<div class="card-body">
								{{ $user }}

								<br>
								<h1>Advances</h1>
								{{ $user->advances }}
							</div>				
						</div>

			</div>					
		</div>	

	</div>	




	</main>

@endsection	

@section('script')

@endsection