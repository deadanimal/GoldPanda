@extends('layouts.app')

@section('title', 'Trade Gold')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="row">


                <div class="col-xl-4">
     

                    <div class="card">
                        <div class="card-body">
       
                            <h3>Gold enhance</h3>   
                            <div class="mb-3">
                                <label class="form-label">Booking Deposit, RM</label>
                                <input type="text" class="form-control"
                                    value="{{ number_format($enhance->capital / 100, 2, '.', ',') }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fee Amount, RM</label>
                                <input type="text" class="form-control"
                                    value="{{ number_format($fee / 100, 2, '.', ',') }}" readonly>
                            </div>    
                            <div class="mb-3">
                                <label class="form-label">Total Amount, RM</label>
                                <input type="text" class="form-control"
                                    value="{{ number_format($total_amount / 100, 2, '.', ',') }}" readonly>
                            </div>                                                      
                            <div class="mb-3">
                                <label class="form-label">Gold amount, gram</label>
                                <input type="text" class="form-control"
                                    value="{{ number_format($enhance->amount / 1000000, 3, '.', ',') }}" readonly>
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label">Gold price per gram, RM</label>
                                <input type="text" class="form-control"
                                    value="{{ number_format($enhance->fiat_leased / (0.85 * $enhance->gold_amount)  * 10000, 2, '.', ',') }}" readonly>
                            </div> 
                            

                            <div class="mb-3">
                                <label class="form-label">Timestamp</label>
                                <input type="text" class="form-control"
                                    value="{{$enhance->created_at}}" readonly>
                            </div>    --}}
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control"
                                    value="{{ $enhance->status }}" readonly>
                            </div>                                                                              


                        </div>
                        @if($enhance->status == 'Active')
                            <button type="submit" class="btn btn-success">Pay</button>
                        @endif
                    </div>
                    





                </div>



            </div>


        </div>



    </main>

@endsection

@section('script')

@endsection
