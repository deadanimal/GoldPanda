@extends('layouts.app')

@section('title', 'Admin - Invoice')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Invoice
                </h1>
            </div>

            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            {{$invoice}}
                        </div>
                    </div>
                </div>



            </div>



        </div>



    </main>

@endsection

@section('script')

@endsection
