@extends('layouts.app')

@section('title', 'Professional Trading Tool')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    RM {{ number_format(($myr_price->price * $gold_price->price) / 100 / 100, 2, '.', ',') }}
                </h1>
                <p id="priceDatetime" class="header-subtitle"></p>
            </div>


            <div class="row">


                <div class="col-xl-3">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Trade Gold</h5>
                            <h6 class="card-subtitle text-muted">Buy or sell spot gold</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/trade">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Gold Trade</label>
                                    <select class="form-control mb-3" name="nature" id="nature"
                                        onchange="trade_gold_changed()">
                                        <option value=1 selected>Buy Gold</option>
                                        <option value=0>Sell Gold</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Amount, RM</label>
                                    <input type="number" class="form-control" name="fiat" id="fiat" value=20 min=20
                                        step=1 max=10000 onchange="trade_gold_changed()">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Fee, RM</label>
                                    <input type="number" class="form-control" name="fiat_fee" id="fiat_fee" readonly>
                                </div>   
                                <div class="mb-3">
                                    <label class="form-label">Total, RM</label>
                                    <input type="number" class="form-control" name="fiat_total" id="fiat_total" readonly>
                                </div>                                                                  
                                <div class="mb-3">
                                    <label class="form-label">Gold Amount, g</label>
                                    <input type="number" class="form-control" name="gold_amount" id="gold_amount" readonly>
                                </div>
                                <button type="submit" class="btn btn-primary">Trade Gold</button>
                            </form>
                        </div>
                    </div>


                </div>

                <div class="col-xl-9">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of gold trades</h5>
                            {{-- <h6 class="card-subtitle text-muted">- - -</h6> --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-sm trade-datatable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Gold</th>
                                        <th>Amount</th>
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


            {{-- <div class="row">


                <div class="col-xl-3">


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
                                    <input type="number" class="form-control"
                                        value="{{ number_format($user->balance / 1000000, 2, '.', '') }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gold Amount, gram</label>
                                    <input type="number" class="form-control" onchange="advance_gold_changed()"
                                        id="gold_amount" name="gold_amount" value=1 step="0.1" min=1>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Amount Advanced, RM</label>
                                    <input type="number" class="form-control" id="amount_advanced" readonly>
                                </div>
                                @if ($user->balance >= 1000000)
                                    <button type="submit" class="btn btn-primary">Advance Gold</button>
                                @endif
                            </form>
                        </div>
                    </div>


                </div>

                <div class="col-xl-9">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List of Advances</h5>
                            
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

            </div> --}}

            <div class="row">


                <div class="col-xl-3">


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Book Gold</h5>
                            <h6 class="card-subtitle text-muted">Book gold for future investment</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/enhance">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Package</label>
                                    <select class="form-control mb-3" name="leverage" id="leverage"
                                        onchange="enhance_gold_changed()">
                                        <option value=5 selected>Accumulation RM20</option>
                                        <option value=6>Accumulation RM50</option>
                                        <option value=7>Accumulation RM100</option>
                                        {{-- <option value=8>Accumulation RM500</option>
                                        <option value=10>Accumulation RM1,000</option> --}}
                                        {{-- <option value=1>1 Dinar (4.25g)</option>
                                        <option value=2>5 Dinar (21.25g)</option>
                                        <option value=3>10 Dinar (42.50g)</option>                                         --}}
                                        {{-- <option value=4>Gold Multiplier 5X</option> --}}
                                        <option value=9>Gold Multiplier</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Booking Deposit, RM</label>
                                    <input type="number" class="form-control" name="fiat_amount" id="fiat_amount"
                                        value=20.00 min=20.00 step=10 max=50000.00 onchange="enhance_gold_changed()">
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

                <div class="col-xl-9">

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
        var goldPriceDatetime = {!! json_encode($gold_price->created_at) !!}

        var statement = 'Price of gold as of ' + moment(goldPriceDatetime).format("DD/MM/YYYY h:mma");
        document.getElementById("priceDatetime").innerHTML = statement;

        trade_gold_changed();

        function trade_gold_changed() {
            var gold_price = {!! ($gold_price->price * $myr_price->price) / 10000 !!}

            var fiat_amount = parseFloat(document.getElementById('fiat').value);
            var gold_amount = 0;

            if (document.getElementById('nature').value == 1) {
                fiat_fee = parseFloat(fiat_amount / 20);
                fiat_total = fiat_amount + fiat_fee;
                gold_amount = fiat_amount / gold_price;
            } else {
                fiat_fee = 0.00;
                fiat_total = fiat_amount;
                gold_amount = fiat_amount / gold_price;
            }            
            fiat_total = parseFloat(fiat_total);
            document.getElementById('gold_amount').value = gold_amount.toFixed(3);
            document.getElementById('fiat_fee').value = fiat_fee.toFixed(2);
            document.getElementById('fiat_total').value = fiat_total.toFixed(2);

        }

        // advance_gold_changed();

        // function advance_gold_changed() {
        //     var gold_price = {!! ($gold_price->price * $myr_price->price) / 10000 !!}
        //     var gold_amount = document.getElementById('gold_amount').value;
        //     document.getElementById('amount_advanced').value = (0.85 * gold_amount * gold_price).toFixed(2);
        // }

        enhance_gold_changed();

        function enhance_gold_changed() {
            var gold_price = {!! ($gold_price->price * $myr_price->price) / 10000 !!}
            var leverage = parseInt(document.getElementById('leverage').value);
            if (leverage == 1 || leverage == 2 || leverage == 3) {
                document.getElementById('fiat_amount').readOnly = true;

                if (leverage == 1) {
                    document.getElementById('gold_booked').value = 4.25;
                    var total_ = 4.25 * 1.05 * gold_price;
                } else if (leverage == 2) {
                    document.getElementById('gold_booked').value = 21.25;
                    var total_ = 21.25 * 1.05 * gold_price;
                } else {
                    document.getElementById('gold_booked').value = 42.50;
                    var total_ = 42.50 * 1.05 * gold_price;
                }
                document.getElementById('amount_booked').value = total_.toFixed(2);
                document.getElementById('fiat_amount').value = (total_ / 10).toFixed(2);

            } else if (leverage == 5 || leverage == 6 || leverage == 7) {
                document.getElementById('fiat_amount').readOnly = true;
                if (leverage == 5) {
                    var deposit = 20.00;
                } else if(leverage == 6) {
                    var deposit = 50.00;
                } else if(leverage == 7) {
                    var deposit = 100.00;
                }
                document.getElementById('fiat_amount').value = deposit;
                var total_ = deposit * 10;
                document.getElementById('amount_booked').value = total_;
                document.getElementById('gold_booked').value = (.95 * total_ / gold_price).toFixed(3);
            } else {
                document.getElementById('fiat_amount').readOnly = false;
                var fiat_amount = parseFloat(document.getElementById('fiat_amount').value);
                var total_ = (leverage + 1) * fiat_amount;
                document.getElementById('amount_booked').value = total_.toFixed(2);
                document.getElementById('gold_booked').value = (.95 * total_ / gold_price).toFixed(3);
            }
        }
    </script>

    <script type="text/javascript">
        $(function() {

            var table = $('.trade-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/trade",
                columns: [{
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
                        data: 'fiat_',
                        name: 'fiat_'
                    },
                    {
                        data: 'status_',
                        name: 'status_'
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

            var table = $('.advance-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/advance",
                columns: [{
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
                columns: [{
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
