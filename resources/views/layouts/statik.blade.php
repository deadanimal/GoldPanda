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

</head>

<body>
    <div class="splash active">
        <div class="splash-icon"></div>
    </div>

    <nav class="navbar navbar-expand navbar-dark absolute-top w-100 py-2">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                Easy Gold
            </a>
            <a class="btn btn-warning btn-pill my-2 ms-2" href="/dashboard">
                Dashboard
            </a>
        </div>
    </nav>

    <section class="pt-7 pb-5 landing-bg text-white overflow-hidden">
        <div class="container py-4">
            <div class="row">
                <div class="col-xl-11 mx-auto">
                    <div class="row">
                        <div class="col-md-12 col-xl-8 text-center mx-auto">
                            <div class="d-block my-4">
                                <h1 class="display-4 fw-bold mb-3 text-white">Modern Gold Platform</h1>
                                <p class="lead fw-light mb-3 landing-text">A professional package that comes with
                                    hunderds of
                                    UI components, forms, tables,
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
            <a href="" class="btn btn-lg btn-pill btn-link text-dark">Trade Gold</a>
            <a href="/product-advance" class="btn btn-lg btn-pill btn-link text-dark">Advance Gold</a>
            <a href="/product-enhance" class="btn btn-lg btn-pill btn-link text-dark">Enhance Gold</a>
            <a href="/faq" class="btn btn-lg btn-pill btn-link text-dark">F.A.Q.</a>
        </div>
    </div>


    @yield('content')


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

</body>

</html>
