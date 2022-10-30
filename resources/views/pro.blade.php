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
                                    <label class="form-label">Available Gold, gram</label>
                                    <input type="number" class="form-control" value="{{number_format($user->balance / 1000000, 2, '.', '')}}" readonly>
                                </div>                                
                                <div class="mb-3">
                                    <label class="form-label">Gold Amount, gram</label>
                                    <input type="number" class="form-control" onchange="advance_gold_changed()" id="gold_amount" name="gold_amount" value=1 step="0.1"
                                        min=1>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Amount Advanced, RM</label>
                                    <input type="number" class="form-control" id="amount_advanced" readonly>
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
                                        <th>Date</th>
                                        <th>Gold</th>
                                        <th>Repayment</th>
                                        <th>Status</th>
                                        <th></th>
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
                            <h5 class="card-title">Book Gold</h5>
                            <h6 class="card-subtitle text-muted">Book extra gold</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/enhance">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Booking Deposit, RM</label>
                                    <input type="number" class="form-control" name="fiat_amount" id="fiat_amount" value=200 min=200 step=100 max=50000 onchange="enhance_gold_changed()">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Multiplier</label>
                                    <input type="number" class="form-control" name="leverage" id="leverage" value=1 min=1 step=1 max=9 onchange="enhance_gold_changed()"
                                        max="19">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Amount Booked, RM</label>
                                    <input type="number" class="form-control" id="amount_booked" readonly>
                                </div>                                     
                                <div class="mb-3">
                                    <label class="form-label">Gold Booked, g</label>
                                    <input type="number" class="form-control" id="gold_booked" readonly>
                                </div>                                         
                                <button type="submit" class="btn btn-primary">Book Gold</button>
                            </form>
                        </div>
                    </div>


                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of bookings</h5>
                            {{-- <h6 class="card-subtitle text-muted">- - -</h6> --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-sm enhance-datatable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Gold</th>
                                        <th>Deposit</th>
                                        <th>Booking</th>
                                        <th>Status</th>
                                        <th></th>
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
        advance_gold_changed();
        function advance_gold_changed() {
            var gold_price = {!! $gold_price->price * $myr_price->price / 10000 !!}
            var gold_amount = document.getElementById('gold_amount').value;
            document.getElementById('amount_advanced').value = (0.85 * gold_amount * gold_price).toFixed(2);            
        }

        enhance_gold_changed();
        function enhance_gold_changed() {
            var gold_price = {!! $gold_price->price * $myr_price->price / 10000 !!}
            var fiat_amount = parseInt(document.getElementById('fiat_amount').value);
            var leverage = parseInt(document.getElementById('leverage').value);
            var total_ = (leverage + 1) * fiat_amount;
            document.getElementById('amount_booked').value = total_
            document.getElementById('gold_booked').value = (.95*total_ / gold_price).toFixed(3);
        }        
    </script>

    <script type="text/javascript">
        $(function() {

            var table = $('.advance-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/advance",
                columns: [
                    {
                        data: {
                            _: "created_at.display",
                            sort: "created_at.timestamp",
                            filter: 'created_at.display'
                        },
                        name: 'created_at.display'
                    },
                    {
                        data: 'gold_',
                        name: 'gold_'
                    },
                    {
                        data: 'amount_',
                        name: 'amount_'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },                    
                    {
                        data: 'link',
                        name: 'link'
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
                columns: [
                    {
                        data: {
                            _: "created_at.display",
                            sort: "created_at.timestamp",
                            filter: 'created_at.display'
                        },
                        name: 'created_at.display'
                    },
                    {
                        data: 'gold_',
                        name: 'gold_'
                    },
                    {
                        data: 'amount_',
                        name: 'amount_'
                    },
                    {
                        data: 'booked_',
                        name: 'booked_'
                    },                    
                    {
                        data: 'status',
                        name: 'status'
                    },                    
                    {
                        data: 'link',
                        name: 'link'
                    },

                ]
            });


        });
    </script>


@endsection
