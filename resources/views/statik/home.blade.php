@extends('layouts.statik')

@section('title', 'Best Gold Platform')

@section('content')

    <section class="py-6">
        <div class="container">
            <div class="mb-4 text-center">
                <h2>Gold Product</h2>
                <p class="text-muted">
                    Buy, sell, and book 99.99% investment-grade gold starting from RM 20.
                </p>
            </div>

            <div class="row pb-3">
                <div class="col-md-6 col-lg-4 text-center">
                    <a class="mb-3 card overflow-hidden" href="/pro">
                        
                            <img src="/img/photos/prod1.jpeg" class="img-fluid card-img-hover landing-img"
                                 />
                        
                    </a>
                    <h4 class="mb-3">Buy and Sell Gold</h4>
                </div>
                <div class="col-md-6 col-lg-4 text-center">
                    <a class="mb-3 card overflow-hidden" href="/user">
                        
                            <img src="/img/photos/prod2.jpeg" class="img-fluid card-img-hover landing-img"
                                alt="Light Bootstrap 5 Dashboard Theme" />
                        
                    </a>
                    <h4 class="mb-3">Invest in Gold</h4>
                </div>
                <div class="col-md-6 col-lg-4 text-center">
                    <a class="mb-3 card overflow-hidden" href="/reward">
                        
                            <img src="/img/photos/prod3.png" class="img-fluid card-img-hover landing-img"
                                alt="Dark Bootstrap 5 Dashboard Theme" />
                        
                    </a>
                    <h4 class="mb-3">Get Reward From Selling</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="py-6 bg-white">
        <div class="container">

            <div class="mb-4 text-center">
                <h2>Features</h2>
                <p class="text-muted">Here's why some of our happy gold savers and users of Easy Gold keep using Easy Gold.
                </p>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <blockquote class="card border">
                        <div class="card-body p-4">
                            <p class="lead mb-2">
                                Redeem your physical gold starting from 1 gram.                                
                            </p>

                        </div>
                    </blockquote>

                </div>
                <div class="col-md-6 col-lg-4">
                    <blockquote class="card border">
                        <div class="card-body p-4">
                            <p class="lead mb-2">Refer your friends and family and get rewarded with gold.</p>

                        </div>
                    </blockquote>

                </div>
                <div class="col-md-6 col-lg-4 d-block d-md-none d-lg-block">
                    <blockquote class="card border">
                        <div class="card-body p-4">
                            <p class="lead mb-2">Counter inflation and expand your wealth by exploring gold products.
                            </p>

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
                        Join the gold investment revolution now!
                    </h2>
                    <a href="/dashboard" class="align-middle btn btn-success btn-lg mt-n1">
                        Access the dashboard
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
