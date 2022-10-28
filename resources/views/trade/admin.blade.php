@extends('layouts.app')
 
@section('title', 'Admin - Trade')
 
@section('content')

	<main class="content">

		<div class="container-fluid">

			<div class="header">
				<h1 class="header-title">
                    Trade Dashboard
				</h1>
			</div>

			<div class="row">

                <div class="col-xl-6">
					
					<div class="card">
                        <div class="card-body">  
    
                            aggregate buys, sells, nets.. in gold and in rm
                            total buys, sells, nets for the day..  in gold and in rm

                            list of buys(confirmed), list of sells(paid out)
                        </div>
                    </div>
                </div>
				


			</div>		
			

			
		</div>



	</main>

@endsection	

@section('script')

@endsection