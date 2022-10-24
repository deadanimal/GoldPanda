<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Modern and advanced gold market">
	<meta name="author" content="Easy Gold">
    <link rel="icon" type="image/png" href="/img/gold-bars.png" />

	<title>Easy Gold - @yield('title')</title>

	<link href="{{ URL::asset('css/modern.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>	

</head>

<body>

	@include('sweetalert::alert')

	<div class="wrapper">

		<nav id="sidebar" class="sidebar">
			<a class="sidebar-brand" href="/">
				Easy Gold
			</a>
			<div class="sidebar-content">


				<ul class="sidebar-nav">


					<li class="sidebar-item">
						<a class="sidebar-link" href="/dashboard">
							<i class="align-middle me-2 fas fa-fw fa-home"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="/pro">
							<i class="align-middle me-2 fas fa-fw fa-university"></i> <span class="align-middle">Trade</span>
						</a>
					</li>				
										

					<li class="sidebar-item">
						<a class="sidebar-link" href="/reward">
							<i class="align-middle me-2 fas fa-fw fa-gift"></i> <span class="align-middle">Reward</span>
						</a>
					</li>	
					
					{{-- <li class="sidebar-item">
						<a class="sidebar-link" href="/blockchain">
							<i class="align-middle me-2 fas fa-fw fa-server"></i> <span class="align-middle">Blockchain</span>
						</a>
					</li>	 --}}
                    
					{{-- <li class="sidebar-item">
						<a class="sidebar-link" href="/physical">
							<i class="align-middle me-2 fas fa-fw fa-industry"></i> <span class="align-middle">Mint</span>
						</a>
					</li>						 --}}
                                 

				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-theme">
				<a class="sidebar-toggle d-flex me-2">
					<i class="hamburger align-self-center"></i>
				</a>


				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item dropdown ms-lg-2">
							<a class="nav-link dropdown-toggle position-relative" href="#" id="userDropdown" data-bs-toggle="dropdown">
								<i class="align-middle fas fa-cog"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">								
                                <a class="dropdown-item" href="/ticket"><i class="align-middle me-1 fas fa-fw fa-life-ring"></i>Support</a>
                                <a class="dropdown-item" href="/profile"><i class="align-middle me-1 fas fa-fw fa-user"></i>Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="/logout"><i class="align-middle me-1 fas fa-fw fa-arrow-alt-circle-right"></i> Sign Out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			@if ($errors->any())

				@foreach ($errors->all() as $error)

					<div class="modal fade show" id="modalText" style="display: block;" aria-modal="true" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Error Message</h5>
									<!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
								</div>
								<div class="modal-body m-3">
									<p class="mb-0">{{ $error }}</p>
								</div>
								<div class="modal-footer">
									<!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
									<button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
								</div>
							</div>
						</div>
					</div>

									
											
				@endforeach

				<div id="modalBackdrop" class="modal-backdrop fade show"></div>

				<script>
					function closeModal() {
  						//document.getElementById("modalText").classList.remove('show');
						//document.getElementById("modalText").classList.add('hide');
						var element = document.getElementById("modalText");
						element.remove();								
						var element = document.getElementById("modalBackdrop");
						element.remove();					
					}
				</script>				
					
					
				
			@endif		
			
			@isset($message)
<div class="alert alert-success">
<strong>{{@message}}</strong>
</div>
@endif			


			@yield('content')


			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-start">
							<ul class="list-inline">

                                @role('super-admin')  
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="/admin/dashboard">As Admin</a>
                                    </li>

                                    <li class="list-inline-item">
                                        <a class="text-muted" href="/dashboard">As User</a>
                                    </li>									
                                @endrole  

								<li class="list-inline-item">
									<a class="text-muted" href="/privacy">Privacy</a>
								</li>

								<li class="list-inline-item">
									<a class="text-muted" href="/terms">Terms</a>
								</li>    
                                
							</ul>
						</div>
						<div class="col-4 text-end">
							<p class="mb-0">
								&copy; 2022 - <a href="/" class="text-muted">Easy Gold</a>
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<svg width="0" height="0" style="position:absolute">
		<defs>
			<symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
				<path
					d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
				</path>
			</symbol>
		</defs>
	</svg>
	<script src="{{ URL::asset('js/app.js') }}"></script>

	@yield('script')


</body>

</html>