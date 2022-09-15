@extends('layouts.statik')
 
@section('title', 'Best Gold Platform')
 
@section('content')

	<section class="pt-7 pb-5 landing-bg text-white overflow-hidden">
		<div class="container py-4">
			<div class="row">
				<div class="col-xl-11 mx-auto">
					<div class="row">
						<div class="col-md-12 col-xl-8 text-center mx-auto">
							<div class="d-block my-4">
								<h1 class="display-4 fw-bold mb-3 text-white">Modern Gold Platform</h1>
								<p class="lead fw-light mb-3 landing-text">A professional package that comes with hunderds of UI components, forms, tables,
									charts, dashboards, pages and svg icons.
									Each one is fully customizable, responsive and easy to use.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="py-3 bg-white landing-nav">
		<div class="container text-center">
			<a href="" class="btn btn-lg btn-pill btn-primary">Product</a>
			<a href="/faq" class="btn btn-lg btn-pill btn-link text-dark">F.A.Q.</a>
			<a href="" class="btn btn-lg btn-pill btn-link text-dark">Changelog</a>
			<a href="/support" class="btn btn-lg btn-pill btn-link text-dark">Support</a>
		</div>
	</div>

	<section class="py-6">
		<div class="container">
			<div class="mb-4 text-center">
				<h2>Multiple demos</h2>
				<p class="text-muted">Multiple color schemes & dashboard layouts available to make this template your very own.</p>
			</div>

			<div class="row pb-3">
				<div class="col-md-6 col-lg-4 text-center">
					<a class="mb-3 card overflow-hidden" href="dashboard-default.html?theme=modern" target="_blank">
						<div class="px-4 pt-4">
							<img src="img/screenshots/modern.png" class="img-fluid card-img-hover landing-img" alt="Modern Bootstrap 5 Dashboard Theme" />
						</div>
					</a>
					<h4 class="mb-3">Modern Theme</h4>
				</div>
				<div class="col-md-6 col-lg-4 text-center">
					<a class="mb-3 card overflow-hidden" href="dashboard-default.html?theme=light" target="_blank">
						<div class="px-4 pt-4">
							<img src="img/screenshots/light.png" class="img-fluid card-img-hover landing-img" alt="Light Bootstrap 5 Dashboard Theme" />
						</div>
					</a>
					<h4 class="mb-3">Light Theme</h4>
				</div>
				<div class="col-md-6 col-lg-4 text-center">
					<a class="mb-3 card overflow-hidden" href="dashboard-default.html?theme=dark" target="_blank">
						<div class="px-4 pt-4">
							<img src="img/screenshots/dark.png" class="img-fluid card-img-hover landing-img" alt="Dark Bootstrap 5 Dashboard Theme" />
						</div>
					</a>
					<h4 class="mb-3">Dark Theme</h4>
				</div>
				<div class="col-md-6 col-lg-4 text-center">
					<a class="mb-3 card overflow-hidden" href="dashboard-default.html" target="_blank">
						<div class="px-4 pt-4">
							<img src="img/screenshots/dashboard-default.png" class="img-fluid card-img-hover landing-img"
								alt="Default Bootstrap 5 Dashboard Theme" />
						</div>
					</a>
					<h4 class="mb-3">Default Dashboard</h4>
				</div>
				<div class="col-md-6 col-lg-4 text-center">
					<a class="mb-3 card overflow-hidden" href="dashboard-analytics.html" target="_blank">
						<div class="px-4 pt-4">
							<img src="img/screenshots/dashboard-analytics.png" class="img-fluid card-img-hover landing-img"
								alt="Analytics Bootstrap 5 Dashboard Theme" />
						</div>
					</a>
					<h4 class="mb-3">Analytics Dashboard</h4>
				</div>
				<div class="col-md-6 col-lg-4 text-center">
					<a class="mb-3 card overflow-hidden" href="dashboard-e-commerce.html" target="_blank">
						<div class="px-4 pt-4">
							<img src="img/screenshots/dashboard-e-commerce.png" class="img-fluid card-img-hover landing-img"
								alt="E-Commerce Bootstrap 5 Dashboard Theme" />
						</div>
					</a>
					<h4 class="mb-3">E-commerce Dashboard</h4>
				</div>
			</div>
		</div>
	</section>

	<section class="py-6 bg-white">
		<div class="container">

			<div class="mb-4 text-center">
				<h2>Testimonials</h2>
				<p class="text-muted">Here's what some of our 3,000 customers have to say about working with our products.</p>
			</div>

			<div class="row">
				<div class="col-md-6 col-lg-4">
					<blockquote class="card border">
						<div class="card-body p-4">
							<div class="d-flex align-items-center mb-3">
								<div>
									<img src="img/brands/b.svg" width="48" height="48" alt="Bootstrap" />
								</div>
								<div class="ps-3">
									<h5 class="mb-1 mt-2">Nikita</h5><small class="d-block text-muted h5 fw-normal">Bootstrap Themes</small>
								</div>
							</div>
							<p class="lead mb-2">“We are totally amazed with a simplicity and the design of the template. Probably saved us hundreds of hours of
								development. We are absolutely amazed with the support Bootlab has provided us.”</p>

							<div class="landing-stars">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
							</div>
						</div>
					</blockquote>
					<blockquote class="card border">
						<div class="card-body p-4">
							<div class="d-flex align-items-center mb-3">
								<div>
									<img src="img/brands/b.svg" width="48" height="48" alt="Bootstrap" />
								</div>
								<div class="ps-3">
									<h5 class="mb-1 mt-2">Jason</h5><small class="d-block text-muted h5 fw-normal">Bootstrap Themes</small>
								</div>
							</div>
							<p class="lead mb-2">“As a DB guy, this template has made my life easy porting over an old website to a new responsive version. I
								can focus more on the data and less on the layout.”</p>

							<div class="landing-stars">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
							</div>
						</div>
					</blockquote>
				</div>
				<div class="col-md-6 col-lg-4">
					<blockquote class="card border">
						<div class="card-body p-4">
							<div class="d-flex align-items-center mb-3">
								<div>
									<img src="img/brands/b.svg" width="48" height="48" alt="Bootstrap" />
								</div>
								<div class="ps-3">
									<h5 class="mb-1 mt-2">Alejandro</h5><small class="d-block text-muted h5 fw-normal">Bootstrap Themes</small>
								</div>
							</div>
							<p class="lead mb-2">“Everything is so properly set up that any new additions I'd make would feel like a native extension of the
								theme versus a simple hack. I definitely feel like this will save me hundredths of hours I'd otherwise spend on designing.”</p>

							<div class="landing-stars">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
							</div>
						</div>
					</blockquote>
					<blockquote class="card border">
						<div class="card-body p-4">
							<div class="d-flex align-items-center mb-3">
								<div>
									<img src="img/brands/b.svg" width="48" height="48" alt="Bootstrap" />
								</div>
								<div class="ps-3">
									<h5 class="mb-1 mt-2">Richard</h5><small class="d-block text-muted h5 fw-normal">Bootstrap Themes</small>
								</div>
							</div>
							<p class="lead mb-2">“This template was just what we were after; its modern, works perfectly and is visually beautiful , we couldn't
								be happier. The support really is excellent, I look forward to working with these guys for a long time to come!”</p>

							<div class="landing-stars">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
							</div>
						</div>
					</blockquote>
				</div>
				<div class="col-md-6 col-lg-4 d-block d-md-none d-lg-block">
					<blockquote class="card border">
						<div class="card-body p-4">
							<div class="d-flex align-items-center mb-3">
								<div>
									<img src="img/brands/b.svg" width="48" height="48" alt="Bootstrap" />
								</div>
								<div class="ps-3">
									<h5 class="mb-1 mt-2">Jordi</h5><small class="d-block text-muted h5 fw-normal">Bootstrap Themes</small>
								</div>
							</div>
							<p class="lead mb-2">“I ran into a problem and contacted support. Within 24 hours, I not only received a response but even an
								updated version that solved my problem and works like a charm. Fantastic customer service!”</p>

							<div class="landing-stars">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
							</div>
						</div>
					</blockquote>
					<blockquote class="card border">
						<div class="card-body p-4">
							<div class="d-flex align-items-center mb-3">
								<div>
									<img src="img/brands/b.svg" width="48" height="48" alt="Bootstrap" />
								</div>
								<div class="ps-3">
									<h5 class="mb-1 mt-2">Martin</h5><small class="d-block text-muted h5 fw-normal">Bootstrap Themes</small>
								</div>
							</div>
							<p class="lead mb-2">“I just began to test and use this theme and I can find that it cover my expectatives. Good support from the
								developer.”</p>

							<div class="landing-stars">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
							</div>
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</section>

	<section class="py-5">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-6 mx-auto">
					<h2 class="mb-3">
						Join over 5,000+ developers who are already working with our products
					</h2>
					<a href="https://themes.getbootstrap.com/product/spark-responsive-admin-template/" target="_blank"
						class="align-middle btn btn-success btn-lg mt-n1">
						Purchase Now
					</a>
				</div>
			</div>
		</div>
	</section>

@endsection	