@extends('layouts.app')

@section('title', 'Admin - User')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    User
                </h1>
            </div>

            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-sm gold-datatable">
                                <thead>
                                    <tr>
										<th>Name</th>
                                        <th>Mobile</th>
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
                ajax: "/admin/user",
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },					
                    {
                        data: 'mobile',
                        name: 'mobile'
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
