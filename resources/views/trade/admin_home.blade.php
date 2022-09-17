@extends('layouts.admin')
 
@section('title', 'Admin - Trade')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
                    Trade - ADMIN
				</h1>
				<p class="header-subtitle">---</p>
			</div>

			<div class="row">

                <div class="col-xl-6">
					
					<div class="card">
                        <div class="card-body">  
        $agg_boughts = ''; <br>
        $agg_solds = ''; <br>
        $agg_pay_ins = ''; <br>
        $agg_pay_outs = ''; <br>

        $agg_boughts_last_week = ''; <br>
        $agg_solds_last_week = ''; <br>
        $agg_pay_ins_last_week = ''; <br>
        $agg_pay_outs_last_week = ''; <br>        

        $lapsed_boughts = ''; <br>
        $lapsed_pay_ins = ''; <br>
        
        $pending_solds = ''; <br>
        $pending_pay_outs = ''; <br>

        $profit_sold = ''; <br>
        $profit_bought = ''; <br>

        $reward_sold = ''; <br>   

        <b>Table and filter of the trades to view</b>
        <b>Table and filter of the pay-ins/pay-outs to view</b>

                        </div>
                    </div>
                </div>
				


			</div>		
			

			
		</div>



	</main>

@endsection	

@section('script')

@endsection