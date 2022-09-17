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
									<h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/buy">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Ringgit Malaysia, RM</label>
											<input type="number" class="form-control" name="fiat_amount" value=20.00 step="0.01" min=20.00>
										</div>
										<div class="mb-3">
										<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" name="gold_amount" readonly>
										</div>
										<button type="submit" class="btn btn-success">Buy</button>
									</form>
								</div>
							</div>

					
				</div>

				<div class="col-xl-4">
					

							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Sell</h5>
									<h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
								</div>
								<div class="card-body">
									<form method="POST" action="/app/sell">
    									@csrf
										<div class="mb-3">
											<label class="form-label">Gold Amount, gram</label>
											<input type="number" class="form-control" name="gold_amount" value=0.01 step="0.01" min=0.01>
										</div>
										<div class="mb-3">
										<label class="form-label">Ringgit Malaysia, RM</label>
											<input type="number" class="form-control" name="fiat_amount" readonly>
										</div>
										<button type="submit" class="btn btn-danger">Sell</button>
									</form>
								</div>
							</div>

					
				</div>				



				

				<div class="col-xl-4 d-flex">
					<div class="w-100">
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
										<!-- <div class="mb-0">
											<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span>
											24H change
										</div> -->
									</div>
								</div>
								<!-- <div class="card">
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
								</div> -->
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
										<!-- <div class="mb-0">
											<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
											More 
										</div> -->
									</div>
								</div>
								<!-- <div class="card">
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
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>		

			<div class="row">
				<div class="col">

				<div class="card">
								<div class="card-header">
									<h5 class="card-title">Trade Transaction</h5>
									<h6 class="card-subtitle text-muted">---</h6>
								</div>
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width:5%;">No</th>
											<th style="width:30%;">Date</th>
											<th style="width:10%"></th>
											<th style="width:25%">Gold</th>
											<th style="width:25%">Cash</th>											
											<th class="d-none d-md-table-cell" style="width:15%">Status</th>
											
										</tr>
									</thead>
									<tbody>

										@foreach ($trades as $trade)
											<tr>
												<td>{{ $trade->id }}</td>
												<td>12 September 2020</td>
												<td>BUY</td>
												<td>1.234567g</td>
												<td>RM 200.00</td>
												<td class="d-none d-md-table-cell">Created</td>
		
											</tr>
										@endforeach									
									</tbody>
								</table>
							</div>				


					<!-- <div class="card">
						<div class="card-body">
							<div class="form-group">
								<label><strong>Status :</strong></label>
								<select id='status' class="form-control" style="width: 200px">
									<option value="">--Select Status--</option>
									<option value="1">Active</option>
									<option value="0">Deactive</option>
								</select>
							</div>
						</div>
					</div>
				
					<table class="table table-bordered data-table">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Email</th>
								<th width="100px">Status</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>	 -->
					
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
@endsection