@extends('layouts.app')

@section('title', 'Admin - User')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Consultant
                </h1>
            </div>


            <div class="row">

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Upline</h4>
                            <p class="card-text">{{ $user->introducer->name }}</p>                         

                            <h4 class="card-title">My Code</h4>
                            <p class="card-text">{{ $user->code }}</p>


                        </div>
             
                    </div>
                </div>


                <div class="col">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">All Sales</h5>
                                            </div>
                                        </div>
                                        <h1 class="display-5 mt-1 mb-3">
                                            RM {{ number_format((int)($data->all_agent_cumulative)  / 100, 2, '.', '') }}
                                        </h1>                                          
                                        <div class="mb-0">
											<span class="text-dark">Monthly: RM {{ number_format((int)($data->all_agent_monthly)  / 100, 2, '.', '') }}</span>											
										</div>                                                                                                                                                             
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Personal Sales</h5>
                                            </div>
                                        </div>
                                        <h1 class="display-5 mt-1 mb-3">
                                            RM {{ number_format((int)($data->first_agent_cumulative)  / 100, 2, '.', '') }}
                                        </h1>                                          
                                        <div class="mb-0">
											<span class="text-dark">Monthly: RM {{ number_format((int)($data->first_agent_monthly)  / 100, 2, '.', '') }}</span>										
										</div>                                                                                                                                                              
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">1st Level Sales</h5>
                                            </div>
                                        </div>
                                        <h1 class="display-5 mt-1 mb-3">
                                            RM {{ number_format((int)($data->second_agent_cumulative)  / 100, 2, '.', '') }}
                                        </h1>                                          
                                        <div class="mb-0">
											<span class="text-dark">Monthly: RM {{ number_format((int)($data->second_agent_monthly)  / 100, 2, '.', '') }}</span>								
										</div>    
                                                                                                                                                                      
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">2nd Level Sales</h5>
                                            </div>
                                        </div>
                                        <h1 class="display-5 mt-1 mb-3">
                                            RM {{ number_format((int)($data->third_agent_cumulative)  / 100, 2, '.', '') }}
                                        </h1>                                          
                                        <div class="mb-0">
											<span class="text-dark">Monthly: RM {{ number_format((int)($data->third_agent_monthly)  / 100, 2, '.', '') }}</span>										
										</div>    
                                                                                                                                                                             
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-sm gold-datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Cumulative</th>
                                        <th>Cumulative Downline</th>
                                        <th>Monthly</th>
                                        <th>Monthly Downline</th>                                        
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
        $(function() {

            var table = $('.gold-datatable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "/user",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'cum_sales',
                        name: 'cum_sales'
                    },
                    {
                        data: 'cum_downlines',
                        name: 'cum_downlines'
                    },
                    {
                        data: 'monthly_sales',
                        name: 'monthly_sales'
                    },
                    {
                        data: 'monthly_downlines',
                        name: 'monthly_downlines'
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
