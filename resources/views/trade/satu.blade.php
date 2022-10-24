@extends('layouts.app')

@section('title', 'Trade Gold')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="row">


                <div class="col-xl-4">


                    {{-- 						
			
                    8	status	varchar(255)	utf8mb4	utf8mb4_unicode_ci	NO	NULL			
                    9	user_id	bigint unsigned	NULL	NULL	NO	NULL		users(id)	
                    10	created_at	timestamp	NULL	NULL	YES	NULL			
                    11	updated_at	timestamp	NULL	NULL	YES	NULL			 --}}

                    <div class="card">
                        <div class="card-body">
                            @if ($trade->buy)
                                <h3>Gold Purchase</h3>                            
                            @else
                                <h3>Gold Sold</h3>
                            @endif                        
                            <div class="mb-3">
                                <label class="form-label">Ringgit Malaysia, RM</label>
                                <input type="text" class="form-control"
                                    value="{{ number_format($trade->fiat / 100, 2, '.', ',') }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gold amount, gram</label>
                                <input type="text" class="form-control"
                                    value="{{ number_format($trade->gold / 1000000, 3, '.', ',') }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gold price per gram, RM</label>
                                <input type="text" class="form-control"
                                    value="{{ number_format($trade->nett / $trade->gold * 10000, 2, '.', ',') }}" readonly>
                            </div>  
                            <div class="mb-3">
                                <label class="form-label">Timestamp</label>
                                <input type="text" class="form-control"
                                    value="{{$trade->created_at}}" readonly>
                            </div>   
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control"
                                    value="{{ $trade->status }}" readonly>
                            </div>                                                                              


                        </div>
                        {{-- <button type="submit" class="btn btn-success">Pay</button> --}}
                    </div>
                    





                </div>



            </div>


        </div>



    </main>

@endsection

@section('script')

@endsection
