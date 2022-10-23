@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Reward
                </h1>
                {{-- <p class="header-subtitle">---</p> --}}
            </div>

            <div class="row">


                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Level</h5>
                            <p class="card-text">{{ $user->level }}</p>

                            <h5 class="card-title">Promoter</h5>
                            <p class="card-text">{{ $user->introducer->name }}</p>

                            <h5 class="card-title">Code</h5>
                            <p class="card-text">{{ $user->code }}</p>

                            <h5 class="card-title">Balance</h5>
                            <p class="card-text">RM {{ number_format($user->reward / 100, 2, '.', ',') }}</p>

                        </div>
                    </div>
                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of rewards</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-sm reward-datatable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Buyer</th>
                                        <th>Level</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
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
    <script type="text/javascript">
        $(function() {

            var table = $('.reward-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/reward",
                columns: [{
                        data: {
                            _: "created_at.display",
                            sort: "created_at.timestamp",
                            filter: 'created_at.display'
                        },
                        name: 'created_at.display'
                    },
                    {
                        data: 'buyer_',
                        name: 'buyer_'
                    },
                    {
                        data: 'level',
                        name: 'level'
                    },
                    {
                        data: 'amount_',
                        name: 'amount_'
                    },
                ]
            });


        });
    </script>
@endsection
