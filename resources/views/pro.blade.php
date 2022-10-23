@extends('layouts.app')

@section('title', 'Professional Trading Tool')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Professional Gold Trading Tool
                </h1>
                {{-- <p class="header-subtitle">---</p> --}}
            </div>

            <div class="row">


                <div class="col-xl-4">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Advance Gold</h5>
                            <h6 class="card-subtitle text-muted">Lease your gold for cash</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/advance">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Gold Amount, gram</label>
                                    <input type="number" class="form-control" name="gold_amount" value=1 step="0.1"
                                        min=1>
                                </div>
                                <button type="submit" class="btn btn-primary">Advance Gold</button>
                            </form>
                        </div>
                    </div>


                </div>

                <div class="col-xl-8">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of Advances</h5>
                            {{-- <h6 class="card-subtitle text-muted">- - -</h6> --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-sm advance-datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>Gold</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

            <div class="row">


                <div class="col-xl-4">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Enhance Gold</h5>
                            <h6 class="card-subtitle text-muted">Book extra gold</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/enhance">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Ringgit Malaysia, RM</label>
                                    <input type="number" class="form-control" name="fiat" value=200 min=200 step="100" max="50000">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Multiplier</label>
                                    <input type="number" class="form-control" name="leverage" value=1 min=1 step="1"
                                        max="19">
                                </div>
                                <button type="submit" class="btn btn-primary">Enhance Gold</button>
                            </form>
                        </div>
                    </div>


                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of Enhances</h5>
                            {{-- <h6 class="card-subtitle text-muted">- - -</h6> --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-sm enhance-datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>Gold</th>
                                        <th>Amount</th>
                                        <th>Status</th>
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

            var table = $('.advance-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/advance",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: {
                            _: "created_at.display",
                            sort: "created_at.timestamp",
                            filter: 'created_at.display'
                        },
                        name: 'created_at.display'
                    },
                    {
                        data: 'gold_amount',
                        name: 'gold_amount'
                    },
                    {
                        data: 'fiat_leased',
                        name: 'fiat_leased'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                ]
            });


        });
    </script>

    <script type="text/javascript">
        $(function() {

            var table = $('.enhance-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/enhance",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: {
                            _: "created_at.display",
                            sort: "created_at.timestamp",
                            filter: 'created_at.display'
                        },
                        name: 'created_at.display'
                    },
                    {
                        data: 'gold_amount',
                        name: 'gold_amount'
                    },
                    {
                        data: 'fiat_leased',
                        name: 'fiat_leased'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },

                ]
            });


        });
    </script>


@endsection
