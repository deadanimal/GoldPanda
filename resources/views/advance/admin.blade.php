@extends('layouts.app')

@section('title', 'Admin - Advance')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Advance
                </h1>
            </div>

            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-sm gold-datatable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
										<th>User</th>
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
                ajax: "/admin/advance",
                columns: [{
                        data: {
                            _: "created_at.display",
                            sort: "created_at.timestamp",
                            filter: 'created_at.display'
                        },
                        name: 'created_at.display'
                    },
                    {
                        data: 'user',
                        name: 'user'
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
@endsection
