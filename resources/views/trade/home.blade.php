@extends('layouts.app')
 
@section('title', 'Trade Gold')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
					Trade
				</h1>
				<p class="header-subtitle">---</p>
			</div>

			<div class="row">


				<div class="col-xl-4">
					

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Buy Gold</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/trade/buy">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Ringgit Malaysia, RM</label>
											<input type="number" class="form-control" id="in_fiat_amount" name="in_fiat_amount" step="1" min=20 onchange="updateFiatInput()">
										</div>
										<div class="mb-3">
										<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" id="out_gold_amount" name="out_gold_amount" readonly>
										</div>
										<button type="submit" class="btn btn-success">Buy</button>
									</form>
								</div>
							</div>

					
				</div>

				<div class="col-xl-4">
					

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Sell Gold</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/trade/sell">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" id="in_gold_amount" name="in_gold_amount" step="0.1" onchange="updateGoldInput()">
										</div>
										<div class="mb-3">
										<label class="form-label">Ringgit Malaysia, RM</label>
											<input type="number" class="form-control" id="out_fiat_amount" name="out_fiat_amount" readonly>
										</div>
										<button type="submit" class="btn btn-danger">Sell</button>
									</form>
								</div>
							</div>

					
				</div>				



				

				<div class="col-xl-4 d-flex">
					<!-- <div class="w-100">
						<div class="row">
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold price per gram, RM</h5>
											</div>

										</div>
										<h1 class="display-5 mt-1 mb-3">242.64</h1>
										<div class="mb-0">
											<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span>
											24H change
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold balance, gram</h5>
											</div>

										</div>
										<h1 class="display-5 mt-1 mb-3">0.123</h1>
										<div class="mb-0">
											<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>+0.001g </span>
											24H change
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold savings, gram</h5>
											</div>


										</div>
										<h1 class="display-5 mt-1 mb-3">3.456</h1>
										<div class="mb-0">
											<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
											More 
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col mt-0">
												<h5 class="card-title">Gold Leased, g</h5>
											</div>

										</div>
										<h1 class="display-5 mt-1 mb-3">43.123</h1>
										<div class="mb-0">
											<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
											Less 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>		

			<div class="row">
				<div class="col">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">List of gold purchases</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width:10%;">ID</th>
											<th style="width:25%;">Date</th>
											<th style="width:25%">Gold</th>
											<th style="width:25%">Price</th>											
											<th class="d-none d-md-table-cell" style="width:15%">Status</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($boughts as $bought)
											<tr>
												<td><a href="/app/bought/{{ $bought->id }}">B-{{ $bought->id }}</a></td>
												<td>{{ $bought->created_at }}</td>
												<td>{{ number_format($bought->gold_amount / 1000000, 6, '.', ',') }} gram</td>
												<td>{{ $bought->fiat_currency }} {{ number_format($bought->fiat_inflow / 100, 2, '.', ',') }}</td>
												<td class="d-none d-md-table-cell">Created</td>
		
											</tr>
										@endforeach									
									</tbody>
								</table>
							</div>				
					
				</div>
			</div>

			<div class="row">
				<div class="col">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">List of gold solds</h5>
									<h6 class="card-subtitle text-muted">- - -</h6>
								</div>
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width:10%;">ID</th>
											<th style="width:25%;">Date</th>
											<th style="width:25%">Gold</th>
											<th style="width:25%">Price</th>											
											<th class="d-none d-md-table-cell" style="width:15%">Status</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($solds as $sold)
											<tr>
												<td><a href="/app/sold/{{ $sold->id }}">S-{{ $sold->id }}</a></td>
												<td>{{ $sold->created_at }}</td>
												<td>{{ number_format($sold->gold_amount / 1000000, 6, '.', ',') }} gram</td>
												<td>{{ $sold->fiat_currency }} {{ number_format($sold->fiat_outflow / 100, 2, '.', ',') }}</td>
												<td class="d-none d-md-table-cell">Created</td>
		
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
<script type="text/javascript">
  $(function () {
      
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "/app/trades/dt",
          data: function (d) {
                d.status = $('#status').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status'},
        ]
    });
  
    $('#status').change(function(){
        table.draw();
    });
      
  });
</script>

<script type="text/javascript">

	var gold_price = {!! json_encode($gold_price->toArray()) !!};
	var myr_price = {!! json_encode($myr_price->toArray()) !!};


	function updateFiatInput(){
		var fiat_flow = document.getElementById("in_fiat_amount").value * 100;
		var fiat_fee = document.getElementById("in_fiat_amount").value * 5;
		var fiat_nett = fiat_flow - fiat_fee;
		var gold_amount = fiat_nett * 100 / (gold_price['buy_price'] * myr_price['buy_price'])
		document.getElementById("out_gold_amount").value = gold_amount.toFixed(6);
		// var in_fiat_amount = document.getElementById("in_fiat_amount").value
		// document.getElementById("out_gold_amount").value = ish;
	}

	function updateGoldInput(){
		var gold_amount = document.getElementById("in_gold_amount").value;
		var fiat_amount = gold_amount * (gold_price['sell_price'] * myr_price['sell_price']) / 10000;
		document.getElementById("out_fiat_amount").value = fiat_amount.toFixed(2);
		// var in_fiat_amount = document.getElementById("in_fiat_amount").value
		// document.getElementById("out_gold_amount").value = ish;
	}	


</script>
@endsection