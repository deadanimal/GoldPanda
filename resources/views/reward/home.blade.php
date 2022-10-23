@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Reward
                </h1>
                <p class="header-subtitle">---</p>
            </div>

            <div class="row">


                <div class="col-xl-4">
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

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of rewards</h5>
                            <h6 class="card-subtitle text-muted">- - -</h6>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width:10%;">ID</th>
                                    <th style="width:20%;">Date</th>
                                    <th style="width:45%">Buyer</th>
                                    <th style="width:5%">Level</th>
                                    <th class="d-none d-md-table-cell" style="width:20%">Amount</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($rewards as $reward)
                                    <tr>
                                        <td>R-{{ $reward->id }}</td>
                                        <td>{{ $reward->created_at }}</td>
                                        <td><a href="/app/user/{{ $reward->buyer->id }}">{{ $reward->buyer->name }}</a></td>
                                        <td>{{ $reward->level }}</td>
                                        <td>{{ $reward->currency }}
                                            {{ number_format($reward->amount / 100, 2, '.', ',') }}</td>
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
