@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Consultant Profile
                </h1>
                {{-- <p class="header-subtitle">---</p> --}}

                <form method="POST" action="/user/{{$user->id}}">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="user_information" value="verified" class="btn btn-primary">Verify User Information</button>                                   
                    <button type="submit" name="bank_information" value="verified" class="btn btn-light">Verify Bank Number</button>                                   
                </form>                    
            </div>

            <div class="row">

                <div class="row">

                    <div class="col-xl-4">


                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Name</h5>
                                <p class="card-text">{{ $user->name }}</p>

                                <h5 class="card-title">Code</h5>
                                <p class="card-text">{{ $user->code }}</p>                                

                                <h5 class="card-title">
                                    Identity Number
                                </h5>
                                <p class="card-text">
                                    {{ $user->ic }}
                                    @if ($user->ic_verified)
                                        <span class="badge rounded-pill bg-success">Verified</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Unverified</span>
                                    @endif
                                </p>

                                <h5 class="card-title">Email</h5>
                                <p class="card-text">{{ $user->email }}</p>

                                <h5 class="card-title">Mobile Number</h5>
                                <p class="card-text">
                                    {{ $user->mobile }}
                                    @if ($user->mobile_verified)
                                        <span class="badge rounded-pill bg-success">Verified</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Unverified</span>
                                    @endif
                                </p>

                                <h5 class="card-title">Bank</h5>
                                <p class="card-text">{{ $user->bank_account_name }}</p>

                                <h5 class="card-title">Bank Account Number</h5>
                                <p class="card-text">
                                    {{ $user->bank_account_number }}
                                    @if ($user->bank_account_verified)
                                        <span class="badge rounded-pill bg-success">Verified</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Unverified</span>
                                    @endif
                                </p>
                            </div>
                        

                        </div>


                    </div>
            


                </div>

            </div>




    </main>

@endsection

@section('script')

@endsection
