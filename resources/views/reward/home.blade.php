@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Reward
                </h1>
                <p class="header-subtitle"></p>
                <button type="button" class="btn btn-warning" onclick="copyCode()">Copy Registration URL</button>
            </div>

            <div class="row">


                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Consultant</h4>
                            <p class="card-text">{{ $user->introducer->name }}</p>

                            <h4 class="card-title">Code</h4>
                            <p class="card-text">{{ $user->code }}</p>

                            <h4 class="card-title">Balance</h4>
                            <p class="card-text">RM {{ number_format($user->reward / 100, 2, '.', ',') }}</p>

                        </div>
                        @if ($user->reward >= 2000)
                            <a href="/reward/claim" type="button" class="btn btn-primary">Redeem Reward</a>
                        @endif
                    </div>
                </div>

                <div class="col-xl-9">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of rewards</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-sm reward-datatable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Reward</th>
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
    <script>
        function copyCode() {
            var user = {!! auth()->user() !!};
            var userCode = user['code'];
            var copyText = "https://easygold.com.my/register/" + userCode;
            navigator.clipboard.writeText(copyText).then(() => {
                alert("Consultant URL copied");
            }, () => {
                alert("Consultant URL not copied");
            });
            
        }
    </script>

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
